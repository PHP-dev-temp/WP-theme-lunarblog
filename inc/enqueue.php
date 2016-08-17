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
	if('toplevel_page_lunar_blog_general' != $hook){return;}
	
	wp_register_style( 'lunar_admin', get_template_directory_uri() . '/css/lunar.admin.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'lunar_admin' );

	wp_enqueue_media();

	wp_register_script('lunar-admin-script', get_template_directory_uri() . '/js/lunar.admin.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('lunar-admin-script');
	
}
add_action('admin_enqueue_scripts', 'lunar_load_admin_scripts');