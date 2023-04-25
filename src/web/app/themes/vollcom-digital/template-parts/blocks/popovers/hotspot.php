<?php
/**
 * Blog Hotspot Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hotspot-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hotspot';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<!--Hotspot-->
<div class="hotspot position-relative h-600">
    <?php if( have_rows('services_rows') ): ?>
        <?php while( have_rows('services_rows') ): the_row(); ?>
            <?php
            $page_link = get_sub_field('page_link');
            $teaser_card = get_sub_field('teaser_card');
            $position_left = get_sub_field('position_left');
            $position_top = get_sub_field('position_top');
            ?>
            <?php if( $page_link && $teaser_card): ?>
                <?php
                $link_url = $page_link['url'];
                $link_title = $page_link['title'];
                $link_target = $page_link['target'] ? $page_link['target'] : '_self';
                $teaser_card_content = $teaser_card . '<br /><a class="mt-3" href="'. $link_url . '" target="' . $link_target . '">Mehr erfahren</a>';
                ?>
                <div class="mb-3 outline-0 position-absolute" data-toggle="popover" title="<?php echo esc_html( $link_title ) ;?>" data-content="<?php echo esc_html( $teaser_card_content ); ?>" data-trigger="focus" style="left: <?php echo esc_attr( $position_left ) ;?>%; top: <?php echo esc_attr( $position_top ) ;?>%">
                    <a tabindex="0" role="button" class="d-flex flex-column outline-0">
                        <span class="text-white mx-auto font-weight-bold"><?php echo esc_html( $link_title ) ;?></span>
                        <div class="blob white mx-auto"></div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
<!--/.Hotspot-->