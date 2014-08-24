<?php
/**
* The template for displaying Category Archive pages.
* 
*/
?>
<?php 
	get_header();
	global $be_themes_data;
	if($be_themes_data['blog_layout'] == 'traditional') {
		$blog_type = 'blog-traditional';
	} else {
		$blog_type = 'blog-masonry';
	}
?>

<section id="content" class="<?php echo $blog_type; ?>-wrap">
	<div class="archive-page-heading <?php echo ($blog_type == 'blog-traditional') ? 'be-wrap' : ''; ?>">
		<h2 class=""><?php get_template_part('page','title'); ?></h2>
		<hr class="separator style-1 blog-title-sep" />
	</div>
	<div class="clearfix <?php echo ($blog_type == 'blog-traditional') ? 'be-row be-wrap' : ''; ?>">
		<div class="blog-posts-wrap clearfix <?php echo ($blog_type == 'blog-traditional') ? 'two-third column-block' : ''; ?>">
			<?php	
				global $wp_query;
				global $paged;
				$showposts= get_option('posts_per_page');
				if($paged == 0) {
					$offset=0;
				} else {
					$offset = ( ( $showposts * $paged ) - $showposts );
				}
				if( have_posts() ) : 
					echo '<div class="clearfix blog-posts '.$blog_type.'">';
					while ( have_posts() ) : the_post();
						if($be_themes_data['blog_layout'] == 'traditional') {
							get_template_part( 'loop-traditional' ); 
						} else {
							get_template_part( 'loop' ); 
						}
					endwhile;
					echo '</div>'; // End Blog Posts
					
					$remaining = $wp_query->found_posts-($offset+$wp_query->post_count);
					if($remaining > 0 && $blog_type != 'blog-traditional') {
						echo '<div class="portfolio_pagination">';
						echo '<a href="#" class="blog-posts-loadmore-btn load-more-btn alt-bg alt-bg-text-color" data-paged="2">'.__('Load More','be-themes').'</a>';
						echo '</div>'; // End Pagination
					} else {
						be_themes_pagination();
					}
				else:
					echo '<p class="blog-error-msgs">'.__( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'be-themes' ).'</p>';
				endif;
			?>
		</div> <!--  End Blog Posts Wrap -->
		<?php if($blog_type == 'blog-traditional') { ?>
			<div class="one-third column-block">
				<?php get_sidebar(); ?>
			</div>	
		<?php } ?>
	</div>
</section>	<!--  End Content -->				
<?php get_footer(); ?>