<?php
	global $wp_query;
	global $woocommerce;
	$page_id = $wp_query->get_queried_object_id();
	global $be_themes_data; 
?>
			
		</div>  <!-- End Ajaxable -->
	</div>  <!-- End Main -->
	<?php if( !empty( $be_themes_data['header_layout'] ) && 'top-header' == $be_themes_data['header_layout'] ): ?>
	<?php $disable_back_to_top = ( !empty( $be_themes_data['back_to_top']) && ( 1 == $be_themes_data['back_to_top'] )) ? "class = hide-icon" : ""; ?>
	<footer id="footer">
		<div id="footer-wrap" class="clearfix">
			<div id="footer-copyright" class="clearfix">
				<div class="left"><?php echo $be_themes_data['copyright_text']; ?></div>
			</div>
			<div id="footer-social"><?php be_themes_social_icons(); ?></div>
		</div>
		<a href="#" id="back-top" <?php echo $disable_back_to_top; ?> ><i class="icon-angle-up"></i></a>
	</footer>
	<?php endif; ?>
        <script>
            var _gaq=[['_setAccount','<?php echo $be_themes_data['google_analytics_code'];  ?>'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
		<!-- Option Panel Custom JavaScript -->
		<script>
			jQuery(document).ready(function(){
				<?php echo stripslashes_deep(htmlspecialchars_decode($be_themes_data['custom_js'],ENT_QUOTES));  ?>
			});
		</script>
		<input type="hidden" id="ajax_url" value="<?php echo admin_url( 'admin-ajax.php' ); ?>" />

		<div class="page-loader">
			<?php 
				if(empty($be_themes_data['disable_loader']) || !($be_themes_data['disable_loader'])) {
					if(!empty($be_themes_data['custom_loader'])) {
						echo '<div class="be-custom-loader"><img src="'.$be_themes_data['custom_loader'].'" alt="" /></div>';
					} else {
						echo '<ul class="be-loader"><li></li><li></li><li></li><li></li></ul>';
					}
				}
			?>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>