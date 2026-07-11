<?php
/** Product categories. */

$categories = function_exists( 'get_terms' ) ? get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'number' => 4, 'parent' => 0 ) ) : array();
?>
<section id="categories" class="section categories">
	<div class="container"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'Find your kit', 'agtools' ); ?></p><h2><?php esc_html_e( 'Shop by category', 'agtools' ); ?></h2></div><a class="text-link" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'View all', 'agtools' ); ?> →</a></div>
		<div class="category-grid">
			<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : foreach ( $categories as $category ) : ?>
				<a class="category-card" href="<?php echo esc_url( get_term_link( $category ) ); ?>"><span class="category-card__mark">+</span><h3><?php echo esc_html( $category->name ); ?></h3><span><?php echo esc_html( sprintf( _n( '%s product', '%s products', $category->count, 'agtools' ), $category->count ) ); ?> →</span></a>
			<?php endforeach; else : ?>
				<?php foreach ( array( __( 'Power tools', 'agtools' ), __( 'Hand tools', 'agtools' ), __( 'Site equipment', 'agtools' ), __( 'Workwear & safety', 'agtools' ) ) as $index => $label ) : ?><a class="category-card" href="#"><span class="category-card__mark"><?php echo esc_html( $index + 1 ); ?></span><h3><?php echo esc_html( $label ); ?></h3><span><?php esc_html_e( 'Explore', 'agtools' ); ?> →</span></a><?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
