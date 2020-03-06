<?php
/**
 * Define Allowed Files to be included.
 */
function skdom_filter_cpt( $array ) {
	return array_merge( $array, array(
		'cpt/posts-testimonials',
                'cpt/posts-portfolio',
                'cpt/posts-faq',
                'cpt/posts-services',
	) );
}
add_filter( 'skdom_filter_cpt', 'skdom_filter_cpt' );

/**
 * Include files.
 */
function skdom_include_cpt() {
	$skdom_allowed_phps = array();
	$skdom_allowed_phps = apply_filters( 'skdom_filter_cpt', $skdom_allowed_phps );
	foreach ( $skdom_allowed_phps as $file ) {
		$skdom_file_to_include = get_template_directory() . '/inc/' . $file . '.php';
		if ( file_exists( $skdom_file_to_include ) ) {
			include_once( $skdom_file_to_include );
		}
	}
}
add_action( 'after_setup_theme', 'skdom_include_cpt' );