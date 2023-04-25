<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wp_vollcomdigital_Starter
 */

get_header(); ?>
<?php
$post_type_query = 'all';
if(isset($post_type)){
    if(is_array($post_type)){
        $post_type_query = reset($post_type);
    }else {
        $post_type_query = $post_type;
    }
}
$search_term = isset($s) ? $s : '';
global $wp_query;
$found_posts = isset($wp_query->found_posts) ? $wp_query->found_posts : 0;

?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="container pt-5">
                <div class="search-result-container">
                    <div class="search-page-wrapper">
                        <form action="<?php echo home_url('/'); ?>" method="get" id="searchform">
                            <span class="overlay-search-icon"><i class="far fa-search"></i></span>
                            <input type="search" placeholder="<?php esc_html_e('What Are you Looking for?', 'wp-vollcom-digital'); ?>" name="s" value="<?= $search_term ?>">
                            <select id="search_select" class="search-type" name="post_type">
                                <option value="any" <?php if($post_type_query == 'all') echo 'selected' ?>><?php esc_html_e('Website', 'wp-vollcom-digital'); ?></option>
                                <option value="post" <?php if($post_type_query == 'post') echo 'selected' ?>><?php esc_html_e('Blogs', 'wp-vollcom-digital'); ?></option>
                                <option value="page" <?php if($post_type_query == 'page') echo 'selected' ?>><?php esc_html_e('Pages', 'wp-vollcom-digital'); ?></option>
                                <option value="jobs" <?php if($post_type_query == 'jobs') echo 'selected' ?>><?php esc_html_e('Jobs', 'wp-vollcom-digital'); ?></option>
                            </select>
                        </form>
                    </div>
                    <div class="mb-2">
                        <h6 class="md-d-inline-block"><?php esc_html_e('Search Result for', 'wp-vollcom-digital'); ?> "<?= $search_term ?>"</h6>
                        <span class="md-float-right font-weight-500"><?= $found_posts ?> <?php esc_html_e('Found', 'wp-vollcom-digital'); ?></span>
                    </div>
                    <?php if ( have_posts() ) :
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'template-parts/content', 'search' );

                        endwhile;

                    else :
                    ?>
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp-vollcom-digital' ); ?></p>

                    <?php
                    endif; ?>
                </div>
                <?php
                    if (function_exists("pagination_nav")) {
                        pagination_nav();
                    }
                ?>
            </div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
