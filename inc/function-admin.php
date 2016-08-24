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
    add_submenu_page( 'lunar_blog_general', 'Lunar Theme Options', 'Theme Options', 'manage_options', 'my_lunar_theme',
        'lunar_theme_support_page');
    add_submenu_page( 'lunar_blog_general', 'Lunar Contact Form', 'Contact Form', 'manage_options', 'lunar_theme_contact',
        'lunar_contact_form_page');
    add_submenu_page( 'lunar_blog_general', 'Lunar CSS Options', 'Custom CSS', 'manage_options', 'lunar_blog_css',
        'lunar_theme_settings_page');
}

function lunar_contact_form_page() {
    // Template for theme Contact page settings and show it in menu
    include_once(get_template_directory() . '/inc/templates/lunar-theme-contact-form.php');
}

function lunar_theme_support_page() {
    // Template for Admin General page and show it in menu
    include_once(get_template_directory() . '/inc/templates/lunar-theme-support.php');
}

function lunar_theme_create_page() {
    // Template for Admin General page and show it in menu
    include_once(get_template_directory() . '/inc/templates/lunar-admin.php');
}

function lunar_theme_settings_page() {
    // Template for Admin Custom CSS page and show it in menu
    include_once(get_template_directory() . '/inc/templates/lunar-theme-custom-css.php');
}

// Generate Admin page/sub pages when create menu
add_action('admin_menu', 'lunar_add_admin_page');

//----------------------------------------------------------------//

function lunar_custom_settings() {

    // Generate fields on admin setting page
    register_setting('lunar-settings-group', 'profile_picture');
    register_setting('lunar-settings-group', 'first_name');
    register_setting('lunar-settings-group', 'last_name');
    register_setting('lunar-settings-group', 'user_description');
    // Added sanitize function for twitter input: lunar_sanitize_twitter_handler.
    register_setting('lunar-settings-group', 'twitter_handler', 'lunar_sanitize_twitter_handler');
    register_setting('lunar-settings-group', 'facebook_handler');
    register_setting('lunar-settings-group', 'google_plus_handler');

    // Generate section, witch we call in template to show fields
    add_settings_section('lunar-sidebar-options', 'Sidebar Options', 'lunar_sidebar_options', 'lunar_blog_general');

    // Add/show fields
    add_settings_field('sidebar-profile-picture', 'Profile Picture', 'lunar_sidebar_profile', 'lunar_blog_general', 'lunar-sidebar-options');
    add_settings_field('sidebar_name', 'Full Name', 'lunar_sidebar_name', 'lunar_blog_general', 'lunar-sidebar-options');
    add_settings_field('sidebar_description', 'User Description', 'lunar_sidebar_description', 'lunar_blog_general', 'lunar-sidebar-options');
    add_settings_field('sidebar_twitter', 'Twitter Handler', 'lunar_sidebar_twitter', 'lunar_blog_general',
        'lunar-sidebar-options');
    add_settings_field('sidebar_facebook', 'Facebook Handler', 'lunar_sidebar_facebook', 'lunar_blog_general',
        'lunar-sidebar-options');
    add_settings_field('sidebar_google_plus', 'Google Plus Handler', 'lunar_sidebar_google_plus', 'lunar_blog_general',
        'lunar-sidebar-options');


    // Theme Support Options
    register_setting('lunar-theme-support', 'post_formats');
    register_setting('lunar-theme-support', 'custom_header');
    register_setting('lunar-theme-support', 'custom_background');

    add_settings_section('lunar-theme-options', 'Theme Options', 'lunar_theme_options', 'my_lunar_theme');

    add_settings_field('post-formats', 'Post Formats', 'lunar_post_formats', 'my_lunar_theme', 'lunar-theme-options');
    add_settings_field('custom-header', 'Custom Header', 'lunar_custom_header', 'my_lunar_theme', 'lunar-theme-options');
    add_settings_field('custom-background', 'Custom Background', 'lunar_custom_background', 'my_lunar_theme', 'lunar-theme-options');

    // Theme contact form settings
    register_setting('lunar-theme-contact', 'activate_contact');
    add_settings_section('lunar-theme-contact-section', 'Contact Form', 'lunar_theme_contact_section', 'lunar_theme_contact');
    add_settings_field('activate-form', 'Activate Contact Form', 'lunar_activate_contact', 'lunar_theme_contact', 'lunar-theme-contact-section');

    //Custom CSS Options
    register_setting('lunar-custom-css-options', 'lunar_css', 'lunar_sanitize_custom_css');
    add_settings_section('lunar-custom-css-section', 'Custom CSS', 'lunar_custom_css_section_callback', 'lunar_blog_css');
    add_settings_field('custom-css', 'Insert your Custom CSS', 'lunar_custom_css_callback', 'lunar_blog_css', 'lunar-custom-css-section');
}

// Custom CSS text area
function lunar_custom_css_callback() {
    $css = get_option( 'lunar_css' );
    $css = empty($css) ? '/* Lunar Theme Custom CSS */' : $css;
    echo '<div id="customCss">'.$css.'</div><textarea id="lunar_css" name="lunar_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}

// Activate Contact form checkbox
function lunar_activate_contact() {
    $options = get_option('activate_contact');
    $checked = (@$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /></label>';
}

// Generate post formats checkboxes
function lunar_post_formats() {
    $options = get_option( 'post_formats' );
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach ( $formats as $format ){
        $checked = (@$options[$format] == 1 ? 'checked' : '');
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
    }
    echo $output;
}

// Generate custom header checkbox
function lunar_custom_header() {
    $options = get_option('custom_header');
    $checked = (@$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}

// Generate custom background checkbox
function lunar_custom_background() {
    $options = get_option('custom_background');
    $checked = (@$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}

// Generate name fields
function lunar_sidebar_profile() {
    $picture = get_option('profile_picture');	
	if(empty($picture)){
		echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button">';
		echo '<input type="hidden" id="profile-picture" name="profile_picture" value=""/>';
	} else {
		echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button">';
		echo '<input type="hidden" id="profile-picture" name="profile_picture" value="' . $picture . '"/>';	
		echo '<input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
	}
    
}

// Generate name fields
function lunar_sidebar_name() {
    $firstName = get_option('first_name');
    $lastName = get_option('last_name');
    echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="First Name"/>';
    echo '<input type="text" name="last_name" value="' . $lastName . '" placeholder="Last Name"/>';
}

// Generate description fields
function lunar_sidebar_description() {
    $userDescription = get_option('user_description');
    echo '<input type="text" name="user_description" value="' . $userDescription . '" placeholder="User description"/>';
    echo '<p class="description">Write something smart</p>';
}

// Generate twitter field
function lunar_sidebar_twitter() {
    $twitter = get_option('twitter_handler');
    echo '<input type="text" name="twitter_handler" value="' . $twitter . '" placeholder="Twitter handler"/>';
    echo '<p class="description">Input your Twitter username without the @ character</p>';
}

// Sanitize css text area
function lunar_sanitize_custom_css( $input ){
    $output = esc_textarea( $input );
    return $output;
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

// Sections callback functions
function lunar_custom_css_section_callback() {
    echo 'Customize Lunar Theme with your own CSS';
}

function lunar_theme_contact_section() {
    echo 'Activate and Deactivate the Built-in Contact Form';
}

function lunar_theme_options() {
    echo 'Activate and Deactivate specific Theme Support Options';
}

function lunar_sidebar_options() {
    echo 'Customize your Theme Settings!';
}

// Activate custom settings and all on admin pages
add_action('admin_menu', 'lunar_custom_settings');
