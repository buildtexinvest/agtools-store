<?php
/** Featured products section. */
?>
<section class="section section--grey featured-products">
	<div class="container"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'Top picks', 'agtools' ); ?></p><h2><?php esc_html_e( 'Made to perform', 'agtools' ); ?></h2></div></div>
		<?php if ( shortcode_exists( 'products' ) ) : echo do_shortcode( '[products limit="4" columns="4" visibility="featured" orderby="date"]' ); else : ?><p><?php esc_html_e( 'Install WooCommerce to show featured products here.', 'agtools' ); ?></p><?php endif; ?>
	</div>
</section>
