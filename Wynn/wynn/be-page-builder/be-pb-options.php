<?php 


add_action('init','be_shortcodes_init');

function be_shortcodes_init(){

	global $be_themes_data;
	global $be_shortcode;

	$be_font_icons = array(
	'none',	
	'plus',
	'minus',
	'left-big',
	'up-big',
	'right-big',
	'down-big',
	'home',
	'pause',
	'fast-fw',
	'fast-bw',
	'to-end',
	'to-start',
	'stop',
	'up-dir',
	'play',
	'right-dir',
	'down-dir',
	'left-dir',
	'cloud',
	'umbrella',
	'star',
	'star-empty',
	'check',
	'left-hand',
	'up-hand',
	'right-hand',
	'down-hand',
	'th-list',
	'heart-empty',
	'heart',
	'music',
	'th',
	'flag',
	'cog',
	'attention',
	'flash',
	'cog-alt',
	'scissors',
	'flight',
	'mail',
	'edit',
	'pencil',
	'ok',
	'ok-circled',
	'cancel',
	'cancel-circled',
	'asterisk',
	'attention-circled',
	'plus-circled',
	'minus-circled',
	'forward',
	'ccw',
	'cw',
	'resize-vertical',
	'resize-horizontal',
	'eject',
	'star-half',
	'ok-circled2',
	'cancel-circled2',
	'help-circled',
	'info-circled',
	'th-large',
	'eye',
	'eye-off',
	'tag',
	'tags',
	'camera-alt',
	'export',
	'print',
	'retweet',
	'comment',
	'chat',
	'location',
	'trash',
	'basket',
	'login',
	'logout',
	'resize-full',
	'resize-small',
	'zoom-in',
	'zoom-out',
	'down-circled2',
	'up-circled2',
	'down-open',
	'left-open',
	'right-open',
	'up-open',
	'arrows-cw',
	'play-circled2',
	'to-end-alt',
	'to-start-alt',
	'inbox',
	'font',
	'bold',
	'italic',
	'text-height',
	'text-width',
	'align-left',
	'align-center',
	'align-right',
	'align-justify',
	'list',
	'indent-left',
	'indent-right',
	'off',
	'road',
	'list-alt',
	'qrcode',
	'barcode',
	'ajust',
	'tint',
	'magnet',
	'move',
	'link-ext',
	'check-empty',
	'bookmark-empty',
	'phone-squared',
	'twitter',
	'facebook',
	'github-circled',
	'rss',
	'hdd',
	'certificate',
	'left-circled',
	'right-circled',
	'up-circled',
	'down-circled',
	'tasks',
	'filter',
	'resize-full-alt',
	'beaker',
	'docs',
	'blank',
	'menu',
	'list-bullet',
	'list-numbered',
	'strike',
	'underline',
	'table',
	'magic',
	'pinterest-circled',
	'pinterest-squared',
	'gplus-squared',
	'gplus',
	'columns',
	'sort',
	'sort-down',
	'sort-up',
	'mail-alt',
	'linkedin',
	'gauge',
	'comment-empty',
	'chat-empty',
	'sitemap',
	'paste',
	'lightbulb',
	'exchange',
	'download-cloud',
	'upload-cloud',
	'user-md',
	'stethoscope',
	'suitcase',
	'bell-alt',
	'coffee',
	'food',
	'doc-text',
	'building',
	'hospital',
	'ambulance',
	'medkit',
	'fighter-jet',
	'beer',
	'h-sigh',
	'plus-squared',
	'angle-double-left',
	'angle-double-right',
	'angle-double-up',
	'angle-double-down',
	'angle-left',
	'angle-right',
	'angle-up',
	'angle-down',
	'desktop',
	'laptop',
	'tablet',
	'mobile',
	'circle-empty',
	'quote-left',
	'quote-right',
	'spinner',
	'circle',
	'reply',
	'github',
	'folder-empty',
	'folder-open-empty',
	'plus-squared-small',
	'minus-squared-small',
	'smile',
	'frown',
	'meh',
	'gamepad',
	'keyboard',
	'flag-empty',
	'flag-checkered',
	'terminal',
	'code',
	'reply-all',
	'star-half-alt',
	'direction',
	'crop',
	'fork',
	'unlink',
	'help',
	'info',
	'attention-alt',
	'superscript',
	'subscript',
	'eraser',
	'puzzle',
	'mic',
	'mute',
	'shield',
	'calendar-empty',
	'extinguisher',
	'rocket',
	'maxcdn',
	'angle-circled-left',
	'angle-circled-right',
	'angle-circled-up',
	'angle-circled-down',
	'html5',
	'css3',
	'anchor',
	'lock-open-alt',
	'bullseye',
	'ellipsis',
	'ellipsis-vert',
	'rss-squared',
	'play-circled',
	'ticket',
	'minus-squared-alt',
	'level-up',
	'level-down',
	'ok-squared',
	'pencil-squared',
	'link-ext-alt',
	'export-alt',
	'compass',
	'collapse',
	'collapse-top',
	'expand',
	'euro',
	'pound',
	'dollar',
	'rupee',
	'yen',
	'renminbi',
	'won',
	'bitcoin',
	'doc-inv',
	'doc-text-inv',
	'sort-name-up',
	'sort-name-down',
	'sort-alt-up',
	'sort-alt-down',
	'sort-number-up',
	'sort-number-down',
	'thumbs-up-alt',
	'thumbs-down-alt',
	'youtube-squared',
	'youtube',
	'xing',
	'xing-squared',
	'youtube-play',
	'dropbox',
	'stackoverflow',
	'instagramm',
	'flickr',
	'adn',
	'bitbucket',
	'bitbucket-squared',
	'tumblr',
	'tumblr-squared',
	'down',
	'up',
	'right',
	'left',
	'apple',
	'windows',
	'android',
	'linux',
	'dribbble',
	'skype',
	'foursquare',
	'trello',
	'female',
	'male',
	'gittip',
	'sun',
	'moon',
	'box',
	'bug',
	'vkontakte',
	'weibo',
	'renren',
	'github-squared',
	'twitter-squared',
	'facebook-squared',
	'linkedin-squared',
	'picture',
	'globe',
	'leaf',
	'lemon',
	'glass',
	'gift',
	'videocam',
	'headphones',
	'video',
	'target',
	'award',
	'thumbs-up',
	'thumbs-down',
	'user',
	'users',
	'credit-card',
	'briefcase',
	'floppy',
	'folder',
	'folder-open',
	'doc',
	'calendar',
	'chart-bar',
	'pin',
	'attach',
	'book',
	'phone',
	'megaphone',
	'upload',
	'download',
	'signal',
	'camera',
	'shuffle',
	'volume-off',
	'volume-down',
	'volume-up',
	'search',
	'key',
	'lock',
	'lock-open',
	'bell',
	'bookmark',
	'link',
	'fire',
	'wrench',
	'hammer',
	'clock',
	'truck',
	'block',
	);
	$animations = array( 'flipInX', 'flipInY', 'fadeIn', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUp', 'slideInDown', 'slideInLeft', 'slideInRight', 'rollIn', 'rollOut' ); //,'expand-open','big-entrance','hatch','bounce','pulse','floating','tossing','pull-up','pull-down','stretch-left','stretch-right'),
	$be_shortcode['title_icon'] = array(
		'name' => __('Title with Icon', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'style' =>array(
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array('small','large'),
				'default'=> 'small'
			),
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'circled' =>array(
				'title'=>__('Circled ?','be-themes'),
				'type'=>'checkbox',
				'default'=> 0
			),
			'icon_bg' => array(
				'title'=> __('Background of Icon if circled','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['color_scheme']
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['alt_bg_text_color']
			),
			'image' => array(
				'title'=> __('Upload Custom Icon as Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => ''
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h4',
			),
			'description' =>array(
				'title'=>__('Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),
			'animate' =>array(
				'title'=>__('Animate Block','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'slideInDown',
			),
		)
	);

 	$be_shortcode['team'] = array (
		'name' => __('Team', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title' => array(
				'title' => __('Title', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h3',
			),			
			'description' => array(
				'title' => __('Description', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),			
			'image' => array(
				'title'=> __('Upload Team Member image','be-themes'),
				'type'=>'media',
				'select'=> 'single'
			),
			'designation' => array(
				'title' => __('Designation', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),		
			'facebook' => array(
				'title' => __('Facebook Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'twitter' => array(
				'title' => __('Twitter Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'google_plus' => array(
				'title' => __('Google Plus Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'linkedin' => array(
				'title' => __('Linked In Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'youtube' => array(
				'title' => __('Youtube Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),								
			'dribbble' => array(
				'title' => __('Dribbble Profile Url', 'be-themes'),
				'type' => 'text',
				'default' => __('', 'be-themes')
			),
			'animate' =>array (
				'title'=> __('Animate Block','be-themes'),
				'type'=> 'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'slideInDown',
			),
		)
	);	
	$be_shortcode['portfolio'] = array(
		'name' => __('Portfolio', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array (
			'portfolio_style' => array (
				'title'=> __('Portfolio Style','be-themes'),
				'type'=> 'select',
				'options'=> array (
					array('label' => 'Boxed', 'value' => 'centered'),
					array('label' => 'Full Width with Gutter', 'value' => 'centered2'),
					array('label' => 'Full Width - Edge to Edge', 'value' => 'full-width')
				),
				'default'=> 'centered'
			),
			'portfolio_layout' => array (
				'title'=> __('Porifolio Masonry Layout','be-themes'),
				'type'=> 'select',
				'options'=> array( 'yes', 'no' ),
				'default'=> 'no'
			),
			'portfolio_lightbox' => array (
				'title'=> __('Porifolio Items Enable LightBox','be-themes'),
				'type'=> 'select',
				'options'=> array( 'yes', 'no' ),
				'default'=> 'no'
			),
			'portfolio_show_title' =>array(
				'title'=>__('Porifolio Items Enable Title','be-themes'),
				'type'=>'checkbox',
				'default'=> 1,
			),
			'portfolio_show_cat' =>array(
				'title'=>__('Porifolio Items Enable Categories','be-themes'),
				'type'=>'checkbox',
				'default'=> 1,
			),
			'show_filters' => array (
				'title'=> __('Filterable Portfolio ?','be-themes'),
				'type'=> 'select',
				'options'=> array( 'yes', 'no' ),
				'default'=> 'yes'
			),				
			'filter' =>array(
				'title'=>__('Filter to use ?','be-themes'),
				'type'=>'select',
				'options'=> array('categories','tags'),
				'default'=> 'categories'
			),
			'category' => array(
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),									
			'pagination' =>array (
				'title'=> __( 'Pagination', 'be-themes' ),
				'type'=> 'select',
				'options'=> array( 'loadmore', 'none' ),
				'default'=> 'loadmore'
			),			
			'items_per_page' =>array (
				'title'=> __('Number of Items per page if paginated','be-themes'),
				'type'=> 'number',
				'default'=> '10'
			),
			'overlay_color' => array(
				'title'=> __('Item Overlay Color','be-themes'),
				'type'=>'color',
				'default' => $be_themes_data['color_scheme'],
			),
			'filter_bg' => array(
				'title'=> __('Filter Area Background Color','be-themes'),
				'type'=>'color',
				'default' => $be_themes_data['color_scheme'],
			),
			'filter_color' => array(
				'title'=> __('Filter Area Text Color','be-themes'),
				'type'=>'color',
				'default' => $be_themes_data['alt_bg_text_color'],
			),
			'filter_align' =>array(
				'title'=>__('Filter Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left','center','right'),
				'default'=> 'left'
			),												
		)
	);
	
	$be_shortcode['blog'] = array(
		'name' => __('Blog', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		//'options' => array ()
	);

	$be_shortcode['text'] = array(
		'name' => __('Text Block', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'backend_output'=>true,
		'options' => array(
			'text_block' =>array(
				'title'=>__('Text Block Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),	
			'animate' =>array(
				'title'=>__('Animate Block','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'slideInDown',
			),												
		)
	);

	$be_shortcode['html'] = array (
		'name' => __('Html Block', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'text_block' =>array (
				'title'=>__('Html Block Content','be-themes'),
				'type'=>'textarea',
				'default'=> '',
				'content'=>true
			),	
			'animate' =>array (
				'title'=>__('Animate Block','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array (
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'slideInDown',
			),												
		)
	);	

	$be_shortcode['premium_sliders'] = array(
		'name' => __('Premium Sliders', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'text_block' =>array(
				'title'=>__('Slider Shortcode','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),							
		)
	);		

	$be_shortcode['separator'] = array(
		'name' => __('Divider', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(

			'style' =>array(
				'title'=>__('Choose a divider style','be-themes'),
				'type'=>'select',
				'options'=> array('style-1','style-2'),
				'default'=> 'style-1'
			),
			'color' => array(
				'title'=> __('Color','be-themes'),
				'type'=>'color',
			),								
		)
	);

	$be_shortcode['animated_numbers'] = array(
		'name' => __('Animated Numbers', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'number' => array(
				'title'=> __('Number','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'caption' => array(
				'title'=> __('Caption','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'number_size' => array(
				'title'=> __('Number Size','be-themes'),
				'type'=>'text',
				'default'=> '60'
			),
			'number_color' => array(
				'title'=> __('Number Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),			
			'caption_size' => array(
				'title'=> __('Caption Size','be-themes'),
				'type'=>'text',
				'default'=> '15'
			),	
			'caption_color' => array(
				'title'=> __('Caption Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),																					
		)
	);	

	$be_shortcode['special_heading'] = array(
		'name' => __('Special Title / Heading', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=>true,
		'options' => array(
			'title_content' =>array(
				'title'=>__('Title','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			),			
			'h_tag' =>array(
				'title'=>__('Heading tag to use for Title','be-themes'),
				'type'=>'select',
				'options'=> array('h1','h2','h3','h4','h5','h6'),
				'default'=> 'h3',
			),	
			'color' => array(
				'title'=> __('Separator Color','be-themes'),
				'type'=>'color',
			),						
			'align' =>array(
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left','center'),
				'default'=> 'left'
			),										
		)
	);



	$be_shortcode['video'] = array(
		'name' => __('Video', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'source' =>array(
				'title'=>__('Choose a Video style','be-themes'),
				'type'=>'select',
				'options'=> array('youtube','vimeo'),
				'default'=> 'youtube'
			),
			'url' => array(
				'title'=> __('Enter the video url','be-themes'),
				'type'=>'text',
				'default'=> ''
			)						
		)
	);

	$be_shortcode['notifications'] = array(
		'name' => __('Notifications', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=> true,
		'options' => array(
			'bg_color' =>array(
				'title'=>__('Background Color of Notification box','be-themes'),
				'type'=>'color',
				'default'=> '#00ca98',
			),
			'notice' => array(
				'title'=> __('Notification Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			)						
		)
	);

	// $be_shortcode['dropcap'] = array(
	// 	'name' => __('Dropcaps', 'be-themes'),
	// 	'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
	// 	'type' => 'single',
	// 	'backend_output'=>true,
	// 	'options' => array(
	// 		'letter'=>array(
	// 			'title'=>__('Letter to be Dropcapped','be-themes'),
	// 			'type'=>'text',
	// 			'default'=> ''
	// 		),
	// 		'icon' =>array(
	// 			'title'=>__('Icon to be Dropcapped  - prioritized over letter ','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> $be_font_icons,
	// 			'default'=> 'none'
	// 		),			
	// 		'type' =>array(
	// 			'title'=>__('Dropcap Style','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> array('circle','square','letter'),
	// 			'default'=> 'circle'
	// 		),
	// 		'size' =>array(
	// 			'title'=>__('Dropcap Size','be-themes'),
	// 			'type'=>'select',
	// 			'options'=> array('small','big'),
	// 			'default'=> 'small'
	// 		),
	// 		'color' =>array(
	// 			'title'=>__('Dropcap Color','be-themes'),
	// 			'type'=>'color',
	// 			'default'=> $be_themes_data['color_scheme']
	// 		),						
	// 		'dropcap_content' => array(
	// 			'title'=> __('Dropcap Content','be-themes'),
	// 			'type'=>'tinymce',
	// 			'default'=> '',
	// 			'content'=>true
	// 		)						
	// 	)
	// );						
				


	$be_shortcode['button'] = array(
		'name' => __('Buttons', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'backend_output'=> true,
		'options' => array(
			'button_text' =>array(
				'title'=>__('Button Text','be-themes'),
				'type'=>'text',
				'default'=> ''
			),			
			'type' =>array(
				'title'=>__('Button Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium','large'),
				'default'=> 'small'
			),
			'gradient' =>array(
				'title'=>__('Gradient ?','be-themes'),
				'type'=>'checkbox',
				'default'=> '1'
			),
			'rounded' =>array (
				'title'=>__('Rounded Corners ?','be-themes'),
				'type'=>'checkbox',
				'default'=> '1'
			),
			'alignment' =>array (
				'title'=>__('Alignment','be-themes'),
				'type'=>'select',
				'options'=> array('left', 'right', 'center', 'full-width', 'none'),
				'default'=> 'circle'
			),
			'icon' =>array(
				'title'=>__('Button Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),									
			'color' =>array(
				'title'=>__('Default background Color','be-themes'),
				'type'=>'color',
				'default'=> $be_themes_data['color_scheme']
			),
			'hover' =>array(
				'title'=>__('Hover Background Color','be-themes'),
				'type'=>'color',
				'default'=> '#323232'
			),									
			'url' => array(
				'title'=> __('Button Links to','be-themes'),
				'type'=>'text',
				'default'=> 'http://www.mojo-themes.com'
			)						
		)
	);

	$be_shortcode['skills'] = array(
		'name' => __('Skills Bar', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'skill'		
	);

	$be_shortcode['skill'] = array(
		'name' => __('Skill', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',
		'options' => array(
			'title' => array(
				'title'=> __('Skill Name','be-themes'),
				'type'=>'text',
			),
			'value' => array(
				'title'=> __('Skill Score in %','be-themes'),
				'type'=>'text',
				'default'=>'50',
			), 							
		)		
	);
	       

	$be_shortcode['tabs'] = array(
		'name' => __('Tabs', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'tab'		
	);

	$be_shortcode['tab'] = array(
		'name' => __('Tab', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'title' => array(
				'title'=> __('Tab Title','be-themes'),
				'type'=>'text'
			),
			'icon' => array(
				'title'=> __('Choose an icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons  //array('none','twitter','facebook'),	
			),
			'tab_content' => array(
				'title'=> __('Tab Content','be-themes'),
				'type'=>'tinymce',
				'default'=>'',
				'content'=>true
			), 							
		)		
	);	

	$be_shortcode['accordion'] = array(
		'name' => __('Accordion', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'toggle',		
	);

	$be_shortcode['toggle'] = array(
		'name' => __('Toggle', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',
		'options' => array(
			'title' => array(
				'title'=> __('Accordion Title','be-themes'),
				'type'=>'text'
			),
			'accordion_content' => array(
				'title'=> __('Accordion Content','be-themes'),
				'type'=>'tinymce',
				'default'=>'',
				'content'=>true
			)								
		)		
	);



	$be_shortcode['lists'] = array(
		'name' => __('Custom Lists', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'list'		
	);

	$be_shortcode['list'] = array(
		'name' => __('Custom List Item', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',
		'options' => array(
			'icon' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'circled' =>array(
				'title'=>__('Circled ?','be-themes'),
				'type'=>'checkbox',
				'default'=> 0
			),
			'icon_bg' => array(
				'title'=> __('Background of Icon if circled','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['color_scheme']
			),
			'icon_color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['alt_bg_text_color']
			),
			'list_content' =>array(
				'title'=>__('Content','be-themes'),
				'type'=>'tinymce',
				'default'=> '',
				'content'=>true
			)																							
		)
	);		



	$be_shortcode['flex_slider'] = array(
		'name' => __('Flex Slider', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'flex_slide',
		'options' => array(
			'animation' => array(
				'title'=> __('Animation style','be-themes'),
				'type'=>'select',
				'options' => array('slide','fade'),
				'default'=>'slide'
			),
			'auto_slide' => array(
				'title'=> __('Auto Slide','be-themes'),
				'type'=>'select',
				'options' => array('yes','no'),
				'default'=>'no'
			),
			'slide_interval' => array(
				'title'=> __('Slide Interval in milli secs if auto slide is enabled','be-themes'),
				'type'=>'text',
			)					
		)		
	);

	$be_shortcode['flex_slide'] = array(
		'name' => __('Slide', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a slider image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'video' => array(
				'title'=> __('Enter Youtube/ Vimeo url if you wish to have video in the slide','be-themes'),
				'type'=>'text',
			),
			'show_title' => array(
				'title'=> __('Show Title ?','be-themes'),
				'type'=>'select',
				'options'=>array('yes','no'),
				'default'=>'no'	
			),
			'show_caption' => array(
				'title'=> __('Show Caption ?','be-themes'),
				'type'=>'select',
				'options'=>array('yes','no'),
				'default'=>'no'		
			), 				
			'title' => array(
				'title'=> __('Title','be-themes'),
				'type'=>'text',
			),
			'caption' => array(
				'title'=> __('Caption','be-themes'),
				'type'=>'text',
			)										
		)		
	);

	$be_shortcode['testimonials'] = array(
		'name' => __('Testimonials', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'testimonial',
		'options' => array(
			'animation' => array(
				'title'=> __('Animation style','be-themes'),
				'type'=>'select',
				'options' => array('slide','fade'),
				'default'=>'fade'
			),
			'slide_interval' => array(
				'title'=> __('Slide Interval in milli secs if auto slide is enabled','be-themes'),
				'type'=>'text',
			)				
		)		
	);
	
	$be_shortcode['testimonial'] = array(
		'name' => __('Testimonial', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a Testimonial Author image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),				
			'author' => array(
				'title'=> __('Author','be-themes'),
				'type'=>'text',
			),
			'company' => array(
				'title'=> __('Company','be-themes'),
				'type'=>'text',
			),
			'description' => array(
				'title'=> __('Testimonial Content','be-themes'),
				'type'=>'tinymce',
				'content'=> true,
			)										
		)		
	);

	$be_shortcode['project_details'] = array(
		'name' => __('Portfolio Details', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single'
	);

	$be_shortcode['linebreak'] = array(
		'name' => __('Extra Spacing', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',
		'options' => array(
			'height' => array(
				'title'=> __('Height of blank space (only numbers)','be-themes'),
				'type'=>'text',
				'default'=>'',
			)
		)			
	);	 



	$be_shortcode['section'] = array(
		'name' => __('Section Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'bg_color' => array(
				'title'=> __('Background Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),			
			'bg_image' => array(
				'title'=> __('Background Image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'bg_repeat' => array(
				'title'=> __('Background Repeat','be-themes'),
				'type'=>'select',
				'options'=>array('repeat','repeat-x','four','repeat-y', 'no-repeat'),
				'default'=>'repeat'
			),
			'bg_attachment' => array(
				'title'=> __('Background Attachment','be-themes'),
				'type'=>'select',
				'options'=>array('scroll','fixed'),
				'default'=>'scroll'
			),
			'bg_position' => array(
				'title'=> __('Background Position','be-themes'),
				'type'=>'select',
				'options'=>array('top left','top top right','top center', 'center left', 'center right', 'center center','bottom left','bottom right','bottom center'),
				'default'=>'top left'
			),
			'bg_stretch' =>array(
				'title'=>__('Center Scale Image to occupy container','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'bg_parallax' =>array(
				'title'=>__('Parallax Effect on Section','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),									
			'border_size' => array(
				'title'=> __('Border Size (only numbers)','be-themes'),
				'type'=>'text',
				'default'=> '1'
			),
			'border_color' => array(
				'title'=> __('Border Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'padding_top' => array(
				'title'=> __('Top Padding','be-themes'),
				'type'=>'text',
				'default'=> '50'
			),
			'padding_bottom' => array(
				'title'=> __('Bottom Padding','be-themes'),
				'type'=>'text',
				'default'=> '50'
			),
			'bg_video' =>array(
				'title'=>__('Enable background Video','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),				
			'bg_video_mp4_src' => array(
				'title'=> __('Mp4 Video File','be-themes'),
				'type'=>'text',
				'default'=> ''
			),
			'bg_overlay' =>array(
				'title'=>__('Enable Background Overlay','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'overlay_color' => array(
				'title'=> __('Background Overlay Color','be-themes'),
				'type'=>'color',
				'default'=>''
			),
			'overlay_opacity' => array(
				'title'=> __('Background Overlay Opacity','be-themes'),
				'type'=>'text',
				'default'=> ''
			),		
			'section_id' => array(
				'title'=> __('Section Id','be-themes'),
				'type'=> 'text',
				'default'=> ''
			),
		)
	);	

	$be_shortcode['row'] = array(
		'name' => __('Row Settings', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'no_wrapper' =>array(
				'title'=>__('No Wrap ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),
			'no_margin_bottom' =>array(
				'title'=>__('Zero Bottom Margin ?','be-themes'),
				'type'=>'checkbox',
				'default'=> ''
			),					
		)
	);



	$be_shortcode['gmaps'] = array(
		'name' => __('Google Map', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'address' => array(
				'title'=> __('Address','be-themes'),
				'type'=>'text',
				'default'=>'',
			),
			'height' => array(
				'title'=> __('Height in px (only numbers)','be-themes'),
				'type'=>'text',
				'default'=>'300',
			),
			'zoom' => array(
				'title'=> __('Zoom value','be-themes'),
				'type'=>'text',
				'default'=>'20',
			),															
		)
	);

	$be_shortcode['icon'] = array(
		'name' => __('Font Icons', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'name' =>array(
				'title'=>__('Icon','be-themes'),
				'type'=>'select',
				'options'=> $be_font_icons,
				'default'=> 'none'
			),
			'size' =>array(
				'title'=>__('Size','be-themes'),
				'type'=>'select',
				'options'=> array('small','medium','large'),
				'default'=> 'small',
			),			
			'style' =>array(
				'title'=>__('Style','be-themes'),
				'type'=>'select',
				'options'=> array('rounded','square','circle', 'plain'),
				'default'=> 'plain',
			),
			'color' => array(
				'title'=> __('Icon Color','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['alt_bg_text_color'],
			),			
			'bg_color' => array(
				'title'=> __('Background of Icon if circled/ Square / Rounded','be-themes'),
				'type'=>'color',
				'default'=>$be_themes_data['color_scheme'],
			),
			'hover_color' => array(
				'title'=> __('Icon Color during Mouse Over','be-themes'),
				'type'=>'color',
				'default'=>'#ffffff',
			),			
			'hover_bg_color' => array(
				'title'=> __('Background Color of Icon during hover','be-themes'),
				'type'=>'color',
				'default'=>'#3a3a3a',
			),
			'href' => array(
				'title'=> __('Icon Link URL','be-themes'),
				'type'=>'text',
				'default'=>'',
			),	
			'align_center' =>array(
				'title'=>__('Center Align the Font Icon','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animate' =>array(
				'title'=>__('Animate Block','be-themes'),
				'type'=>'checkbox',
				'default'=> '',
			),
			'animation_type' =>array(
				'title'=>__('Animation Type','be-themes'),
				'type'=>'select',
				'options'=> $animations,
				'default'=> 'slideInDown',
			),
		)
	);	

	$be_shortcode['lightbox_image'] = array(
		'name' => __('Lightbox Image', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'single',			
		'options' => array(
			'image' => array(
				'title'=> __('Choose a thumbnail image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),							
		)		
	);

	$be_shortcode['clients'] = array(
		'name' => __('Clients', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi',
		'multi_field'=> true,
		'single_field'=>'client',
		'options' => array(
			'col' =>array(
				'title'=>__('Portfolio Columns','be-themes'),
				'type'=>'select',
				'options'=> array('five', 'four', 'three'),
				'default'=> 'five'
			),
			'dir_nav_bg_color' => array(
				'title'=> __('Navigation - Active State Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'dir_nav_bg_hover_color' => array(
				'title'=> __('Navigation - Hover State Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			)
		)
	);	

	$be_shortcode['client'] = array(
		'name' => __('Client', 'be-themes'),
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'type' => 'multi_single',			
		'options' => array(
			'image' => array(
				'title'=> __('Select Client image','be-themes'),
				'type'=>'media',
				'default'=>'',
				'select' => 'single'
			),
			'link' => array(
				'title'=> __('Client Website URL','be-themes'),
				'type'=>'text',
			),
			'new_tab' => array(
				'title'=> __('Open URL in New tab','be-themes'),
				'type'=>'select',
				'options'=>array('yes','no'),
				'default'=>'yes'
			)									
		)		
	);
	
	$be_shortcode['portfolio_carousel'] = array(
		'name' => __('Portfolio Carousel', 'be-themes'),
		'type' => 'single',
		'icon' => BE_PAGE_BUILDER_URL.'/images/shortcodes/icon.png',
		'options' => array(
			'col' =>array(
				'title'=>__('Portfolio Columns','be-themes'),
				'type'=>'select',
				'options'=> array('five', 'four', 'three'),
				'default'=> 'five'
			),
			'category' => array(
				'title'=> __('Portfolio Categories','be-themes'),
				'type'=>'taxo',
				'taxonomy'=> 'portfolio_categories'
			),
			'items_per_page' =>array(
				'title'=>__('Items per Page','be-themes'),
				'type'=>'text',
				'default'=> '12'
			),
			'portfolio_lightbox' => array (
				'title'=> __('Porifolio Items Enable LightBox','be-themes'),
				'type'=> 'select',
				'options'=> array( 'yes', 'no' ),
				'default'=> 'no'
			),
			'dir_nav_bg_color' => array(
				'title'=> __('Navigation - Active State Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'dir_nav_bg_hover_color' => array(
				'title'=> __('Navigation - Hover State Color','be-themes'),
				'type'=>'color',
				'default'=> '',
			),
			'portfolio_lightbox' => array (
				'title'=> __('Porifolio Items Enable LightBox','be-themes'),
				'type'=> 'select',
				'options'=> array( 'yes', 'no' ),
				'default'=> 'no'
			),
			'portfolio_show_title' =>array(
				'title'=>__('Porifolio Items Enable Title','be-themes'),
				'type'=>'checkbox',
				'default'=> 1,
			),
			'portfolio_show_cat' =>array(
				'title'=>__('Porifolio Items Enable Categories','be-themes'),
				'type'=>'checkbox',
				'default'=> 1,
			),
		)
	);
}

?>