<?php
/** Product categories. */

$categories = array(
	array( 'diamond-blades', __( 'Diamond blades', 'agtools' ), '◉' ),
	array( 'drill-bits', __( 'Drill bits', 'agtools' ), '✣' ),
	array( 'tile-cutters', __( 'Tile cutters', 'agtools' ), '▤' ),
	array( 'grinding', __( 'Grinding', 'agtools' ), '◌' ),
	array( 'hand-tools', __( 'Hand tools', 'agtools' ), '⌐' ),
	array( 'accessories', __( 'Accessories', 'agtools' ), '✦' ),
);
?>
<section id="categories" class="section categories">
	<div class="container"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'Find your kit', 'agtools' ); ?></p><h2><?php esc_html_e( 'Shop by category', 'agtools' ); ?></h2></div><a class="text-link" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'View all', 'agtools' ); ?> →</a></div>
		<div class="category-grid category-grid--six">
			<?php foreach ( $categories as $category ) : $term = get_term_by( 'slug', $category[0], 'product_cat' ); $url = $term ? get_term_link( $term ) : ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>
				<a class="category-card" href="<?php echo esc_url( $url ); ?>"><span class="category-card__mark" aria-hidden="true"><?php echo esc_html( $category[2] ); ?></span><h3><?php echo esc_html( $category[1] ); ?></h3><span><?php esc_html_e( 'Shop category', 'agtools' ); ?> <b>→</b></span></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
