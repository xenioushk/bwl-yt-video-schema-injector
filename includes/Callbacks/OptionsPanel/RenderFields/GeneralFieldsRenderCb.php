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
class GeneralFieldsRenderCb {

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
	 * Get search box status field.
	 */
	public function get_search_box() {
			$field_id   = 'bwl_advanced_faq_search_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$value      = $this->options[ $field_id ] ?? 1; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $this->get_boolean_dropdown_options(), $value  ); //phpcs:ignore
	}

	/**
     * Get meta info status field.
     */
	public function get_meta_info() {
			$field_id   = 'bwl_advanced_faq_meta_info_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$value      = $this->options[ $field_id ] ?? 1; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $this->get_boolean_dropdown_options(), $value  ); //phpcs:ignore
	}
}
