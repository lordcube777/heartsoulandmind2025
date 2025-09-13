<?php
function my_post_queries ( $query ) {
	// do not alter the query on wp-admin pages and only alter it if it's the main query
	if ( !is_admin() && $query->is_main_query() ) {
		if( is_home() || is_archive() ){
			$query->set( 'posts_per_page', 10 );
		}
		if ( is_author() ) {
			$query->set( 'posts_per_page', 5 );
		}
	}
}
add_action( 'pre_get_posts', 'my_post_queries' );
