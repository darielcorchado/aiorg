<?php
/**
 * Registers agent post type
 *
 * @param None
 * @return None
 */

function register_agent_city_state_post_type()
{
    $labels = [
        'name' => _x('City/States', 'post type general name'),
        'singular_name' => _x('City/State', 'post type singular name'),
        'add_new' => _x('Add New', 'city-state'),
        'add_new_item' => __('Add New City/State'),
        'edit_item' => __('Edit City/State'),
        'new_item' => __('New City/State'),
        'view_item' => __('View City/State'),
        'search_items' => __('Search City/States'),
        'not_found' => __('No City/States found'),
        'not_found_in_trash' => __('No City/States found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Agent Cities',
    ];

	$args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'city-state', 'with_front' => false],
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_icon' => 'dashicons-location',
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
        'has_archive' => 'city-states',
        // 'taxonomies' => ['post_tag', 'category'],
    ];

    register_post_type('city_state', $args);
}

add_action('init', 'register_agent_city_state_post_type');

function agent_state_rewrite_rules() {
	add_rewrite_tag('%city_state%', '([^/]+)', 'city_state=');
	add_permastruct('city_state', '/car-insurance/%state%/%city_state%/', false);

	add_rewrite_rule('^car-insurance/(?!agents)([^/]+)/page/([0-9]+)/?','index.php?post_type=city_state&states=$matches[1]&paged=$matches[2]','top');
	add_rewrite_rule('^car-insurance/(?!agents)([^/]+)/([^/]+)/?','index.php?city_state=$matches[2]&states=$matches[1]','top');
}
add_action( 'init', 'agent_state_rewrite_rules' );


function agent_city_state_permalinks($permalink, $post, $leavename) {
	global $wpdb;

	$post_id = $post->ID;
	if (($post->post_type != 'city_state') ||
	    empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft'))) {
		return $permalink;
	}

	$post_meta = get_post_meta($post->ID);
	if (empty($post_meta)) {
		return $permalink;
	}

	$state_term = get_term_by('id', $post_meta['_yoast_wpseo_primary_states'][0], 'states');
	if (empty($state_term)) {
		$query = $wpdb->prepare("
   	 		SELECT * FROM `car-insurance_city`  AS cic
			  JOIN `car-insurance_state` AS cis ON cis.id = cic.state_id
			 WHERE cic.title2 = '%s'
			 ORDER BY RAND()
			 LIMIT 1", $post->post_name);

	    $state_by_city = $wpdb->get_results($query);

		if (!empty($state_by_city)) {
			$state_slug = $state_by_city[0]->title2;

			// If no state term then we replace with empty string
			$permalink  = str_replace('%state%', $state_slug, $permalink);
		}

		return $permalink;
	}

	$permalink = str_replace('%state%', $state_term->slug, $permalink);

	return $permalink;
}
add_filter('post_type_link', 'agent_city_state_permalinks', 10, 3);
