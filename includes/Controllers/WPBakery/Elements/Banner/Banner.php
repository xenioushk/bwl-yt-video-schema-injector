<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Banner;

/**
 * Class Banner
 *
 * Handles Banner WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Banner {
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

		$layout = [
			esc_html__( 'Layout 01 ( Single Column )', 'kdesk_vc' ) => 'layout_1',
		];

		$theme = [
			esc_html__( 'Default Button', 'kdesk_vc' ) => '',
			esc_html__( 'Custom Button', 'kdesk_vc' )  => 'custom',
		];

		vc_map([
            'name'            => esc_html__( 'Static Banner', 'kdesk_vc' ),
            'description'     => esc_html__( 'Home Page Static Banner.', 'kdesk_vc' ),
            'base'            => 'kdesk_vc_banner',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [

				[
					'admin_label' => true,
					'type'        => 'textarea_html',
					'class'       => '',
					'heading'     => esc_html__( 'Banner Text', 'kdesk_vc' ),
					'param_name'  => 'content',
					'value'       => '',
					'group'       => 'General',
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'CTA Content Alignment', 'kdesk_vc' ),
					'param_name' => 'content_alignment',
					'value'      => kdesk_content_alignment(),
					'group'      => 'General',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of button.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Background Type', 'kdesk_vc' ),
					'param_name' => 'bg_type',
					'value'      => [
						'Image'       => 'image',
						'Solid Color' => 'solid',
					],
					'group'      => 'Design',
				],

				[
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Background Image', 'kdesk_vc' ),
					'param_name' => 'banner_bg',
					'group'      => 'Design',
					'dependency' => [ 'element' => 'bg_type', 'value' => [ 'image' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Image Overlay Color', 'kdesk_vc' ),
					'param_name'  => 'bg_color',
					'value'       => '#555555',
					'description' => esc_html__( 'Note: Please keep alpha to 100% and set ovarlay opacity in following drop down.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'bg_type', 'value' => [ 'image' ] ],
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Image Overlay Opacity', 'kdesk_vc' ),
					'param_name' => 'bg_opacity',
					'value'      => kdesk_overlay_opacity(),
					'group'      => 'Design',
					'dependency' => [ 'element' => 'bg_type', 'value' => [ 'image' ] ],
				],

				[
					'type'       => 'colorpicker',
					'class'      => '',
					'heading'    => esc_html__( 'Solid Background Color', 'kdesk_vc' ),
					'param_name' => 'solid_bg',
					'value'      => '#000000',
					'group'      => 'Design',
					'dependency' => [ 'element' => 'bg_type', 'value' => [ 'solid' ] ],
				],

				/*-----  BUTTON#1----*/

				[
					'type'       => 'checkbox',
					'class'      => '',
					'heading'    => esc_html__( 'Enable Button#1', 'kdesk_vc' ),
					'param_name' => 'ctrl_btn_1',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'Button 01',
				],

				[
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Button#1 Text', 'kdesk_vc' ),
					'param_name' => 'btn_1_text',
					'group'      => 'Button 01',
					'dependency' => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Button#1 URL', 'kdesk_vc' ),
					'param_name' => 'btn_1_url',
					'group'      => 'Button 01',
					'dependency' => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Button#1 Theme', 'kdesk_vc' ),
					'param_name'  => 'btn_1_theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select custom to design your own button style.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'btn_1_border_radius',
					'value'       => kdesk_border_radius( 0, 64 ),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Background', 'kdesk_vc' ),
					'param_name'  => 'btn_1_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_1_color',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'btn_1_hover_bg',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_1_hover_color',
					'value'       => KDESK_LIGHT_TEXT_COLOR,
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				/*-----  BUTTON#2----*/

				[
					'type'       => 'checkbox',
					'class'      => '',
					'heading'    => esc_html__( 'Enable Button#2', 'kdesk_vc' ),
					'param_name' => 'ctrl_btn_2',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'Button 02',
				],

				[
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Button#2 Text', 'kdesk_vc' ),
					'param_name' => 'btn_2_text',
					'group'      => 'Button 02',
					'dependency' => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Button#2 URL', 'kdesk_vc' ),
					'param_name' => 'btn_2_url',
					'group'      => 'Button 02',
					'dependency' => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Button#2 Theme', 'kdesk_vc' ),
					'param_name'  => 'btn_2_theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select custom to design your own button style.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'btn_2_border_radius',
					'value'       => kdesk_border_radius( 0, 64 ),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Background', 'kdesk_vc' ),
					'param_name'  => 'btn_2_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_2_color',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'btn_2_hover_bg',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_2_hover_color',
					'value'       => KDESK_LIGHT_TEXT_COLOR,
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
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
