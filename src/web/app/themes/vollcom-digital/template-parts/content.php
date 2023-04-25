<?php
/**
 * Template part for displaying a post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_vollcomdigital_Starter
 */
/**
 * Load values and assign defaults
 */
$author_id = get_the_author_meta('ID');
$avatar_image = get_field('avatar', 'user_'. $author_id);
wp_enqueue_script( 'wp-vollcom-digital-posts-js', get_template_directory_uri() . '/inc/assets/js/posts.min.js', array('jquery'), '', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$enable_vc = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true);
	if(!$enable_vc ) {
		?>
        <header class="entry-header mb-5">
            <div class="view h-400 curved" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url()); ?>); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                <div class="mask d-flex flex-center has-braun-background-gradient-color">

                    <div class="container text-md-center">
                        <!--Categories-->
                        <?php $categories = get_the_category(); ?>
                        <?php if ( ! empty( $categories ) ): ?>
                            <?php echo '<div class="mb-2 h6"><a class="text-white" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>'; ?>
                        <?php endif; ?>
                        <!--/.Categories-->

	                    <?php the_title( '<h1 class="entry-title text-white animated fadeInUp mb-3">', '</h1>' ); ?>

                        <!--Post meta-->
                        <p class="text-white mb-3">
                            <u><?php esc_html( the_author() ); ?></u>
                            &#8212;
                            <time class="text-white" datetime="<?php echo esc_attr( get_the_date('c') ); ?>" itemprop="datePublished"><?php echo esc_attr( get_the_date('M j, Y') ); ?></time>
                        </p>
                        <p class="text-white"><?php echo do_shortcode('[rt_reading_time postfix="mins read" postfix_singular="min read"]'); ?></p>
                        <!--/.Post meta-->

                    </div>
                </div>
            </div>
        </header><!-- .entry-header -->
	<?php } ?>

    <div class="container">
        <div class="row">

            <?php if ( shortcode_exists('lwptoc') ): ?>
            <!--Post navigation-->
            <div id="post-navigation" class="col-lg-2 d-none d-lg-block">
                <div id="toc" class="mb-4 mb-lg-0 d-none d-lg-block">
                    <?php echo do_shortcode('[lwptoc]'); ?>
                </div>
            </div>
            <!--Post navigation-->
            <?php endif; ?>

            <!--Post content-->
            <div class="col-lg-8">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-vollcom-digital' ),
                    'after'  => '</div>',
                ) );
                ?>

                <!--Post meta-->
                <div class="d-block d-lg-none my-5">

                    <?php if ( shortcode_exists('shariff') ): ?>
                    <hr>
                    <!--Social Sharing-->
                    <div id="social-sharing" class="my-3 mb-lg-0 d-block d-lg-none">
                        <h6><?php esc_html_e('Share this article', 'wp-vollcom-digital'); ?></h6>
                        <?php echo do_shortcode('[shariff]'); ?>
                    </div>
                    <!--/.Social Sharing-->
                    <hr class="mb-4">
                    <?php endif; ?>


                    <div class="row">

                        <?php if ( !empty($avatar_image) ): ?>
                        <div class="col-md-4 mb-4">
                            <img class="lazy" src="<?php echo esc_url($avatar_image['url']); ?>" alt="<?php echo esc_attr($avatar_image['alt']); ?>" width="48" height="48" />
                        </div>
                        <?php endif; ?>
                        <div class="<?php ( !empty($avatar_image) ) ? 'col-md-8 ' : ' ' ;?>col-12 mb-4">
                            <p class="mb-3"><?php esc_html_e('Article by:', 'wp-vollcom-digital'); ?></p>

                            <h5 class="mb-3"><?php esc_html( the_author() ); ?></h5>

	                        <?php if ( !empty( get_the_author_meta('description')) ): ?>
                                <p class="mb-3"><small><?php esc_html_e( get_the_author_meta('description'), 'wp-vollcom-digital'); ?></small></p>
	                        <?php endif; ?>
                        </div>
                    </div>

                </div>
                <!--Post meta-->

	            <?php if ( get_edit_post_link() && !$enable_vc ) : ?>
                    <footer class="entry-footer container mb-5">
			            <?php
			            edit_post_link(
				            sprintf(
				            /* translators: %s: Name of current post */
					            esc_html__( 'Edit %s', 'wp-vollcom-digital' ),
//					            the_title( '<span class="screen-reader-text">"', '"</span>', false )
				            ),
				            '<span class="edit-link">',
				            '</span>'
			            );
			            ?>
                    </footer><!-- .entry-footer -->
	            <?php endif; ?>

            </div>
            <!--Post content-->

            <!--Sidebar-->
            <div id="post-sidebar" class="col-lg-2 d-none d-lg-block">
                <div class="meta-widget">
                    <!--Author meta-->
                    <div class="mb-3">
                        <?php if ( !empty($avatar_image) ): ?>
                                <img class="lazy rounded mb-3" src="<?php echo esc_url($avatar_image['url']); ?>" alt="<?php echo esc_attr($avatar_image['alt']); ?>" width="48" height="48" />
                        <?php endif; ?>

                        <h6><?php esc_html( the_author() ); ?></h6>

                        <?php if ( !empty(get_the_author_meta('description')) ): ?>
                            <p><small><?php esc_html_e( get_the_author_meta('description'), 'wp-vollcom-digital'); ?></small></p>
                        <?php endif; ?>
                    </div>
                    <!--/.Author meta-->

                    <?php if ( shortcode_exists('shariff') ): ?>
                    <hr>
                    <!--Social Sharing-->
                    <div id="social-sharing" class="mb-4 mb-lg-0 d-none d-lg-block">
                        <h6><?php esc_html_e('Share this article', 'wp-vollcom-digital'); ?></h6>
                        <?php echo do_shortcode('[shariff]'); ?>
                    </div>
                    <!--/.Social Sharing-->
                    <?php endif; ?>

                </div>
            </div>
            <!--Sidebar-->

        </div>
    </div>
</article><!-- #post-## -->
<?php
$post_id = $post->ID;
$terms = wp_get_post_tags($post_id);
$tag_ids = [];
foreach( $terms as $term ) {
    $tag_ids[] = $term->term_id;
}
$related_posts_by_tags = $related_posts_by_category = [];
if(!empty($tag_ids)){
    $args = array(
        'posts_per_page' 	=> 3,
        'tag__in' => $tag_ids,
        'post_type' 		=> 'post',
        'exclude' => array($post_id),
        'suppress_filters' => 0
    );
    $related_posts_by_tags = get_posts($args);
}

if (count($related_posts_by_tags) < 3) {
    $remaining_post_count = 3 - count($related_posts_by_tags);
    $posts_by_tags_ids = [];
    foreach ($related_posts_by_tags as $post_by_tag){
        $posts_by_tags_ids[] = $post_by_tag->ID;
    }
    if(!array_key_exists($post_id, $posts_by_tags_ids)){
        $posts_by_tags_ids[] = $post_id;
    }
    $category_ids = wp_get_post_categories($post_id);
    if ( !empty( $category_ids ) ) {
        $query = array(
            'category__in'        => $category_ids,
            'posts_per_page'      => $remaining_post_count,
            'ignore_sticky_posts' => 1,
            'suppress_filters'  => 0
        );
        if(!empty($posts_by_tags_ids)){
            $query['post__not_in'] = $posts_by_tags_ids;
        }
        $related_posts_by_category = get_posts($query);
    }
}
if (!empty($related_posts_by_tags) || !empty($related_posts_by_category)): ?>
<!--Related posts-->
<section id="related_articles" class="pt-5">
    <div class="container">
        <h2 class="h2-responsive text-center mb-5"><?php esc_html_e('Similar Articles', 'wp-vollcom-digital'); ?></h2>
        <div class="row justify-content-center">
                <div class="container">
                    <!--Related articles-->
                    <div id="card-grids" class="mb-5">
                        <div class="row row-cols-1 row-cols-md-3 g-4 posts-list">
                            <?php foreach($related_posts_by_tags as $post): ?>
                                <?php get_template_part( 'template-parts/blocks/cards/related-articles', 'card' ); ?>
                            <?php endforeach; ?>
                            <?php foreach( $related_posts_by_category as $post) :?>
                                <?php get_template_part( 'template-parts/blocks/cards/related-articles', 'card' ); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!--/.Related articles-->
                </div>
        </div>
    </div>
</section>
<!--/.Related posts-->
<?php wp_reset_postdata(); ?>
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

