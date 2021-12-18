<?php
/**
 * Template Name: MDA Page
 *
 * MDA Page Template
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

          <h1><?php the_title(); ?></h1>

          <?php if (get_field('subhead')): ?>
          <h2 class="subhead"><?php the_field('subhead'); ?></h2>
          <?php endif; ?>

          <?php if (is_page('about')): ?>
          <img class="as-seen as-seen-full" src="/wp-content/themes/phoenix/images/as-seen-logos.svg" alt="As seen in...">
          <img class="as-seen as-seen-mobile" src="/wp-content/themes/phoenix/images/as-seen-logos-mobile.svg" alt="As seen in...">
          <?php endif; ?>

          <div id="mdatop" class="main-mda">
            
            <?php get_template_part('template-parts/content', 'topmda'); ?>

          </div>


        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="main-content">
			<?php if( function_exists( 'aioseo_breadcrumbs' ) ): ?>
				<div class="breadcrumb-wrap"><?php aioseo_breadcrumbs(); ?></div>
			<?php endif ?>
            <?php get_template_part(
                'template-parts/content',
                'post'
            ); ?>
        </div>
      </div>
    </div>
  </div>
</main><!-- #main -->

<?php get_footer();
