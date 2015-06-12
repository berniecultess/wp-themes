<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->

<?php global $Zoo_Options; ?>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta http-equiv="X-UA-Compatible" content="IE=100" >
<meta content="initial-scale=1.0, width=device-width" name="viewport">
<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php $Zoo_Options->show('zo_favicon'); ?>" type="image/x-icon" />

<?php wp_head() ?>

</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>
	<nav id="primary-nav">
	    <div id="topbar">
			<span id="active-bar"></span>
		</div> 
	    <!--Navigation-->
	    <div class="mainnav mainnavhide">
	        <div class="innernav" >
		        <div class="grid">
		            <div class="row">
						<div class="mainLogo"><a href="<?php echo get_home_url(); ?>"><img id="mainLogo" alt="" src="<?php $Zoo_Options->show('1'); ?>"/></a></div>
						<span id="menubutton"></span>
						<?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'walker'=> new single_page_walker,
                                'container' => false,
                                'items_wrap' => '<ul class="nav-links">%3$s</ul>',
                                'fallback_cb' => 'default_menu_cb'
                            )
                        );

						?>
						
					</div> 
				</div>
			</div>	
		</div>
	</nav>	


