<?php
/**
 * Site header.
 *
 * @package AGTools
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'agtools' ); ?></a>
<header class="ag-header">
	<div class="ag-header__topbar"><div class="container ag-header__topbar-inner"><span><?php esc_html_e( 'Free delivery on orders over €150', 'agtools' ); ?></span><a href="mailto:hello@agtools.fi">hello@agtools.fi</a><nav class="ag-header__languages" aria-label="<?php esc_attr_e( 'Language selector', 'agtools' ); ?>"><a href="#" aria-current="true">FI</a><a href="#">EN</a><a href="#">RU</a></nav></div></div>
	<div class="container ag-header__main">
		<div class="ag-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">AG<span>TOOLS</span></a>
			<?php endif; ?>
		</div>
		<button class="ag-header__menu-toggle" type="button" aria-expanded="false" aria-controls="ag-header-nav">
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'agtools' ); ?></span><span></span><span></span>
		</button>
		<button class="ag-header__catalog" type="button" aria-expanded="false" aria-controls="ag-mega-menu"><span aria-hidden="true">☰</span><?php esc_html_e( 'Catalog', 'agtools' ); ?></button>
		<form class="ag-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-ag-search>
			<label class="screen-reader-text" for="agtools-search"><?php esc_html_e( 'Search products', 'agtools' ); ?></label>
			<input id="agtools-search" type="search" name="s" autocomplete="off" placeholder="<?php esc_attr_e( 'Search by product or article number', 'agtools' ); ?>">
			<?php if ( function_exists( 'WC' ) ) : ?><input type="hidden" name="post_type" value="product"><?php endif; ?>
			<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'agtools' ); ?>">⌕</button><div class="ag-search__results" hidden aria-live="polite"></div>
		</form>
		<div class="ag-header__actions">
			<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
				<div class="ag-header__dropdown"><button class="ag-header__action" type="button" aria-expanded="false"><span aria-hidden="true">◯</span><b><?php esc_html_e( 'Account', 'agtools' ); ?></b></button><div class="ag-header__dropdown-panel"><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'My account', 'agtools' ); ?></a><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>orders/"><?php esc_html_e( 'Orders', 'agtools' ); ?></a><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>edit-account/"><?php esc_html_e( 'Account settings', 'agtools' ); ?></a></div></div>
				<a class="ag-header__action" href="#wishlist" aria-label="<?php esc_attr_e( 'Wishlist', 'agtools' ); ?>"><span aria-hidden="true">♡</span><b><?php esc_html_e( 'Wishlist', 'agtools' ); ?></b></a>
				<div class="ag-header__dropdown ag-header__cart"><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="ag-header__action"><span aria-hidden="true">▱</span><b><?php esc_html_e( 'Cart', 'agtools' ); ?></b><i><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></i></a><div class="ag-header__dropdown-panel ag-header__mini-cart"><?php do_action( 'woocommerce_before_mini_cart' ); woocommerce_mini_cart(); do_action( 'woocommerce_after_mini_cart' ); ?></div></div>
			<?php endif; ?>
		</div>
	</div>
	<div class="ag-header__nav-wrap"><div class="container"><nav id="ag-header-nav" class="ag-header__nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'agtools' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'agtools_primary_nav_fallback' ) ); ?></nav></div></div>
	<div id="ag-mega-menu" class="ag-mega-menu" hidden><div class="container ag-mega-menu__inner"><div><p class="ag-mega-menu__eyebrow"><?php esc_html_e( 'Shop by category', 'agtools' ); ?></p><ul class="ag-mega-menu__list"><?php foreach ( array( __( 'Diamond Blades', 'agtools' ), __( 'Diamond Drill Bits', 'agtools' ), __( 'Tile Cutters', 'agtools' ), __( 'Grinding', 'agtools' ), __( 'Hand Tools', 'agtools' ), __( 'Dust Management', 'agtools' ), __( 'Accessories', 'agtools' ) ) as $category ) : ?><li><a href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php echo esc_html( $category ); ?><span>→</span></a></li><?php endforeach; ?></ul></div><aside class="ag-mega-menu__promo"><p><?php esc_html_e( 'Professional tools. No compromise.', 'agtools' ); ?></p><a class="button" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'Shop all products', 'agtools' ); ?> →</a></aside></div></div>
</header>
