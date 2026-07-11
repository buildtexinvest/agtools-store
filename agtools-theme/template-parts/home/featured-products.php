<?php
/** Featured products section. */
?>
<section class="section section--grey featured-products">
	<div class="container"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'Top picks', 'agtools' ); ?></p><h2><?php esc_html_e( 'Made to perform', 'agtools' ); ?></h2></div></div>
		<?php if ( function_exists( 'wc_get_products' ) ) : $products = wc_get_products( array( 'limit' => 4, 'featured' => true, 'status' => 'publish' ) ); if ( $products ) : woocommerce_product_loop_start(); foreach ( $products as $post ) : $GLOBALS['post'] = get_post( $post->get_id() ); setup_postdata( $GLOBALS['post'] ); wc_get_template_part( 'content', 'product' ); endforeach; wp_reset_postdata(); woocommerce_product_loop_end(); else : ?><p><?php esc_html_e( 'Featured products are coming soon.', 'agtools' ); ?></p><?php endif; else : ?><p><?php esc_html_e( 'Install WooCommerce to show featured products here.', 'agtools' ); ?></p><?php endif; ?>
	</div>
</section>
