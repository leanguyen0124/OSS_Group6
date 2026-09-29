<?php
/**
 * Main plugin class.
 *
 * @package CustomContentReport
 */

defined( 'ABSPATH' ) || exit;

class Custom_Content_Report {
	const DB_VERSION = '1.1';
	const COMPONENT  = 'custom_content_report';
	const ACTION     = 'activity_reported';

	/**
	 * Plugin instance.
	 *
	 * @var Custom_Content_Report|null
	 */
	private static $instance = null;

	/**
	 * Whether the shared front-end dialog was rendered.
	 *
	 * @var bool
	 */
	private $dialog_rendered = false;

	/**
	 * Return the plugin instance.
	 *
	 * @return Custom_Content_Report
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Register hooks.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'maybe_upgrade' ) );
		add_action( 'admin_notices', array( $this, 'dependency_notice' ) );
		add_action( 'bp_activity_entry_meta', array( $this, 'render_report_button' ), 99 );
		add_filter( 'bbp_topic_admin_links', array( $this, 'add_topic_report_link' ), 20, 2 );
		add_filter( 'bbp_reply_admin_links', array( $this, 'add_reply_report_link' ), 20, 2 );
		add_filter( 'bbp_has_topics_query', array( $this, 'hide_reported_topics' ) );
		add_filter( 'bbp_has_replies_query', array( $this, 'hide_reported_replies' ) );
		add_action( 'wp_footer', array( $this, 'render_report_dialog' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'wp_ajax_ccr_report_activity', array( $this, 'ajax_report_activity' ) );
		add_filter( 'bp_activity_get_where_conditions', array( $this, 'hide_reported_activities' ), 10, 2 );
		add_filter( 'bp_notifications_get_notifications_for_user', array( $this, 'format_notification' ), 10, 8 );
		add_action( 'bp_activity_deleted_activities', array( $this, 'mark_deleted_activities' ) );
		add_action( 'before_delete_post', array( $this, 'mark_deleted_forum_post' ) );
		add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
		add_action( 'admin_post_ccr_delete_activity', array( $this, 'handle_delete_activity' ) );
	}

	/**
	 * Create or upgrade the report table.
	 */
	public static function activate() {
		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$table_name      = $wpdb->prefix . 'content_reports';
		$charset_collate = $wpdb->get_charset_collate();
		$sql             = "CREATE TABLE {$table_name} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			content_type varchar(20) NOT NULL DEFAULT 'activity',
			activity_id bigint(20) unsigned NOT NULL,
			reporter_id bigint(20) unsigned NOT NULL,
			reported_user_id bigint(20) unsigned NOT NULL,
			reason varchar(50) NOT NULL,
			details text NOT NULL,
			status varchar(20) NOT NULL DEFAULT 'open',
			created_at datetime NOT NULL,
			updated_at datetime NOT NULL,
			resolved_by bigint(20) unsigned NOT NULL DEFAULT 0,
			PRIMARY KEY  (id),
			UNIQUE KEY content_reporter (content_type,activity_id,reporter_id),
			KEY activity_id (activity_id),
			KEY status (status),
			KEY reported_user_id (reported_user_id)
		) {$charset_collate};";

		dbDelta( $sql );

		$legacy_index = $wpdb->get_var( "SHOW INDEX FROM {$table_name} WHERE Key_name = 'activity_reporter'" );
		if ( $legacy_index ) {
			$wpdb->query( "ALTER TABLE {$table_name} DROP INDEX activity_reporter" );
		}

		update_option( 'ccr_db_version', self::DB_VERSION );
	}

	/**
	 * Run schema upgrades after a plugin update.
	 */
	public function maybe_upgrade() {
		if ( self::DB_VERSION !== get_option( 'ccr_db_version' ) ) {
			self::activate();
		}
	}

	/**
	 * Show a dependency warning to administrators.
	 */
	public function dependency_notice() {
		if ( function_exists( 'bp_is_active' ) || ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		echo '<div class="notice notice-warning"><p>';
		esc_html_e( 'Custom Content Report requires BuddyPress to be active.', 'custom-content-report' );
		echo '</p></div>';
	}

	/**
	 * Report reasons shown to users and moderators.
	 *
	 * @return array<string,string>
	 */
	private function reasons() {
		return array(
			'spam'        => __( 'Spam or misleading content', 'custom-content-report' ),
			'harassment'  => __( 'Harassment or bullying', 'custom-content-report' ),
			'hate'        => __( 'Hate speech', 'custom-content-report' ),
			'violence'    => __( 'Violence or dangerous content', 'custom-content-report' ),
			'inappropriate' => __( 'Inappropriate content', 'custom-content-report' ),
			'other'       => __( 'Other', 'custom-content-report' ),
		);
	}

	/**
	 * Whether the current request can show the reporting UI.
	 *
	 * @return bool
	 */
	private function can_report_here() {
		$has_activity = function_exists( 'bp_is_active' ) && bp_is_active( 'activity' );
		$has_forums   = function_exists( 'bbp_get_topic_post_type' );

		return is_user_logged_in() && ( $has_activity || $has_forums );
	}

	/**
	 * Render a report button for another member's activity.
	 */
	public function render_report_button() {
		if ( ! $this->can_report_here() || ! function_exists( 'bp_get_activity_id' ) ) {
			return;
		}

		$activity_id = (int) bp_get_activity_id();
		$author_id   = (int) bp_get_activity_user_id();

		if ( ! $activity_id || get_current_user_id() === $author_id ) {
			return;
		}

		printf(
			'<button type="button" class="button bp-secondary-action ccr-report-button" data-content-type="activity" data-content-id="%1$d" aria-haspopup="dialog">%2$s</button>',
			$activity_id,
			esc_html__( 'Report', 'custom-content-report' )
		);
	}

	/**
	 * Add a report action beside bbPress topic actions.
	 *
	 * @param array $links    Existing action links.
	 * @param int   $topic_id Topic ID.
	 * @return array
	 */
	public function add_topic_report_link( $links, $topic_id ) {
		if ( ! is_user_logged_in() || get_current_user_id() === (int) bbp_get_topic_author_id( $topic_id ) ) {
			return $links;
		}

		$links['ccr_report'] = $this->forum_report_button( 'topic', $topic_id );

		return $links;
	}

	/**
	 * Add a report action beside bbPress reply actions.
	 *
	 * @param array $links    Existing action links.
	 * @param int   $reply_id Reply ID.
	 * @return array
	 */
	public function add_reply_report_link( $links, $reply_id ) {
		if ( ! is_user_logged_in() || get_current_user_id() === (int) bbp_get_reply_author_id( $reply_id ) ) {
			return $links;
		}

		$links['ccr_report'] = $this->forum_report_button( 'reply', $reply_id );

		return $links;
	}

	/**
	 * Build a bbPress report button.
	 *
	 * @param string $content_type Topic or reply.
	 * @param int    $content_id   bbPress post ID.
	 * @return string
	 */
	private function forum_report_button( $content_type, $content_id ) {
		return sprintf(
			'<button type="button" class="ccr-report-button ccr-report-link" data-content-type="%1$s" data-content-id="%2$d" aria-haspopup="dialog">%3$s</button>',
			esc_attr( $content_type ),
			(int) $content_id,
			esc_html__( 'Report', 'custom-content-report' )
		);
	}

	/**
	 * Hide reported topics from this member's bbPress queries.
	 *
	 * @param array $args WP_Query arguments.
	 * @return array
	 */
	public function hide_reported_topics( $args ) {
		return $this->exclude_reported_forum_posts( $args, 'topic' );
	}

	/**
	 * Hide reported replies from this member's bbPress queries.
	 *
	 * @param array $args WP_Query arguments.
	 * @return array
	 */
	public function hide_reported_replies( $args ) {
		$reported_ids = array_merge(
			$this->reported_content_ids( 'reply' ),
			$this->reported_content_ids( 'topic' )
		);

		if ( empty( $reported_ids ) ) {
			return $args;
		}

		$args['post__not_in'] = array_unique( array_merge( isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array(), $reported_ids ) );

		return $args;
	}

	/**
	 * Add member-specific exclusions to a bbPress query.
	 *
	 * @param array  $args         WP_Query arguments.
	 * @param string $content_type Topic or reply.
	 * @return array
	 */
	private function exclude_reported_forum_posts( $args, $content_type ) {
		$reported_ids = $this->reported_content_ids( $content_type );

		if ( empty( $reported_ids ) ) {
			return $args;
		}

		$args['post__not_in'] = array_unique( array_merge( isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array(), $reported_ids ) );

		return $args;
	}

	/**
	 * Get content IDs reported by the logged-in member.
	 *
	 * @param string $content_type Content type.
	 * @return array<int>
	 */
	private function reported_content_ids( $content_type ) {
		if ( ! is_user_logged_in() || is_admin() ) {
			return array();
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'content_reports';

		return wp_parse_id_list(
			$wpdb->get_col(
				$wpdb->prepare(
					"SELECT activity_id FROM {$table_name} WHERE reporter_id = %d AND content_type = %s",
					get_current_user_id(),
					$content_type
				)
			)
		);
	}

	/**
	 * Render one reusable report dialog below the activity loop.
	 */
	public function render_report_dialog() {
		if ( ! $this->can_report_here() || $this->dialog_rendered ) {
			return;
		}

		$this->dialog_rendered = true;
		?>
		<div class="ccr-dialog" hidden>
			<div class="ccr-dialog__backdrop" data-ccr-close></div>
			<div class="ccr-dialog__panel" role="dialog" aria-modal="true" aria-labelledby="ccr-dialog-title">
				<button type="button" class="ccr-dialog__close" data-ccr-close aria-label="<?php esc_attr_e( 'Close', 'custom-content-report' ); ?>">&times;</button>
				<h2 id="ccr-dialog-title"><?php esc_html_e( 'Report this post', 'custom-content-report' ); ?></h2>
				<p><?php esc_html_e( 'Choose the reason that best describes the problem.', 'custom-content-report' ); ?></p>
				<form class="ccr-report-form">
					<input type="hidden" name="content_type" value="">
					<input type="hidden" name="content_id" value="">
					<label for="ccr-reason"><?php esc_html_e( 'Reason', 'custom-content-report' ); ?></label>
					<select id="ccr-reason" name="reason" required>
						<option value=""><?php esc_html_e( 'Select a reason', 'custom-content-report' ); ?></option>
						<?php foreach ( $this->reasons() as $value => $label ) : ?>
							<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>
					<label for="ccr-details"><?php esc_html_e( 'More information (optional)', 'custom-content-report' ); ?></label>
					<textarea id="ccr-details" name="details" rows="4" maxlength="500"></textarea>
					<div class="ccr-report-form__message" role="status" aria-live="polite"></div>
					<div class="ccr-dialog__actions">
						<button type="button" class="button" data-ccr-close><?php esc_html_e( 'Cancel', 'custom-content-report' ); ?></button>
						<button type="submit" class="button button-primary"><?php esc_html_e( 'Send report', 'custom-content-report' ); ?></button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Load front-end assets only when BuddyPress activity is available.
	 */
	public function enqueue_assets() {
		if ( ! $this->can_report_here() ) {
			return;
		}

		wp_enqueue_style( 'custom-content-report', CCR_URL . 'assets/css/report.css', array(), CCR_VERSION );
		wp_enqueue_script( 'custom-content-report', CCR_URL . 'assets/js/report.js', array(), CCR_VERSION, true );
		wp_localize_script(
			'custom-content-report',
			'CCR_REPORT',
			array(
				'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
				'nonce'      => wp_create_nonce( 'ccr_report_activity' ),
				'sending'    => __( 'Sending...', 'custom-content-report' ),
				'success'    => __( 'Report sent. This post is now hidden from your feed.', 'custom-content-report' ),
				'error'      => __( 'Could not send the report. Please try again.', 'custom-content-report' ),
			),
		);
	}

	/**
	 * Save a report, notify the author, then return success to remove the item.
	 */
	public function ajax_report_activity() {
		check_ajax_referer( 'ccr_report_activity', 'nonce' );

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must log in to report content.', 'custom-content-report' ) ), 401 );
		}

		$content_type = isset( $_POST['content_type'] ) ? sanitize_key( wp_unslash( $_POST['content_type'] ) ) : '';
		$content_id   = isset( $_POST['content_id'] ) ? absint( wp_unslash( $_POST['content_id'] ) ) : 0;
		$reason       = isset( $_POST['reason'] ) ? sanitize_key( wp_unslash( $_POST['reason'] ) ) : '';
		$details      = isset( $_POST['details'] ) ? sanitize_textarea_field( wp_unslash( $_POST['details'] ) ) : '';
		$reasons      = $this->reasons();

		if ( ! in_array( $content_type, array( 'activity', 'topic', 'reply' ), true ) || ! $content_id || ! isset( $reasons[ $reason ] ) ) {
			wp_send_json_error( array( 'message' => __( 'Choose a valid reason.', 'custom-content-report' ) ), 400 );
		}

		$reporter_id = get_current_user_id();
		$author_id   = $this->validate_report_target( $content_type, $content_id, $reporter_id );

		if ( is_wp_error( $author_id ) ) {
			wp_send_json_error( array( 'message' => $author_id->get_error_message() ), 400 );
		}

		if ( $reporter_id === (int) $author_id ) {
			wp_send_json_error( array( 'message' => __( 'You cannot report your own post.', 'custom-content-report' ) ), 400 );
		}

		$details = function_exists( 'mb_substr' ) ? mb_substr( $details, 0, 500 ) : substr( $details, 0, 500 );

		global $wpdb;
		$table_name = $wpdb->prefix . 'content_reports';
		$existing   = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT id FROM {$table_name} WHERE content_type = %s AND activity_id = %d AND reporter_id = %d LIMIT 1",
				$content_type,
				$content_id,
				$reporter_id
			)
		);

		if ( $existing ) {
			wp_send_json_success( array( 'message' => __( 'You already reported this post. It remains hidden.', 'custom-content-report' ) ) );
		}

		$now      = current_time( 'mysql', true );
		$inserted = $wpdb->insert(
			$table_name,
			array(
				'content_type'     => $content_type,
				'activity_id'      => $content_id,
				'reporter_id'      => $reporter_id,
				'reported_user_id' => (int) $author_id,
				'reason'           => $reason,
				'details'          => $details,
				'status'           => 'open',
				'created_at'       => $now,
				'updated_at'       => $now,
			),
			array( '%s', '%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s' )
		);

		if ( false === $inserted ) {
			wp_send_json_error( array( 'message' => __( 'Could not save the report.', 'custom-content-report' ) ), 500 );
		}

		$this->notify_author( $content_type, $content_id, (int) $author_id );

		do_action( 'ccr_content_reported', (int) $wpdb->insert_id, $content_type, $content_id, $reporter_id );

		wp_send_json_success( array( 'message' => __( 'Report sent. This post is now hidden from your feed.', 'custom-content-report' ) ) );
	}

	/**
	 * Validate target visibility and return its author ID.
	 *
	 * @param string $content_type Content type.
	 * @param int    $content_id   Content ID.
	 * @param int    $reporter_id  Reporter user ID.
	 * @return int|WP_Error
	 */
	private function validate_report_target( $content_type, $content_id, $reporter_id ) {
		if ( 'activity' === $content_type ) {
			if ( ! function_exists( 'bp_activity_get_specific' ) ) {
				return new WP_Error( 'activity_unavailable', __( 'Activity reporting is unavailable.', 'custom-content-report' ) );
			}

			$result = bp_activity_get_specific( array( 'activity_ids' => array( $content_id ) ) );
			if ( empty( $result['activities'][0] ) ) {
				return new WP_Error( 'not_found', __( 'This post no longer exists.', 'custom-content-report' ) );
			}

			$activity = $result['activities'][0];
			if ( function_exists( 'bp_activity_user_can_read' ) && ! bp_activity_user_can_read( $activity, $reporter_id ) ) {
				return new WP_Error( 'forbidden', __( 'You cannot access this post.', 'custom-content-report' ) );
			}

			return (int) $activity->user_id;
		}

		$post = get_post( $content_id );
		if ( ! $post || ! function_exists( 'bbp_get_topic_post_type' ) ) {
			return new WP_Error( 'not_found', __( 'This post no longer exists.', 'custom-content-report' ) );
		}

		$expected_type = 'topic' === $content_type ? bbp_get_topic_post_type() : bbp_get_reply_post_type();
		if ( $expected_type !== $post->post_type ) {
			return new WP_Error( 'invalid_type', __( 'This post cannot be reported.', 'custom-content-report' ) );
		}

		$forum_id = 'topic' === $content_type ? bbp_get_topic_forum_id( $content_id ) : bbp_get_reply_forum_id( $content_id );
		if ( function_exists( 'bbp_user_can_view_forum' ) && ! bbp_user_can_view_forum( array( 'forum_id' => $forum_id, 'user_id' => $reporter_id ) ) ) {
			return new WP_Error( 'forbidden', __( 'You cannot access this post.', 'custom-content-report' ) );
		}

		return (int) $post->post_author;
	}

	/**
	 * Add a private BuddyPress notification to the activity author.
	 *
	 * @param string $content_type Content type.
	 * @param int    $content_id   Content ID.
	 * @param int    $author_id    Author user ID.
	 */
	private function notify_author( $content_type, $content_id, $author_id ) {
		if ( ! $author_id || ! function_exists( 'bp_notifications_add_notification' ) ) {
			return;
		}

		bp_notifications_add_notification(
			array(
				'user_id'           => $author_id,
				'item_id'           => $content_id,
				'secondary_item_id' => 0,
				'component_name'    => self::COMPONENT,
				'component_action'  => $content_type . '_reported',
				'date_notified'     => function_exists( 'bp_core_current_time' ) ? bp_core_current_time() : current_time( 'mysql', true ),
				'is_new'            => 1,
				'allow_duplicate'   => false,
			)
		);
	}

	/**
	 * Format the custom BuddyPress notification.
	 *
	 * @param mixed  $content               Existing content.
	 * @param int    $item_id               Activity ID.
	 * @param int    $secondary_item_id     Unused.
	 * @param int    $total_items           Notification count.
	 * @param string $format                Requested format.
	 * @param string $component_action_name Component action.
	 * @param string $component_name        Component name.
	 * @param int    $notification_id       Notification ID.
	 * @return mixed
	 */
	public function format_notification( $content, $item_id, $secondary_item_id, $total_items, $format, $component_action_name, $component_name, $notification_id ) {
		unset( $secondary_item_id, $notification_id );

		$actions = array( self::ACTION, 'topic_reported', 'reply_reported' );
		if ( self::COMPONENT !== $component_name || ! in_array( $component_action_name, $actions, true ) ) {
			return $content;
		}

		if ( 'topic_reported' === $component_action_name && function_exists( 'bbp_get_topic_permalink' ) ) {
			$link = bbp_get_topic_permalink( $item_id );
		} elseif ( 'reply_reported' === $component_action_name && function_exists( 'bbp_get_reply_url' ) ) {
			$link = bbp_get_reply_url( $item_id );
		} else {
			$link = function_exists( 'bp_activity_get_permalink' ) ? bp_activity_get_permalink( $item_id ) : home_url( '/' );
		}
		$text = 1 < (int) $total_items
			? sprintf( __( '%d of your posts were reported. Please review them for possible policy violations.', 'custom-content-report' ), (int) $total_items )
			: __( 'Your post was reported. Please review it for possible policy violations.', 'custom-content-report' );

		if ( 'string' === $format ) {
			return '<a href="' . esc_url( $link ) . '">' . esc_html( $text ) . '</a>';
		}

		return array(
			'text' => $text,
			'link' => $link,
		);
	}

	/**
	 * Exclude reports made by the logged-in user from activity queries.
	 *
	 * @param array $where_conditions Existing SQL conditions.
	 * @param array $args             Activity query arguments.
	 * @return array
	 */
	public function hide_reported_activities( $where_conditions, $args ) {
		unset( $args );

		if ( ! is_user_logged_in() || is_admin() ) {
			return $where_conditions;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'content_reports';
		$user_id    = get_current_user_id();

		$where_conditions['ccr_reported'] = $wpdb->prepare(
			"a.id NOT IN (SELECT activity_id FROM {$table_name} WHERE reporter_id = %d AND content_type = 'activity')",
			$user_id
		);

		return $where_conditions;
	}

	/**
	 * Keep report rows in sync when activity is deleted elsewhere.
	 *
	 * @param array|int $activity_ids Deleted activity IDs.
	 */
	public function mark_deleted_activities( $activity_ids ) {
		global $wpdb;

		$activity_ids = wp_parse_id_list( $activity_ids );
		if ( empty( $activity_ids ) ) {
			return;
		}

		$table_name   = $wpdb->prefix . 'content_reports';
		$placeholders = implode( ',', array_fill( 0, count( $activity_ids ), '%d' ) );
		$params       = array_merge( array( current_time( 'mysql', true ), get_current_user_id() ), $activity_ids );
		$sql          = "UPDATE {$table_name} SET status = 'deleted', updated_at = %s, resolved_by = %d WHERE content_type = 'activity' AND activity_id IN ({$placeholders})";

		$wpdb->query( $wpdb->prepare( $sql, $params ) );

		if ( function_exists( 'bp_notifications_delete_all_notifications_by_type' ) ) {
			foreach ( $activity_ids as $activity_id ) {
				bp_notifications_delete_all_notifications_by_type( $activity_id, self::COMPONENT, self::ACTION );
			}
		}
	}

	/**
	 * Keep report rows in sync when a bbPress topic or reply is deleted.
	 *
	 * @param int $post_id WordPress post ID.
	 */
	public function mark_deleted_forum_post( $post_id ) {
		if ( ! function_exists( 'bbp_get_topic_post_type' ) ) {
			return;
		}

		$post = get_post( $post_id );
		if ( ! $post ) {
			return;
		}

		if ( bbp_get_topic_post_type() === $post->post_type ) {
			$content_type = 'topic';
		} elseif ( bbp_get_reply_post_type() === $post->post_type ) {
			$content_type = 'reply';
		} else {
			return;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'content_reports';
		$wpdb->update(
			$table_name,
			array(
				'status'      => 'deleted',
				'updated_at'  => current_time( 'mysql', true ),
				'resolved_by' => get_current_user_id(),
			),
			array(
				'content_type' => $content_type,
				'activity_id'  => $post_id,
			),
			array( '%s', '%s', '%d' ),
			array( '%s', '%d' )
		);

		if ( function_exists( 'bp_notifications_delete_all_notifications_by_type' ) ) {
			bp_notifications_delete_all_notifications_by_type( $post_id, self::COMPONENT, $content_type . '_reported' );
		}
	}

	/**
	 * Add moderation queue to wp-admin.
	 */
	public function register_admin_page() {
		$count = $this->open_report_count();
		$title = __( 'Content Reports', 'custom-content-report' );

		if ( $count ) {
			$title .= sprintf( ' <span class="awaiting-mod">%d</span>', $count );
		}

		add_menu_page(
			__( 'Content Reports', 'custom-content-report' ),
			$title,
			'manage_options',
			'custom-content-reports',
			array( $this, 'render_admin_page' ),
			'dashicons-flag',
			58
		);
	}

	/**
	 * Count open reports.
	 *
	 * @return int
	 */
	private function open_report_count() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'content_reports';

		return (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table_name} WHERE status = 'open'" );
	}

	/**
	 * Render the moderation queue.
	 */
	public function render_admin_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to view reports.', 'custom-content-report' ) );
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'content_reports';
		$per_page   = 20;
		$page       = isset( $_GET['paged'] ) ? max( 1, absint( $_GET['paged'] ) ) : 1;
		$offset     = ( $page - 1 ) * $per_page;
		$total      = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table_name}" );
		$reports    = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} ORDER BY FIELD(status, 'open', 'deleted'), created_at DESC LIMIT %d OFFSET %d",
				$per_page,
				$offset
			)
		);
		$reasons    = $this->reasons();
		$activities = array();

		if ( $reports && function_exists( 'bp_activity_get_specific' ) ) {
			$activity_ids = array();
			foreach ( $reports as $report ) {
				if ( 'activity' === $report->content_type ) {
					$activity_ids[] = $report->activity_id;
				}
			}

			if ( $activity_ids ) {
				$activity_result = bp_activity_get_specific(
					array(
						'activity_ids' => $activity_ids,
						'per_page'     => $per_page,
					)
				);

				foreach ( $activity_result['activities'] as $activity ) {
					$activities[ $activity->id ] = $activity;
				}
			}
		}
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Content Reports', 'custom-content-report' ); ?></h1>
			<?php if ( isset( $_GET['ccr_message'] ) ) : ?>
				<div class="notice notice-success is-dismissible"><p><?php echo esc_html( sanitize_text_field( wp_unslash( $_GET['ccr_message'] ) ) ); ?></p></div>
			<?php endif; ?>
			<p><?php esc_html_e( 'Review reported BuddyPress activities, bbPress topics, and replies. Deletion permanently removes the content.', 'custom-content-report' ); ?></p>
			<table class="widefat fixed striped">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Post', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Reported user', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Reporter', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Reason', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Details', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Date', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Status', 'custom-content-report' ); ?></th>
						<th><?php esc_html_e( 'Action', 'custom-content-report' ); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php if ( empty( $reports ) ) : ?>
					<tr><td colspan="8"><?php esc_html_e( 'No reports found.', 'custom-content-report' ); ?></td></tr>
				<?php else : ?>
					<?php foreach ( $reports as $report ) : ?>
						<?php
						$content_type = $report->content_type ? $report->content_type : 'activity';
						$author       = get_userdata( $report->reported_user_id );
						$reporter     = get_userdata( $report->reporter_id );
						$link         = '';
						$excerpt      = '';

						if ( 'activity' === $content_type && isset( $activities[ $report->activity_id ] ) ) {
							$link    = function_exists( 'bp_activity_get_permalink' ) ? bp_activity_get_permalink( $report->activity_id ) : '';
							$excerpt = $activities[ $report->activity_id ]->content;
						} elseif ( in_array( $content_type, array( 'topic', 'reply' ), true ) ) {
							$forum_post = get_post( $report->activity_id );
							if ( $forum_post ) {
								$excerpt = $forum_post->post_content;
								$link    = 'topic' === $content_type && function_exists( 'bbp_get_topic_permalink' )
									? bbp_get_topic_permalink( $report->activity_id )
									: ( function_exists( 'bbp_get_reply_url' ) ? bbp_get_reply_url( $report->activity_id ) : get_permalink( $report->activity_id ) );
							}
						}

						if ( 'deleted' === $report->status ) {
							$link = '';
						}
						?>
						<tr>
							<td>
								<?php if ( $link ) : ?>
									<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">#<?php echo (int) $report->activity_id; ?></a>
								<?php else : ?>
									#<?php echo (int) $report->activity_id; ?>
								<?php endif; ?>
								<small><?php echo esc_html( ucfirst( $content_type ) ); ?></small>
								<?php if ( $excerpt ) : ?>
									<div><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 18 ) ); ?></div>
								<?php endif; ?>
							</td>
							<td><?php echo esc_html( $author ? $author->display_name : __( 'Deleted user', 'custom-content-report' ) ); ?></td>
							<td><?php echo esc_html( $reporter ? $reporter->display_name : __( 'Deleted user', 'custom-content-report' ) ); ?></td>
							<td><?php echo esc_html( isset( $reasons[ $report->reason ] ) ? $reasons[ $report->reason ] : $report->reason ); ?></td>
							<td><?php echo esc_html( $report->details ? $report->details : '—' ); ?></td>
							<td><?php echo esc_html( get_date_from_gmt( $report->created_at, 'Y-m-d H:i' ) ); ?></td>
							<td><?php echo esc_html( 'open' === $report->status ? __( 'Open', 'custom-content-report' ) : __( 'Deleted', 'custom-content-report' ) ); ?></td>
							<td>
								<?php if ( 'open' === $report->status ) : ?>
									<a class="button button-link-delete" href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin-post.php?action=ccr_delete_activity&content_type=' . rawurlencode( $content_type ) . '&content_id=' . (int) $report->activity_id ), 'ccr_delete_content_' . $content_type . '_' . (int) $report->activity_id ) ); ?>" onclick="return confirm('<?php echo esc_js( __( 'Permanently delete this post?', 'custom-content-report' ) ); ?>');"><?php esc_html_e( 'Delete post', 'custom-content-report' ); ?></a>
								<?php else : ?>
									&mdash;
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<?php
			$total_pages = (int) ceil( $total / $per_page );
			if ( 1 < $total_pages ) {
				echo '<div class="tablenav"><div class="tablenav-pages">';
				echo wp_kses_post(
					paginate_links(
						array(
							'base'    => add_query_arg( 'paged', '%#%' ),
							'format'  => '',
							'current' => $page,
							'total'   => $total_pages,
						)
					)
				);
				echo '</div></div>';
			}
			?>
		</div>
		<?php
	}

	/**
	 * Permanently delete one reported item.
	 */
	public function handle_delete_activity() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to delete this post.', 'custom-content-report' ) );
		}

		$content_type = isset( $_GET['content_type'] ) ? sanitize_key( wp_unslash( $_GET['content_type'] ) ) : '';
		$content_id   = isset( $_GET['content_id'] ) ? absint( $_GET['content_id'] ) : 0;
		check_admin_referer( 'ccr_delete_content_' . $content_type . '_' . $content_id );

		if ( ! $content_id || ! in_array( $content_type, array( 'activity', 'topic', 'reply' ), true ) ) {
			wp_die( esc_html__( 'Invalid reported post.', 'custom-content-report' ) );
		}

		if ( 'activity' === $content_type ) {
			$deleted = function_exists( 'bp_activity_delete' ) && bp_activity_delete( array( 'id' => $content_id ) );
		} else {
			$post    = get_post( $content_id );
			$deleted = $post && wp_delete_post( $content_id, true );
		}
		$message = $deleted
			? __( 'Post deleted.', 'custom-content-report' )
			: __( 'Post could not be deleted or no longer exists.', 'custom-content-report' );

		wp_safe_redirect(
			add_query_arg(
				'ccr_message',
				$message,
				admin_url( 'admin.php?page=custom-content-reports' )
			)
		);
		exit;
	}
}
