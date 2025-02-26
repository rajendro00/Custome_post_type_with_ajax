<?php  

/**
 * Plugin Name: Custome Post  Type
 * Plugin URI: https://rajen.com
 * Description: This is a professional basement plugin
 * Version: 1.0.0
 * Author: Rajendro
 * Author URI: https://rajen.com
 * License: GPL2
 * Text Domain: custome-post-type
 */  


 class custome_post_type{

    function __construct(){
        // add_shortcode( 'custome_post_type_shortcode', [$this, 'custome_post_type_display'] );
        add_action('init', [$this, 'custome_post_type']);
        include __DIR__.'/include/post-form.php';
        define('PLUGIN_ASSETS_DIR_PUBLIC', plugin_dir_url(__FILE__). 'assets/public/');
        new post_form();
    }

    function custome_post_type(){
        $labels = array(
            'name'                  => _x( 'Stories', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'Story', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'Stories', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Story', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New Story', 'textdomain' ),
            'new_item'              => __( 'New Story', 'textdomain' ),
            'edit_item'             => __( 'Edit Story', 'textdomain' ),
            'view_item'             => __( 'View Story', 'textdomain' ),
            'all_items'             => __( 'All Stories', 'textdomain' ),
            'search_items'          => __( 'Search Stories', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent Stories:', 'textdomain' ),
            'not_found'             => __( 'No Stories found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No Stories found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'Story Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Story archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into Story', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Story', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter Stories list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Stories list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Stories list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'story' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );
    
        register_post_type( 'story', $args );

        $labels = array(
            'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Categories', 'textdomain' ),
            'all_items'         => __( 'All Categories', 'textdomain' ),
            'view_item'         => __( 'View Category', 'textdomain' ),
            'parent_item'       => __( 'Parent Category', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
            'edit_item'         => __( 'Edit Category', 'textdomain' ),
            'update_item'       => __( 'Update Category', 'textdomain' ),
            'add_new_item'      => __( 'Add New Category', 'textdomain' ),
            'new_item_name'     => __( 'New Category Name', 'textdomain' ),
            'not_found'         => __( 'No Categories Found', 'textdomain' ),
            'back_to_items'     => __( 'Back to Categories', 'textdomain' ),
            'menu_name'         => __( 'Categories', 'textdomain' ),
        );
    
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'stories_category' ),
            'show_in_rest'      => true,
        );
    
    
        register_taxonomy( 'stories_category', 'story', $args );
    }

 }

 new custome_post_type();