<?php
/**
 * Registers agent post type
 *
 * @param None
 * @return None
 */

function register_ais_agent_post_type()
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
        'rewrite' => ['slug' => 'car-insurance/agents', 'with_front' => false],
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
            'page-attributes',
            'comments',
        ],

        'taxonomies' => ['category'],
    ];

    register_post_type('ais_agent', $args);
}

add_action('init', 'register_ais_agent_post_type');

if ( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array(
		'key' => 'group_60ec8786b7b51',
		'title' => 'Original Agent ID',
		'fields' => array(
			array(
				'key' => 'field_60ec87ace17ce',
				'label' => 'Original Agent ID',
				'name' => 'original_agent_id',
				'type' => 'text',
				'instructions' => 'Original agent ID that is associated with this Agent',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'ais_agent',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;

function agent_rewrite_rules() {
	add_rewrite_tag( '%cpt_id%', '([^/]+)', 'post_type=ais_agent&p=' );
	add_permastruct('ais_agent', '/car-insurance/agents/%cpt_id%/', false);

	add_rewrite_rule('^car-insurance/agents/page/([0-9]+)/?','index.php?post_type=ais_agent&paged=$matches[1]','top');

	// Original redirect for wordpress ID's being in the slug rather than outside db ID's
	//add_rewrite_rule('^car-insurance/agents/([0-9]+)/?','index.php?post_type=ais_agent&p=$matches[1]','top');
}
add_action( 'init', 'agent_rewrite_rules' );

function agent_permalinks($permalink, $post, $leavename) {
	global $wpdb;

	$post_id = $post->ID;
	if (($post->post_type != 'ais_agent') ||
	    empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft'))) {
		return $permalink;
	}

	$parent = $post->post_parent;
	$parent_post = get_post( $parent );

	// This was used to send users to agents/{wp_posts.ID} rather than car-insurance_agents.id
	/*if (!$parent_post) {
		return $permalink;
	}

	$replace    = $post->ID;
	$permalink  = str_replace('%cpt_id%', $replace, $permalink);*/


	// Use car-insurance_agents.id
	$replace = $post->ID;
	$meta    = get_post_meta($replace);

	if (!empty($meta['original_agent_id'])) {
		$original_id = $meta['original_agent_id'][0];
		$permalink   = str_replace('%cpt_id%', $original_id, $permalink);
	} else {
		$permalink   = str_replace('%cpt_id%', '', $permalink);
	}

	return $permalink;
}
add_filter('post_type_link', 'agent_permalinks', 10, 3);

// Permalink/redirect settings for getting the original agent id into the slug
function custom_rewrite_basic() {
    add_rewrite_tag( '%original_agent_id%', '([0-9]+)' );
    add_rewrite_rule('^car-insurance/agents/([0-9]+)/?', 'index.php?post_type=ais_agent&original_agent_id=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_basic');

function filtra_query( $query ) {
    $agent_id = $query->get('original_agent_id');

    if (!empty($agent_id)) {
        $args = [
			[
				'key' => 'original_agent_id',
	            'value' => $agent_id
			]
		];

        $query->set( 'meta_query', $args );
    }
}
add_action( 'pre_get_posts', 'filtra_query' );
