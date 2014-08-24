<section id="content" class="no-sidebar-page">
	<div id="content-wrap">
		<section id="page-content">
			<div class="clearfix">
			<?php 
				global $be_themes_data;
				$is_show_title = get_post_meta( get_the_ID(), 'be_themes_show_project_title', true );
				if( $is_show_title != 'no' ):
			?>
				<div class="be-section clearfix single-portfolio-title">
					<div class="be-row be-wrap clearfix">
						<div class="two-third column-block">
							<h2 class="single-portfolio-heading"><?php the_title(); ?></h2>
						</div>
						<div class="one-third column-block project_navigation">
							<?php next_post_link('%link', '<i class="font-icon icon-angle-left"></i>' );
							if( !empty( $be_themes_data['back_to_portfolio']) ) {
								echo '<a href="'.$be_themes_data['back_to_portfolio'].'"><i class="font-icon icon-th"></i></a>';
							}					 
							previous_post_link('%link','<i class="font-icon icon-angle-right"></i>'); ?>
						</div>	
					</div>
					<hr class="separator style-1 be-wrap" />
				</div>
			<?php endif; ?>
				<?php the_content(); ?>	

				<div class="be-wrap">	
					<hr class="separator style-1" />
					<?php be_themes_related_projects(get_the_ID()); ?>
				</div>
			</div> <!--  End Page Content -->
		</section>
	</div>
</section>