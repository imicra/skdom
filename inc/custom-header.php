<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package skdom
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses skdom_header_style()
 */
function skdom_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'skdom_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/img/header-image.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 2050,
		'height'                 => 1400,
		'flex-height'            => true,
                'flex-width'             => true,
		'wp-head-callback'       => 'skdom_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'skdom_custom_header_setup' );

$header_images = array(
    'header_image' => array(
            'url'           => get_template_directory_uri() . '/img/header-image.jpg',
            'thumbnail_url' => get_template_directory_uri() . '/img/header-image-thumbnail.jpg',
            'description'   => 'imicra header composition',
    ),  
);
register_default_headers( $header_images );
