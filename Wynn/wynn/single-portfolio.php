<?php
/*
 *  The template for displaying a Portfolio Item.
*/
get_header(); 
while (have_posts() ) : the_post();
	$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
	if($single_portfolio_style) {
		get_template_part( 'portfolio/single', $single_portfolio_style );
	} else {
		get_template_part( 'portfolio/single', 'normal' );
	}
endwhile;
get_footer();
?>