<?php
/**
 * The Sidebar containing the main (right) widget area.
 *
 * @package WordPress
 * 
 * 
 */  ?>
<?php
	$sidebar_class = ''; 
	if( is_single() && has_post_thumbnail() ) {
		$sidebar_class = 'single-featured';
	}	
?> 
<div class="sidebar-widgets-wrap <?php echo $sidebar_class; ?> clearfix">
	<?php
		global $wp_registered_sidebars;
		$sidebar_array = array();
		foreach ( $wp_registered_sidebars as $key => $value ) {
			$sidebar_array[] = $key;
		}
		if( is_single() || is_page()) {
			$right_sidebar = get_post_meta(get_the_ID(),'be_themes_header_sidebar',true);
		}
		if( empty( $right_sidebar ) || !in_array( $right_sidebar, $sidebar_array ) ) {
			$right_sidebar = 'header-sidebar';
		}
		if ( function_exists('is_woocommerce') && is_woocommerce() ) {
			$right_sidebar = get_post_meta(get_option('woocommerce_shop_page_id'),'be_themes_header_sidebar',true);
		}
		if (is_active_sidebar( $right_sidebar ) ) {
			dynamic_sidebar( $right_sidebar );
		}
	?>
</div> <!--  End Sidebar Widgets Wrap -->