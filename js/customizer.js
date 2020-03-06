/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title, .site-description' ).css( {
					'color': to
				} );
			}
                        $( 'header.nav, header.nav a, .header-slide h1, .button, .header-slide .block-header' ).css( {
				'color': to
			} );
                        $( '.contacts-nav .contacts-popup .contacts-menu, .menu-button span, .main-navigation .menu-header .close-menu span' ).css( {
                                'background-color': to
                        } );
		} );
	} );
        
        // Background color for header and footer.
	wp.customize( 'theme_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.header-slide, .site-footer .site-info' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Section background color.
	wp.customize( 'section_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.section-bg' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Header colors.
	wp.customize( 'titles_colors', function( value ) {
		value.bind( function( to ) {
			$( '.section h1, .section h2, .section h3, .section h4, .section h5, .section h6, .site-title, .main-navigation ul li ul li a:hover, #about .block-icon:hover, .workflow-text p, .accordion-header a, .rect-block, .rect-block .block-icon__inner h4, .contacts-nav .contacts-popup .contacts-menu' ).css( {
				'color': to
			} );
		} );
	} );
        
        // Logo SK Dom theme.
	wp.customize( 'skdom_logo', function( value ) {
		value.bind( function( to ) {
                        if( to !== '' ) {
                                    $( '.logo-nav' ).removeClass( 'skdom_only_customizer' );
                                    $( '.logo-nav-opt' ).addClass( 'skdom_only_customizer' );
                                    $( '.main-navigation .menu-header .logo img' ).removeClass( 'skdom_only_customizer' );
                                    $( '.site-title' ).addClass( 'skdom_only_customizer' );
                            }
			else {
				$( '.logo-nav' ).addClass( 'skdom_only_customizer' );
				$( '.logo-nav-opt' ).removeClass( 'skdom_only_customizer' );
                                $( '.main-navigation .menu-header .logo img' ).addClass( 'skdom_only_customizer' );
                                $( '.site-title' ).removeClass( 'skdom_only_customizer' );
			}
                    
			$('.logo-nav img').attr( 'src', to );
                        $('.main-navigation .menu-header .logo img').attr( 'src', to );
		} );
	} );
        
        /**
         * Options.
         */
        // Header Mod.
	wp.customize( 'skdom_header_mod', function( value ) {
		value.bind( function( to ) {
                        if( to !== 'intelligent' ) {
                            menuFun.fixed_menu();
                        } else {
                            menuFun.intelligent_menu();
                        }
		} );
	} );
        
        /**
         * Header.
         */
        // Header color.
	wp.customize( 'skdom_header_bar_color', function( value ) {
		value.bind( function( to ) {
                        $( 'header.nav.bg-nav' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Mobile Navigation color.
	wp.customize( 'skdom_mobile_nav_color', function( value ) {
		value.bind( function( to ) {
                        $( '.main-navigation' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Mobile Navigation Overlay.
	wp.customize( 'skdom_mobile_nav_overlay', function( value ) {
		value.bind( function( to ) {
                        $( '.close-header-layer' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Mobile contacts icon
        wp.customize( 'skdom_mobile_contacts_ico', function( value ) {
		value.bind( function( to ) {
                        $('.contacts-popup i').attr( 'class', 'fa' );
                        $('.contacts-popup i').addClass( to );
		} );
	} );
        
        // Site Name
        wp.customize( 'skdom_site_name', function( value ) {
		value.bind( function( to ) {
                        $('.header-slide h1').text( to );
		} );
	} );
        
        // Site Description
        wp.customize( 'skdom_site_description', function( value ) {
		value.bind( function( to ) {
                        $('.header-slide p').text( to );
		} );
	} );
        
        // Button 1 CTA text
        wp.customize( 'skdom_button_1_name', function( value ) {
		value.bind( function( to ) {
                        $('.header-slide .button.style-1').text( to );
                        
                        if ( to === '' ) {
                            $( '.header-slide .button.style-1' ).css( 'display', 'none' );
                        } else {
                            $( '.header-slide .button.style-1' ).css( 'display', 'inline-block' );
                        }
		} );
	} );
        
        // Button 1 Link to Section
        wp.customize( 'skdom_button_1_section', function( value ) {
		value.bind( function( to ) {
                        if( to.charAt(0) === '#' && to.charAt(1) !== '' ) {
                            $( '.header-slide .button.style-1' ).removeAttr('onClick');
                            $( '.header-slide .button.style-1' ).attr( 'href', to );
                            $( '.header-slide .button.style-1' ).attr( 'data-anchor', to );
                        } else {
                            $( '.header-slide .button.style-1' ).removeAttr('data-anchor');
                            $( '.header-slide .button.style-1' ).attr( 'onClick', 'return false' );
                        }
		} );
	} );
        
        // Button 2 CTA text
        wp.customize( 'skdom_button_2_name', function( value ) {
		value.bind( function( to ) {
                        $('.header-slide .button.style-2').text( to );
                        
                        if ( to === '' ) {
                            $( '.header-slide .button.style-2' ).css( 'display', 'none' );
                        } else {
                            $( '.header-slide .button.style-2' ).css( 'display', 'inline-block' );
                        }
		} );
	} );
        
        // Button 2 Link to Section
        wp.customize( 'skdom_button_2_section', function( value ) {
		value.bind( function( to ) {
                        if( to.charAt(0) === '#' && to.charAt(1) !== '' ) {
                            $( '.header-slide .button.style-2' ).removeAttr('onClick');
                            $( '.header-slide .button.style-2' ).attr( 'href', to );
                            $( '.header-slide .button.style-2' ).attr( 'data-anchor', to );
                        } else {
                            $( '.header-slide .button.style-2' ).removeAttr('data-anchor');
                            $( '.header-slide .button.style-2' ).attr( 'onClick', 'return false' );
                        }
		} );
	} );
        
        /**
         * About.
         */
        // About Title
        wp.customize( 'skdom_about_title', function( value ) {
		value.bind( function( to ) {
                        $('#about .section-heading h2').text( to );
                        
                        if ( to === '' ) {
                            $('#about .section-heading .line-short').css( 'display', 'none' );
                        } else {
                            $('#about .section-heading .line-short').css( 'display', 'block' );
                        }
		} );
	} );
        
        // About Subtitle
        wp.customize( 'skdom_about_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('#about .section-heading p').text( to );
		} );
	} );
        
        /**
         * Promo.
         */
        // Promo Background Image.
	wp.customize( 'skdom_promo_bgimage', function( value ) {
		value.bind( function( to ) {
			$('#promo').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // Promo Title
        wp.customize( 'skdom_promo_title', function( value ) {
		value.bind( function( to ) {
                        $('#promo .section-heading h2').text( to );
		} );
	} );
        
        // Promo Subtitle
        wp.customize( 'skdom_promo_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('#promo .section-heading p').text( to );
		} );
	} );
        
        // Promo Overlay.
	wp.customize( 'skdom_promo_overlay', function( value ) {
		value.bind( function( to ) {
                        $( '#promo .overlay' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        /**
         * Gallery.
         */
        // Gallery Link to portfolio item
        wp.customize( 'skdom_gallery_item', function( value ) {
		value.bind( function( to ) {
                    if ( true !== to ) {
                        $( '.portfolio-item .desc' ).css( 'display', 'none' );
                        $( '.image-links.double a' ).css( 'width', '100%' );
                        $( '.image-links.double a:last-child' ).css( 'display', 'none' );
                    } else {
                        $( '.portfolio-item .desc' ).css( 'display', 'block' );
                        $( '.image-links.double a' ).css( 'width', '50%' );
                        $( '.image-links.double a:last-child' ).css( 'display', 'block' );
                    }
		} );
	} );
        
        // Gallery Background Image.
	wp.customize( 'skdom_gallery_bgimage', function( value ) {
		value.bind( function( to ) {
			$('#gallery .bg-image').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // Gallery Title
        wp.customize( 'skdom_gallery_title', function( value ) {
		value.bind( function( to ) {
                        $('#gallery .section-heading h2').text( to );
                        
                        if ( to === '' ) {
                            $('#gallery .section-heading .line-short').css( 'display', 'none' );
                        } else {
                            $('#gallery .section-heading .line-short').css( 'display', 'block' );
                        }
		} );
	} );
        
        // Gallery Subtitle
        wp.customize( 'skdom_gallery_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('#gallery .section-heading p').text( to );
		} );
	} );
        
        // Gallery Button text
        wp.customize( 'skdom_gallery_button', function( value ) {
		value.bind( function( to ) {
                        $('#gallery .button h4').text( to );
                        
                        if ( to === '' ) {
                            $( '#gallery .button' ).css( 'display', 'none' );
                        } else {
                            $( '#gallery .button' ).css( 'display', 'block' );
                        }
		} );
	} );
        
        // Gallery background color.
	wp.customize( 'skdom_gallery_bgcolor', function( value ) {
		value.bind( function( to ) {
                        $( '#gallery .overlay' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        /**
	 * Featured Section Overview
	 */
        // Featured Section Title
        wp.customize( 'skdom_featured_title', function( value ) {
		value.bind( function( to ) {
                        $('#featured .section-heading h2').text( to );
                        
                        if ( to === '' ) {
                            $('#featured .section-heading .line-short').css( 'display', 'none' );
                        } else {
                            $('#featured .section-heading .line-short').css( 'display', 'block' );
                        }
		} );
	} );
        
        // Featured Section Subtitle
        wp.customize( 'skdom_featured_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('#featured .section-heading p').text( to );
		} );
	} );
        
        /**
	 * Featured Section One
	 */
        // Featured Section One Image.
	wp.customize( 'skdom_featured_one_image', function( value ) {
		value.bind( function( to ) {
			$('.bigimg-left img').attr( 'src', to );
                        
                        if ( to === '' ) {
                            $( '.bigimg-left .section-image' ).css( 'display', 'none' );
                            if($(window).width() > 768) {
                                $( '.bigimg-left .section-icons' ).addClass( 'interaction' );
                                if ( $( '.bigimg-right .section-icons' ).hasClass( 'interaction' ) ) {
                                    $( '.bigimg-right .section-icons' ).css({
                                        'position': 'absolute',
                                        'bottom': '0',
                                        'right': '0'
                                    });
                                }
                            }
                        } else {
                            $( '.bigimg-left .section-image' ).css( 'display', 'block' );
                            if($(window).width() > 768) {
                                $( '.bigimg-left .section-icons' ).removeClass( 'interaction' );
                                if ( $( '.bigimg-right .section-icons' ).hasClass( 'interaction' ) ) {
                                    $( '.bigimg-right .section-icons' ).css({
                                        'position': 'relative',
                                        'bottom': '',
                                        'right': ''
                                    });
                                }
                            }
                        }
		} );
	} );
        
        // Featured Section One Title
        wp.customize( 'skdom_featured_one_title', function( value ) {
		value.bind( function( to ) {
                        $('.bigimg-left .section-heading h2').text( to );
		} );
	} );
        
        // Featured Section One Subtitle
        wp.customize( 'skdom_featured_one_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('.bigimg-left .section-heading p').text( to );
		} );
	} );
        
        // Featured Section One Button text
        wp.customize( 'skdom_featured_one_button', function( value ) {
		value.bind( function( to ) {
                        $('.bigimg-left .button').text( to );
                        
                        if ( to === '' ) {
                            $( '.bigimg-left .button' ).css( 'display', 'none' );
                        } else {
                            $( '.bigimg-left .button' ).css( 'display', 'inline-block' );
                        }
		} );
	} );
        
        /**
	 * Featured Section Two
	 */
        // Featured Section Two Image.
	wp.customize( 'skdom_featured_two_image', function( value ) {
		value.bind( function( to ) {
			$('.bigimg-right img').attr( 'src', to );
                        
                        if ( to === '' ) {
                            $( '.bigimg-right .section-image' ).css( 'display', 'none' );
                            $( '.bigimg-right .section-icons' ).attr( 'class', 'col-sm-6 section-icons' );
                            if($(window).width() > 768) {
                                $( '.bigimg-right .section-icons' ).addClass( 'interaction' );
                                if ( $( '.bigimg-left .section-icons' ).hasClass( 'interaction' ) ) {
                                    $( '.bigimg-right .section-icons' ).css({
                                        'position': 'absolute',
                                        'bottom': '0',
                                        'right': '0'
                                    });
                                }
                            }
                        } else {
                            $( '.bigimg-right .section-image' ).css( 'display', 'block' );
                            $( '.bigimg-right .section-icons' ).attr( 'class', 'col-sm-6 col-sm-pull-6 section-icons' );
                            if($(window).width() > 768) {
                                $( '.bigimg-right .section-icons' ).removeClass( 'interaction' );
                                $( '.bigimg-right .section-icons' ).css({
                                        'position': 'relative',
                                        'bottom': '',
                                        'right': ''
                                    });
                            }  
                        }
		} );
	} );
        
        // Featured Section Two Title
        wp.customize( 'skdom_featured_two_title', function( value ) {
		value.bind( function( to ) {
                        $('.bigimg-right .section-heading h2').text( to );
		} );
	} );
        
        // Featured Section Two Subtitle
        wp.customize( 'skdom_featured_two_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('.bigimg-right .section-heading p').text( to );
		} );
	} );
        
        // Featured Section Two Button text
        wp.customize( 'skdom_featured_two_button', function( value ) {
		value.bind( function( to ) {
                        $('.bigimg-right .button').text( to );
                        
                        if ( to === '' ) {
                            $( '.bigimg-right .button' ).css( 'display', 'none' );
                        } else {
                            $( '.bigimg-right .button' ).css( 'display', 'inline-block' );
                        }
		} );
	} );
        
        /**
	 * CTA
	 */
        // CTA background color.
	wp.customize( 'skdom_cta_bgcolor', function( value ) {
		value.bind( function( to ) {
                        $( '#cta .overlay, .cta-phone .block-border .triangle-down span:nth-child(1)' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // CTA Background Image.
	wp.customize( 'skdom_cta_bgimage', function( value ) {
		value.bind( function( to ) {
			$('#cta .bg-image').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // CTA Background attachment option
	wp.customize( 'skdom_cta_attachment', function( value ) {
		value.bind( function( to ) {
                        if( to !== 'fixed' ) {
                            $( '#cta .block-bg' ).removeClass( 'parallax-bg' );
                        } else {
                            $( '#cta .block-bg' ).addClass( 'parallax-bg' );
                        }
		} );
	} );
        
        // CTA Border
        wp.customize( 'skdom_cta_border', function( value ) {
		value.bind( function( to ) {
                    if ( true !== to ) {
                        $( '.cta-phone .block-border' ).css({
                            'border': 'none',
                            'padding-top': '0',
                            'padding-bottom': '0'
                        });
                        $( '.cta-phone .block-border .triangle-down' ).css( 'display', 'none' );
                    } else {
                        $( '.cta-phone .block-border' ).css({
                            'border': '4px solid #58b32b',
                            'padding-top': '50px',
                            'padding-bottom': '40px'
                        });
                        $( '.cta-phone .block-border .triangle-down' ).css( 'display', 'block' );
                    }
		} );
	} );
        
        // CTA Title
        wp.customize( 'skdom_cta_title', function( value ) {
		value.bind( function( to ) {
                        $('.cta-phone h2 span:first-child').text( to );
		} );
	} );
        
        // CTA Phone
        wp.customize( 'skdom_cta_phone', function( value ) {
		value.bind( function( to ) {
                        $('.cta-phone h2 span:nth-child(2)').text( to );
		} );
	} );
        
        // CTA Subtitle
        wp.customize( 'skdom_cta_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('.cta-phone p').text( to );
		} );
	} );
        
        /**
	 * Workflow Section
	 */
        // Workflow Background Image.
	wp.customize( 'skdom_workflow_bgimage', function( value ) {
		value.bind( function( to ) {
			$('.workflow .bg-image').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // Workflow Background attachment option
	wp.customize( 'skdom_workflow_attachment', function( value ) {
		value.bind( function( to ) {
                        if( to !== 'fixed' ) {
                            $( '#workflow-bg' ).removeClass( 'parallax-bg' );
                        } else {
                            $( '#workflow-bg' ).addClass( 'parallax-bg' );
                        }
		} );
	} );
        
        // Workflow Section Title
        wp.customize( 'skdom_workflow_title', function( value ) {
		value.bind( function( to ) {
                        $('.workflow .section-heading h2').text( to );
                        
                        if ( to === '' ) {
                            $('.workflow .section-heading .line-short').css( 'display', 'none' );
                        } else {
                            $('.workflow .section-heading .line-short').css( 'display', 'block' );
                        }
		} );
	} );
        
        // Workflow Section Subtitle
        wp.customize( 'skdom_workflow_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('.workflow .section-heading p').text( to );
		} );
	} );
        
        /**
	 * Testimonials
	 */
        // Testimonials Background Image.
	wp.customize( 'skdom_testimonials_bgimage', function( value ) {
		value.bind( function( to ) {
			$('#testimonials .bg-image').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // Testimonials background color.
	wp.customize( 'skdom_testimonials_bgcolor', function( value ) {
		value.bind( function( to ) {
                        $( '#testimonials .overlay' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Testimonials Title
        wp.customize( 'skdom_testimonials_title', function( value ) {
		value.bind( function( to ) {
                        $('#testimonials .section-heading h2').text( to );
                        
                        if ( to === '' ) {
                            $('#testimonials .section-heading .line-short').css( 'display', 'none' );
                        } else {
                            $('#testimonials .section-heading .line-short').css( 'display', 'block' );
                        }
		} );
	} );
        
        /**
	 * Services Section
	 */
        // Services Section background color option
//        wp.customize( 'skdom_services_section_bg_color', function( value ) {
//		value.bind( function( to ) {
//                    
//                    if ( $( '.services' ).attr( 'style' ) && $( '.services' ).attr( 'style' ) !== '' ) {
//                        var style = $( '.services' ).attr( 'style' );
//                    }
//                    
//                    if ( true === to ) {
//                        $( '.services' ).addClass( 'section-bg' );
//                        $( '.services' ).attr( 'style', '' + style + '' );
//                    } else {
//                        $( '.services' ).removeClass( 'section-bg' );
//                        $( '.services' ).attr( 'style', '' );
//                    }
//		} );
//	} );
        
        // Services Title
        wp.customize( 'skdom_services_title', function( value ) {
		value.bind( function( to ) {
                        $('.services .section-heading h2').text( to );
                        
                        if ( to === '' ) {
                            $('.services .section-heading .line-short').css( 'display', 'none' );
                        } else {
                            $('.services .section-heading .line-short').css( 'display', 'block' );
                        }
		} );
	} );
        
        // Services Subtitle
        wp.customize( 'skdom_services_subtitle', function( value ) {
		value.bind( function( to ) {
                        $('.services .section-heading p').text( to );
		} );
	} );
        
        // Services Button text
        wp.customize( 'skdom_services_button', function( value ) {
		value.bind( function( to ) {
                        $('#services .button').text( to );
                        
                        if ( to === '' ) {
                            $( '#services .button' ).css( 'display', 'none' );
                        } else {
                            $( '#services .button' ).css( 'display', 'inline-block' );
                        }
		} );
	} );
        
        /**
	 * FAQ Section
	 */
        // FAQ Title
        wp.customize( 'skdom_faq_title', function( value ) {
		value.bind( function( to ) {
                        $( '#faq h3' ).text( to );
                        
                        if ( to === '' ) {
                            $( '#faq' ).css( 'display', 'none' );
                            $( '#cform' ).attr( 'class', 'section-group col-sm-10 col-sm-offset-1' );
                            $( '#cform' ).find( '.input-cont' ).find( 'input' ).parents( '.col-xs-12' ).addClass( 'col-sm-6' );
                        } else {
                            $( '#faq' ).css( 'display', 'block' );
                            $( '#cform' ).attr( 'class', 'section-group col-sm-6' );
                            $( '#cform' ).find( '.input-cont' ).find( 'input' ).parents( '.col-xs-12' ).removeClass( 'col-sm-6' );
                        }
		} );
	} );
        
        // Form Title
        wp.customize( 'skdom_form_title', function( value ) {
		value.bind( function( to ) {
                        $( '#cform h3' ).text( to );
                        
                        if ( to === '' ) {
                            $( '#cform' ).css( 'display', 'none' );
                            $( '#faq' ).attr( 'class', 'section-group col-sm-10 col-sm-offset-1' );
                        } else {
                            $( '#cform' ).css( 'display', 'block' );
                            $( '#faq' ).attr( 'class', 'section-group col-sm-6' );
                        }
		} );
	} );
        
        /**
	 * Contacts
	 */
        // Contacts Background Image.
	wp.customize( 'skdom_contacts_bgimage', function( value ) {
		value.bind( function( to ) {
			$('#contacts .bg-image').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // Contacts background color.
	wp.customize( 'skdom_contacts_bgcolor', function( value ) {
		value.bind( function( to ) {
                        $( '#contacts .overlay' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Contacts Title
        wp.customize( 'skdom_contacts_title', function( value ) {
		value.bind( function( to ) {
                        $('#contacts .section-heading h3').text( to );
		} );
	} );
        
        /**
	 * Footer
	 */
        // Footer Background Image.
	wp.customize( 'skdom_footer_bgimage', function( value ) {
		value.bind( function( to ) {
			$('.site-footer_wrap .bg-image').css( 'background-image', 'url(' + to + ')' );
		} );
	} );
        
        // Footer background color.
	wp.customize( 'skdom_footer_bgcolor', function( value ) {
		value.bind( function( to ) {
                        $( '.site-footer_wrap .overlay' ).css( {
				'background-color': to
			} );
		} );
	} );
        
        // Footer Logo.
	wp.customize( 'skdom_footer_logo', function( value ) {
		value.bind( function( to ) {
			$('.site-footer .footer-logo').attr( 'src', to );
		} );
	} );
        
        // Footer Copyrights.
        wp.customize( 'skdom_footer_copyrights', function( value ) {
		value.bind( function( to ) {
                        $('.site-footer .rights-text').text( to );
		} );
	} );
} )( jQuery );
