<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package elos
 * @since elos 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0'>
		<title><?php wp_title('|', true, 'right'); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php if (ot_get_option('favicon')) : ?>
			<link rel="shortcut icon" href="<?php echo ot_get_option('favicon') ?>" type="image/x-icon" />
		<?php endif; ?>
		<?php echo ot_get_option('scripts_header'); ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php if (ot_get_option('preloader') == 'enabled'): ?>
		<div class="preloading-screen" style=" background: #fff center no-repeat fixed">
			<div class="spinners">
			  <div class="bounce1"></div>
			</div>
		</div>
	<?php endif; ?>

		<?php if (ot_get_option('control_panel') == 'enabled_admin' && current_user_can('manage_options') || ot_get_option('control_panel') == 'enabled_all'): ?>
			<?php get_template_part('framework/control-panel'); ?>
		<?php endif; ?>
 
		<?php 
		$body_class = '';
		if (is_page()) {
			$body_class = get_post_meta(get_the_ID(), 'body_class', true);
		}
		if (empty($body_class)) {
			$body_class = ot_get_option('body_class');
		}
		if (in_array($body_class,array('b1170','b960')) ): ?>
			<div class="wrapper_boxed">
		<?php endif; ?>
		
		<div class="site_wrapper">
			<?php
			switch (ts_get_main_menu_style()):
				case 'style2':
					get_template_part('inc/headerstyle2');
					break;
				
				case 'style1':
				default:
					get_template_part('inc/headerstyle1');
					break;
			endswitch;
			
			if (!get_post_meta(is_singular() ? get_the_ID() : null, 'post_slider',true)):
				get_template_part( 'inc/top' );
			else:
				get_template_part( 'inc/header-image' );
			endif; ?>
