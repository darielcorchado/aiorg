<?php
/**
 * Registers agent post type
 *
 * @param None
 * @return None
 */

function register_agent_post_type()
{
    $labels = [
        'name' => _x('Agents', 'post type general name'),
        'singular_name' => _x('Agent', 'post type singular name'),
        'add_new' => _x('Add New', 'agent'),
        'add_new_item' => __('Add New Agent'),
        'edit_item' => __('Edit Agent'),
        'new_item' => __('New Agent'),
        'view_item' => __('View Agent'),
        'search_items' => __('Search Agents'),
        'not_found' => __('No agents found'),
        'not_found_in_trash' => __('No agents found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Agents',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'agents/%agent_city%', 'with_front' => false],
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessman',
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
        'has_archive' => 'agents',
        // 'taxonomies' => ['post_tag', 'category'],
    ];

    register_post_type('agent', $args);
}

add_action('init', 'register_agent_post_type');
