<?php
/*
 *
 * Template Name: Contact
 *
*/
?>
<?php 
get_header(); 
global $be_themes_data;
while( have_posts() ): the_post(); 
?>
<section class="be-section map-section">
	<div class="gmap map_960" id="contact-page-map" data-address="<?php echo $be_themes_data['address']; ?>" data-zoom="14"></div> <!--  End Map -->
</section>
<section id="content" class="no-sidebar-page">
	<div id="content-wrap">

		<section id="page-content">
			<div class="be-row be-wrap clearfix">
				<div class="two-third column-block">
					<div class="contact_form">
						<h4 class="special-h-tag"><?php _e('Contact Us','be-themes'); ?></h4>
						<form method="post" class="contact">
							
							<fieldset class="contact_fieldset">
								<label class="contact_form_label"><?php _e('Your Name:*','be-themes'); ?></label>
								<input type="text" name="contact_name" class="txt autoclear" />
							</fieldset>
							<fieldset class="contact_fieldset">
								<label class="contact_form_label"><?php _e('Your Email:*','be-themes'); ?></label>
								<input type="text" name="contact_email" class="txt autoclear" />
							</fieldset>
							<fieldset class="contact_fieldset">
								<label class="contact_form_label"><?php _e('Subject:','be-themes'); ?></label>
								<input type="text" name="contact_subject" class="txt autoclear" />
							</fieldset>
							
							<fieldset class="contact_fieldset">
								<label class="contact_form_label"><?php _e('Your Message:*','be-themes'); ?></label>
								<textarea name="contact_comment" class="txt_area autoclear"></textarea>
							</fieldset>
							<fieldset class="contact_fieldset submit-fieldset">
								<input type="submit" name="contact_submit" value="<?php _e('Submit','be-themes'); ?>" class="contact_submit title_headings"/>
								<div class="contact_loader"></div>
							</fieldset>
							<div class="contact_status"></div>
						</form>
					</div>  <!-- End Contact Form -->
				</div>
				<div class="one-third column-block">	
					<?php the_content(); ?>
				</div> <!--  End Page Content -->
			</div>		
		</section> <!--  End Content -->

	</div>
</section>					 
<?php endwhile; ?>
<?php get_footer(); ?>