<h1>Lunar Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="lunar-general-form">
    <?php settings_fields( 'lunar-theme-contact' ); ?>
    <?php do_settings_sections( 'lunar_theme_contact' ); ?>
    <?php submit_button(); ?>
</form>