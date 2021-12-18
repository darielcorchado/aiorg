<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
            <!-- Zip code form will go here -->
			<?php

			$ai_variants = [BLOG_NAME_CAI, BLOG_NAME_FCI, BLOG_NAME_GIQ, BLOG_NAME_BFI, BLOG_NAME_CIC, BLOG_NAME_AIS];

			if (in_array(strtolower(get_bloginfo('name')), $ai_variants)) {
				get_template_part('template-parts/content', 'topmda');
			}?>
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
								<div class="breadcrumb-wrap no-mt <?php echo get_breadcrumb_site_class()?>">
									<?php	aioseo_breadcrumbs(); ?>
							</div>
						<?php endif ?>
            <?php get_template_part(
                'template-parts/content',
                get_post_type()
            ); ?>
        </div>
      </div>
    </div>
  </div>
</main><!-- #main -->

<?php get_footer();
