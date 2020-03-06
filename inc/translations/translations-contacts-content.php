<?php
/**
 * Translation functions for Workflow Content
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_contacts_get_default_content() {
	return json_encode( array(
		array(
			'icon_font'  => 'ifamily_fa',
                        'icon_value' => 'fa-map-marker',
			'title'      => esc_html__( 'Адрес', 'skdom' ),
			'text'       => esc_html__( 'г. Сыктывкар,респ. Коми', 'skdom' ),
                        'link'       => esc_url( '' ),
			'id'         => 'skdom_56fd4d93f3013',
		),
		array(
			'icon_font'  => 'ifamily_fa',
                        'icon_value' => 'fa-mobile-phone',
			'title'      => esc_html__( 'Телефоны', 'skdom' ),
			'text'       => esc_html__( '(8212) 555-555', 'skdom' ),
                        'link'       => esc_url( '' ),
			'id'         => 'skdom_56fd4d93f3014',
		),
		array(
			'icon_font'  => 'ifamily_fa',
                        'icon_value' => 'fa-paper-plane',
			'title'      => esc_html__( 'Почта', 'skdom' ),
			'text'       => esc_html__( 'imicra@mail.ru', 'skdom' ),
                        'link'       => esc_url( 'mailto:imicra@mail.ru' ),
			'id'         => 'skdom_56fd4d93f3015',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_contacts_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_contacts_get_default_content();
	skdom_pll_string_register_helper( 'skdom_contacts_content', $default, 'Contacts Section' );
}
add_action( 'after_setup_theme', 'skdom_contacts_register_strings', 11 );
