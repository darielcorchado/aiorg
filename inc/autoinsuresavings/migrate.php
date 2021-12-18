<?php

//$wpdb->get_results("DELETE FROM wp_posts WHERE post_type = 'ais_agent'");

return;

die("Don't run this");

global $wpdb;
$wpdb->show_errors();

$now = new \DateTime('now');
$now = $now->format('Y-m-d H:i:s');

// MIGRATION ADd state taxonomy terms
/*function add_states_tax() {
	global $wpdb;

	$states = $wpdb->get_results("
		SELECT *
		  FROM `car-insurance_state` AS cis
		  GROUP BY cis.title
	");

	print_r($states);

	foreach ($states as $state) {
		wp_insert_term($state->title, 'states', [
			'slug' => $state->title2,
		]);
	}
}

add_action('init', 'add_states_tax');

die("STOP");*/

// !!!!! Migrate agent States. SEE BELOW for code that needs to be run in functions.php

// Migrate Agent cities
/*$cities = $wpdb->get_results("
	SELECT cis.title AS state_title, cic.title AS city_title, cic.title2 AS city_title2
	  FROM `car-insurance_city`   AS cic
	  JOIN `car-insurance_state`  AS cis ON cis.id = cic.state_id
	  JOIN `car-insurance_agents` AS cia ON cia.city_id = cic.id
	  					  				AND cia.state_id = cis.id
 LEFT JOIN wp_posts AS wp ON wp.post_title = cic.title
                         AND wp.post_type = 'city_state'
                         AND wp.post_status = 'publish'

	WHERE cic.title NOT LIKE '%Cheapest Car Insurance%'
	  AND wp.ID is null
    GROUP BY cis.id, cic.title
");

echo "There should be " . count($cities) . " posts<br>";

foreach ($cities as $city) {
	$new_post = $wpdb->insert('wp_posts', [
		'post_title'    => $city->city_title,
		'post_content'  => '',
		'post_date'     => $now,
		'post_date_gmt' => $now,
		'post_name'     => strtolower(str_replace(' ', '-', $city->city_title2)),
		'post_status'   => 'publish',
		'post_type'     => 'city_state'
	]);
}



die("DONE");*/
// !!!! Assign state taxonomies via functions.php



// Add State/City relationships
$cities = $wpdb->get_results("
	SELECT wp.ID, cis.title AS state_title, t.term_id, t.name AS term_name
	  FROM wp_posts AS wp
	  JOIN `car-insurance_city`  AS cic ON LOWER(cic.title) = LOWER(wp.post_title)
	  JOIN `car-insurance_state` AS cis ON cis.id = cic.state_id
	  JOIN wp_terms 			 AS t   ON LOWER(t.name) = LOWER(cis.title)
	 WHERE wp.post_type   = 'city_state'
	   AND wp.post_status = 'publish'
	   GROUP BY wp.ID
");


echo count($cities) . " Records. <br />";

foreach ($cities as $city) {
	$term    = $city->state_title;
	$post_id = $city->ID;

	$cities = $wpdb->get_results("INSERT IGNORE INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES ($post_id, {$city->term_id}, 0)");
	//$wpdb->get_results("DELETE FROM wp_term_relationships WHERE object_id = $post_id");
}

die("STOP");




$query = $wpdb->prepare("
	SELECT *, cis.title AS state_title, cic.title AS city_title, cia.name AS agent_name
	  FROM wp_posts AS wp
	  JOIN `car-insurance_agents` AS cia ON LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-')) = wp.post_name
										AND CONCAT(cia.address, ', ', cia.city, ' ', cia.zip) = wp.post_excerpt

	 WHERE wp.post_type = 'ais_agent'
	   GROUP BY wp.ID, cia.name, cia.address", $agent_slug);


/*INSERT IGNORE INTO wp_postmeta
(SELECT null, wp.ID, 'original_agent_id', cia.id
   FROM wp_posts AS wp
   JOIN `car-insurance_agents` AS cia ON LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-')) = wp.post_name
								     AND CONCAT(cia.address, ', ', cia.city, ' ', cia.zip) = wp.post_excerpt
  WHERE wp.post_type = 'ais_agent'
  GROUP BY wp.ID, cia.id)

  INSERT IGNORE INTO wp_postmeta
  (SELECT null, wp.ID, '_original_agent_id', 'field_60ec87ace17ce'
     FROM wp_posts AS wp
     JOIN `car-insurance_agents` AS cia ON LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-')) = wp.post_name
  								     AND CONCAT(cia.address, ', ', cia.city, ' ', cia.zip) = wp.post_excerpt
    WHERE wp.post_type = 'ais_agent'
    GROUP BY wp.ID, cia.id)

	*/

/*INSERT IGNORE INTO wp_posts
(SELECT null, 0, now(), now(), '', cia.name, CONCAT(cia.address, ', ', cia.city, ' ', cia.zip), 'publish', 'open', 'open', '', LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-')) as post_name,
'', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '', 0, 'ais_agent', '', 0 FROM `car-insurance_agents` AS cia LIMIT 500)
*/

// Meta values added to wp_postmeta for yoast state value and term assignment
/*INSERT IGNORE INTO wp_postmeta
(SELECT NULL, p.ID, '_yoast_wpseo_primary_states', wtr.term_taxonomy_id
FROM wp_posts AS p
JOIN wp_term_relationships AS wtr ON wtr.object_id = p.ID
WHERE p.post_type = 'city_state');*/


// 1. Migrate the wp_postmeta data
// 2. Commit code for changes to agent_city_state_permalinks
// 3. 

/*$states = $wpdb->get_results("
	SELECT *
	  FROM `car-insurance_agents` AS cia
	 LEFT JOIN wp_posts AS wp ON wp.post_title = cia.name
	                         AND wp.post_type = 'ais_agent'
	                         AND wp.post_status = 'publish'
							 AND wp.post_excerpt = LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-'))
	 WHERE wp.ID is null
	 GROUP BY cia.id, cia.name
	 LIMIT 20
");

echo count($states) . " Records. <br />";

foreach ($states as $state) {
	$wpdb->insert('wp_posts', [
		'post_title'    => $state->name,
		'post_content'  => '',
		'post_date'     => $now,
		'post_date_gmt' => $now,
		'post_name'     => strtolower(str_replace(' ', '-', str_replace('&', 'and', $state->name))),
		'post_status'   => 'publish',
		'post_excerpt'  => "{$state->address}, {$state->city} {$state->zip}",
		'post_type'     => 'ais_agent',
		'comment_status' => 'open'
	]);
}

die("STOP");
*/


$major_car_companies = [
	'Acura',
	'Alfa Romeo',
	'Audi',
	'BMW',
	'Bentley',
	'Buick',
	'Cadillac',
	'Chevrolet',
	'Chrysler',
	'Dodge',
	'Fiat',
	'Ford',
	'GMC',
	'Genesis',
	'Honda',
	'Hyundai',
	'Infiniti',
	'Jaguar',
	'Jeep',
	'Kia',
	'Land Rover',
	'Lexus',
	'Lincoln',
	'Lotus',
	'Maserati',
	'Mazda',
	'Mercedes-Benz',
	'Mercury',
	'Mini',
	'Mitsubishi',
	'Nikola',
	'Nissan',
	'Polestar',
	'Pontiac',
	'Porsche',
	'Ram',
	'Rivian',
	'Rolls-Royce',
	'Saab',
	'Saturn',
	'Scion',
	'Smart',
	'Subaru',
	'Suzuki',
	'Tesla',
	'Toyota',
	'Volkswagen',
	'Volvo'
];

$major_car_companies = implode('\', \'', $major_car_companies);

// Main car companies migrations
$vehicles = $wpdb->get_results("SELECT * FROM auto_internallinks WHERE reference IN ('$major_car_companies')");
$models   = $wpdb->get_results("
      SELECT *
        FROM auto_internallinks AS ai
   LEFT JOIN wp_posts AS wp ON wp.post_title = ai.reference
                           AND wp.post_type = 'vehicle_quote'
                           AND wp.post_status = 'publish'
       WHERE reference NOT IN ('$major_car_companies')
         AND wp.ID is null");

$vehicle_data = [];
foreach ($vehicles as $vehicle) {
	if (strpos($vehicle->reference, 'Top content') !== false || strpos($vehicle->reference, 'Bottom content') !== false ||
        strpos($vehicle->reference, 'Top') !== false || strpos($vehicle->reference, 'Bottom') !== false || strpos($vehicle->reference, 'home') !== false) {
		continue;
	}

	$vehicle_data[$vehicle->reference][$vehicle->position] = $vehicle->seocode;
}

$model_data = [];
foreach ($models as $model) {
	if (strpos($model->reference, 'Top content') !== false || strpos($model->reference, 'Bottom content') !== false ||
        strpos($model->reference, 'Top') !== false || strpos($model->reference, 'Bottom') !== false || strpos($model->reference, 'home') !== false) {
		continue;
	}

	$model_data[$model->reference][$model->position] = $model->seocode;
}


$vehicles_ran = $wpdb->get_results("
	SELECT *
	FROM wp_posts
	WHERE post_type   = 'vehicle'
	  AND post_status ='publish'
");

if (count($vehicles_ran) == 0) {
	foreach ($vehicle_data as $vehicle => $data) {
		$wpdb->insert('wp_posts', [
			'post_title'    => $vehicle,
			'post_content'  => $data['top'] . $data['bottom'],
			'post_date'     => $now,
			'post_date_gmt' => $now,
			'post_name'     => strtolower(str_replace(' ', '-', $vehicle)),
			'post_status'   => 'publish',
			'post_type'     => 'vehicle'
		]);

		sleep(1);
	}
} else {
	echo "No more vehicles<br>";
}

sleep(5);

$models_ran = $wpdb->get_results("
	SELECT *
	FROM wp_posts
	WHERE post_type   = 'vehicle_quote'
	  AND post_status ='publish'
");

if (count($models_ran) == 0) {
	$count = 0;

	foreach ($model_data as $model => $data) {
		// DB get's heavy so lets give em a break
		if ($count % 10 == 0) {
			sleep(3);
		}

		$query = $wpdb->get_results("
    		SELECT aq.company, aq.maker
    		  FROM auto_quotes AS aq
    		 WHERE maker = LOWER('$model')
    	  GROUP BY aq.company, aq.maker");


  	  	$parent    = !empty($query) ? $query[0]->company : '';
		if ($model == 'Accord Plug-In') {
			$parent = 'Honda';
		}

	  	$post      = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_title = '$parent' and post_type = 'vehicle'");
		$parent_id = !empty($parent) ? $post[0]->ID : 0;

        if (in_array($parent, ['MINI', 'Nissan'])) {
			// Do manually
            $parent_id = 0;
        }

		$wpdb->insert('wp_posts', [
			'post_title'    => $model,
			'post_content'  => $data['top'] . $data['bottom'],
			'post_date'     => $now,
			'post_date_gmt' => $now,
			'post_name'     => strtolower(str_replace(' ', '-', $model)) . '-insurance-rates',
			'post_status'   => 'publish',
			'post_type'     => 'vehicle_quote',
			'post_parent'   => $parent_id
		]);

		$count++;
	}
} else {
	echo "No more models<br>";
}

die("DONE");






// Below is for state taxonomies. It needs to run in functions.php on init somewhere

$states = $wpdb->get_results("
	SELECT *
	  FROM `car-insurance_state` AS cis
	  GROUP BY cis.title
");

foreach ($states as $state) {
	wp_insert_term($state->title, 'states', [
		'slug' => $state->title2,
	]);
}
