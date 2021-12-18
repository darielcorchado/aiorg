<?php

add_action('init', 'unregister_company_cpt', 20);
add_action('init', 'unregister_credit_company_cpt', 20);

require  get_stylesheet_directory() . '/inc/autoinsuresavings/states-taxonomy.php';
require  get_stylesheet_directory() . '/inc/autoinsuresavings/vehicle.php';
require  get_stylesheet_directory() . '/inc/autoinsuresavings/ais-agents.php';
require  get_stylesheet_directory() . '/inc/autoinsuresavings/agent-states.php';
//require  get_stylesheet_directory() . '/inc/autoinsuresavings/migrate.php';

/**
* Change titles on archive pages
*/
add_filter( 'get_the_archive_title', function ($title) {
	global $post;

	if (!$post) {
		return;
	}

	if ('ais_agent' == $post->post_type && is_archive()) {
		echo "All Auto Insurance ";
	}

	if ('city_state' == $post->post_type && is_archive()) {
		$title = single_cat_title( '', false );
		echo $title . " Car Insurance Quotes | Auto Insurance Agents in $title";
	}
});

// Auto assign page templates to CPTs
function default_page_template( $template ) {
	global $post;
	global $wp;

	if (!$post) {
		return $template;
	}

	if ('ais_agent' == $post->post_type) {
		$url = home_url($wp->request);
		$url = explode('/', $url);

		if (is_archive('agents') && (!isset($url[5]) || $url[5] == 'page')) {
			return locate_template( array('archive.php'));
		}

		return locate_template( array('page-templates/ais-single-agent.php'));
	}

	if ('city_state' == $post->post_type) {
		if (is_archive()) {
			return locate_template( array('archive.php'));
		}

		return locate_template( array('page-templates/ais-agents.php'));
	}

	if ('vehicle' == $post->post_type) {
		if (is_archive('/car-insurance/vehicles')) {
			return locate_template( array('archive.php'));
		}

		return locate_template( array('page-templates/ais-vehicle.php'));
	}

	if ('vehicle_quote' == $post->post_type) {
		return locate_template( array('page-templates/ais-quotes-vehicles.php'));
	}

	return $template;
}
add_filter( 'template_include', 'default_page_template', 99);

// Override Yoast SEO Title Data
function custom_title( $title ){
	global $post;
	global $wpdb;

	if (!$post) {
		return $title;
	}

    if ('city_state' == $post->post_type) {
		$states = get_states();

		@$url = explode('/', $_SERVER['REQUEST_URI']);
		@$state_key = ucwords(str_replace('-', ' ', $url[2]));

		if (empty($state_key)) {
			return $title;
		}

		@$state_abbv = $states[$state_key];

		if (empty($state_abbv)) {
			return $title;
		}

		$title = "Best & Cheapest Car Insurance in {$post->post_title}, $state_abbv - AutoInsureSavings.org";

		if (is_archive()) {
			$title = "$state_key Car Insurance Quotes | Auto Insurance Agents in $state_abbv";
		}
    }

	if ('ais_agent' == $post->post_type && !is_archive()) {
		$parse_url  = explode("/", $_SERVER['REQUEST_URI']);
		@$agent_slug = $parse_url[3];

		$query = $wpdb->prepare("
			SELECT *, cis.title AS state_title, cic.title AS city_title, cia.name AS agent_name
			  FROM wp_posts AS wp
			  JOIN `car-insurance_agents` AS cia ON LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-')) = wp.post_name
												AND CONCAT(cia.address, ', ', cia.city, ' ', cia.zip) = wp.post_excerpt
		 LEFT JOIN `car-insurance_state`  AS cis ON cis.id = cia.state_id
		 LEFT JOIN `car-insurance_city`   AS cic ON cic.id = cia.city_id
			 WHERE wp.ID = '%d'
			   AND wp.post_type = 'ais_agent'
			   GROUP BY wp.ID, cia.name, cia.address", $agent_slug);

		$agent_data = $wpdb->get_results($query);

		 if (empty($agent_data)) {
			 return $title;
		 }

		$title = "{$post->post_title} in {$agent_data[0]->city}, {$agent_data[0]->state_title}";
	}

	if ('vehicle' == $post->post_type || 'vehicle_quote' == $post->post_type) {
		$parse_url  = explode("/", $_SERVER['REQUEST_URI']);
		$make       = $parse_url[3];

		$title = $post->post_title;
		if (!empty($make) && $title != ucwords($make)) {
			$title = ucwords($make) . " $title";
		}

		$title = "$title Car Insurance Cost - Compare Quotes Now";
	}

    return $title;
}
add_filter('wpseo_title','custom_title');

function custom_meta( $desc ){
	global $post;

	if (!$post) {
		return $desc;
	}

	if ('ais_agent' == $post->post_type && !is_archive()) {
		$desc = "Find a car insurance agent in USA or get an auto insurance quote.";
	}

	if ('vehicle' == $post->post_type || 'vehicle_quote' == $post->post_type) {
		$url = explode('/', $_SERVER['REQUEST_URI']);
		$make = ucwords(str_replace('-', ' ', $url[3]));

		if (empty($make)) {
			return $desc;
		}

		$title = $post->post_title;
		if (!empty($make) && $title != ucwords($make)) {
			$title = ucwords($make) . " $title";
		}

		$desc = "Compare $title car insurance costs and insurance quotes with AutoInsureSavings.org to find the best coverage rates.";
	}

	if ('city_state' == $post->post_type) {
		$states = get_states();

		$url       = explode('/', $_SERVER['REQUEST_URI']);
		@$state_key = ucwords(str_replace('-', ' ', $url[2]));

		@$state_abbv = $states[$state_key];

		if (empty($state_abbv)) {
			return $desc;
		}

		$desc = "Compare the best & cheapest car insurance in {$post->post_title}, $state_abbv or get insurance quotes from Grange, Arbella, Erie, Infinity, & more.";

		if (is_archive()) {
			$desc = "Find an affordable car insurance agent in $state_key or get an auto insurance quotes to get the best price.";
		}
	}

    return $desc;
}
add_filter('wpseo_metadesc','custom_meta');

function custom_canon($url) {
	global $post;

	if (!$post) {
		return $url;
	}

	if ('ais_agent' == $post->post_type || 'city_state' == $post->post_type || 'vehicle' == $post->post_type || 'vehicle_quote' == $post->post_type) {
		$url = '';
	}

	return $url;
}
add_filter('wpseo_canonical', 'custom_canon');

// We need to redirect back to the same page for comments
add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location) {
	return $_SERVER["HTTP_REFERER"];
}

function get_states() {
	return $states = [
		'Alabama'=>'AL',
		'Alaska'=>'AK',
		'Arizona'=>'AZ',
		'Arkansas'=>'AR',
		'California'=>'CA',
		'Colorado'=>'CO',
		'Connecticut'=>'CT',
		'Delaware'=>'DE',
		'Florida'=>'FL',
		'Georgia'=>'GA',
		'Hawaii'=>'HI',
		'Idaho'=>'ID',
		'Illinois'=>'IL',
		'Indiana'=>'IN',
		'Iowa'=>'IA',
		'Kansas'=>'KS',
		'Kentucky'=>'KY',
		'Louisiana'=>'LA',
		'Maine'=>'ME',
		'Maryland'=>'MD',
		'Massachusetts'=>'MA',
		'Michigan'=>'MI',
		'Minnesota'=>'MN',
		'Mississippi'=>'MS',
		'Missouri'=>'MO',
		'Montana'=>'MT',
		'Nebraska'=>'NE',
		'Nevada'=>'NV',
		'New Hampshire'=>'NH',
		'New Jersey'=>'NJ',
		'New Mexico'=>'NM',
		'New York'=>'NY',
		'North Carolina'=>'NC',
		'North Dakota'=>'ND',
		'Ohio'=>'OH',
		'Oklahoma'=>'OK',
		'Oregon'=>'OR',
		'Pennsylvania'=>'PA',
		'Rhode Island'=>'RI',
		'South Carolina'=>'SC',
		'South Dakota'=>'SD',
		'Tennessee'=>'TN',
		'Texas'=>'TX',
		'Utah'=>'UT',
		'Vermont'=>'VT',
		'Virginia'=>'VA',
		'Washington'=>'WA',
		'West Virginia'=>'WV',
		'Wisconsin'=>'WI',
		'Wyoming'=>'WY'
	];
}
