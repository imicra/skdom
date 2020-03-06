<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skdom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
        $skdom_loader = get_theme_mod( 'skdom_loader', true );
        
        if ( isset( $skdom_loader ) && ($skdom_loader == 1) ) {
            if ( is_front_page() ) : ?>
                    <div class="loader">
                            <div class="loader-inner ball-scale-multiple">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                            </div>
                    </div>
            <?php endif; // End preloader. 
        }
?>

<?php 
    $skdom_header_mod = get_theme_mod( 'skdom_header_mod', 'intelligent' );
    
    if( 'intelligent' != $skdom_header_mod ) {
        $header_mod = '';
    } else {
        $header_mod = 'header-mod';
    }
?>
<header class="nav container-fluid <?php if ( ! empty( $header_mod ) ) {echo esc_attr( $header_mod );} ?>">
        <div class="menu-button">
                <span></span>
                <span></span>
                <span></span>
        </div>
        <?php
                $skdom_logo = get_theme_mod( 'skdom_logo', get_template_directory_uri() . '/img/logo-nav.png' );
                
                if( 'posts' == get_option( 'show_on_front' ) && is_front_page() ) {
                    $skdom_url = '#home';
                    $anchor = 'data-anchor="#home"';
                } else {
                    $skdom_url = esc_url( home_url( '/' ) );
                }
                
                if ( ! empty( $skdom_logo ) ) { ?>
                        <a href="<?php echo $skdom_url; ?>"<?php if ( ! empty( $anchor ) ) {  echo $anchor; } ?> class="logo-nav">
                                <?php echo '<img src="' . esc_url( $skdom_logo ) . '" alt="' . get_bloginfo( 'title' ) . '">'; ?>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-nav-opt skdom_only_customizer">
                                <?php echo '<h1 class="site-title">'. get_bloginfo( 'name' ) .'</h1>'; ?>
                        </a>
                <?php } else { 
                            if ( is_customize_preview() ) : ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-nav skdom_only_customizer">
                                        <?php echo '<img src="" alt="' . get_bloginfo( 'title' ) . '">'; ?>
                                </a>
                            <?php endif; ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-nav-opt">
                                <?php echo '<h1 class="site-title">'. get_bloginfo( 'name' ) .'</h1>'; ?>
                        </a>
                <?php }
        ?>
        <?php
                $default = skdom_header_contacts_get_default_content();
                $skdom_header_contacts = get_theme_mod( 'skdom_header_contacts', $default );
        
                if ( ! skdom_general_repeater_is_empty( $skdom_header_contacts ) ) {
        ?>
        <?php if ( ! empty( $skdom_header_contacts ) ) { 
            $skdom_header_contacts_decoded = json_decode( $skdom_header_contacts ); ?>
        <div class="contacts-nav row">
                <?php
                
                    $skdom_mobile_ico = get_theme_mod( 'skdom_mobile_contacts_ico', 'fa-phone' );
                    $mobile = skdom_mobile_contacts_get_default_content();
                    $skdom_mobile_contacts = get_theme_mod( 'skdom_mobile_contacts', $mobile );
                    
                    if ( ! empty( $skdom_mobile_contacts ) ) {
                        $skdom_mobile_contacts_decoded = json_decode( $skdom_mobile_contacts );
                ?>
                    <div class="contacts-popup">
                            <i class="fa <?php echo esc_attr( $skdom_mobile_ico ); ?>"></i>
                            <div class="contacts-menu">
                                <?php
                                    foreach ( $skdom_mobile_contacts_decoded as $skdom_popup_box ) {
                                        $title = ! empty( $skdom_popup_box->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_popup_box->title, 'Header Content' ) : '';
                                        $subtitle = ! empty( $skdom_popup_box->subtitle ) ? apply_filters( 'skdom_translate_single_string', $skdom_popup_box->subtitle, 'Header Content' ) : '';
                                        $section_is_empty = empty( $title ) && empty( $subtitle );
                                        
                                        if ( ! $section_is_empty ) { ?>
                                            <?php if ( ! empty( $title ) ) { ?>
                                                <span><?php echo wp_kses_post( $title ); ?></span>
                                            <?php } ?>
                                            <?php if ( ! empty( $subtitle ) ) { ?>
                                                <span><?php echo wp_kses_post( $subtitle ); ?></span>
                                            <?php } ?>
                                <?php
                                        } // End if().
                                    } // End foreach(). 
                                ?>
                            </div>
                    </div>
                <?php
                    } // End if().
                ?>
                <?php 
                    foreach ( $skdom_header_contacts_decoded as $skdom_contact_box ) {
                        $icon  = ! empty( $skdom_contact_box->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_contact_box->icon_value, 'Header Content' ) : '';
                        $title = ! empty( $skdom_contact_box->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_contact_box->title, 'Header Content' ) : '';
                        $text = ! empty( $skdom_contact_box->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_contact_box->text, 'Header Content' ) : '';
                        $link = ! empty( $skdom_contact_box->link ) ? apply_filters( 'skdom_translate_single_string', $skdom_contact_box->link, 'Header Content' ) : '';
                        $section_is_empty = ( empty( $icon ) ) && empty( $title ) && empty( $text );
                
                        if ( ! $section_is_empty ) { ?>
                            <dl>
                                <?php if ( ! empty( $icon ) ) { ?>
                                    <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                                <?php } ?>
                                <?php if ( ! empty( $title ) ) { ?>
                                    <dt><?php echo wp_kses_post( $title ); ?></dt>
                                <?php } ?>
                                <?php if ( ! empty( $text ) ) {
                                    if ( ! empty( $link ) ) { ?>
                                        <dd>
                                            <a href="<?php echo esc_attr( $link ); ?>"><?php echo html_entity_decode( $text ); ?></a>
                                        </dd>
                                    <?php } else { ?>
                                            <dd><?php echo html_entity_decode( $text ); ?></dd>
                                        <?php } 
                                    } ?>
                            </dl>
                <?php
                        } // End if().
                    } // End foreach(). 
                ?>
        </div>
        <?php } // End if() skdom_header_contacts. ?>
        <?php } else {
            if ( is_customize_preview() ) {
                // code
            }
        } // End if() ?>
        <nav class="main-navigation row">
                <div class="menu-header">
                        <div class="logo">
                        <?php
                                if ( ! empty( $skdom_logo ) ) {
                                        echo '<img src="'. esc_url( $skdom_logo ) .'" alt="' . get_bloginfo( 'title' ) . '">';
                                        echo '<h4 class="site-title skdom_only_customizer">'. get_bloginfo( 'name' ) .'</h4>';
                                } else {
                                        if ( is_customize_preview() ) :
                                            echo '<img src="'. esc_url( $skdom_logo ) .'" alt="' . get_bloginfo( 'title' ) . '" class="skdom_only_customizer">';
                                        endif;
                                        echo '<h4 class="site-title">'. get_bloginfo( 'name' ) .'</h4>';
                                }
                        ?>
                        </div>
                        <div class="close-menu">
                                <span></span>
                                <span></span>
                        </div>
                </div>
                <?php
                    wp_nav_menu( array(
                                'container'      => false,
                                'theme_location' => 'primary',
                                'menu_class'     => 'nav-menu',
                                'fallback_cb'    => 'skdom_default_menu',
                                'walker'         => new Skdom_Walker_Nav_Menu
                        ) );
                ?>
        </nav>
        <div class="close-header-layer"></div>
</header>
