<?php
/*
 *  The template for displaying a Blog Post.
 * 
 *
*/
?>
<?php get_header(); 
global $be_themes_data;
if($be_themes_data['blog_layout'] == 'traditional') {
	$blog_type = 'blog-traditional';
} else {
	$blog_type = 'blog-masonry';
}
while ( have_posts() ) : the_post();
?>
	<?php
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		if( $thumb_id != false && !empty($thumb_id) && get_post_format() != 'image' && get_post_format() != 'gallery' ) {
			echo '<div class="single-featured-image">';
			echo do_shortcode('[section bg_image="'.$thumb_id.'" bg_position="center center" bg_stretch="1" padding_top="200" padding_bottom="200"]');
			echo '</div>';
		}
	?>
	<section id="content" class="<?php echo $blog_type; ?>-wrap">
		<div class="clearfix be-wrap <?php echo ($blog_type == 'blog-traditional') ? 'be-row be-wrap' : 'no-sidebar-page'; ?>">
			<?php 
				if($be_themes_data['blog_layout'] == 'traditional' && (get_post_format() != 'quote')) {
					echo '<div class="clearfix">';
						get_template_part( 'loop-traditional' );
					echo '</div>';
				}
			?>
		</div>
		<div class="clearfix be-wrap <?php echo ($blog_type == 'blog-traditional') ? 'be-row be-wrap' : 'no-sidebar-page'; ?>">
			<div id="content-wrap" class="clearfix <?php echo ($blog_type == 'blog-traditional') ? 'two-third column-block' : ''; ?>">
				<section id="page-content">
					<div clearfix">
						<?php 
							if($be_themes_data['blog_layout'] == 'traditional' && (get_post_format() != 'quote')) {
								echo '<div class="'.implode(' ',get_post_class('blog-post')).'">';
								echo '<div class="blog-post-content sec-color">';
								echo apply_filters('the_content',get_the_content());
								$args = array (
									'before'           => '<div class="pages_list margin-40">',
									'after'            => '</div>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'next',
									'nextpagelink'     => __('Next >','be-themes'),
									'previouspagelink' => __('< Prev','be-themes'),
									'pagelink'         => '%',
									'echo'             => 0 
								);
								echo wp_link_pages( $args );
								echo '</div></div>';
							} else {
								get_template_part( 'loop' ); 
							}
						?>
					</div> <!--  End Loop -->
					<div class="be-themes-comments">
						<?php comments_template( '', true ); ?>
					</div> <!--  End Optional Page Comments -->				
				</section> <!--  End Page Content -->
			</div> <!--  End Content Wrap -->
			<?php if($blog_type == 'blog-traditional') { ?>
				<div class="one-third column-block">
					<?php get_sidebar(); ?>
				</div>	
			<?php } ?>
		</div>
	</section> <!--  End Content -->					
<?php 
endwhile;
get_footer(); 
?>