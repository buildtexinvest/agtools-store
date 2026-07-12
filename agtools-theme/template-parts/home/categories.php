<?php
/**
 * Premium WooCommerce category cards.
 *
 * @package AGTools
 */

$categories = array(
	array( 'diamond-blades', __( 'Diamond Blades', 'agtools' ), 'category-diamond-blades.webp' ),
	array( 'drill-bits', __( 'Diamond Drill Bits', 'agtools' ), 'category-drill-bits.webp' ),
	array( 'tile-cutters', __( 'Tile Cutters', 'agtools' ), 'category-tile-cutters.webp' ),
	array( 'grinding', __( 'Grinding', 'agtools' ), 'category-grinding.webp' ),
	array( 'hand-tools', __( 'Hand Tools', 'agtools' ), 'category-hand-tools.webp' ),
	array( 'accessories', __( 'Accessories', 'agtools' ), 'category-accessories.webp' ),
);

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
<section id="categories" class="ag-categories" aria-labelledby="ag-categories-title">
	<div class="container">
		<header class="ag-categories__header">
			<div><p class="ag-categories__eyebrow"><?php esc_html_e( 'Professional range', 'agtools' ); ?></p><h2 id="ag-categories-title"><?php esc_html_e( 'Shop by category', 'agtools' ); ?></h2></div>
			<a class="ag-categories__all" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'View all products', 'agtools' ); ?><span aria-hidden="true">→</span></a>
		</header>
		<div class="ag-categories__grid">
			<?php foreach ( $categories as $category ) :
				$term    = taxonomy_exists( 'product_cat' ) ? get_term_by( 'slug', $category[0], 'product_cat' ) : false;
				$url     = $term && ! is_wp_error( $term ) ? get_term_link( $term ) : $shop_url;
				$count   = $term && ! is_wp_error( $term ) ? (int) $term->count : 0;
				$counter = sprintf( _n( '%s product', '%s products', $count, 'agtools' ), number_format_i18n( $count ) );
				?>
				<article class="ag-category-card">
					<a class="ag-category-card__link" href="<?php echo esc_url( $url ); ?>">
						<img class="ag-category-card__image" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $category[2] ); ?>" alt="" loading="lazy" decoding="async">
						<span class="ag-category-card__overlay" aria-hidden="true"></span>
						<span class="ag-category-card__content"><span class="ag-category-card__counter"><?php echo esc_html( $counter ); ?></span><span class="ag-category-card__title"><?php echo esc_html( $category[1] ); ?></span><span class="ag-category-card__cta"><?php esc_html_e( 'Shop category', 'agtools' ); ?><b aria-hidden="true">→</b></span></span>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
