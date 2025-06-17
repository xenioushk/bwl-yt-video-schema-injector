<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Testimonial;

/**
 * Class Testimonial
 *
 * Handles Testimonial WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Testimonial {
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
			esc_html__( 'Layout 1 (Carousel)', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 2(Simple)', 'kdesk_vc' ) => 'layout_2',
		];

		vc_map([
            'name'                    => esc_html__( 'Testimonials', 'kdesk_vc' ),
            'description'             => esc_html__( 'Place Testimonials In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_testimonial',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_testimonial_item' ],
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
					'heading'     => esc_html__( 'Testimonial Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select Testimonial Layout Style.', 'kdesk_vc' ),
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Item Per Row', 'kdesk_vc' ),
					'param_name' => 'item_per_row',
					'value'      => kdesk_items_per_row( 3, 1 ),
					'group'      => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide two arrow will display beside the carousel items.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide bottom will display below the carousel items.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1' ] ],
				],

				// DESIGN TAB.

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Content Alignment', 'kdesk_vc' ),
					'param_name' => 'alignment',
					'value'      => kdesk_content_alignment(),
					'group'      => 'Design',
				],

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
					'description' => esc_html__( 'This color will apply in Icon color and navigation button.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of testimonial box.', 'kdesk_vc' ),
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
            'name'            => esc_html__( 'Testimonial Item', 'kdesk_vc' ),
            'description'     => 'Add testimonial item.',
            'base'            => 'kdesk_testimonial_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_testimonial' ],
            'params'          => [
				[
					'admin_label' => true,
					'type'        => 'textarea',
					'heading'     => esc_html__( 'Testimonial Text', 'kdesk_vc' ),
					'param_name'  => 'testimonial_info',
				],

				[
					'admin_label' => true,
					'type'        => 'textfield',
					'heading'     => esc_html__( 'User Name', 'kdesk_vc' ),
					'param_name'  => 'user_name',
				],

				[
					'type'       => 'textfield',
					'heading'    => esc_html__( 'User Designation', 'kdesk_vc' ),
					'param_name' => 'user_designation',
				],

				[
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'User Image', 'kdesk_vc' ),
					'param_name' => 'user_image',
				],

            ],
		]);
	}
}
