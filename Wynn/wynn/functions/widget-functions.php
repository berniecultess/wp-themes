<?php
/********************************************
			REGISTER WIDGET AREA
*********************************************/
add_action( 'widgets_init', 'be_themes_widgets_init' );
if (!function_exists('be_themes_widgets_init')) {
	function be_themes_widgets_init() {
		global $be_themes_data;
		if($be_themes_data['blog_layout'] == 'traditional') {
			$animate = 'no-animate';
			$color = '';
		} else {
			$animate = 'animate';
			$color = 'alt-bg-text-color';
		}
		register_sidebar(
			array (
			   'name' => __( 'Default Header Sidebar', 'paws' ),
			   'id'   => 'header-sidebar',
			   'description'   => __( 'Widget area of Right Sidebar template pages', 'be-themes' ),
			   'before_widget' => '<div class="%2$s widget '.$animate.'">', 
			   'after_widget'  => '</div></div></div>',
			   'before_title'  => '<h6 class="widget-title '.$color.'">',
			   'after_title'   => '</h6><div class="widget-content sec-bg sec-color"><div class="widget-pad">',
			)
		);
		if(  !empty($be_themes_data['custom_sidebars']) && sizeof( $be_themes_data['custom_sidebars'] ) > 0 ) {
			foreach( $be_themes_data['custom_sidebars'] as $sidebar ) {
				register_sidebar( 
					array (
						'name' => __( $sidebar, 'be-themes' ),
						'id' => generateSlug( $sidebar, 45 ),
						'description'   => '',
						'before_widget' => '<div class="%2$s widget '.$animate.'">', 
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title '.$color.'">',
						'after_title'   => '</h6><div class="widget-content sec-bg sec-color"><div class="widget-pad">',
					) 
				);
			}
		}
	}
}
if (!function_exists('widget_empty_title')) {
	function widget_empty_title($output='', $instance, $id) {
		if($id == 'shopping_cart') {
			global $woocommerce;
			if ($output == '') {
				return '<span class="widget-icon icon-list"></span><a class="cart-contents cart-content-count" href="'.$woocommerce->cart->get_cart_url().'" title="'.__('View your shopping cart', 'woothemes').'">'.$woocommerce->cart->cart_contents_count.'</a>';
			} else {
				return '<span class="widget-icon icon-list"></span><span class="widget-title-text with-icon">'.$output.'</span><a class="cart-contents cart-content-count" href="'.$woocommerce->cart->get_cart_url().'" title="'.__('View your shopping cart', 'woothemes').'">'.$woocommerce->cart->cart_contents_count.'</a>';
			}
		}
		else {
			if ($output == '') {
				return '<span class="widget-icon icon-list no-title"></span>';
			} else {
				if( $id == 'categories'  || $id == 'archives' || $id == 'tag_cloud' || $id == 'recent-posts' || $id == 'search' || $id == 'calendar' ) {
					return '<span class="widget-icon icon-list"></span><span class="widget-title-text with-icon">'.$output.'</span>';
				} else {
					return '<span class="widget-title-text no-icon">'.$output.'</span>';
				}
			}
		}
	}
}
add_filter('widget_title', 'widget_empty_title', 10, 3);
/********************************************
			INCLUDE WIDGET FUNCTIONS
*********************************************/
require_once( get_template_directory() .'/functions/widgets/recent_post_widget.php' );
?>