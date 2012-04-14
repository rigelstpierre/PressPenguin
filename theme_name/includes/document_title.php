<?php 
	function document_title()
	{
		if ( is_home() || is_front_page() ) {
			bloginfo( 'name' );
			if( get_bloginfo( 'description' ) )
				echo ' | ' ; bloginfo( 'description' );
			} elseif (is_404()) {
			_e('404 Not Found');
			} elseif (is_category()) {
			_e('Category:'); wp_title('');
			} elseif (is_search()) {
			_e('Search Results');
			} elseif ( is_day() || is_month() || is_year() ) {
			_e('Archives:'); wp_title('');
			} else {
			echo wp_title(''); 	echo ' | ' ; bloginfo( 'name' );
		}
	}
?>