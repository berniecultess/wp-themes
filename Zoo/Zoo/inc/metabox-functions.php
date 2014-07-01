<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => 'Page Options',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
						array(
			'name' => 'Heading Style',
				'desc' => 'Select Page Heading Style',
				'id'   => $prefix . 'heading_style',
				'type' => 'select',
				'options' => array(
					array( 'name' => 'Standard', 'value' => 'standard', ),
					array( 'name' => 'Dropcap', 'value' => 'dropcap', ),
					array( 'name' => 'No Heading', 'value' => 'noheading', ),
				),
			),	

			array(
	            'name' => 'Background Color',
	            'desc' => 'Select page background color',
	            'id'   => $prefix . 'background_colorpicker',
	            'type' => 'colorpicker',
				'std'  => '#ffffff'
	        ),
			array(
				'name' => 'Background Image',
				'desc' => 'Upload a background image or enter an URL.',
				'id'   => $prefix . 'background_image',
				'type' => 'file',
			),
			array(
				'name' => 'Page Description',
				'id'   => $prefix . 'description_text',
				'type' => 'wysiwyg',
			),

		
		),
	);

	$meta_boxes[] = array(
		'id'         => 'super_slider_metabox',
		'title'      => 'Slide Caption Scoll Animation Presets',
		'pages'      => array( 'super_slider', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name' => 'Animtion Style',
				'id'   => $prefix . 'caption_animation',
				'type' => 'select',
				'options' => array(
					array( 'name' => 'None', 'value' => '', ),
					array( 'name' => 'Shrink', 'value' => "data-0='transform:scale(1); top:0px;' data-1400='transform:scale(0.5); top:200px;' ", ),
					array( 'name' => 'Grow', 'value' => "data-0='transform:scale(1); top:0px;' data-1400='transform:scale(2); top:-200px;' ", ),
					array( 'name' => 'Spin', 'value' => "data-0='transform:rotate(0deg);' data-1400='transform:rotate(360deg);' ", ),
				),
			),
		)
	);


	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
