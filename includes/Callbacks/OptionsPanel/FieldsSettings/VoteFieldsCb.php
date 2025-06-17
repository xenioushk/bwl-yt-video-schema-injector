<?php
namespace BwlFaqManager\Callbacks\OptionsPanel\FieldsSettings;

use BwlFaqManager\Callbacks\OptionsPanel\RenderFields\VoteFieldsRenderCb;

/**
 * Class for registering fields.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class VoteFieldsCb {

	/**
     * Set the fields for the settings page
     */
    public function get_fields() {

			$render_cb = new VoteFieldsRenderCb();
			// Register fields here if needed.

			$settings_fields = [
				'baf_logged_in_voting_status' => [
					'title'    => esc_html__( 'Allow Votes Only For Users?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_logged_in_voting_status' ],
				],
				'bwl_advanced_faq_like_button_status' => [
					'title'    => esc_html__( 'Display Like Button?', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_like_button_status' ],
				],
				'baf_repeat_vote_interval' => [
					'title'    => esc_html__( 'Repeat Vote Interval:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_repeat_vote_interval' ],
				],
				'baf_like_icon' => [
					'title'    => esc_html__( 'Like Icon:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_like_icon' ],
				],
				'baf_like_icon_color' => [
					'title'    => esc_html__( 'Like Icon Color:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_like_icon_color' ],
				],
				'baf_like_icon_hover_color' => [
					'title'    => esc_html__( 'Like Icon Hover Color:', 'bwl-adv-faq' ),
					'callback' => [ $render_cb, 'get_like_icon_hover_color' ],
				],
			];

			return $settings_fields;

	}
}
