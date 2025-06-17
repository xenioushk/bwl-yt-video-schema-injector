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
class VoteFieldsRenderCb {

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
	 * Get logged in voting status field.
	 */
	public function get_logged_in_voting_status() {
			$field_id   = 'baf_logged_in_voting_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$value      = $this->options[ $field_id ] ?? 1; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $this->get_boolean_dropdown_options(), $value  ); //phpcs:ignore
	}

	/**
	 * Get like button status field.
	 */
	public function get_like_button_status() {
			$field_id   = 'bwl_advanced_faq_like_button_status'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$value      = $this->options[ $field_id ] ?? 1; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $this->get_boolean_dropdown_options(), $value  ); //phpcs:ignore
	}

	/**
	 * Get repeat vote interval field.
	 */
	public function get_repeat_vote_interval() {
		$field_id   = 'baf_repeat_vote_interval'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? 120; // change default value.
		$hints      = esc_html__( 'Default 120 (2 hours).', 'baf-faqtfw' );

		echo $this->get_text_field( $field_name, $field_id, ( intval($value) === 0 ) ? 100: $value, '', 'small-text', $hints ); //phpcs:ignore
	}

	/**
	 * Get like button icon field.
	 */
	public function get_like_icon() {
			$field_id   = 'baf_like_icon'; // change the id.
			$field_name = $this->options_id . "[{$field_id}]";
			$options    = [
				'fa-thumbs-o-up'     => 'Transparent Thumbs Up',
				'fa-thumbs-up'       => 'Filled Thumbs Up',
				'fa-heart-o'         => 'Transparent Heart',
				'fa-heart'           => 'Filled Heart',
				'fa-smile-o'         => 'Smile Face',
				'fa-level-up'        => 'Level up',
				'fa-arrow-circle-up' => 'Circle up',
				'fa-arrow-up'        => 'Arrow up',
				'fa-angle-up'        => 'Angle up',
				'fa-angle-double-up' => 'Double Angle up',
			];
			$value      = $this->options[ $field_id ] ?? 'fa-thumbs-o-up'; // change default value.

			echo $this->get_select_field( $field_name, $field_id, $options, $value  ); //phpcs:ignore
	}

	/**
	 * Get like icon color field.
	 */
	public function get_like_icon_color() {
		$field_id   = 'baf_like_icon_color'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? '#228AFF'; // change default value.

		echo $this->get_text_field( $field_name, $field_id, $value, '', 'small-text', ); //phpcs:ignore
	}

	/**
	 * Get like icon hover color field.
	 */
	public function get_like_icon_hover_color() {
		$field_id   = 'baf_like_icon_hover_color'; // change the id.
		$field_name = $this->options_id . "[{$field_id}]";
		$value      = $this->options[ $field_id ] ?? '#333333'; // change default value.

		echo $this->get_text_field( $field_name, $field_id, $value, '', 'small-text', ); //phpcs:ignore
	}
}
