<?php
/** Hero section. */
?>
<section class="ag-hero" aria-labelledby="ag-hero-title">
	<div class="ag-hero__texture" aria-hidden="true"></div>
	<div class="container ag-hero__inner">
		<div class="ag-hero__content">
			<p class="ag-hero__eyebrow"><?php esc_html_e( 'AG Tools for professionals', 'agtools' ); ?></p>
			<h1 id="ag-hero-title"><?php esc_html_e( 'Professional Tile Installation Tools', 'agtools' ); ?></h1>
			<p class="ag-hero__lead"><?php esc_html_e( 'Diamond blades, drill bits, tile cutters and accessories for professionals across Finland.', 'agtools' ); ?></p>
			<div class="ag-hero__actions">
				<a class="ag-hero__button ag-hero__button--primary" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'Shop Products', 'agtools' ); ?><span aria-hidden="true">→</span></a>
				<a class="ag-hero__button ag-hero__button--secondary" href="#categories"><?php esc_html_e( 'Browse Categories', 'agtools' ); ?><span aria-hidden="true">↓</span></a>
			</div>
			<ul class="ag-hero__trust" aria-label="<?php esc_attr_e( 'AG Tools benefits', 'agtools' ); ?>">
				<li><?php esc_html_e( 'Fast delivery', 'agtools' ); ?></li>
				<li><?php esc_html_e( 'Original products', 'agtools' ); ?></li>
				<li><?php esc_html_e( 'Professional support', 'agtools' ); ?></li>
			</ul>
		</div>
		<figure class="ag-hero__visual"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-tile-installation-tools.webp' ); ?>" alt="<?php esc_attr_e( 'Diamond blade, diamond drill bit and tile cutter for professional installation work', 'agtools' ); ?>" fetchpriority="high" decoding="async"></figure>
	</div>
</section>
