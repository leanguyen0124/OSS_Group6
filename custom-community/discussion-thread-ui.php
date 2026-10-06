<?php
/**
 * Thread-style presentation for single bbPress topics.
 * Load this file from custom-community.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Enqueue visual-only styles on bbPress topic pages. */
function oss_thread_detail_enqueue_styles() {
	if ( ! is_singular( 'topic' ) ) {
		return;
	}

	wp_register_style( 'oss-thread-detail', false, array(), '1.0.0' );
	wp_enqueue_style( 'oss-thread-detail' );
	wp_add_inline_style( 'oss-thread-detail', '
		body.single-topic #bbpress-forums {
			--oss-thread-ink: #252238;
			--oss-thread-muted: #777387;
			--oss-thread-line: #ebe8f1;
			--oss-thread-accent: #7053a5;
			max-width: 780px;
			margin: 26px auto 56px;
			padding: clamp(18px, 3vw, 30px);
			border: 1px solid #ece8f2;
			border-radius: 24px;
			background: #fff;
			box-shadow: 0 14px 40px rgba(42, 30, 67, .08);
			color: var(--oss-thread-ink);
			font: 400 15px/1.65 system-ui, -apple-system, "Segoe UI", sans-serif;
		}
		body.single-topic #bbpress-forums,
		body.single-topic #bbpress-forums * { box-sizing: border-box; }
		body.single-topic .entry-title,
		body.single-topic .page-title {
			max-width: 780px;
			margin: 28px auto 10px;
			padding: 0 18px;
			color: #29243b;
			font-size: clamp(25px, 4vw, 36px);
			font-weight: 750;
			line-height: 1.2;
			letter-spacing: -.6px;
		}
		body.single-topic #bbpress-forums a { color: var(--oss-thread-accent); }
		body.single-topic #bbpress-forums .bbp-breadcrumb,
		body.single-topic #bbpress-forums .bbp-topic-tags,
		body.single-topic #bbpress-forums .bbp-topic-meta,
		body.single-topic #bbpress-forums .bbp-template-notice {
			color: var(--oss-thread-muted);
			font-size: 12px;
		}
		body.single-topic #bbpress-forums .bbp-template-notice {
			border: 1px solid #e5e9f5;
			border-radius: 12px;
			background: #f7f8fc;
			padding: 10px 14px;
		}
		body.single-topic #bbpress-forums .bbp-topic {
			margin: 18px 0 22px;
			padding: 18px 20px;
			border: 1px solid #e8e3ef;
			border-radius: 19px;
			background: linear-gradient(180deg, #fff 0%, #fdfcff 100%);
			box-shadow: 0 5px 18px rgba(42, 30, 67, .045);
		}
		body.single-topic #bbpress-forums .bbp-topic-author,
		body.single-topic #bbpress-forums .bbp-reply-author {
			float: none !important;
			width: 100% !important;
			min-height: 0 !important;
			margin: 0 !important;
			padding: 0 !important;
			border: 0 !important;
			background: transparent !important;
			text-align: left !important;
		}
		body.single-topic #bbpress-forums .bbp-topic-author img.avatar,
		body.single-topic #bbpress-forums .bbp-reply-author img.avatar {
			width: 40px;
			height: 40px;
			margin: 0 10px 0 0;
			border-radius: 50%;
			object-fit: cover;
			vertical-align: middle;
		}
		body.single-topic #bbpress-forums .bbp-topic-author a.bbp-author-name,
		body.single-topic #bbpress-forums .bbp-reply-author a.bbp-author-name {
			color: var(--oss-thread-ink);
			font-size: 14px;
			font-weight: 700;
			text-decoration: none;
		}
		body.single-topic #bbpress-forums .bbp-topic-content,
		body.single-topic #bbpress-forums .bbp-reply-content {
			float: none !important;
			width: 100% !important;
			margin: 0 !important;
			padding: 12px 0 2px !important;
			border: 0 !important;
			color: #39364a;
			font-size: 15px;
			line-height: 1.75;
			overflow-wrap: anywhere;
		}
		body.single-topic #bbpress-forums .bbp-topic-content p,
		body.single-topic #bbpress-forums .bbp-reply-content p { margin: 0 0 12px; }
		body.single-topic #bbpress-forums .bbp-topic-content p:last-child,
		body.single-topic #bbpress-forums .bbp-reply-content p:last-child { margin-bottom: 0; }
		body.single-topic #bbpress-forums .bbp-reply-content img,
		body.single-topic #bbpress-forums .bbp-topic-content img { max-width: 100%; height: auto; border-radius: 14px; }
		body.single-topic #bbpress-forums ul.bbp-replies,
		body.single-topic #bbpress-forums ul.bbp-replies .bbp-body,
		body.single-topic #bbpress-forums ul.bbp-replies .bbp-body > ul {
			margin: 0 !important;
			padding: 0 !important;
			border: 0 !important;
			background: transparent !important;
			list-style: none !important;
		}
		body.single-topic #bbpress-forums ul.bbp-replies > .bbp-header,
		body.single-topic #bbpress-forums ul.bbp-replies > .bbp-footer { display: none !important; }
		body.single-topic #bbpress-forums .bbp-reply {
			float: none !important;
			width: 100% !important;
			margin: 12px 0 !important;
			padding: 16px 18px !important;
			border: 1px solid var(--oss-thread-line) !important;
			border-radius: 18px !important;
			background: #fff !important;
			box-shadow: 0 4px 14px rgba(42, 30, 67, .035);
		}
		body.single-topic #bbpress-forums .bbp-reply-author .bbp-author-role,
		body.single-topic #bbpress-forums .bbp-reply-author .bbp-user-nicename { display: none; }
		body.single-topic #bbpress-forums .bbp-reply-meta,
		body.single-topic #bbpress-forums .bbp-topic-meta { color: var(--oss-thread-muted); font-size: 11px; }
		body.single-topic #bbpress-forums .bbp-reply-meta p { margin: 4px 0 0; }
		body.single-topic #bbpress-forums .bbp-reply-content .bbp-reply-permalink { display: none; }
		body.single-topic #bbpress-forums .bbp-topic-actions,
		body.single-topic #bbpress-forums .bbp-reply-actions,
		body.single-topic #bbpress-forums .bbp-topic-subscription,
		body.single-topic #bbpress-forums .bbp-topic-favorite {
			color: var(--oss-thread-muted);
			font-size: 12px;
		}
		body.single-topic #bbpress-forums .bbp-topic-actions a,
		body.single-topic #bbpress-forums .bbp-reply-actions a,
		body.single-topic #bbpress-forums .bbp-topic-subscription a,
		body.single-topic #bbpress-forums .bbp-topic-favorite a {
			display: inline-flex;
			align-items: center;
			min-height: 34px;
			margin: 4px 6px 4px 0;
			padding: 6px 11px;
			border: 1px solid var(--oss-thread-line);
			border-radius: 999px;
			background: #fff;
			color: #615774;
			text-decoration: none;
		}
		body.single-topic #bbpress-forums .bbp-topic-actions a:hover,
		body.single-topic #bbpress-forums .bbp-reply-actions a:hover,
		body.single-topic #bbpress-forums .bbp-topic-subscription a:hover,
		body.single-topic #bbpress-forums .bbp-topic-favorite a:hover { background: #f6f2fb; color: var(--oss-thread-accent); }
		body.single-topic #bbpress-forums #bbp-reply-form,
		body.single-topic #bbpress-forums .bbp-reply-form {
			margin-top: 22px;
			padding: 18px;
			border: 1px solid #e8e3ef;
			border-radius: 19px;
			background: #fbfaff;
		}
		body.single-topic #bbpress-forums #bbp_reply_content,
		body.single-topic #bbpress-forums textarea.bbp-the-content {
			width: 100%;
			min-height: 120px;
			padding: 14px 16px;
			border: 1px solid #ded8ea;
			border-radius: 14px;
			background: #fff;
			color: var(--oss-thread-ink);
			font: inherit;
			resize: vertical;
		}
		body.single-topic #bbpress-forums #bbp_reply_submit {
			min-height: 42px;
			padding: 9px 18px;
			border: 0;
			border-radius: 999px;
			background: #7053a5;
			color: #fff;
			font: 650 14px/1.3 system-ui, sans-serif;
			cursor: pointer;
		}
		body.single-topic #bbpress-forums #bbp_reply_submit:hover { background: #5a4089; }
		body.single-topic #bbpress-forums input:focus,
		body.single-topic #bbpress-forums textarea:focus { outline: 3px solid #cfc1e5; outline-offset: 2px; }
		@media (max-width: 640px) {
			body.single-topic #bbpress-forums { margin: 16px 10px 36px; padding: 14px; border-radius: 19px; }
			body.single-topic .entry-title, body.single-topic .page-title { margin-top: 20px; font-size: 25px; }
			body.single-topic #bbpress-forums .bbp-topic,
			body.single-topic #bbpress-forums .bbp-reply { padding: 14px !important; border-radius: 16px !important; }
			body.single-topic #bbpress-forums #bbp-reply-form,
			body.single-topic #bbpress-forums .bbp-reply-form { padding: 14px; }
		}
	' );
}
add_action( 'wp_enqueue_scripts', 'oss_thread_detail_enqueue_styles', 30 );
