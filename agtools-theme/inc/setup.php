<?php
/**
 * Theme support and navigation setup.
 *
 * @package AGTools
 */

defined( 'ABSPATH' ) || exit;

function agtools_setup() {
	load_theme_textdomain( 'agtools', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 260, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/theme.css' );

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'agtools' ),
			'footer'  => __( 'Footer navigation', 'agtools' ),
		)
	);
}
add_action( 'after_setup_theme', 'agtools_setup' );

function agtools_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'agtools_content_width', 1240 );
}
add_action( 'after_setup_theme', 'agtools_content_width', 0 );
