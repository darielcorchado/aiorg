<?php
    
/**
 * Functions which setup the City taxonomy for our CPTs
 *
 * @package USIA
 */


/**
 * Registers city taxonomy for a CPT
 *
 * @param   $cpt_slug = slug of the custom post type
 * @return  None
 */

function register_cpt_city_taxonomy($cpt_slug)
{
    $labels = [
        'name' => _x('Cities', 'taxonomy general name'),
        'singular_name' => _x('City', 'taxonomy singular name'),
        'search_items' => __('Search Cities'),
        'all_items' => __('All Cities'),
        'parent_item' => 'Parent City:',
        'parent_item_colon' => 'Parent City:',
        'edit_item' => __('Edit City'),
        'update_item' => __('Update City'),
        'add_new_item' => __('Add New City'),
        'new_item_name' => __('New City'),
        'view_item' => __('View City'),
        'not_found' => __('No Cities found'),
        'not_found_in_trash' => __('No Cities found in Trash'),
        'menu_name' => 'Cities',
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
            'slug' => "$cpt_slug"."s",
            'with_front' => false
        ],
    ];

    register_taxonomy($cpt_slug.'_city', [$cpt_slug], $args);
}


function register_cpt_city_taxonomies()
{
    $cpts = ['agent'];
    foreach ($cpts as $cpt) {
        register_cpt_city_taxonomy($cpt);
    }
}
add_action('init', 'register_cpt_city_taxonomies');