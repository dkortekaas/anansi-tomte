<?php

add_action( 'admin_menu', 'add_weblogiqpress_options_page' );
function add_weblogiqpress_options_page() {

    //add_options_page(
    //    __('Theme Options'),
    //    __('Theme Options'),
    //    'manage_options',
    //    'weblogiqpress-options-page',
    //    'display_weblogiqpress_options_page'
    //);

    add_menu_page(
		__('Social Media'),
		__('Social Media'),
        "manage_options",
		'weblogiqpress-options-page',
		'display_weblogiqpress_options_page',
        'dashicons-share',
        99
    );

}

function display_weblogiqpress_options_page() { ?>

    <div class="wrap">
        <h1><?php echo __('Social media profiles'); ?></h1>
	
        <form method="post" action="options.php">

	    <?php do_settings_sections( 'weblogiqpress-options-page' ); ?>
	    <?php settings_fields( 'weblogiqpress-settings' ); ?>

	    <?php submit_button(); ?>

        </form>
    </div>
<?php
}

add_action( 'admin_init', 'weblogiqpress_admin_init_social' );
function weblogiqpress_admin_init_social() {

	add_settings_section(
		'weblogiqpress-settings-section-social',
		'Social Media',
		'social_weblogiqpress_settings_message',
		'weblogiqpress-options-page'
	);

	add_settings_field(
		'twitter_url',
		'Twitter Profile Url',
		'render_weblogiqpress_input_twitter',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'facebook_url',
		'Facebook Profile Url',
		'render_weblogiqpress_input_facebook',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'google_url',
		'Google+ Profile Url',
		'render_weblogiqpress_input_google',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'linkedin_url',
		'LinkedIn Profile Url',
		'render_weblogiqpress_input_linkedin',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'pinterest_url',
		'Pinterest Profile Url',
		'render_weblogiqpress_input_pinterest',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'instagram_url',
		'Instagram Profile Url',
		'render_weblogiqpress_input_instagram',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'youtube_url',
		'Youtube Profile Url',
		'render_weblogiqpress_input_youtube',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);
	add_settings_field(
		'skype_name',
		'Skype Name',
		'render_weblogiqpress_input_skype',
		'weblogiqpress-options-page',
		'weblogiqpress-settings-section-social'
	);

	register_setting(
		'weblogiqpress-settings',
		'twitter_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'facebook_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'google_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'linkedin_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'pinterest_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'instagram_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'youtube_url'
	);
	register_setting(
		'weblogiqpress-settings',
		'skype_name'
	);
}

function social_weblogiqpress_settings_message() {
	echo __('Enter your Social media profile URLs below.');
}

function render_weblogiqpress_input_twitter() {

	$input = get_option( 'twitter_url' );
	echo '<input type="text" id="twitter_url" name="twitter_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_facebook() {

	$input = get_option( 'facebook_url' );
	echo '<input type="text" id="facebook_url" name="facebook_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_google() {

	$input = get_option( 'google_url' );
	echo '<input type="text" id="google_url" name="google_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_linkedin() {

	$input = get_option( 'linkedin_url' );
	echo '<input type="text" id="linkedin_url" name="linkedin_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_pinterest() {

	$input = get_option( 'pinterest_url' );
	echo '<input type="text" id="pinterest_url" name="pinterest_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_instagram() {

	$input = get_option( 'instagram_url' );
	echo '<input type="text" id="instagram_url" name="instagram_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_youtube() {

	$input = get_option( 'youtube_url' );
	echo '<input type="text" id="youtube_url" name="youtube_url" class="regular-text code" value="' . $input . '" />';

}

function render_weblogiqpress_input_skype() {

	$input = get_option( 'skype_name' );
	echo '<input type="text" id="skype_name" name="skype_name" class="regular-text code" value="' . $input . '" />';

}