<?php
/**
 * Premium WooCommerce loop product cards.
 *
 * @package AGTools
 */

defined( 'ABSPATH' ) || exit;

function agtools_product_card_brand( $product_id ) {
	$taxonomies = array( 'product_brand', 'pwb-brand', 'yith_product_brand', 'pa_brand', 'brand' );

	foreach ( $taxonomies as $taxonomy ) {
		if ( taxonomy_exists( $taxonomy ) ) {
			$terms = get_the_terms( $product_id, $taxonomy );
			if ( $terms && ! is_wp_error( $terms ) ) {
				return $terms[0]->name;
			}
		}
	}

	return '';
}

function agtools_product_card_badges( $product ) {
	$badges = array();
	$created = get_post_timestamp( $product->get_id() );
	$threshold = (int) apply_filters( 'agtools_product_card_best_seller_threshold', 20 );

	if ( $product->is_on_sale() ) {
		$badges[] = __( 'Sale', 'agtools' );
	}

	if ( $created && ( current_time( 'timestamp' ) - $created ) <= MONTH_IN_SECONDS ) {
		$badges[] = __( 'New', 'agtools' );
	}

	if ( $threshold > 0 && (int) $product->get_total_sales() >= $threshold ) {
		$badges[] = __( 'Best Seller', 'agtools' );
	}

	return $badges;
}

function agtools_render_product_card_media() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$image_id = $product->get_image_id();
	$image = $image_id ? wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy', 'decoding' => 'async', 'alt' => $product->get_name() ) ) : wc_placeholder_img( 'woocommerce_thumbnail' );
	$badges = agtools_product_card_badges( $product );
	?>
	<div class="ag-product-card__media">
		<?php if ( $badges ) : ?><span class="ag-product-card__badges"><?php foreach ( $badges as $badge ) : ?><span class="ag-product-card__badge"><?php echo esc_html( $badge ); ?></span><?php endforeach; ?></span><?php endif; ?>
		<?php echo wp_kses_post( $image ); ?>
	</div>
	<?php
}

function agtools_render_product_card_content() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$brand = agtools_product_card_brand( $product->get_id() );
	$rating_count = $product->get_rating_count();
	$in_stock = $product->is_in_stock();
	?>
	<div class="ag-product-card__content">
		<?php if ( $brand ) : ?><span class="ag-product-card__brand"><?php echo esc_html( $brand ); ?></span><?php endif; ?>
		<h2 class="ag-product-card__title"><?php echo esc_html( $product->get_name() ); ?></h2>
		<?php if ( $rating_count ) : ?><span class="ag-product-card__rating"><?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $rating_count ) ); ?><span class="ag-product-card__review-count"><?php echo esc_html( sprintf( _n( '%s review', '%s reviews', $rating_count, 'agtools' ), $rating_count ) ); ?></span></span><?php endif; ?>
		<span class="ag-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
		<span class="ag-product-card__stock <?php echo $in_stock ? 'is-in-stock' : 'is-out-of-stock'; ?>"><?php echo esc_html( $in_stock ? __( 'In stock', 'agtools' ) : __( 'Out of stock', 'agtools' ) ); ?></span>
	</div>
	<?php
}

function agtools_render_product_card_actions() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$image_id = $product->get_image_id();
	$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : wc_placeholder_img_src( 'woocommerce_thumbnail' );
	?>
	<div class="ag-product-card__actions">
		<?php woocommerce_template_loop_add_to_cart(); ?>
		<a class="ag-product-card__wishlist" href="<?php echo esc_url( apply_filters( 'agtools_product_card_wishlist_url', '#wishlist', $product ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Add %s to wishlist', 'agtools' ), $product->get_name() ) ); ?>">♡</a>
		<button class="ag-product-card__quick-view" type="button" data-ag-quick-view data-product-title="<?php echo esc_attr( $product->get_name() ); ?>" data-product-image="<?php echo esc_url( $image_url ); ?>" data-product-price="<?php echo esc_attr( wp_strip_all_tags( $product->get_price_html() ) ); ?>" data-product-url="<?php echo esc_url( $product->get_permalink() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Quick view %s', 'agtools' ), $product->get_name() ) ); ?>">⌕</button>
	</div>
	<?php
}

function agtools_setup_product_cards() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

	add_action( 'woocommerce_before_shop_loop_item_title', 'agtools_render_product_card_media', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'agtools_render_product_card_content', 10 );
	add_action( 'woocommerce_after_shop_loop_item', 'agtools_render_product_card_actions', 10 );
}
add_action( 'wp', 'agtools_setup_product_cards' );

function agtools_product_quick_view_dialog() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	?>
	<dialog class="ag-quick-view" data-ag-quick-view-dialog aria-labelledby="ag-quick-view-title">
		<button class="ag-quick-view__close" type="button" data-ag-quick-view-close aria-label="<?php esc_attr_e( 'Close quick view', 'agtools' ); ?>">×</button>
		<img class="ag-quick-view__image" src="" alt="">
		<div class="ag-quick-view__content"><p class="ag-quick-view__eyebrow"><?php esc_html_e( 'Quick view', 'agtools' ); ?></p><h2 id="ag-quick-view-title"></h2><p class="ag-quick-view__price"></p><a class="ag-quick-view__link" href=""><?php esc_html_e( 'View product', 'agtools' ); ?> →</a></div>
	</dialog>
	<?php
}
add_action( 'wp_footer', 'agtools_product_quick_view_dialog' );
