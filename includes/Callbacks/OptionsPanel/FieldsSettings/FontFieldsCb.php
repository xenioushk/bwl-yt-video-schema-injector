<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\FontFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class FontFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new FontFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				'bwl_advanced_label_tag' => [
					'title'    => esc_html__( 'FAQ Title Tag:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_label_tags' ],
				],
				'bwl_advanced_label_font_size' => [
					'title'    => esc_html__( 'FAQ Title Font Size:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_label_font_sizes' ],
				],
				'bwl_advanced_content_font_size' => [
					'title'    => esc_html__( 'Content Font Size:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_content_font_sizes' ],
				],
				BAF_FONT_AWESOME_STATUS => [
					'title'    => esc_html__( 'Disable Font Awesome?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_fa_status' ],
				],
				'bwl_advanced_fa_arrow_up' => [
					'title'    => esc_html__( 'Label Arrow:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_fa_arrow' ],
				],
			];

			return $settings_fields;

	}
}
