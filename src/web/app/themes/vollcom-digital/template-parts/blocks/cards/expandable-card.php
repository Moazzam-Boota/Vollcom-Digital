<?php
/**
 * Expandable Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'expandable-card-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'expandable-card';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$image= get_field('image');
$title = get_field('title');
$description = get_field('description');
$rows = get_field('repeater');
$card_link = get_field('card_link');
$id = uniqid('expandablecard_');
?>
<!--Expandable Card-->
<div class="card testimonial-card hoverable mb-4 h-100 z-depth-0">

    <?php if( !empty($image) ): ?>
        <!-- Card image -->
        <div class="view overlay">
            <img class="card-img-top" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!--/.Card image-->
    <?php endif; ?>

    <!--Card content-->
    <div class="card-body pb-0">
        <?php if ( !empty($title) ): ?>
	        <?php if( !empty($card_link) ) : ?>
                <a href="<?php echo esc_url( $card_link['url'] ); ?>">
            <?php endif; ?>
                <h3 class="card-title font-weight-bold h4 text-dark-blue"><?php echo esc_html($title); ?></h3>
            <?php if( !empty($card_link) ) : ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>
	    <?php if ( !empty($description) ): ?>
            <div class="text-left">
                <?php echo esc_html_e($description); ?>
            </div>
	    <?php endif; ?>
    </div>
    <?php if( $rows ): ?>
        <div class="collapse-content collapse-content pt-0 px-3 pb-3">
            <div class="collapse mb-4" id="<?php echo esc_attr($id); ?>">
                <ul class="list-unstyled text-left">
                    <?php foreach( $rows as $row ): ?>
                        <li>
                            <a href="<?php echo esc_url( $row['link']['url'] ); ?>" href="<?php echo esc_url( $row['link']['target'] ? $row['link']['target'] : '_self'); ?>">
                                <i class="fal fa-arrow-circle-right vd-dark-blue-text"></i>&nbsp;
                                <?php echo esc_html( $row['link']['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="d-flex justify-content-center position-relative">
                <div class="position-absolute t-n1">
                    <a class="" data-toggle="collapse" href="#<?php echo esc_attr($id); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>">
                        <span class="fa-stack fa-lg" style="vertical-align: top;">
                          <i class="fas fa-hexagon fa-stack-2x fa-rotate-90" style="color: #07a8c4"></i>
                          <i class="fas fa-angle-down fa-stack-1x fa-inverse rotate"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--/.Card content-->
</div>
<!--/.Expandable Card-->
