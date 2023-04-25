<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_vollcomdigital_Starter
 */

?>
</div>
</div>
</div>
<div id="footer">

    <div class="position-relative d-flex justify-content-center py-5 mt-n5">
        <div class="position-absolute z-1 b-3">
            <div class="triangle-up">
                <img class="ml-n3 pt-3"
                     src="<?php echo esc_url(get_template_directory_uri() . '/inc/assets/images/vollcom-digital-logo-cube.png'); ?>"
                     alt="Vollcom digital cube" width="55" height="75" style="margin-left: -1.7rem !important;">

            </div>
        </div>
        <div class="has-dunkelblau-background-color py-4 position-absolute w-100 z-0" style="bottom: 0"></div>
    </div>
    <?php get_template_part('footer-widget'); ?>
    <footer id="colophon"
            class="site-footer has-hellblau-background-color <?php echo esc_attr(wp_vollcomdigital_starter_bg_class()); ?>"
            role="contentinfo">
        <div class="container py-3">
            <div class="row">
                <div class="site-info white-text col-12 col-md-5 mb-3 mb-md-0">
                    &copy; <?php esc_html_e('Copyright', 'wp-vollcom-digital'); ?> <?php echo '<span class="white-text">' . esc_html(get_bloginfo('name')) . '</span>'; ?> <?php echo date('Y'); ?>
                    . <?php esc_html_e('All Rights Reserved.', 'wp-vollcom-digital'); ?>
                </div>
                <?php if (is_active_sidebar('subfooter')) : ?>
                    <div class="col-12 col-md-7"><?php dynamic_sidebar('subfooter'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</div>
</div>

<?php wp_footer(); ?>
</body>
</html>