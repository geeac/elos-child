<?php
/**
 * Template Name: Portfolio Template 1
 *
 * @package elos
 * @since elos 1.0
 */
global $wp_query; 

get_header();

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$position = ts_get_single_post_sidebar_position();
switch ($position) {
	case 'left':
		$container_class = 'content_right';
		break;
	
	case 'right':
		$container_class = 'content_left';
		break;
	
	default:
		$container_class = false;
		break;
}

$posts_per_page = get_post_meta(get_the_ID(),'number_of_items',true);
if (!$posts_per_page) {
	$posts_per_page = -1;
}

$number_of_colums = intval(get_post_meta(get_the_ID(),'number_of_columns',true));

switch ($number_of_colums) {
	case 3:
		$image_size = 'portfolio-1-3';
		$column_class = '';
		break;
	
	case 4:
		$image_size = 'portfolio-1-4';
		$column_class = 'four';
		break;
	
	case 2:
	default:
		$image_size = 'portfolio-1-2';
		$column_class = 'two';
		break;
}

$args = array(
	'numberposts'     => '',
	'posts_per_page'     => $posts_per_page,
	'offset'          => 0,
	'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
	'cat'        =>  '',
	'include'         => '',
	'exclude'         => '',
	'meta_key'        => '',
	'meta_value'      => '',
	'post_type'       => 'portfolio',
	'post_mime_type'  => '',
	'post_parent'     => '',
	'paged'				=> $paged,
	'post_status'     => 'publish'
);

$portfolio_categories = get_post_meta(get_the_ID(),'portfolio_categories',true);
if (is_array($portfolio_categories) && count($portfolio_categories) > 0) {

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio-categories',
			'field' => 'id',
			'terms' => $portfolio_categories
		)
	);
}
query_posts( $args ); ?>


<?php if ($container_class): ?>

  
	<?php ts_get_single_post_sidebar('left'); ?>
	<div class="<?php echo $container_class; ?>">
		<div class="features_sec20 lessmt">
<?php else: ?>
	<div class="features_sec20">
		<div class="container">
<?php endif; ?>
      <!-- START PORTFOLIO INTRO -->
<div class="vc_row wpb_row vc_row-fluid vc_custom_1413291289148"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner vc_custom_1414133596786"><div class="wpb_wrapper"><h2 class="wow lessmar2 left"  data-wow-delay="0ms" style="text-align:left;">OUR <strong>PROJECTS</strong></p>
<p></h2><div class="clearfix divider divider_colored_line_2 center lessmar "  data-wow-delay="0ms"><span></span><span></span></div>
	<div class="wpb_text_column wpb_content_element wpb_right-to-left">
		<div class="wpb_wrapper">
      <!-- BEGIN PORTFOLIO PAGE CONTENT --><p>
      IDS Real Estate Group manages a diverse portfolio of properties totaling 21 million square feet. We have over 1,000 tenants and manage $75 million per year in average tenant improvements. While we’ve developed $850 million in projects to date, we have over $550 million currently in development. To see samples of our projects, including photographs and more detailed information, select from the properties below.
      </p><!-- END PORTFOLIO PAGE CONTENT -->
		</div>
	</div>
</div></div></div></div>
<!-- END PORTFOLIO INTRO -->  
      
		<?php if (get_post_meta(get_the_ID(),'show_categories_filter', true) != 'no'): ?>
			<div class="filters-container cbp-l-filters-alignCenter">
				<button data-filter="*" class="cbp-filter-item-active cbp-filter-item"><?php _e('All', 'elos');?></button>
				<?php $categories = get_terms('portfolio-categories');
				foreach ($categories as $category):		
					if (is_array($portfolio_categories) && !in_array($category -> term_id, $portfolio_categories)):
						continue;
					endif;
					?>
					<button data-filter=".category-<?php echo $category -> slug; ?>" class="cbp-filter-item"><?php echo $category -> name; ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		
		<?php if (have_posts()) : ?>
			<div class="grid-container cbp-l-grid-projects IDS-grid-projects <?php echo $column_class; ?>">
				<ul>
					<?php while (have_posts()):
						the_post();
						$item_cats = wp_get_post_terms(get_the_ID(), 'portfolio-categories');
						$cat = array();
						$cat1 = array();
						foreach ($item_cats as $item_cat):
							if (is_array($portfolio_categories) && !in_array($item_cat -> term_id, $portfolio_categories)):
								continue;
							endif;
							$cat[] = 'category-' . $item_cat->slug;
							$cat1[] = $item_cat->name;
						endforeach;
						?>
					
						<li class="cbp-item <?php echo implode(' ',$cat); ?>">
							<div class="cbp-caption">
								<div class="cbp-caption-defaultWrap">
									<?php ts_the_resized_post_thumbnail($image_size,get_the_title()); ?>
								</div>
								<div class="cbp-caption-activeWrap">
									<div class="cbp-l-caption-alignCenter">
										<div class="cbp-l-caption-body">
											<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="cbp-l-caption-buttonLeft"><?php _e('View Project', 'elos'); ?></a>
										</div>
									</div>
								</div>
							</div>
							<div class="threeborder"><div class="cbp-l-grid-projects-title"><?php the_title(); ?></div><div class="cbp-l-grid-projects-desc"><?php echo get_post_meta($post -> ID, 'subtitle', true); ?></div></div>
						</li>
					
					<?php endwhile; ?>
					
					
				</ul>
			</div>
			<?php ts_the_elos_navi(); ?>
		<?php endif; ?>
		<div class="cbp-l-loadMore-text">
			<div data-href="#" class="cbp-l-loadMore-text-link"></div>
		</div> 

<?php if ($container_class): ?>
		</div>        
	</div><!-- end content left side -->
	<?php ts_get_single_post_sidebar('right'); ?>
</div> <!-- .container -->
<?php else: ?>
	</div>
</div><!-- .features_sec20 -->
<?php endif; ?>
			
	
<div class="clearfix margin_top1"></div>
<?php 
wp_reset_postdata();
wp_reset_query();
get_footer(); ?>