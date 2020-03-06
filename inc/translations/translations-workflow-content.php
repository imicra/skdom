<?php
/**
 * Translation functions for Workflow Content
 *
 * @package skdom
 */

/**
 * Get header contacts section default content.
 */
function skdom_workflow_get_default_content() {
	return json_encode( array(
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-phone-dialog',
			'title'      => esc_html__( 'Позвоните нам', 'skdom' ),
			'text'       => esc_html__( 'Оставте заявку или позвоните нам по телефону: наш менеджер свяжется с вами в ближайшее время', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3013',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-set-square',
			'title'      => esc_html__( 'Подготовка проекта', 'skdom' ),
			'text'       => esc_html__( 'Подбор проекта и консультация, разработка чертежей и составление сметы', 'skdom' ),
			'id'         => 'skdom_56fd4d94f3014',
		),
		array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-concrete-mixer',
			'title'      => esc_html__( 'Подготовка участка', 'skdom' ),
			'text'       => esc_html__( 'Привязка проекта дома к участку, подготовка строительных материалов', 'skdom' ),
			'id'         => 'skdom_56fd4d95f3015',
		),
                array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-brick-wall',
			'title'      => esc_html__( 'Строительство', 'skdom' ),
			'text'       => esc_html__( 'Строительство фундамента, возведение стен, кровельные работы', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3016',
		),
                array(
			'icon_font'  => 'ifamily_sk',
                        'icon_value' => 'sk-window',
			'title'      => esc_html__( 'Отделка и монтаж', 'skdom' ),
			'text'       => esc_html__( 'Монтаж окон и дверей, отделка фасада, монтаж коммуникаций', 'skdom' ),
			'id'         => 'skdom_56fd4d93f3016',
		),
	) );
}

/**
 * Register strings for polylang.
 */
function skdom_workflow_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) ) {
		return;
	}

	$default = skdom_workflow_get_default_content();
	skdom_pll_string_register_helper( 'skdom_workflow_content', $default, 'Workflow Section' );
}
add_action( 'after_setup_theme', 'skdom_workflow_register_strings', 11 );
