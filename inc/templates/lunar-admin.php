<h1>Lunar Theme Options</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields('lunar-settings-group'); ?>
    <?php do_settings_sections('lunar_blog_general'); ?>
    <?php submit_button(); ?>
</form>