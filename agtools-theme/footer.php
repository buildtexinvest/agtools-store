<?php
/**
 * Site footer.
 *
 * @package AGTools
 */
?>
<footer class="site-footer">
	<div class="container site-footer__grid">
		<div><a class="brand brand--light" href="<?php echo esc_url( home_url( '/' ) ); ?>">AG<span>TOOLS</span></a><p><?php esc_html_e( 'Professional tools and equipment for work that lasts.', 'agtools' ); ?></p></div>
		<div><h2><?php esc_html_e( 'Shop', 'agtools' ); ?></h2><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => 'wp_page_menu' ) ); ?></div>
		<div><h2><?php esc_html_e( 'Need help?', 'agtools' ); ?></h2><a href="mailto:hello@agtools.fi">hello@agtools.fi</a><a href="tel:+358400000000">+358 40 000 0000</a></div>
	</div>
	<div class="container site-footer__bottom"><span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> AG Tools</span><span><?php esc_html_e( 'Built for professionals.', 'agtools' ); ?></span></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
