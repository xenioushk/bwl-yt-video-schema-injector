<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Slider;

/**
 * Class Slider
 *
 * Handles slider wpbakery page builder element.
 *
 * @package KDESKADDON
 */
class Slider {
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
			esc_html__( 'SELECT', 'kdesk_vc' )           => '',
			esc_html__( 'Slider Layout 01', 'kdesk_vc' ) => 'slider_1',
		];

		$theme = [
			esc_html__( 'Default', 'kdesk_vc' ) => '',
			esc_html__( 'Custom', 'kdesk_vc' )  => 'custom',
		];

		// Register "container" content element. It will hold all your inner (child) content elements
		vc_map([
            'name'                    => esc_html__( 'Slider', 'kdesk_vc' ),
            'description'             => esc_html__( 'Place Slider In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_slider',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'slider_item' ],
            'content_element'         => true,
            'show_settings_on_create' => true,
            'controls'                => 'full',
            'is_container'            => false,
            'icon'                    => 'icon-kdesk-vc-addon',
            'params'                  => [
				// add params same as with any other content element
				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Choose Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select slider layout style.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
				],

				[
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Carousel Navigation Button?', 'kdesk_vc' ),
					'param_name' => 'carousel_nav',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'General',
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Theme', 'kdesk_vc' ),
					'param_name'  => 'theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select custom to design your own button style.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Navigation Background', 'kdesk_vc' ),
					'param_name'  => 'nav_bg',
					'value'       => '#FF6622',
					'description' => esc_html__( 'Set navigation background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Navigation Icon Color', 'kdesk_vc' ),
					'param_name'  => 'nav_color',
					'value'       => '#000000',
					'description' => esc_html__( 'Set navigation icon color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Left Navigation Icon', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav_icon_left',
					'settings'    => [
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Design',
					'value'       => 'fa-angle-left',
					'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Right Navigation Icon', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav_icon_right',
					'settings'    => [
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Design',
					'value'       => 'fa-angle-right',
					'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

			],
			'js_view'                 => 'VcColumnView',
		]);

		vc_map([
            'name'            => esc_html__( 'Slider Item', 'kdesk_vc' ),
            'description'     => esc_html__( 'Add Slider Item.', 'kdesk_vc' ),
            'base'            => 'slider_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_slider' ], // Use only|except attributes to limit parent (separate multiple values with comma)
            'params'          => [
				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'textarea_html',
					'heading'     => esc_html__( 'Title', 'kdesk_vc' ),
					'param_name'  => 'content',
					'description' => esc_html__( 'You can add html and custom css code as slider title text.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Sub Title', 'kdesk_vc' ),
					'param_name' => 'slider_sub_title',
					'group'      => 'General',
				],

				[
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Sub Title', 'kdesk_vc' ),
					'param_name' => 'slider_sub_title_status',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'General',
				],

				[
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Enable Featured Image?', 'kdesk_vc' ),
					'param_name' => 'feat_img_status',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => 1 ],
					'group'      => 'General',
				],

				[
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Add Featured Image', 'kdesk_vc' ),
					'param_name' => 'slider_feat_img',
					'group'      => 'General',
					'dependency' => [ 'element' => 'feat_img_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Alter content position?', 'kdesk_vc' ),
					'param_name'  => 'alt_content_position',
					'value'       => [ esc_html__( 'Yes', 'kdesk_vc' ) => 1 ],
					'group'       => 'General',
					'description' => esc_html__( 'If you want to display featured image first position, then enable this option.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'feat_img_status', 'value' => [ '1' ] ],
				],

				[
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Content Alignment', 'kdesk_vc' ),
					'param_name' => 'content_alignment',
					'value'      => kdesk_content_alignment(),
					'group'      => 'General',
				],

				// Design.
				[
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Background Type', 'kdesk_vc' ),
					'param_name' => 'bg_type',
					'value'      => [
						'Image'       => 'image',
						'Solid Color' => 'solid',
					],
					'group'      => 'Design',
				],

				[
					'holder'     => 'img',
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Slider Background Image', 'kdesk_vc' ),
					'param_name' => 'slider_image',
					'group'      => 'Design',
					'dependency' => [ 'element' => 'bg_type', 'value' => [ 'image' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Image Overlay Color', 'kdesk_vc' ),
					'param_name'  => 'bg_color',
					'value'       => '#000000',
					'description' => esc_html__( 'Note: Please keep alpha to 100% and set ovarlay opacity in following drop down.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'bg_type', 'value' => [ 'image' ] ],
				],

				[
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Image Overlay Opacity', 'kdesk_vc' ),
					'param_name' => 'bg_opacity',
					'value'      => kdesk_overlay_opacity(),
					'group'      => 'Design',
					'dependency' => [ 'element' => 'bg_type', 'value' => [ 'image' ] ],
				],

				[
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Solid Background Color', 'kdesk_vc' ),
					'param_name' => 'solid_bg',
					'value'      => '#000000',
					'group'      => 'Design',
					'dependency' => [ 'element' => 'bg_type', 'value' => [ 'solid' ] ],
				],

				[
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title Color', 'kdesk_vc' ),
					'param_name' => 'content_color',
					'value'      => '#FFFFFF',
					'group'      => 'Design',
				],

				[
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Slider Sub Title Color', 'kdesk_vc' ),
					'param_name' => 'slider_sub_title_color',
					'value'      => '#FFFFFF',
					'group'      => 'Design',
				],

				// Button 01

				[
					'type'       => 'checkbox',
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
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Additional Button#1 Class', 'kdesk_vc' ),
					'param_name'  => 'btn_1_class',
					'value'       => '',
					'description' => esc_html__( 'Example: btn-theme-invert, btn-theme-white, btn-square, btn-small', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Theme', 'kdesk_vc' ),
					'param_name'  => 'btn_1_theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select custom to design your own button style.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'ctrl_btn_1', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Display Button Border', 'kdesk_vc' ),
					'param_name'  => 'btn_1_border',
					'value'       => [
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
						esc_html__( 'No', 'kdesk_vc' )  => 0,
					],
					'description' => esc_html__( 'Set No, if you hide button border.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'btn_1_border_radius',
					'value'       => kdesk_border_radius( 0, 32 ),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Background', 'kdesk_vc' ),
					'param_name'  => 'btn_1_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_1_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Border Color', 'kdesk_vc' ),
					'param_name'  => 'btn_1_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button border color.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'btn_1_hover_bg',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_1_hover_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Hover Border Color', 'kdesk_vc' ),
					'param_name'  => 'btn_1_hover_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover border color.', 'kdesk_vc' ),
					'group'       => 'Button 01',
					'dependency'  => [ 'element' => 'btn_1_theme', 'value' => [ 'custom' ] ],
				],

				// Button 02

				[
					'type'       => 'checkbox',
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
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Additional Button#2 Class', 'kdesk_vc' ),
					'param_name'  => 'btn_2_class',
					'value'       => '',
					'description' => esc_html__( 'Example: btn-theme-invert, btn-theme-white, btn-square, btn-small', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Theme', 'kdesk_vc' ),
					'param_name'  => 'btn_2_theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select custom to design your own button style.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'ctrl_btn_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Display Button Border', 'kdesk_vc' ),
					'param_name'  => 'btn_2_border',
					'value'       => [
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
						esc_html__( 'No', 'kdesk_vc' )  => 0,
					],
					'description' => esc_html__( 'Set No, if you hide button border.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'btn_2_border_radius',
					'value'       => kdesk_border_radius(),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Background', 'kdesk_vc' ),
					'param_name'  => 'btn_2_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_2_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Border Color', 'kdesk_vc' ),
					'param_name'  => 'btn_2_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button border color.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'btn_2_hover_bg',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'btn_2_hover_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Button Hover Border Color', 'kdesk_vc' ),
					'param_name'  => 'btn_2_hover_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover border color.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'btn_2_theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'animation_style',
					'heading'     => esc_html__( 'Content Animation in Style', 'kdesk_vc' ),
					'param_name'  => 'content_animation_in',
					'description' => esc_html__( 'Choose your animation style', 'kdesk_vc' ),
					'admin_label' => false,
					'weight'      => 0,
					'group'       => 'Animation',
				],

				[
					'type'        => 'animation_style',
					'heading'     => esc_html__( 'Content Animation Out Style', 'kdesk_vc' ),
					'param_name'  => 'content_animation_out',
					'description' => esc_html__( 'Choose your animation style', 'kdesk_vc' ),
					'admin_label' => false,
					'weight'      => 0,
					'group'       => 'Animation',
				],

			],
		]);
	}
}
