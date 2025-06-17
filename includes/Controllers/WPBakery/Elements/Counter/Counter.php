<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Counter;

/**
 * Class Counter
 *
 * Handles Counter WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Counter {
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
			esc_html__( 'SELECT', 'kdesk_vc' ) => '',
			esc_html__( 'Layout 01 (With background)', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 02 (Transparent background)', 'kdesk_vc' ) => 'layout_2',
		];

		$column = [
			esc_html__( 'SELECT', 'kdesk_vc' )           => '',
			esc_html__( '2 items each row', 'kdesk_vc' ) => '2',
			esc_html__( '3 items each row', 'kdesk_vc' ) => '3',
			esc_html__( '4 items each row (Default)', 'kdesk_vc' ) => '4',
			esc_html__( '6 items each row', 'kdesk_vc' ) => '6',
		];

		// Register "container" content element. It will hold all your inner (child) content elements
		vc_map([
            'name'                    => esc_html__( 'Counter', 'kdesk_vc' ),
            'description'             => esc_html__( 'Place Counter In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_counter',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_counter_item' ], // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            'content_element'         => true,
            'show_settings_on_create' => true,
            'controls'                => 'full',
            'is_container'            => false,
            'icon'                    => 'icon-kdesk-vc-addon',
            'params'                  => [
				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Counter Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select counter layout style.', 'kdesk_vc' ),
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
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Select Content Alignment', 'kdesk_vc' ),
					'param_name'  => 'text_align',
					'value'       => kdesk_content_alignment(),
					'group'       => 'General',
					'description' => esc_html__( 'Set content alignment of each counter block.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Count Time', 'kdesk_vc' ),
					'param_name'  => 'time',
					'value'       => kdesk_count_time(),
					'group'       => 'General',
					'description' => esc_html__( 'The total duration of the count up animation.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Count Delay', 'kdesk_vc' ),
					'param_name'  => 'delay',
					'value'       => kdesk_count_delay(),
					'group'       => 'General',
					'description' => esc_html__( 'The delay in milliseconds per number count up.', 'kdesk_vc' ),
				],

				[
					'type'       => 'checkbox',
					'class'      => '',
					'heading'    => esc_html__( 'Hide Icon?', 'kdesk_vc' ),
					'param_name' => 'hide_icon',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'General',
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
					'heading'     => esc_html__( 'Counter Box Background', 'kdesk_vc' ),
					'param_name'  => 'counter_bg',
					'value'       => '',
					'description' => esc_html__( 'Set counter box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Counter Color', 'kdesk_vc' ),
					'param_name'  => 'counter_color',
					'value'       => '',
					'description' => esc_html__( 'Set counter color.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
					'group'       => 'Design',
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Text Color', 'kdesk_vc' ),
					'param_name'  => 'text_color',
					'value'       => '',
					'description' => esc_html__( 'Set text color.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
					'group'       => 'Design',
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Icon Color', 'kdesk_vc' ),
					'param_name'  => 'icon_color',
					'value'       => '',
					'description' => esc_html__( 'Set icon color.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
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
            'js_view'                 => 'VcColumnView',
		]);

		vc_map([
            'name'            => esc_html__( 'Counter Item', 'kdesk_vc' ),
            'description'     => 'Add counter item',
            'base'            => 'kdesk_counter_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_counter' ],
            'params'          => [
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Counter Text', 'kdesk_vc' ),
					'param_name'  => 'counter_title',
					'value'       => '',
					'description' => 'Example:  Supports, Categories, Tags',
					'group'       => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Counter Value', 'kdesk_vc' ),
					'param_name'  => 'counter_value',
					'value'       => '',
					'description' => esc_html__( 'Add any number. Please do not add string.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'kdesk_vc' ),
					'param_name'  => 'icon',
					'settings'    => [
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'General',
					'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
				],

            ],
		]);
	}
}
