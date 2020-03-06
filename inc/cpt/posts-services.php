<?php

/**
 * File posts-services.php.
 * 
 * Custom Post Type for Services.
 * 
 * @package skdom
 */

function skdom_services_posttypes() {
    
    $labels = array(
        'name'               => __( 'Services', 'skdom' ),
        'singular_name'      => __( 'Service', 'skdom' ),
        'menu_name'          => __( 'Services', 'skdom' ),
        'name_admin_bar'     => __( 'Service', 'skdom' ),
        'add_new'            => __( 'Add New', 'skdom' ),
        'add_new_item'       => __( 'Add New Service', 'skdom' ),
        'new_item'           => __( 'New Service', 'skdom' ),
        'edit_item'          => __( 'Edit Service', 'skdom' ),
        'view_item'          => __( 'View Service', 'skdom' ),
        'all_items'          => __( 'All Services', 'skdom' ),
        'search_items'       => __( 'Search Services', 'skdom' ),
        'parent_item_colon'  => __( 'Parent Services:', 'skdom' ),
        'not_found'          => __( 'No services found.', 'skdom' ),
        'not_found_in_trash' => __( 'No services found in Trash.', 'skdom' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-hammer',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'services' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' )
    );
    register_post_type( 'services', $args );
}
add_action( 'init', 'skdom_services_posttypes' );