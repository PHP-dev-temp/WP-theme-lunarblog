<?php

/*
 * =======================================
 *                ADMIN PAGE
 * ========================================
 */

//----------------------------------------------------------------//

function lunar_add_admin_page() {

    // Generate Admin page and show it in menu
    add_menu_page('Lunar', 'Lunar-blog', 'manage_options', 'lunar_blog_general', 'lunar_theme_create_page',
        get_template_directory_uri() . '/images/l-icon.png', 110);

    // Generate Admin sub pages  and show it in menu
    add_submenu_page( 'lunar_blog_general', 'Lunar Theme Options', 'General', 'manage_options', 'lunar_blog_general',
        'lunar_theme_create_page' );
    add_submenu_page( 'lunar_blog_general', 'Lunar CSS Options', 'Custom CSS', 'manage_options', 'lunar_blog_css',
        'lunar_theme_settings_page');
}

function lunar_theme_create_page() {
    // Template for Admin General page and show it in menu
    include_once(get_template_directory() . '/inc/templates/lunar-admin.php');
}

function lunar_theme_settings_page() {
    // Template for Admin Custom CSS page and show it in menu
    echo '<h1>Sunset Custom CSS</h1>';
}

// Generate Admin page/sub pages when create menu
add_action('admin_menu', 'lunar_add_admin_page');

//----------------------------------------------------------------//

function lunar_custom_settings() {
    // Generate fields on admin setting page
    register_setting('lunar-settings-group', 'first_name');
    register_setting('lunar-settings-group', 'last_name');

    // Added sanitize function for twitter input: lunar_sanitize_twitter_handler.
    register_setting('lunar-settings-group', 'twitter_handler', 'lunar_sanitize_twitter_handler');
    register_setting('lunar-settings-group', 'facebook_handler');
    register_setting('lunar-settings-group', 'google_plus_handler');

    // Generate section, witch we call in template to show fields
    add_settings_section('lunar-sidebar-options', 'Sidebar Options', 'lunar_sidebar_options', 'lunar_blog_general');

    // Add/show fields
    add_settings_field('sidebar_name', 'Full Name', 'lunar_sidebar_name', 'lunar_blog_general', 'lunar-sidebar-options');
    add_settings_field('sidebar_twitter', 'Twitter handler', 'lunar_sidebar_twitter', 'lunar_blog_general',
        'lunar-sidebar-options');
    add_settings_field('sidebar_facebook', 'Facebook handler', 'lunar_sidebar_facebook', 'lunar_blog_general',
        'lunar-sidebar-options');
    add_settings_field('sidebar_google_plus', 'Google plus handler', 'lunar_sidebar_google_plus', 'lunar_blog_general',
        'lunar-sidebar-options');
}

// Generate name fields
function lunar_sidebar_name() {
    $firstName = get_option('first_name');
    $lastName = get_option('last_name');
    echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="First Name"/>';
    echo '<input type="text" name="last_name" value="' . $lastName . '" placeholder="Last Name"/>';
}

// Generate twitter field
function lunar_sidebar_twitter() {
    $twitter = get_option('twitter_handler');
    echo '<input type="text" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter handler"/>';
    echo '<p class="description">Input your Twitter username without the @ character</p>';
}

// Sanitize twitter_handler value
function lunar_sanitize_twitter_handler($input) {
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}

// Generate facebook field
function lunar_sidebar_facebook() {
    $fb = get_option('facebook_handler');
    echo '<input type="text" name="facebook_handler" value="' . $fb . '" placeholder="Facebook handler"/>';
}

// Generate google plus field
function lunar_sidebar_google_plus() {
    $gplus = get_option('google_plus_handler');
    echo '<input type="text" name="google_plus_handler" value="' . $gplus . '" placeholder="Google Plus handler"/>';
}

function lunar_sidebar_options() {
    echo 'Customize your Theme Settings!';
}

// Activate custom settings and all on admin pages
add_action('admin_menu', 'lunar_custom_settings');
