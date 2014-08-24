<?php
/**************************************************************************
							SHORTCODES 
**************************************************************************/

if (!function_exists('be_themes_formatter')) {
	function be_themes_formatter( $content ) {
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
		foreach ( $pieces as $piece ) {
			if ( preg_match( $pattern_contents, $piece, $matches ) ) {
				$new_content .= $matches[1];
			} else {
				$new_content .= wptexturize(wpautop($piece));
			}
		}
		return $new_content;
	}
}

/**************************************
			SECTION
**************************************/

if (!function_exists('be_section')) {
	function be_section( $atts, $content ) {
		extract( shortcode_atts( array(
	        'bg_color'=>'',
	        'bg_image' => '',
	        'bg_repeat' => 'repeat',
	        'bg_attachment' => 'scroll',
	        'bg_position' => 'left top',
	        'bg_stretch'=>0,
	        'bg_parallax'=>0,
	        'border_size' => '1',
	        'border_color' =>'',
	        'padding_top'=>'',
	        'padding_bottom'=>'',
	        'bg_video'=>0,
	        'bg_video_mp4_src'=>'',
			'bg_overlay'=>0,
			'overlay_color'=>'',
			'overlay_opacity'=>'',
			'section_id'=>''
	    ),$atts));
	    $background = '';
	    $border = '';
	    if(empty( $bg_image  ) ) {
	    	if( ! empty( $bg_color ) ) {
	    		$background = 'background-color: '.$bg_color.';';
			}
	    } else {
			$attachment_info=wp_get_attachment_image_src($bg_image,'full');
			$attachment_url = $attachment_info[0];
			if( ! empty( $attachment_url ) ) {
				if( isset( $bg_parallax ) && 1 == $bg_parallax ) {
					$bg_position = 'center center';
				}
	    		$background = 'background:'.$bg_color.' url('.$attachment_url.') '.$bg_repeat.' '.$bg_attachment.' '.$bg_position.';';
	    	}
	    }
	    if( ! empty( $border_color ) ) {
	    	$border = 'border-top:'.$border_size.'px solid '.$border_color.';border-bottom:'.$border_size.'px solid '.$border_color.';';
	    }
	    if( isset( $padding_top ) && $padding_top != '' ) {
	    	$padding_top = 'padding-top:'.$padding_top.'px;';
	    }
	    if( isset( $padding_bottom ) && $padding_bottom != '' ) {
	    	$padding_bottom = 'padding-bottom:'.$padding_bottom.'px;';
	    }
	    if( isset( $bg_stretch ) && 1 == $bg_stretch ) {
	    	$bg_stretch = 'be-bg-cover';
	    } else {
	    	$bg_stretch = '';
	    }
	    if( isset( $bg_parallax ) && 1 == $bg_parallax ) {
	    	$bg_parallax = 'be-bg-parallax';
	    } else {
	    	$bg_parallax = '';
	    }
	    $bg_overlay_class = '';
	    $bg_video_class = '';
	    if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
	    	$bg_overlay_class = 'be-bg-overlay';
	    }    
	    if( isset( $bg_video ) && 1 == $bg_video ) {
	    	$bg_video_class = 'be-video-section';
	    }
	    $output = '';
	    $output .= '<div class="be-section '.$bg_stretch.' '.$bg_parallax.' '.$bg_overlay_class.' '.$bg_video_class.' clearfix" style="'.$background.$border.'" id="'.$section_id.'">';
	    $output .= '<div class="be-section-pad clearfix" style="'.$padding_top.$padding_bottom.'">';
		if( isset( $bg_video ) && 1 == $bg_video ) {
			$output .= '<video class="be-bg-video" autoplay="autoplay" loop="loop" muted="muted" preload="auto">';
			$output .= '<source src="'.$bg_video_mp4_src.'" type="video/mp4">';
			$output .= '</video>';
		}	   
		if( isset( $bg_overlay ) && 1 == $bg_overlay ) {
			$opacity = '';
			if($overlay_opacity) {
				$opacity .= '-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity='.floatval($overlay_opacity).');';
				$opacity .= 'filter: alpha(opacity='.floatval($overlay_opacity).');';
				$opacity .= '-moz-opacity: '.floatval($overlay_opacity/100).';';
				$opacity .= '-khtml-opacity: '.floatval($overlay_opacity/100).';';
				$opacity .= 'opacity: '.floatval($overlay_opacity/100).';';
			}
			$output .= '<div class="section-overlay" style="background: '.$overlay_color.'; '.$opacity.'"></div>';
		}
	    $output .= do_shortcode( $content );
	    $output .= '</div>';
	    $output .= '</div>';
	    return $output;
	}
}
add_shortcode( 'section', 'be_section' );

/**************************************
			ROW
**************************************/

if (!function_exists('be_row')) {
	function be_row( $atts, $content ) {
		extract( shortcode_atts( array(
	        'no_wrapper'=>0,
	        'no_margin_bottom'=>0,
	    ),$atts ) );
		$class = 'be-wrap clearfix';
	    if( isset( $no_wrapper ) &&  1 == $no_wrapper ) {
	    	$class = '';
	    }
	    if( isset( $no_margin_bottom ) &&  1 == $no_margin_bottom ) {
	    	$class .= ' zero-bottom';
	    }
		return '<div class="be-row '.$class.'">'.do_shortcode( $content ).'</div>';
	}
}
add_shortcode( 'row','be_row' );

/**************************************
			TEXT BLOCK
**************************************/

if (!function_exists('be_text')) {
	function be_text( $atts, $content ) {
		extract( shortcode_atts( array(
	        'animate'=>0,
	        'animation_type'=>'slide-up',
	    ),$atts ) );
	    $output = '';
	    if( isset( $animate ) && 1 == $animate ) {
	    	$output .= '<div class="be-text-block be-animate" data-animation="'.$animation_type.'">';
	    }
	    $output .= be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
	    if( isset( $animate ) && 1 == $animate ) {
	    	$output .= '</div>';
	    }
		return $output;
	}
}
add_shortcode( 'text', 'be_text' );

/**************************************
			Html BLOCK
**************************************/

if (!function_exists('be_html')) {
	function be_html( $atts, $content ) {
		extract( shortcode_atts( array (
	        'animate'=>0,
	        'animation_type'=>'slide-up',
	    ),$atts ) );
	    $output = '';
	    if( isset( $animate ) && 1 == $animate ) {
	    	$output .= '<div class="be-text-block be-animate" data-animation="'.$animation_type.'">';
	    }
	    $output .= $content;
	    if( isset( $animate ) && 1 == $animate ) {
	    	$output .= '</div>';
	    }
		return $output;
	}
}
add_shortcode( 'html', 'be_html' );

/**************************************
			PREMIUM SLIDERS
**************************************/

if (!function_exists('be_premium_sliders')) {
	function be_premium_sliders( $atts, $content ) {
		return do_shortcode( $content );
	}
}
add_shortcode( 'premium_sliders', 'be_premium_sliders' );

/**************************************
			SEPARATOR
**************************************/

if (!function_exists('be_separator')) {
	function be_separator( $atts ) {
		extract( shortcode_atts( array(
	        'style' => 'style-1',
	        'color' =>'',
	    ),$atts ) );
		$output ='';
		if( ! empty( $color ) ) {
			$color = 'style="border-color:'.$color.';color:'.$color.';"';
		}
		$output .='<hr class="be-shortcode separator '.$style.'" '.$color.' />';
		return $output;
	}
}
add_shortcode( 'separator', 'be_separator' );

/**************************************
			Special Heading
**************************************/

if (!function_exists('be_special_heading')) {
	function be_special_heading( $atts, $content ) {
		extract( shortcode_atts( array(
	        'divider_style' => 'style-1',
	        'h_tag' => 'h3',
	        'align' => 'center',
	        'color' => '#323232',
	    ),$atts ) );

		$output ='';
		if( ! empty( $color ) ) {
			$color = 'style="border-color:'.$color.';color:'.$color.';"';
		}		
		$output .='<div class="special-heading align-'.$align.'"><'.$h_tag.' class="special-h-tag">'.$content.'</'.$h_tag.'><hr class="separator style-2" '.$color.' /></div>';
		return $output;
	}
}
add_shortcode( 'special_heading', 'be_special_heading' );

/**************************************
			LINEBREAK
**************************************/

if (!function_exists('be_linebreak')) {
	function be_linebreak( $atts ) {
		extract(shortcode_atts( array(
	        'height'=>'50',
	    ),$atts ) );	
		$output = '';
		$output .='<div class="linebreak" style="height:'.$height.'px;"></div>';
		return $output;
	}
}
add_shortcode( 'linebreak', 'be_linebreak' );

/**************************************
			YOUTUBE
**************************************/

if (!function_exists('be_video')) {
	function be_video( $atts, $content ) {
		extract(shortcode_atts( array(
			'source'=>'youtube',
	        'url'=>'',
	    ),$atts ) );

	    switch ( $source ) {
	    	case 'youtube':
	    		return be_youtube( $url );
	    		break;
	    	
	    	default:
	    		return be_vimeo( $url );
	    		break;
	    }
	}
}
add_shortcode( 'video', 'be_video' );

	/**************************************
				Youtube
	**************************************/
	if (!function_exists('be_youtube')) {
		function be_youtube( $url ) {
			$video_id = '';
			if( ! empty( $url ) ) {
				if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
					
					$video_id = $match[1];
				}
				return '<iframe class="youtube" src="http://www.youtube.com/embed/'.$video_id.'" style="border: none;"></iframe>';		
			} else {
				return '';
			}

		}
	}
	/**************************************
				VIMEO
	**************************************/
	if (!function_exists('be_vimeo')) {
		function be_vimeo( $url ) {
			$video_id = '';
			if( ! empty( $url ) ) {
				sscanf(parse_url($url, PHP_URL_PATH), '/%d', $video_id);
				return '<iframe src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" style="border: none;"></iframe>';
			} else {
				return '';
			}
		}
	}
	
/**************************************
			TITLE WITH ICON
**************************************/

if (!function_exists('be_title_icon')) {
	function be_title_icon( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'style'=>'small',
			'icon'=>'none',
			'circled'=>0,
			'icon_bg'=> $be_themes_data['color_scheme'],
			'icon_color'=>$be_themes_data['alt_bg_text_color'],
			'image'=>'',
			'title' =>'',
			'h_tag'=>'h4',
			'animate'=> 0,
			'animation_type'=> 'slide-up',
		),$atts ) );
		if( isset( $animate ) && 1 == $animate ) {
			$animate = ' be-animate';
		} else {
			$animate = '';
		}
		$output = '';
		if( 1 == $circled ) {
			$circled = 'circled';
			$background_color = 'background-color:'.$icon_bg.';';
		} else {
			$circled = '';
			$background_color = ''; 		
		}
		if( empty( $image ) && $icon == 'none' ) {
			$output .= '<div class="title-with-icon '.$animate.'" data-animation="'.$animation_type.'">';
			$output .='<'.$h_tag.'>'.$title.'</'.$h_tag.'>';
			$output .= do_shortcode($content);
			$output .='</div>';    	
		} elseif( ! empty( $image ) ) {
			$img = wp_get_attachment_image_src( $image, 'full' );

			if( $style == 'small' ) {
				$output .= '<div class="title-with-icon image '.$style.' '.$animate.'" data-animation="'.$animation_type.'">';
				$output .='<'.$h_tag.' class="title-icon-heading"><img class="title-image-icon" src='.$img[0].' alt="'.$title.'" />'.$title.'</'.$h_tag.'>';
				$output .= be_themes_formatter(do_shortcode(shortcode_unautop($content)));
				$output .='</div>';	    	
			} else {
				$output .= '<div class="title-with-icon image '.$style.' '.$animate.'" data-animation="'.$animation_type.'">';	    	
				$output .='<img class="title-image-icon" src='.$img[0].' alt="'.$title.'" />';
				$output .= '<'.$h_tag.' class="title-icon-heading">'.$title.'</'.$h_tag.'>';
				$output .= be_themes_formatter(do_shortcode(shortcode_unautop($content)));
				$output .='</div>';  
			}
		} elseif($icon !='none') {
			if($style == 'small'){
				$output .= '<div class="title-with-icon '.$style.' '.$animate.'" data-animation="'.$animation_type.'">';
				$output .='<'.$h_tag.' class="title-icon-heading"><i class="font-icon icon-'.$icon.' title-icon '.$circled.'" style="'.$background_color.'color:'.$icon_color.';"></i>'.$title.'</'.$h_tag.'>';
				$output .= be_themes_formatter(do_shortcode(shortcode_unautop($content)));
				$output .='</div>';	    	
			} else {
				$output .= '<div class="title-with-icon '.$style.' '.$animate.'" data-animation="'.$animation_type.'">';	    	
				$output .='<i class="font-icon icon-'.$icon.' title-icon '.$circled.'" style="'.$background_color.'color:'.$icon_color.';"></i>';
				$output .= '<'.$h_tag.' class="title-icon-heading">'.$title.'</'.$h_tag.'>';
				$output .= be_themes_formatter(do_shortcode(shortcode_unautop($content)));
				$output .='</div>';  
			}		
		}
		return $output; 
	}
}
add_shortcode( 'title_icon', 'be_title_icon' );

/**************************************
			DROP CAPS
**************************************/

if (!function_exists('be_dropcap')) {
	function be_dropcap( $atts, $content ) {
		extract( shortcode_atts( array(
	        'type'=>'circle',
	        'color'=>'',
	        'size' =>'small',
	        'letter'=>'',
	        'icon'=>'none',
	    ), $atts ) );
		$output="";
		if( $icon != 'none' ){
			$letter = '<i class="font-icon icon-'.$icon.'"></i>';
		}
		$background_color="";
		if( $type == 'square' ) {
			if( $color ){
	    		$background_color = '" style="background-color:'.$color.';"';
	   		} else {
	   			$background_color = ' alt-bg alt-bg-text-color"';
	   		}
			return '<span class="dropcap dropcap-square '.$size.$background_color.'>'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		}
		if( $type == 'circle' ) {
			if( $color ){
	    		$background_color = '" style="background-color:'.$color.';"';
	   		} else {
	   			$background_color = ' alt-bg alt-bg-text-color"';
	   		}
			return '<span class="dropcap dropcap-circle '.$size.$background_color.'>'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		} else {
		    if( $color ){
	    		$background_color = ' style="color:'.$color.';"';
	   		}
			return '<span class="dropcap dropcap-letter '.$size.'"'.$background_color.'>'.$letter.'</span>'.be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		}
	}
}
add_shortcode( 'dropcap', 'be_dropcap' );

/**************************************
			Animated Numbers
**************************************/

if (!function_exists('be_animated_numbers')) {
	function be_animated_numbers( $atts, $content ) {
		extract( shortcode_atts( array(
			'number' => '',
			'caption' => '',
	        'number_size' => '35',
	        'number_color' => '#323232',
	        'caption_size' => '12',
	        'caption_color' => '#323232',
	    ), $atts ) );
		$output = '';
		$output = '<div class="animate-number-wrap">';
		$output .= '<span class="animate-number" data-number="'.$number.'" style="color:'.$number_color.';font-size:'.$number_size.'px;line-height:1"></span>';
		//$output .= '<br />';
		$output .= '<span class="animate-number-caption" style="color:'.$caption_color.';font-size:'.$caption_size.'px;">'.$caption.'</span>';
		$output .= '</div>';
		return $output;
	}
}
add_shortcode( 'animated_numbers', 'be_animated_numbers' );

/*=============================
	TABS
=============================*/

if (!function_exists('be_tabs')) {
	function be_tabs( $atts, $content ){
		$GLOBALS['tabs_cnt'] = 0;
		$tabs_cnt=0;
		$GLOBALS['tabs'] = array();
		$rand = rand();
		$content=do_shortcode( $content );
			
		if( is_array( $GLOBALS['tabs'] ) ){
			foreach( $GLOBALS['tabs'] as $tab ){
				$tabs_cnt++;
				$tabs[] = '<li><a href="#fragment-'.$tabs_cnt.'-'.$rand.'" >'.$tab['title'].'</a></li>';
				$panes[] = '<div id="fragment-'.$tabs_cnt.'-'.$rand.'"><p>'.$tab['content'].'</p></div>';
			}
			$return = "\n".'<div class="tabs"><ul class="clearfix">'.implode( "\n", $tabs ).'</ul>'.implode( $panes ).'</div>'."\n";
		}
		return $return;
	}
}
add_shortcode( 'tabs', 'be_tabs' );

if (!function_exists('be_tab')) {
	function be_tab( $atts, $content ){
		$content= do_shortcode($content);
		extract($atts);
		$x = $GLOBALS['tabs_cnt'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tabs_cnt'] ), 'content' =>  $content);
		$GLOBALS['tabs_cnt']++;
	}
}
add_shortcode( 'tab', 'be_tab' );

/*=============================
	ACCORDIAN
=============================*/

if (!function_exists('be_accordion')) {
	function be_accordion( $atts, $content ){
		return '<div class="accordion">'.do_shortcode($content).'</div>';
	}
}
add_shortcode( 'accordion', 'be_accordion' );

if (!function_exists('be_toggle')) {
	function be_toggle( $atts, $content ){
		extract(shortcode_atts(array('title'=>''),$atts));
		return '<h3>'.$title.'</h3><div>'.do_shortcode($content).'</div>';
	}
}
add_shortcode( 'toggle', 'be_toggle' );

/**************************************
			TESTIMONIALS
**************************************/

if (!function_exists('be_testimonials')) {
	function be_testimonials( $atts, $content ){
		extract( shortcode_atts( array(
	        'animation'=> 'fade',
			'slide_interval'=> '3000'
	    ), $atts ) );
		return '<div class="be-testimonials cbp-qtrotator sec-bg sec-color">'.do_shortcode($content).'</div>';
	}
}
add_shortcode( 'testimonials', 'be_testimonials' );

if (!function_exists('be_testimonial')) {
	function be_testimonial( $atts, $content ) {
		extract(shortcode_atts(array('image'=>'', 'author'=>'', 'company'=>''),$atts));
		if ( !empty( $image ) ) {
			$attachment_info = wp_get_attachment_image_src( $image, 'thumbnail' );
			$attachment_url = $attachment_info[0];
			$author_image =  '<img class="be-testi-author-img" src="'.$attachment_url.'" alt="" />';
		}
		$output = '';
		$output .= '<div class="cbp-qtcontent">';
		$output .= '<div class="be-testimonial-wrap">'.$author_image;
		if( !empty($author) || !empty($company) ) {
			$output .= '<h6 class="be-testi-author">'.$author.' <span class="alt-color">'.$company.'</span></h6>';
		}
		$output .= '<i class="font-icon icon-quote-left alt-color"></i>'.do_shortcode($content);
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
}
add_shortcode( 'testimonial', 'be_testimonial' );

/**************************************
			MEET OUR TEAM
**************************************/

if (!function_exists('be_team')) {
	function be_team( $atts, $content ) {
		extract( shortcode_atts( array ( 
			'title'=>'',
			'h_tag'=>'h5',
			'image'=>'',
			'designation'=>'',
			'description'=>'',
			'facebook'=>'',
			'twitter'=>'',
			'dribbble'=>'',
			'google_plus'=>'',
			'linkedin'=>'',
			'youtube'=>'',
			'animate'=> 0,
	        'animation_type'=> 'slide-up',
		),$atts ) );
		if( isset( $animate ) && 1 == $animate ) {
	    	$animate = ' be-animate';
	    } else {
			$animate = '';
		}
		$output = '';
		$url = wp_get_attachment_image_src( $image, 'portfolio-one' );
		$output .= '<div class="team-img '.$animate.'" data-animation="'.$animation_type.'"><img src="'.$url[0].'" alt="'.$title.'" /></div>
					<div class="team-wrap '.$animate.'" data-animation="'.$animation_type.'">
					<'.$h_tag.' class="team-title sec-title-color">'.$title.'</'.$h_tag.'><p class="designation">'.$designation.'</p>
					<p class="team-description">'.$description.'</p>';
		if( ! empty( $facebook ) || ! empty( $twitter ) || ! empty( $dribbble ) || ! empty( $google_plus ) || ! empty( $linkedin ) || ! empty( $youtube ) || ! empty( $vimeo ) ){
			$output .='<ul class="team-social clearfix">';
			if( ! empty( $facebook ) ){
				$output .='<li><a href="'.$facebook.'" class="team_icons" target="_blank"><i class="icon-facebook"></i></a></li>';
			}
			if( ! empty( $twitter ) ){
				$output .='<li><a href="'.$twitter.'" class="team_icons" target="_blank"><i class="icon-twitter"></i></a></li>';
			}
			if( ! empty( $google_plus ) ){
				$output .='<li><a href="'.$google_plus.'" class="team_icons" target="_blank"><i class="icon-gplus"></i></a></li>';
			}
			if( ! empty( $linkedin ) ){
				$output .='<li><a href="'.$linkedin.'" class="team_icons" target="_blank"><i class="icon-linkedin"></i></a></li>';
			}
			if( !empty( $youtube ) ){
				$output .='<li><a href="'.$youtube.'" class="team_icons" target="_blank"><i class="icon-youtube"></i></a></li>';
			}								
			if( !empty( $dribbble ) ){
				$output .='<li><a href="'.$dribbble.'" class="team_icons" target="_blank"><i class="icon-dribbble"></i></a></li>';
			}
			$output .='</ul>';
		}			
		$output .='</div>';			
		return $output;		
	}
}
add_shortcode( 'team', 'be_team' );

/**************************************
			LISTS
**************************************/

if (!function_exists('be_lists')) {
	function be_lists( $atts, $content ) {
		return '<ul class="custom-list">'.do_shortcode( $content ).'</ul>';
	}
}
add_shortcode( 'lists', 'be_lists' );

if (!function_exists('be_list')) {
	function be_list( $atts, $content ) {
		global $be_themes_data;
		extract(shortcode_atts( array( 
			'icon'=>'',
			'circled'=>'',
			'icon_bg'=> $be_themes_data['color_scheme'], 
			'icon_color' => $be_themes_data['alt_bg_text_color'], 
		), $atts ) );
		//$content = str_replace('<ul>', '<ul class="'.$style.' custom-list">', do_shortcode($content));
		if( $icon != 'none' ) { 
		 	if( 1 == $circled ){
		 		$circled = 'circled';
		 		$background_color = 'background-color:'.$icon_bg.';';
		 	} else {
		 		$circled = '';
		 		$background_color = ''; 		
		 	}
		} 
		return '<li class="clearfix"><i class="font-icon icon-'.$icon.' '.$circled.'" style="'.$background_color.'color:'.$icon_color.';"></i><p class="custom-list-content">'.$content.'</p></li>';
	}
}
add_shortcode( 'list', 'be_list' );

/**************************************
			NOTIFICATIONS
**************************************/

if (!function_exists('be_notifications')) {
	function be_notifications( $atts, $content ) {
		extract(shortcode_atts( array(
	        'bg_color'=>'',
	    ), $atts ) );
	    $style = '';
		if( ! empty( $bg_color ) ) {
			$style = 'background-color:'.$bg_color.';';
		}
		return '<div class="be-notification" style="'.$style.'">'.do_shortcode( $content ).'<span class="close"><i class="font-icon icon-cancel"></i></span></div>';
	}
}
add_shortcode( 'notifications', 'be_notifications' );

/**************************************
			CONTENT FORMATING
**************************************/

if (!function_exists('be_one_col')) {
	function be_one_col( $atts, $content ) {
		$output = '';
		$output .= '<div class="one-col column-block clearfix">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'one_col', 'be_one_col' );

/***********ONE THIRD**************/

if (!function_exists('be_one_third')) {
	function be_one_third( $atts, $content ) {
		$output = '';
		$output .= '<div class="one-third column-block">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'one_third', 'be_one_third' );

if (!function_exists('be_one_third_last')) {
	function be_one_third_last( $atts, $content ) {
		$output = '';
		$output .= '<div class="one-third column-block last">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
}
add_shortcode( 'one_third_last', 'be_one_third_last' );

/***********ONE FOURTH**************/
	
if (!function_exists('be_one_fourth')) {
	function be_one_fourth( $atts, $content ) {
		$output = '';
		$output = '<div class="one-fourth column-block">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'one_fourth', 'be_one_fourth' );
	
if (!function_exists('be_one_fourth_last')) {
	function be_one_fourth_last( $atts, $content ) {
		$output = '';
		$output .= '<div class="one-fourth column-block last">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
}
add_shortcode( 'one_fourth_last', 'be_one_fourth_last' );

if (!function_exists('be_one_fifth')) {
	function be_one_fifth( $atts, $content ) {
		$output = '';
		$output = '<div class="one-fifth column-block">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'one_fifth', 'be_one_fifth' );

if (!function_exists('be_one_fifth_last')) {
	function be_one_fifth_last( $atts, $content ) {
		$output = '';
		$output = '<div class="one-fifth column-block last">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'one_fifth_last', 'be_one_fifth_last' );

/***********ONE HALF**************/

if (!function_exists('be_one_half')) {
	function be_one_half( $atts, $content )  {
		$output = '';
		$output = '<div class="one-half column-block">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'one_half', 'be_one_half' );

if (!function_exists('be_one_half_last')) {
	function be_one_half_last( $atts, $content ) {
		$output = '';
		$output .= '<div class="one-half column-block last">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
}
add_shortcode('one_half_last','be_one_half_last');

/***********TWO THIRD**************/
		
if (!function_exists('be_two_third')) {
	function be_two_third( $atts, $content ) {
		$output = '';
		$output = '<div class="two-third column-block">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'two_third', 'be_two_third' );

if (!function_exists('be_two_third_last')) {
	function be_two_third_last( $atts, $content ) {
		$output = '';
		$output = '<div class="two-third column-block last">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
}
add_shortcode('two_third_last','be_two_third_last');
/***********THREE FOURTH**************/	

if (!function_exists('be_three_fourth')) {
	function be_three_fourth( $atts, $content ) {
		$output = '';
		$output = '<div class="three-fourth column-block">'.do_shortcode( $content ).'</div>';
		return $output;
	}
}
add_shortcode( 'three_fourth', 'be_three_fourth' );

if (!function_exists('be_three_fourth_last')) {
	function be_three_fourth_last( $atts, $content ) {
		$output = '';
		$output = '<div class="three-fourth column-block last">'.do_shortcode( $content ).'</div>';
		$output .= '<div class="clear"></div>';
		return $output;
	}
}
add_shortcode('three_fourth_last','be_three_fourth_last');

/**************************************
			BUTTON
**************************************/

if (!function_exists('be_button')) {
	function be_button( $atts, $content ) {
		extract( shortcode_atts( array( 
			'color'=>'#000000',
			'url'=>'',
			'hover'=>'',
			'type'=>'small',
			'icon'=>'',
			'gradient'=>'', 
			'rounded'=>'',
			'button_text'=>'',
			'alignment'=>'',
			'align_center'=>''
		), $atts ) );
		!empty( $color ) ? ( $background_color = "background-color:".$color ) : ( $background_color="" );
		
		if( empty( $hover ) ) {
			$hover = $color;
		}
		
		( !empty( $icon ) && $icon != 'none' )  ? ( $icon = "icon-".$icon." icon-button" ) : ( $icon = '' );
		$gradient == "1" ? ( $gradient = "gradient" ): ( $gradient = '' );
		$rounded == "1" ? ( $rounded = "rounded" ): ( $rounded = '' );

		$class = '';
		if( isset( $align_center ) && 1 == $align_center ) {
			$class = 'block-center';
		} else {
			$class = 'block-inline';
		}
		$output = '';
		if( $type == 'link' ) {
			$output .= '<a href="'.$url.'">'.$button_text.'</a>';
		} else {
			$output .= '<div class="be-button-wrap '.$class.' be-align-'.$alignment.'"><a class="be-shortcode '.$type.'btn be-button '.$gradient.' '.$rounded.' '.$icon.'" data-hover-color="'.$hover.'" data-default-color="'.$color.'" href="'.$url.'" style="'.$background_color.'" >'.$button_text.'</a></div>';
		}
		return $output;
	}
}
add_shortcode( 'button', 'be_button' );

/**************************************
			Font Icons
**************************************/

if (!function_exists('be_icons')) {
	function be_icons( $atts, $content ) {
		extract(shortcode_atts(array(
			'name' => '',
			'size'=> 'small',
			'color'=> '#fff',
			'bg_color'=> '#000',
			'style'=> 'square',
			'href'=> '#',
			'hover_color'=> '#fff',
			'hover_bg_color'=> '#000',
			'align_center' => 0,
			'animate'=> 0,
			'animation_type'=> 'slide-up',
		),$atts));
		if( isset( $animate ) && 1 == $animate ) {
			$animate = ' be-animate';
		} else {
			$animate = '';
		}
		$output = "";
		$class = '';
		 if( isset( $align_center ) && 1 == $align_center ) {
			$class = 'block-center';
		 }
		if( $style == 'plain' ) {
			$output .='<a href="'.$href.'" class="icon-shortcode '.$class.' '.$animate.'" data-animation="'.$animation_type.'"><i class="font-icon icon-'.$name.' '.$size.' '.$style.'" style="color:'.$color.';" data-color="'.$color.'" data-hover-color="'.$hover_color.'"></i></a>';
		} else {
			$output .='<a href="'.$href.'" class="icon-shortcode '.$class.' '.$animate.'" data-animation="'.$animation_type.'"><i class="font-icon icon-'.$name.' '.$size.' '.$style.'" style="color:'.$color.';background-color:'.$bg_color.';" data-color="'.$color.'" data-bg-color="'.$bg_color.'" data-hover-color="'.$hover_color.'" data-bg-hover-color="'.$hover_bg_color.'"></i></a>';
		}
		return $output;
	}	
}
add_shortcode( 'icon', 'be_icons' );

/**************************************
			PORTFOLIO
**************************************/

if (!function_exists('be_portfolio')) {
	function be_portfolio( $atts ) {
		global $be_themes_data;
		extract( shortcode_atts( array (
	        'portfolio_style'=> 'centered',
	        'portfolio_layout'=> 'no',
	        'portfolio_lightbox'=> 'no',
	        'portfolio_show_title'=> 0,
	        'portfolio_show_cat'=> 0,
			'filter'=> 'categories',        
	        'category'=> '',
	        'show_filters'=> 'yes',
	        'pagination'=> 'loadmore',
	        'items_per_page'=> '10',
	        'overlay_color'=> $be_themes_data['color_scheme'],
	        'filter_bg'=> $be_themes_data['color_scheme'],
	        'filter_color' => $be_themes_data['alt_bg_text_color'],
	        'filter_align' => 'left',
	    ) , $atts ) );
		
		$output = '';
		global $paged;
		$pageoptions = array();
		$showposts = $items_per_page;
		if($filter == "tag") {
			$filteres_to_use='portfolio_tags';
		}
		else {
			$filteres_to_use='portfolio_categories';
		}
		$selected_categorey = explode(",", $category);
		if($selected_categorey) {
			$args_cat = array( 'taxonomy' => array($filteres_to_use) );
			$stack = array();
			foreach(get_categories($args_cat) as $single_category){
				if (in_array($single_category->slug, $selected_categorey)) {
					array_push($stack, $single_category->cat_ID);
				}
			}
			$terms = get_terms($filteres_to_use, array('include' => $stack));
		}
		else {
			$terms = get_terms($filteres_to_use);
		}
		if($portfolio_style) {
			$portfolio_type = $portfolio_style;
		}
		else {
			$portfolio_type = 'centered';
		}
		if(!$showposts) {
			$showposts = get_option('posts_per_page');
		}
		if($portfolio_layout == 'yes') {
			$pageoptions['image_size'] = 'one-half';
		} else {
			$pageoptions['image_size'] = 'portfolio-four';
		}
		if($portfolio_lightbox == 'yes') {
			$pageoptions['lightbox'] = 'lightbox';
		} else {
			$pageoptions['lightbox'] = 'no-lightbox';
		}
		if($portfolio_show_title) {
			$pageoptions['title'] = 'yes';
		} else {
			$pageoptions['title'] = 'no';
		}
		if($portfolio_show_cat) {
			$pageoptions['cat'] = 'yes';
		} else {
			$pageoptions['cat'] = 'no';
		}
		$offset = ( ( $showposts * $paged ) - $showposts );
		if($paged == 0) {
			$offset=0;
		} else {
			$offset = ( ( $showposts * $paged ) - $showposts );
		}
		if( $category ) {
			if($pagination == 'none') {
				$args = array (
					'post_type' => 'portfolio',
					'showposts' => -1,
					'tax_query' => array(
						array (
							'taxonomy' => 'portfolio_categories',
							'field' => 'slug',
							'terms' => $selected_categorey,
							'operator' => 'IN'
						)
					)
				);
			}
			else {
				$args = array (
					'post_type' => 'portfolio',
					'tax_query' => array(
						array (
							'taxonomy' => 'portfolio_categories',
							'field' => 'slug',
							'terms' => $selected_categorey,
							'operator' => 'IN'
						)
					),
					'posts_per_page' => $showposts,
					'offset' => $offset
				);
			}
		}
		else {
			if($pagination == 'none') {
				$args = array (
					'post_type' => 'portfolio',
					'showposts' => -1
				);
			}
			else {
				$args = array (
					'post_type' => 'portfolio',
					'posts_per_page' => $showposts,
					'offset' => $offset
				);
			}
		}
		$the_query = new WP_Query( $args );
		$output .= '<div class="portfolio-wrap">';
		if($terms && $show_filters == 'yes') {
			$output .= '<div class="clearfix filters_list_container align-'.$filter_align.'" style="background-color:'.$filter_bg.';"><div class="filters_lists" style="color:'.$filter_color.';">';
			$categorys = "";
			$numItems = count($terms);
			$i = 0;
			$output.='<span class="sort current_choice" data-id="hentry">All</span><span class="filter-sep">|</span>';
			foreach ($terms as $term) {
				$i++;
				$output.='<span class="sort" data-id="'.$term->slug.'">'.$term->name.'</span>';
				if( $i != $numItems ) {
					$output .= '<span class="filter-sep">|</span>';
				}	
			}
			$output.='</div></div>';
		}
		if($portfolio_type == 'centered2') {
			$portfolio_type_class = 'centered portfolio-centered2';
		} else {
			$portfolio_type_class = $portfolio_type;
		}
		$output .= '<div id="gallery-container" class="portfolio portfolio-'.$portfolio_type_class.' clearfix " data-total-posts="'.($the_query->found_posts-$the_query->post_count).'">';
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$terms= be_themes_get_taxonomies_by_id(get_the_ID(), $filteres_to_use);
			$portfolio_category = "";
			foreach ($terms as $term) {
				$portfolio_category .= $term->slug." ";
			}
			$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
			$length = 1;
			if($terms) {
				$termoutput = '';
				foreach ($terms as $term) {
					$termoutput .= '<span>'.$term->name.'</span>';
					if(count($terms) != $length) {
						$termoutput .= ' | ';
					}
					$length++;
				}
			}
			$attachment_id = get_post_thumbnail_id(get_the_ID());
			$attachment_images_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $pageoptions['image_size'] );
			$attachment_url = $attachment_images_src[0]; 
			$attachment_full = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$attachment_full_url = $attachment_full[0];
			$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
			if($pageoptions['lightbox'] == 'lightbox') {
				$mfp_class='mfp-image image-popup-vertical-fit';
				if( ! empty( $video_url ) ) {
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe image-popup-vertical-fit';
				}
				$link = $attachment_full_url;
				$target = '';
			} else {
				$mfp_class = 'no-lightbox';
				$project_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_visitsite_url', true );
				if(get_post_meta( get_the_ID(), 'be_themes_portfolio_item_link_to_project_url', true ) && !empty($project_url)) {
					$link = $project_url;
					$target = 'target="_blank"';
				} else {
					$link = get_permalink();
					$target = '';
				}
			}
			switch ($portfolio_type) {
				case 'centered2':
					$output .= '<div  class="hentry portfolio-item centered centered2 '.$portfolio_category.'"><div class="portfolio-item-wrap"><div class="portfolio-item-wrap-inner">';
					$output .= '<a href="'.$link.'" class="portfolio-centered2-item-wrap '.$mfp_class.'" '.$target.'>';
					$output .= '<img src="'.$attachment_url.'" alt="" />';
					$output .= '<div class="portfolio-overlay" style="background-color:'.$overlay_color.';"><div class="portfolio-overlay-inner"><div class="portfolio-overlay-centered">';
					if( $pageoptions['title'] == 'yes' || $pageoptions['cat'] == 'yes' ) {
						if( $pageoptions['title'] == 'yes' ) {
							$output .= '<h6 class="fadeInLeft animated">'.get_the_title().'</h6>';
						}
						if( $pageoptions['title'] == 'yes' && $pageoptions['cat'] == 'yes' ) {
							$output .= '<div><div class="portfolio-overlay-sep"></div></div>';
						}
						if( $pageoptions['cat'] == 'yes' ) {
							$output .= '<div class="portfolio-item-terms fadeInRight animated">'.$termoutput.'</div>';
						}
					} else {
						$output .= '<i class="font-icon icon-plus portfolio-ovelay-icon rollIn animated"></i>';
					}
					$output .= '</div></div></div></a></div></div></div>';
					break;
				case 'full-width':
					$output .= '<div  class="hentry portfolio-item full-width '.$portfolio_category.'">';
					$output .= '<a class="portfolio-item-wrap '.$mfp_class.'" href="'.$link.'" '.$target.'>';
					$output .= '<img src="'.$attachment_url.'" />';
					$output .= '<div class="portfolio-overlay" style="background-color:'.$overlay_color.';"><div class="portfolio-overlay-inner"><div class="portfolio-overlay-centered">';
					if( $pageoptions['title'] == 'yes' || $pageoptions['cat'] == 'yes' ) {
						if($pageoptions['title'] == 'yes' ) {
							$output .= '<h6 class="fadeInLeft animated">'.get_the_title().'</h6>';
						}
						if( $pageoptions['title'] == 'yes' && $pageoptions['cat'] == 'yes' ) {
							$output .= '<div><div class="portfolio-overlay-sep"></div></div>';
						}
						if( $pageoptions['cat'] == 'yes' ) {
							$output .= '<div class="portfolio-item-terms fadeInRight animated">'.$termoutput.'</div>';
						}
					} else {
						$output .= '<i class="font-icon icon-plus portfolio-ovelay-icon rollIn animated"></i>';
					}
					$output .= '</div></div></div></a></div>';
					break;
				default:
					$output .= '<div  class="hentry portfolio-item centered '.$portfolio_category.'"><div class="portfolio-item-wrap"><div class="portfolio-item-wrap-inner">';
					$output .= '<a href="'.$link.'" class="'.$mfp_class.'" '.$target.'><img src="'.$attachment_url.'" /></a>';
					if( $pageoptions['title'] == 'yes' || $pageoptions['cat'] == 'yes' ) {
						$output .= '<div class="portfolio-item-bottom-details clearfix">';
						if($pageoptions['title'] == 'yes' ) {
							$output .= '<h3 class="portfolio-item-title"><a href="'.$link.'" '.$target.'>'.get_the_title().'</a></h3>';
						}
						if( $pageoptions['cat'] == 'yes' ) {
							$output .= '<div class="portfolio-item-terms">'.$termoutput.'</div>';
						}
						$output .= '</div>';
					}
					$output .= '</div></div></div>';
					break;
			}
		endwhile;
		$output .= '</div>';
		$remaining = $the_query->found_posts-($offset+$the_query->post_count);
		if($remaining > 0) {
			$output .= '<div class="portfolio_pagination '.$portfolio_type.'">';
			$output .= '<a href="#" class="portfolio-loadmore-btn load-more-btn alt-bg alt-bg-text-color shortcode" data-style="'.$portfolio_style.'" data-layout="'.$portfolio_layout.'" data-lightbox="'.$portfolio_lightbox.'" data-title="'.$portfolio_show_title.'" data-cat="'.$portfolio_show_cat.'" data-filter="'.$filter.'" data-category="'.$category.'" data-items="'.$items_per_page.'" data-paged="2">';
			$output .= __('Load More','be-themes');
			$output .= '</a>';
			$output .= '</div>';
		}
		$output .= '</div>';
		wp_reset_postdata();
		wp_reset_query();
		return $output;
	}
}
add_shortcode( 'portfolio' , 'be_portfolio' );

if (!function_exists('be_blog')) {
	function be_blog( $atts ) {
		$output = '';
		$output .= '<div class="blog-posts-wrap clearfix">';
		global $paged;
		$showposts= get_option('posts_per_page');
		$offset = ( ( $showposts * $paged ) - $showposts );
		if($paged == 0)
			$offset=0;
		else
			$offset = ( ( $showposts * $paged ) - $showposts );
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $showposts,
			'offset' => $offset
		);
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) :
				$output .= '<div class="blog-posts blog-masonry" data-total-posts="'.($wp_query->found_posts-$wp_query->post_count).'">';
				if ( $wp_query->have_posts() ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						ob_start();  
						get_template_part( 'loop' );
						$output .= ob_get_clean();
					endwhile;
				endif;
				$output .= '</div>';
				$remaining = $wp_query->found_posts-($offset+$wp_query->post_count);
				if($remaining > 0) :
					$output .= '<div class="portfolio_pagination">';
					$output .= '<a href="#" class="blog-posts-loadmore-btn load-more-btn alt-bg alt-bg-text-color" data-paged="2">'.__('Load More','be-themes').'</a>';
					$output .= '</div>';
				endif;
			else:
				$output .= '<p class="blog-error-msgs">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'be-themes' ).'</p>';
		endif;
		$output .= '</div>';
		return $output;
	}
}
add_shortcode( 'blog' , 'be_blog' );
/**************************************
			SLIDER
**************************************/

if (!function_exists('be_flex_slider')) {
	function be_flex_slider( $atts, $content ) {
		extract( shortcode_atts( array(
	        'animation'=> 'fade',
	        'auto_slide'=> 'no',                //Boolean: Animate slider automatically
			'slide_interval'=> '1000',           //Integer: Set the speed of the slideshow cycling, in milliseconds
	    ), $atts ) );
	    $output = "";
	    $output .= '<div class="be-flex-slider flexslider content-flexslider" data-animation="'.$animation.'" data-auto-slide='.$auto_slide.' data-slide-interval="'.$slide_interval.'"><ul class="slides">';
		$output .= do_shortcode( $content );
	    $output .= '</ul></div>';
	    return $output;
	}
}
add_shortcode( 'flex_slider', 'be_flex_slider' );

if (!function_exists('be_flex_slide')) {
	function be_flex_slide( $atts, $content ) {
			extract( shortcode_atts( array(
				'image'=>'',
				'video'=>'',
				'title'=>'',
				'caption' => '',
				'show_title'=>'no',
	        	'show_caption'=>'no',
	        	'size'=>'full',
	    	), $atts ) );

			$output = '';
	    	$output .= '<li>';
			if( ! empty( $video ) ) {	
				$videoType = be_themes_video_type( $video );
				if( $videoType == "youtube" ) {
					if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $match ) ) {
						$video_id = $match[1];
					}
					$output.='<iframe width="940" height="450" src="http://www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe>';
				}
				elseif( $videoType == "vimeo" ) {
					sscanf( parse_url( $video, PHP_URL_PATH ), '/%d', $video_id );
					$output.='<iframe src="http://player.vimeo.com/video/'.$video_id.'" width="500" height="281" allowFullScreen></iframe>';
				}
			} else {
				if ( !empty( $image ) ) { // check if the post has a Post Thumbnail assigned to it.
					$attachment_info = wp_get_attachment_image_src( $image, 'full' );
					$attachment_url = $attachment_info[0];
					
					$output .=  '<img src="'.$attachment_url.'" alt="" />';
				}
			}
			if($show_title == 'yes') {
				$title = '<h4 class="flex-slide-title alt_bg_color">'.$title.'</h4>';
			}
			if($show_caption == 'yes') {
				$caption = '<p>'.$caption.'</p>';
			}
			if($show_title == 'yes' || $show_caption == 'yes') {
				$output .=  '<div class="flex-caption">'.$title.$caption.'</div>';
			}
	        $output .='</li>';
	        return $output;
	}
}
add_shortcode( 'flex_slide', 'be_flex_slide' );

/**************************************
			CALL TO ACTION
**************************************/	

if (!function_exists('be_call_to_action')) {
	function be_call_to_action( $atts, $content ){
			extract( shortcode_atts( array(
			'new_tab'=> 'no',
			'button_text'=>'Click Here',
			'button_color'=>'#00bfd7',
			'button_link'=>'',
	    ), $atts ) );
		$output = '';
		$style = '';
		$output .= '<div class="call-to-action be-shortcode clearfix" '.$style.'>';
		$output .= '<div class="action-content">';
		$output .= be_themes_formatter( do_shortcode( shortcode_unautop( $content ) ) );
		$output .= '</div>';
		if( ! empty( $button_link ) ) {
			$output .= '<div class="action-button"><a class="mediumbtn be-button gradient rounded" data-hover-color="#000" data-default-color="'.$button_color.'" href="'.$button_link.'" style="background-color:'.$button_color.';" >'.$button_text.'</a></div>';
		}
		$output .= '</div>';
		return $output;	
	}
}
add_shortcode( 'call_to_action', 'be_call_to_action' );

/**************************************
			PROJECT DETAILS
**************************************/

if (!function_exists('be_project_details')) {
	function be_project_details( $atts, $content ) {
		global $post;
		$output = '';
		$post_type = get_post_type();
		if( $post_type != 'portfolio' ) {
			return '';
		} else {
			$client_name = get_post_meta( $post->ID, 'be_themes_portfolio_client_name', true );
			$project_date = get_post_meta( $post->ID, 'be_themes_portfolio_project_date', true );

			$cats = get_the_terms( $post->ID, 'portfolio_categories' );
			$portfolio_cats = array();
			foreach ( $cats as $value ) {
				array_push( $portfolio_cats, $value->name );
			}
			$portfolio_cats = implode( ', ', $portfolio_cats );
			$output .= '<ul class="project_details">';
			if( ! empty( $project_date ) ) {
				$output .= '<li class="project_date"><span>Date:</span> '.$project_date.'</li>';
			}			
			if( ! empty( $client_name ) ) {
				$output .= '<li class="client_name"><span>Client:</span> '.$client_name.'</li>';
			}
			if( ! empty( $portfolio_cats ) ) {
				$output .= '<li class="project_cats"><span>Skills:</span> '.$portfolio_cats.'</li>';
			}						
			$output .='</ul>';	
			return $output;
		}

	}
}
add_shortcode( 'project_details', 'be_project_details' );

/**************************************
			SKILlS
**************************************/

if (!function_exists('be_skills')) {
	function be_skills( $atts, $content ){
		return '<div class="skill_container be-shortcode"><div class="col"><ul class="be-skills">'.do_shortcode($content).'</ul></div></div>';
	}
}
add_shortcode( 'skills', 'be_skills' );

if (!function_exists('be_skill')) {
	function be_skill( $atts, $content ){
		extract(shortcode_atts(array('title'=>'','value'=>''),$atts));
		return '<li class="sec-bg"><span class="expand alt-bg alt-bg-text-color be-skill" data-skill-value="'.$value.'%" style="width:0"><span class="skill_name">'.$title.'</span></span></li>';
	}
}
add_shortcode( 'skill', 'be_skill' );

/**************************************
			RECENT PROJECTS
**************************************/

if (!function_exists('be_recent_projects')) {
	function be_recent_projects( $atts, $content ) {
		extract( shortcode_atts( array(
			'number'=>'three',
	    ), $atts ) );
			
		if($number == 'three') {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}

		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
		);
		$output = '';
		$my_query = new WP_Query( $args );
		if( $my_query->have_posts() ) {
			
			$output .= '<div class="clearfix related-items">';
			while ($my_query->have_posts()) : $my_query->the_post(); 
				$attachment_id = get_post_thumbnail_id( get_the_ID() );
				$attachment_thumb = wp_get_attachment_image_src( $attachment_id, 'portfolio-two' );
				$attachment_full = wp_get_attachment_image_src( $attachment_id, 'full' );
				$attachment_thumb_url = $attachment_thumb[0];
				$attachment_full_url = $attachment_full[0];
				$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
				$mfp_class='mfp-image';
				if( ! empty( $video_url ) ){
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe';
				}
				$post_terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
				$output .= '<div class="one-'.$column.' column-block be-hoverlay">';
					$output .= '<div class="element-inner">';
					$output .= '<a href="'.$attachment_full_url.'" class="thumb-wrap image-popup-vertical-fit '.$mfp_class.'"><img src="'.$attachment_thumb_url.'" alt />';
					$output .= '<div class="thumb-overlay"><div class="thumb-bg">';
					$output .= '<div class="thumb-icons"><i class="font-icon icon-plus"></i></div>';
					$output .= '</div></div>';//end thumb overlay & bg
					$output .= '</a>';//end thumb wrap

					$output .= '<div class="portfolio-title"><h5>';
					if( empty( $permalink ) ) {
						$permalink = '#';
					}
					$output .= '<a href="'.$permalink.'">'.get_the_title().'</a>';
					$output .= '</h5>';
					$output .= '<div class="portfolio-content">'.be_themes_trim_content(get_the_excerpt(),100).'</div>';
					$output .= '<ul class="portfolio-categories clearfix">';
					if( is_array( $post_terms ) ) {
						foreach ( $post_terms as  $term ) {
							$output .= '<li><h6>'.$term->name.'</h6></li>';
						}
					}
					$output .= '</ul>';	
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';//end element inner
			endwhile;
			$output .= '</div>'; // end column block
		}
		wp_reset_query();
		return $output;
	}
}
add_shortcode( 'recent_projects', 'be_recent_projects' );

/**************************************
			RECENT POSTS
**************************************/

if (!function_exists('be_recent_posts')) {
	function be_recent_posts( $atts, $content ) {
		extract( shortcode_atts( array(
			'number'=>'three',
	    ), $atts ) );
			
		if( $number == 'three' ) {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}

		$args=array(
			'post_type' => 'post',
			'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			),
		);
		$output = '';
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			
			$output .= '<div class="clearfix related-items">';
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
				 $output .= '<div class="one-'.$column.' column-block be-hoverlay">';
				// $output .= '<div class="element-inner">';
				ob_start();
				get_template_part( 'content', get_post_format() );
				$post_format_content = ob_get_clean();
				$output .= $post_format_content;
				//$output .= '</div>'; // end element inner
				$output .= '<header class="recent-post-header"><h5 class="recent-post-title">'.get_the_title().'</h5><nav class="post-nav"><h6>'.get_the_date( "F j, Y" ).' / </h6><h6 class="alt-color"><a href="'.get_comments_link().'">'.get_comments_number('0','1','%').__(' comments','be-themes').'</a></h6></nav><hr class="special-sep" /></header>';
				$output .= '<article class="recent-posts-content">'.be_themes_get_excerpt( get_the_ID(), 20 ).'</article>';
				
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();
		return $output;
	}
}
add_shortcode( 'recent_posts', 'be_recent_posts' );

/**************************************
			PRICING TABLE
**************************************/

if (!function_exists('be_pricing_column')) {
	function be_pricing_column( $atts, $content ) {
		global $be_themes_data;
		extract( shortcode_atts( array(
			'title'=>'',
			'h_tag'=>'h3',
			'price'=>'',
			'duration'=>'',
			'currency'=>'$',
			'button_text'=>'',
			'button_color'=>$be_themes_data['color_scheme'],
			'button_link'=>'',
			'highlight'=>'no',
			'style'=>'style-1',
	    ), $atts ) );

	    $output = '';

	    $output .= '<ul class="pricing-table highlight-'.$highlight.'">';
	    if( ! empty( $title ) ) {
	    	if( $style == 'style-1' ) {
	    		$output .='<li class="pricing-title"><'.$h_tag.'>'.$title.'</'.$h_tag.'></li>';
	    	} else {
	    		$output .='<li class="pricing-title alt-bg"><'.$h_tag.' class="alt-bg-text-color">'.$title.'</'.$h_tag.'></li>';
	    	}
	    }
	    if( ! empty( $duration ) ) {
	    	$duration = '/ '.$duration;
	    }
	    if( ! empty( $price ) ) {
	    	$output .='<li class="pricing-price sec-bg sec-color"><span class="currency">'.$currency.'</span><span class="price">'.$price.'</span><span class="pricing-duration">'.$duration.'</span></li>';
	    }	
	    $output .= do_shortcode( $content );

	    if( !empty( $button_text ) && !empty( $button_link ) ) {
	    	$output .= '<li class="pricing-button sec-bg sec-color">'.do_shortcode('[button button_text= "'.$button_text.'" type= "medium" gradient= "1" rounded= "1" icon= "" color= "'.$button_color.'" hover= "#00bfd7" url="'.$button_link.'" ]').'</li>';
	    }
	    $output .= '</ul>';

	    return $output;

	}
}
add_shortcode( 'pricing_column', 'be_pricing_column' );

if (!function_exists('be_pricing_feature')) {
	function be_pricing_feature( $atts, $column ) {
		extract( shortcode_atts( array(
			'feature'=>'',
		), $atts ) );
		$output = '';
		if( ! empty( $feature ) ) {
			$output .='<li class="pricing-feature">'.$feature.'</li>';
		}
		return $output;
	}
}
add_shortcode( 'pricing_feature', 'be_pricing_feature' );

if (!function_exists('be_gmaps')) {
	function be_gmaps( $atts, $content ) {
		extract( shortcode_atts( array(
			'address'=>'',
			'height'=>'300',
			'zoom'=>'20',
			'style'=>'MAP'
		), $atts ) );

		$output = '';
		if( ! empty( $address ) ) {
			$output .= '<div class="gmap-wrapper" style="height:'.$height.'px;"><div class="gmap map_960" data-address="'.$address.'" data-zoom="'.$zoom.'"></div></div>';
		}

		return $output;
	}
}
add_shortcode( 'gmaps', 'be_gmaps' );

if (!function_exists('be_lightbox_image')) {
	function be_lightbox_image( $atts, $content ) {
		extract( shortcode_atts( array(
			'image'=>'',
		), $atts ) );

		$output = '';
		$thumb = wp_get_attachment_image_src( $image, 'one-half' );
		$attachment_thumb_url = $thumb[0];
		$full = wp_get_attachment_image_src( $image, 'full' );
		$attachment_full_url = $full[0];
		$video_url = get_post_meta( $image, 'be_themes_featured_video_url', true );
		$mfp_class='mfp-image';
		$icon = 'picture';
		if( ! empty( $video_url ) ) {
			$attachment_full_url = $video_url;
			$mfp_class = 'mfp-iframe';
			$icon = 'videocam';

		}
		$output .= '<a class="be-lightbox-image thumb-wrap image-popup-vertical-fit '.$mfp_class.'" href="'.$attachment_full_url.'">';
		$output .= '<img src="'.$attachment_thumb_url.'" alt="" />';
		$output .= 		'<div class="portfolio-overlay">';
		$output .= 			'<div class="portfolio-overlay-inner">';
		$output .= 				'<div class="portfolio-overlay-centered">';
		$output .=    				'<h6><i class="font-icon icon-'.$icon.'"></i></h6>';
		$output .= 				'</div>';
		$output .= 			'</div>';
		$output .= 		'</div>';
		$output .= 	'</a>';
		return $output;				
	}
}
add_shortcode('lightbox_image','be_lightbox_image');
/**************************************
			HIGHLIGHT
**************************************/

if (!function_exists('be_highlight')) {
	function be_highlight($atts,$content){
		extract(shortcode_atts(array (
			'color'=>''
		),$atts));
		$background_color="";
		if($color) {
			$background_color = "background-color:".$color;
		}
		return '<span class="highlight" style="'.$background_color.'">'.$content.'</span>';
	}
}
add_shortcode('highlight','be_highlight');

/**************************************
			CLIENTS
**************************************/

if (!function_exists('be_clients')) {
	function be_clients($atts,$content){
		global $be_themes_data;
		extract( shortcode_atts( array(
			'col' => 'five',
			'dir_nav_bg_color' =>'',
			'dir_nav_bg_hover_color' =>'',
		), $atts ) );
		if( $dir_nav_bg_color ) {
			$style = 'style="background-color: '.$dir_nav_bg_color.';"';
		} else {
			$style = 'style="background-color: #2d323e;"';
		}
		if( $dir_nav_bg_color ) {
			$dir_nav_bg_color = 'data-default-bg-color="'.$dir_nav_bg_color.'"';
		} else {
			$dir_nav_bg_color = 'data-default-bg-color="#2d323e"';
		}
		if( $dir_nav_bg_hover_color ) {
			$dir_nav_bg_hover_color = 'data-hover-bg-color="'.$dir_nav_bg_hover_color.'"';
		} else {
			$dir_nav_bg_hover_color = 'data-hover-bg-color="'.$be_themes_data['color_scheme'].'"';
		}
		$rand = rand();
		$output = '<div class="caroufredsel_wrapper clearfix">';
		$output .='<ul class="be-carousel client-carousel" id="be-carousel-'.$rand.'" data-col="'.$col.'">';
		$output .=do_shortcode($content);
		$output .='</ul>';
		$output .='<a id="prev-be-carousel-'.$rand.'" class="prev be-carousel-nav icon-angle-left" href="#" '.$dir_nav_bg_color.' '.$dir_nav_bg_hover_color.' '.$style.'></a><a id="next-be-carousel-'.$rand.'" class="next be-carousel-nav icon-angle-right" href="#" '.$dir_nav_bg_color.' '.$dir_nav_bg_hover_color.' '.$style.'></a>';
		$output .='</div>';
		return $output;
	}
}
add_shortcode('clients','be_clients');

if (!function_exists('be_client')) {
	function be_client( $atts, $content ) {
		extract( shortcode_atts( array(
			'image'=>'',
			'link' =>'',
			'dir_nav_hover_color' =>'',
			'dir_nav_active_color' =>'',
			'new_tab'=> 'yes',
	    ), $atts ) );

	    $output =  '';
	    $attachment = wp_get_attachment_image_src( $image, 'portfolio-four' );
	    $url = $attachment[0];
	    if( $url ) {
	    	$output .='<li class="carousel-item"><a href="'.$link.'"><img src="'.$url.'" alt="" /></a></li>';
	    }
	    return $output;
	}
}
add_shortcode( 'client', 'be_client' );

if ( ! function_exists( 'be_portfolio_carousel' ) ) {
	function be_portfolio_carousel( $atts ) {
		extract( shortcode_atts( array (
			'col'=>'five',
	        'category'=> '',
	        'items_per_page'=> '-1',
			'dir_nav_bg_color' =>'',
			'dir_nav_bg_hover_color' =>'',
	        'portfolio_lightbox'=> 'no',
	        'portfolio_show_title'=> 0,
	        'portfolio_show_cat'=> 0,
	    ) , $atts ) );
		global $be_themes_data;
		$pageoptions = array();
		if($portfolio_lightbox == 'yes') {
			$pageoptions['lightbox'] = 'lightbox';
		} else {
			$pageoptions['lightbox'] = 'no-lightbox';
		}
		if($portfolio_show_title) {
			$pageoptions['title'] = 'yes';
		} else {
			$pageoptions['title'] = 'no';
		}
		if($portfolio_show_cat) {
			$pageoptions['cat'] = 'yes';
		} else {
			$pageoptions['cat'] = 'no';
		}
		if( $dir_nav_bg_color ) {
			$style = 'style="background-color: '.$dir_nav_bg_color.';"';
		} else {
			$style = 'style="background-color: #2d323e;"';
		}
		if( $dir_nav_bg_color ) {
			$dir_nav_bg_color = 'data-default-bg-color="'.$dir_nav_bg_color.'"';
		} else {
			$dir_nav_bg_color = 'data-default-bg-color="#2d323e"';
		}
		if( $dir_nav_bg_hover_color ) {
			$dir_nav_bg_hover_color = 'data-hover-bg-color="'.$dir_nav_bg_hover_color.'"';
		} else {
			$dir_nav_bg_hover_color = 'data-hover-bg-color="'.$be_themes_data['color_scheme'].'"';
		}
		$output = '';
		$category = explode(',', $category);
		$rand = rand();
		$output .= '<div class="carousel-wrap portfolios-carousel"><div class="caroufredsel_wrapper clearfix"><ul id="be-carousel-'.$rand.'" class="be-carousel portfolios-carousel" data-col="'.$col.'">';
		if(empty($items_per_page)) {
			$items_per_page = -1;
		}
		if( empty( $category[0] ) ) {
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'orderby'=> 'date',
			);
		} else {
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $items_per_page,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'slug',
						'terms' => $category,
						'operator' => 'IN',
					)
				),
				'orderby'=> 'date',
			);	
		}
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
			$portfolio_category = "";
			foreach ($terms as $term) {
				$portfolio_category .= $term->slug." ";
			}
			$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
			$length = 1;
			if($terms) {
				$termoutput = '';
				foreach ($terms as $term) {
					$termoutput .= '<span>'.$term->name.'</span>';
					if(count($terms) != $length) {
						$termoutput .= ' | ';
					}
					$length++;
				}
			}
			$attachment_id = get_post_thumbnail_id(get_the_ID());
			$attachment_images_src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'portfolio-two' );
			$attachment_url = $attachment_images_src[0]; 
			$attachment_full = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$attachment_full_url = $attachment_full[0];
			$video_url = get_post_meta( $attachment_id, 'be_themes_featured_video_url', true );
			$permalink = '';
			if($pageoptions['lightbox'] == 'lightbox') {
				$mfp_class='mfp-image image-popup-vertical-fit';
				if( ! empty( $video_url ) ) {
					$attachment_full_url = $video_url;
					$mfp_class = 'mfp-iframe image-popup-vertical-fit';
				}
				$link = $attachment_full_url;
				$target = '';
			} else {
				$mfp_class = 'no-lightbox';
				$project_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_visitsite_url', true );
				if(get_post_meta( get_the_ID(), 'be_themes_portfolio_item_link_to_project_url', true ) && !empty($project_url)) {
					$link = $project_url;
					$target = 'target="_blank"';
				} else {
					$link = get_permalink();
					$target = '';
				}
			}
			$overlay_color = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_color', true );
			if($overlay_color) {
				$overlay_color = 'background: '.$overlay_color.';';
			} else {
				$overlay_color = '';
			}
			$overlay_opacity = get_post_meta( get_the_ID(), 'be_themes_portfolio_overlay_opacity', true );
			if($overlay_opacity) {
				$overlay_opacity = 'opacity: '.(intval($overlay_opacity)/100).';filter: alpha(opacity='.(intval($overlay_opacity)/100).');';
			} else {
				$overlay_opacity = '';
			}
			$output .='<li class="carousel-item portfolio-item">';
			$output .= '<a href="'.$link.'" class="portfolio-centered2-item-wrap '.$mfp_class.'" '.$target.'>';
			$output .= '<img src="'.$attachment_url.'" alt="" />';
			$output .= '<div class="portfolio-overlay" style="background-color:'.$overlay_color.';"><div class="portfolio-overlay-inner"><div class="portfolio-overlay-centered">';
			if( $pageoptions['title'] == 'yes' || $pageoptions['cat'] == 'yes' ) {
				if( $pageoptions['title'] == 'yes' ) {
					$output .= '<h6 class="fadeInLeft animated">'.get_the_title().'</h6>';
				}
				if( $pageoptions['title'] == 'yes' && $pageoptions['cat'] == 'yes' ) {
					$output .= '<div><div class="portfolio-overlay-sep"></div></div>';
				}
				if( $pageoptions['cat'] == 'yes' ) {
					$output .= '<div class="portfolio-item-terms fadeInRight animated">'.$termoutput.'</div>';
				}
			} else {
				$output .= '<i class="font-icon portfolio-ovelay-icon rollIn animated"></i>';
			}
			$output .= '</div></div></div></a>';
			$output .= '</li>';
		endwhile;
		wp_reset_postdata();
		$output .='</ul>';
		$output .='<a id="prev-be-carousel-'.$rand.'" class="prev be-carousel-nav icon-angle-left" href="#" '.$dir_nav_bg_color.' '.$dir_nav_bg_hover_color.' '.$style.'></a><a id="next-be-carousel-'.$rand.'" class="next be-carousel-nav icon-angle-right" href="#" '.$dir_nav_bg_color.' '.$dir_nav_bg_hover_color.' '.$style.'></a>';
		$output .='</div></div>';
		return $output;
	}
	add_shortcode( 'portfolio_carousel' , 'be_portfolio_carousel' );
}
?>