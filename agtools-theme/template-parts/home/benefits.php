<?php
/** Benefits section. */

$benefits = array(
	array( '01', __( 'Fast delivery', 'agtools' ), __( 'Order today, get to work sooner with reliable delivery.', 'agtools' ) ),
	array( '02', __( 'Original products', 'agtools' ), __( 'Genuine products from brands trusted by professionals.', 'agtools' ) ),
	array( '03', __( 'Professional support', 'agtools' ), __( 'Expert help from people who understand the trade.', 'agtools' ) ),
	array( '04', __( 'Secure payment', 'agtools' ), __( 'Simple and secure checkout on every order.', 'agtools' ) ),
);
?>
<section class="section benefits"><div class="container"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'Why AG Tools', 'agtools' ); ?></p><h2><?php esc_html_e( 'Work smarter. Build better.', 'agtools' ); ?></div></div><div class="benefit-grid"><?php foreach ( $benefits as $benefit ) : ?><article class="benefit"><span><?php echo esc_html( $benefit[0] ); ?></span><h3><?php echo esc_html( $benefit[1] ); ?></h3><p><?php echo esc_html( $benefit[2] ); ?></p></article><?php endforeach; ?></div></div></section>
