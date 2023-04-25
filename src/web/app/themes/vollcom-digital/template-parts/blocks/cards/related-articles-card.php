<?php
/**
 * Related Posts Teaser Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

/**
 * Load values and assign defaults
 */
$categories = get_the_category();
?>
<div id="blog-teaser-card-<?= the_ID(); ?>" class="col mb-4 blog-teaser-card">
	<article id="post-<?= the_ID(); ?>" <?php post_class(); ?>>
		<div class="card h-100 border wow bg-transparent" data-wow-delay="0.6s">
			<div class="block-card">

				<?php if( !empty(get_permalink() )): ?>
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php endif; ?>

					<?php if( has_post_thumbnail() ): ?>
						<!--Card image-->
						<?php echo wp_kses_post(get_the_post_thumbnail('', 'full', array( 'class' => 'card-img' ))); ?>
						<div class="card-img-overlay"></div>
						<!--/.Card image-->
					<?php endif; ?>

					<?php if( !empty(get_permalink() )): ?>
				</a>
			<?php endif; ?>

				<!--Card footer-->
				<div class="card-footer">
                    <?php if (!empty( $categories ) ): ?>
                        <?php echo '<div class="mb-1"><a href="' . esc_url( get_category_link($categories[0]->term_id) ) . '">' . esc_html( $categories[0]->name ) . '</a></div>'; ?>
                    <?php endif; ?>
                    <?php if( !empty(get_permalink())): ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php endif; ?>
                        <h3 class="card-title font-weight-bold h4 text-dark-blue pt-2"><?php esc_html_e(get_the_title(), 'wp-vollcom-digital'); ?></h3>
                        <time class="has-petrol-color" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('M j, Y'); ?></time>
                        <?php if( !empty(get_permalink() )): ?>
                    </a>
				<?php endif; ?>
				</div>
				<!--/.Card footer-->

			</div>
		</div>
	</article><!-- #post-## -->
</div>