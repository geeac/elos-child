<?php
/**
 * The template for displaying the footer.
 *
 * @package elos
 * @since elos 1.0
 */

		$footer_style = '';
		$footer_variant = '';
		$footer_bg = '';
		$copyright_bar_variant = '';
		
		if (is_singular()):
			
			$footer_style = get_post_meta(get_the_ID(),'footer_style',true);
			$footer_variant = get_post_meta(get_the_ID(),'footer_variant',true);
			$footer_bg = get_post_meta(get_the_ID(),'footer_background',true);	
			$copyright_bar_variant = get_post_meta(get_the_ID(),'copyright_bar_variant',true);	
		endif;
		
		if (empty($footer_style) || $footer_style == 'default'):
			$footer_style = ot_get_option('footer_style');
		endif;
		
		if (empty($footer_variant) || $footer_variant == 'default'):
			$footer_variant = ot_get_option('footer_variant');
		endif;
		
		if (empty($footer_bg)):
			$footer_bg = ot_get_option('footer_background');
		endif;
		
		if (empty($copyright_bar_variant) || $copyright_bar_variant == 'default'):
			$copyright_bar_variant = ot_get_option('copyright_bar_variant');
		endif;
		
		$footer_class = '';
		if ($footer_style == 'light'):
			$footer_class = 'three';
		endif;
		
		?>
		<div class="clearfix"></div>
		
			<div class="footer1 <?php echo $footer_class; ?>" <?php echo (!empty($footer_bg) ? 'style="background: url('.esc_url($footer_bg).') repeat-y center top"' : ''); ?>>
				<div class="container">
					
					<?php 
					switch ($footer_variant):
						case '2_rows':
							get_sidebar('footer1');
							get_sidebar('footer2');
							break;
						
						case '1_row_alt':
							get_sidebar('footer3');
							break;
							
						case '1_row';
						default:
							get_sidebar('footer1');
							break;	
					endswitch;
					?>
				</div>
			</div><!-- end footer -->
		

		<div class="clearfix"></div>

		<div class="copyright_info <?php echo $footer_class; ?>">
			<div class="container">

				<div class="one_half">

					<?php echo ot_get_option('footer_text'); ?>
					<?php
						if (has_nav_menu('copyright-bar')):
							wp_nav_menu(array(
								'theme_location' => 'copyright-bar',
								'container' => false,
								'menu_id' => 'footer-menu',
								'depth' => 1
							));
						endif;
					?>
				</div>

				<div class="one_half last">
					<?php
					if ($copyright_bar_variant == 'menu'):
						if (has_nav_menu('copyright-bar-secondary')):
							wp_nav_menu(array(
								'theme_location' => 'copyright-bar-secondary',
								'container' => false,
								'menu_id' => 'footer-menu-secondary',
								'depth' => 1
							));
						endif;
					else:
						$active_social_items = ot_get_option('active_social_items');
						if (is_array($active_social_items)): ?> 
							<ul class="footer_social_links <?php echo $footer_class; ?>">
								<?php if (in_array('facebook',$active_social_items)): ?>
									<li>
										<a href='<?php echo esc_url(ot_get_option('facebook_url')); ?>' title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
									</li>
								<?php endif;?>
								<?php if (in_array('twitter',$active_social_items)): ?>
									<li>
										<a href='<?php echo esc_url(ot_get_option('twitter_url')); ?>' title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
									</li>
								<?php endif;?>
								<?php if (in_array('google_plus',$active_social_items)): ?>
									<li>
										<a href='<?php echo esc_url(ot_get_option('google_plus_url')); ?>' title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a>
									</li>
								<?php endif;?>
								<?php if (in_array('linkedin',$active_social_items)): ?>
									<li>
										<a href='<?php echo esc_url(ot_get_option('linkedin_url')); ?>' title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>
									</li>
								<?php endif; ?>
								<?php if (in_array('flickr',$active_social_items)): ?>
									<li>
										<a href='<?php echo esc_url(ot_get_option('flickr_url')); ?>' title="Tumblr" target="_blank"><i class="fa fa-flickr"></i></a>
									</li>
								<?php endif;?>
								<?php if (in_array('youtube',$active_social_items)): ?>
									<li>
										<a href='<?php echo esc_url(ot_get_option('youtube_url')); ?>' title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a>
									</li>
								<?php endif;?>
								<?php if (in_array('rss',$active_social_items)): ?>
									<li>
										<a href='<?php bloginfo('rss2_url'); ?>' title="RSS" target="_blank"><i class="fa fa-rss"></i></a>
									</li>
								<?php endif;?>
							</ul>
						<?php endif;
					endif; ?>			
				</div>
			</div>
		</div><!-- end copyright info -->
		<a href="#" class="scrollup"><?php _e('Scroll to top', 'elos'); ?></a><!-- end scroll to top of the page-->
		</div> <!-- .site_wrapper -->



		<?php 
		$body_class = '';
		if (is_page()) {
			$body_class = get_post_meta(get_the_ID(), 'body_class', true);
		}
		if (empty($body_class)) {
			$body_class = ot_get_option('body_class');
		}
		if (in_array($body_class,array('b1170','b960')) ): ?>
			</div>
		<?php endif; ?>
		<?php echo ot_get_option('scripts_footer'); ?>


<?php wp_footer(); ?>
<script type="text/javascript">
  jQuery(document).ready(function() {
  jQuery(".portfolio_area_right .project_details span em a").removeAttr("href");
  });

  jQuery( "#menu-item-6937 .subMenu-toggle" ).click(function() {
  parent.location = 'http://idsweb.zumahost.com/about/';
  });

</script>
	</body>
</html>