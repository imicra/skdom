<?php
/**
 * Translation functions for Promo Block Section
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_promo_get_default_content() {
	return json_encode( array(
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-big',
			'title'      => esc_html__( 'Надежность', 'skdom' ),
			'text'       => esc_html__( 'Деревянные дома устойчивы, прочны, практически не деформируются, не подвергаются усадке.', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3013',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-crane',
			'title'      => esc_html__( 'Быстрое возведение', 'skdom' ),
			'text'       => esc_html__( 'Доставленный на площадку материал, как правило, полностью готов к работе.', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3014',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-savings',
			'title'      => esc_html__( 'Доступная цена', 'skdom' ),
			'text'       => esc_html__( 'Дома из клееного бруса недорого обходятся их владельцам - это не рекламный ход, а реальность!', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3015',
		),
                array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-paint-roller',
			'title'      => esc_html__( 'Внутренняя отделка', 'skdom' ),
			'text'       => esc_html__( 'Отсутствует необходимость отделки дома (и внутри, и снаружи). В доме можно жить сразу после постройки!', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3016',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-leaf-in',
			'title'      => esc_html__( 'Натуральный материал', 'skdom' ),
			'text'       => esc_html__( 'Натуральные материалы обеспечивают благоприятный микроклимат в доме', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3017',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-plan-plane',
			'title'      => esc_html__( 'Индивидуальный проект', 'skdom' ),
			'text'       => esc_html__( 'Клееный брус позволяет воплощать любые пожелания заказчика и идеи проектировщика.', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3018',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_promo_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_promo_get_default_content();
	skdom_pll_string_register_helper( 'skdom_promo_content', $default, 'Promo Block Section' );
}
add_action( 'after_setup_theme', 'skdom_promo_register_strings', 11 );
