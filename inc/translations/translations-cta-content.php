<?php
/**
 * Translation functions for CTA Section
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_cta_ico_get_default_content() {
	return json_encode( array(
		array(
                        'icon_font'  => 'ifamily_fa',
                        'icon_value' => 'fa-phone',
			'id'         => 'skdom_56fd4d93f3013',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_cta_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_cta_ico_get_default_content();
	skdom_pll_string_register_helper( 'skdom_cta_ico', $default, 'CTA Section' );
}
add_action( 'after_setup_theme', 'skdom_cta_register_strings', 11 );
