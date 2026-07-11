<?php
/** Benefits section. */

$benefits = array(
	array( '01', __( 'Built to last', 'agtools' ), __( 'Professional-grade tools from brands you can trust.', 'agtools' ) ),
	array( '02', __( 'Fast delivery', 'agtools' ), __( 'Straight to site, workshop or home—without the wait.', 'agtools' ) ),
	array( '03', __( 'Real support', 'agtools' ), __( 'Talk to people who know the tools and the trade.', 'agtools' ) ),
);
?>
<section class="section benefits"><div class="container"><div class="section-heading"><div><p class="eyebrow"><?php esc_html_e( 'Why AG Tools', 'agtools' ); ?></p><h2><?php esc_html_e( 'Work smarter. Build better.', 'agtools' ); ?></div></div><div class="benefit-grid"><?php foreach ( $benefits as $benefit ) : ?><article class="benefit"><span><?php echo esc_html( $benefit[0] ); ?></span><h3><?php echo esc_html( $benefit[1] ); ?></h3><p><?php echo esc_html( $benefit[2] ); ?></p></article><?php endforeach; ?></div></div></section>
