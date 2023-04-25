<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp_vollcomdigital_Starter
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section class="error-404 not-found py-5">
            <div class="container">

                <!--Page header-->
                <header class="page-header d-flex mb-5">
                    <div class="mx-auto d-flex align-items-center">
                        <h2 class="display-1"><?php esc_html_e( '4', 'wp-vollcom-digital' ); ?></h2>
                        <img class="mx-3" src="<?php echo esc_url(get_template_directory_uri().'/inc/assets/images/404-cube.svg') ;?>" alt="Vollcom Digital" width="103" height="120" />
                        <h2 class="display-1"><?php esc_html_e( '4', 'wp-vollcom-digital' ); ?></h2>
                    </div>
                </header>
                <!--/.Page header-->

                <!--Page content-->
                <div class="page-content text-center">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can’t be found', 'wp-vollcom-digital' ); ?></h1>
                    <p class="mb-5"><?php esc_html_e( 'Sorry, we couldn’t find the page you were looking for. We suggest that you return to main sections.', 'wp-vollcom-digital' ); ?></p>
                    <a class="btn mb-5 has-hellblau-background-color text-white" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e( 'Go to the main page', 'wp-vollcom-digital' ); ?></a>
                </div>
                <!--/.Page content-->

            </div>
        </section><!-- .error-404 -->

    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
