<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\GeneralFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class GeneralFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new GeneralFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				'bwl_advanced_faq_search_status' => [
					'title'    => esc_html__( 'Display Search Box?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_search_box' ],
				],
				'bwl_advanced_faq_meta_info_status' => [
					'title'    => esc_html__( 'Display Meta Info?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_meta_info' ],
				],
			];

			return $settings_fields;

	}
}
