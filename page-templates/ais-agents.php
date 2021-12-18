<?php

/**
 * Template Name: AIS Agent Cities
 * Template Post Type: city_state
 *
 * FB Landing Page Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phoenix
 */

 $city = $post->post_name;

 $parse_url  = explode("/", $_SERVER['REQUEST_URI']);
 $state_slug = $parse_url[2];

 global $wpdb;
 $query = $wpdb->prepare("
	 SELECT *, cis.title AS state_name, cis.title2 AS state_slug, cis.id AS state_id, cia.id AS agent_id, wp.ID as post_id, cic.title as city_title
	   FROM `car-insurance_city`   AS cic
	   JOIN `car-insurance_state`  AS cis ON cis.id = cic.state_id
	   JOIN `car-insurance_agents` AS cia ON cia.city_id  = cic.id
								         AND cia.state_id = cic.state_id
	   LEFT JOIN wp_posts          AS wp  ON wp.post_name    = LOWER(REPLACE(REPLACE(cia.name, '&', 'and'), ' ', '-'))
	   									 AND wp.post_excerpt = CONCAT(cia.address, ', ', cia.city, ' ', cia.zip)
	  WHERE cic.title2 = '%s'
	    AND cis.title2 = '%s'
	  GROUP BY cia.id, cia.name", $city, $state_slug);

 $agents_by_city = $wpdb->get_results($query);

 get_header(); ?>

 <main id="primary" class="site-main page">
   <div class="hero">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
		   <?php if (count($agents_by_city) > 0): ?>
           		<h1><?=  "{$agents_by_city[0]->city_title}, {$agents_by_city[0]->abv} Cheap Auto Insurance, Find Local Agents in {$agents_by_city[0]->state_name} for Maximum Savings" ?></h1>
	   	   <?php else: ?>
			   <h1><?php the_title(); ?></h1>
		   <?php endif; ?>

           <?php if (get_field('subhead')): ?>
               <h2 class="subhead"><?php the_field('subhead'); ?></h2>
           <?php endif; ?>

           <?php if (is_page('about')): ?>
               <img class="as-seen as-seen-full" src="/wp-content/themes/phoenix/images/as-seen-logos.svg" alt="As seen in...">
               <img class="as-seen as-seen-mobile" src="/wp-content/themes/phoenix/images/as-seen-logos-mobile.svg" alt="As seen in...">
           <?php endif; ?>

           <?php get_template_part('template-parts/content', 'topmda'); ?>


         </div>
       </div>
     </div>
   </div>

   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="main-content">
             <?php get_template_part('template-parts/content', get_post_type()); ?>

			 <?php
				 $query = $wpdb->prepare("
					 SELECT *
					   FROM `car-insurance_city`   AS cic
					  WHERE cic.state_id = %d
					    AND cic.title NOT LIKE '%Car Insurance%'
					  ORDER BY RAND()
					  LIMIT 20", $agents_by_city[0]->state_id);

				 $cities_by_state = $wpdb->get_results($query);
			 ?>

			 <div class="agent-dir">
				 <?php if (count($agents_by_city) > 0): ?>
					 <div class="agent-cities">
						 <p class='agent-titles'><a href='/car-insurance/<?= $agents_by_city[0]->state_slug ?>/'>All Agents in <?= $agents_by_city[0]->state_name ?></a></p>
						 <?php
							foreach ($agents_by_city as $agent) {
								echo "<div class='agent'>";
									if (!empty($agent->post_id)) {
										echo "<a href='/car-insurance/agents/{$agent->agent_id}/'><b>{$agent->name}</b></a><br>";
									} else {
										echo "<b>{$agent->name}</b><br>";
									}

									echo "{$agent->address}, {$agent->city}, {$agent->abv} {$agent->zip}<br>";
									echo "{$agent->phone}<br>";
								echo "</div>";
							}

							if (count($cities_by_state) > 0) {
								echo "<h3>Nearby Local Cities</h3>";
								echo "<ul class='city-columns'>";
									foreach ($cities_by_state as $city) {
										echo "<li><a href='/car-insurance/{$agents_by_city[0]->state_slug}/{$city->title2}/'>{$city->title}</a></li>";
									}
								echo "</ul>";
							}
						 ?>

						<h3>Pros & Cons of Each Insurance Company</h3>
	 					<p>Type car insurance company name in search bar to find the pros, cons, and ratings. Otherwise, each insurer is from highest to lowest rated.</p>
	 					<?php echo do_shortcode('[table id=1083 /]'); ?>

	 					<h3>Minimum Coverage by State, Uninsured Motorist Protection, & Personal Injury Protection</h3>
	 					<p>Type your state in the search to find details.</p>
	 					<?php echo do_shortcode('[table id=332 /]'); ?>
				 	</div>
				<?php else: ?>
					<div class="agent-cities">
						<p>There is no data for this city.</p>
					</div>
				<?php endif; ?>

				<div class="agent-extras">
					<?php echo do_shortcode('[table id=233 /]'); ?>
					<?php echo do_shortcode('[table id=2807 /]'); ?>

					<h3>Recent in Auto Insurance and Vehicles</h3>
					<ul>
						<li><a href="/missouri-cheapest-car-insurance/">Missouri Cheapest Car Insurance &amp; Best Coverage Options</a></li>
						<li><a href="/mississippi-cheapest-car-insurance/">Mississippi Cheapest Car Insurance &amp; Best Coverage Options</a></li>
						<li><a href="/minnesota-cheapest-car-insurance/">Minnesota Cheapest Car Insurance &amp; Best Insurance Options</a></li>
						<li><a href="/washington-cheapest-car-insurance/">Washington Cheapest Car Insurance &amp; Best Coverage Options</a></li>
						<li><a href="/indiana-cheapest-car-insurance/">Indiana Cheapest Car Insurance &amp; Best Insurance Options</a></li>
						<li><a href="/maryland-cheapest-car-insurance/">Maryland Cheapest Car Insurance &amp; Best Coverage Options</a></li>
						<li><a href="/michigan-cheapest-car-insurance/">Michigan Cheapest Car Insurance &amp; Best Insurance Options</a></li>
						<li><a href="/florida-cheapest-car-insurance/">Florida Cheapest Car Insurance &amp; Best Insurance Coverage Options</a></li>
						<li><a href="/texas-cheapest-car-insurance/">Texas Cheapest Car Insurance &amp; Best Coverage Options</a></li>
						<li><a href="/south-dakota-cheapest-car-insurance/">South Dakota Cheapest Car Insurance &amp; Best Coverage Options</a></li>
					</ul>
				</div>
			</div>
         </div>
       </div>
     </div>
   </div>
 </main><!-- #main -->

 <?php get_footer();
