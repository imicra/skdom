<?php

/**
 * File posts-portfolio.php.
 * 
 * Custom Post Type for Portfolio.
 * 
 * @package skdom
 */

function skdom_portfolio_posttypes() {
    
    $labels = array(
        'name'               => __( 'Portfolio', 'skdom' ),
        'singular_name'      => __( 'Portfolio item', 'skdom' ),
        'menu_name'          => __( 'Portfolio', 'skdom' ),
        'name_admin_bar'     => __( 'Portfolio', 'skdom' ),
        'add_new'            => __( 'Add New', 'skdom' ),
        'add_new_item'       => __( 'Add New Portfolio item', 'skdom' ),
        'new_item'           => __( 'New Portfolio item', 'skdom' ),
        'edit_item'          => __( 'Edit Portfolio item', 'skdom' ),
        'view_item'          => __( 'View Portfolio item', 'skdom' ),
        'all_items'          => __( 'All Portfolio items', 'skdom' ),
        'search_items'       => __( 'Search Portfolio items', 'skdom' ),
        'parent_item_colon'  => __( 'Parent Portfolio item:', 'skdom' ),
        'not_found'          => __( 'No Portfolio items found.', 'skdom' ),
        'not_found_in_trash' => __( 'No Portfolio items found in Trash.', 'skdom' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' )
    );
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'skdom_portfolio_posttypes' );