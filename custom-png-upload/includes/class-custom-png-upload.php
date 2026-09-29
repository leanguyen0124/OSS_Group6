<?php
/**
 * Main plugin class.
 *
 * @package CustomPNGUpload
 */

defined( 'ABSPATH' ) || exit;

class Custom_PNG_Upload {
	const META_KEY      = '_cpi_image_ids';
	const OWNER_META    = '_cpi_pending_owner';
	const MAX_FILE_SIZE = 5242880;
	const MAX_IMAGES    = 4;

	/**
	 * Plugin instance.
	 *
	 * @var Custom_PNG_Upload|null
	 */
	private static $instance = null;

	/**
	 * Return plugin instance.
	 *
	 * @return Custom_PNG_Upload
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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'wp_ajax_cpi_upload_png', array( $this, 'ajax_upload_png' ) );
		add_action( 'wp_ajax_cpi_delete_pending_png', array( $this, 'ajax_delete_pending_png' ) );

		add_action( 'bp_activity_post_form_options', array( $this, 'render_upload_field' ) );
		add_action( 'bp_activity_posted_update', array( $this, 'attach_to_activity' ), 10, 3 );
		add_action( 'bp_groups_posted_update', array( $this, 'attach_to_group_activity' ), 10, 4 );
		add_filter( 'bp_get_activity_content_body', array( $this, 'append_activity_images' ), 20, 2 );

		add_action( 'bbp_theme_after_topic_form_content', array( $this, 'render_upload_field' ) );
		add_action( 'bbp_theme_after_reply_form_content', array( $this, 'render_upload_field' ) );
		add_action( 'bbp_new_topic', array( $this, 'attach_to_forum_post' ), 20 );
		add_action( 'bbp_edit_topic', array( $this, 'attach_to_forum_post' ), 20 );
		add_action( 'bbp_new_reply', array( $this, 'attach_to_forum_post' ), 20 );
		add_action( 'bbp_edit_reply', array( $this, 'attach_to_forum_post' ), 20 );
		add_filter( 'bbp_get_topic_content', array( $this, 'append_forum_images' ), 20, 2 );
		add_filter( 'bbp_get_reply_content', array( $this, 'append_forum_images' ), 20, 2 );
	}

	/**
	 * Load uploader assets for logged-in members.
	 */
	public function enqueue_assets() {
		if ( ! is_user_logged_in() ) {
			return;
		}

		wp_enqueue_style( 'custom-png-upload', CPI_URL . 'assets/css/upload.css', array(), CPI_VERSION );
		wp_enqueue_script( 'custom-png-upload', CPI_URL . 'assets/js/upload.js', array(), CPI_VERSION, true );
		wp_localize_script(
			'custom-png-upload',
			'CPI_UPLOAD',
			array(
				'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
				'nonce'         => wp_create_nonce( 'cpi_upload_png' ),
				'maxImages'     => self::MAX_IMAGES,
				'maxFileSize'   => self::MAX_FILE_SIZE,
				'uploading'     => __( 'Uploading PNG...', 'custom-png-upload' ),
				'remove'        => __( 'Remove image', 'custom-png-upload' ),
				'invalidType'   => __( 'Only PNG images are allowed.', 'custom-png-upload' ),
				'tooLarge'      => __( 'Each PNG must be 5 MB or smaller.', 'custom-png-upload' ),
				'tooMany'       => sprintf( __( 'Maximum %d images per post.', 'custom-png-upload' ), self::MAX_IMAGES ),
				'uploadError'   => __( 'Image upload failed. Please try again.', 'custom-png-upload' ),
			)
		);
	}

	/**
	 * Render a reusable upload control inside a posting form.
	 */
	public function render_upload_field() {
		if ( ! is_user_logged_in() ) {
			return;
		}

		$existing_count = 0;
		if ( function_exists( 'bbp_is_topic_edit' ) && bbp_is_topic_edit() ) {
			$existing_count = count( wp_parse_id_list( get_post_meta( bbp_get_topic_id(), self::META_KEY, true ) ) );
		} elseif ( function_exists( 'bbp_is_reply_edit' ) && bbp_is_reply_edit() ) {
			$existing_count = count( wp_parse_id_list( get_post_meta( bbp_get_reply_id(), self::META_KEY, true ) ) );
		}
		?>
		<div class="cpi-uploader" data-existing-count="<?php echo (int) $existing_count; ?>">
			<label class="cpi-uploader__label">
				<span><?php esc_html_e( 'Add PNG images', 'custom-png-upload' ); ?></span>
				<input class="cpi-file-input" type="file" accept="image/png,.png" multiple>
			</label>
			<small><?php printf( esc_html__( 'PNG only. Maximum %1$d images, %2$d MB each.', 'custom-png-upload' ), self::MAX_IMAGES, self::MAX_FILE_SIZE / 1048576 ); ?></small>
			<div class="cpi-upload-status" role="status" aria-live="polite"></div>
			<div class="cpi-preview" aria-live="polite"></div>
		</div>
		<?php
	}

	/**
	 * Receive one PNG and create a pending media attachment.
	 */
	public function ajax_upload_png() {
		check_ajax_referer( 'cpi_upload_png', 'nonce' );

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must log in to upload images.', 'custom-png-upload' ) ), 401 );
		}

		if ( empty( $_FILES['cpi_png'] ) || ! is_array( $_FILES['cpi_png'] ) ) {
			wp_send_json_error( array( 'message' => __( 'No image was received.', 'custom-png-upload' ) ), 400 );
		}

		$file = $_FILES['cpi_png'];
		if ( UPLOAD_ERR_OK !== (int) $file['error'] ) {
			wp_send_json_error( array( 'message' => __( 'The PNG upload did not complete.', 'custom-png-upload' ) ), 400 );
		}

		if ( (int) $file['size'] > self::MAX_FILE_SIZE ) {
			wp_send_json_error( array( 'message' => __( 'Each PNG must be 5 MB or smaller.', 'custom-png-upload' ) ), 413 );
		}

		$checked = wp_check_filetype_and_ext( $file['tmp_name'], $file['name'], array( 'png' => 'image/png' ) );
		if ( 'png' !== $checked['ext'] || 'image/png' !== $checked['type'] ) {
			wp_send_json_error( array( 'message' => __( 'Only valid PNG images are allowed.', 'custom-png-upload' ) ), 415 );
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$attachment_id = media_handle_upload(
			'cpi_png',
			0,
			array(),
			array(
				'test_form' => false,
				'mimes'     => array( 'png' => 'image/png' ),
			)
		);

		if ( is_wp_error( $attachment_id ) ) {
			wp_send_json_error( array( 'message' => $attachment_id->get_error_message() ), 400 );
		}

		update_post_meta( $attachment_id, self::OWNER_META, get_current_user_id() );

		wp_send_json_success(
			array(
				'id'  => $attachment_id,
				'url' => wp_get_attachment_image_url( $attachment_id, 'medium' ),
				'alt' => get_the_title( $attachment_id ),
			)
		);
	}

	/**
	 * Delete an uploaded image before its post is submitted.
	 */
	public function ajax_delete_pending_png() {
		check_ajax_referer( 'cpi_upload_png', 'nonce' );

		$attachment_id = isset( $_POST['attachment_id'] ) ? absint( wp_unslash( $_POST['attachment_id'] ) ) : 0;
		if ( ! is_user_logged_in() || ! $this->is_owned_pending_png( $attachment_id ) ) {
			wp_send_json_error( array( 'message' => __( 'This image cannot be removed.', 'custom-png-upload' ) ), 403 );
		}

		wp_delete_attachment( $attachment_id, true );
		wp_send_json_success();
	}

	/**
	 * Associate uploaded PNGs with a BuddyPress activity.
	 *
	 * @param string $content     Activity content.
	 * @param int    $user_id     Activity author ID.
	 * @param int    $activity_id Activity ID.
	 */
	public function attach_to_activity( $content, $user_id, $activity_id ) {
		unset( $content );
		if ( get_current_user_id() === (int) $user_id ) {
			$this->save_activity_images( $activity_id );
		}
	}

	/**
	 * Associate uploaded PNGs with a BuddyPress group activity.
	 *
	 * @param string $content     Activity content.
	 * @param int    $user_id     Activity author ID.
	 * @param int    $group_id    Group ID.
	 * @param int    $activity_id Activity ID.
	 */
	public function attach_to_group_activity( $content, $user_id, $group_id, $activity_id ) {
		unset( $content, $group_id );
		if ( get_current_user_id() === (int) $user_id ) {
			$this->save_activity_images( $activity_id );
		}
	}

	/**
	 * Store uploaded image IDs as activity metadata.
	 *
	 * @param int $activity_id Activity ID.
	 */
	private function save_activity_images( $activity_id ) {
		$ids = $this->claim_posted_images();
		if ( $ids && function_exists( 'bp_activity_update_meta' ) ) {
			bp_activity_update_meta( $activity_id, self::META_KEY, $ids );
		}
	}

	/**
	 * Associate uploaded PNGs with a bbPress topic or reply.
	 *
	 * @param int $post_id Topic or reply ID.
	 */
	public function attach_to_forum_post( $post_id ) {
		if ( get_current_user_id() !== (int) get_post_field( 'post_author', $post_id ) && ! current_user_can( 'moderate' ) ) {
			return;
		}

		$existing = wp_parse_id_list( get_post_meta( $post_id, self::META_KEY, true ) );
		$ids      = $this->claim_posted_images( max( 0, self::MAX_IMAGES - count( $existing ) ) );
		if ( ! $ids ) {
			return;
		}

		$ids      = array_slice( array_unique( array_merge( $existing, $ids ) ), 0, self::MAX_IMAGES );

		foreach ( $ids as $attachment_id ) {
			wp_update_post( array( 'ID' => $attachment_id, 'post_parent' => $post_id ) );
		}

		update_post_meta( $post_id, self::META_KEY, $ids );
	}

	/**
	 * Validate and claim image IDs from current request.
	 *
	 * @param int $limit Maximum images to claim.
	 * @return array<int>
	 */
	private function claim_posted_images( $limit = self::MAX_IMAGES ) {
		$limit = max( 0, min( self::MAX_IMAGES, (int) $limit ) );
		if ( ! $limit || empty( $_POST['cpi_attachment_ids'] ) ) {
			return array();
		}

		$ids     = array_slice( wp_parse_id_list( wp_unslash( $_POST['cpi_attachment_ids'] ) ), 0, $limit );
		$claimed = array();

		foreach ( $ids as $attachment_id ) {
			if ( ! $this->is_owned_pending_png( $attachment_id ) ) {
				continue;
			}

			delete_post_meta( $attachment_id, self::OWNER_META );
			update_post_meta( $attachment_id, '_cpi_content_image', 1 );
			$claimed[] = $attachment_id;
		}

		return $claimed;
	}

	/**
	 * Confirm attachment ownership and PNG MIME type.
	 *
	 * @param int $attachment_id Attachment ID.
	 * @return bool
	 */
	private function is_owned_pending_png( $attachment_id ) {
		return $attachment_id
			&& 'attachment' === get_post_type( $attachment_id )
			&& 'image/png' === get_post_mime_type( $attachment_id )
			&& get_current_user_id() === (int) get_post_meta( $attachment_id, self::OWNER_META, true )
			&& get_current_user_id() === (int) get_post_field( 'post_author', $attachment_id );
	}

	/**
	 * Append image gallery to BuddyPress activity output.
	 *
	 * @param string $content  Activity content.
	 * @param object $activity Activity object.
	 * @return string
	 */
	public function append_activity_images( $content, $activity ) {
		if ( empty( $activity->id ) || ! function_exists( 'bp_activity_get_meta' ) ) {
			return $content;
		}

		return $content . $this->gallery_html( bp_activity_get_meta( $activity->id, self::META_KEY ) );
	}

	/**
	 * Append image gallery to bbPress topic or reply output.
	 *
	 * @param string $content Content HTML.
	 * @param int    $post_id Topic or reply ID.
	 * @return string
	 */
	public function append_forum_images( $content, $post_id ) {
		return $content . $this->gallery_html( get_post_meta( $post_id, self::META_KEY, true ) );
	}

	/**
	 * Build safe gallery HTML.
	 *
	 * @param mixed $attachment_ids Attachment IDs.
	 * @return string
	 */
	private function gallery_html( $attachment_ids ) {
		$attachment_ids = wp_parse_id_list( $attachment_ids );
		if ( ! $attachment_ids ) {
			return '';
		}

		$html = '<div class="cpi-image-gallery">';
		foreach ( $attachment_ids as $attachment_id ) {
			if ( 'image/png' !== get_post_mime_type( $attachment_id ) ) {
				continue;
			}

			$image = wp_get_attachment_image( $attachment_id, 'large', false, array( 'class' => 'cpi-content-image', 'loading' => 'lazy' ) );
			$link  = wp_get_attachment_url( $attachment_id );
			if ( $image && $link ) {
				$html .= '<a href="' . esc_url( $link ) . '" target="_blank" rel="noopener">' . $image . '</a>';
			}
		}

		return $html . '</div>';
	}
}
