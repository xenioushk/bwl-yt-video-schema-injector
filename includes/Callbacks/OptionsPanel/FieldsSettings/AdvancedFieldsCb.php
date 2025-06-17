<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\AdvancedFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class AdvancedFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new AdvancedFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				BAF_CPT_CUSTOM_SLUG => [
					'title'    => esc_html__( 'Custom Slug:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_custom_slug' ],
				],
				BAF_SUB_CAT_STATUS => [
					'title'    => esc_html__( 'Enable Sub Categories Mode?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_sub_cat_status' ],
				],
				BAF_COMMENT_STATUS => [
					'title'    => esc_html__( 'Enable Comment Support?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_comment_status' ],
				],
				BAF_FAQ_SCHEMA_STATUS => [
					'title'    => esc_html__( 'Disable FAQ Schema?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_faq_schema_status' ],
				],
				BAF_INLINE_CUSTOM_CSS => [
					'title'    => esc_html__( 'Custom CSS:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_custom_css' ],
				],
			];

			return $settings_fields;

	}
}
