<?php
/**
 * Translation functions for About Section
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_about_get_default_content() {
	return json_encode( array(
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-hand',
			'title'      => esc_html__( 'Строим под ключ', 'skdom' ),
			'text'       => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3013',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-calendar',
			'title'      => esc_html__( 'Быстрые темпы возведения', 'skdom' ),
			'text'       => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3014',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-plan-drawing',
			'title'      => esc_html__( 'Проект', 'skdom' ),
			'text'       => esc_html__( 'Используем готовый проект, или ваш или разработаем новый с учетом ваших потребностей', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3015',
		),
                array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-money',
			'title'      => esc_html__( 'Поэтапная оплата', 'skdom' ),
			'text'       => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3016',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-smartphone',
			'title'      => esc_html__( 'Отчетность о работе', 'skdom' ),
			'text'       => esc_html__( 'Фото и видео отчеты о ходе работ каждый день', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3017',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-price-tag',
			'title'      => esc_html__( 'Качество по разумной цене', 'skdom' ),
			'text'       => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3018',
		),
                array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-house-fence',
			'title'      => esc_html__( 'Благоустройство', 'skdom' ),
			'text'       => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3019',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-calculator',
			'title'      => esc_html__( 'Точная смета', 'skdom' ),
			'text'       => esc_html__( 'Гарантируем точную смету и сохранность первоначальной  стоимост', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3020',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-measuring',
			'title'      => esc_html__( 'Гарантия качества', 'skdom' ),
			'text'       => esc_html__( 'Гарантируем качество наших работ в договоре', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3021',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_about_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_about_get_default_content();
	skdom_pll_string_register_helper( 'skdom_about_content', $default, 'About Section' );
}
add_action( 'after_setup_theme', 'skdom_about_register_strings', 11 );
