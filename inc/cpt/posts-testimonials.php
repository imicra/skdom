<?php

/**
 * File posts-testimonials.php.
 * 
 * Custom Post Type for Testimonials.
 * 
 * @package skdom
 */

function skdom_testimonials_posttypes() {
    
    $labels = array(
        'name'               => __( 'Testimonials', 'skdom' ),
        'singular_name'      => __( 'Testimonial', 'skdom' ),
        'menu_name'          => __( 'Testimonials', 'skdom' ),
        'name_admin_bar'     => __( 'Testimonial', 'skdom' ),
        'add_new'            => __( 'Add New', 'skdom' ),
        'add_new_item'       => __( 'Add New Testimonial', 'skdom' ),
        'new_item'           => __( 'New Testimonial', 'skdom' ),
        'edit_item'          => __( 'Edit Testimonial', 'skdom' ),
        'view_item'          => __( 'View Testimonial', 'skdom' ),
        'all_items'          => __( 'All Testimonials', 'skdom' ),
        'search_items'       => __( 'Search Testimonials', 'skdom' ),
        'parent_item_colon'  => __( 'Parent Testimonials:', 'skdom' ),
        'not_found'          => __( 'No testimonials found.', 'skdom' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.', 'skdom' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => false,
        'menu_icon'          => 'dashicons-id-alt',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 30,
        'supports'           => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' )
    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'skdom_testimonials_posttypes' );