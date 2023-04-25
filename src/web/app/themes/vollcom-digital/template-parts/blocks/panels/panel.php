<?php
/**
 * Expandable Panel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'panel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = ' panel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

/**
 * Load values and assign defaults.
 */

$body_title = get_field('body_title');
$body_text = get_field('body_text');
$body_link = get_field('body_link');

?>
<!--Panel-->
<div id="<?php echo esc_attr($id); ?>" class="bg-services mb-4 <?php echo esc_attr($className); ?>">
    <?php if (!empty($body_title) || !empty($body_text) || !empty($body_link) ): ?>
    <!--Card Body-->
    <div class="card-body media p-5">
        <div>
            <?php if ( !empty($body_title) ): ?>
                <!--Card title-->
                <h3 class="card-title"><?php echo wp_kses_post($body_title); ?></h3>
                <!--/.Card title-->
            <?php endif; ?>
            <?php if ( !empty($body_text) ): ?>
                <!--Card text-->
                <div class="card-text">
                    <?php echo wp_kses_post($body_text); ?>
                </div>
                <!--/.Card text-->
            <?php endif; ?>
            <?php if( $body_link ): ?>
            <!--Card links-->
                <a class="card-link float-right service-link" href="<?php echo esc_url( $body_link ); ?>" role="button"><i class="far fa-long-arrow-right font-weight-bold"></i></a>
            <!--/.Card links-->
            <?php endif; ?>
        </div>
    </div>
    <!--/.Card Body-->
    <?php endif; ?>
</div>
<!--/.Panel-->
