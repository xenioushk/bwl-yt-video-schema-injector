<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\ThemeFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class ThemeFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new ThemeFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				'bwl_advanced_faq_theme' => [
					'title'    => esc_html__( 'FAQ Theme:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_faq_themes' ],
				],
				'enable_custom_theme' => [
					'title'    => esc_html__( 'Enable Custom Theme:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_custom_theme_status' ],
				],
				'gradient_first_color' => [
					'title'    => esc_html__( 'Label Gradient First Color:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_gradient_first_color' ],
				],
				'gradient_second_color' => [
					'title'    => esc_html__( 'Label Gradient Second Color:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_gradient_second_color' ],
				],
				'label_text_color' => [
					'title'    => esc_html__( 'Label Text Color:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_label_text_color' ],
				],
			];

			return $settings_fields;

	}
}
