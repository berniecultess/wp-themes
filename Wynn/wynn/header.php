<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> 
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	<![endif]-->

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<?php
	global $be_themes_data; // Get Backend Options
		if($be_themes_data['favicon']) {
			echo '<link rel="icon" type="image/png" href="'.$be_themes_data['favicon'].'">';
		}
	?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>">

    <?php 
    	if ( is_singular() ) { 
    		wp_enqueue_script( 'comment-reply' );
    	}
    	wp_head(); 
    ?>
</head>

<body <?php body_class(); ?> id="body">
	<header id="header">
		<?php be_language_switcher(); ?>
		<div id="header-wrap">
			<div id="logo-nav-wrap" class="clearfix">
				<?php 
					$logo = get_template_directory_uri().'/img/logo.png';
					if( ! empty( $be_themes_data['logo'] ) ) {
						$logo = $be_themes_data['logo'];
					}  
				?>
				<div id="logo" class="clearfix">
					<div class="relative-position clearfix">
						<a href="<?php echo site_url(); ?>/" class="logo-link"> <img src="<?php echo $logo; ?>" alt="" /></a>
						<div class="right mobile-menu-controller"><i class="font-icon icon-menu"></i></div>
					</div>
				</div> <!-- END LOGO -->

				<nav id="navigation" class="clearfix main-menu">	
				<?php $defaults = array(
						'theme_location'=>'main_nav',
						'depth'=>3,
						'container_class'=>'menu',
						'menu_id' => 'menu',
						'menu_class' => '',
						'walker' => new My_Walker_Nav_Menu()
					);
					if ( has_nav_menu( 'main_nav' ) ) {
						wp_nav_menu( $defaults );
					} else {
						wp_page_menu();
					}				
				?>
				</nav><!-- End Navigation -->
			</div>
			<?php if( !empty( $be_themes_data['header_layout'] ) && 'left-header' == $be_themes_data['header_layout'] ) { ?>
			<div id="header-bottom">
				<p> <?php echo $be_themes_data['copyright_text']; ?> </p>
				<?php be_themes_social_icons(); ?>
			</div> <!--  End Header Bottom -->
			<?php } ?>
		</div> <!--  End Header Wrap -->
	</header> <!-- END HEADER -->
	<div id="main">
		<div class="ajaxable" id="replace-ajaxable">
		<?php
		if ( is_home() || is_category() || is_tag() || is_archive() || is_search() || is_singular('post') ) {
			if($be_themes_data['blog_layout'] != 'traditional') {
				get_sidebar();
			}
		} else {
			$show_widgets = get_post_meta(get_the_ID(),'be_themes_show_widgets',true);
			if( is_page_template('portfolio.php') ) {
				$portfolio_style = get_post_meta(get_the_ID(),'be_themes_portfolio_style',true);
				if ( ($portfolio_style != 'horizontal' && $portfolio_style != 'vertical') ) {
					get_template_part( 'portfolio/portfolio', 'filter' );
				}
			}
			else if ( function_exists('is_woocommerce') && is_woocommerce() ) {	
				$show_widgets = get_post_meta(get_option('woocommerce_shop_page_id'),'be_themes_show_widgets',true);
				if( ( isset($show_widgets) && $show_widgets == 'yes' ) ) {
					get_sidebar();
				}	
			}
			else if( !is_singular('portfolio') ) {
				if( ( isset($show_widgets) && $show_widgets == 'yes' ) ) {
					get_sidebar();
				}
			}
		}
		?>