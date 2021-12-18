<?php
/**
 * Registers answer post type
 *
 * @param None
 * @return None
 */

function register_answer_post_type()
{
    $labels = [
        'name' => _x('Answers', 'post type general name'),
        'singular_name' => _x('Answer', 'post type singular name'),
        'add_new' => _x('Add New', 'Answer'),
        'add_new_item' => __('Add New Answer'),
        'edit_item' => __('Edit Answer'),
        'new_item' => __('New Answer'),
        'view_item' => __('View Answer'),
        'search_items' => __('Search Answers'),
        'not_found' => __('No answers found'),
        'not_found_in_trash' => __('No answers found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Answers',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'answers'],
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-editor-help',
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
        'has_archive' => 'answers',
        'taxonomies' => ['post_tag'],
    ];

    register_post_type('answer', $args);
}

add_action('init', 'register_answer_post_type');
