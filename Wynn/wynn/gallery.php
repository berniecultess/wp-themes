<?php
/*
* Template Name: Gallery
*/
get_header(); 
global $be_themes_data;
?>
<section id="content" class="">
	<div id="gallery-container-wrap" class="clearfix">
		<?php 
			$gallery_style = get_post_meta(get_the_ID(),'be_themes_gallery_style',true);
			$animation = get_post_meta(get_the_ID(),'be_themes_title_cat_animation',true);
		?>
		<div id="gallery-container" <?php $class = ( 'style1' == $gallery_style || 'style2' == $gallery_style ) ? 'class="inline-wrap"' : ''; echo $class; ?>>
			<?php
				$attachments = get_post_meta(get_the_ID(),'be_themes_gallery_images');
				if( empty( $gallery_style ) ) {
					$gallery_style = 'style1';
				} 
				if(!empty($attachments)) {
					foreach ( $attachments as $attachment_id ) {
						$attach_img = wp_get_attachment_image_src($attachment_id, 'full');
						$attach_detail = be_get_attachment_details( $attachment_id );
						$class = '';
						if( 'style3' == $gallery_style ) {
							$class = 'center';
						}
						$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);
						if($video_url) {
							$data_source = 'video';
						} else {
							$data_source = $attach_img[0];
						}
						echo '<div class="placeholder '.$gallery_style.'_placehloder load show-title '.$class.'" data-source="'.$data_source.'">';
						if($video_url) {
							echo be_gal_video($video_url);
						} else {
							echo '<img src="" style="opacity: 0; display: block;" />';
						}
						if( 'style1' == $gallery_style  ) {
							echo '<div class="overlay_placeholder"></div>';
						}
						if($attach_detail['description']) {
							echo '<div class="gallery-item-caption portfolio-item-title animated '.$animation.'"><div>'.$attach_detail['description'].'</div></div>';
						}
						echo '</div>';
					}
				}
			?>
		</div>
	</div>
	<div>
		<span class="arrow_prev"><i class="font-icon icon-angle-left"></i></span>
		<span class="arrow_next"><i class="font-icon icon-angle-right"></i></span>
		<div class="carousel_bar_area clearfix">
			<div class="carousel_bar_wrap">
				<div class="carousel_bar">
					<ul id="carousel" class="elastislide-list">
						<?php
						$count = 0;
						if(!empty($attachments)) {
							foreach ( $attachments as $attachment_id ) {
								$attach_img = wp_get_attachment_image_src($attachment_id, 'carousel-thumb');
								$video_url = get_post_meta($attachment_id, 'be_themes_featured_video_url', true);
								if($video_url) {
									$data_source = '<img width="75" height="50" src="'.get_template_directory_uri().'/images/video-placeholder.jpg" class="attachment-carousel-thumb" alt="hanging_on_reduced">';
								} else {
									$data_source = '<img width="75" height="50" src="'.$attach_img[0].'" class="attachment-carousel-thumb" alt="hanging_on_reduced">';
								}
								echo '<li><a href="#" class="gallery-thumb" data-target="'.$count.'">'.$data_source.'</a></li>';
								$count++;
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>