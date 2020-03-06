<?php
/**
 * Translation functions for Featured Section One
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_featured_one_get_default_content() {
	return json_encode( array(
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-leaf-out',
			'title'      => esc_html__( 'Экологичность', 'skdom' ),
			'text'       => esc_html__( 'Экологически чистый материал. Этот материал имеет долгий срок службы. В таком доме комфортно жить.', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3013',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-comfort-warming',
			'title'      => esc_html__( 'Комфорт', 'skdom' ),
			'text'       => esc_html__( 'Экологически чистый материал. Этот материал имеет долгий срок службы. В таком доме комфортно жить.', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3014',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-construction',
			'title'      => esc_html__( 'Строительство', 'skdom' ),
			'text'       => esc_html__( 'Экологически чистый материал. Этот материал имеет долгий срок службы. В таком доме комфортно жить.', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3015',
		),
                array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-price',
			'title'      => esc_html__( 'Выгодно', 'skdom' ),
			'text'       => esc_html__( 'Деревянные дома устойчивы, прочны, практически не деформируются, не подвергаются усадке.', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3016',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_featured_one_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_featured_one_get_default_content();
	skdom_pll_string_register_helper( 'skdom_featured_one_content', $default, 'Featured Section One' );
}
add_action( 'after_setup_theme', 'skdom_featured_one_register_strings', 11 );
