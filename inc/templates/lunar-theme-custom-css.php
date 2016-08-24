<h1>Lunar Custom CSS</h1>
<?php settings_errors(); ?>

<form id="save-custom-css-form" method="post" action="options.php" class="lunar-general-form">
    <?php settings_fields( 'lunar-custom-css-options' ); ?>
    <?php do_settings_sections( 'lunar_blog_css' ); ?>
    <?php submit_button(); ?>
</form>