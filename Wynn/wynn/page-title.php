<?php 
if(is_category()){
	echo __('Category: ','be-themes').single_cat_title( '', false );
}  elseif(is_tag()){
	echo __('Articles Tagged with: ','be-themes').single_tag_title( '', false );
} elseif (is_search()) {
	echo __('Search Results for: ','be-themes').get_search_query();
}  elseif(is_archive()){
	if ( is_day() ) :
		printf( __( 'Daily Archives: <span>%s</span>', 'be-themes' ), get_the_date() ); 
	elseif ( is_month() ) :
		printf( __( 'Monthly Archives: <span>%s</span>', 'be-themes' ), get_the_date( 'F Y' ) ); 
	elseif ( is_year() ) : 
		printf( __( 'Yearly Archives: <span>%s</span>', 'be-themes' ), get_the_date( 'Y' ) ); 
	else : 
		_e( 'Blog Archives', 'be-themes' );
	endif; 
} else {
	the_title();
}  
?>