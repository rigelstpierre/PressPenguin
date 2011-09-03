<?php
add_action( 'after_setup_theme', 'lps_theme_setup' );
add_filter('body_class','expand_body_classes'); // Adds page slug to the body class

include_once 'includes/excerpts.php'; // Custom Excerpts
include_once 'includes/scripts.php'; // Enqued Scripts
include_once 'includes/custom_field_functions.php'; // Functions for including/processing content from custom fields. See Readme for usage.
/* Uncomment to create custom post types and custom taxonomies
	include_once 'includes/post_types.php'; // Template for creating custom post types and custom taxonomies
*/

function lps_theme_setup() {
	
	global $content_width;
	/* Set the $content_width for things such as video embeds. */
	if ( !isset( $content_width ) )
		$content_width = 600;

	add_action( 'init', 'lps_load_scripts');
	add_action( 'init', 'lps_register_menus' );
	add_action( 'widgets_init', 'lps_register_sidebars' );
	add_filter( 'stylesheet_uri','wpi_stylesheet_uri',10,2);
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails');
	//add_image_size( 'name', width, hight, crop);
}

function wpi_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri){
    return $stylesheet_dir_uri.'/css/style.css';
	}

function lps_register_menus() {
	register_nav_menus(array('primary'=>__('Primary Nav'),));
}

function lps_register_sidebars() {
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary Sidebar' ),
			'description' => __( 'The following widgets will appear in the main sidebar div.' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		)
	);
}

function post_meta() {
	include 'includes/meta.php';
}


// Add page slug as body class. Also include the page parent
function expand_body_classes($classes, $class='') {
	global $wp_query;	
	$post_id = $wp_query->post->ID;
	if(is_page($post_id )){
		$page = get_page($post_id);
		//check for parent
		if($page->post_parent>0){
			$parent = get_page($page->post_parent);
			$classes[] = sanitize_title($parent->post_title);
		}
		$classes[] = sanitize_title($page->post_title);
	}
	return $classes;// return the $classes array
}


// Clean up <head> and improve security.
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');

?>