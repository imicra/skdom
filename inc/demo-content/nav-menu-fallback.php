<?php

/* 
 * Default nav menu, if not other menu has been provided.
 * 
 * @package sk-dom
 */
function skdom_default_menu() {
    
    $html = '<ul class="nav-menu">';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
                    $html .= __( 'Home', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="#about" data-anchor="#about">';
                    $html .= __( 'About', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="#gallery" data-anchor="#gallery">';
                    $html .= __( 'Gallery', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">';
                    $html .= '<a href="#featured" data-anchor="#featured">';
                        $html .= __( 'Featured', 'skdom' );
                    $html .= '</a>';
                    $html .= '<i class="fa fa-chevron-down"></i>';
                    $html .= '<ul class="sub-menu">';
                            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                                $html .= '<a href="#" onclick="return false;">';
                                    $html .= __( 'Building 1', 'skdom' );
                                $html .= '</a>';
                            $html .= '</li>';
                            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                                $html .= '<a href="#" onclick="return false;">';
                                    $html .= __( 'Building 2', 'skdom' );
                                $html .= '</a>';
                            $html .= '</li>';
                            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                                $html .= '<a href="#" onclick="return false;">';
                                    $html .= __( 'Building 3', 'skdom' );
                                $html .= '</a>';
                            $html .= '</li>';
                            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                                $html .= '<a href="#" onclick="return false;">';
                                    $html .= __( 'Building 4', 'skdom' );
                                $html .= '</a>';
                            $html .= '</li>';
                    $html .= '</ul>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="#cta" data-anchor="#cta">';
                    $html .= __( 'Booking', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="#workflow" data-anchor="#workflow">';
                    $html .= __( 'Workflow', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="#services" data-anchor="#services">';
                    $html .= __( 'Services', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
            $html .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
                $html .= '<a href="#contacts" data-anchor="#contacts">';
                    $html .= __( 'Contacts', 'skdom' );
                $html .= '</a>';
            $html .= '</li>';
    $html .= '</ul>';
            
    echo $html;
            
}