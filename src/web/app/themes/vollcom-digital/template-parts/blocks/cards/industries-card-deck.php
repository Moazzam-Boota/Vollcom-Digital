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
$id = 'industries-card-deck-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'industries-card-deck';
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
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var('paged');
}
else if ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
}
else {
    $paged = 1;
}
$per_page = 6;
$hide_empty = '1';
$custom_taxonomy = 'branchen';
$number_of_series = count( get_terms( $custom_taxonomy, array( 'hide_empty' => $hide_empty ) ) );
$offset = $per_page * ( $paged - 1) ;
$args = array(
    'offset' => $offset,
    'number' => $per_page,
    'hide_empty' => $hide_empty
);
$custom_terms = get_terms( $custom_taxonomy, $args );

?>
<!--Industries Card Deck-->
<div class="row mb-3">
    <?php foreach($custom_terms as $custom_term) : ?>

        <?php $custom_term_image = get_field('image',$custom_term->taxonomy . '_' . $custom_term->term_id); ?>
        <!--Column-->
        <div class="col-md-4 mb-4 pagination-item">
            <!--Card-->
            <div class="card h-100">
                <a href="<?php echo esc_url(get_term_link($custom_term)); ?>">
                    <?php if( !empty( $custom_term_image ) ): ?>
                        <!--Card image-->
                        <img class="card-img-top" src="<?php echo esc_url($custom_term_image['url']); ?>" alt="<?php echo esc_attr($custom_term_image['alt']); ?>" />
                        <!--/.Card image-->
                    <?php endif; ?>
                    <!--Card content-->
                    <div class="card-body">
                        <?php if( !empty( $custom_term->name ) ) : ?>
                            <h3 class="card-title font-weight-bold h4 text-dark-blue">
                                <?php echo esc_html( $custom_term->name ); ?>
                            </h3>
                        <?php endif ;?>

                        <?php if( !empty( $custom_term->description ) ) : ?>
                            <p class="card-text">
                                <?php echo esc_html( $custom_term->description ); ?>
                            </p>
                        <?php endif ;?>
                    </div>
                    <!--/.Card content-->
                </a>
            </div>
            <!--/.Card-->
        </div>
        <!--/.Column-->

    <?php endforeach; ?>
</div>
<!--/.Industries Card Deck-->
<!--Pagination-->
<?php
    // need an unlikely integer
    $big = 999999;

    echo paginate_links( array(
        'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'  => '?paged=%#%',
        'current' => $paged,
        'type' => 'list',
        'prev_text' => __('zurück', 'wp-vollcom-digital'),
        'next_text' => __('weiter', 'wp-vollcom-digital'),
        'total'   => ceil( $number_of_series / $per_page ),
        )
    );
?>
<!--/.Pagination-->