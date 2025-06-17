<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\ReadingFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class ReadingFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new ReadingFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				'bwl_advanced_faq_collapsible_accordion_status' => [
					'title'    => esc_html__( 'Collapsible Accordion:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_collapsible_accordion' ],
				],
				'bwl_collapsible_btn_status' => [
					'title'    => esc_html__( 'Display Expand/Collapse Button?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_expand_collapse_button' ],
				],
				'bwl_advanced_faq_excerpt_status' => [
					'title'    => esc_html__( 'Enable FAQ Excerpt?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_faq_excerpt' ],
				],
				'bwl_advanced_faq_excerpt_length' => [
					'title'    => esc_html__( 'Excerpt Length:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_faq_excerpt_length' ],
				],
				BAF_DISABLE_SINGLE_FAQ_STATUS => [
					'title'    => esc_html__( 'Disable Single FAQ Page?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_single_faq_disable_status' ],
				],
			];

			return $settings_fields;

	}
}
