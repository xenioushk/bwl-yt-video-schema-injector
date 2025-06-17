<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\ContactInfo;

/**
 * Class Contact Info
 *
 * Handles Contact Info WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class ContactInfo {
    /**
	 * Register methods.
	 */
	public function register() {
		add_action( 'vc_before_init', [ $this, 'get_wpb_elem' ] );
	}

    /**
     * Get WPBakery element.
     */
	public function get_wpb_elem() {

		vc_map([
            'name'            => esc_html__( 'Contact Info', 'kdesk_vc' ),
            'description'     => esc_html__( 'Place Contact Info In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_contact_info',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Address', 'kdesk_vc' ),
					'param_name'  => 'contact_address',
					'value'       => '',
					'description' => esc_html__( 'Add your address.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Phone', 'kdesk_vc' ),
					'param_name'  => 'contact_phone',
					'value'       => '',
					'description' => esc_html__( 'Add your phone number.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Email', 'kdesk_vc' ),
					'param_name'  => 'contact_email',
					'value'       => '',
					'description' => esc_html__( 'Add your email address.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Web', 'kdesk_vc' ),
					'param_name'  => 'contact_web',
					'value'       => '',
					'description' => esc_html__( 'Add website URL.', 'kdesk_vc' ),
					'group'       => 'General',
				],

            ],
		]);
	}
}
