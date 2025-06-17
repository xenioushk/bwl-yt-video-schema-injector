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
class ReadingFieldsRenderCb {

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
	 * Get the collapsible accordion field.
	 */
	public function get_collapsible_accordion() {

			$field_id   = 'bwl_advanced_faq_collapsible_accordion_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$options    = [
				'0' => esc_html__( 'Select', 'bwl-adv-faq' ),
				'1' => esc_html__( 'Show All FAQ Answer Closed', 'bwl-adv-faq' ),
				'2' => esc_html__( 'Show All FAQ Answer Opened', 'bwl-adv-faq' ),
			];
			$value      = $this->options[ $field_id ] ?? 0; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore
	}

	/**
	 * Get the expand/collapse button field.
	 */
	public function get_expand_collapse_button() {

		$field_id       = 'bwl_collapsible_btn_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$value      = $this->options[ $field_id ] ?? 0; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $this->get_boolean_dropdown_options(), $value  ); //phpcs:ignore
	}

	/**
	 * Get the FAQ excerpt field.
	 */
	public function get_faq_excerpt() {

			$field_id   = 'bwl_advanced_faq_excerpt_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$value      = $this->options[ $field_id ] ?? 0; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $this->get_boolean_dropdown_options(), $value  ); //phpcs:ignore
	}

	/**
	 * Get the FAQ excerpt length field.
	 */
	public function get_faq_excerpt_length() {

		$field_id   = 'bwl_advanced_faq_excerpt_length'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? 60; // change default value.

		echo $this->get_text_field( $field_name, $field_id, ( intval($value) === 0 ) ? 5: $value  , '', 'small-text' ); //phpcs:ignore
	}

	/**
	 * Get single Faq disable status.
	 **/
	public function get_single_faq_disable_status() {

		$field_id   = BAF_DISABLE_SINGLE_FAQ_STATUS; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_checkbox_field( $field_name, $field_id, $value , '', '', ); //phpcs:ignore
	}
}
