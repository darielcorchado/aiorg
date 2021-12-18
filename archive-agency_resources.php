<?php
/**
 * The template for displaying the archive page for the agents custom post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Phoenix
 */
get_header(); ?>
	<main id="primary" class="site-main">
		<div class="hero">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Insurance Service Providers for Agents and Agencies</h1>
<h2 class='subhead'>Insurance agents rely on a variety of tools and services to help manage and grow their agencies.  This Agent Resources section was created to help agents compare and rate businesses who support an agency with training, administration, marketing and more. </h2>

            			<?php get_template_part('template-parts/content', 'topmda'); ?>

					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">					
					<div class="main-content">
					<?php if( function_exists( 'aioseo_breadcrumbs' ) ): ?>
						<div class="breadcrumb-wrap no-mt"><?php aioseo_breadcrumbs(); ?></div>
					<?php endif ?>
<?php
$categories = get_terms( 'resource_type', array(
    'orderby'    => 'count',
    'hide_empty' => 0,
    'orderby'                => 'name',
    'order'                  => 'ASC',
) );

$parents = [];
$children = [];
foreach($categories as $category):
  if($category->parent == 0) { 
    array_push($parents, $category);
  } else {
    $children["key" . $category->parent] ?: [];
    $children["key" . $category->parent][]=$category;
  }
endforeach;
foreach($parents as $parent):
?>
<h2><?php echo $parent->name ?></h2>
<?php foreach($children["key" . $parent->term_id] as $child): ?>
<h3><a href='<?php echo get_term_link($child->term_id) ?>'><?php echo $child->name ?></a></h3>
<?php endforeach; ?>
<?php endforeach; ?>
</div></div></div></div>


	</main><!-- #main -->

<?php get_footer();
