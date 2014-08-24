<?php
define('PREMIUM_THEME_NAME','wynn');

if ( ! isset( $content_width ) ) { 
	$content_width = 1920;
}
$be_themes_data = get_option(PREMIUM_THEME_NAME);


/* ---------------------------------------------  */
// Theme Setup
/* ---------------------------------------------  */

add_action( 'after_setup_theme', 'be_themes_setup' );

if ( ! function_exists( 'be_themes_setup' ) ):
	function be_themes_setup() {
		load_theme_textdomain( 'be-themes', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		register_nav_menu( 'main_nav', 'Main Menu' );		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'quote', 'video', 'audio','link' ) );
	}
endif;

// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/meta-box' ) );
require_once( get_template_directory().'/functions/helpers.php' );
require_once( get_template_directory().'/functions/widget-functions.php' );
require_once( get_template_directory().'/functions/custom-post-types.php' );
require_once( get_template_directory().'/ajax-handler.php' );
require_once( get_template_directory().'/functions/shortcodes.php' );
require_once( get_template_directory().'/be-themes-options.php' ); 
require_once( get_template_directory().'/functions/be-styles-functions.php' );
require_once ( get_template_directory().'/meta-box/meta-box.php' );
require_once( get_template_directory().'/be-themes-metabox.php' );
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once( get_template_directory().'/woocommerce/be-woo-functions.php' );
}

function be_themes_image_sizes( $sizes ) {

    global $_wp_additional_image_sizes;
    if ( empty( $_wp_additional_image_sizes ) )
        return $sizes;

    foreach ( $_wp_additional_image_sizes as $id => $data ) {
        if ( !isset($sizes[$id]) )
            $sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
    }

    return $sizes;
}



/* ---------------------------------------------  */
// Specifying the various image sizes for theme
/* ---------------------------------------------  */

empty( $be_themes_data['one_col_height'] ) ? ( $one_col_height = 260 ) : ( $one_col_height = $be_themes_data['one_col_height'] );
empty( $be_themes_data['two_col_height'] ) ? ( $two_col_height = 260 ) : ( $two_col_height = $be_themes_data['two_col_height'] );
empty( $be_themes_data['three_col_height'] ) ? ( $three_col_height = 220 ) : ( $three_col_height = $be_themes_data['three_col_height'] );
empty( $be_themes_data['four_col_height'] ) ? ( $four_col_height = 272 ) : ( $four_col_height = $be_themes_data['four_col_height'] );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'blog-image', 600);
	add_image_size( 'portfolio-two', 526, 314, true );
	add_image_size( 'portfolio-three', 480, 285, true );
	add_image_size( 'portfolio-four', 480, 285, true );
	add_image_size( 'blog-widget', 54, 54,true );
	add_image_size( 'carousel-thumb', 75, 50,true );
	add_image_size( 'one-half', 560 );
	add_image_size( 'one-third', 460 );
	add_image_size( 'one-fourth', 480 );
	add_image_size( 'wynn-full', 1160 );
	add_filter( 'image_size_names_choose', 'be_themes_image_sizes' );
}


/* ---------------------------------------------  */
// Remove Admin bar & add support for post formats
/* ---------------------------------------------  */

add_filter('show_admin_bar', '__return_false');

add_post_type_support( 'page', 'post-formats' );





/* ---------------------------------------------  */
// Function for including the required google fonts
/* ---------------------------------------------  */

add_action( 'wp_head', 'be_themes_google_fonts',0 );

function be_themes_google_fonts() {
	global $be_themes_data;
	$be_themes_fonts[] = $be_themes_data['h1']['family'];
	$google_fonts = array();
	array_push(
		$be_themes_fonts,
		$be_themes_data['h2']['family'],
		$be_themes_data['h3']['family'],
		$be_themes_data['h4']['family'],
		$be_themes_data['h5']['family'],
		$be_themes_data['h6']['family'],
		$be_themes_data['body_text']['family'],
		$be_themes_data['footer_text']['family'],
		$be_themes_data['navigation_text']['family']
	);
	
	$be_themes_fonts = array_unique($be_themes_fonts);
	
	foreach( $be_themes_fonts as $font ) {
	    $font_family = explode( '/', $font );
		if( $font_family[0] == 'google' ) {
			$google_fonts[] .= "'".$font_family[1]."'";
		}
	}
	
	if( isset( $google_fonts ) ) {
		$fonts_include = implode( ',', $google_fonts );
	}
		
	if( isset( $fonts_include ) ){
		echo 
		     '<script type="text/javascript">
		  		WebFontConfig = {
		    		google: { families: ['.$fonts_include.']}
		  		};
		  		(function() {
			        var wf = document.createElement("script");
			        wf.src = ("https:" == document.location.protocol ? "https" : "http") +
			            "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
			        wf.type = "text/javascript";
			        wf.async = "true";
			        var s = document.getElementsByTagName("script")[0];
			        s.parentNode.insertBefore(wf, s);
			    })();
		    </script>';
	}	    
	
}


/* ---------------------------------------------  */
// Function for setting the background image of a page
/* ---------------------------------------------  */

add_action( 'wp_head', 'be_themes_body_background' );

function be_themes_body_background() {
	global $wp_query;
	global $be_themes_data;
	$page_id = $wp_query->get_queried_object_id();
	$output ='';	 
		 $bg_image = get_post_meta( $page_id, 'be-themes_page_bg_image', true );
		 if( $bg_image ) {
		 	$src = wp_get_attachment_image_src( $bg_image, 'full' );
		 	$src = $src[0];
        } else {
	    	if( isset( $be_themes_data['body']['scale'] ) ){
	    		if( isset($be_themes_data['body']['custom']) ){
		    		$src = $be_themes_data['body']['bgpattern'];
		    	}
		    	elseif( !empty( $be_themes_data['body']['background'] ) ){
			    	$src = get_template_directory_uri().'/css/patterns/'.$be_themes_data['body']['background'].'.png';
		    	}
		    			
		  	}
	    }
	    if( isset($src) ) { 
	    $output .='
	    <script>
	    	jQuery(document).ready(function(){
		    	jQuery.backstretch("'.$src.'");
	    	});
	    </script>';
	    
     }
     echo $output;
}

add_action( 'wp_footer', 'be_themes_exclude_woo_from_ajax' );

function be_themes_exclude_woo_from_ajax() {
	global $woocommerce;
	global $be_themes_data;

		echo '<script>
				var no_ajax_pages = [];';

	if(isset($be_themes_data['disable_all_ajax']) && $be_themes_data['disable_all_ajax'] ){
			echo 'no_ajax_pages.push("");';
	}
	echo '</script>';

	if($woocommerce) { 	
		$order = new WC_Order();
		echo '<script>
				no_ajax_pages.push("'.$woocommerce->cart->get_cart_url().'");
				no_ajax_pages.push("'.$woocommerce->cart->get_checkout_url().'");
				no_ajax_pages.push("'.get_permalink( woocommerce_get_page_id( 'shop' ) ).'");';
				if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
					echo 'no_ajax_pages.push("'.$order->get_checkout_payment_url().'");
					no_ajax_pages.push("'.$order->get_checkout_order_received_url().'");';
				} else {
					echo 'no_ajax_pages.push("'.get_permalink( woocommerce_get_page_id( 'pay' ) ).'");';
				}
				
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => -1
				);
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post(); 
					echo 'no_ajax_pages.push("'.get_permalink( get_the_ID() ).'");';
				endwhile; 
				}
		echo '</script>';
	}	
}

/* ---------------------------------------------  */
// Function for generating dynamic css
/* ---------------------------------------------  */

add_action( 'wp_ajax_be_themes_options_css', 'be_themes_options_css' );
add_action( 'wp_ajax_nopriv_be_themes_options_css', 'be_themes_options_css' ); 

function be_themes_options_css() {
	global $be_themes_data;
    header( 'Content-Type: text/css' );
    if( $be_themes_data['dev_or_deploy']=="dev" ) {
	    header( 'Expires: Thu, 31 Dec 2050 23:59:59 GMT' );
	    header( 'Pragma: cache' );
	    delete_transient( 'be_themes_css' );
	}
   if ( false === ( $css = get_transient( 'be_themes_css' ) ) ) {
        $be_themes_path = get_template_directory_uri();
        $css_dir = get_stylesheet_directory() . '/css/'; 
        ob_start(); // Capture all output (output buffering)

		require(get_template_directory() .'/css/be-themes-styles.php'); // Generate CSS

		$css = ob_get_clean(); // Get generated CSS (output buffering)
		
        set_transient( 'be_themes_css', $css );
    }

    echo $css;
    die();
}


/* ---------------------------------------------  */
// Enqueue Stylesheets
/* ---------------------------------------------  */

add_action( 'wp_enqueue_scripts', 'be_themes_add_styles' );

function be_themes_add_styles() {

	wp_register_style( 'be-themes-shortcodes', get_template_directory_uri().'/css/shortcodes.css' );
	wp_enqueue_style( 'be-themes-shortcodes' );

	wp_register_style( 'be-flexslider', get_template_directory_uri().'/css/flexslider.css' );
	wp_enqueue_style( 'be-flexslider' );	

	wp_register_style( 'be-themes-css', admin_url('admin-ajax.php?action=be_themes_options_css') );
	wp_enqueue_style( 'be-themes-css' );

	wp_register_style( 'fontello', get_template_directory_uri().'/fonts/fontello/fontello.css' );
	wp_enqueue_style( 'fontello' );

	wp_register_style( 'be-lightbox-css', get_template_directory_uri().'/css/magnific-popup.css' );
	wp_enqueue_style( 'be-lightbox-css' );

	wp_register_style( 'be-animations', get_template_directory_uri().'/css/animate-custom.css' );
	wp_enqueue_style( 'be-animations' );

}

/* ---------------------------------------------  */
// Enqueue scripts
/* ---------------------------------------------  */

add_action( 'wp_enqueue_scripts', 'be_themes_add_scripts' ); 

function be_themes_add_scripts() {

	global $be_themes_data;

	wp_deregister_script( 'modernizr' );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js' );
	wp_enqueue_script( 'modernizr' );
	
	wp_deregister_script( 'be-themes-plugins-js' );
	wp_register_script( 'be-themes-plugins-js', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), FALSE, TRUE );
	wp_enqueue_script( 'be-themes-plugins-js' );

	wp_deregister_script( 'map-api' );
	wp_register_script( 'map-api', 'http://maps.google.com/maps/api/js?sensor=false&amp;language=en', array(), FALSE, TRUE );
	wp_enqueue_script( 'map-api' );
	
	wp_deregister_script( 'be-map' );
	wp_register_script( 'be-map', get_template_directory_uri() . '/js/gmap3.min.js', array( 'jquery','map-api' ), FALSE, TRUE );
	wp_enqueue_script( 'be-map' );

	wp_deregister_script( 'jquery_ui_custom' );
	wp_register_script( 'jquery_ui_custom', get_template_directory_uri() . '/js/jquery-ui-1.8.22.custom.min.js', array( 'be-themes-plugins-js' ), FALSE, TRUE );
	wp_enqueue_script( 'jquery_ui_custom' );

	wp_deregister_script( 'be-themes-script-js' );
	wp_register_script( 'be-themes-script-js', get_template_directory_uri() . '/js/script.js', array( 'jquery','be-themes-plugins-js'), FALSE, TRUE );
	wp_enqueue_script( 'be-themes-script-js' );

	
	
}

/* ---------------------------------------------  */
// Add Body Class
/* ---------------------------------------------  */

add_filter('body_class','be_themes_add_body_class');
function be_themes_add_body_class($classes) {
	global $be_themes_data;
	global $post;
	if( !is_object($post) ) {
        return $classes;
    }
	if(is_singular('portfolio')) {
		$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
		if($single_portfolio_style) {
			$classes[] = 'single-'.$single_portfolio_style;
		} else {
			$classes[] = 'single-normal';
		}
	}
	if( is_page_template('gallery.php') ) {
		$gallery_style = get_post_meta(get_the_ID(), 'be_themes_gallery_style', true);
		if($gallery_style) {
			$classes[] = 'single-'.$gallery_style;
			$vertical_boxed = get_post_meta(get_the_ID(), 'be_themes_vertical_boxed', true);
			if( 'yes' == $vertical_boxed ) {
				$classes[] = 'vertical-boxed';
			}
			$vertical_item_gutter = get_post_meta(get_the_ID(), 'be_themes_vertical_item_gutter', true);
			if( 'yes' == $vertical_item_gutter ) {
				$classes[] = 'item-gutter';
			}
		}
	}
	$portfolio_type = get_post_meta(get_the_ID(), 'be_themes_portfolio_style', true);
	if( is_page_template('portfolio.php') ) {
		$classes[] = 'single-style1';
		$vertical_boxed = get_post_meta(get_the_ID(), 'be_themes_vertical_boxed', true);
		if( 'yes' == $vertical_boxed ) {
			$classes[] = 'vertical-boxed';
		}
		$vertical_item_gutter = get_post_meta(get_the_ID(), 'be_themes_vertical_item_gutter', true);
		if( 'yes' == $vertical_item_gutter ) {
			$classes[] = 'item-gutter';
		}
	}
	if( !empty( $be_themes_data['header_layout'] ) ) {
		$classes[] = $be_themes_data['header_layout'];
	}
	if( !empty( $be_themes_data['sticky_header'] ) ) {
		$classes[] = 'sticky-header';
	}
	if( isset( $be_themes_data['disable_smooth_scroll'] ) && !empty( $be_themes_data['disable_smooth_scroll'] ) ) {
		$classes[] = 'no-smooth-scroll';
	} else {
		$classes[] = 'smooth-scroll';
	}
	return $classes;
	
}

require_once( get_template_directory() .'/be-page-builder/be-page-builder.php' );
require_once( get_template_directory() .'/functions/be-tgm-plugins.php' );

class My_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth=0, $args=array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<span class=\"mobile-sub-menu-controller\"><i class=\"icon-angle-down\"></i></span><ul class=\"my-sub-menu\">\n";
	}
}
?>