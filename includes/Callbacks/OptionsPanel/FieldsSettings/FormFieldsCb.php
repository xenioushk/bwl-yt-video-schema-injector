<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\FormFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class FormFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new FormFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				'bwl_advanced_faq_logged_in_status' => [
					'title'    => esc_html__( 'Require Log In To Submit FAQ?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_faq_logged_in_status' ],
				],
				'bwl_advanced_faq_captcha_status' => [
					'title'    => esc_html__( 'Captcha In FAQ Submit Form?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_capthca_status' ],
				],
				'bwl_advanced_email_notification_status' => [
					'title'    => esc_html__( 'New FAQ Email Notification?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_faq_notification_status' ],
				],
				'bwl_advanced_notification_email_id' => [
					'title'    => esc_html__( 'Notification Email ID:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_notification_email' ],
				],
			];

			return $settings_fields;

	}
}
