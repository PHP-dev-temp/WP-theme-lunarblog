<h1>Lunar Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="lunar-general-form">
    <?php settings_fields( 'lunar-theme-support' ); ?>
    <?php do_settings_sections( 'my_lunar_theme' ); ?>
    <?php submit_button(); ?>
</form>