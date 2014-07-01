<?php 

if( class_exists('Woocommerce') ) {
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}

	add_action( 'wp_print_scripts', 'be_woo_deregister_javascript', 100 );
	function be_woo_deregister_javascript() {
		//wp_deregister_script( 'prettyPhoto' );
		//wp_deregister_script( 'prettyPhoto-init' );
		wp_deregister_style( 'woocommerce_prettyPhoto_css' );
		wp_enqueue_script( 'wc-single-product' );
		
	}

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

	add_action('woocommerce_before_main_content', 'be_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'be_wrapper_end', 10);
	add_action('woocommerce_before_shop_loop_item', 'be_woo_before_loop_item', 10);
	add_action('woocommerce_after_shop_loop_item', 'be_woo_after_loop_item', 10);
	add_action('woocommerce_before_shop_loop_item_title', 'be_woo_before_loop_item_title', 10);
	add_action('woocommerce_after_shop_loop_item_title', 'be_woo_after_loop_item_title', 10);
	add_action('woocommerce_before_shop_loop_item_title', 'be_woo_thumbnail_before', 9);
	add_action('woocommerce_product_add_to_cart_text', 'be_woo_add_to_cart_text', 10);
	add_action('woocommerce_before_single_product', 'be_woo_before_single_product', 9);
	add_action('woocommerce_after_single_product', 'be_woo_after_single_product', 10);
	add_action('woocommerce_before_single_product_summary', 'be_woo_before_single_product_summary', 21);
	add_action('woocommerce_after_single_product_summary', 'be_woo_after_single_product_summary', 19);
	add_action('woocommerce_before_shop_loop', 'be_woo_before_shop_loop', 30);
	add_action('woocommerce_after_shop_loop', 'be_woo_after_shop_loop', 10);
	add_action('woocommerce_single_product_summary', 'be_woo_single_product_summary','11');


	function be_wrapper_start() {
		$shop_page_query = new WP_Query( array('page_id' => get_option('woocommerce_shop_page_id')));
	    while ( $shop_page_query->have_posts() ) : $shop_page_query->the_post();
	    	if( is_shop()) {
	       		the_content();
	       	}
	    endwhile;
	    wp_reset_query();
		echo '<section id="content" class=""><div class="portfolio-wrap">';
	}
	function be_wrapper_end() {
		echo '</div></section>';
	}
	function be_woo_before_loop_item() {
		echo '<div class="product-inner-wrap">';
	}
	function be_woo_after_loop_item() {
		echo '</div>';
	}
	function be_woo_before_loop_item_title() {
		echo '<div class="product-image-overlay"><ul class="be-loader"><li></li><li></li><li></li><li></li></ul></div></div><div class="product-item-bottom-details">';
	}
	function be_woo_after_loop_item_title() {
		echo '</div>';
	}
	function be_woo_thumbnail_before() {
		echo '<div class="product-thumbnail-before">';
	}
	function be_woo_before_single_product() {
		echo '<section id="page-content" class="be-wrap">';
	}
	function be_woo_after_single_product() {
		echo '</section>';
	}
	function be_woo_before_single_product_summary() {
		echo '<div class="left single-right">';
	}
	function be_woo_after_single_product_summary() {
		echo '</div><div class="clear"></div>';
	}
	function be_woo_before_shop_loop() {
		echo '<div class="products-wrap"><div class="shop-title-sep"><hr class="separator style-1"></div>';
	}
	function be_woo_after_shop_loop() {
		echo '</div>';
	}

	function be_woo_single_product_summary() {
		echo '<hr class="separator style-1 product-title-sep" />';
	}

	function be_woo_add_to_cart_text() {
		return '';
	}
	function be_themes_woo_style() {
	    wp_register_style( 'be-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.css' );
	    wp_enqueue_style( 'be-woocommerce' );
		
		wp_deregister_script( 'be-themes-woocommerce-js' );
		wp_register_script( 'be-themes-woocommerce-js', get_template_directory_uri() . '/woocommerce/woocommerce.js', array( 'jquery','be-themes-plugins-js'), FALSE, TRUE );
		wp_enqueue_script( 'be-themes-woocommerce-js' );
	}
	 
	add_action( 'wp_enqueue_scripts', 'be_themes_woo_style' );


	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 4; // 4 products per row
		}
	}

	// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<a class="cart-contents cart-content-count" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></a>
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 21);


	function woocommerce_output_related_products() {
	    woocommerce_related_products(array(5,4)); // 3 products, 3 columns
	}


	function be_woo_child_manage_woocommerce_styles() {
		global $woocommerce;
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script( 'wc-chosen', $woocommerce->plugin_url() . '/assets/js/frontend/chosen-frontend' . $suffix . '.js', array( 'chosen' ), FALSE, true );
		wp_enqueue_style( 'woocommerce_chosen_styles', $woocommerce->plugin_url() . '/assets/css/chosen.css' );
	}
	add_action( 'wp_enqueue_scripts', 'be_woo_child_manage_woocommerce_styles', 99 );

	global $be_themes_data;
	if( !empty($be_themes_data['number_of_products_per_page']) ) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.intval($be_themes_data['number_of_products_per_page']).';' ), 20 );
	}
}
?>