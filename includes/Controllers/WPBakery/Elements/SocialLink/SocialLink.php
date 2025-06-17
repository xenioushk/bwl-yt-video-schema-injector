<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\SocialLink;

/**
 * Class Social Link
 *
 * Handles Social Link WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class SocialLink {
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
            'name'            => esc_html__( 'Social Link Block', 'kdesk_vc' ),
            'description'     => esc_html__( 'Place Social Info In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_social_link',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Twitter', 'kdesk_vc' ),
					'param_name'  => 'twitter_link',
					'value'       => '',
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Facebook', 'kdesk_vc' ),
					'param_name'  => 'facebook_link',
					'value'       => '',
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Pinterest', 'kdesk_vc' ),
					'param_name'  => 'pinterest_link',
					'value'       => '',
					'group'       => 'General',
				],

				// DESIGN TAB.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Select Theme', 'kdesk_vc' ),
					'param_name'  => 'theme',
					'value'       => [
						esc_html__( 'Default', 'kdesk_vc' ) => 'default',
						esc_html__( 'Custom', 'kdesk_vc' ) => 'custom',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'Choose Custom to create your own theme.', 'kdesk_vc' ),
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'This color will apply in social button.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Icon Color', 'kdesk_vc' ),
					'param_name'  => 'theme_icon_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'This color will apply in social icon.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Hover Color', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_color',
					'value'       => '#22AFE6',
					'description' => esc_html__( 'This color will apply in social button.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

            ],
		]);
	}
}
