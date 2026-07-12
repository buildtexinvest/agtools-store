<?php
/**
 * Asset registration.
 *
 * @package AGTools
 */

defined( 'ABSPATH' ) || exit;

function agtools_asset_version( $path ) {
	$file = get_template_directory() . $path;
	return file_exists( $file ) ? (string) filemtime( $file ) : wp_get_theme()->get( 'Version' );
}

function agtools_enqueue_assets() {
	wp_enqueue_style(
		'agtools-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'agtools-theme',
		get_template_directory_uri() . '/assets/css/theme.css',
		array(),
		agtools_asset_version( '/assets/css/theme.css' )
	);

	wp_enqueue_style(
		'agtools-header',
		get_template_directory_uri() . '/assets/css/header.css',
		array( 'agtools-theme' ),
		agtools_asset_version( '/assets/css/header.css' )
	);

	wp_enqueue_style(
		'agtools-hero',
		get_template_directory_uri() . '/assets/css/hero.css',
		array( 'agtools-theme' ),
		agtools_asset_version( '/assets/css/hero.css' )
	);

	wp_enqueue_style(
		'agtools-categories',
		get_template_directory_uri() . '/assets/css/categories.css',
		array( 'agtools-theme' ),
		agtools_asset_version( '/assets/css/categories.css' )
	);

	wp_enqueue_script(
		'agtools-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		agtools_asset_version( '/assets/js/theme.js' ),
		true
	);

	wp_localize_script(
		'agtools-theme',
		'agtoolsHeader',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'agtools-search' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'agtools_enqueue_assets' );

function agtools_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'agtools_resource_hints', 10, 2 );
