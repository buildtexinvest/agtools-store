<?php
/** Hero section. */
?>
<section class="hero hero--premium">
	<div class="container hero__grid">
		<div class="hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Built for professionals', 'agtools' ); ?></p>
			<h1><?php esc_html_e( 'Cut deeper. Work smarter.', 'agtools' ); ?></h1>
			<p class="hero__lead"><?php esc_html_e( 'Premium diamond tools, equipment and accessories for demanding jobs.', 'agtools' ); ?></p>
			<div class="button-group"><a class="button" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'Shop now', 'agtools' ); ?> <span>→</span></a><a class="hero__secondary" href="#categories"><?php esc_html_e( 'Explore categories', 'agtools' ); ?> <span>↓</span></a></div>
		</div>
		<div class="hero__visual"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-angle-grinder.png' ); ?>" alt="<?php esc_attr_e( 'Professional angle grinder with diamond blade', 'agtools' ); ?>" fetchpriority="high"></div>
	</div>
</section>
