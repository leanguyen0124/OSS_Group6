<?php
/** Shared community content column and recent-post sidebar. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="oss-home-layout">
    <div class="oss-community-main">
        <?php
        // HTML rendered by the calling theme template, with values escaped there.
        echo $args['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
    </div>
    <?php get_template_part( 'template-parts/home/recent-posts', null, array( 'items' => $args['items'] ?? oss_community_latest_items( 10 ) ) ); ?>
</div>
