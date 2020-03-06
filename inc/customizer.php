<?php
/**
 * skdom Theme Customizer
 *
 * @package skdom
 */

/* Include customizer repeater */
require_once get_template_directory() . '/inc/customizer-repeater/functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function skdom_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->default   = '#fefefe';
        $wp_customize->get_control( 'blogname' )->description = __( 'Appearance if Logo Image is not choosen.', 'skdom' );
        $wp_customize->get_control( 'blogdescription' )->description = __( 'Not displayed on front page.', 'skdom' );
        $wp_customize->remove_control( 'custom_logo' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'skdom_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'skdom_customize_partial_blogdescription',
		) );
	}
        
        require_once( 'alpha-color-picker/alpha-color-picker.php' );
        
        /**
	 * General Panel
	 */
        $wp_customize->add_panel( 'general', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => esc_html__( 'General', 'skdom' ),
	) );
        
        $wp_customize->get_section( 'title_tagline' )->panel = 'general';
        $wp_customize->get_section( 'colors' )->panel = 'general';
        $wp_customize->get_section( 'header_image' )->panel = 'general';
        $wp_customize->get_section( 'background_image' )->panel = 'general';
        
        /**
	 * Skdom Customizer Customizations
	 */
        
        // Header and footer background color
	$wp_customize->add_setting( 'theme_bg_color', array(
		'default'			=> '#1a1c27',
		'transport'			=> 'postMessage',
		'type'				=> 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'theme_bg_color', 
				array(
					'label'		=> __( 'Header and footer background color', 'skdom'),
					'section'	=> 'colors',
					'settings'	=> 'theme_bg_color'
				)
		)
	);
        
        // Section background color
	$wp_customize->add_setting( 'section_bg_color', array(
		'default'			=> '#f9fafb',
		'transport'			=> 'postMessage',
		'type'				=> 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'section_bg_color', 
				array(
					'label'		=> esc_html__( 'Section background color', 'skdom'),
                                        'description'   => esc_html__( '(Optional)', 'skdom' ),
					'section'	=> 'colors',
					'settings'	=> 'section_bg_color'
				)
		)
	);
        
        // Titles colors
	$wp_customize->add_setting( 'titles_colors', array(
		'default'			=> '#2f353f',
		'transport'			=> 'postMessage',
		'type'				=> 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'titles_colors', 
				array(
					'label'		=> __( 'Header colors', 'skdom'),
					'section'	=> 'colors',
					'settings'	=> 'titles_colors',
                                        'description'   => __( 'Titles and similar colors (like hover effect)' )
				)
		)
	);
        
        /**
	 * Logo SK Dom theme (Default)
	 */
	$wp_customize->add_setting( 'skdom_logo', array(
		'default' => get_template_directory_uri() . '/img/logo-nav.png',
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_logo', array(
	      	'label'    => esc_html__( 'Logo', 'skdom' ),
	      	'section'  => 'title_tagline',
                'priority' => 1,
	)));
        
        /**
	 * Options Panel
	 */
        $wp_customize->add_section( 'theme_options', 
		array(
			'title'			=> __( 'Theme Options', 'skdom' ),
			'priority'		=> 20,
			'capability'	=> 'edit_theme_options',
		)
	);
        
        $wp_customize->get_control( 'show_on_front' )->section = 'theme_options';
        $wp_customize->get_control( 'show_on_front' )->priority = 70;
        $wp_customize->get_control( 'page_on_front' )->section = 'theme_options';
        $wp_customize->get_control( 'page_on_front' )->priority = 75;
        $wp_customize->get_control( 'page_for_posts' )->section = 'theme_options';
        $wp_customize->get_control( 'page_for_posts' )->priority = 80;
        
        // Add Preloader option
        $wp_customize->add_setting( 'skdom_loader',
		array(
			'default'           => true,
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_loader',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'On/Off Preloader', 'skdom' ),
                        'description'   => esc_html__( 'If this box is checked, Front page content will be rendered after preloader animation.', 'skdom' ),
			'section'	=> 'theme_options',
                        'priority'      => 10,
		)
	);
        
        // Add Header Mod
	$wp_customize->add_setting( 'skdom_header_mod',
		array(
			'default'	    => 'intelligent',
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_header_mod',
		)
	);

	$wp_customize->add_control( 'skdom_header_mod',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Intelligent/Fixed Header', 'skdom' ),
			'section'	=> 'theme_options',
			'choices'	=> array(
                                'intelligent'	=> __( 'Intelligent (default)', 'skdom' ),
                                'fixed'	        => __( 'Fixed', 'skdom' )
			),
                        'priority'      => 20,
		)
	);
        
        // WOW option
        $wp_customize->add_setting( 'skdom_wow',
		array(
			'default'           => true,
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_wow',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'On/Off WOW animation effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is checked, WOW animation will be enabled on the front page.', 'skdom' ),
			'section'	=> 'theme_options',
                        'priority'      => 30,
		)
	);
        
        // Parallax Effect option
        $wp_customize->add_setting( 'skdom_parallax',
		array(
			'default'           => true,
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_parallax',
		array(
			'type'		=> 'checkbox',
			'label'		=> __( 'On/Off Parallax effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is checked, Parallax Effect will be enabled on the front page.', 'skdom' ),
			'section'	=> 'theme_options',
                        'priority'      => 40,
		)
	);
        
        /**
	 * Header Panel
	 */
        $wp_customize->add_panel( 'header', array(
		'priority'   => 25,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Header Section', 'skdom' ),
	) );
        
        /**
	 * Header Colors Section
	 */
        $wp_customize->add_section( 'skdom_header_colors', 
		array(
			'title'	        => __( 'Header Colors', 'skdom' ),
			'priority'      => 10,
                        'panel'         => 'header',
			'description'   => __( 'Header & Navigation Menu Colors.', 'skdom' )
		)
	);

	// Header color
	$wp_customize->add_setting( 'skdom_header_bar_color', array(
		'default' => 'rgba(34, 34, 34, 0.95)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));
        
        $wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_header_bar_color',
			array(
				'label'    => esc_html__( 'Header navigation bar color and transparency', 'skdom' ),
				'section'  => 'skdom_header_colors',
				'priority' => 10,
                                'palette' => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // Mobile Navigation color
	$wp_customize->add_setting( 'skdom_mobile_nav_color', array(
		'default' => '#222',
		'sanitize_callback' => 'sanitize_hex_color',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'skdom_mobile_nav_color',
			array(
				'label'    => __( 'Mobile Navigation color', 'skdom' ),
				'section'  => 'skdom_header_colors',
				'priority'   => 20,
			)
		)
	);
        
        // Mobile Navigation Overlay
	$wp_customize->add_setting( 'skdom_mobile_nav_overlay', array(
		'default' => 'rgba(0, 0, 0, 0.5)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

        $wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_mobile_nav_overlay',
			array(
				'label'    => esc_html__( 'Mobile Navigation Overlay color and transparency', 'skdom' ),
				'section'  => 'skdom_header_colors',
				'priority' => 30,
                                'palette' => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        /**
	 * Header Content Section
	 */
        $wp_customize->add_section( 'skdom_header_content', 
		array(
			'title'	        => __( 'Header Content', 'skdom' ),
			'priority'      => 20,
                        'panel'         => 'header',
			'description'   => __( 'Header Contacts information.', 'skdom' )
		)
	);
        
        // Main contacts
        $default = skdom_header_contacts_get_default_content();
	$wp_customize->add_setting( 'skdom_header_contacts', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default' => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_header_contacts', array(
		'label'   => esc_html__( 'Add new contact box','skdom' ),
		'section' => 'skdom_header_content',
		'priority' => 10,
		'skdom_icon_control' => true,
		'skdom_title_control' => true,
		'skdom_text_control' => true,
		'skdom_link_control'  => true,
	) ) );
        
        // Mobile contacts icon
	$wp_customize->add_setting( 'skdom_mobile_contacts_ico', array(
//		'sanitize_callback' => 'skdom_sanitize_input',
		'default'           => 'fa-phone',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( new Skdom_Icon_Picker( $wp_customize, 'skdom_mobile_contacts_ico', array(
		'label'   => __( 'Add mobile contact icon', 'skdom' ),
                'description' => esc_html__('Only for mobyle sizes', 'skdom'),
		'section' => 'skdom_header_content',
		'priority' => 20,
	) ) );
        
        // Mobile contacts items
        $default = skdom_mobile_contacts_get_default_content();
	$wp_customize->add_setting( 'skdom_mobile_contacts', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default' => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_mobile_contacts', array(
		'label'   => esc_html__( 'Add new mobile contact item','skdom' ),
		'section' => 'skdom_header_content',
		'priority' => 30,
		'skdom_title_control' => true,
		'skdom_subtitle_control' => true,
	) ) );
        
        /**
	 * Header Slider Section
	 */
        $wp_customize->add_section( 'skdom_slider_content', 
		array(
			'title'	        => esc_html__( 'Slider Content', 'skdom' ),
			'priority'      => 30,
                        'panel'         => 'header',
			'description'   => esc_html__( 'Content for big image.', 'skdom' ),
                        'active_callback' => 'skdom_is_front_page',
		)
	);
        
        // WOW effect option
        $wp_customize->add_setting( 'skdom_slider_wow',
		array(
			'default'           => true,
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_slider_wow',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off WOW effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is unchecked, animation effect is disable.', 'skdom' ),
			'section'	=> 'skdom_slider_content',
                        'priority'      => 1,
		)
	);
        
        // Site Slogan
	$wp_customize->add_setting( 'skdom_site_name', array(
                'default'           => esc_html__( 'Строим дома', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_site_name', array(
		'label'         => esc_html__( 'Site Name', 'skdom' ),
                'description'   => esc_html__( 'Main site name/slogan.', 'skdom' ),
		'section'       => 'skdom_slider_content',
		'priority'      => 10,
                'type'          => 'text',
	));
        
        // Site Description
        $wp_customize->add_setting( 'skdom_site_description', array(
                'default'           => esc_html__( 'Строительство деревянных частных домов  в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_site_description', array(
		'label'         => esc_html__( 'Site Description', 'skdom' ),
                'description'   => esc_html__( 'Description under slogan.', 'skdom' ),
		'section'       => 'skdom_slider_content',
		'priority'      => 20,
                'type'          => 'textarea',
	));
        
        // Button 1
        $wp_customize->add_setting( 'skdom_button_1_name', array(
                'default'           => esc_html__( 'заказать', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_button_1_name', array(
		'label'         => esc_html__( 'Button 1', 'skdom' ),
                'description'   => esc_html__( 'CTA text', 'skdom' ),
		'section'       => 'skdom_slider_content',
		'priority'      => 30,
                'type'          => 'text',
	));
        
        $wp_customize->add_setting( 'skdom_button_1_link', array(
                'default'           => '0',
		'sanitize_callback' => 'absint',
	) );
        
        $wp_customize->add_control( 'skdom_button_1_link', array(
                'description'   => esc_html__( 'Link to Page', 'skdom' ),
		'section'       => 'skdom_slider_content',
		'priority'      => 35,
                'type'          => 'dropdown-pages',
	));
        
        $wp_customize->add_setting( 'skdom_button_1_section', array(
		'default' => esc_html__( '#','skdom' ),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'skdom_button_1_section', array(
		'description'    => esc_html__( 'Link to Section', 'skdom' ),
		'section'  => 'skdom_slider_content',
		'priority'    => 36,
	));
        
        // Button 2
        $wp_customize->add_setting( 'skdom_button_2_name', array(
                'default'           => esc_html__( 'наши работы', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_button_2_name', array(
		'label'         => esc_html__( 'Button 2', 'skdom' ),
                'description'   => esc_html__( 'CTA text', 'skdom' ),
		'section'       => 'skdom_slider_content',
		'priority'      => 40,
                'type'          => 'text',
	));
        
        $wp_customize->add_setting( 'skdom_button_2_link', array(
                'default'           => '0',
		'sanitize_callback' => 'absint',
	) );
        
        $wp_customize->add_control( 'skdom_button_2_link', array(
                'description'   => esc_html__( 'Link to Page', 'skdom' ),
		'section'       => 'skdom_slider_content',
		'priority'      => 45,
                'type'          => 'dropdown-pages',
	));
        
        $wp_customize->add_setting( 'skdom_button_2_section', array(
		'default' => esc_html__( '#','skdom' ),
		'sanitize_callback' => 'esc_url',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'skdom_button_2_section', array(
		'description'    => esc_html__( 'Link to Section', 'skdom' ),
		'section'  => 'skdom_slider_content',
		'priority'    => 46,
	));
        
        /**
	 * About Panel
	 */
        $wp_customize->add_panel( 'skdom_about_panel', array(
		'priority'   => 30,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'About Section', 'skdom' ),
                'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * About Options
	 */
        $wp_customize->add_section( 'skdom_about_options' , array(
		'title'		  => esc_html__( 'Options Section', 'skdom' ),
                'panel'           => 'skdom_about_panel',
		'priority'	  => 10,
	) );
        
        // About Hash
        $wp_customize->add_setting( 'skdom_about_hash', array(
                'default'           => esc_html__( 'about', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_about_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_about_options',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // About Section background color option
        $wp_customize->add_setting( 'skdom_about_section_bg_color',
		array(
			'default'           => false,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_about_section_bg_color',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Section background color', 'skdom' ),
                        'description'   => esc_html__( '(Setting locate in General/Colors)', 'skdom' ),
			'section'	=> 'skdom_about_options',
                        'priority'      => 1,
		)
	);
        
        // About WOW effect option
        $wp_customize->add_setting( 'skdom_about_wow',
		array(
			'default'           => false,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_about_wow',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off WOW effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is unchecked, animation effect on content blocks is disable.', 'skdom' ),
			'section'	=> 'skdom_about_options',
                        'priority'      => 5,
		)
	);
        
        // About Cols in row
        $wp_customize->add_setting( 'skdom_about_col', array(
                'default'           => 3,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_about_col', array(
		'label'         => esc_html__( 'Number of Columns in row', 'skdom' ),
                'description'   => esc_html__( '(For best expirience recommended 3 or 4)', 'skdom' ),
		'section'       => 'skdom_about_options',
		'priority'      => 7,
                'type'          => 'number',
	));
        
        /**
	 * About Content
	 */
        $wp_customize->add_section( 'skdom_about_content' , array(
		'title'		  => esc_html__( 'Content Section', 'skdom' ),
                'panel'           => 'skdom_about_panel',
		'priority'	  => 20,
	) );
        
        // About Title
        $wp_customize->add_setting( 'skdom_about_title', array(
                'default'           => esc_html__( 'Немного о компании ск дом', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_about_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_about_content',
		'priority'      => 10,
                'type'          => 'text',
	));
        
        // About Subtitle
        $wp_customize->add_setting( 'skdom_about_subtitle', array(
                'default'           => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_about_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_about_content',
		'priority'      => 20,
                'type'          => 'textarea',
	));
        
        // About Content
        $default = skdom_about_get_default_content();
	$wp_customize->add_setting( 'skdom_about_content', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_about_content', array(
		'label'    => esc_html__( 'Add new box','skdom' ),
		'section'  => 'skdom_about_content',
		'priority' => 30,
		'skdom_icon_control'  => true,
		'skdom_title_control' => true,
		'skdom_text_control'  => true,
                'skdom_page_control'  => true,
	) ) );
        
        /**
	 * Promo Panel
	 */
        $wp_customize->add_panel( 'skdom_promo_panel', array(
		'priority'   => 35,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Promo Block Section', 'skdom' ),
                'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * Promo Options Section
	 */
        $wp_customize->add_section( 'skdom_promo_options' , array(
		'title'		  => esc_html__( 'Section Options', 'skdom' ),
		'priority'	  => 10,
                'panel'           => 'skdom_promo_panel',
	) );
        
        // Promo Hash
        $wp_customize->add_setting( 'skdom_promo_hash', array(
                'default'           => esc_html__( 'promo', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_promo_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_promo_options',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Promo Background Image
        $wp_customize->add_setting( 'skdom_promo_bgimage', array(
		'default'           => get_template_directory_uri() . '/img/promo-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_promo_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_promo_options',
                'priority' => 10,
	)));
        
        // Promo Overlay color
	$wp_customize->add_setting( 'skdom_promo_overlay', array(
		'default'           => 'rgba(82, 65, 47, 0.7)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_promo_overlay',
			array(
				'label'    => esc_html__( 'Overlay color and transparency under content blocks', 'skdom' ),
				'section'  => 'skdom_promo_options',
				'priority' => 20,
                                'palette'  => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // Promo WOW effect option
        $wp_customize->add_setting( 'skdom_promo_wow',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_promo_wow',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off WOW effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is unchecked, animation effect on content blocks is disable.', 'skdom' ),
			'section'	=> 'skdom_promo_options',
                        'priority'      => 30,
		)
	);
        
        // Promo Cols in row
        $wp_customize->add_setting( 'skdom_promo_col', array(
                'default'           => 2,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_promo_col', array(
		'label'         => esc_html__( 'Number of Columns in row', 'skdom' ),
                'description'   => esc_html__( '(For best expirience recommended 2)', 'skdom' ),
		'section'       => 'skdom_promo_options',
		'priority'      => 40,
                'type'          => 'number',
	));
        
        /**
	 * Promo Content Section
	 */
        $wp_customize->add_section( 'skdom_promo_content' , array(
		'title'		  => esc_html__( 'Section Content', 'skdom' ),
		'priority'	  => 20,
                'panel'           => 'skdom_promo_panel',
	) );
        
        // Promo Title
        $wp_customize->add_setting( 'skdom_promo_title', array(
                'default'           => esc_html__( 'Дома из дерева', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_promo_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_promo_content',
		'priority'      => 10,
                'type'          => 'text',
	));
        
        // Promo Subtitle
        $wp_customize->add_setting( 'skdom_promo_subtitle', array(
                'default'           => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_promo_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_promo_content',
		'priority'      => 20,
                'type'          => 'textarea',
	));
        
        // Promo Content
        $default = skdom_promo_get_default_content();
	$wp_customize->add_setting( 'skdom_promo_content', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_promo_content', array(
		'label'    => esc_html__( 'Add new box','skdom' ),
		'section'  => 'skdom_promo_content',
		'priority' => 30,
		'skdom_icon_control'  => true,
		'skdom_title_control' => true,
		'skdom_text_control'  => true,
                'skdom_page_control'  => true,
	) ) );
        
        /**
	 * Gallery Panel
	 */
        $wp_customize->add_panel( 'skdom_gallery_panel' , array(
		'title'		  => esc_html__( 'Gallery Section', 'skdom' ),
                'capability'      => 'edit_theme_options',
		'priority'	  => 40,
		'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * Gallery Options
	 */
        $wp_customize->add_section( 'skdom_gallery_options' , array(
		'title'		  => esc_html__( 'Section Options', 'skdom' ),
		'priority'	  => 10,
                'panel'           => 'skdom_gallery_panel',
	) );
        
        // Gallery Hash
        $wp_customize->add_setting( 'skdom_gallery_hash', array(
                'default'           => esc_html__( 'gallery', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_gallery_options',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Gallery Background Image
        $wp_customize->add_setting( 'skdom_gallery_bgimage', array(
		'default'           => get_template_directory_uri() . '/img/gallery-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_gallery_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_gallery_options',
                'priority' => 10,
	)));
        
        // Gallery background color
	$wp_customize->add_setting( 'skdom_gallery_bgcolor', array(
		'default'           => 'rgba(252, 249, 239, 0.9)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_gallery_bgcolor',
			array(
				'label'    => esc_html__( 'Background color and transparency', 'skdom' ),
				'section'  => 'skdom_gallery_options',
				'priority' => 10,
                                'palette'  => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // Gallery Cols in row
        $wp_customize->add_setting( 'skdom_gallery_col', array(
                'default'           => 3,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_col', array(
		'label'         => esc_html__( 'Number of Columns in row', 'skdom' ),
                'description'   => esc_html__( '(For best expirience recommended 3 or 2)', 'skdom' ),
		'section'       => 'skdom_gallery_options',
		'priority'      => 10,
                'type'          => 'number',
	));
        
        // Gallery Number of images
        $wp_customize->add_setting( 'skdom_gallery_number', array(
                'default'           => 6,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_number', array(
		'label'         => esc_html__( 'Number of images', 'skdom' ),
		'section'       => 'skdom_gallery_options',
		'priority'      => 10,
                'type'          => 'number',
	));
        
        // Gallery Link to portfolio item
        $wp_customize->add_setting( 'skdom_gallery_item',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'postMessage'
		)
	);

	$wp_customize->add_control( 'skdom_gallery_item',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'Link to portfolio item', 'skdom' ),
                        'description'   => esc_html__( 'Display or not a link to portfolio item.', 'skdom' ),
			'section'	=> 'skdom_gallery_options',
                        'priority'      => 10,
		)
	);
        
        // Gallery Lightbox Mod
	$wp_customize->add_setting( 'skdom_gallery_lightbox',
		array(
			'default'	    => 'gallery',
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_lightbox_mod',
		)
	);

	$wp_customize->add_control( 'skdom_gallery_lightbox',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Gallery Lightbox Mod', 'skdom' ),
			'section'	=> 'skdom_gallery_options',
			'choices'	=> array(
                                'gallery'	=> __( 'Gallery (default)', 'skdom' ),
                                'image'	        => __( 'Individual image', 'skdom' )
			),
                        'priority'      => 10,
		)
	);
        
        /**
	 * Gallery Content Section
	 */
        $wp_customize->add_section( 'skdom_gallery_content' , array(
		'title'		  => esc_html__( 'Section Content', 'skdom' ),
		'priority'	  => 20,
                'panel'           => 'skdom_gallery_panel',
	) );
        
        // Gallery Title
        $wp_customize->add_setting( 'skdom_gallery_title', array(
                'default'           => esc_html__( 'Лучшее, что мы построили', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_gallery_content',
		'priority'      => 10,
                'type'          => 'text',
	));
        
        // Gallery Subtitle
        $wp_customize->add_setting( 'skdom_gallery_subtitle', array(
                'default'           => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_gallery_content',
		'priority'      => 20,
                'type'          => 'textarea',
	));
        
        // Gallery Button
        $wp_customize->add_setting( 'skdom_gallery_button', array(
                'default'           => esc_html__( 'Вся галерея', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_button', array(
		'label'         => esc_html__( 'Button', 'skdom' ),
                'description'   => esc_html__( 'Text', 'skdom' ),
		'section'       => 'skdom_gallery_content',
		'priority'      => 30,
                'type'          => 'text',
	));
        
        $wp_customize->add_setting( 'skdom_gallery_link', array(
                'default'           => '0',
		'sanitize_callback' => 'absint',
	) );
        
        $wp_customize->add_control( 'skdom_gallery_link', array(
                'description'   => esc_html__( 'Button Link', 'skdom' ),
		'section'       => 'skdom_gallery_content',
		'priority'      => 35,
                'type'          => 'dropdown-pages',
	));
        
        /**
	 * Featured Panel
	 */
        $wp_customize->add_panel( 'featured', array(
		'priority'   => 45,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Featured Section', 'skdom' ),
                'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * Featured Section Overview
	 */
        $wp_customize->add_section( 'skdom_featured', 
		array(
			'title'	        => esc_html__( 'Featured Section Overview', 'skdom' ),
			'priority'      => 10,
                        'panel'         => 'featured',
		)
	);
        
        // Featured Hash
        $wp_customize->add_setting( 'skdom_featured_hash', array(
                'default'           => esc_html__( 'featured', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_featured_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_featured',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Featured Section background color option
        $wp_customize->add_setting( 'skdom_featured_section_bg_color',
		array(
			'default'           => false,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_featured_section_bg_color',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Section background color', 'skdom' ),
                        'description'   => esc_html__( '(Setting locate in General/Colors)', 'skdom' ),
			'section'	=> 'skdom_featured',
                        'priority'      => 10,
		)
	);
        
        // Featured WOW effect option
        $wp_customize->add_setting( 'skdom_featured_wow',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_featured_wow',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off WOW effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is unchecked, animation effect on content blocks is disable.', 'skdom' ),
			'section'	=> 'skdom_featured',
                        'priority'      => 20,
		)
	);
        
        // Featured Cols in row
        $wp_customize->add_setting( 'skdom_featured_col', array(
                'default'           => 2,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_featured_col', array(
		'label'         => esc_html__( 'Number of Columns in row', 'skdom' ),
                'description'   => esc_html__( '(For best expirience recommended 1 or 2)', 'skdom' ),
		'section'       => 'skdom_featured',
		'priority'      => 30,
                'type'          => 'number',
	));
        
        // Featured Section Title
        $wp_customize->add_setting( 'skdom_featured_title', array(
                'default'           => esc_html__( 'Строим самые оптимальные типы домов', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_featured',
		'priority'      => 40,
                'type'          => 'text',
	));
        
        // Featured Section Subtitle
        $wp_customize->add_setting( 'skdom_featured_subtitle', array(
                'default'           => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_featured',
		'priority'      => 50,
                'type'          => 'textarea',
	));
        
        /**
	 * Featured Section One
	 */
        $wp_customize->add_section( 'skdom_featured_one', 
		array(
			'title'	        => esc_html__( 'Featured Section One', 'skdom' ),
			'priority'      => 20,
                        'panel'         => 'featured',
		)
	);
        
        // Featured Section One Image
        $wp_customize->add_setting( 'skdom_featured_one_image', array(
		'default'           => get_template_directory_uri() . '/img/house-left.png',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_featured_one_image', array(
	      	'label'    => esc_html__( 'Image', 'skdom' ),
	      	'section'  => 'skdom_featured_one',
                'priority' => 10,
	)));
        
        // Featured Section 1 Title
        $wp_customize->add_setting( 'skdom_featured_one_title', array(
                'default'           => esc_html__( 'Каркасно-панельные дома', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_one_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_featured_one',
		'priority'      => 20,
                'type'          => 'text',
	));
        
        // Featured Section 1 Subtitle
        $wp_customize->add_setting( 'skdom_featured_one_subtitle', array(
                'default'           => esc_html__( 'Дома из клееного бруса - это последнее достижение деревянного зодчества, которое соединяет в себе “природность” дерева и новейшие технологии строительства.', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_one_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_featured_one',
		'priority'      => 30,
                'type'          => 'textarea',
	));
        
        // Featured Section 1 Content
        $default = skdom_featured_one_get_default_content();
	$wp_customize->add_setting( 'skdom_featured_one_content', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_featured_one_content', array(
		'label'    => esc_html__( 'Add new block','skdom' ),
		'section'  => 'skdom_featured_one',
		'priority' => 40,
		'skdom_icon_control'  => true,
		'skdom_title_control' => true,
		'skdom_text_control'  => true,
                'skdom_page_control'  => true,
	) ) );
        
        // Featured Section 1 Button
        $wp_customize->add_setting( 'skdom_featured_one_button', array(
                'default'           => esc_html__( 'Подробнее', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_one_button', array(
		'label'         => esc_html__( 'Button', 'skdom' ),
                'description'   => esc_html__( 'Text', 'skdom' ),
		'section'       => 'skdom_featured_one',
		'priority'      => 50,
                'type'          => 'text',
	));
        
        $wp_customize->add_setting( 'skdom_featured_one_link', array(
                'default'           => '0',
		'sanitize_callback' => 'absint',
	) );
        
        $wp_customize->add_control( 'skdom_featured_one_link', array(
                'description'   => esc_html__( 'Button Link', 'skdom' ),
		'section'       => 'skdom_featured_one',
		'priority'      => 55,
                'type'          => 'dropdown-pages',
	));
        
        /**
	 * Featured Section Two
	 */
        $wp_customize->add_section( 'skdom_featured_two', 
		array(
			'title'	        => esc_html__( 'Featured Section Two', 'skdom' ),
			'priority'      => 30,
                        'panel'         => 'featured',
		)
	);
        
        // Featured Section Two Image
        $wp_customize->add_setting( 'skdom_featured_two_image', array(
		'default'           => get_template_directory_uri() . '/img/house-right.png',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_featured_two_image', array(
	      	'label'    => esc_html__( 'Image', 'skdom' ),
	      	'section'  => 'skdom_featured_two',
                'priority' => 10,
	)));
        
        // Featured Section 2 Title
        $wp_customize->add_setting( 'skdom_featured_two_title', array(
                'default'           => esc_html__( 'Дома из клееного бруса', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_two_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_featured_two',
		'priority'      => 20,
                'type'          => 'text',
	));
        
        // Featured Section 2 Subtitle
        $wp_customize->add_setting( 'skdom_featured_two_subtitle', array(
                'default'           => esc_html__( 'Дома из клееного бруса - это последнее достижение деревянного зодчества, которое соединяет в себе “природность” дерева и новейшие технологии строительства.', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_two_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_featured_two',
		'priority'      => 30,
                'type'          => 'textarea',
	));
        
        // Featured Section 2 Content
        $default = skdom_featured_two_get_default_content();
	$wp_customize->add_setting( 'skdom_featured_two_content', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_featured_two_content', array(
		'label'    => esc_html__( 'Add new block','skdom' ),
		'section'  => 'skdom_featured_two',
		'priority' => 40,
		'skdom_icon_control'  => true,
		'skdom_title_control' => true,
		'skdom_text_control'  => true,
                'skdom_page_control'  => true,
	) ) );
        
        // Featured Section 2 Button
        $wp_customize->add_setting( 'skdom_featured_two_button', array(
                'default'           => esc_html__( 'Подробнее', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_featured_two_button', array(
		'label'         => esc_html__( 'Button', 'skdom' ),
                'description'   => esc_html__( 'Text', 'skdom' ),
		'section'       => 'skdom_featured_two',
		'priority'      => 50,
                'type'          => 'text',
	));
        
        $wp_customize->add_setting( 'skdom_featured_two_link', array(
                'default'           => '0',
		'sanitize_callback' => 'absint',
	) );
        
        $wp_customize->add_control( 'skdom_featured_two_link', array(
                'description'   => esc_html__( 'Button Link', 'skdom' ),
		'section'       => 'skdom_featured_two',
		'priority'      => 55,
                'type'          => 'dropdown-pages',
	));
        
        /**
	 * CTA Panel
	 */
        $wp_customize->add_panel( 'skdom_cta_panel' , array(
		'title'		  => esc_html__( 'CTA Section', 'skdom' ),
                'capability'      => 'edit_theme_options',
		'priority'	  => 50,
		'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * CTA Options
	 */
        $wp_customize->add_section( 'skdom_cta_options' , array(
		'title'		  => esc_html__( 'Section Options', 'skdom' ),
		'priority'	  => 10,
                'panel'           => 'skdom_cta_panel',
	) );
        
        // CTA Hash
        $wp_customize->add_setting( 'skdom_cta_hash', array(
                'default'           => esc_html__( 'cta', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_cta_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_cta_options',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // CTA background color
	$wp_customize->add_setting( 'skdom_cta_bgcolor', array(
		'default'           => 'rgba(82, 65, 47, 0.9)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_cta_bgcolor',
			array(
				'label'    => esc_html__( 'Background color and transparency', 'skdom' ),
				'section'  => 'skdom_cta_options',
				'priority' => 10,
                                'palette'  => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // CTA Background Image
        $wp_customize->add_setting( 'skdom_cta_bgimage', array(
		'default'           => get_template_directory_uri() . '/img/cta-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_cta_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_cta_options',
                'priority' => 20,
	)));
        
        // CTA Parallax option
        $wp_customize->add_setting( 'skdom_cta_parallax',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_cta_parallax',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Parallax effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is checked, the parallax effect is enabled.', 'skdom' ),
			'section'	=> 'skdom_cta_options',
                        'priority'      => 25,
		)
	);
        
        // CTA Background attachment option
	$wp_customize->add_setting( 'skdom_cta_attachment',
		array(
			'default'	    => 'fixed',
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_attachment_mod',
                        'transport'	    => 'postMessage'
		)
	);

	$wp_customize->add_control( 'skdom_cta_attachment',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Fixed/Normal attachment background image', 'skdom' ),
			'section'	=> 'skdom_cta_options',
			'choices'	=> array(
                                'fixed'	=> __( 'Fixed (choose for use Parallax effect)', 'skdom' ),
                                'normal' => __( 'Normal', 'skdom' )
			),
                        'priority'      => 26,
		)
	);
        
        // CTA Border option
        $wp_customize->add_setting( 'skdom_cta_border',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'postMessage'
		)
	);

	$wp_customize->add_control( 'skdom_cta_border',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Border', 'skdom' ),
			'section'	=> 'skdom_cta_options',
                        'priority'      => 30,
		)
	);
        
        /**
	 * CTA Content
	 */
        $wp_customize->add_section( 'skdom_cta_content' , array(
		'title'		  => esc_html__( 'Section Content', 'skdom' ),
		'priority'	  => 20,
                'panel'           => 'skdom_cta_panel',
	) );
        
        // CTA icon
        $default = skdom_cta_ico_get_default_content();
	$wp_customize->add_setting( 'skdom_cta_ico', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_cta_ico', array(
		'label'    => esc_html__( 'Add icon','skdom' ),
		'section'  => 'skdom_cta_content',
		'priority' => 10,
		'skdom_icon_control'  => true,
                'skdom_link_control'  => true,
	) ) );
        
        // CTA Title
        $wp_customize->add_setting( 'skdom_cta_title', array(
                'default'           => esc_html__( 'Позвоните нам:', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_cta_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_cta_content',
		'priority'      => 20,
                'type'          => 'text',
	));
        
        // CTA Phone number
        $wp_customize->add_setting( 'skdom_cta_phone', array(
                'default'           => esc_html__( ' (8212) 555-555', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_cta_phone', array(
		'label'         => esc_html__( 'Phone number', 'skdom' ),
		'section'       => 'skdom_cta_content',
		'priority'      => 30,
                'type'          => 'text',
	));
        
        // CTA Subtitle
        $wp_customize->add_setting( 'skdom_cta_subtitle', array(
                'default'           => esc_html__( 'Мы ответим на все ваши вопросы', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_cta_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_cta_content',
		'priority'      => 40,
                'type'          => 'textarea',
	));
        
        /**
	 * Workflow Panel
	 */
        $wp_customize->add_panel( 'skdom_workflow_panel' , array(
		'title'		  => esc_html__( 'Workflow Section', 'skdom' ),
                'capability'      => 'edit_theme_options',
		'priority'	  => 55,
		'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * Workflow Options
	 */
        $wp_customize->add_section( 'skdom_workflow_options' , array(
		'title'		  => esc_html__( 'Section Options', 'skdom' ),
		'priority'	  => 10,
                'panel'           => 'skdom_workflow_panel',
	) );
        
        // Workflow Hash
        $wp_customize->add_setting( 'skdom_workflow_hash', array(
                'default'           => esc_html__( 'workflow', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_workflow_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_workflow_options',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Workflow Section background color option
        $wp_customize->add_setting( 'skdom_workflow_section_bg_color',
		array(
			'default'           => false,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_workflow_section_bg_color',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Section background color', 'skdom' ),
                        'description'   => esc_html__( '(Setting locate in General/Colors)', 'skdom' ),
			'section'	=> 'skdom_workflow_options',
                        'priority'      => 1,
		)
	);
        
        // Workflow WOW effect option
        $wp_customize->add_setting( 'skdom_workflow_wow',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
			'transport'	    => 'none'
		)
	);

	$wp_customize->add_control( 'skdom_workflow_wow',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off WOW effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is unchecked, animation effect on content blocks is disable.', 'skdom' ),
			'section'	=> 'skdom_workflow_options',
                        'priority'      => 5,
		)
	);
        
        // Workflow Background Image
        $wp_customize->add_setting( 'skdom_workflow_bgimage', array(
		'default'           => get_template_directory_uri() . '/img/workflow-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_workflow_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_workflow_options',
                'priority' => 10,
	)));
        
        // Workflow Parallax option
        $wp_customize->add_setting( 'skdom_workflow_parallax',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_workflow_parallax',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Parallax effect', 'skdom' ),
                        'description'   => esc_html__( 'If this box is checked, the parallax effect is enabled.', 'skdom' ),
			'section'	=> 'skdom_workflow_options',
                        'priority'      => 15,
		)
	);
        
        // Workflow Background attachment option
	$wp_customize->add_setting( 'skdom_workflow_attachment',
		array(
			'default'	    => 'fixed',
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_attachment_mod',
                        'transport'	    => 'postMessage'
		)
	);

	$wp_customize->add_control( 'skdom_workflow_attachment',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Fixed/Normal attachment background image', 'skdom' ),
			'section'	=> 'skdom_workflow_options',
			'choices'	=> array(
                                'fixed'	=> __( 'Fixed (choose for use Parallax effect)', 'skdom' ),
                                'normal' => __( 'Normal', 'skdom' )
			),
                        'priority'      => 16,
		)
	);
        
        /**
	 * Workflow Content
	 */
        $wp_customize->add_section( 'skdom_workflow_content' , array(
		'title'		  => esc_html__( 'Section Content', 'skdom' ),
		'priority'	  => 20,
                'panel'           => 'skdom_workflow_panel',
	) );
        
        // Workflow Title
        $wp_customize->add_setting( 'skdom_workflow_title', array(
                'default'           => esc_html__( 'Схема работы', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_workflow_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_workflow_content',
		'priority'      => 10,
                'type'          => 'text',
	));
        
        // Workflow Subtitle
        $wp_customize->add_setting( 'skdom_workflow_subtitle', array(
                'default'           => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_workflow_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_workflow_content',
		'priority'      => 20,
                'type'          => 'textarea',
	));
        
        // Workflow Content
        $default = skdom_workflow_get_default_content();
	$wp_customize->add_setting( 'skdom_workflow_content', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_workflow_content', array(
		'label'    => esc_html__( 'Add new block','skdom' ),
		'section'  => 'skdom_workflow_content',
		'priority' => 30,
		'skdom_icon_control'  => true,
		'skdom_title_control' => true,
		'skdom_text_control'  => true,
                'skdom_page_control'  => true,
	) ) );
        
        /**
	 * Testimonials Section
	 */
        $wp_customize->add_section( 'skdom_testimonials_section' , array(
		'title'		  => esc_html__( 'Testimonials Section', 'skdom' ),
		'priority'	  => 60,
		'active_callback' => 'skdom_is_front_page',
	) );
        
        // Testimonials Hash
        $wp_customize->add_setting( 'skdom_testimonials_hash', array(
                'default'           => esc_html__( 'testimonials', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_testimonials_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_testimonials_section',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Testimonials Background Image
        $wp_customize->add_setting( 'skdom_testimonials_bgimage', array(
		'default'           => get_template_directory_uri() . '/img/testimonials-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_testimonials_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_testimonials_section',
                'priority' => 10,
	)));
        
        // Testimonials background color
	$wp_customize->add_setting( 'skdom_testimonials_bgcolor', array(
		'default'           => 'rgba(21, 15, 10, 0.85)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_testimonials_bgcolor',
			array(
				'label'    => esc_html__( 'Background color and transparency', 'skdom' ),
				'section'  => 'skdom_testimonials_section',
				'priority' => 20,
                                'palette'  => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // Testimonials Title
        $wp_customize->add_setting( 'skdom_testimonials_title', array(
                'default'           => esc_html__( 'Наши клиенты о нас', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_testimonials_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_testimonials_section',
		'priority'      => 30,
                'type'          => 'text',
	));
        
        // Testimonials Number
        $wp_customize->add_setting( 'skdom_testimonials_number', array(
                'default'           => 3,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_testimonials_number', array(
		'label'         => esc_html__( 'Number of testimonials', 'skdom' ),
                'description'   => esc_html__( '(Displayed in random order)', 'skdom' ),
		'section'       => 'skdom_testimonials_section',
		'priority'      => 40,
                'type'          => 'number',
	));
        
        /**
	 * Services Section
	 */
        $wp_customize->add_section( 'skdom_services_section' , array(
		'title'		  => esc_html__( 'Services Section', 'skdom' ),
		'priority'	  => 65,
		'active_callback' => 'skdom_is_front_page',
	) );
        
        // Services Hash
        $wp_customize->add_setting( 'skdom_services_hash', array(
                'default'           => esc_html__( 'services', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_services_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_services_section',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Services Section background color option
        $wp_customize->add_setting( 'skdom_services_section_bg_color',
		array(
			'default'           => true,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
//			'transport'	    => 'postMessage'
		)
	);

	$wp_customize->add_control( 'skdom_services_section_bg_color',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Section background color', 'skdom' ),
                        'description'   => esc_html__( '(Setting locate in General/Colors)', 'skdom' ),
			'section'	=> 'skdom_services_section',
                        'priority'      => 10,
		)
	);
        
        // Services Number
        $wp_customize->add_setting( 'skdom_services_number', array(
                'default'           => 4,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_services_number', array(
		'label'         => esc_html__( 'Number of Services', 'skdom' ),
		'section'       => 'skdom_services_section',
		'priority'      => 15,
                'type'          => 'number',
	));
        
        // Services Cols in row
        $wp_customize->add_setting( 'skdom_services_col', array(
                'default'           => 4,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_services_col', array(
		'label'         => esc_html__( 'Number of Columns in row', 'skdom' ),
                'description'   => esc_html__( '(For best expirience recommended 3 or 4)', 'skdom' ),
		'section'       => 'skdom_services_section',
		'priority'      => 16,
                'type'          => 'number',
	));
        
        // Services Title
        $wp_customize->add_setting( 'skdom_services_title', array(
                'default'           => esc_html__( 'Дополнительные услуги', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_services_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_services_section',
		'priority'      => 20,
                'type'          => 'text',
	));
        
        // Services Subtitle
        $wp_customize->add_setting( 'skdom_services_subtitle', array(
                'default'           => esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_services_subtitle', array(
		'label'         => esc_html__( 'Subtitle', 'skdom' ),
		'section'       => 'skdom_services_section',
		'priority'      => 30,
                'type'          => 'textarea',
	));
        
        // Services Buttons
        $wp_customize->add_setting( 'skdom_services_button', array(
                'default'           => esc_html__( 'Подробнее', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_services_button', array(
		'label'         => esc_html__( 'Buttons', 'skdom' ),
                'description'   => esc_html__( 'Text', 'skdom' ),
		'section'       => 'skdom_services_section',
		'priority'      => 40,
                'type'          => 'text',
	));
        
        /**
	 * FAQ Panel
	 */
        $wp_customize->add_panel( 'faq_panel', array(
		'priority'   => 70,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'FAQ/Form', 'skdom' ),
                'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * FAQ Option Section
	 */
        $wp_customize->add_section( 'skdom_faq_option_section', 
		array(
			'title'	        => esc_html__( 'FAQ Option', 'skdom' ),
			'priority'      => 1,
                        'panel'         => 'faq_panel',
		)
	);
        
        // FAQ Hash
        $wp_customize->add_setting( 'skdom_faq_hash', array(
                'default'           => esc_html__( 'faq', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_faq_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_faq_option_section',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // FAQ Section background color option
        $wp_customize->add_setting( 'skdom_faq_section_bg_color',
		array(
			'default'           => false,
			'sanitize_callback' => 'skdom_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'skdom_faq_section_bg_color',
		array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'On/Off Section background color', 'skdom' ),
                        'description'   => esc_html__( '(Setting locate in General/Colors)', 'skdom' ),
			'section'	=> 'skdom_faq_option_section',
                        'priority'      => 1,
		)
	);
        
        /**
	 * FAQ Section
	 */
        $wp_customize->add_section( 'skdom_faq_section', 
		array(
			'title'	        => esc_html__( 'FAQ Section', 'skdom' ),
			'priority'      => 10,
                        'panel'         => 'faq_panel',
		)
	);
        
        // FAQ Number of items
        $wp_customize->add_setting( 'skdom_faq_number', array(
                'default'           => 3,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_faq_number', array(
		'label'         => esc_html__( 'Number of items', 'skdom' ),
		'section'       => 'skdom_faq_section',
		'priority'      => 10,
                'type'          => 'number',
	));
        
        // FAQ Accordion mode
	$wp_customize->add_setting( 'skdom_faq_mode',
		array(
			'default'	    => 'toggle',
			'type'		    => 'theme_mod',
			'sanitize_callback' => 'skdom_sanitize_faq_mod',
		)
	);

	$wp_customize->add_control( 'skdom_faq_mode',
		array(
			'type'		=> 'radio',
			'label'		=> __( 'Toggle/Normal Accordion Mode', 'skdom' ),
			'section'	=> 'skdom_faq_section',
			'choices'	=> array(
                                'toggle'	=> __( 'Toggle (default)', 'skdom' ),
                                'each' => __( 'Normal', 'skdom' )
			),
                        'priority'      => 20,
		)
	);
        
        // FAQ active item
        $wp_customize->add_setting( 'skdom_faq_active', array(
                'default'           => 2,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_faq_active', array(
		'label'         => esc_html__( 'Active item', 'skdom' ),
		'section'       => 'skdom_faq_section',
		'priority'      => 30,
                'type'          => 'number',
	));
        
        // FAQ Title
        $wp_customize->add_setting( 'skdom_faq_title', array(
                'default'           => esc_html__( 'Нас часто спрашивают', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_faq_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
                'description'   => esc_html__( 'If field is empty section does not exist', 'skdom' ),
		'section'       => 'skdom_faq_section',
		'priority'      => 40,
                'type'          => 'text',
	));
        
        /**
	 * Form Section
	 */
        $wp_customize->add_section( 'skdom_form_section', 
		array(
			'title'	        => esc_html__( 'Contact Form Section', 'skdom' ),
			'priority'      => 20,
                        'panel'         => 'faq_panel',
		)
	);
        
        // Form Title
        $wp_customize->add_setting( 'skdom_form_title', array(
                'default'           => esc_html__( 'Спросите нас', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_form_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
                'description'   => esc_html__( 'If field is empty section does not exist', 'skdom' ),
		'section'       => 'skdom_form_section',
		'priority'      => 20,
                'type'          => 'text',
	));
        
        /**
	 * Contacts Panel
	 */
        $wp_customize->add_panel( 'skdom_contacts_panel' , array(
		'title'		  => esc_html__( 'Contacts Section', 'skdom' ),
                'capability'      => 'edit_theme_options',
		'priority'	  => 75,
		'active_callback' => 'skdom_is_front_page',
	) );
        
        /**
	 * Contacts Options
	 */
        $wp_customize->add_section( 'skdom_contacts_options' , array(
		'title'		  => esc_html__( 'Section Options', 'skdom' ),
		'priority'	  => 10,
                'panel'           => 'skdom_contacts_panel',
	) );
        
        // Contacts Hash
        $wp_customize->add_setting( 'skdom_contacts_hash', array(
                'default'           => esc_html__( 'contacts', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
	) );
        
        $wp_customize->add_control( 'skdom_contacts_hash', array(
		'label'         => esc_html__( '# of section (used in One Page navigation menu)', 'skdom' ),
		'section'       => 'skdom_contacts_options',
		'priority'      => 1,
                'type'          => 'text',
	));
        
        // Contacts background color
	$wp_customize->add_setting( 'skdom_contacts_bgcolor', array(
		'default'           => 'rgba(21, 15, 10, 0.85)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_contacts_bgcolor',
			array(
				'label'    => esc_html__( 'Background color and transparency', 'skdom' ),
				'section'  => 'skdom_contacts_options',
				'priority' => 10,
                                'palette'  => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // Contacts Background Image
        $wp_customize->add_setting( 'skdom_contacts_bgimage', array(
		'default'           => get_template_directory_uri() . '/img/contacts-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_contacts_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_contacts_options',
                'priority' => 20,
	)));
        
        // Contacts Cols in row
        $wp_customize->add_setting( 'skdom_contacts_col', array(
                'default'           => 3,
		'sanitize_callback' => 'skdom_sanitize_number_absint',
	) );
        
        $wp_customize->add_control( 'skdom_contacts_col', array(
		'label'         => esc_html__( 'Number of Columns in row', 'skdom' ),
                'description'   => esc_html__( '(For best expirience recommended 3 or 4)', 'skdom' ),
		'section'       => 'skdom_contacts_options',
		'priority'      => 30,
                'type'          => 'number',
	));
        
        /**
	 * Contacts Content
	 */
        $wp_customize->add_section( 'skdom_contacts_content' , array(
		'title'		  => esc_html__( 'Section Content', 'skdom' ),
		'priority'	  => 20,
                'panel'           => 'skdom_contacts_panel',
	) );
        
        // Contacts Title
        $wp_customize->add_setting( 'skdom_contacts_title', array(
                'default'           => esc_html__( 'Надеемся на успешное сотрудничество', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_contacts_title', array(
		'label'         => esc_html__( 'Title', 'skdom' ),
		'section'       => 'skdom_contacts_content',
		'priority'      => 10,
                'type'          => 'text',
	));
        
        // Contacts Content
        $default = skdom_contacts_get_default_content();
	$wp_customize->add_setting( 'skdom_contacts_content', array(
		'sanitize_callback' => 'skdom_sanitize_repeater',
		'default'           => $default,
	) );

	$wp_customize->add_control( new Skdom_General_Repeater( $wp_customize, 'skdom_contacts_content', array(
		'label'    => esc_html__( 'Add new block','skdom' ),
		'section'  => 'skdom_contacts_content',
		'priority' => 20,
		'skdom_icon_control'  => true,
		'skdom_title_control' => true,
		'skdom_text_control'  => true,
                'skdom_link_control'  => true,
	) ) );
        
        /**
	 * Footer Panel
	 */
        $wp_customize->add_panel( 'skdom_footer_panel' , array(
		'title'	      => esc_html__( 'Footer Section', 'skdom' ),
                'capability'  => 'edit_theme_options',
		'priority'    => 80,
                'description' => esc_html__( 'The main content of this section is customizable in: Customize -> Widgets -> Footer area. ', 'skdom' ),
	) );
        
        /**
	 * Footer Options
	 */
        $wp_customize->add_section( 'skdom_footer_options' , array(
		'title'		  => esc_html__( 'Section Options', 'skdom' ),
		'priority'	  => 10,
                'panel'           => 'skdom_footer_panel',
	) );
        
        // Footer background color
	$wp_customize->add_setting( 'skdom_footer_bgcolor', array(
		'default'           => 'rgba(21, 15, 10, 0.9)',
		'sanitize_callback' => 'skdom_sanitize_rgba',
                'transport'	    => 'postMessage',
                'type'		    => 'theme_mod',
	));

	$wp_customize->add_control(
		new Customize_Alpha_Color_Control(
			$wp_customize,
			'skdom_footer_bgcolor',
			array(
				'label'    => esc_html__( 'Background color and transparency', 'skdom' ),
				'section'  => 'skdom_footer_options',
				'priority' => 10,
                                'palette'  => array(
                                    '#150f0a',
                                    '#fefefe',
                                    '#df312c',
                                    '#52412f',
                                    '#eef000',
                                    '#018b58',
                                    '#1571c1',
                                    '#8309e7'
                                ),
			)
		)
	);
        
        // Footer Background Image
        $wp_customize->add_setting( 'skdom_footer_bgimage', array(
            'default'           => get_template_directory_uri() . '/img/footer-bg.jpg',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_footer_bgimage', array(
	      	'label'    => esc_html__( 'Background Image', 'skdom' ),
	      	'section'  => 'skdom_footer_options',
                'priority' => 20,
	)));
        
        /**
	 * Footer Content
	 */
        $wp_customize->add_section( 'skdom_footer_content' , array(
		'title'		  => esc_html__( 'Footer Content', 'skdom' ),
		'priority'	  => 20,
                'panel'           => 'skdom_footer_panel',
	) );
        
        // Footer Logo
        $wp_customize->add_setting( 'skdom_footer_logo', array(
		'default'           => get_template_directory_uri() . '/img/logo-nav.png',
		'sanitize_callback' => 'esc_url',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'skdom_footer_logo', array(
	      	'label'    => esc_html__( 'Footer Logo', 'skdom' ),
	      	'section'  => 'skdom_footer_content',
                'priority' => 20,
	)));
        
        // Footer Copyrights
        $wp_customize->add_setting( 'skdom_footer_copyrights', array(
                'default'           => __( '<span>"СК ДОМ"</span>, г.Сыктывкар', 'skdom' ),
		'sanitize_callback' => 'skdom_sanitize_input',
                'transport'	    => 'postMessage',
	) );
        
        $wp_customize->add_control( 'skdom_footer_copyrights', array(
		'label'         => esc_html__( 'Copyrights', 'skdom' ),
                'description'   => esc_html__( 'Wrap in SPAN Tag (<span>"Word"</span>) for colorize "Word"', 'skdom' ),
		'section'       => 'skdom_footer_content',
		'priority'      => 30,
                'type'          => 'text',
	));
}
add_action( 'customize_register', 'skdom_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function skdom_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function skdom_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function skdom_customize_preview_js() {
	wp_enqueue_script( 'skdom-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'skdom_customize_preview_js' );

if ( ! function_exists( 'skdom_sanitize_input' ) ) {

	/**
	 * Sanitize variables to allow HTML tags
	 *
	 * @param string $input Text to sanitize.
	 */
	function skdom_sanitize_input( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
}

/**
 * Sanitize checkboxes
 *
 * @param bool $input Value of checkbox to be sanitize.
 */
function skdom_sanitize_checkbox( $input ) {
    return ( isset( $input ) && true == $input ? true : false );
}

/**
 * Sanitize Header Mod option:
 * If something goes wrong and one of the two specified options are not used,
 * apply the default (intelligent).
 */
function skdom_sanitize_header_mod( $value ) {
    if ( ! in_array( $value, array( 'intelligent', 'fixed' ) ) ) {
        $value = 'intelligent';
	}
    return $value;
}

/**
 * Sanitize Gallery lightbox mod:
 * If something goes wrong and one of the two specified options are not used,
 * apply the default (intelligent).
 */
function skdom_sanitize_lightbox_mod( $value ) {
    if ( ! in_array( $value, array( 'gallery', 'image' ) ) ) {
        $value = 'gallery';
	}
    return $value;
}

/**
 * Sanitize FAQ option:
 * If something goes wrong and one of the two specified options are not used,
 * apply the default (open).
 */
function skdom_sanitize_faq_mod( $value ) {
    if ( ! in_array( $value, array( 'toggle', 'each' ) ) ) {
        $value = 'toggle';
	}
    return $value;
}

/**
 * Sanitize CTA attachment image option:
 * If something goes wrong and one of the two specified options are not used,
 * apply the default (open).
 */
function skdom_sanitize_attachment_mod( $value ) {
    if ( ! in_array( $value, array( 'fixed', 'normal' ) ) ) {
        $value = 'fixed';
	}
    return $value;
}

/**
 * Sanitize RGBA colors
 *
 * @param string $value Color to sanitize.
 */
function skdom_sanitize_rgba( $value ) {
	// If empty or an array return transparent
	if ( empty( $value ) || is_array( $value ) ) {
		return 'rgba(0,0,0,0)';
	}
	$value = str_replace( ' ', '', $value );
	if ( substr( $value, 0, 4 ) == 'rgba' ) {
		sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
	}
	return sanitize_hex_color( $value );
}

/**
 * Sanitize Number
 */
function skdom_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}

/* Include customizer Custom Styles */
require_once get_template_directory() . '/inc/custom-styles.php';

if ( ! function_exists( 'skdom_is_front_page' ) ) {

	/**
	 * Check if the current page is frontpage
	 */
	function skdom_is_front_page() {
		if ( 'posts' == get_option( 'show_on_front' ) && is_front_page() ) {
			return true;
		}
		return false;
	}
}