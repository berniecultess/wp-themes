<?php
/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'be_themes_';
$animations = array( 
				'flipInX' => 'flipInX',
				'flipInY' => 'flipInY',
				'fadeIn' => 'fadeIn',
				'fadeInDown' => 'fadeInDown',
				'fadeInLeft' => 'fadeInLeft',
				'fadeInRight' => 'fadeInRight',
				'fadeInUp' => 'fadeInUp',
				'slideInDown' => 'slideInDown',
				'slideInLeft' => 'slideInLeft',
				'slideInRight' => 'slideInRight',
				'rollIn' => 'rollIn',
				'rollOut' => 'rollOut',
				'None' => 'None'
			);
global $meta_boxes;

$meta_boxes = array();



$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'portfolio',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Portfolio Post Type',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'portfolio' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			// Field name - Will be used as label
			'name'		=> __('Project Meta','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}portfolio_client_name",
			// Field description (optional)
			'desc'		=> '',
			// Field description (optional)
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),		
		array(
			// Field name - Will be used as label
			'name'		=> __('Project URL','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}portfolio_visitsite_url",
			// Field description (optional)
			'desc'		=> 'Visit Site url',
			// Field description (optional)
			'type'		=> 'text'
		),
		array (
			'name' => __('Link to Project Url','be-themes'),
			'id'   => "{$prefix}portfolio_item_link_to_project_url",
			'type' => 'checkbox',
			'desc' => '',
			'std'  => 0,
		),
		array (
			'name'	=> __('Portfolio Single Page Style','be-themes'),
			'id'	=> "{$prefix}portfolio_single_page_style",
			'desc'	=> '',
			'type' 	=> 'radio',
			'options'	=> array (
				'normal' => 'Single Page - Page Builder',
				'style1' => 'Horizontal Carousel Slider',
				'style2' => 'Centered Slider',
				'style3' => 'Full Screen Slider',
			),
			'std'  => 'normal'
		),
		array (
			'name'		=> __('Slider Images','be-themes'),
			'id'	=> "{$prefix}single_portfolio_slider_images",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 100,
		),
		array (
			'name' => 'Show Project Title ?',
			'id'   => "{$prefix}show_project_title",
			'type' => 'radio',
			'desc' => 'Show Project Title with Navigation in Single Page - Pagebuilder style',
			'options'	=> array(
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'  => 'yes',
		),
		array (
			'name' => __('Porifolio Items Enable Title','be-themes'),
			'id'   => "{$prefix}portfolio_item_show_title",
			'type' => 'checkbox',
			'desc' => '',
			'std'  => 1,
		),
		array (
			'name' => __('Porifolio Items Enable Categories','be-themes'),
			'id'   => "{$prefix}portfolio_item_show_cat",
			'type' => 'checkbox',
			'desc' => '',
			'std'  => 1,
		),

	)
);




$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'page_portfolio',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Sidebar and Portfolio Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'page' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'advanced',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array (
			'name' => 'Show Widgets Top Bar ?',
			'id'   => "{$prefix}show_widgets",
			'type' => 'radio',
			'options'	=> array(
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'  => 'no',
			'desc' => ''
		),		
		array (
			'name' => __('Widget Area','be-themes'),
			'id'   => "{$prefix}header_sidebar",
			'type' => 'sidebar_select',
			'std'  => 'header-sidebar',
			'desc' => '',
		),

		// array (
		// 	'name' => __('Vertical Portfolio or Horizontal Carousel Gallery - Boxed Style with 4 corner padding','be-themes'),
		// 	'id'   => "{$prefix}vertical_boxed",
		// 	'type' => 'radio',
		// 	'desc' => '',
		// 	'options'	=> array (
		// 		'yes'			=> 'Yes',
		// 		'no'			=> 'No'
		// 	),
		// 	'std'  => 'no',
		// ),
		// array (
		// 	'name' => __('Vertical Portfolio or Horizontal Carousel Gallery - Gutter between images','be-themes'),
		// 	'id'   => "{$prefix}vertical_item_gutter",
		// 	'type' => 'radio',
		// 	'desc' => '',
		// 	'options'	=> array (
		// 		'yes'			=> 'Yes',
		// 		'no'			=> 'No'
		// 	),
		// 	'std'  => 'no',
		// ),
		// array (
		// 	'name' => __('Porifolio Items Enable Title','be-themes'),
		// 	'id'   => "{$prefix}portfolio_show_title",
		// 	'type' => 'checkbox',
		// 	'desc' => 'This Option is Applicable only for Vertical Portfolio',
		// 	'std'  => 1,
		// ),
		// array (
		// 	'name' => __('Porifolio Items Enable Categories','be-themes'),
		// 	'id'   => "{$prefix}portfolio_show_cat",
		// 	'type' => 'radio',
		// 	'type' => 'checkbox',
		// 	'desc' => 'This Option is Applicable only for Vertical Portfolio',
		// 	'std'  => 1,
		// ),

		// array (
		// 	'name' => 'Portfolio Category',
		// 	'id'   => "{$prefix}portfolio_category",
		// 	'type' => 'taxo',
		// 	'taxonomy' => 'portfolio_categories',
		// 	'desc' => 'Choose your categories - This Option is Applicable only for Vertical Portfolio'
		// ),

		// array (
		// 	'name'		=> __('Show posts','be-themes'),
		// 	'id'		=> "{$prefix}portfolio_show_posts",
		// 	'desc'		=> 'Portfolio posts count',
		// 	'type'		=> 'number',
		// 	'std'		=> 10
		// ),
		// array (
		// 	'name'	=> __('Gallery Style','be-themes'),
		// 	'id'	=> "{$prefix}gallery_style",
		// 	'desc'	=> '',
		// 	'type' 	=> 'radio',
		// 	'options'	=> array (
		// 		'style1' => 'Horizontal Carousel Slider',
		// 		'style2' => 'Centered Slider',
		// 		'style3' => 'Full Screen Slider',
		// 	),
		// 	'std'  => 'style1'
		// ),		
		// array (
		// 	// Field name - Will be used as label
		// 	'name'		=> __('Gallery Images','be-themes'),
		// 	// Field ID, i.e. the meta key
		// 	'id'	=> "{$prefix}gallery_images",
		// 	// Field description (optional)
		// 	'desc'		=> '',
			
		// 	'type'		=> 'image_advanced',
		// 	// Default value (optional)
		// 	'max_file_uploads' => 100,
		// )			
	)
);


$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'vertical_portfolio',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Vertical Portfolio & Gallery Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'page' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'advanced',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array (
			'name' => __('Vertical Portfolio or Horizontal Carousel Gallery - Boxed Style with 4 corner padding','be-themes'),
			'id'   => "{$prefix}vertical_boxed",
			'type' => 'radio',
			'desc' => '',
			'options'	=> array (
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'  => 'no',
		),
		array (
			'name' => __('Vertical Portfolio or Horizontal Carousel Gallery - Gutter between images','be-themes'),
			'id'   => "{$prefix}vertical_item_gutter",
			'type' => 'radio',
			'desc' => '',
			'options'	=> array (
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'  => 'no',
		),
		array (
			'name' => __('Porifolio Items Enable Title','be-themes'),
			'id'   => "{$prefix}portfolio_show_title",
			'type' => 'checkbox',
			'desc' => '',
			'std'  => 1,
		),
		array (
			'name' => __('Porifolio Items Enable Categories','be-themes'),
			'id'   => "{$prefix}portfolio_show_cat",
			'type' => 'radio',
			'type' => 'checkbox',
			'desc' => '',
			'std'  => 1,
		),

		array (
			'name' => 'Portfolio Category',
			'id'   => "{$prefix}portfolio_category",
			'type' => 'taxo',
			'taxonomy' => 'portfolio_categories',
			'desc' => 'Choose your categories'
		),

		array (
			'name'		=> __('Show posts','be-themes'),
			'id'		=> "{$prefix}portfolio_show_posts",
			'desc'		=> 'Portfolio posts count',
			'type'		=> 'number',
			'std'		=> 10
		),
		array (
			'name' => __('Title and Categories Animation Type','be-themes'),
			'id'   => "{$prefix}title_cat_animation",
			'type' => 'select',
			'desc' => '',
			'options' => $animations,
			'std'  => 'None',
		),
		// array (
		// 	'name'	=> __('Gallery Style','be-themes'),
		// 	'id'	=> "{$prefix}gallery_style",
		// 	'desc'	=> '',
		// 	'type' 	=> 'radio',
		// 	'options'	=> array (
		// 		'style1' => 'Horizontal Carousel Slider',
		// 		'style2' => 'Centered Slider',
		// 		'style3' => 'Full Screen Slider',
		// 	),
		// 	'std'  => 'style1'
		// ),		
		// array (
		// 	// Field name - Will be used as label
		// 	'name'		=> __('Gallery Images','be-themes'),
		// 	// Field ID, i.e. the meta key
		// 	'id'	=> "{$prefix}gallery_images",
		// 	// Field description (optional)
		// 	'desc'		=> '',
			
		// 	'type'		=> 'image_advanced',
		// 	// Default value (optional)
		// 	'max_file_uploads' => 100,
		// )			
	)
);

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'gallery_folio',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Gallery Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'page' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'advanced',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array (
			'name'	=> __('Gallery Style','be-themes'),
			'id'	=> "{$prefix}gallery_style",
			'desc'	=> '',
			'type' 	=> 'radio',
			'options'	=> array (
				'style1' => 'Horizontal Carousel Slider',
				'style2' => 'Centered Slider',
				'style3' => 'Full Screen Slider',
			),
			'std'  => 'style1'
		),		
		array (
			// Field name - Will be used as label
			'name'		=> __('Gallery Images','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}gallery_images",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'image_advanced',
			// Default value (optional)
			'max_file_uploads' => 100,
		)			
	)
);

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'post_format_options',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Post Format Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array (
			// Field name - Will be used as label
			'name'		=> __('Youtube / Vimeo Video Url','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}video_url",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),
		array (
			// Field name - Will be used as label
			'name'		=> __('Audio Embed Code Or Link to an Audio File','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}audio_url",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),
		array (
			// Field name - Will be used as label
			'name'		=> __('Link','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}link_format",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),		
		array (
			// Field name - Will be used as label
			'name'		=> __('Quote Title','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}quote_title",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),			
		array (
			// Field name - Will be used as label
			'name'		=> __('Gallery Post Format Images','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}gal_post_format",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'thickbox_image',
			// Default value (optional)
			'max_file_uploads' => 10,
		)					


	)
);




/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function be_themes_register_meta_boxes()
{
	global $meta_boxes;
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'be_themes_register_meta_boxes' );