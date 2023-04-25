<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_vollcomdigital_Starter
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php if( get_post_type() === 'jobs' ): ?>
            <?php get_template_part( 'template-parts/content', 'jobs'); ?>
        <?php else: ?>
            <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
	    <?php endif; ?>

        <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>
    <?php endwhile; ?>

    </main>
</section>

<?php
get_sidebar();
get_footer();
