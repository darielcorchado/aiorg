<?php

/**
 * Functions which setup the City taxonomy for our CPTs
 */


/**
 * Registers city taxonomy for a CPT
 *
 * @param   $cpt_slug = slug of the custom post type
 * @return  None
 */

function register_cpt_state_taxonomy($cpt_slug)
{
    $labels = [
        'name' => _x('States', 'taxonomy general name'),
        'singular_name' => _x('State', 'taxonomy singular name'),
        'search_items' => __('Search States'),
        'all_items' => __('All States'),
        'parent_item' => 'Parent State:',
        'parent_item_colon' => 'Parent State:',
        'edit_item' => __('Edit State'),
        'update_item' => __('Update State'),
        'add_new_item' => __('Add New State'),
        'new_item_name' => __('New State'),
        'view_item' => __('View State'),
        'not_found' => __('No States found'),
        'not_found_in_trash' => __('No States found in Trash'),
        'menu_name' => 'States',
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
            'hierarchical' => true,
            'slug' => "car-insurance",
            'with_front' => false
        ],

		'has_archive' => 'car-insurance',
    ];

    register_taxonomy('states', [$cpt_slug], $args);
}


function register_cpt_state_taxonomies()
{
    $cpts = ['city_state'];
    foreach ($cpts as $cpt) {
        register_cpt_state_taxonomy($cpt);
    }
}
add_action('init', 'register_cpt_state_taxonomies');
