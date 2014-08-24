<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections) {
	
	//$sections = array();
	$sections[] = array (
				'title' => __('A Section added by hook', 'be-themes'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'be-themes'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}
//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}


/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;


$args['intro_text'] = __('<p>Welcome to Ubercorp Options Panel. You will find out that its very simple to do what you want to and yet powerful enough to do whatever you want to with our wide variety of options. </p>', 'be-themes');


//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = PREMIUM_THEME_NAME;


$args['menu_title'] = __('Wynn Options', 'be-themes');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Wynn Theme Options', 'be-themes');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = PREMIUM_THEME_NAME.'_theme_options';



//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 29;

//Custom page icon class (used to override the page icon next to heading)
$args['page_icon'] = PREMIUM_THEME_NAME.'-logo';

	
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Theme Information 1', 'be-themes'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'be-themes')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Theme Information 2', 'be-themes'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'be-themes')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'be-themes');

global $sections;

$sections = array();
global $pattern_array;
$pattern_array = array(
				'None' => array('title' => 'None', 'img' => NHP_OPTIONS_URL.'images/pattern/None.png'),
				'Style-1' => array('title' => 'Style-1', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-1.png'),
				'Style-2' => array('title' => 'Style-2', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-2.png'),
				'Style-3' => array('title' => 'Style-3', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-3.png'),
				'Style-4' => array('title' => 'Style-4', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-4.png'),
				'Style-5' => array('title' => 'Style-5', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-5.png'),
				'Style-6' => array('title' => 'Style-6', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-6.png'),
				'Style-7' => array('title' => 'Style-7', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-7.png'),
				'Style-8' => array('title' => 'Style-8', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-8.png'),
				'Style-9' => array('title' => 'Style-9', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-9.png'),
				'Style-10' => array('title' => 'Style-10', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-10.png'),
				'Style-11' => array('title' => 'Style-11', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-11.png'),
				'Style-12' => array('title' => 'Style-12', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-12.png'),
				'Style-13' => array('title' => 'Style-13', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-13.png'),
				'Style-14' => array('title' => 'Style-14', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-14.png'),
				'Style-15' => array('title' => 'Style-15', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-15.png'),
				'Style-16' => array('title' => 'Style-16', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-16.png'),
				'Style-17' => array('title' => 'Style-17', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-17.png'),
				'Style-18' => array('title' => 'Style-18', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-18.png'),
				'Style-19' => array('title' => 'Style-19', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-19.png'),
				'Style-20' => array('title' => 'Style-20', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-20.png'),
				'Style-21' => array('title' => 'Style-21', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-21.png'),
			);
global $background_array;
$background_array = array (
				'None' => array('title' => 'None', 'img' => NHP_OPTIONS_URL.'images/pattern/None.png'),
				'Style-1' => array('title' => 'Style-1', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-1.png'),
				'Style-2' => array('title' => 'Style-2', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-2.png'),
				'Style-3' => array('title' => 'Style-3', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-3.png'),
				'Style-4' => array('title' => 'Style-4', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-4.png'),
				'Style-5' => array('title' => 'Style-5', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-5.png')
			);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'images/icon/general.png',
				'title' => __('General', 'be-themes'),
				'desc' => __('<p class="description"></p>', 'be-themes'),
				'fields' =>	array(
					array (
						'id' => 'dev_or_deploy',
						'type' => 'button_set',
						'title' => __('Status of the Website', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('It is important to set this to "deploy" after you have finished playing with options panel and ready to launch the website. It will help us cache the css and optimize performance of the website', 'be-themes'),
						'options' => array('dev' => 'Develop','deploy' => 'Deploy'),//Must provide key => value pairs for radio options
						'std' => 'dev'
					),
					array (
						'id' => 'enable_pb',
						'type' => 'checkbox',
						'title' => __('Enable Pagebuilder ?', 'be-themes'),
						'sub_desc' => __('Check this box if you would like to use the page builder for constructing your pages and portfolio posts. Page Builder is not available for blog posts. You can still disable the page builder per page if you would like to use the default wordpress content editor', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
					),						
					array(
						'id' => 'logo',
						'type' => 'upload',
						'title' => __('Your Logo', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please upload your logo here.', 'be-themes')
						),				
					array (
						'id' => 'favicon',
						'type' => 'upload',
						'title' => __('Your Favicon', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please upload a favicon here.', 'be-themes')
					),
					array(
						'id' => 'copyright_text',
						'type' => 'textarea',
						'title' => __('Copyrights Text', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please Enter the text along with any links that need to go in the footer copyright area', 'be-themes'),
						'validate' => 'html', 
						'std' => 'Copyrights 2012. All Rights Reserved'
						),

					array(
						'id' => 'google_analytics_code',
						'type' => 'text',
						'title' => __('Google Analytics Code', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Google analytics tracking ID here.', 'be-themes'),
						'validate' => 'js', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
						'std' => ''
						),
					array(
						'id' => 'custom_css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please add your custom css here.', 'be-themes'),
						'validate' => 'html_custom', 
						'std' => ''
						),
					array (
						'id' => 'custom_js',
						'type' => 'textarea',
						'title' => __('Custom Javascript', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please add your custom js code here', 'be-themes'),
						'validate' => 'html_custom', 
						'std' => ''
					),
					array (
						'id' => 'disable_loader',
						'type' => 'checkbox',
						'title' => __('Disable Loader ?', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
					),
					array (
						'id' => 'disable_smooth_scroll',
						'type' => 'checkbox',
						'title' => __('Disable Smooth Scroll ?', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
					),
					array (
						'id' => 'custom_loader',
						'type' => 'upload',
						'title' => __('Custom Loader', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please upload a Loader here.', 'be-themes')
					),
				)
			);

$sections[] = array(
				'title' => __('Background', 'be-themes'),
				'desc' => __('<p class="description">Control the Appearance of the site from this tab by uploading your own patterns and images or by choosing from one of the plethora of presets available</p>', 'be-themes'),
				'icon' => NHP_OPTIONS_URL.'images/icon/bg.png',
				'fields' => array(
					array(
						'id' => 'body',
						'type' => 'background',
						'title' => __('Body', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'defaults' => $pattern_array,
						'patterns' => array('dark' => 'Dark','light' => 'Light'),
						'std' =>    array(            
								'background' =>'', 
			                    'scale' => 0,
			                    'bgdefault' => '',
			                    'bgpattern' => '',
			                    'color' => '#f2f8f8', 
			                    'opacity' => '1'
			                )
						
						),				

					array(
						'id' => 'header',
						'type' => 'background',
						'title' => __('Header Background', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'defaults' => $pattern_array,
						'patterns' => array('dark' => 'Dark','light' => 'Light'),
						'std' =>    array(            
								'background' =>'', 
			                    'scale' => 0,
			                    'bgdefault' => '',
			                    'bgpattern' => '',
			                    'color' => '#000000', 
			                    'opacity' => '1'
			                )
						
						),	
					array(
						'id' => 'footer',
						'type' => 'background',
						'title' => __('Footer Background', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'defaults' => $pattern_array,
						'patterns' => array('dark' => 'Dark','light' => 'Light'),
						'std' =>    array(            
								'background' =>'', 
			                    'scale' => 0,
			                    'bgdefault' => '',
			                    'bgpattern' => '',
			                    'color' => '#000000', 
			                    'opacity' => '1'
			                )
						
						),
					array(
						'id' => 'sub_menu_bg',
						'type' => 'color',
						'title' => __('Submenu Background Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#181818'
						),								

					 )
				);


$sections[] = array(
				'title' => __('Typography', 'be-themes'),
				'desc' => __('<p class="description"></p>', 'be-themes'),
				'icon' => NHP_OPTIONS_URL.'images/icon/typo.png',
				'fields' => array(

					array(
						'id' => 'h1',
						'type' => 'typo',
						'title' => __('H1', 'be-themes'), 
						'sub_desc' => __('Heading Tag 1', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '40px',
					                    'line_height' => '52px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),

					array(
						'id' => 'h2',
						'type' => 'typo',
						'title' => __('H2', 'be-themes'), 
						'sub_desc' => __('Heading Tag 2', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '35px',
					                    'line_height' => '48px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),

					array(
						'id' => 'h3',
						'type' => 'typo',
						'title' => __('H3', 'be-themes'), 
						'sub_desc' => __('Heading Tag 3', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '28px',
					                    'line_height' => '39px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),

					array(
						'id' => 'h4',
						'type' => 'typo',
						'title' => __('H4', 'be-themes'), 
						'sub_desc' => __('Heading Tag 4', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '21px',
					                    'line_height' => '35px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),

					array(
						'id' => 'h5',
						'type' => 'typo',
						'title' => __('H5', 'be-themes'), 
						'sub_desc' => __('Heading Tag 5', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '17px',
					                    'line_height' => '30px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),

					array(
						'id' => 'h6',
						'type' => 'typo',
						'title' => __('H6', 'be-themes'), 
						'sub_desc' => __('Heading Tag 6', 'be-themes'), 
						'desc' => __('', 'be-themes'),
						'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '15px',
					                    'line_height' => '26px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),

					array(
						'id' => 'body_text',
						'type' => 'typo',
						'title' => __('Body Text', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '13px',
					                    'line_height' => '26px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#525d66'
					                )
						),
					array(
						'id' => 'footer_text', 
						'type' => 'typo',
						'title' => __('Footer Text', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '12px',
					                    'line_height' => '24px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#9d9d9d'
					                )
						),

					array(
						'id' => 'navigation_text',
						'type' => 'typo',
						'title' => __('Navigation Menu', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'), 
						'desc' => __('', 'be-themes'),
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '11px',
					                    'line_height' => '40px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'uppercase',
					                    'color' => '#a3a3a3'
					                )
						),	
					array(
						'id' => 'sub_menu_text',
						'type' => 'typo',
						'title' => __('Sub Menu', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'), 
						'desc' => __('', 'be-themes'),
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '11px',
					                    'line_height' => '20px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'uppercase',
					                    'color' => '#a3a3a3'
					                )
						),													

					 														

					) // Fields Array
				);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'images/icon/layout-new.png',
				'title' => __('Layout', 'be-themes'),
				'desc' => __('<p class="description">', 'be-themes'),
				'fields' =>	array(
					array(
						'id' => 'disable_all_ajax',
						'type' => 'checkbox',
						'title' => __('Disable All Ajax Loading', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
						),	
					array(
						'id' => 'comments_on_page',
						'type' => 'checkbox',
						'title' => __('Show Comments Section in Pages ?', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
						),						
					array(
						'id' => 'custom_sidebars',
						'type' => 'multi_text',
						'title' => __('Custom Sidebars', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => ''
						),

					array(
						'id' => 'number_of_products_per_page',
						'type' => 'text',
						'title' => __('Products per Page', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
					),	
					array(
						'id' => 'header_layout',
						'type' => 'select',
						'title' => __('Header Layout', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'options' => array('left-header'=>'Left Side', 'top-header'=>'Top Bar'),
						'std' => 'left-header'
					),
					array(
						'id' => 'sticky_header',
						'type' => 'checkbox',
						'title' => __('Sticky Header', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 1
					),
					array(
						'id' => 'back_to_top',
						'type' => 'checkbox',
						'title' => __('Back to Top disable', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 1
					),
					array (
						'id' => 'blog_layout',
						'type' => 'select',
						'title' => __('Blog Layout', 'be-themes'),
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'options' => array('masonry'=>'Masonry', 'traditional'=>'Traditional'),
						'std' => 'masonry'
					),
					array (
						'id' => 'blog_title',
						'type' => 'text',
						'title' => __('Traditional Blog Page Title', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 'Blog'
					),					
				)
			);


$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'images/icon/brush.png',
				'title' => __('Colors', 'be-themes'),
				'desc' => __('<p class="description">', 'be-themes'),
				'fields' =>	array(

					array(
						'id' => 'color_scheme',
						'type' => 'color',
						'title' => __('Color Scheme', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#24c26d'
						),

					array(
						'id' => 'alt_bg_text_color',
						'type' => 'color',
						'title' => __('Text Color on a background which has the above Color Scheme', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#eff5f5'
						),
					array(
						'id' => 'alt_bg_border',
						'type' => 'color',
						'title' => __('Border Color of elements that have the above Color Scheme as background', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#59a178'
						),					
					array(
						'id' => 'sec_bg',
						'type' => 'color',
						'title' => __('Secondary Background Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Background Color of certain shortcode and widget elements such as Tabs, Accordion, Text boxes etc', 'be-themes'),
						'std' => '#ffffff'
						),
					array(
						'id' => 'sec_color',
						'type' => 'color',
						'title' => __('Secondary Text Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Text Color of certain shortcode and widget elements which have the secondary background above', 'be-themes'),
						'std' => '#5f6567'
						),
					array(
						'id' => 'sec_border',
						'type' => 'color',
						'title' => __('Secondary Border Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Border Color of certain shortcode and widget elements such as Tabs, Accordion, Text boxes etc', 'be-themes'),
						'std' => '#dfdbdf'
						),					
					array(
						'id' => 'sec_title_color',
						'type' => 'color',
						'title' => __('Secondary Title Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Color of Heading tags on certain shortcode and widget elements which have the secondary background above', 'be-themes'),
						'std' => '#23272c'
						),	
					array(
						'id' => 'meta_colors',
						'type' => 'color',
						'title' => __('Meta Colors', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Text Color of Meta Information like Portfolio Categories, Blog Post Date etc', 'be-themes'),
						'std' => '#71898e'
						),
					array(
						'id' => 'separator_color',
						'type' => 'color',
						'title' => __('Separator Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#CBD3D5'
						),	
					array(
						'id' => 'menu_hover_color',
						'type' => 'color',
						'title' => __('Menu Hover Text Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#ffffff'
						),
					array(
						'id' => 'menu_selected_color',
						'type' => 'color',
						'title' => __('Active Menu Text Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#ffffff'
						),
					array(
						'id' => 'slider_arrow_bg',
						'type' => 'color',
						'title' => __('Slider Arrow Background Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#000000'
						),
					array(
						'id' => 'slider_arrow_color',
						'type' => 'color',
						'title' => __('Slider Arrow Color', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#ffffff'
						),																					
					array(
						'id' => 'woo_sec_button_colors',
						'type' => 'color',
						'title' => __('Woo Commerce Secondary Button Background Colors', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#323232'
					),	
					array(
						'id' => 'gallery_caption_bg',
						'type' => 'color',
						'title' => __('Background Color of Gallery Captions', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#24c26d'
						),	
					array(
						'id' => 'gallery_caption_text_color',
						'type' => 'color',
						'title' => __('Text Color of Gallery Captions', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#fff'
						),										
									
				)
			);



$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'images/icon/portfolio.png',
				'title' => __('Portfolio', 'be-themes'),
				'desc' => __('<p class="description">', 'be-themes'),
				'fields' =>	array(
					array(
						'id' => 'back_to_portfolio',
						'type' => 'text',
						'title' => __('Back to Portfolio Link', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'validate' => 'url',
						'std' => ''
					),	
					array(
						'id' => 'vertical_portfolio_title',
						'type' => 'typo',
						'title' => __('Font Controls of Vertical Portfolio Title', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						//'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '21px',
					                    'line_height' => '35px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#ffffff'
					                )
						),
					array(
						'id' => 'vertical_portfolio_cats',
						'type' => 'typo',
						'title' => __('Font Controls of Vertical Portfolio Category list', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						//'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '12px',
					                    'line_height' => '30px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#eff5f5'
					                )
						),					
					array(
						'id' => 'vertical_portfolio_title_bg',
						'type' => 'color',
						'title' => __('Background Color of Vertical Portfolio\'s Title', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#000000'
						),
					array(
						'id' => 'vertical_portfolio_cats_bg',
						'type' => 'color',
						'title' => __('Background Color of Vertical Portfolio\'s Categories', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#24c26d'
						),													

					array(
						'id' => 'centered_portfolio_title',
						'type' => 'typo',
						'title' => __('Font Controls of Boxed Portfolio Title', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:bold',
					                    'size' => '14px',
					                    'line_height' => '22px',
					                    'style' => 'normal',
					                    'weight' => 'bold',
					                    'transform' => 'none',
					                    'color' => '#23272c'
					                )
						),
					array(
						'id' => 'centered_portfolio_cats',
						'type' => 'typo',
						'title' => __('Font Controls of Centered Portfolio Category list', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						//'group' => 'typo',
						'std' => array
					                (
					                    'family' => 'google/Noto Sans:regular',
					                    'size' => '11px',
					                    'line_height' => '26px',
					                    'style' => 'normal',
					                    'weight' => 'normal',
					                    'transform' => 'none',
					                    'color' => '#71898e'
					                )
						),						

				)
			);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'images/icon/contact.png',
				'title' => __('Contact Settings', 'be-themes'),
				'desc' => __('<p class="description"></p>', 'be-themes'),
				'fields' => array(

					array(
						'id' => 'address',
						'type' => 'textarea',
						'title' => __('Contact Address', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please Enter your address to be used in the contact page map', 'be-themes'),
						'validate' => 'no_html',
						'std' => '66 Nicholson Ave Buffalo NY 14214'
						),
					array(
						'id' => 'contact_form_mail',
						'type' => 'text',
						'title' => __('Email ID', 'be-themes'),
						'sub_desc' => __('This is where the enquiries from the contact form will be sent to. If empty the enquiries will be sent the the admins email', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => ''
					),	

				),
				
			);	




$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'images/icon/social.png',
				'title' => __('Social Media Settings', 'be-themes'),
				'desc' => __('<p class="description">Please choose the icons that need to be displayed using the Social Media Widget. Use this widget to direct your visitors to follow your social media profiles.</p>', 'be-themes'),
				'fields' => array(

					array(
						'id' => 'facebook_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Facebook', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Facebook Icon', 'be-themes'),
						'std'=> 1,
						),

					array(
						'id' => 'facebook_icon_url',
						'type' => 'text',
						'title' => __('Facebook Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Facebook page/profile url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://www.facebook.com'
						),

					array(
						'id' => 'twitter_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Twitter', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Twitter Icon', 'be-themes'),
						'std'=> 1,

						),

					array(
						'id' => 'twitter_icon_url',
						'type' => 'text',
						'title' => __('Twitter Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Twitter page/profile url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://www.twitter.com'

						),

					array(
						'id' => 'gplus_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Google Plus', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Google Plus Icon', 'be-themes'),
						'std'=> 1,
						),

					array(
						'id' => 'gplus_icon_url',
						'type' => 'text',
						'title' => __('Google Plus Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Google plus page/profile url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://google.com'
						),
					
					array(
						'id' => 'dribbble_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Dribbble', 'be-themes'), 
						'sub_desc' => __('Please enter your RSS feed url', 'be-themes'),
						'desc' => __('Add Dribbble Icon', 'be-themes')
					),

					array(
						'id' => 'dribbble_icon_url',
						'type' => 'text',
						'title' => __('Dribbble Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Dribbble profile url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://dribbble.com'
					),
					array(
						'id' => 'pinterest_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Pinterest', 'be-themes'), 
						'sub_desc' => __('Please enter your Pinterest url', 'be-themes'),
						'desc' => __('Add Pinterest Icon', 'be-themes'),
						'std'=> 1,
					),

					array(
						'id' => 'pinterest_icon_url',
						'type' => 'text',
						'title' => __('Pinterest Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Pinterest profile url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://pinterest.com/'
					),
					array(
						'id' => 'youtube_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Youtube', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Youtube Icon', 'be-themes')
					),

					array(
						'id' => 'youtube_icon_url',
						'type' => 'text',
						'title' => __('Youtube Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Youtube url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://youtube.com/'
					),
					array(
						'id' => 'flickr_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Flickr', 'be-themes'), 
						'sub_desc' => __('Please enter your Flickr url', 'be-themes'),
						'desc' => __('Add Flickr Icon', 'be-themes')
					),

					array(
						'id' => 'flickr_icon_url',
						'type' => 'text',
						'title' => __('Flickr Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Flickr profile url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://www.flickr.com/'
					),
					array(
						'id' => 'skype_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Skype', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Skype Icon', 'be-themes')
					),

					array(
						'id' => 'skype_icon_url',
						'type' => 'text',
						'title' => __('Skype Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Skype url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://www.skype.com/'
					),
					array(
						'id' => 'instagramm_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Instagram', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Instagram Icon', 'be-themes')
					),

					array(
						'id' => 'instagramm_icon_url',
						'type' => 'text',
						'title' => __('Instagram Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Instagram url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://www.instagram.com/'
					),
					array(
						'id' => 'linkedin_icon',
						'type' => 'checkbox_hide_below',
						'title' => __('Linked In', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Add Linked In Icon', 'be-themes')
					),

					array(
						'id' => 'linkedin_icon_url',
						'type' => 'text',
						'title' => __('Linked In Icon Url', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('Please enter your Linked In url', 'be-themes'),
						'validate' => 'url',
						'std' => 'http://www.linkedin.com/'
					),					
					array(
						'id' => 'invert_icon_colors',
						'type' => 'checkbox',
						'title' => __('Invert Social Media Icon Colors', 'be-themes'),
						'sub_desc' => __('Icons are coloured on hover and the default color will be the one set below', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => 0
						),
					array(
						'id' => 'social_icon_colors',
						'type' => 'color',
						'title' => __('Social Media Icon Colors', 'be-themes'), 
						'sub_desc' => __('', 'be-themes'),
						'desc' => __('', 'be-themes'),
						'std' => '#383838'
					),																								
				)
			
			);		

				

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>