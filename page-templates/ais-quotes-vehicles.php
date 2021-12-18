<?php
/**
 * Template Name: AIS Vehicle Quote
 * Template Post Type: vehicle_quote
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

			 <?php
			 	$parent = explode('/', $_SERVER['REQUEST_URI']);
				$make   = ucwords($parent[3]);
			 ?>

           <h1><?= $make ?: '' ?> <?php the_title(); ?> Car Insurance Cost</h1>


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

			 <?php echo do_shortcode('[vehicle_quotes]') ?>
         </div>
       </div>
     </div>
   </div>
 </main><!-- #main -->

 <?php get_footer();
