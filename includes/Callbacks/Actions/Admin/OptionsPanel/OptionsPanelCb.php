<?php
namespace BWLYTVSI\Callbacks\Actions\Admin\OptionsPanel;

/**
 * Class for registering all the schedulers.
 *
 * @package BWLYTVSI
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class OptionsPanelCb {

	/**
	 * Register the options for the settings page.
	 */
	public function register_options() {
		register_setting(
            'general',             // Option group (use 'general' for general settings)
            'bwlytvsi_api_key',    // Option name
            [
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
            ]
		);

		add_settings_field(
            'bwlytvsi_api_key',
            'YouTube API Key',
            [ $this, 'bwlytvsi_api_key_field_callback' ],
            'general'
		);
	}

	/**
	 * Callback function to display the API key input field.
	 */
	public function bwlytvsi_api_key_field_callback() {
		$api_key = get_option( 'bwlytvsi_api_key', '' );
		echo '<input type="text" id="bwlytvsi_api_key" name="bwlytvsi_api_key" value="' . esc_attr( $api_key ) . '" class="regular-text" />';
	}
}
