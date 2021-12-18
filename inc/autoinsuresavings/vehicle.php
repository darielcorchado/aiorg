<?php
/**
 * Registers agent post type
 *
 * @param None
 * @return None
 */

function register_vehicle_post_type()
{
    $labels = [
        'name' => _x('Vehicles', 'post type general name'),
        'singular_name' => _x('Vehicle', 'post type singular name'),
        'add_new' => _x('Add New', 'vehicle'),
        'add_new_item' => __('Add New Vehicle'),
        'edit_item' => __('Edit Vehicle'),
        'new_item' => __('New Vehicle'),
        'view_item' => __('View Vehicle'),
        'search_items' => __('Search Vehicles'),
        'not_found' => __('No Vehicles found'),
        'not_found_in_trash' => __('No Vehicles found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Vehicles',
    ];

	$args = array(
		'labels'                => $labels,
		'hierarchical'          => false,
		'public'                => true,
		'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
		'rewrite' => [
			'slug' => 'vehicles',
			'with_front' => false,
		],
		'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-car',
		'menu_position' => null,
        'show_in_rest' => true,
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'comments',
			'page-attributes'
        ],

		'has_archive' => 'car-insurance/vehicles',
	);

    register_post_type('vehicle', $args);

	//-------------------------------------------------
	//-------------------------------------------------
	//-------------------------------------------------

	$labels = [
        'name' => _x('Vehicle Models/Quotes', 'post type general name'),
        'singular_name' => _x('Vehicle Quotes', 'post type singular name'),
        'add_new' => _x('Add New', 'vehicle_quotes'),
        'add_new_item' => __('Add New Vehicle Quotes'),
        'edit_item' => __('Edit Vehicle Quotes'),
        'new_item' => __('New Vehicle Quotes'),
        'view_item' => __('View Vehicle Quotes'),
        'search_items' => __('Search Vehicle Quotes'),
        'not_found' => __('No Vehicle Quotes found'),
        'not_found_in_trash' => __('No Vehicle Quotes found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Vehicle Models/Quotes',
    ];

	$args = array(
		'labels'                => $labels,
		'hierarchical'          => false,
		'public'                => true,
		'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
		'rewrite' => [
			'slug' => 'vehicle_quote',
			'with_front' => false,
		],

		'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-money-alt',
		'menu_position' => null,
        'show_in_rest' => true,
		'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'comments',
			'page-attributes'
        ],

		'has_archive' => 'false',
	);

    register_post_type('vehicle_quote', $args);
}

add_action('init', 'register_vehicle_post_type');

/**
* Ad parent box for vehicle quote CPTs
*/
function my_add_meta_boxes() {
	add_meta_box( 'vehicle-quote-parent', 'Vehicle', 'vehicle_quote_attributes_meta_box', 'vehicle_quote', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'my_add_meta_boxes' );

function vehicle_quote_attributes_meta_box( $post ) {
	$post_type_object = get_post_type_object( $post->post_type );
	$pages = wp_dropdown_pages( array( 'post_type' => 'vehicle', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __( '(no parent)' ), 'sort_column'=> 'menu_order, post_title', 'echo' => 0 ) );
	if ( ! empty( $pages ) ) {
		echo $pages;
	}
}

function my_add_rewrite_rules() {
	add_rewrite_tag('%vehicle%', '([^/]+)', 'vehicle=');
	add_permastruct('vehicle', '/car-insurance/vehicles/%vehicle%', false);

	//---------
	//---------

	add_rewrite_tag('%vehicle_quote%', '([^/]+)', 'vehicle_quote=');
	add_permastruct('vehicle_quote', '/car-insurance/vehicles/%vehicle_type%/%vehicle_quote%/', false);
	add_rewrite_rule('^car-insurance/vehicles/([^/]+)/([^/]+)/?','index.php?vehicle_quote=$matches[2]','top');

	// Check for parent directories only after the car model checks
	add_rewrite_rule('^car-insurance/vehicles/([^/]+)/?','index.php?vehicle=$matches[1]','top');
}
add_action( 'init', 'my_add_rewrite_rules' );


function my_permalinks($permalink, $post, $leavename) {

	$post_id = $post->ID;
	if (($post->post_type != 'vehicle_quote') ||
	    empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft'))) {
		return $permalink;
	}

	$parent = $post->post_parent;
	$parent_post = get_post( $parent );

	if (!$parent_post) {
		return $permalink;
	}

	$permalink = str_replace('%vehicle_type%', str_replace(' ', '-', $parent_post->post_name), $permalink);

	return $permalink;
}
add_filter('post_type_link', 'my_permalinks', 10, 3);
