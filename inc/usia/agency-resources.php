<?php
/**
 * Registers agency_resources post type
 *
 * @param None
 * @return None
 */

function register_agency_resources_post_type()
{
    $labels = [
        'name' => _x('Agency Resources', 'post type general name'),
        'singular_name' => _x('Agency Resource', 'post type singular name'),
        'add_new' => _x('Add New', 'agency_resources'),
        'add_new_item' => __('Add New Agency Resource'),
        'edit_item' => __('Edit Agency Resource'),
        'new_item' => __('New Agency Resource'),
        'view_item' => __('View Agency Resource'),
        'search_items' => __('Search Agency Resources'),
        'not_found' => __('No Agency Resources found'),
        'not_found_in_trash' => __('No Agency Resources found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Agency',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'agency-resources'],
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-bank',
        'hierarchical' => false,
        'menu_position' => null,
        'show_in_rest' => true,
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            // 'excerpt',
            'comments',
        ],
        'has_archive' => 'agency-resources',
        'taxonomies' => ['resource_type'],
    ];

    register_post_type('agency_resources', $args);
}

add_action('init', 'register_agency_resources_post_type');
