<?php get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="grid">		
					<?php the_content(); ?>
				</div>        
			</article>
		
	<?php endwhile; ?>
		
<?php get_footer(); ?>

