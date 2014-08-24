<?php
/*
 * Ajax Request handler
 */

/* ---------------------------------------------  */
// Function for processing contact form submission
/* ---------------------------------------------  */

add_action( 'wp_ajax_nopriv_contact_authentication', 'be_themes_contact_authentication' );
add_action( 'wp_ajax_contact_authentication', 'be_themes_contact_authentication' );
add_action( 'wp_ajax_nopriv_ajax_portfolio', 'be_themes_ajax_portfolio' );
add_action( 'wp_ajax_ajax_portfolio', 'be_themes_ajax_portfolio' );
add_action( 'wp_ajax_nopriv_get_blog', 'be_themes_get_blog' );
add_action( 'wp_ajax_get_blog', 'be_themes_get_blog' );
	
function be_themes_contact_authentication() {
	global $be_themes_data;
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$contact_subject = $_POST['contact_subject'];
	if(empty($contact_name) || empty($contact_email) || empty($contact_comment) || empty($contact_subject) ) {
		$result['status'] = "error";
		$result['data'] = __('All fields are required','be-themes');
	}
	else if(!preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $contact_email)) {
		$result['status']="error";
		$result['data']=__('Please enter a valid email address','be-themes');
	}
	else if(!empty($contact_name) && !empty($contact_email) && !empty($contact_comment) && !empty($contact_subject) ) {
		if ( !empty( $be_themes_data['contact_form_mail'] ) ) {
			$to = $be_themes_data['contact_form_mail'];
		} else {
			$to = get_option('admin_email');
		}
		$subject = $contact_subject;
		$from = $contact_email;
		$headers = "From:" . $from;
		mail($to,$subject,$contact_comment,$headers);
		$result['status'] = "sucess";
		$result['data'] =__('Your message was sent sucessfully','be-themes');
	}
	header('Content-type: application/json');
	echo json_encode($result);
	die();
}

######### Portfolio Template ##########
function be_themes_ajax_portfolio() {
	extract($_POST);
	$output = '';
	$pageoptions = array();
	$showposts = $items_per_page;
	if($filter == "tag") {
		$filteres_to_use='portfolio_tags';
	}
	else {
		$filteres_to_use='portfolio_categories';
	}
	$selected_categorey = explode(",", $category);
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
	else {
		$args = array (
			'post_type' => 'portfolio',
			'posts_per_page' => $showposts,
			'offset' => $offset
		);
	}
	$the_query = new WP_Query( $args );
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
				$output .= '<div class="portfolio-overlay"><div class="portfolio-overlay-inner"><div class="portfolio-overlay-centered">';
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
				$output .= '<div class="portfolio-overlay"><div class="portfolio-overlay-inner"><div class="portfolio-overlay-centered">';
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
				$output .= '<div class="portfolio-item-bottom-details clearfix">';
				$output .= '<h3 class="portfolio-item-title"><a href="'.$link.'" '.$target.'>'.get_the_title().'</a></h3>';
				$output .= '<div class="portfolio-item-terms">';
				$output .= $termoutput;
				$output .= '</div></div></div></div></div>';
				break;
		}
	endwhile;
	echo $output;
	wp_reset_postdata();
	die();
}
######### BLOG ##########
function be_themes_get_blog() {
	extract($_POST);
	$args = array (
		'paged' => $paged,
		'post_status'=>'publish',
		'ignore_sticky_posts'=>true
	);
	if(!(is_category() || is_archive() || is_tag() || is_search())) {
		query_posts($args);
	}
	if( have_posts() ) :
		while (have_posts() ) : the_post();
			get_template_part( 'loop' );
		endwhile;
	endif;
	}
?>