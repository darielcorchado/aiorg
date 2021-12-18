<?php
/**
 * Template Name: Kraken
 *
 * Kraken Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phoenix
 */

get_header(); ?>

<style>
  main#primary .kraken-wrapper {
    max-width: 1200px !important;
    margin-top: 20px;
  }

  main#primary .kraken-wrapper .row.equal-height {
    display: flex;
    flex-wrap: wrap;
  }

  main#primary .kraken-wrapper .row.equal-height [class*="col-"]{
    display: flex;
    flex-direction: column;
  }

  main#primary .kraken-wrapper h2::before {
    margin: 0 0 30px 0;
  }

  main#primary .kraken-wrapper h2:first-of-type::before {
    display: none;
  }

  main#primary .kraken-wrapper table {
    display: table;
  }

  main#primary .kraken-wrapper table thead tr th:last-of-type {
    min-width: 0;
    text-align: center;
  }

  main#primary .kraken-wrapper table tbody tr td strong {
    display: inline-block;
    font-size: 24px;
    line-height: 2;
    margin-top: -8px;
  }

  main#primary .kraken-wrapper table tbody tr td {
    font-size: 14px;
    vertical-align: middle;
  }

  main#primary .kraken-wrapper table tbody tr td:last-of-type {
    text-align: center;
  }

  main#primary .kraken-wrapper table tbody tr td:last-of-type strong {
    font-size: 20px;
    line-height: 1.6;
    margin-top: 0;
  }

  main#primary .kraken-wrapper .toc-wrapper .toc {
    width: 320px;
  }

  main#primary .kraken-wrapper .toc-wrapper .toc.fixed, main#primary .kraken-wrapper .toc-wrapper .toc-indicator {
    position: fixed;
    top: 140px;
  }

  main#primary .kraken-wrapper .toc-wrapper .toc.absolute {
    position: absolute;
    top: unset;
    bottom: 20px;
  }

  main#primary .kraken-wrapper .toc-wrapper .toc h3 {
    margin-top: 0;
  }

  main#primary .kraken-wrapper .toc-wrapper .toc .toc-links a {
    display: block;
    font-size: 14px;
    line-height: 1.4;
    padding: 4px 0 4px 18px;
    border: none;
    border-left: 2px solid #eee;

    -webkit-transition: border-color 0.2s ease;
    -moz-transition: border-color 0.2s ease;
    -o-transition: border-color 0.2s ease;
    transition: border-color 0.2s ease;
  }

  main#primary .kraken-wrapper .toc-wrapper .toc .toc-links a.active, main#primary .kraken-wrapper .toc-wrapper .toc .toc-links a:hover, main#primary .kraken-wrapper .toc-wrapper .toc .toc-links a:focus {
    color: #5c9ead;
    border-color: #5c9ead;
  }
</style>

<main id="primary" class="site-main page">
  <div class="hero">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <h1><?php the_title(); ?></h1>

          <?php if (get_field('subhead')): ?>
          <h2 class="subhead"><?php the_field('subhead'); ?></h2>
          <?php endif; ?>

          <div id="mdatop" class="main-mda">
            
            <?php get_template_part('template-parts/content', 'topmda'); ?>

          </div>


        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="main-content">
      <div class="row">
        <div class="col-md-12">

          <?php get_template_part('template-parts/content', 'eat'); ?>

        </div>
      </div>
    </div>

    <div class="main-content kraken-wrapper">
      <div class="row equal-height">
        <div class="col-md-4 toc-wrapper">
          <div class="toc-indicator"></div>
          <div class="toc">
            <h3>On This Page</h3>

            <div class="toc-links"></div>

          </div>
        </div>

        <div class="col-md-8">
              
          <?php 
            if (have_posts()): 
              while (have_posts()): 
                the_post(); 

                the_content();
              endwhile;
            endif;
          ?>

        </div>
      </div>
    </div>
  </div>
</main><!-- #main -->

<script>
  (function($) {

    $(document).ready(function() {
      var toc_links = '';

      $('.kraken-wrapper h2, .kraken-wrapper h3').each(function() {
        if ($(this).html() !== 'On This Page') {
          var title = $(this).html(),
              link = replaceAll(title, ' ', '-').toLowerCase();

          $(this).attr('id', link);
          toc_links = toc_links + '<a href="#' + link + '" onclick="toc_click(event, this);">' + title + '</a>';
        }
      });

      $('.toc-links').html(toc_links);
    });

    $(window).on('scroll', function() {
      var toc_top = $('.toc-wrapper').offset().top,
          window_top = $(window).scrollTop(),
          toc_offset = ($('.toc-indicator').offset().top - $('.toc-wrapper').offset().top) - ($('.toc-wrapper').height() - $('.toc').height());

      if ((toc_top - window_top) < 141) {
        $('.toc').addClass('fixed');
      }
      else {
        $('.toc').removeClass('fixed');
      }

      if (toc_offset > -20) {
        $('.toc').addClass('absolute');
      }
      else {
        $('.toc').removeClass('absolute');
      }

      $('.kraken-wrapper h2, .kraken-wrapper h3').each(function() {
        if ($(this).isInViewport()) {
          if (!$(this).hasClass('active')) {
            $('.kraken-wrapper h2, .kraken-wrapper h3').removeClass('active');
            $('.toc-links a').removeClass('active');

            $(this).addClass('active');
            $('.toc-links a[href="#' + $(this).attr('id') + '"]').addClass('active');
          }
        }
      });
    });

  })(jQuery);

  $.fn.isInViewport = function() {
    var elementTop = $(this).offset().top - 600,
        elementBottom = elementTop + $(this).outerHeight(),
        viewportTop = $(window).scrollTop(),
        viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
  };

  function toc_click(e, t) {
    e.preventDefault();

    $('html, body').stop().animate({
      scrollTop: $($(t).attr('href')).offset().top - 130
    }, 600, 'easeInOutExpo');
  }

  function replaceAll(string, search, replace) {
    return string.split(search).join(replace);
  }
</script>

<?php get_footer();
