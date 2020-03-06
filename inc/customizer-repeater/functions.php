<?php
/**
 * Include repeater files
 *
 * @package skdom
 */

// Require customizer functions and dependencies
require get_template_directory() . '/inc/customizer-repeater/inc/customizer.php';

/**
 * Check if Repeater is empty
 *
 * @param string $skdom_arr Repeater json array.
 *
 * @return bool
 */
function skdom_general_repeater_is_empty( $skdom_arr ) {
	if ( empty( $skdom_arr ) ) {
		return true;
	}
	$skdom_arr_decoded = json_decode( $skdom_arr, true );
	$not_check_keys = array( 'choice', 'id' );
	foreach ( $skdom_arr_decoded as $item ) {
		foreach ( $item as $key => $value ) {
			if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon') ) {
				return false;
			}
			if ( ! in_array( $key, $not_check_keys ) ) {
				if ( ! empty( $value ) ) {
					return false;
				}
			}
		}
	}
	return true;
}
