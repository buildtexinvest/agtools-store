<?php
/**
 * Premium WooCommerce product detail page enhancements.
 *
 * @package AGTools
 */

defined( 'ABSPATH' ) || exit;

function agtools_pdp_brand( $product_id ) {
	return function_exists( 'agtools_product_card_brand' ) ? agtools_product_card_brand( $product_id ) : '';
}

function agtools_pdp_reference() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$brand = agtools_pdp_brand( $product->get_id() );
	?>
	<div class="ag-pdp__reference">
		<?php if ( $brand ) : ?><span class="ag-pdp__brand"><?php echo esc_html( $brand ); ?></span><?php endif; ?>
		<?php if ( $product->get_sku() ) : ?><span><?php echo esc_html( sprintf( __( 'SKU: %s', 'agtools' ), $product->get_sku() ) ); ?></span><?php endif; ?>
		<span class="ag-pdp__stock <?php echo $product->is_in_stock() ? 'is-in-stock' : 'is-out-of-stock'; ?>"><?php echo esc_html( $product->is_in_stock() ? __( 'In stock', 'agtools' ) : __( 'Out of stock', 'agtools' ) ); ?></span>
	</div>
	<?php
}

function agtools_pdp_trust() {
	$benefits = array(
		__( 'Original products', 'agtools' ),
		__( 'Fast delivery in Finland', 'agtools' ),
		__( 'Professional support', 'agtools' ),
		__( 'Secure payments', 'agtools' ),
	);
	?>
	<ul class="ag-pdp__trust" aria-label="<?php esc_attr_e( 'Purchase benefits', 'agtools' ); ?>">
		<?php foreach ( $benefits as $benefit ) : ?><li><?php echo esc_html( $benefit ); ?></li><?php endforeach; ?>
	</ul>
	<?php
}

function agtools_pdp_share() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$url = rawurlencode( $product->get_permalink() );
	$title = rawurlencode( $product->get_name() );
	?>
	<div class="ag-pdp__sharing"><a href="#wishlist" aria-label="<?php echo esc_attr( sprintf( __( 'Add %s to wishlist', 'agtools' ), $product->get_name() ) ); ?>">♡ <?php esc_html_e( 'Wishlist', 'agtools' ); ?></a><a href="mailto:?subject=<?php echo esc_attr( $title ); ?>&body=<?php echo esc_attr( $url ); ?>"><?php esc_html_e( 'Share', 'agtools' ); ?> ↗</a></div>
	<?php
}

function agtools_pdp_tab_content( $key, $tab ) {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	if ( 'specifications' === $key ) {
		wc_display_product_attributes( $product );
		return;
	}

	if ( 'downloads' === $key ) {
		$downloads = $product->get_downloads();
		echo '<div class="ag-pdp__tab-content">';
		if ( $downloads ) {
			echo '<ul class="ag-pdp__downloads">';
			foreach ( $downloads as $download ) {
				echo '<li>' . esc_html( $download->get_name() ) . '</li>';
			}
			echo '</ul>';
		} else {
			echo '<p>' . esc_html__( 'Downloads are not available for this product.', 'agtools' ) . '</p>';
		}
		echo '</div>';
		return;
	}

	if ( 'shipping_returns' === $key ) {
		echo '<div class="ag-pdp__tab-content"><p>' . esc_html__( 'Fast delivery across Finland. Returns are accepted according to our store terms; contact our professional support team if you need help with your order.', 'agtools' ) . '</p></div>';
	}
}

function agtools_pdp_tabs( $tabs ) {
	if ( isset( $tabs['description'] ) ) {
		$tabs['description']['title'] = __( 'Description', 'agtools' );
	}

	if ( isset( $tabs['additional_information'] ) ) {
		$tabs['additional_information']['title'] = __( 'Specifications', 'agtools' );
	} else {
		$tabs['specifications'] = array( 'title' => __( 'Specifications', 'agtools' ), 'priority' => 20, 'callback' => 'agtools_pdp_tab_content' );
	}

	$tabs['downloads'] = array( 'title' => __( 'Downloads', 'agtools' ), 'priority' => 30, 'callback' => 'agtools_pdp_tab_content' );
	$tabs['shipping_returns'] = array( 'title' => __( 'Shipping & Returns', 'agtools' ), 'priority' => 40, 'callback' => 'agtools_pdp_tab_content' );

	if ( isset( $tabs['reviews'] ) ) {
		$tabs['reviews']['title'] = __( 'Reviews', 'agtools' );
	}

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'agtools_pdp_tabs', 98 );

function agtools_track_recently_viewed_product() {
	if ( ! is_singular( 'product' ) || ! function_exists( 'wc_setcookie' ) ) {
		return;
	}

	$product_id = get_the_ID();
	$viewed = isset( $_COOKIE['agtools_recently_viewed'] ) ? array_map( 'absint', explode( '|', wp_unslash( $_COOKIE['agtools_recently_viewed'] ) ) ) : array();
	$viewed = array_values( array_diff( $viewed, array( $product_id ) ) );
	array_unshift( $viewed, $product_id );
	$viewed = array_slice( $viewed, 0, 8 );

	wc_setcookie( 'agtools_recently_viewed', implode( '|', $viewed ), time() + MONTH_IN_SECONDS );
}
add_action( 'template_redirect', 'agtools_track_recently_viewed_product' );

function agtools_recently_viewed_products() {
	$current_product_id = get_queried_object_id();

	if ( ! $current_product_id || empty( $_COOKIE['agtools_recently_viewed'] ) || ! function_exists( 'wc_get_products' ) ) {
		return;
	}

	$ids = array_filter( array_map( 'absint', explode( '|', wp_unslash( $_COOKIE['agtools_recently_viewed'] ) ) ) );
	$ids = array_values( array_diff( $ids, array( $current_product_id ) ) );
	if ( ! $ids ) {
		return;
	}

	$products = wc_get_products( array( 'include' => $ids, 'limit' => 8, 'status' => 'publish', 'orderby' => 'include' ) );
	if ( ! $products ) {
		return;
	}
	?>
	<section class="ag-recently-viewed" aria-labelledby="ag-recently-viewed-title"><div class="container"><header class="ag-recently-viewed__header"><p><?php esc_html_e( 'Continue shopping', 'agtools' ); ?></p><h2 id="ag-recently-viewed-title"><?php esc_html_e( 'Recently viewed', 'agtools' ); ?></h2></header><?php woocommerce_product_loop_start(); foreach ( $products as $recent_product ) : $GLOBALS['post'] = get_post( $recent_product->get_id() ); setup_postdata( $GLOBALS['post'] ); wc_get_template_part( 'content', 'product' ); endforeach; wp_reset_postdata(); $GLOBALS['product'] = wc_get_product( $current_product_id ); woocommerce_product_loop_end(); ?></div></section>
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'agtools_recently_viewed_products', 25 );

function agtools_pdp_related_products_args( $args ) {
	$args['posts_per_page'] = 8;
	$args['columns'] = 4;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'agtools_pdp_related_products_args' );

function agtools_setup_product_page() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	add_action( 'woocommerce_single_product_summary', 'agtools_pdp_reference', 6 );
	add_action( 'woocommerce_single_product_summary', 'agtools_pdp_trust', 31 );
	add_action( 'woocommerce_single_product_summary', 'agtools_pdp_share', 40 );
}
add_action( 'wp', 'agtools_setup_product_page' );
