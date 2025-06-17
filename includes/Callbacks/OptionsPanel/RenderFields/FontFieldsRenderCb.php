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
class FontFieldsRenderCb {

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
	 * Get label tag field.
	 **/
	public function get_label_tags() {

		$field_id   = 'bwl_advanced_label_tag'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$options    = [
			'label' => 'label',
			'h2'    => 'h2',
			'h3'    => 'h3',
			'h4'    => 'h4',
			'h5'    => 'h5',
			'h6'    => 'h6',
		];
		$value      = $this->options[ $field_id ] ?? 'label'; // change default value.

		echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore
	}

	/**
	 * Get label font size field.
	 **/
	public function get_label_font_sizes() {

		$field_id   = 'bwl_advanced_label_font_size'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$options    = [
			'' => esc_attr__( 'Use Theme Font Size', 'bwl-adv-faq' ),
		];
		for ( $i = 15; $i <= 72; $i++ ) {
			$options[ $i ] = "{$i}px";
		}
		$value = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore

	}

	/**
	 * Get content font size field.
	 **/
	public function get_content_font_sizes() {

		$field_id   = 'bwl_advanced_content_font_size'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$options    = [
			'' => esc_attr__( 'Use Theme Font Size', 'bwl-adv-faq' ),
		];
		for ( $i = 11; $i <= 62; $i++ ) {
			$options[ $i ] = "{$i}px";
		}
		$value = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore

	}
	/**
	 * Get font awesome status field.
	 **/
	public function get_fa_status() {

		$field_id   = BAF_FONT_AWESOME_STATUS; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_checkbox_field( $field_name, $field_id, $value, '', '', ); //phpcs:ignore
	}

	/**
	 * Get Font Awesome arrow field.
	 **/
	public function get_fa_arrow() {

		$field_id   = 'bwl_advanced_fa_arrow_up'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$options    = [
			'\f062' => 'Arrow Up',
			'\f106' => 'Angle up',
			'\f102' => 'Double Angle Up',
			'\f0aa' => 'Circle Arrow Up',
			'\f0d8' => 'Caret Arrow Up',
			'\f077' => 'Chevron Arrow Down',
		];
		$value      = $this->options[ $field_id ] ?? '\f062'; // change default value.

		echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore
	}
}
