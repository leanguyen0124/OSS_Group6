<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Section Next post
* ------------------------------------------------------------------------------ */


?>
<nav class="badoblog-css-np-box">

    <div class="badoblog-css-np-post-container">
        <?php
        $previous_post = get_previous_post();
        if (!empty($previous_post)) {
            $prev_id = $previous_post->ID;
            $prev_img = get_the_post_thumbnail($prev_id, 'badoblog-img-112x63');
            ?>
            <a href="<?php echo esc_url(get_permalink($prev_id)); ?>">
                <div class="badoblog-css-np-post">
                    <div class="badoblog-css-previous-post-label">
                        <span> &#10094; <?php esc_html_e('Previous post', 'bado-blog'); ?></span>
                    </div>
                    <div class="badoblog-css-previous-post-box">
                        <?php
                        if (!empty($prev_img)) {
                            echo '<div class="badoblog-css-np-post-img">'.$prev_img.'</div>';
                        }
                        ?>
                        <div class="badoblog-css-np-post-title">
                            <?php echo esc_html($previous_post->post_title); ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php 
        }
        ?>
    </div>

    <div class="badoblog-css-np-post-container">
        <?php
        $next_post = get_next_post();
        if (!empty($next_post)) {
            $next_id = $next_post->ID;
            $next_img = get_the_post_thumbnail($next_id, 'badoblog-img-112x63');
            ?>
            <a href="<?php echo esc_url(get_permalink($next_id)); ?>">
                <div class="badoblog-css-np-post">
                    <div class="badoblog-css-next-post-label">
                        <span><?php esc_html_e('Next post', 'bado-blog'); ?> &#10095; </span>
                    </div>
                    <div class="badoblog-css-next-post-box">
                        <?php
                        if (!empty($next_img)) {
                            echo '<div class="badoblog-css-np-post-img">'.$next_img.'</div>';
                        }
                        ?>
                        <div class="badoblog-css-np-post-title">
                            <?php echo esc_html($next_post->post_title); ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php 
        }
        ?>
    </div>
    
</nav>
