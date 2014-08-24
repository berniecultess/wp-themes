<?php
global $pageoptions;
$attachment_images_src=wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
$attachment_url = $attachment_images_src[0];
$attachment_width = $attachment_images_src[1];
$attachment_height = $attachment_images_src[2];
$project_url = get_post_meta( get_the_ID(), 'be_themes_portfolio_visitsite_url', true );
if(get_post_meta( get_the_ID(), 'be_themes_portfolio_item_link_to_project_url', true ) && !empty($project_url)) {
	$link = $project_url;
	$class = 'dJAX_external';
} else {
	$link = get_permalink();
	$class = '';
} ?>
<div data-href="<?php echo $link; ?>" class="hentry portfolio-item vertical background-streach style1_placehloder placeholder clickable load show-title <?php echo $class; ?>" data-source="<?php echo $attachment_url; ?>">
	<img src="" style="opacity: 0; display: block;" />
	<div class="portfolio-item-overlay"></div>
	<?php
		if(get_post_meta(get_the_ID(),'be_themes_portfolio_item_show_title',true)) {
			$pageoptions['single_title'] = 'yes';
		} else {
			$pageoptions['single_title'] = 'no';
		}
		if(get_post_meta(get_the_ID(),'be_themes_portfolio_item_show_cat',true)) {
			$pageoptions['single_cat'] = 'yes';
		} else {
			$pageoptions['single_cat'] = 'no';
		}
		if(($pageoptions['title'] == 'yes' || $pageoptions['cat'] == 'yes' ) && ($pageoptions['single_title'] == 'yes' || $pageoptions['single_cat'] == 'yes')) { ?>
			<div class="portfolio-item-title animated <?php echo $pageoptions['animation']; ?>">
				<?php
					if($pageoptions['title'] == 'yes' && $pageoptions['single_title'] == 'yes' ) {
						$item_title = get_the_title();
						if( ! empty($item_title)) { ?>
							<h4 class="portfolio-item-heading"><?php echo $item_title; ?></h4><br /> <?php 
						}
					}
					if($pageoptions['cat'] == 'yes' && $pageoptions['single_cat'] == 'yes' ) {
						$terms = be_themes_get_taxonomies_by_id(get_the_ID(), 'portfolio_categories');
						if( !empty($terms)) { ?>	
							<div class="portfolio-item-cats">	
								<?php
									
									$length = 1;
									foreach ($terms as $term) {
										echo '<span>'.$term->name.'</span>';
										if(count($terms) != $length) {
											echo '<span>  |  </span>';
										}
										$length++;
									}
								?>
							</div> <?php
						}
					} ?>
			</div> <?php
		} 
	?>
</div>