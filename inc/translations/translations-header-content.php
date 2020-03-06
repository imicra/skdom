<?php
/**
 * Translation functions for Header Content Section
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_header_contacts_get_default_content() {
	return json_encode( array(
		array(
                        'icon_font'  => 'ifamily_fa',    
			'icon_value' => 'fa-phone',
			'title'      => esc_html__( 'Звоните нам', 'skdom' ),
			'text'       => esc_html__( '(8212) 555-555', 'skdom' ),
                        'link'       => esc_url( '' ),
			'id'         => 'skdom_56fd4d93f3013',
		),
		array(
                        'icon_font'  => 'ifamily_fa', 
			'icon_value' => 'fa-home',
			'title'      => esc_html__( 'Адрес', 'skdom' ),
			'text'       => esc_html__( 'Сыктывкар', 'skdom' ),
                        'link'       => esc_url( '' ),
			'id'         => 'skdom_56fd4d94f3014',
		),
		array(
                        'icon_font'  => 'ifamily_fa', 
			'icon_value' => 'fa-envelope',
			'title'      => esc_html__( 'Предложения', 'skdom' ),
			'text'       => esc_html__( 'imicra@mail.ru', 'skdom' ),
                        'link'       => esc_url( 'mailto:imicra@mail.ru' ),
			'id'         => 'skdom_56fd4d95f3015',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_header_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_header_contacts_get_default_content();
	skdom_pll_string_register_helper( 'skdom_header_contacts', $default, 'Header Content' );
}
add_action( 'after_setup_theme', 'skdom_header_register_strings', 11 );
