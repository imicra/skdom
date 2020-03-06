<?php
/**
 * Translation functions for Header Mobile Contact Icon Section
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_mobile_contacts_get_default_content() {
	return json_encode( array(
		array(
			'title'      => esc_html__( '(8212) 555-555', 'skdom' ),
			'subtitle'   => esc_html__( 'Сыктывкар', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3016',
		),
		array(
			'title'      => esc_html__( '(8212) 666-666', 'skdom' ),
			'subtitle'   => esc_html__( 'Воркута', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3017',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_header_mobile_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_mobile_contacts_get_default_content();
	skdom_pll_string_register_helper( 'skdom_mobile_contacts', $default, 'Header Content' );
}
add_action( 'after_setup_theme', 'skdom_header_mobile_register_strings', 11 );
