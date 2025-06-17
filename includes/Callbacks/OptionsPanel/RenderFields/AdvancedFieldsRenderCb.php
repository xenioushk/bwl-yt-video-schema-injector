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
class AdvancedFieldsRenderCb {

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
	 * Get the FAQ custom slug field.
	 */
	public function get_custom_slug() {

		$field_id   = BAF_CPT_CUSTOM_SLUG; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? 'bwl-advanced-faq'; // change default value.

		$hints = '<strong>Example:</strong> http://yourdomain.com/custom-slug/faq-4/ <strong>Note:</strong> After changing the slug, you may face a 404 error. To fix it, go to Settings > Permalinks, select "Default," save, then reselect "Post name" and save again.';
		echo $this->get_text_field( $field_name, $field_id, $value  , '', 'medium-text', $hints ); //phpcs:ignore
	}

	/**
	 * Get the sub category status field.
	 */
	public function get_sub_cat_status() {

		$field_id   = BAF_SUB_CAT_STATUS; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.
		$hints      = esc_html__( 'Turn this option ON to enable custom ordering for both categories and subcategories.', 'bwl-adv-faq' );

		echo $this->get_checkbox_field( $field_name, $field_id, $value , '', '', $hints); //phpcs:ignore
	}

	/**
	 * Get the FAQ comment status field.
	 */
	public function get_comment_status() {
		$field_id   = BAF_COMMENT_STATUS; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_checkbox_field( $field_name, $field_id, $value , '', '', ); //phpcs:ignore
	}

	/**
	 * Get the faq schema status field.
	 */
	public function get_faq_schema_status() {

		$field_id   = BAF_FAQ_SCHEMA_STATUS; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_checkbox_field( $field_name, $field_id, $value , '', '', ); //phpcs:ignore
	}

	/**
	 * Get the FAQ custom CSS field.
	 */
	public function get_custom_css() {
		$field_id   = BAF_INLINE_CUSTOM_CSS; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? ''; // change default value.

		echo $this->get_textarea_field( $field_name, $field_id, $value , '', '', ); //phpcs:ignore
	}
}
