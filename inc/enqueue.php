<?php

/*
 * =======================================
 *          ADMIN ENQUEUE FUNCTIONS
 * ========================================
 */

//----------------------------------------------------------------//

// Load css for admin page
function lunar_load_admin_scripts($hook){
	//echo $hook;
	if('toplevel_page_lunar_blog_general' == $hook) {

		wp_register_style( 'lunar_admin', get_template_directory_uri() . '/css/lunar.admin.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'lunar_admin' );

		wp_enqueue_media();

		wp_register_script('lunar-admin-script', get_template_directory_uri() . '/js/lunar.admin.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('lunar-admin-script');
		return;
	} else if('lunar-blog_page_lunar_blog_css' == $hook) {
		wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/lunar.ace.css', array(), '1.0.0', 'all' );
		wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
		wp_enqueue_script( 'sunset-custom-css-script', get_template_directory_uri() . '/js/lunar.custom_css.js', array('jquery'), '1.0.0', true );
	} else {return;}
	
}
add_action('admin_enqueue_scripts', 'lunar_load_admin_scripts');


/*
 * =======================================
 *          THEME ENQUEUE FUNCTIONS
 * ========================================
 */

//----------------------------------------------------------------//

function lunar_load_scripts() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all');
	wp_enqueue_style('lunar', get_template_directory_uri() . '/css/lunar.css', array(), '1.0.0', 'all');

	wp_deregister_script( 'jquery' );
	wp_register_script('jquery' , get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true);
	wp_enqueue_script('jquery' );
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);

}
add_action( 'wp_enqueue_scripts', 'lunar_load_scripts' );