<?php
/*
* Template Name: Portfolio
*/
get_header(); 
global $be_themes_data;
?>
<section id="content">
	<div class="portfolio-wrap">
		<?php
		    $portfolio_type = 'vertical';
			$showposts = get_post_meta(get_the_ID(),'be_themes_portfolio_show_posts',true);
			if(!$showposts) {
				$showposts = -1;
			}
			global $pageoptions;
			$pageoptions = array();
			if(get_post_meta(get_the_ID(),'be_themes_portfolio_show_title',true)) {
				$pageoptions['title'] = 'yes';
			} else {
				$pageoptions['title'] = 'no';
			}
			if(get_post_meta(get_the_ID(),'be_themes_portfolio_show_cat',true)) {
				$pageoptions['cat'] = 'yes';
			} else {
				$pageoptions['cat'] = 'no';
			}
			if(get_post_meta(get_the_ID(),'be_themes_title_cat_animation',true)) {
				$pageoptions['animation'] = get_post_meta(get_the_ID(),'be_themes_title_cat_animation',true);
			} else {
				$pageoptions['animation'] = 'None';
			}
			$selected_categorey=get_post_meta(get_the_ID(), 'be_themes_portfolio_category', 'true');
			if($selected_categorey) {
					$args = array (
						'post_type' => 'portfolio',
						'tax_query' => array(
							array (
								'taxonomy' => 'portfolio_categories',
								'field' => 'slug',
								'terms' => explode(",", implode(',', $selected_categorey)),
								'operator' => 'IN'
							)
						),
						'posts_per_page' => $showposts,
					);
			}
			else {
					$args = array (
						'post_type' => 'portfolio',
						'posts_per_page' => $showposts,
					);
			}
			$the_query = new WP_Query( $args );
		 ?>
		<div id="gallery-container-wrap" <?php echo ($portfolio_type == 'horizontal') ? 'class="horizontal-slide"' : 'class="clearfix"'; ?>>
			<div id="gallery-container" class="portfolio portfolio-<?php echo $portfolio_type; ?> clearfix" data-total-posts="<?php echo ($the_query->found_posts-$the_query->post_count); ?>"> 
				<?php
				while ( $the_query->have_posts() ) : $the_query->the_post();
					get_template_part( 'portfolio/'.$portfolio_type, 'portfolio' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>	<!-- End Portfolio Container -->
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
							while ( $the_query->have_posts() ) : $the_query->the_post();
								echo '<li><a href="#" class="gallery-thumb" data-target="'.$count.'">'.wp_get_attachment_image( get_post_thumbnail_id(get_the_ID()), 'carousel-thumb' ).'</a></li>';
								$count++;
							endwhile;
							wp_reset_postdata();
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	<!-- End Portfolio Container Wrap -->
</section>	<!--  End Content -->	
<?php get_attachment_id_from_src('http://www.brandexponents.com/wynn-export/wp-content/uploads/2013/08/tumblr_n10n1wmxiS1st5lhmo1_1280-480x285.jpg'); ?>			
<?php get_footer(); ?>