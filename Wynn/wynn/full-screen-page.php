<?php
/*
 *
 * Template Name: Full Screen Page 
 *
*/
?>
<?php get_header(); 

global $be_themes_data; 

while(have_posts()): the_post(); 
	$be_pb_class = 'page-builder';
	$be_pb_disabled = get_post_meta( $post->ID, '_be_pb_disable', true );
	if( true === $be_pb_disabled || 'yes' == $be_pb_disabled || !isset( $be_themes_data['enable_pb'] ) || 0 == $be_themes_data['enable_pb'] ) {
		$be_pb_class = 'be-wrap no-page-builder';
	}
?>

			<section id="content" class="no-sidebar-page">
				<div id="content-wrap" class="<?php echo $be_pb_class; ?>">
					<?php 
						if(  true === $be_pb_disabled || 'yes' == $be_pb_disabled || !isset( $be_themes_data['enable_pb'] ) || 0 == $be_themes_data['enable_pb'] ) :
					?>
						<h1 id="no-pb-title"><?php get_template_part('page','title'); ?></h1>
						<hr class="separator style-1" />
					<?php
						endif;
					?>
					<section id="page-content">
						<div>	
							<?php the_content(); ?>
						</div> 

						<?php if( isset($be_themes_data['comments_on_page']) && $be_themes_data['comments_on_page'] == 1 ) : ?>

						<div class="be-themes-comments be-row be-wrap">
							<?php comments_template( '', true ); ?>
						</div> <!--  End Optional Page Comments -->

						<?php endif; ?>

					</section> <!--  End Page Content -->

				</div> <!--  End Content Wrap -->
			</section> <!--  End Content -->				 
<?php endwhile; ?>
<?php get_footer(); ?>