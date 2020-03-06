<?php

/* 
 * Define and register starter content to showcase the theme on new sites.
 * 
 * @package skdom
 */

function skdom_starter_content_setup() {
    
    $starter_content = array(
        'widgets' => array(
                // Add the core-defined business info widget to the footer 1 area.
                'footer-area' => array(
                        'text_about',
//                        array(
//                          'title' => '',
//                          'text'  => get_template_directory_uri() . '/demo-content/widgets/about.php'
//                        )
                ),

                // Add the core-defined business info widget to the footer 1 area.
                'footer-area-2' => array(
                        'categories',
                ),

                // Add the core-defined business info widget to the footer 1 area.
                'footer-area-3' => array(
                        'text_business_info',
                ),
        ),
        
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array(
                'home' => array(
                        'post_type' => 'page',
                        'post_title' => _x( 'Home', 'Theme starter content' ),
                        'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
                ),
                'about' => array(
                        'post_type' => 'page',
                        'post_title' => _x( 'About', 'Theme starter content' ),
                        'post_content' => _x( 'You might be an artist who would like to introduce yourself and your work here or maybe you&rsquo;re a business with a mission to describe.', 'Theme starter content' ),
                ),
                'contact' => array(
                        'post_type' => 'page',
                        'post_title' => _x( 'Contact', 'Theme starter content' ),
                        'post_content' => _x( 'This is a page with some basic contact information, such as an address and phone number. You might also try a plugin to add a contact form.', 'Theme starter content' ),
                ),
                'blog' => array(
                        'post_type' => 'page',
                        'post_title' => _x( 'Blog', 'Theme starter content' ),
                ),
        ),
        
        // Set up nav menus for each of the three areas registered in the theme.
        'nav_menus' => array(
                // Assign a menu to the "primary" location.
                'primary' => array(
                        'name' => __( 'Header Menu', 'skdom' ),
                        'items' => array(
                                'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                                'page_about',
                                'page_blog',
                                'page_contact',
                        ),
                ),
            
                // Assign a menu to the "footer" location.
                'footer' => array(
                        'name' => __( 'Footer Menu', 'skdom' ),
                        'items' => array(
                                'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                                'page_about',
                                'page_blog',
                                'page_contact',
                        ),
                ),

                // Assign a menu to the "social" location.
                'social' => array(
                        'name' => __( 'Social Links Menu', 'skdom' ),
                        'items' => array(
                                'link_yelp',
                                'link_facebook',
                                'link_twitter',
                                'link_instagram',
                                'link_email',
                        ),
                ),
        ),
    );
    
    /**
     * Filters Skdom array of starter content.
     *
     * @param array $starter_content Array of starter content.
     */
    $starter_content = apply_filters( 'skdom_starter_content', $starter_content );
    
    add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'skdom_starter_content_setup' );