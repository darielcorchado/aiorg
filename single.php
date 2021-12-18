<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Phoenix
 */

get_header(); ?>

	<main id="primary" class="site-main">
		<div class="hero">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1><?php the_title(); ?></h1>
						<?php if (get_phoenix_subhead()): ?>
            				<h2 class="subhead"><?php phoenix_subhead(); ?></h2>
						<?php elseif( (get_field('usia_variant', 'option') == 'yes') &&
						function_exists('generate_subhead') && (is_singular('company') || is_singular('agent'))): ?>
							<h2 class="subhead"><?php echo generate_subhead(get_post()); ?></h2>
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
						<?php if( function_exists( 'aioseo_breadcrumbs' ) && aioseo_breadcrumbs(false)):

							$breadcrumb_classes = get_breadcrumb_site_class();
							if (get_field('hide_mda') == "yes") $breadcrumb_classes .= 'no-mt';

							?>
								<div class="breadcrumb-wrap <?php echo $breadcrumb_classes ?>">
									<?php aioseo_breadcrumbs(); ?>
							</div>

						<?php endif ?>
            <?php get_template_part(
                'template-parts/content',
                get_post_type()
            ); ?>
					</div>
				</div>
			</div>
      <?php if (is_singular('company') || is_singular('agent')): ?>
        <div class="row">
          <div class="col-md-12">
             <?php if (comments_open() || get_comments_number()):
                 comments_template();
             endif; ?>
          </div>
        </div>
      <?php endif; ?>

		<?php if (get_field('field_show_related_posts', 'option') === 'yes'): ?>
		<div class="row">
			<div class="col-md-12">
				<div class="main-content related-posts">
					<h2>Related Links</h2>

					<?php
						$post_type = get_post_type();
						$categories = get_the_category(get_the_ID());
						$category_ids = array();

						$args = array(
							'post_type' => $post_type,
					        'posts_per_page' => 10,
					        'post__not_in' => array(get_the_ID()),
					    );
					    $posts = get_posts($args);

					    $similar_args = array(
					        'post_type' => ['post', $post_type],
					        'post__not_in' => array(get_the_ID()),
					        'posts_per_page' => 4,
					        'orderby' => 'rand',
					    );

						if($post_type == 'post'){
							$category_id = $categories[0]->cat_ID;
							$args['cat'] = $category_id;

							foreach ($categories as $category):
								array_push($category_ids, $category->term_id);
							endforeach;

							$similar_args['category__in'] = $category_ids;
							$similar_args['post_type'] = 'post';
						}

					    $similar_posts = new WP_Query($similar_args);

						if(count($posts) > 0):
					?>
					<div class="related-group">
						<h4>Recent Articles</h4>

						<div class="related-posts">

							<?php
								foreach ($posts as $post):
									setup_postdata($post);
							?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
							<?php
								endforeach;
								wp_reset_postdata();
							?>

						</div>
					</div>

					<?php
					endif;
						if (have_rows('field_related_post', 'option')):
					?>
					<div class="related-group">
						<h4>Recent Insurance Answers</h4>

						<div class="related-posts">

							<?php
								while (have_rows('field_related_post', 'option')):
									the_row();
							?>
							<a href="<?php the_sub_field('related_post_permalink'); ?>"><?php the_sub_field('related_post_title'); ?></a><br>
							<?php
								endwhile;
							?>

						</div>
					</div>
					<?php
						endif;
						if($similar_posts->have_posts()):
					?>

					<div class="related-group">
						<h4>Similar Entries</h4>

						<div class="related-posts">

							<?php
								while ($similar_posts->have_posts()):
                    				$similar_posts->the_post();
							?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
							<?php
								endwhile;
								wp_reset_postdata();
							?>

						</div>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
		<?php endif; ?>

		</div>
	</main><!-- #main -->

	<div class="social-share social">
		<a class="link" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>?ref=facebook" target="_blank" rel="nofollow noopener noreferrer">
			<div class="icon facebook">
				<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="#ffffff" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
			</div>
		</a>

		<a class="link" href="https://twitter.com/intent/tweet?text=Reading:%20<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>%20<?php the_permalink(); ?>?ref=twitter" target="_blank" rel="nofollow noopener noreferrer">
			<div class="icon twitter">
				<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" class="svg-inline--fa fa-twitter fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#ffffff" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
			</div>
		</a>

		<a class="link" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>" target="_blank" rel="nofollow noopener noreferrer">
			<div class="icon linkedin">
				<svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" class="svg-inline--fa fa-linkedin-in fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#ffffff" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>
			</div>
		</a>
	</div>

<?php get_footer();
