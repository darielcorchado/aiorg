<?php

/**
 * Template Name: AIS Single Agent
 * Template Post Type: ais_agent, page
 *
 * FB Landing Page Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phoenix
 */

 $city = $post->post_name;

$parse_url  = explode("/", $_SERVER['REQUEST_URI']);
$agent_slug = $parse_url[3];

$query = $wpdb->prepare("
	SELECT *, cis.title AS state_title, cia.city AS city_title, cia.name AS agent_name
	  FROM `car-insurance_agents` AS cia
 LEFT JOIN `car-insurance_state`  AS cis ON cis.id = cia.state_id
 LEFT JOIN `car-insurance_city`   AS cic ON cic.id = cia.city_id
	 WHERE cia.id = '%d'", $agent_slug);

$agent_data = $wpdb->get_results($query);

 if (empty($agent_data)) {
	 header('Location: /car-insurance/agents/');
 }

  get_header(); ?>

  <main id="primary" class="site-main page">
    <div class="hero">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
		   <?php if ($agent_data[0]->state_title && $agent_data[0]->city_title && $agent_data[0]->agent_name): ?>
 		   	   <h1><?= "{$agent_data[0]->agent_name} in {$agent_data[0]->city_title}, {$agent_data[0]->state_title}"  ?></h1>
	   	   <?php else: ?>
			   <h1><?php the_title() ?></h1>
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

 			 <div class="agent-dir">
 				 <?php if (count($agent_data) > 0): ?>
 					 <div class="agent-cities">
 						 <p><b><?= $agent_data[0]->agent_name?>:</b><br><?= $agent_data[0]->address . ', ' . $agent_data[0]->city . ' ' . $agent_data[0]->zip . ' ' . $agent_data[0]->phone ?> </p>

						 <?php
						 	comment_form([], $post->ID);
						 	$comments = get_comments(['post_id' => $post->ID]);
						 ?>

						 <!-- Because of the weird redirecting to achieve original DB ids in the slug for agent pages,
						 We have to manually add back in comments -->
						<div id="comments">
							<h4 class="total-comments"><?= count($comments); ?> comments</h4>
							<ol class="commentlist">
								<?php foreach ($comments as $comment) : ?>
									<li class="comment" id="li-comment-<?= $comment->comment_ID ?>">

										<div id="comment-<?= $comment->comment_ID ?>" itemscope="" itemtype="http://schema.org/UserComments">
											<div class="comment-author vcard">
												<?= get_avatar( $comment, 50 ) ?>
												<span class="fn" itemprop="creator" itemscope="" itemtype="http://schema.org/Person">
													<span itemprop="name"><b><?= $comment->comment_author ?></b></span>
												</span>

												<?php
													$comment_date = date_create($comment->comment_date);
												?>

												<span class="ago" style="color: #999; font-size: .9em;"><?= date_format($comment_date, "F j, Y") ?></span>
												<span class="comment-meta" style="color: #999; font-size: .9em;">
													<?= edit_comment_link( __( 'Edit', 'textdomain' ), '( ', ' )' ); ?>
												</span>
											</div>
											<div class="commentmetadata">
												<div class="commenttext" itemprop="commentText">
													<?= wpautop($comment->comment_content) ?>
												</div>

												<div class="reply"></div>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							</ol>
						</div>

						<hr />

 						<h3>Pros & Cons of Each Insurance Company</h3>
 	 					<p>Type car insurance company name in search bar to find the pros, cons, and ratings. Otherwise, each insurer is from highest to lowest rated.</p>
 	 					<?php echo do_shortcode('[table id=1083 /]'); ?><br>

 	 					<h3>Minimum Coverage by State, Uninsured Motorist Protection, & Personal Injury Protection</h3>
 	 					<p>Type your state in the search to find details.</p>
 	 					<?php echo do_shortcode('[table id=332 /]'); ?><br>
 				 	</div>
 				<?php endif; ?>

 				<div class="agent-extras">
 					<?php echo do_shortcode('[table id=233 /]'); ?><br>
 					<?php echo do_shortcode('[table id=2807 /]'); ?><br>

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
