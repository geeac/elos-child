<?php
/**
 * The Template for displaying single portfolio.
 *
 * @package crystal
 * @since crystal 1.0
 */
global $post;

get_header(); ?>
<?php if ( have_posts() ) : the_post();
	$image_src = '';
	if (has_post_thumbnail())
	{
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
		$image_src = $image[0];
	}
	?>
	
	<div class="container">

		<div class="content_fullwidth">

			<div class="portfolio_area">
				
				<?php
					$media = null;

					if (get_post_format() == 'video'):
						$url = get_post_meta($post -> ID, 'video_url',true);
						if (!empty($url)):
							$embadded_video = ts_get_embaded_video($url);
						elseif (empty($url)):
							$embadded_video = get_post_meta($post -> ID, 'embedded_video',true);
						endif;
					elseif (get_post_format() == 'gallery'):
						$gallery = get_post_meta($post->ID, 'gallery_images',true);
						$gallery_html = '';
						if (is_array($gallery)):
							foreach ($gallery as $image):
								$gallery_html .= '<li>'.ts_get_resized_image_by_size($image['image'], 'portfolio-single', $image['title']).'</li>';
							endforeach;
						endif;
					endif;

					if (isset($embadded_video)):
						$media = '<div class="video-wrapper">'.$embadded_video.'</div>';
					elseif (isset($gallery_html)):
						$media = '<div class="flexslider one-col control-nav control-nav-style2"><ul class="slides">'.$gallery_html.'</ul></div>';
					else:
						$media = ts_get_resized_post_thumbnail($post -> ID, 'portfolio-single', get_the_title());
					endif;    
          
				?>
				
				<div class="portfolio_area_left"><?php //echo $media; ?>
          
          <?php $IDS_portfolio_ID_cf = get_post_meta( get_the_ID(), 'ids_associated_gallery_id', true ); if ($IDS_portfolio_ID_cf){ ?>          
         <div class="ids-project-page-gallery-section"> <?php do_action('slideshow_deploy', $IDS_portfolio_ID_cf); ?></div>
          <?php }; ?>
          
        </div>

				<div class="portfolio_area_right">

					<h3><?php _e('Project Description', 'elos');?></h3>
					<?php the_content(); ?>

					<div class="project_details"> 
						<h4><?php _e('Project Details', 'elos'); ?></h4>
								<?php 
						$categories = get_the_term_list( $post->ID, 'portfolio-categories', '', ' ' );
						if ($categories): ?>
							<span><strong><?php _e('Categories', 'elos'); ?></strong> <em><?php echo $categories; ?> </em></span> 
						<?php endif; ?>
						<div class="clearfix margin_top5"></div>
						<?php $url = get_post_meta($post -> ID, 'url', true); ?>
						<?php if ($url): ?>
							<a href="<?php echo esc_url($url); ?>" class="but_goback" target="_blank"><i class="fa fa-hand-o-right fa-large"></i> <?php _e('Visit Site', 'elos'); ?></a>
						<?php endif; ?>
					
					</div>  

				</div>

			</div><!-- end section -->

		</div>

	</div><!-- end content area -->
	<div class="clearfix margin_top7"></div>

<?php endif; ?>
<?php get_footer(); ?>