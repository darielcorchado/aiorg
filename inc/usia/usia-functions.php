<?php
function print_rating($rating = 0, $total_reviews = 0, $label = 'Company'){
    if($rating > 0){
        $star = ($rating/5) * 100;
    }
    ?>
    <div class="stars-only">
        <div class="user-review-area comments-review-area wp-review-151531 review-wrapper">
		    <div class="comments-rating-shortcode delay-animation">
			    <div class="review-star">
	                <div class="review-result-wrapper" style="color: #95bae0;">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>

		                <div class="review-result" style="width:<?php echo $star ?>%; color:#1e73be;">
						    <i class="fa fa-star"></i>
						    <i class="fa fa-star"></i>
						    <i class="fa fa-star"></i>
						    <i class="fa fa-star"></i>
						    <i class="fa fa-star"></i>
				        </div><!-- .review-result -->
                    </div><!-- .review-result-wrapper -->

                </div><!-- .review-star -->
		    </div>
		    <div class="user-total-wrapper">
			    <span class="user-review-title"><?php echo $label?> Rating</span>
			    <span class="review-total-box">
				    <span class="wp-review-user-rating-total"><?php echo round($rating, 2) ?></span>
				    <small>(<span class="wp-review-user-rating-counter"><?php echo $total_reviews ?></span> reviews)</small>
			    </span>
		    </div>
	    </div>
	</div>
<?php }
function generate_subhead($current_post){
	$post_type = $current_post->post_type;
	$subhead   = get_field('subhead', $current_post->ID);

	if($post_type == 'agent' && empty($subhead)){

		$agent_name = $current_post->post_title;
		$agency = get_field('agency_name');
		$city = get_field('agent_city');
		$state = get_field('agent_state');
		$location = '';

		if($city || $state){
			$location = "in $city, $state";
		}

		$subhead = __("$agent_name is an $agency insurance agent $location. Get $agent_name  reviews, contact info, and office hours below. Find and compare the best $city insurance agents with free online insurance quotes.", "txtdomain");

	} else if($post_type == 'company' && empty($subhead)){

		$insurance_company = $current_post->post_title;
		$am_best_rating = get_field('ama');
		$sp_rating = get_field('sandprating');

		$am_best_rating_text = '';
		$sp_rating_text = '';
		$separator = '';

		if($am_best_rating && $am_best_rating != 'N/A'){
			$am_best_rating_text = " The $insurance_company A.M. Best rating is $am_best_rating";
			$separator = '.';
		}
		if($sp_rating && $sp_rating != 'N/A'){
			if($am_best_rating && $am_best_rating != 'N/A'){
				$separator = ", and the ";
			}else{
				$separator = " The ";
			}
			$sp_rating_text = "$insurance_company S&P Rating is $sp_rating.";
		}

		$subhead = __("This $insurance_company review will cover $insurance_company ratings by real users for overall satisfaction and claims, cost, billing, and service satisfaction.".$am_best_rating_text. $separator. $sp_rating_text." To compare insurance rates from the best companies in your locale, enter your ZIP code below.", "txtdomain");
	}
	return $subhead;
}

add_filter( 'comments_number', 'replace_comment_by_reviews', 10, 2 );
function replace_comment_by_reviews ( $out, $num ) {
	if ($num == 0){
		$out =  __( 'No Reviews', 'wp-review' );
	}
	elseif ($num == 1){
		$out = '1 '. __( 'Review', 'wp-review' );
	}
	else {
		$out = $num .' '.  __('Reviews');
	}
	return $out;
}

/**
 * Setting the Agents urls like /agents/agent_city
 * Setting Agency Resources urls like /agency-resources/resource_type
 */
function wpa_show_permalinks( $post_link, $post ){
    if ( is_object( $post ) && $post->post_type == 'agent' ){
        $terms = wp_get_object_terms( $post->ID, 'agent_city' );
        if( $terms ){
            return str_replace( '%agent_city%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );


/**
 * Rplacing Company cpt slug by Reviews
 */
function replace_company_cpt_slug_by_reviews( $args, $post_type ) {

	if ( 'company' === $post_type ) {
	   $args['rewrite']['slug'] = 'reviews';
	   $args['has_archive'] = 'reviews';
	}


	return $args;
 }
 add_filter( 'register_post_type_args', 'replace_company_cpt_slug_by_reviews', 10, 2 );


 /**
  * Seting the Company yoast seo fields with the Company SEO post_metas
  */

add_filter('wpseo_title', 'custom_title');
function custom_title($title) {
	global $post;

    if( get_field('pagetitle') ) {
        $title = '★ '. str_replace( '-', '- ★', get_field('pagetitle') );
    }

	if (is_singular('company')) {
		if (!preg_match('/[a-zA-Z0-9-:]*\/reviews\/[a-zA-Z0-9-]*/s', get_permalink())) {
			return;
		}

		$title_segments = explode(' ', $title);
		$star_html = "&#9733;";

		$new_title = "";
		foreach ($title_segments as $key => $segment) {
			if ($key == 0) {
				continue;
			}

			if (trim(html_entity_decode($segment)) == '★' || trim($segment) == $star_html) {
				break;
			}

			if (!preg_match('/[a-zA-Z0-9 ]/', $segment)) {
				continue;
			}

			$new_title .= " $segment";
		}

		$star           = esc_html("&#9733;");
		$raw_title      = $new_title;
		$adjusted_title = preg_replace('/Reviews/', 'Company Ratings', $raw_title);
		$title          = "$star $raw_title - $star $adjusted_title";
	}

	if (is_singular('agency_resources')) {
		$title = "☑ " . get_the_title() . " | US Insurance Agents";
	}

  if (is_post_type_archive('agency_resources')) {
		$title = "☑ Insurance Service Providers for Agents and Agencies | US Insurance Agents";
  }

  if(is_tax('resource_type')) {
    $title= '☑ ' . single_term_title('', false) . ' | US Insurance Agents';
  }

  if (is_tax('agent_city')) {
    $meta  = get_post_meta($post->ID);
    $title = "☑ Free {$meta['agent_city'][0]} Insurance Quotes - {$meta['agent_city'][0]} Insurance Agents and Brokers";
  }

	if (is_singular('agent')) {
		if ((get_field('agent_pagetitle'))) {
			$page_title = str_replace('Insurance Quotes', '', get_field('agent_pagetitle'));
		} else {
			$page_title = get_the_title();
			if (get_field('agency_name') && get_field('agency_name') != $page_title) {
				$page_title .= " - " . str_replace(' Insurance', '', get_field('agency_name'));
			}
			if (get_field('agent_city')) {
				$page_title .= " - " . get_field('agent_city');
				if (get_field('agent_state')) {
					$page_title .= ', ' . get_field('agent_state');
				}
			}
		}
		$title = "☑ " . $page_title;
	}

  if (is_post_type_archive('agent')) {
    $title = '☑ Local Insurance Agents and Brokers - Compare Quotes from Local Agents';
  }

  if (is_post_type_archive('company')) {
   $title = '☑ Insurance Company Reviews &amp; Ratings - Auto, Home, Life, Health';
  }

	if (is_tax('answer_tag')) {
   $title = 'Recent questions tagged ' . single_term_title('', false) . ' - US Insurance Agents';
	}

    return $title;
}

add_filter('wpseo_metadesc','custom_meta');
function custom_meta( $desc ){

    if (get_field('metadesc')) {
        $desc = get_field('metadesc');
    }

    return $desc;
}

/**
 * Add the excerpt to the content on USIA COmpany CPT
 */

function add_usia_company_excerpt($content) {
    if(get_post_type( ) == 'company' && has_excerpt() ){
		$content = '<div class="company-content">'.get_the_excerpt( ). $content . '</div>';
	}
	return $content;
}
add_filter( 'the_content', 'add_usia_company_excerpt', 6);

/**
 * Fix agent CPT pagination without adjusting rewrite rule
 */
function agent_filter_post_type($link, $post) {
  	if ($post->post_type == 'agent') {
    	if ($cats = get_the_terms($post->ID, 'agent_city')) {
      		$link = str_replace('%agent_city%', current($cats)->slug, $link);
    	}
  }
  return $link;
}
add_filter('post_type_link', 'agent_filter_post_type', 10, 2);

function agent_pagination_fix($wp_rewrite) {
    unset($wp_rewrite->rules['agents/([^/]+)/page/?([0-9]{1,})/?$']);

    $wp_rewrite->rules = array(
        'agents/?$' => $wp_rewrite->index . '?post_type=agent',
        'agents/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?post_type=agent&paged=' . $wp_rewrite->preg_index(1),
        'agents/([^/]+)/page/?([0-9]{1,})/?$' => $wp_rewrite->index . '?agent_city=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2),
    ) + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'agent_pagination_fix');

function rewrite_agent_archive_title($title) {
	global $post;

	if (is_tax('agent_city')):
		$city_term = get_queried_object();
		$city = $city_term->name;
		$city = str_replace(substr($city, -3), ', ' . strtoupper(substr($city, -2)), $city);

		if (strpos($city, 'st-') !== false):
			$city = str_replace('-', '. ', $city);
		else:
			$city = str_replace('-', ' ', $city);
		endif;

		$title = ucwords($city);
	elseif (is_tax('resource_type')):
		$resource_term = get_queried_object();
		$resource = $resource_term->name;

		$title = ucwords($resource);
	elseif (is_tax('answer_tag')):
		$answer_tag = get_queried_object();
		$answer_tag = $answer_tag->name;

		$title = 'Recent questions tagged "' . ucwords($answer_tag) . '"';
	endif;

	return $title;
}
add_action('get_the_archive_title', 'rewrite_agent_archive_title');

/**
 * Making sure the taxonomy labels in breadcrumbs are equal to the title
 */
add_filter('aioseo_breadcrumbs_trail', 'aioseo_breadcrumbs_trail');
function aioseo_breadcrumbs_trail($crumbs) {
	foreach ($crumbs as $key => $crumb) {
		$taxs = ['agent_city', 'answer_tag'];

		if (is_a($crumb['reference'], 'WP_Term') && in_array($crumb['reference']->taxonomy, $taxs) ) {
			$crumb['label'] = update_breadcrumb_label($crumb['label'], $crumb['reference']->taxonomy);
			$crumbs[$key] = $crumb;
		}
	}
	return $crumbs;
}

function update_breadcrumb_label($label, $taxonomy) {
	if ($taxonomy == 'agent_city') {
		$city = str_replace(substr($label, -3), ', ' . strtoupper(substr($label, -2)), $label);

		if (strpos($city, 'st-') !== false) :
			$city = str_replace('-', '. ', $city);
		else :
			$city = str_replace('-', ' ', $city);
		endif;

		return ucwords($city);
	}
	if ($taxonomy == 'answer_tag') {
		return 'Recent questions tagged "' . ucwords($label) . '"';
	}

	return $label;
}

/**
 * Shortcode to Show agent cities by state-abbrev
 * @param the state abbrev
 */
function show_agent_cities( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'state' => 'USA',
		),
		$atts
	);
	$state = $atts['state'];
	$cities = null;
	$list = '<ul class = "usia-item-list">';

	if( $state === 'USA'){
		$cities = get_terms(array(
			'taxonomy' => 'agent_city'
		));
	}else{
		$cities = get_terms(array(
			'taxonomy' => 'agent_city',
			'name_end_like' => $state
		));

	}

	foreach ($cities as $city){
		$name = ucwords(str_replace('-', ' ', substr($city->name, 0, -3)));
		$list .= '<li><a href="'.get_term_link($city, 'agent_city').'">'.$name.' Insurance</a></li>';
	}

	$list .= '</ul>';
	echo $list;
}
add_shortcode( 'agent-cities', 'show_agent_cities' );

function name_end_like( $clauses, $taxonomies, $args ) {
    if ( ! empty( $args['name_end_like'] ) ) {
        global $wpdb;

        $name_end_like = $wpdb->esc_like( $args['name_end_like'] );

        if ( ! isset( $clauses['where'] ) )
            $clauses['where'] = '1=1';

        $clauses['where'] .= $wpdb->prepare( " AND t.name LIKE %s ", "%$name_end_like" );
    }

    return $clauses;
}

add_filter( 'terms_clauses', 'name_end_like', 10, 3 );
