<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_vollcomdigital_Starter
 */

?>
<div class="row m-0 mb-3">
    <?php if(!wp_is_mobile()) : ?>
        <div class="col-md-2 py-3">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="dark-blue-gray">
                <div class="search-image-wrapper text-center">
                <?php if( has_post_thumbnail()): ?>
                    <?php echo wp_kses_post(get_the_post_thumbnail(null, 'post-thumbnail', array( 'class' => 'card-img h-100' ))); ?>
                <?php else: ?>
                    <img src="/app/uploads/2021/04/vollcom-digital-logo-cube.png" class="card-img" style="height: 151px; width: auto !important;" alt="Vollcom Digital" loading="lazy">
                <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endif; ?>
    <div class="col-12 col-md-10 py-3">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="dark-blue-gray">
        <div id="post-<?php the_ID(); ?>">
            <div class="entry-meta mb-3 font-weight-bolder">
                <?php wp_vollcomdigital_search_headtexts(); ?>
            </div><!-- .entry-meta -->
            <header class="entry-header">
                <h5 class="entry-title md-h3"><?php the_title(); ?></h5>
            </header><!-- .entry-header -->

            <div class="entry-summary">
                <p>
                    <?php echo excerpt(30); ?>
                </p>
            </div><!-- .entry-summary -->
        </div><!-- #post-## -->
        </a>
    </div>
</div>
