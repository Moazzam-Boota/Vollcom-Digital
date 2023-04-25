<?php
/**
 * Blog Post Carddeck Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blog-carddeck-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blog-carddeck';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/**
*  Loop through post objects (assuming this is a multi-select field) ( don't setup postdata )
*  Using this method, the $post object is never changed so all functions need a seccond parameter of the post ID in question.
*/
$args = array(
    'order' => 'ASC'
);
$sort_by_date = get_field('sort_by_date');
if($sort_by_date) {
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
}

$post_objects = get_field('posts'); // return false in case empty

if($post_objects) {
    $post_ids = get_field('posts', false, false); // return ""
    $args['post__in'] = $post_ids;
}else {
    $max_post_number = 10;
    if(!$max_post_number)
        $max_post_number = 10;
    $args['posts_per_page'] = $max_post_number;
}
$args['suppress_filters'] = 0;

$post_objects = get_posts( $args );
?>
<?php if( $post_objects ): ?>
<!--Blog Posts Carddeck-->
<div id="<?php echo esc_attr($id); ?>" class="row row-cols-1 row-cols-md-2">
    <?php foreach( $post_objects as $post_object): ?>
    <div class="col mb-4">
        <div class="card h-100 border wow bg-transparent" data-wow-delay="0.6s">
            <div class="block-card">

                <?php if( !empty(get_permalink($post_object->ID) )): ?>
                    <a href="<?php echo esc_url(get_permalink($post_object->ID)); ?>">
                <?php endif; ?>

                    <?php if( has_post_thumbnail($post_object->ID) ): ?>
                        <!--Card image-->
                        <?php echo wp_kses_post(get_the_post_thumbnail($post_object->ID, '', array( 'class' => 'card-img' ))); ?>
                        <div class="card-img-overlay"></div>
                        <!--/.Card image-->
                    <?php endif; ?>

                <?php if( !empty(get_permalink($post_object->ID) )): ?>
                    </a>
                <?php endif; ?>

                <!--Card footer-->
                <div class="card-footer">
                    <?php $categories = get_the_category($post_object->ID); ?>

                    <?php if ( ! empty( $categories ) ): ?>
                        <?php echo '<div class="mb-1"><a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>'; ?>
                    <?php endif; ?>

	                <?php if( !empty(get_permalink($post_object->ID) )): ?>
                        <a href="<?php echo esc_url(get_permalink($post_object->ID)); ?>">
                    <?php endif; ?>
                        <h3 class="card-title font-weight-bold h4 text-dark-blue"><?php echo esc_html(get_the_title($post_object->ID)); ?></h3>
                        <p class="card-text black-text"><?php echo esc_html(get_the_excerpt($post_object->ID)); ?></p>
                        <time class="has-petrol-color" datetime="<?php echo get_the_date('c', $post_object->ID); ?>" itemprop="datePublished"><?php echo get_the_date('M j, Y', $post_object->ID); ?></time>
                    <?php if( !empty(get_permalink($post_object->ID) )): ?>
                        </a>
                    <?php endif; ?>
                </div>
                <!--/.Card footer-->

            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<!--/.Blog Posts Carddeck-->
<?php endif; ?>