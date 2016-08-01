<?php
/**
 * Shortcode Title: Person 2
 * Shortcode: person_2
 * Usage: [person_2 animation="bounceInUp" animation_delay="200" animation_iteration="1" id="1" align="left"]
 */
add_shortcode('person_2', 'ts_person_2_func');

function ts_person_2_func($atts, $content = null) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'style' => '',
		"id" => 0,
		"align" => "",
	), $atts));

	$person = null;
	if (!empty($id)) {
		$person = get_post($id);
	}


	
	$html = '';








	if ($person) {
		
		$image_size = 'person-2';
		switch ($style) {
			case 2:
				$style_class = 'two';
				$image_size = 'person-2-2';
				break;
			
			case 3:
				$image_size = 'person-2-3';
				break;
			
			case 4:
				$image_size = 'person-2-4';
				break;
			
			case 5:
				$image_size = 'person-2-5';
				break;
			
			case 1:
			default:
				$style_class = '';
		}
		
		$image = '';
		if (has_post_thumbnail($person->ID, 'post')) {
			$image = ts_get_resized_post_thumbnail($person->ID, $image_size);
		}

		$facebook = get_post_meta($person->ID, 'facebook_url', true);
		$twitter = get_post_meta($person->ID, 'twitter_url', true);
		$google_plus = get_post_meta($person->ID, 'google_plus_url', true);
		$youtube = get_post_meta($person->ID, 'youtube_url', true);
		$skype = get_post_meta($person->ID, 'skype_username', true);

		$content = stripslashes($person->post_content);
		
		switch ($style) {
			case 2:
				$style_class = 'two';
				break;
			
			case 3:
				$style_class = '';
				break;
			
			case 1:
			default:
				$style_class = '';
		}
		
		$socials = '
			<ul>
				' . (!empty($facebook) ? '<li><a href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a></li>' : '') . '
				' . (!empty($twitter) ? '<li><a href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a></li>' : '') . '
				' . (!empty($google_plus) ? '<li><a href="'.esc_url($google_plus).'"><i class="fa fa-google-plus"></i></a></li>' : '') . '
				' . (!empty($youtube) ? '<li><a href="'.esc_url($youtube).'"><i class="fa fa-youtube"></i></a></li>' : '') . '
				' . (!empty($skype) ? '<li><a href="skype:'.esc_attr($skype).'?call"><i class="fa fa-skype"></i></a></li>' : '') . '
			</ul>';
		
		switch ($style) {
			case 3:
				$html = '
					<div class="features_sec26 '.ts_get_animation_class($animation).'" '.ts_get_animation_data_class($animation_delay,$animation_iteration).'>
						<div class="box ids-person-case-3 ids-person-style-' . $style . '" onresize="ResizeChildImage(' . $person->ID . ')" onload="ResizeChildImage(' . $person->ID . ')">
							'.$image.'
							<h3 class="nocaps">'.get_the_title($person -> ID).'</h3>
							<h6 class="nocaps">'.get_post_meta($person->ID, 'team_position', true).'</h6>

							<p>'.ts_get_shortened_string(strip_tags($content),30).'</p>
							<br />
							'.$socials.'
						</div>
					</div><!-- end features section26 -->';
				break;
			
			case 4:
				$html = '
					<div class="features_sec35 '.ts_get_animation_class($animation).'" '.ts_get_animation_data_class($animation_delay,$animation_iteration).'>
						<div class="box ids-person-case-4 ids-person-style-' . $style . '" onresize="ResizeChildImage(' . $person->ID . ')" onload="ResizeChildImage(' . $person->ID . ')">
							<div class="timage">'.$image.'</div>
							<h3 class="nocaps">'.get_the_title($person -> ID).'</h3>
							<h6 class="nocaps">'.get_post_meta($person->ID, 'team_position', true).'</h6>
							<p>'.ts_get_shortened_string(strip_tags($content),30).'</p>
							<br />
							'.$socials.'
						</div>
					</div>';
				break;
			
			case 2:
			case 1:
			default:			 $IDS_person_rollover_text_cf = get_post_meta( $person->ID, 'ids_team_member_rollover_text', true );
			 if ($IDS_person_rollover_text_cf){
			 $ids_person_snippet = '<div id="IDS-person-snippet-' . $person->ID . '" class="cbp-caption-activeWrap wp-post-image"><div class="cbp-l-caption-alignCenter"><div class="cbp-l-caption-body">' . $IDS_person_rollover_text_cf . '</div></div></div>';
			 } else { 
			 $ids_person_snippet = ''; 
			 };

			 if ($image){ 
			 $ids_image_snippet = '<div class="IDS-image-container wp-post-image" id="IDS-image-container-' . $person->ID . '">' . $image . $ids_person_snippet . '</div>';			 
			 } else { 
			 $ids_image_snippet = ''; 
			 };
          
				$html = '
					<div class="features_sec42 '.$style_class.' '.ts_get_animation_class($animation).'" '.ts_get_animation_data_class($animation_delay,$animation_iteration).'>					
						<div id="ids-person-box-id-' . $person->ID . '" class="box wp-post-image ids-person-case-1 ids-person-style-' . $style . '" onresize="ResizeChildImage(' . $person->ID . ')" onload="ResizeChildImage(' . $person->ID . ')">
							' . $ids_image_snippet . '
							<h4>'.get_the_title($person -> ID).'</h4>
							<h6 class="nocaps">'.get_post_meta($person->ID, 'team_position', true).'</h6>
							<p>'.ts_get_shortened_string(strip_tags($content),30).'</p>
							<br />
							'.$socials.'													
						</div></div>						';
		}
		
		
	}


	



	return $html;
}