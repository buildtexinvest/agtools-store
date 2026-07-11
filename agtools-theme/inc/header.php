<?php
/**
 * Storefront header helpers and product search endpoint.
 *
 * @package AGTools
 */

defined( 'ABSPATH' ) || exit;

function agtools_primary_nav_fallback() {
	$items = array(
		__( 'Home', 'agtools' )    => home_url( '/' ),
		__( 'Shop', 'agtools' )    => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ),
		__( 'Brands', 'agtools' )  => home_url( '/brands/' ),
		__( 'New', 'agtools' )     => home_url( '/new/' ),
		__( 'Sale', 'agtools' )    => home_url( '/sale/' ),
		__( 'Blog', 'agtools' )    => home_url( '/blog/' ),
		__( 'Contact', 'agtools' ) => home_url( '/contact/' ),
	);

	echo '<ul class="ag-header__nav-list">';
	foreach ( $items as $label => $url ) {
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

function agtools_search_products() {
	check_ajax_referer( 'agtools-search', 'nonce' );

	if ( ! function_exists( 'wc_get_products' ) ) {
		wp_send_json_success( array( 'html' => '' ) );
	}

	$term = sanitize_text_field( wp_unslash( $_POST['term'] ?? '' ) );
	if ( strlen( $term ) < 2 ) {
		wp_send_json_success( array( 'html' => '' ) );
	}

	$products = wc_get_products(
		array(
			'limit'  => 6,
			'status' => 'publish',
			's'      => $term,
		)
	);

	ob_start();
	if ( $products ) {
		foreach ( $products as $product ) {
			$categories = wc_get_product_term_ids( $product->get_id(), 'product_cat' );
			$category   = $categories ? get_term( $categories[0], 'product_cat' ) : null;
			?>
			<a class="ag-search__result" href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<span class="ag-search__image"><?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?></span>
				<span class="ag-search__details"><b><?php echo esc_html( $product->get_name() ); ?></b><small><?php echo esc_html( $category && ! is_wp_error( $category ) ? $category->name : __( 'Product', 'agtools' ) ); ?></small></span>
				<span class="ag-search__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
			</a>
			<?php
		}
	} else {
		echo '<p class="ag-search__empty">' . esc_html__( 'No products found.', 'agtools' ) . '</p>';
	}

	wp_send_json_success( array( 'html' => ob_get_clean() ) );
}
add_action( 'wp_ajax_agtools_search_products', 'agtools_search_products' );
add_action( 'wp_ajax_nopriv_agtools_search_products', 'agtools_search_products' );
