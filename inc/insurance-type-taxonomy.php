<?php
    
/**
 * Functions which setup the Insurance Type taxonomy for Company CPT
 *
 * @package Freeadvice
 */


/**
 * Registers Insurance Type taxonomy for Company CPT
 *
 * @return  None
 */

function register_cpt_insurance_type_taxonomy($cpt_slug)
{
    $labels = [
        'name' => _x('Insurance Types', 'taxonomy general name'),
        'singular_name' => _x('Insurance Type', 'taxonomy singular name'),
        'search_items' => __('Search Insurance Types'),
        'all_items' => __('All Insurance Types'),
        'parent_item' => 'Parent Insurance Type:',
        'parent_item_colon' => 'Parent Insurance Type:',
        'edit_item' => __('Edit Insurance Type'),
        'update_item' => __('Update Insurance Type'),
        'add_new_item' => __('Add New Insurance Type'),
        'new_item_name' => __('New Insurance Type'),
        'view_item' => __('View Insurance Type'),
        'not_found' => __('No Insurance Types found'),
        'not_found_in_trash' => __('No Insurance Types found in Trash'),
        'menu_name' => 'Insurance Types',
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
            'slug' => $cpt_slug."-ins-type",
        ],
    ];

    register_taxonomy($cpt_slug.'_insurance_type', [$cpt_slug], $args);
}

function register_cpt_insurance_type_taxonomies()
{
    $cpts = ['company', 'agent'];
    foreach ($cpts as $cpt) {
        register_cpt_insurance_type_taxonomy($cpt);
    }
}

add_action('init', 'register_cpt_insurance_type_taxonomies');