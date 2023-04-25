<?php
/**
 * Custom Logos Carousel Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'customer-logos-carousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'customer-logos-carousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults
$post_objects = get_field('customers');
$number = floor((12 / count($post_objects)));
?>
<!--Customer Logo Carousel-->
<?php if( isset($post_objects) ): ?>
<div id="customer-carousel-multi" class="carousel slide carousel-multi-item v-2 customer-post mb-0">

    <!--Items-->
    <div class="carousel-inner v-2" role="listbox">
        <?php foreach( $post_objects as $index => $post_object): ?>
            <?php if ( $index === 0) : ?>
                <div class="carousel-item active">
            <?php endif; ?>
            <?php if ( $index > 0 ) : ?>
                <div class="carousel-item">
            <?php endif; ?>
                <div class="col-12 d-flex col-md-4 col-lg-<?php echo esc_attr($number); ?>">
                    <div class="card mb-2 z-depth-0 mx-auto">
                        <?php echo wp_kses_post(get_the_post_thumbnail($post_object->ID, array(350, 250), array( 'class' => 'img-fluid' ))); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!--/.Items-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#customer-carousel-multi" role="button" data-slide="prev" style="width: 0;">
        <span class="carousel-control-prev-icon mr-4" aria-hidden="true" style="color:black;">
            <i class="fas fa-chevron-left text-dark-blue"></i>
        </span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#customer-carousel-multi" role="button" data-slide="next" style="width: 0;">
        <span class="carousel-control-next-icon ml-4" aria-hidden="true" style="color:black;">
            <i class="fas fa-chevron-right text-dark-blue"></i>
        </span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<?php else : ?>
    <p class=""><?php echo esc_html_e('No partner found', 'wp-vollcom-digital'); ?></p>
<?php endif; ?>
<!--/.Multi Item Carousel Advance-->
