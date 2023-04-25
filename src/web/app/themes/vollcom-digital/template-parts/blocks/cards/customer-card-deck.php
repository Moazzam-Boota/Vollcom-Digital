<?php
/**
 * Blog Paginated Carddeck Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'paginated-carddeck-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'paginated-carddeck';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/**
 * Load values and assign defaults
 * Loop through post objects (assuming this is a multi-select field) ( don't setup postdata )
 * Using this method, the $post object is never changed so all functions need a seccond parameter of the post ID in question.
*/
if( get_field('sort_by_date') === true ) {
    $post_ids = get_field('posts', false, false);
    $args = array(
        'post__in' => $post_ids,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $post_objects = get_posts( $args );
} else {
    $post_objects = get_field('posts');
}
?>
<?php if( $post_objects ): ?>
<!--Blog Posts Carddeck-->
<div class="row row-cols-1 row-cols-md-3">
    <?php foreach( $post_objects as $post_object): ?>
    <div class="col mb-4">
        <div class="card shadow-5 h-100">
            <!--Card image-->
            <?php echo get_the_post_thumbnail($post_object->ID, array(350, 250), array( 'class' => 'card-img-top' )); ?>
            <!--/.Card image-->
            <!--Card content-->
            <div class="card-body">
                <a class="text-black-50" href="<?php echo get_permalink($post_object->ID); ?>">
                    <h3 class="card-title font-weight-bold h4 text-dark-blue">
                        <?php echo get_the_title($post_object->ID); ?>
                    </h3>
                    <p class="card-text">
                        <?php echo get_the_excerpt($post_object->ID); ?>
                    </p>
                </a>
            </div>
            <!--/.Card content-->
            <hr class="mx-3 my-0">
            <!--Card footer-->
            <div class="card-footer bg-white border-0">
                <div class="d-flex justify-content-between">
                    <?php $categories = get_the_category($post_object->ID); ?>
                    <?php if ( ! empty( $categories ) ): ?>
                        <?php echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '"><small>' . esc_html( $categories[0]->name ) . '</small></a>'; ?>
                    <?php endif; ?>
                    <time class="text-black-50" datetime="<?php echo get_the_date('c', $post_object->ID); ?>" itemprop="datePublished"><small><?php echo get_the_date('', $post_object->ID); ?></small></time>
                </div>
            </div>
            <!--/.Card footer-->
        </div>
    </div>
    <?php endforeach; ?>
</div>
<!--/.Blog Posts Carddeck-->
<?php endif; ?>