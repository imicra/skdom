<?php
/**
 * General functions for translation.
 *
 * @package skdom
 */


/**
 * Filter to translate strings
 */
function skdom_translate_single_string( $original_value, $domain ) {
	if ( is_customize_preview() ) {
		$wpml_translation = $original_value;
	} else {
		$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
		if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
			return pll__( $original_value );
		}
	}

	return $wpml_translation;
}
add_filter( 'skdom_translate_single_string', 'skdom_translate_single_string', 10, 2 );


/**
 * Helper to register pll string.
 *
 * @param String     $theme_mod Theme mod name.
 * @param bool /json $default Default value.
 * @param String     $name Name for polylang backend.
 */
function skdom_pll_string_register_helper( $theme_mod, $default = false, $name ) {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}
	$repeater_content = get_theme_mod( $theme_mod, $default );
	$repeater_content = json_decode( $repeater_content );
	if ( ! empty( $repeater_content ) ) {
		foreach ( $repeater_content as $repeater_item ) {
			foreach ( $repeater_item as $field_name => $field_value ) {
				if ( $field_name === 'social_repeater' ) {
					$social_repeater_value = json_decode( $field_value );
					if ( ! empty( $social_repeater_value ) ) {
						foreach ( $social_repeater_value as $social ) {
							foreach ( $social as $key => $value ) {
								if ( $key === 'link' ) {
									pll_register_string( 'Social link', $value, $name );
								}
								if ( $key === 'icon' ) {
									pll_register_string( 'Social icon', $value, $name );
								}
							}
						}
					}
				} else {
					if ( $field_name !== 'id' && $field_name !== 'choice' ) {
						$f_n = ucfirst( $field_name );
						pll_register_string( $f_n, $field_value, $name );
					}
				}
			}
		}
	}
}


/**
 * Define Allowed Files to be included.
 */
function skdom_filter_translations( $array ) {
	return array_merge( $array, array(
		'translations/translations-header-content',
                'translations/translations-header-mobile',
                'translations/translations-about-content',
                'translations/translations-promo-content',
                'translations/translations-featured-one-content',
                'translations/translations-featured-two-content',
                'translations/translations-cta-content',
                'translations/translations-workflow-content',
                'translations/translations-contacts-content',
	) );
}
add_filter( 'skdom_filter_translations', 'skdom_filter_translations' );



/**
 * Include translations files.
 */
function skdom_include_translations() {
	$skdom_allowed_phps = array();
	$skdom_allowed_phps = apply_filters( 'skdom_filter_translations', $skdom_allowed_phps );
	foreach ( $skdom_allowed_phps as $file ) {
		$skdom_file_to_include = get_template_directory() . '/inc/' . $file . '.php';
		if ( file_exists( $skdom_file_to_include ) ) {
			include_once( $skdom_file_to_include );
		} else {
			if ( defined( 'SKDOM_PATH' ) ) {
				$skdom_file_to_include_from_pro = SKDOM_PATH . 'public/inc/' . $file . '.php';
				if ( file_exists( $skdom_file_to_include_from_pro ) ) {
					include_once( $skdom_file_to_include_from_pro );
				}
			}
		}
	}
}
add_action( 'after_setup_theme', 'skdom_include_translations' );
