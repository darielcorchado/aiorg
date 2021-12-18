<?php
/**
 * Template Name: Landing Page - Facebook
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

          <h1><?php the_title(); ?></h1>

          <?php if (get_field('subhead')): ?>
          <h2 class="subhead"><?php the_field('subhead'); ?></h2>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">

          <div id="mdatop" class="main-mda">
            
            <?php get_template_part('template-parts/content', 'topmda'); ?>

          </div>


        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <img class="as-seen as-seen-full" src="/wp-content/themes/phoenix/images/as-seen-logos.svg" alt="As seen in...">
          <img class="as-seen as-seen-mobile" src="/wp-content/themes/phoenix/images/as-seen-logos-mobile.svg" alt="As seen in...">
        </div>
      </div>
    </div>
  </div>
  <div id="steps-info">
    <div class="container">
      <div class="row">
        <div class="col-md-12 drivers-save">
          <?php if (get_field('drivers_save_text', 'option')): ?>
            <?php echo get_field('drivers_save_text', 'option'); ?>
          <?php else: ?>
            <h2>Drivers can save <em>$610/yr*</em> by comparing
               <?php echo strtolower(get_field('auto_synonym', 'option')); ?>
             insurance</h2>
            <p>*based on an industry survey</p>
         <?php endif; ?>
        </div>
      </div>
    </div>

    <div id="blurbs">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-12">

            <a href="#mdatop">
              <div id="blurb-0" class="blurb-column">
                <div class="blurb">
                  <div class="blurb-content">

                    <div class="blurb-image blurb-0">
                      <img src="/wp-content/themes/phoenix/images/location.svg" />
                    </div>

                    <div class="blurb-container">
                      <h4>Step 1</h4>

                      <div class="blurb-description">
                        <p>Enter ZIP Code</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

          <div class="col-md-4 col-xs-12">

            <a href="#mdatop">
              <div id="blurb-1" class="blurb-column">
                <div class="blurb">
                  <div class="blurb-content">
                    <div class="blurb-image blurb-1">
                      <img src="/wp-content/themes/phoenix/images/document.svg">
                    </div>

                    <div class="blurb-container">
                      <h4>Step 2</h4>

                      <div class="blurb-description">
                        <p>Vehicle Details</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>

          <div class="col-md-4 col-xs-12">

            <a href="#mdatop">
              <div id="blurb-2" class="blurb-column">
                <div class="blurb">
                  <div class="blurb-content">
                    <div class="blurb-image blurb-1">
                    <img src="/wp-content/themes/phoenix/images/money.svg">
                    </div>

                    <div class="blurb-container">
                      <h4>Step 3</h4>

                      <div class="blurb-description">
                        <p>Compare and Save!</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>

          </div>
        </div><!-- end of row -->

        <div class="row">
          <div class="col-md-12">
            <div class="divider-text">
              <p>Stop overpaying for coverage – <a href="#mdatop">enter your ZIP code to COMPARE and SAVE!</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="main-content">
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
