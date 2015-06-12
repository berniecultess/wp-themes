<?php
$attachment_images_src=wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
$attachment_url = $attachment_images_src[0]; ?>
<div href="<?php echo get_permalink(); ?>" class="hentry portfolio-item horizontal background-streach placeholder clickable load" source="<?php echo $attachment_url; ?>">
	<div class="portfolio-item-overlay"></div>
	<h3 class="portfolio-item-title"><?php echo get_the_title(); ?>	
	</h3>
</div>