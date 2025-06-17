<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Button;

/**
 * Class Button
 *
 * Handles Button WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Button {
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

		$theme = [
			esc_html__( 'Default Button', 'kdesk_vc' ) => '',
			esc_html__( 'Custom Button', 'kdesk_vc' )  => 'custom',
		];

		vc_map([
            'name'            => esc_html__( 'Buttons', 'kdesk_vc' ),
            'description'     => esc_html__( 'Place Buttons In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_vc_button',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'icon'            => 'icon-kdesk-vc-addon',
            'params'          => [

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text', 'kdesk_vc' ),
					'param_name'  => 'btn_text',
					'value'       => '',
					'description' => esc_html__( 'Add button text.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'holder'      => 'link',
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Button Info', 'kdesk_vc' ),
					'param_name'  => 'btn_info',
					'value'       => '',
					'description' => esc_html__( 'Add button info.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Theme', 'kdesk_vc' ),
					'param_name'  => 'theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select button theme', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Display Button Border', 'kdesk_vc' ),
					'param_name'  => 'btn_border',
					'value'       => [
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
						esc_html__( 'No', 'kdesk_vc' )  => 0,
					],
					'description' => esc_html__( 'Set No, if you hide button border.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'btn_border_radius',
					'value'       => kdesk_border_radius( 1, 32 ),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Background', 'kdesk_vc' ),
					'param_name'  => 'btn_bg',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Border Color', 'kdesk_vc' ),
					'param_name'  => 'btn_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button border color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'btn_hover_bg',
					'value'       => '#444444',
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_hover_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Border Color', 'kdesk_vc' ),
					'param_name'  => 'btn_hover_border_color',
					'value'       => '#444444',
					'description' => esc_html__( 'Set button hover border color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of button.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'animation_style',
					'heading'     => esc_html__( 'Animation Style', 'kdesk_vc' ),
					'param_name'  => 'animation',
					'description' => esc_html__( 'Choose your animation style', 'kdesk_vc' ),
					'admin_label' => false,
					'weight'      => 0,
					'group'       => 'Animation',
				],
            ],

		]);
	}
}
