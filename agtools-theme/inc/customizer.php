<?php
/**
 * Small, performance-friendly theme settings.
 *
 * @package AGTools
 */

defined( 'ABSPATH' ) || exit;

function agtools_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'agtools_brand',
		array(
			'title'    => __( 'AG Tools brand', 'agtools' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting( 'agtools_phone', array( 'default' => '+358 40 000 0000', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'agtools_phone', array( 'label' => __( 'Phone number', 'agtools' ), 'section' => 'agtools_brand', 'type' => 'text' ) );
}
add_action( 'customize_register', 'agtools_customize_register' );
