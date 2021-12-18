<?php
/**
 * Template Name: AIS Vehicle
 * Template Post Type: vehicle
 *
 * FB Landing Page Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phoenix
 */

 get_header(); ?>

 <main id="primary" class="site-main page">
   <div class="hero">
     <div class="container">
       <div class="row">
         <div class="col-md-12">

           <h1><?php the_title(); ?> Car Insurance</h1>

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
				 $company = strtolower(the_title('', '', false));

				 global $wpdb;
				 $query = $wpdb->prepare("
					 SELECT *
					   FROM auto_quotes AS aq
					   JOIN auto_images AS ai ON LOWER(REPLACE(ai.reference, ' ', '-')) = LOWER(REPLACE(aq.maker, ' ', '-'))
					  WHERE company = '%s'
				   GROUP BY maker, images", $company);

				 $vehicles = $wpdb->get_results($query);
			 ?>

			 <?php if (count($vehicles) > 0): ?>
				 <h2>Popular Models</h2>
				 <div class="vehicle-quotes">
					 <?php
						foreach ($vehicles as $vehicle) {
							echo "<div class='quote'>";
								$maker_url   = str_replace(' ', '-', $vehicle->maker);
								$company_url = str_replace(' ', '-', $vehicle->company);
								$img_url     = "/wp-content/themes/aiorg/img/cars/{$vehicle->images}";

								echo "<div class='img'><a href='/car-insurance/vehicles/$company_url/$maker_url-insurance-rates/'><img src='$img_url' /><b>{$vehicle->maker}</b></a></div>";
								echo "<p><a href='/car-insurance/vehicles/$company_url/$maker_url-insurance-rates/'>{$vehicle->maker} Insurance Cost</a></p>";
							echo "</div>";
						}
					 ?>
			 	</div>
			<?php endif; ?>
         </div>
       </div>
     </div>
   </div>
 </main><!-- #main -->

 <?php get_footer();
