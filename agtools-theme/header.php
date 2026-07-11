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
<header class="site-header">
	<div class="site-header__utility">
		<div class="container site-header__utility-inner">
			<span><?php esc_html_e( 'Professional tools. Ready when you are.', 'agtools' ); ?></span>
			<a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', get_theme_mod( 'agtools_phone', '+358 40 000 0000' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'agtools_phone', '+358 40 000 0000' ) ); ?></a>
		</div>
	</div>
	<div class="container site-header__main">
		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">AG<span>TOOLS</span></a>
			<?php endif; ?>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'agtools' ); ?></span><span></span><span></span>
		</button>
		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'agtools' ); ?>">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'fallback_cb' => 'wp_page_menu' ) ); ?>
		</nav>
		<form class="header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="agtools-search"><?php esc_html_e( 'Search products', 'agtools' ); ?></label>
			<input id="agtools-search" type="search" name="s" placeholder="<?php esc_attr_e( 'Search products', 'agtools' ); ?>">
			<?php if ( function_exists( 'WC' ) ) : ?><input type="hidden" name="post_type" value="product"><?php endif; ?>
			<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'agtools' ); ?>">⌕</button>
		</form>
		<div class="site-header__actions">
			<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
				<a class="header-action" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" aria-label="<?php esc_attr_e( 'My account', 'agtools' ); ?>"><span aria-hidden="true">◯</span><b><?php esc_html_e( 'Account', 'agtools' ); ?></b></a>
				<a class="header-action" href="#wishlist" aria-label="<?php esc_attr_e( 'Wishlist', 'agtools' ); ?>"><span aria-hidden="true">♡</span><b><?php esc_html_e( 'Wishlist', 'agtools' ); ?></b></a>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart" aria-label="<?php esc_attr_e( 'View cart', 'agtools' ); ?>"><span aria-hidden="true">▱</span><b><?php esc_html_e( 'Cart', 'agtools' ); ?></b><i><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></i></a>
			<?php endif; ?>
		</div>
	</div>
</header>
