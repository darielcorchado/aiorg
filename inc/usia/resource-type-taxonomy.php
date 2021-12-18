<?php
    
/**
 * Functions which setup the Resource Type taxonomy for Company CPT
 *
 * @package Freeadvice
 */


/**
 * Registers Resource taxonomy for Company CPT
 *
 * @return  None
 */

function register_resource_taxonomy()
{
    $labels = [
        'name' => _x('Resource Types', 'taxonomy general name'),
        'singular_name' => _x('Resource Type', 'taxonomy singular name'),
        'search_items' => __('Search Resource Types'),
        'all_items' => __('All Resource Types'),
        'parent_item' => 'Parent Resource Type:',
        'parent_item_colon' => 'Parent Resource Type:',
        'edit_item' => __('Edit Resource Type'),
        'update_item' => __('Update Resource Type'),
        'add_new_item' => __('Add New Resource Type'),
        'new_item_name' => __('New Resource Type'),
        'view_item' => __('View Resource Type'),
        'not_found' => __('No Resource Type found'),
        'not_found_in_trash' => __('No Resource Type found in Trash'),
        'menu_name' => 'Resource Types',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'query_var' => true,
        'hierarchical' => true,
        'rewrite' => [
            'hierarchical' => false,
            'slug' => "agency-resource-type"
        ],
    ];

    register_taxonomy('resource_type', 'agency_resources', $args);

    $labels = [
        'name' => _x('Answer Tags', 'taxonomy general name'),
        'singular_name' => _x('Answer Tag', 'taxonomy singular name'),
        'search_items' => __('Search Answer Tags'),
        'all_items' => __('All Answer Tags'),
        'parent_item' => 'Parent Answer Tag:',
        'parent_item_colon' => 'Parent Answer Tag:',
        'edit_item' => __('Edit Answer Tag'),
        'update_item' => __('Update Answer Tag'),
        'add_new_item' => __('Add New Answer Tag'),
        'new_item_name' => __('New Answer Tag'),
        'view_item' => __('View Answer Tag'),
        'not_found' => __('No Answer Tag found'),
        'not_found_in_trash' => __('No Answer Tag found in Trash'),
        'menu_name' => 'Answer Tags',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'query_var' => true,
        'hierarchical' => true,
        'rewrite' => [
            'hierarchical' => false,
            'slug' => "answer/tag"
        ],
    ];

    register_taxonomy('answer_tag', 'answer', $args);

}



add_action('init', 'register_resource_taxonomy');