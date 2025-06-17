<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\RenderFields;

use BwlFaqManager\Helpers\PluginConstants;
use BwlFaqManager\Traits\OptionsFieldsTraits;

/**
 * Class for rendering the fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class ThemeFieldsRenderCb {

	use OptionsFieldsTraits;

	/**
	 * Options array.
     *
	 * @var array
	 */
	public $options;

	/**
	 * Options ID.
	 *
	 * @var string
	 */
	public $options_id;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->options    = PluginConstants::$plugin_options;
		$this->options_id = BAF_OPTIONS_ID; // change here.
	}


	/**
	 * Get faq themes field.
	 */
	public function get_faq_themes() {

			$field_id   = 'bwl_advanced_faq_theme'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$options    = [
				''       => 'default',
				'light'  => 'light',
				'red'    => 'red',
				'blue'   => 'blue',
				'green'  => 'green',
				'pink'   => 'pink',
				'orange' => 'orange',
			];
			$value      = $this->options[ $field_id ] ?? 'default'; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore
	}

	/**
	 * Get custom theme status field.
	 **/
	public function get_custom_theme_status() {

		$field_id   = 'enable_custom_theme'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.
		echo $this->get_checkbox_field( $field_name, $field_id, $value , '', '', ); //phpcs:ignore
	}

	/**
	 * Get gradient first color field.
	 **/
	public function get_gradient_first_color() {

		$field_id   = 'gradient_first_color'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? '#FFFFFF'; // change default value.

		echo $this->get_text_field( $field_name, $field_id, $value, '', 'small-text', ); //phpcs:ignore 
	}
	/**
	 * Get gradient second color field.
	 **/
	public function get_gradient_second_color() {

		$field_id   = 'gradient_second_color'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? '#EAEAEA'; // change default value.

		echo $this->get_text_field( $field_name, $field_id, $value, '', 'small-text', ); //phpcs:ignore 
	}

	/**
	 * Get label text color field.
	 **/
	public function get_label_text_color() {

		$field_id   = 'label_text_color'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? '#777777'; // change default value.

		echo $this->get_text_field( $field_name, $field_id, $value, '', 'small-text', ); //phpcs:ignore 
	}
}
