<?php
/**
 * Top secion of the theme, includes page header or image slider
 *
 * @package elos
 * @since elos 1.0
 */

$subtitle = '';

if( is_tag() )
{
	$title = sprintf(__('Posts Tagged "%s"','elos'),single_tag_title('',false));
}
elseif (is_day())
{
	$title = sprintf(esc_html__('Posts made in %s','elos'),get_the_time('F jS, Y'));
}
elseif (is_month())
{
	$title =sprintf(esc_html__('Posts made in %s','elos'),get_the_time('F, Y'));
}
elseif (is_year())
{
	$title = sprintf(esc_html__('Posts made in %s','elos'),  get_the_time('Y'));
}
elseif (is_search())
{
	$title = sprintf(esc_html__('Search results for %s','elos'), get_search_query());
}
elseif (is_category())
{
	$title = single_cat_title('',false);
}
elseif (is_author())
{
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
	$title = sprintf(__('Posts by %s','elos'), $curauth->nickname);
}
elseif ( is_single())
{
	if (get_post_type() == 'post')
	{
		$title = __('Blog','elos');
	}
	else
	{
		$title = get_the_title();
		$subtitle = get_post_meta(get_the_ID(), 'subtitle', true);
	}
}
elseif ( is_page() )
{
	$title = get_the_title();
	$subtitle = get_post_meta(get_the_ID(), 'subtitle', true);
}
else if (is_404())
{
	$title = __('404 Page Not Found','elos');
}
else if (function_exists('is_woocommerce') && is_woocommerce())
{
	$title = __('Shop','elos');
}
else
{
	$title = get_bloginfo('name');
}

$titlebar = get_post_meta(get_the_ID(),'titlebar',true);
$no_titlebar = false;
switch ($titlebar)
{
	case 'title':
		$show_title = true;
		$show_breadcrumbs = false;
		break;

	case 'breadcrumbs':
		$show_title = false;
		$show_breadcrumbs = true;
		break;

	case 'no_titlebar':
		$no_titlebar = true;
		break;

	default:
		$show_title = true;
		$show_breadcrumbs = true;
}

$titlebar_style = get_post_meta(get_the_ID(),'titlebar_style',true);

if (function_exists('is_woocommerce') && is_woocommerce()) {
	$titlebar_style =  ot_get_option('default_shop_titlebar_style');
}

if (empty($titlebar_style) || $titlebar_style == 'default') {
	$titlebar_style = ot_get_option('default_titlebar_style');
}

if (get_post_type( get_the_ID() ) == 'portfolio') {
	$titlebar_style = 'modern';
}


switch ($titlebar_style) {
	
	case 'modern_subtitle':
		$class = 'page_title';
		$show_breadcrumbs = false; //override breadcrumbs settings
		$title_container = '<h1 {style}>'.$title.'</h1>';
		break;
	
	case 'modern':
		$subtitle = null; //reset subtitle
		$class = 'page_title two';
		$show_breadcrumbs = false; //override breadcrumbs settings
		$title_container = '<h1 {style}>'.$title.'</h1>';
		
		break;
	
	case 'standard':
	default:
		$subtitle = null; //reset subtitle
		$class = 'page_title2';
		$title_container = '<div class="title"><h1 {style}>'.$title.'</h1></div>';
		break;
}

$image = get_post_meta(get_the_ID(),'titlebar_background',true);

if (function_exists('is_woocommerce') && is_woocommerce()) {
	$image =  ot_get_option('default_shop_title_background');
}
if (empty($image)) {
	$image = ot_get_option('default_title_background');
}

if (!empty($image)) {
	$title_background_position = get_post_meta(get_the_ID(),'title_background_position',true);
	if (empty($title_background_position)) {
		$title_background_position = ot_get_option('default_title_background_position');
	}
	if (!empty($title_background_position) && $title_background_position != 'default') {
		$class .= ' '.$title_background_position;
	}

	$title_background_size = get_post_meta(get_the_ID(),'title_background_size',true);
	if (empty($title_background_size)) {
		$title_background_size = ot_get_option('default_title_background_size');
	}
	if (!empty($title_background_size) && $title_background_size) {
		$class .= ' '.$title_background_size;
	}
}

$style_arr = array();
if (!empty($image)) {
	$style_arr[] = 'background-image: url('.esc_url($image).')';
}
$style_title = '';
if (is_singular()) {
	$title_color = get_post_meta(get_the_ID(),'titlebar_title_color', true);
	$subtitle_color = get_post_meta(get_the_ID(),'titlebar_subtitle_color', true);
	
	if (!empty($title_color)) {
		$style_title = 'style="color:'.esc_attr($title_color).'"';
	}
	
	if (!empty($subtitle_color)) {
		$style_arr[] = 'color:'.esc_attr($subtitle_color);
	}
}
$style = '';
if (count($style_arr) > 0) {
	$style = 'style="'.implode(';',$style_arr).'"';
}

$title_container = str_replace('{style}',$style_title,$title_container);

if ($no_titlebar === false): ?>
	<div class="<?php echo esc_attr($class); ?>" <?php echo $style; ?>>
		<div class="container">
			
			<?php 
			if (get_post_type( get_the_ID() ) == 'portfolio'): ?>
				<?php 
				$portfolio_page = ot_get_option('portfolio_page');
				if ($portfolio_page): ?>
					<div class="portfolio-up"><a href="<?php echo esc_url(get_the_permalink($portfolio_page)); ?>"><i class="fa fa-th"></i></a></div>
				<?php endif; ?>
				
				<div class="portfolio-nav">
					

					<?php if (get_next_post()): ?>
						<?php next_post_link('%link','<i class="fa fa-angle-left"></i>'); ?>
					<?php else: ?>
						<i class="fa fa-angle-left"></i>
					<?php endif; ?>

					<?php if (get_previous_post()): ?>
						<?php previous_post_link('%link','<i class="fa fa-angle-right"></i>'); ?>
					<?php else: ?>
						<i class="fa fa-angle-right"></i>
					<?php endif; ?>


				</div>
			<?php endif;
			
			if ($show_title):
				echo $title_container;
			endif;
			if ($subtitle):
				echo $subtitle;
			endif;

			if ($show_breadcrumbs && ot_get_option('show_breadcrumbs') != "no"): ?>
				 <div class="pagenation"><?php ts_the_breadcrumbs();?></div>
			<?php endif; ?>
		</div>
	</div><!-- end page title --> 
	<div class="clearfix"></div>
<?php endif; ?>