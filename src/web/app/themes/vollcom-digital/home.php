<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_vollcomdigital_Starter
 */

get_header();
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var('paged');
}
else if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}
else {
	$paged = 1;
}

$per_page = get_option( 'posts_per_page' );
$hide_empty = '1';
$type = 'post';
$number_of_series = wp_count_posts( $type );
$offset = $per_page * ( $paged - 1) ;
$count_posts = wp_count_posts( $type )->publish;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$the_query = new WP_Query(array(
	'paged' => $paged,
	'posts_per_page' => $per_page,
	'post_type' => $type,
	'offset' => $offset,
	'number' => $per_page,
	'hide_empty' => $hide_empty,
	'order' => 'DESC'
));
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <!--Page header-->
    <header class="page-header mb-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <h1 class="page-title animated text-center text-md-left animatedFadeInUp fadeInUp mb-5"><?php esc_html__( single_post_title(), 'wp-vollcom-digital'); ?></h1>
                    <p><?php echo esc_html__('We share common trends, strategies ideas, opinions, short & long stories from the team behind company. Here’s what we’ve been up to recently.', 'wp-vollcom-digital'); ?></p>
                </div>
                <div class="col-md-6 mb-4 d-none d-md-block">
                    <img class="img-fluid" src="<?php echo esc_url(get_template_directory_uri().'/inc/assets/images/blog-hero.png') ;?>" alt="Vollcom Digital Blog" />
                </div>
            </div>
        </div>
    </header>
    <!--Page header-->

    <?php if( $the_query->have_posts() ): ?>
        <div class="container">
             <!--Grid cards-->
            <div id="card-grids" class="mb-5">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 posts-list">
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php get_template_part( 'template-parts/blocks/cards/blog', 'teaser-card' ); ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <!--/.Grid cards-->

            <!--Pagination-->
            <?php
                if (function_exists("pagination_nav")) {
                    pagination_nav();
                }
            ?>
            <!--/.Pagination-->
        </div>

        <?php else: ?>
            <div class="d-flex justify-content-center py-5">
                <p><?php esc_html_e('No blog posts found', 'wp-vollcom-digital'); ?></p>
            </div>
        <?php endif; ?>

    <!--Page footer-->
    <div id="page-footer" class="has-hellgrau-background-color py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 mb-lg-4 text-center text-lg-left">
                    <h3 class="mb-5"><?php esc_html_e('Get our stories delivered from us to your inbox monthly', 'wp-vollcom-digital'); ?></h3>
                    <?php if( shortcode_exists('contact-form-7') ): ?>
                        <?php echo do_shortcode('[contact-form-7 id="312" title="Newsletter Form"]'); ?>
                    <?php endif; ?>
                </div>
                <div class="d-none d-lg-block col-lg-4 mb-lg-4">
                    <img class="img-fluid float-right" src="<?php echo get_template_directory_uri() . '/inc/assets/images/vollcom-digital-newsletter.png' ;?>" alt="Vollcom Digital Newsletter" />
                </div>
            </div>
        </div>
    </div>
    <!--/.Page footer-->

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
