<?php 
require_once( get_template_directory() .'/functions/custom-post-types/PostType.php' );
/**************************
		PORTFOLIO
**************************/
//Create Post Type
$portfolio = Create_Custom_Post_Type( 'portfolio' );
//Add Categories Style Taxonomy
$portfolio->Add_Categories_Style_Taxonomy( 'portfolio_categories' );
//Add Tags Style Taxonomy
$portfolio->Add_Tags_Style_Taxonomy( 'portfolio_tags' );
?>