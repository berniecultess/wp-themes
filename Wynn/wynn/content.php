<?php 
if( has_post_thumbnail() ) : 
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'blog-image' );
    $thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );    
	$url = $thumb['0'];
	$attachment_full_url = $thumb_full[0];
endif;	
if( !empty( $url ) ) : ?>
<div class="post-thumb">	
	<div class="element-inner">        	
		<a href="<?php echo $attachment_full_url; ?>" class="image-popup-vertical-fit mfp-image thumb-wrap">
			<img src="<?php echo $url; ?>" alt="<?php echo get_the_title( get_the_ID() ); ?>" />
			<div class="thumb-overlay"><div class="thumb-bg">
				<div class="thumb-icons">
					<i class="font-icon icon-plus"></i></div>
				</div>
			</div>
		</a>
	</div>			
</div> <!--  End Post Thumb -->
<?php endif; ?>