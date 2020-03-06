<?php
/* 
 * Customizer Custom Styles
 */

if ( ! function_exists( 'skdom_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see skdom_custom_header_setup().
	 */
	function skdom_header_style() {
		$header_text_color = get_header_textcolor();
                $header_bg_color = get_theme_mod( 'theme_bg_color' );
                $section_bg_color = get_theme_mod( 'section_bg_color' );
                $titles_colors = get_theme_mod( 'titles_colors' );
                $skdom_header_bar_color = get_theme_mod( 'skdom_header_bar_color' );
                $skdom_mobile_nav_color = get_theme_mod( 'skdom_mobile_nav_color' );
                $skdom_mobile_nav_overlay = get_theme_mod( 'skdom_mobile_nav_overlay' );
                $skdom_promo_overlay = get_theme_mod( 'skdom_promo_overlay' );
                $skdom_gallery_bgcolor = get_theme_mod( 'skdom_gallery_bgcolor' );
                $skdom_cta_bgcolor = get_theme_mod( 'skdom_cta_bgcolor' );
                $skdom_cta_border = get_theme_mod( 'skdom_cta_border' );
                $skdom_testimonials_bgcolor = get_theme_mod( 'skdom_testimonials_bgcolor' );
                $skdom_contacts_bgcolor = get_theme_mod( 'skdom_contacts_bgcolor' );
                $skdom_footer_bgcolor = get_theme_mod( 'skdom_footer_bgcolor' );

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) != $header_text_color ) {

                    // If we get this far, we have custom styles. Let's do this.
                    ?>
                    <style type="text/css">
                    <?php
                    // Has the text been hidden?
                    if ( ! display_header_text() ) :
                    ?>
                            .site-title,
                            .site-description {
                                    position: absolute;
                                    clip: rect(1px, 1px, 1px, 1px);
                            }
                    <?php
                            // If the user has set a custom color for the text use that.
                            else :
                    ?>
                            .site-title,
                            .site-description {
                                    color: #<?php echo esc_attr( $header_text_color ); ?>;
                            }
                    <?php endif; ?>
                            header.nav, 
                            header.nav a,
                            .header-slide h1, 
                            .button, 
                            .header-slide 
                            .block-header {
                                    color: #<?php echo esc_attr( $header_text_color ); ?>;
                            }
                            
                            .contacts-nav .contacts-popup .contacts-menu,
                            .menu-button span,
                            .main-navigation .menu-header .close-menu span {
                                    background-color: #<?php echo esc_attr( $header_text_color ); ?>;
                            }
                    </style>
                    <?php
                }
                
                /*
                 * Do we have a custom header background color?
                 */
                if ( '#1a1c27' != $header_bg_color ) { ?>
                        <style type="text/css">
                                .header-slide,
                                .site-footer .site-info {
                                        background-color: <?php echo esc_attr( $header_bg_color ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Section background color
                 */
                if ( '#f9fafb' != $section_bg_color ) { ?>
                        <style type="text/css">
                                .section-bg {
                                        background-color: <?php echo esc_attr( $section_bg_color ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Header colors
                 */
                if ( '#2f353f' != $titles_colors ) { ?>
                        <style type="text/css">
                                .section h1, .section h2, .section h3, .section h4, .section h5, .section h6,
                                .site-title,
                                .main-navigation ul li ul li a:hover,
                                #about .block-icon:hover,
                                .workflow-text p,
                                .accordion-header a,
                                .rect-block, .rect-block .block-icon__inner h4, 
                                .contacts-nav .contacts-popup .contacts-menu {
                                        color: <?php echo esc_attr( $titles_colors ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Header bar color
                 */
                if ( 'rgba(34, 34, 34, 0.95)' != $skdom_header_bar_color ) { ?>
                        <style type="text/css">
                                header.nav.bg-nav {
                                        background-color: <?php echo esc_attr( $skdom_header_bar_color ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Mobile Navigation color
                 */
                if ( '#222' != $skdom_mobile_nav_color ) { ?>
                        <style type="text/css">
                            @media screen and (max-width: 1024px) {
                                .main-navigation {
                                        background-color: <?php echo esc_attr( $skdom_mobile_nav_color ); ?>;
                                }
                            }
                        </style>
                <?php
                }
                
                /*
                 * Mobile Navigation Overlay
                 */
                if ( 'rgba(0, 0, 0, 0.5)' != $skdom_mobile_nav_overlay ) { ?>
                        <style type="text/css">
                                .close-header-layer {
                                        background-color: <?php echo esc_attr( $skdom_mobile_nav_overlay ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Promo Block Overlay color
                 */
                if ( 'rgba(82, 65, 47, 0.7)' != $skdom_promo_overlay ) { ?>
                        <style type="text/css">
                                #promo .overlay {
                                        background-color: <?php echo esc_attr( $skdom_promo_overlay ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Gallery background color
                 */
                if ( 'rgba(252, 249, 239, 0.9)' != $skdom_gallery_bgcolor ) { ?>
                        <style type="text/css">
                                #gallery .overlay {
                                        background-color: <?php echo esc_attr( $skdom_gallery_bgcolor ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * CTA background color
                 */
                if ( 'rgba(82, 65, 47, 0.9)' != $skdom_cta_bgcolor ) { ?>
                        <style type="text/css">
                                #cta .overlay,
                                .cta-phone .block-border .triangle-down span:nth-child(1) {
                                        background-color: <?php echo esc_attr( $skdom_cta_bgcolor ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * CTA Border
                 */
                if ( true !== $skdom_cta_border ) { ?>
                        <style type="text/css">
                                .cta-phone .block-border {
                                        border: none;
                                        padding-top: 0;
                                        padding-bottom: 0;
                                }
                                .cta-phone .block-border .triangle-down {
                                    display: none;
                                }
                        </style>
                <?php
                } else { ?>
                    <style type="text/css">
                            .cta-phone .block-border {
                                    border: 4px solid #58b32b;
                                    padding-top: 20px;
                                    padding-bottom: 10px;
                            }
                            @media screen and (min-width: 768px) {
                                .cta-phone .block-border {
                                        padding-top: 50px;
                                        padding-bottom: 40px;
                                }
                            }
                            .cta-phone .block-border .triangle-down {
                                display: block;
                            }
                    </style>
                <?php
                }
                
                /*
                 * Testimonials background color
                 */
                if ( 'rgba(21, 15, 10, 0.85)' != $skdom_testimonials_bgcolor ) { ?>
                        <style type="text/css">
                                #testimonials .overlay {
                                        background-color: <?php echo esc_attr( $skdom_testimonials_bgcolor ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Contacts background color
                 */
                if ( 'rgba(21, 15, 10, 0.85)' != $skdom_contacts_bgcolor ) { ?>
                        <style type="text/css">
                                #contacts .overlay {
                                        background-color: <?php echo esc_attr( $skdom_contacts_bgcolor ); ?>;
                                }
                        </style>
                <?php
                }
                
                /*
                 * Footer background color
                 */
                if ( 'rgba(21, 15, 10, 0.9)' != $skdom_footer_bgcolor ) { ?>
                        <style type="text/css">
                                .site-footer_wrap .overlay {
                                        background-color: <?php echo esc_attr( $skdom_footer_bgcolor ); ?>;
                                }
                        </style>
                <?php
                }
	}
endif;