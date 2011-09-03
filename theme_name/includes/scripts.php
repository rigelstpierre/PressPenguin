<?php
	function lps_load_scripts() {
		wp_enqueue_script('basic', get_bloginfo('template_directory').'/js/main.js', array('jquery'), '1.0');
		wp_enqueue_script('modernizr', get_bloginfo('template_directory').'/js/modernizr-2.0.6.js', array('jquery'), '1.0');

		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"), false);
			wp_enqueue_script('jquery');
			}

		if ( is_singular() && get_option( 'thread_comments' ) && comments_open() )
			wp_enqueue_script( 'comment-reply' );	
	}
?>