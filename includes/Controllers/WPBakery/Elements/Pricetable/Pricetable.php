<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Pricetable;

/**
 * Class Pricetable
 *
 * Handles Pricetable WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Pricetable {
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
			esc_html__( 'Layout 01 (Simple Column Grid)', 'kdesk_vc' ) => 'simple',
			esc_html__( 'Layout 02 (No Column Padding Grid)', 'kdesk_vc' ) => 'no_padding',
		];

		$column = [
			esc_html__( 'SELECT', 'kdesk_vc' )           => '',
			esc_html__( '2 items each row', 'kdesk_vc' ) => '2',
			esc_html__( '3 items each row', 'kdesk_vc' ) => '3',
			esc_html__( '4 items each row (Default)', 'kdesk_vc' ) => '4',
		];

		vc_map([
            'name'                    => esc_html__( 'Pricetable', 'kdesk_vc' ),
            'description'             => esc_html__( 'Place Pricetable In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_pricetable',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_pricetable_item' ],
            'content_element'         => true,
            'show_settings_on_create' => true,
            'controls'                => 'full',
            'is_container'            => false,
            'icon'                    => 'icon-kdesk-vc-addon',
            'params'                  => [
				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Price Table Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select pricetable layout style.', 'kdesk_vc' ),
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Column', 'kdesk_vc' ),
					'param_name'  => 'column',
					'value'       => $column,
					'group'       => 'General',
					'description' => esc_html__( 'Number of items display each row.', 'kdesk_vc' ),
				],
            ],
            'js_view'                 => 'VcColumnView',
		]);

		vc_map([
            'name'            => esc_html__( 'Pricetable Item', 'kdesk_vc' ),
            'description'     => 'Add Pricetable Item',
            'base'            => 'kdesk_pricetable_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_pricetable' ],
            'params'          => [
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Label', 'kdesk_vc' ),
					'param_name'  => 'pricetable_type',
					'value'       => '',
					'description' => esc_html__( 'Example: Basic, Standard, Business, Premium etc.', 'kdesk_vc' ),
					'group'       => 'General',
				],
				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Currency', 'kdesk_vc' ),
					'param_name'  => 'pricetable_currency',
					'value'       => '',
					'description' => esc_html__( 'Example: $', 'kdesk_vc' ),
					'group'       => 'General',
				],
				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Price', 'kdesk_vc' ),
					'param_name'  => 'pricetable_price',
					'value'       => '',
					'description' => esc_html__( 'Example: 10, 10.99 or any numeric value.', 'kdesk_vc' ),
					'group'       => 'General',
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Period', 'kdesk_vc' ),
					'param_name'  => 'pricetable_period',
					'value'       => [
						esc_html__( 'Yearly', 'kdesk_vc' ) => 'year',
						esc_html__( 'Monthly', 'kdesk_vc' ) => 'month',
						esc_html__( 'Daily', 'kdesk_vc' )  => 'day',
						esc_html__( 'Hourly', 'kdesk_vc' ) => 'hour',
					],
					'description' => esc_html__( 'Choose plan duration.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Content Alignment', 'kdesk_vc' ),
					'param_name'  => 'content_alignment',
					'value'       => kdesk_content_alignment(),
					'description' => esc_html__( 'You can set pricing table content alignment.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Pricetable Details Type', 'kdesk_vc' ),
					'param_name' => 'pricetable_details_type',
					'value'      => [
						esc_html__( 'Lists', 'kdesk_vc' ) => 'list',
						esc_html__( 'Compact', 'kdesk_vc' ) => 'compact',
					],
					'group'      => 'Pricing Rows',
				],
				[
					'type'        => 'textarea_html',
					'class'       => '',
					'heading'     => esc_html__( 'Pricetable Details', 'kdesk_vc' ),
					'param_name'  => 'content',
					'value'       => '',
					'description' => 'For lists details type use the shortcode: [kdesk_pt_item title="feature text"]',
					'group'       => 'Pricing Rows',
				],

				// Regular

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Box Background', 'kdesk_vc' ),
					'param_name'  => 'pt_box_bg',
					'value'       => '#FAFAFA',
					'description' => esc_html__( 'Set box background.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Type Color', 'kdesk_vc' ),
					'param_name'  => 'pt_type_color',
					'value'       => '',
					'description' => esc_html__( 'Set regular pricetable type color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Currency Color', 'kdesk_vc' ),
					'param_name'  => 'pt_currency_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set regular pricetable currency color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Price Color', 'kdesk_vc' ),
					'param_name'  => 'pt_price_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set regular pricetable price color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Period Color', 'kdesk_vc' ),
					'param_name'  => 'pt_period_color',
					'value'       => '#646E7A',
					'description' => esc_html__( 'Set regular pricetable period color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Details Color', 'kdesk_vc' ),
					'param_name'  => 'pt_details_color',
					'value'       => '#2C2C2C',
					'description' => esc_html__( 'Set regular pricetable details color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text', 'kdesk_vc' ),
					'param_name'  => 'pricetable_link_text',
					'value'       => '',
					'description' => esc_html__( 'You can add custom button text.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
				],
				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Button URL', 'kdesk_vc' ),
					'param_name'  => 'pricetable_link',
					'value'       => '',
					'description' => esc_html__( 'You can add button llink.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Customize Regular Column', 'kdesk_vc' ),
					'param_name'  => 'pt_theme_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => 0,
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
					],
					'description' => esc_html__( 'Add your own colors for pricing table box, text and button.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Display Button Border', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_border',
					'value'       => [
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
						esc_html__( 'No', 'kdesk_vc' )  => 0,
					],
					'description' => esc_html__( 'Set No, if you hide button border.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_border_radius',
					'value'       => kdesk_border_radius(),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Background', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Border Color', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button border color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_hover_bg',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_hover_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Regular Button Hover Border Color', 'kdesk_vc' ),
					'param_name'  => 'pt_btn_hover_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover border color.', 'kdesk_vc' ),
					'group'       => 'Regular Column',
					'dependency'  => [ 'element' => 'pt_theme_status', 'value' => [ '1' ] ],
				],

				// Featured Column.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Set As  Featured Plan', 'kdesk_vc' ),
					'param_name'  => 'featured_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => 0,
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
					],
					'description' => esc_html__( 'Add can mark this colum as Featured.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Customize Featured Column', 'kdesk_vc' ),
					'param_name'  => 'fpt_theme_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => 0,
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
					],
					'description' => esc_html__( 'Add your own colors for featured pricing table box, text and button.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
				],

				[
					'type'        => 'colorpicker',
					'class'       => 'vc_col-xs-4',
					'heading'     => esc_html__( 'Featured Box Background', 'kdesk_vc' ),
					'param_name'  => 'fpt_box_bg',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set featured box background.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => 'vc_col-xs-4',
					'heading'     => esc_html__( 'Featured Type Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_type_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set featured pricetable type color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Currency Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_currency_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set featured pricetable Currency color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Price Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_price_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set featured pricetable Price color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Period Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_period_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set featured pricetable period color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Details Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_details_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set featured pricetable details color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				// Featured Button Pricing Table.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Display Button Border', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_border',
					'value'       => [
						esc_html__( 'Yes', 'kdesk_vc' ) => 1,
						esc_html__( 'No', 'kdesk_vc' )  => 0,
					],
					'description' => esc_html__( 'Set No, if you hide button border.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Border Radius', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_border_radius',
					'value'       => kdesk_border_radius(),
					'description' => esc_html__( 'Set button border radius.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Background', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button background.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Text Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button text color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Border Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button border color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				// Button Hover Color.
				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Hover Background', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_hover_bg',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover background.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Hover Text Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_hover_color',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Set button hover text color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Featured Button Hover Border Color', 'kdesk_vc' ),
					'param_name'  => 'fpt_btn_hover_border_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'Set button hover border color.', 'kdesk_vc' ),
					'group'       => 'Featured Column',
					'dependency'  => [ 'element' => 'fpt_theme_status', 'value' => [ '1' ] ],
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
