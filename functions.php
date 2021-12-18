<?php
/**
 * aiorg child theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Project Phoenix
 */

const SITE_NAME_CIC = 'carinsurancecompanies';

const BLOG_NAME_FCI  = 'florida car insurance';
const BLOG_NAME_GIQ  = 'gap insurance quotes';
const BLOG_NAME_CIC  = 'car insurance companies';
const BLOG_NAME_BFI  = 'broadforminsurance.org';
const BLOG_NAME_AIS  = 'auto insure saving';

const BLOG_POSTS_PER_PAGE    = 9;
const BLOG_IMAGE_DEFAULT_URL = '/wp-content/themes/phoenix/images/noimage-10914_400x250.jpg';

/**
 * Enqueue scripts and styles
 */
function aiorg_scripts()
{
	global $wp_query;

    wp_enqueue_style(
        'muli-font',
        'https://fonts.googleapis.com/css2?family=Muli:wght@400;500;600;700;800;900&display=swap',
        [],
        _S_VERSION
    );

    wp_enqueue_style(
        'aiorg',
        '/wp-content/themes/aiorg/css/aiorg.css',
        [],
        _S_VERSION
    );

	/*wp_register_script( 'main-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), false, true );

	wp_localize_script( 'main-script', 'params', array(
		'ajaxurl'      => admin_url('admin-ajax.php'), // WordPress AJAX
		'posts'        => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
		'action'       => 'loadmore',
		'max_page'     => $wp_query->max_num_pages
	));*/

	wp_enqueue_script( 'main-script' );
}
add_action('wp_enqueue_scripts', 'aiorg_scripts');

/**
 * Add category landing page shortcode
 */
function pull_category_posts()
{
    global $post;

    $url_parts = explode('/', $_SERVER['REQUEST_URI']);
	$paged = (get_query_var('paged')) ? (get_query_var('paged') - 1) * 10 : 0;

    $category = $url_parts[1];

    $count = array(
        'posts_per_page' => -1,
        'category_name' => $category,
    );
    $count_posts = count(get_posts($count));

    $args = array(
        'posts_per_page' => 10,
        'category_name' => $category,
        'offset' => $paged,
    );
    $posts = get_posts($args);

    foreach ($posts as $post):
        setup_postdata($post);

        $featured_class;
        $featured_id = get_post_thumbnail_id();
        $featured_url_array = wp_get_attachment_image_src($featured_id, 'full', true);
        $featured_url = $featured_url_array[0];

        if (strpos($featured_url, 'default.png') !== false):
            $featured_class = ' default-image';
            $featured_url = get_theme_mod('phoenix_default_image');
        else:
            $featured_class = '';
        endif;

        $content .= '<div class="category-post">';
        $content .= '<h2><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
        $content .= '<a href="' . get_the_permalink() . '"><div class="featured-image' . $featured_class . '" style="background-image: url(' . $featured_url . ');"></div></a>';
        $content .= '<div class="excerpt">' . custom_excerpt(72) . ' <a href="' . get_the_permalink() . '">Continue Reading</a></div>';
        $content .= '</div>';
    endforeach;
    wp_reset_postdata();

    $content .= '<div class="category-pagination">';

    $page_count = 0;
    while ($page_count < ($count_posts) / 10):
        $page_count++;

        if ($page_count === 1):
            $content .= '<a href="/' . $category . '/" class="page">' . $page_count . '</a>';
        else:
            $content .= '<a href="/' . $category . '/page/' . $page_count . '/" class="page">' . $page_count . '</a>';
        endif;
    endwhile;

    $content .= '</div>';
    $content .= '<script>(function($){$(document).ready(function(){$(".page").each(function(){if($(this).attr("href")===window.location.pathname){$(this).addClass("active");}});});})(jQuery);</script>';

    echo $content;
}
add_shortcode('pull_category_posts', 'pull_category_posts');

/**
 * Get custom excerpt
 */
function custom_excerpt($limit)
{
    return wp_trim_words(get_the_excerpt(), $limit);
}

/**
 * Get custom excerpt
 */
function count_posts($category) {
    if (is_string($category)):
        $category_id = get_cat_ID($category);
    elseif (is_numeric($category)):
        $category_id = $category;
    else:
        return 0;
    endif;

    $category = get_category($category_id);

    return $category->count;
}

/** Sort companies alphabetically */
add_action( 'pre_get_posts', 'change_company_sort_order');
function change_company_sort_order($query){
    if(is_post_type_archive('company')):
       $query->set( 'order', 'ASC' );
       //Set the orderby
       $query->set( 'orderby', 'title' );
    endif;
}

/**
 * Add tag support to pages
 */
function page_tags() {
  register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'page_tags');

/**
 * Unregister Company CPT
 */
function unregister_company_cpt() {
	unregister_post_type( 'company' );
}

/**
 * Unregister Credit Companies CPT
 */
function unregister_credit_company_cpt() {
	unregister_post_type( 'credit_company' );
}

// Unregister Company CPT for CIC
if (strpos(strtolower(get_bloginfo('name')), SITE_NAME_CIC) !== false) {
	add_action('init', 'unregister_company_cpt', 20);
}

if (strtolower(get_bloginfo('name')) == BLOG_NAME_FCI ||
    strtolower(get_bloginfo('name')) == BLOG_NAME_GIQ ||
	strtolower(get_bloginfo('name')) == BLOG_NAME_BFI ||
	strtolower(get_bloginfo('name')) == BLOG_NAME_CIC ||
	strtolower(get_bloginfo('name')) == BLOG_NAME_BFI) {

	add_action('init', 'unregister_company_cpt', 20);
	add_action('init', 'unregister_credit_company_cpt', 20);
}

function render_blank() {
	return;
}

add_shortcode('insert', 'render_blank');
add_shortcode('divider', 'render_blank');

function print_menu_shortcode($atts=[], $content = null) {
    $shortcode_atts = shortcode_atts([ 'name' => '', 'class' => '' ], $atts);
    $name   = $shortcode_atts['name'];
    $class  = $shortcode_atts['class'];

    return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );
}

add_shortcode('add_menu', 'print_menu_shortcode');

/**
 * AI specific ai fields
 */
require get_stylesheet_directory() . '/inc/acfconfig.php';

/**
 * Tracking scripts
 */
require get_stylesheet_directory() . '/inc/tracking.php';

if (strtolower(get_bloginfo('name')) == BLOG_NAME_AIS) {
	require get_stylesheet_directory() . '/inc/autoinsuresavings/ais-functions.php';
}

if(get_field('usia_variant', 'option') == 'yes') {
  /**
   * Functions related to USIA custom post types
   */
  require get_stylesheet_directory() . '/inc/usia/agents.php';
  require get_stylesheet_directory() . '/inc/usia/answers.php';
  require get_stylesheet_directory() . '/inc/usia/agency-resources.php';

  /**
   * USIA ACF CONFIG
   */
  require get_stylesheet_directory() . '/inc/usia/usia-acfconfig.php';

  /**
   * USIA custom fucntions
   */
  require get_stylesheet_directory() . '/inc/usia/usia-functions.php';

  /**
   * Registers the taxonomies
   */
  require  get_stylesheet_directory() . '/inc/insurance-type-taxonomy.php';
  require  get_stylesheet_directory() . '/inc/city-taxonomy.php';
  require  get_stylesheet_directory() . '/inc/usia/resource-type-taxonomy.php';

  /**
   * USIA Adding answer and company post types to tags archive
   */
  function wpa_cpt_tags( $query ) {
      if ( $query->is_tag() && $query->is_main_query() ) {
          $query->set( 'post_type', array( 'post', 'answer', 'company' ) );
      }
  }
  add_action( 'pre_get_posts', 'wpa_cpt_tags' );
}



function articles_infinite_scroll($atts) {
	$values = shortcode_atts(
        [
        	'post'     => '',
            'category' => '',
            'columns'  => 3,
			'style'    => ''
        ],
        $atts
    );

	$style_class = '';
	$article_column_width = 4;
	if (strtolower($values['style']) == 'alt') {
		$style_class = 'alt-style';
		$article_column_width = 12;
	}

	$posts_per_page;
	$posts_per_page = isset($_GET['scroll']) ? (int)$_GET['scroll'] * BLOG_POSTS_PER_PAGE : BLOG_POSTS_PER_PAGE;

	if ($values['post'] !== ''):
		$args = array(
			'posts_per_page' => $posts_per_page,
			'post_type' => $values['post']
		);
	elseif ($values['category'] !== ''):
		$args = array(
			'posts_per_page' => $posts_per_page,
			'category_name' => $values['category']
		);
	else:
		$args = array(
			'posts_per_page' => $posts_per_page
		);
	endif;

	$all_articles = new WP_Query(['post_type' => $values['post'], 'category_name' => $values['category']]);
	$articles     = new WP_Query($args);

	$content = '
		<div class="container article-container" data-post-count="' . $all_articles->post_count . '">
			<div class="articles-wrapper">
				<div class="row">';

	if ($articles->have_posts()):
	    while ($articles->have_posts()):
	        $articles->the_post();

	        $output      = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content(), $matches);
    		$first_image = isset($matches[1][0]) ? $matches[1][0]: null;

    		if (get_the_post_thumbnail() !== '' ):
				$featured_id        = get_post_thumbnail_id();
				$featured_url_array = wp_get_attachment_image_src($featured_id, 'et-pb-post-main-image', true);
				$article_image      = $featured_url_array[0];
			else:
				$article_image = $first_image;
			endif;

			if ($article_image === null):
				$article_image = BLOG_IMAGE_DEFAULT_URL;
			endif;

			if ($values['columns'] === 3):
				$content = $content . '
					<div class="col-lg-' . $article_column_width . '">
						<a href="' . get_the_permalink() . '">
							<article class="article ' . $style_class . '">
								<div class="image" style="background-image: url(' . $article_image . ');"></div>

								<div class="content">
									<h2 class="entry-title">' . mb_strimwidth(get_the_title(), 0, 54, '...') . '</h2>

									<a href="' . get_the_permalink() . '" class="more-link">Read More</a>
								</div>
							</article>
						</a>
					</div>
				';
			else:
				$content = $content . '
					<div class="col-lg-6">
						<a href="' . get_the_permalink() . '">
							<article class="article two">
								<div class="image" style="background-image: url(' . $article_image . ');"></div>

								<div class="content">
									<h2 class="entry-title">' . mb_strimwidth(get_the_title(), 0, 54, '...') . '</h2>

									<a href="' . get_the_permalink() . '" class="more-link">Read More</a>
								</div>
							</article>
						</a>
					</div>
				';
			endif;

		endwhile;
	endif;
	wp_reset_postdata();

	$content = $content . '
				</div>

				<div class="row">
					<div class="col-lg-12">
						<center>
							<div class="load-articles"></div>
							<div class="articles-loader"></div>
						</center>
					</div>
				</div>
			</div>
		</div>
	';

	return $content;
}
add_shortcode('articles', 'articles_infinite_scroll');






function get_vehicle_quotes() {
	global $post;
	global $wpdb;

	$quotes_query = $wpdb->prepare("
		SELECT CONCAT(aq.model, ' ', aq.company, ' ', aq.maker) as full_title, aq.model, aq.company, aq.maker,
		       ar.average, ar.list, ar.trim

		  FROM auto_quotes       AS aq
		  LEFT JOIN auto_results AS ar ON ar.reference = CONCAT(aq.model, ' ', aq.company, ' ', aq.maker)
		 WHERE maker = %s
	  GROUP BY maker, company, model
	  ORDER BY model DESC", $post->post_title);

	$quotes = $wpdb->get_results($quotes_query);

	$content  = '';

	foreach ($quotes as $quote) {
		$agent_query = $wpdb->prepare("
			SELECT *
			  FROM auto_quotes AS aq
			 WHERE maker   = %s
			   AND company = %s
			   AND model   = %d
	      ORDER BY insurance
		", $quote->maker, $quote->company, $quote->model);

		$agencies = $wpdb->get_results($agent_query);

		$content .= "<div class='vehicle-quote-summary'>";
			$content .= "<div class='quote-column'>";
				$content .= "<h2>{$quote->full_title}</h2>";
				$content .= "<table class='quote-table'>";
					$content .= "<tr><th>Cheapest Insurance Companies</th><th>Average Annual Cost</th></tr>";

					foreach ($agencies as $agency) {
						$content .= "<tr>";
							$content .= "<td>{$agency->insurance}</td>";
							$content .= "<td>\${$agency->price}</td>";
						$content .= "</tr>";
					}

				$content .= "</table>";
			$content .= "</div>";

			$content .= "<div class='quote-column right'>";
				$content .= "<div class='quote-segment'>";
					$content .= "<h3>Compare all {$quote->full_title} rates</h3>";
					$content .= "<div class=\"jump-container\"><a class=\"button page-scroll\" href=\"#mdatop\">Start Now →</a></div>";
				$content .= "</div>";

				$content .= "<div class='quote-segment'>";
					$content .= "<h3>Average Cost to Insure Per Year</h3>";
					$content .= "<p class='price'>\${$quote->average}</p>";
				$content .= "</div>";

				$content .= "<div class='quote-segment'>";
					$content .= "<h3>List Price</h3>";
					$content .= "<p class='price'>\${$quote->list}</p>";
				$content .= "</div>";

				$content .= "<div class='quote-segment'>";
					$content .= "<h3>Trims Available</h3>";
					$content .= "<p>{$quote->trim}</p>";
				$content .= "</div>";
			$content .= "</div>";
		$content .= "</div>";
	}

	return $content;
}

add_shortcode('vehicle_quotes', 'get_vehicle_quotes');

function get_breadcrumb_site_class(){
	if ( in_array(strtolower(get_bloginfo('name')), [BLOG_NAME_CAI, BLOG_NAME_FCI]) ){
		return "fci";
	}
	return "";
}

/**
 * Remove noindex from Embeddable Posts
 */
//check verion compativility
global $wp_version;
if ( version_compare( $wp_version, '5.7', '>=' ) ) {
	add_filter( 'wp_robots', 'aiorg_wp_robots_noindex_embeds' );
	add_filter( 'aioseo_robots_meta', 'aioseo_remove_noindex_on_embeds', 999 );
}else{
	remove_action( 'embed_head', 'wp_no_robots' );
	add_action( 'embed_head', 'aiorg_wp_no_robots' );
}


function aiorg_wp_robots_noindex_embeds( array $robots ) {
	if ( is_embed() ) {
		$robots['noindex'] = false;
	}

	return $robots;
}
function aioseo_remove_noindex_on_embeds( array $attributes ) {
	if ( is_embed() ) {
		$attributes['noindex'] = '';
	}

	return $attributes;
}

function aiorg_wp_no_robots() {
	if ( get_option( 'blog_public' ) ) {
		echo "<meta name='robots' content='follow' />\n";
		return;
	}

	echo "<meta name='robots' content='noindex,nofollow' />\n";
}