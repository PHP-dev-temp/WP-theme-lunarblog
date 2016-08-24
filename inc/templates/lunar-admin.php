<h1>Lunar Theme Options</h1>
<?php settings_errors(); ?>
<?php

$picture = esc_attr(get_option('profile_picture'));
$firstName = esc_attr(get_option('first_name'));
$lastName = esc_attr(get_option('last_name'));
$fullName = $firstName . ' ' . $lastName;
$description = esc_attr(get_option('user_description'));

?>
<div class="lunar-sidebar-preview">
    <div class="lunar-sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
        </div>
        <h1 class="lunar-username"><?php print $fullName; ?></h1>
        <h2 class="lunar-description"><?php print $description; ?></h2>
        <div class="icons-wrapper">

        </div>
    </div>
</div>
<form method="post" action="options.php" class="lunar-general-form">
    <?php settings_fields('lunar-settings-group'); ?>
    <?php do_settings_sections('lunar_blog_general'); ?>    
	<?php submit_button( 'Save Changes Again', 'primary', 'btnSubmit' ); ?>
</form>