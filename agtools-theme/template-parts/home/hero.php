<?php
/** Hero section. */
?>
<section class="hero">
	<div class="container hero__grid">
		<div class="hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Tools for professionals', 'agtools' ); ?></p>
			<h1><?php esc_html_e( 'Built for the job. Ready for anything.', 'agtools' ); ?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Reliable tools, workwear and equipment for people who expect more from every shift.', 'agtools' ); ?></p>
			<div class="button-group"><a class="button" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'Shop tools', 'agtools' ); ?> <span>→</span></a><a class="text-link" href="#categories"><?php esc_html_e( 'Explore categories', 'agtools' ); ?></a></div>
		</div>
		<div class="hero__visual" aria-hidden="true"><div class="hero__disc"></div><div class="hero__tool"><span></span><i></i></div><p>AG<br>TOOLS</p></div>
	</div>
</section>
