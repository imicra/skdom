<?php

/**
 * File posts-faq.php.
 * 
 * Custom Post Type for FAQ.
 * 
 * @package skdom
 */

function skdom_faq_posttypes() {
    
    $labels = array(
        'name'               => __( 'FAQ', 'skdom' ),
        'singular_name'      => __( 'FAQ item', 'skdom' ),
        'menu_name'          => __( 'FAQ', 'skdom' ),
        'name_admin_bar'     => __( 'FAQ', 'skdom' ),
        'add_new'            => __( 'Add New', 'skdom' ),
        'add_new_item'       => __( 'Add New FAQ item', 'skdom' ),
        'new_item'           => __( 'New FAQ item', 'skdom' ),
        'edit_item'          => __( 'Edit FAQ item', 'skdom' ),
        'view_item'          => __( 'View FAQ item', 'skdom' ),
        'all_items'          => __( 'All FAQ items', 'skdom' ),
        'search_items'       => __( 'Search FAQ items', 'skdom' ),
        'parent_item_colon'  => __( 'Parent FAQ item:', 'skdom' ),
        'not_found'          => __( 'No FAQ items found.', 'skdom' ),
        'not_found_in_trash' => __( 'No FAQ items found in Trash.', 'skdom' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => false,
        'menu_icon'          => 'dashicons-format-chat',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'faq' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 31,
        'supports'           => array( 'title', 'editor', 'page-attributes' )
    );
    register_post_type( 'faq', $args );
}
add_action( 'init', 'skdom_faq_posttypes' );