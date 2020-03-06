<?php
/**
 * skdom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package skdom
 */

if ( ! function_exists( 'skdom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function skdom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on skdom, use a find and replace
		 * to change 'skdom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'skdom', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
                // Add testimonial image size
                add_image_size( 'skdom-testimonial', 100, 100, true );
                // Add portfolio image size
                add_image_size( 'skdom-galley-thumb', 645, 389, true );
                // Add services image size
                add_image_size( 'skdom-services-thumb', 90, 120, true );
                // Add footer logo size
                add_image_size( 'skdom-footer-logo', 9999, 50, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Header', 'skdom' ),
                        'footer' => esc_html__( 'Footer Nav Menu', 'skdom' ),
                        'social' => esc_html__( 'Social Media Menu', 'skdom' ),
		) );
                
                /**
                 * class="active" in Nav Menu.
                 */
                function active_class ($classes, $item) {
                        if (in_array('current-menu-item', $classes) ){
                                $classes[] = 'active';
                        }
                        return $classes;
                }
                add_filter('nav_menu_css_class' , 'active_class' , 10 , 2);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'skdom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'skdom_setup' );

/**
 * This function allows modification of the list of image sizes that are available to administrators in the WordPress.
 *
 * @param array $sizes Array of image sizes.
 *
 * @return array
 */
function skdom_media_uploader_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'skdom-testimonial'    => esc_html__( 'Testimonials','skdom' ),
		'skdom-galley-thumb'   => esc_html__( 'Portfolio','skdom' ),
                'skdom-services-thumb' => esc_html__( 'Services','skdom' ),
                'skdom-footer-logo'    => esc_html__( 'Footer Logo','skdom' ),
	) );
}
add_filter( 'image_size_names_choose', 'skdom_media_uploader_custom_sizes' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for Portfolio post thumbnails.
 * for minimum two images in row.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function skdom_portfolio_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( ( 'portfolio' == get_post_type() ) ) {
                $attr['sizes'] = '(min-width: 768px) 428px, 90vw';
        }

	return $attr;
}
//add_filter( 'wp_get_attachment_image_attributes', 'skdom_portfolio_thumbnail_sizes_attr', 10, 3 );

/**
 * Enqueue scripts for customizer.
 */
function skdom_customizer_scripts() {

	wp_enqueue_script( 'skdom_customizer_script', get_template_directory_uri() . '/js/skdom_customizer.js', array( 'jquery' ), '1.0.0', true );

}
add_action( 'customize_controls_enqueue_scripts', 'skdom_customizer_scripts' );

/**
 * Register custom fonts.
 */
function skdom_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'skdom' );

	if ( 'off' !== $open_sans ) {
		$font_families = array();

		$font_families[] = 'Open Sans:300,400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function skdom_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'skdom-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'skdom_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function skdom_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'skdom_content_width', 640 );
}
add_action( 'after_setup_theme', 'skdom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function skdom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'skdom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'skdom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        
        register_sidebars( 3, array(
                /* translators: %d is widget area id */
		'name'          => esc_html__( 'Footer area %d', 'skdom' ),
		'id'            => 'footer-area',
		'description'   => esc_html__( 'Add widgets here.', 'skdom' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'skdom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function skdom_scripts() {
        //Bootstrap 3 - grid only
        wp_enqueue_style( 'skdom-bootstrap-style', get_template_directory_uri() . '/css/bootstrap-grid.min.css' );
        
        //Main Fonts - "Open Sans"
//        wp_enqueue_style( 'skdom-fonts', get_template_directory_uri() . '/css/fonts.css' );
        wp_enqueue_style( 'skdom-fonts', skdom_fonts_url(), array(), null );
        
        //Main Styles
	wp_enqueue_style( 'skdom-style', get_stylesheet_uri() );
        
        //Opt Styles
	wp_enqueue_style( 'skdom-opt', get_template_directory_uri() . '/css/theme-opt.css' );
        
        //Loaders pack - for preloader
        if ( 'posts' == get_option( 'show_on_front' ) && is_front_page() ) {            
            wp_enqueue_style( 'skdom-loaders', get_template_directory_uri() . '/css/loaders.css' );            
        }
        
        //Swiper - from plugin
        wp_enqueue_style( 'skdom-swiper-css', get_template_directory_uri() . '/css/swiper.min.css' );
        
        //Fancybox - from plugin
        wp_enqueue_style( 'skdom-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
        
        //Animate - with WOW plugin
        if ( 'posts' == get_option( 'show_on_front' ) && is_front_page() ) {            
            wp_enqueue_style( 'skdom-animate', get_template_directory_uri() . '/css/animate.css' );          
        }
        
        //Font-Awesome
        wp_enqueue_style( 'skdom-font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );
        
        //Theme's Icon Font
        wp_enqueue_style( 'skdom-font-construct', get_template_directory_uri() . '/fonts/construct/css/construct.css' );
        
        //Elegant-Font
        wp_enqueue_style( 'skdom-font-elegant', get_template_directory_uri() . '/fonts/elegant-font/css/style.css' );
        
        //WOW Plugin
        $skdom_wow = get_theme_mod( 'skdom_wow', true );
        if ( ! empty( $skdom_wow ) && ( (bool) $skdom_wow === true ) && 'posts' == get_option( 'show_on_front' ) && is_front_page() ) {          
            wp_enqueue_script( 'skdom-wow', get_template_directory_uri() . '/js/wow.min.js', array(), '1.1.3', true );
        }
        
        //Swiper Plugin
        wp_enqueue_script( 'skdom-swiper', get_template_directory_uri() . '/js/swiper.min.js', array(), '3.4.2', true );
        
        //Fancybox Plugin - for Gallery
        wp_enqueue_script( 'skdom-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array(), '2.1.5', true );
        
        //Stellar Plugin - for Parallax Effect
        $skdom_parallax = get_theme_mod( 'skdom_parallax', true );
        if ( ! empty( $skdom_parallax ) && ( (bool) $skdom_parallax === true ) && 'posts' == get_option( 'show_on_front' ) && is_front_page() ) {           
            wp_enqueue_script( 'skdom-stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array(), '0.6.2', true );
            wp_enqueue_script( 'skdom-custom-stellar', get_template_directory_uri() . '/js/custom-stellar.js', array( 'jquery' ), true );   
        }
        
        //Main Scripts
        wp_enqueue_script( 'skdom-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0.0', true );
        
	wp_enqueue_script( 'skdom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'skdom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skdom_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Walker Class for Nav-Menu.
 */
require get_template_directory() . '/inc/custom-walker-nav-menu.php';

/**
 * Nav-Menu fallback.
 */
require get_template_directory() . '/inc/demo-content/nav-menu-fallback.php';

/**
 * Translations.
 */
require get_template_directory() . '/inc/translations/general.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/cpt/general.php';

/**
 * Load SVG icon functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Define and register starter content.
 */
require get_template_directory() . '/inc/starter-content.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

