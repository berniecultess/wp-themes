<?php
	$output = '';
	$format = get_post_format();
	if( is_single() ) {
		switch ( $format ) {
			case "image":
				$output .='<div class="'.implode(' ',get_post_class('blog-post')).'">';
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'one-half');
				$url = $thumb['0'];
				if($url) {
					$output .= '<a href="'.get_permalink(get_the_ID()).'" class="image-wrap">';
					$output .= '<img src="'.$url.'" alt="" />';
					$output .= '</a>';
				}

				$output .= '<h2 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h2>';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '</div>';
				break;
			case "video":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'">';
				$url = get_post_meta(get_the_ID(),'be_themes_video_url',true);
				if( !empty( $url ) ) {
					$videoType = be_video_type( $url );
					if( $videoType == "youtube" ) {
						if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
							$video_id = $match[1];
						}
						$output.='<iframe width="940" height="450" src="http://www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe>';
					}
					elseif( $videoType == "vimeo" ) {
						sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
						$output .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" allowFullScreen></iframe>';
					}
					else{
						$poster = '';
						if( has_post_thumbnail() ) {
							$id = get_post_thumbnail_id(get_the_ID());
							$img_src = wp_get_attachment_image_src( $attachment_id, 'one-half');
							$poster = 'poster="'.$img_src[0].'"';
						}
						$output .='<video  class="custom-video" src="'.$url.'" '.$poster.' controls="controls"></video>';
					}
				}
				$output .= '<h2 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h2>';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '<hr class="separator style-1 blog-title-sep" />';				
				$output .= '<div class="blog-post-content sec-color">';
				$output .= apply_filters('the_content',get_the_content());
				$output .= '</div>';
				$output .= '</div>';
				break;
			case "audio":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'">';
				$output .= '<div class="image-wrap">';
				$url = get_post_meta(get_the_ID(),'be_themes_audio_url',true);
				if( !empty($url) ) {
					$output .= '<audio class="audio" src="'.$url.'" controls="controls"></audio>';
				}
				$output .= '</div>';
				$output .= '<h2 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h2>';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '<hr class="separator style-1 blog-title-sep" />';				
				$output .= '<div class="blog-post-content sec-color">';
				$output .= apply_filters('the_content',get_the_content());
				$output .= '</div>';
				$output .= '</div>';
				break;
			case "gallery":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'">';
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => get_the_ID()
				);
				$attachments = get_post_meta(get_the_ID(),'be_themes_gal_post_format');
				if(!empty($attachments)) {
					$output .= '<div class="home-slider single-gal-slider flex-loading clearfix">';
					$output .= '<div class="flexslider blog-flexslider">';
					$output .= '<ul class="slides">';
					foreach ( $attachments as $attachment_id ) {
						$output .= '<li>';
						$attach_img = wp_get_attachment_image_src($attachment_id, 'full');
						$output .= '<img src="'.$attach_img[0].'" alt="" />';
						$output .= '</li>';
					}
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<i class="font-icon icon-cog icon-spin"></i>';
					$output .= '</div>';
				}
				$output .= '<h2 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h2>';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '<hr class="separator style-1 blog-title-sep" />';				
				$output .= '<div class="blog-post-content sec-color">';
				$output .= apply_filters('the_content',get_the_content());
				$output .= '</div>';
				$output .= '</div>';
				break;
			case "quote":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).' quote"><div class="post-item-wrap">';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h1 class="text-align-center"><i class="font-icon icon-quote-left alt-color"></i></h1>';
				$output .= '<h2 class="blog-title text-align-center"><a href="'.get_permalink(get_the_ID()).'">"'.get_post_meta(get_the_ID(),'be_themes_quote_title',true).'"</a></h2>';
				$output .= '<p class="quote-author text-align-center"><a href="'.get_post_meta(get_the_ID(),'be_themes_quote_author_link',true).'">'.get_post_meta(get_the_ID(),'be_themes_quote_author',true).'</a></p>';
				$output .= '<div class="post-nav text-align-center">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div></div>';
				break;
			case "link":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h2 class="blog-title text-align-center"><a href="'.get_post_meta(get_the_ID(),'be_themes_link_format',true).'" target="_blank">'.get_the_title().'</a></h2>';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div></div>';
				break;					
			case "aside":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '<hr class="separator style-1 blog-title-sep" />';				
				$output .= '<div class="blog-post-content sec-color">';
				$output .= apply_filters('the_content',get_the_content());
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div></div>';
				break;
			default :
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'">';
				$output .= '<h2 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h2>';
				$output .= '<div class="post-nav">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '<span class="blog-detail-sep"> | </span>';
				$output .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
				$output .= '<span class="blog-detail-sep"> | </span>';				
				$output .= get_the_category_list(', ');
				$output .= '</div>';
				$output .= '<hr class="separator style-1 blog-title-sep" />';
				$output .= '<div class="blog-post-content sec-color">';
				$output .= apply_filters('the_content',get_the_content());
				$args = array(
				'before'           => '<div class="pages_list margin-40">',
				'after'            => '</div>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'next',
				'nextpagelink'     => __('Next >','be-themes'),
				'previouspagelink' => __('< Prev','be-themes'),
				'pagelink'         => '%',
				'echo'             => 0 );
				$output .= wp_link_pages( $args );				
				$output .= '</div>';
				$output .= '</div>';
				break;
		}		

	} else {
		$post_details = '';
		$post_details .= '<hr class="separator style-1 blog-title-sep title-bottom" />';
		$post_details .= '<p class="post-nav clearfix">';
		$post_details .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
		$post_details .= '<span class="blog-detail-sep"> | </span>';
		$post_details .= '<a href="'.get_permalink(get_the_ID()).'" class="recent-post-comment-count">'.get_comments_number().' '.__('Comments','be-themes').'</a>';
		$post_details .= '<span class="blog-detail-sep"> | </span>';
		$post_details .= get_the_category_list(', ');
		$post_details .= '<a href="'.get_permalink().'" class="right alt-color">Read More <i class="icon-right-open"></i></a>';
		$post_details .= '</p>';
		$post_details .= '<hr class="separator style-1 blog-title-sep" />';
		switch ($format) {
			case "image":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-image');
				$url = $thumb['0'];
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';
				if( $url ) {
					$output .= '<a href="'.get_permalink(get_the_ID()).'" class="image-wrap">';
					$output .= '<img src="'.$url.'" alt="" />';
					$output .= '</a>';
				}
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;
				$output .= '</div>';			
				break;
			case "video":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$url = get_post_meta(get_the_ID(),'be_themes_video_url',true);
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';

				if( !empty( $url ) ) {
					$videoType = be_video_type($url);
					if($videoType == "youtube") {
						if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
							$video_id = $match[1];
						}
						$output .= '<iframe width="940" height="450" src="http://www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe>';
					}
					elseif( $videoType == "vimeo" ) {
						sscanf( parse_url($url, PHP_URL_PATH), '/%d', $video_id );
						$output .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" allowFullScreen></iframe>';
					}
					else{
						$poster = '';
						if( has_post_thumbnail() ){
							$id = get_post_thumbnail_id( get_the_ID() );
							$img_src = wp_get_attachment_image_src( $attachment_id, 'blog-image');
							$poster = 'poster="'.$img_src[0].'"';
						}
						$output .= '<video  class="custom-video" src="'.$url.'" '.$poster.' controls="controls"></video>';
					}
				}
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;	
				$output .= '</div>';			
				break;
			case "audio":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$output .= '<div class="image-wrap">';
				$url = get_post_meta( get_the_ID(),'be_themes_audio_url',true );
				$output .= '</div>';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';
				if( !empty( $url ) ) {
					$output .= '<audio class="audio" src="'.$url.'" controls="controls"></audio>';
				}
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;
				$output .= '</div>';				
				break;
			case "gallery":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => get_the_ID()
				);
				$attachments = get_post_meta(get_the_ID(),'be_themes_gal_post_format');
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';
				if(!empty($attachments)) {
					$output .= '<div class="home-slider flex-loading clearfix">';
					$output .= '<div class="flexslider blog-flexslider">';
					$output .= '<ul class="slides">';
					foreach ( $attachments as $attachment_id ) {
						$output .= '<li>';
						$attach_img = wp_get_attachment_image_src($attachment_id, 'full');
						$output .= '<img src="'.$attach_img[0].'" alt="" />';
						$output .= '</li>';
					}
					$output .= '</ul>';
					$output .= '</div>';
					$output .= '<i class="font-icon icon-cog icon-spin"></i>';
					$output .= '</div>';
				}
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;
				$output .= '</div>';				
				break;
			case "quote":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).' quote"><div class="post-item-wrap">';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="quote-wrap alt-color"><i class="font-icon icon-quote-left"></i></h3>';
				$output .= '<h3 class="blog-title text-align-center"><a href="'.get_permalink(get_the_ID()).'">"'.get_post_meta(get_the_ID(),'be_themes_quote_title',true).'"</a></h3>';
				$output .= '<p class="quote-author text-align-center"><a href="'.get_post_meta(get_the_ID(),'be_themes_quote_author_link',true).'">'.get_post_meta(get_the_ID(),'be_themes_quote_author',true).'</a></p>';
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;
				$output .= '</div>';				
				break;
			case "link":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="link-wrap alt-color"><i class="font-icon icon-link"></i></h3>';
				$output .= '<h3 class="blog-title text-align-center"><a href="'.get_post_meta(get_the_ID(),'be_themes_link_format',true).'" target="_blank">'.get_the_title().'</a></h3>';
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;
				$output .= '</div>';				
				break;					
			case "aside":
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<p class="post-nav clearfix">';
				$output .= '<span class="recent-post-time">'.get_the_date( "F j, Y" ).'</span>';
				$output .= '</p>';
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div></div>';
				break;
			default :
				$output .= '<div class="'.implode(' ',get_post_class('blog-post')).'"><div class="post-item-wrap">';
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-image');
				$url = $thumb['0']; 
				$output .= '<div class="blog-post-content-area-wrap clearfix">';
				$output .= '<div class="blog-post-content-area">';
				$output .= '<h3 class="blog-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h3>';
				if($url) {
					$output .= '<a href="'.get_permalink(get_the_ID()).'" class="image-wrap">';
					$output .= '<img src="'.$url.'" alt="" />';
					$output .= '</a>';
				}
				$output .= '<div class="blog-post-content sec-color">';
				$output .= get_the_excerpt();
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= $post_details;
				$output .= '</div>';				
				break;
		}
	}
	echo $output;
?>