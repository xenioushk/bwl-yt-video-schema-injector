<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Logos;

/**
 * Class Logos
 *
 * Handles Logos WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Logos {
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
			esc_html__( 'SELECT', 'kdesk_vc' )          => '',
			esc_html__( 'Simple Layout', 'kdesk_vc' )   => 'layout_1',
			esc_html__( 'Carousel Layout', 'kdesk_vc' ) => 'layout_2',
		];

		vc_map([
            'name'                    => esc_html__( 'Logos', 'kdesk_vc' ),
            'description'             => esc_html__( 'Place Logo In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_logos',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_logo_item' ],
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
					'heading'     => esc_html__( 'Logos Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select logo layout style.', 'kdesk_vc' ),
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Items Per Row', 'kdesk_vc' ),
					'param_name'  => 'carousel_items',
					'value'       => kdesk_items_per_row( 6, 1 ),
					'group'       => 'General',
					'description' => esc_html__( 'Select no of item you like to show each row.', 'kdesk_vc' ),
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_2' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide two arrow will display beside the carousel items.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_2' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide bottom will display below the carousel items.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_2' ] ],
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
            'name'            => esc_html__( 'Logo item', 'kdesk_vc' ),
            'description'     => 'Add logo item',
            'base'            => 'kdesk_logo_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_logos' ],
            'params'          => [
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Logo Title', 'kdesk_vc' ),
					'param_name'  => 'logo_title',
					'description' => '',
					'group'       => 'General',
				],
				[
					'holder'      => 'image',
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Logo Image', 'kdesk_vc' ),
					'param_name'  => 'slider_image',
					'description' => '',
					'group'       => 'General',
				],
				[
					'admin_label' => true,
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Logo URL:', 'kdesk_vc' ),
					'param_name'  => 'logo_custom_link',
					'value'       => '',
					'description' => esc_html__( 'Add custom logo link.', 'kdesk_vc' ),
					'group'       => 'General',
				],

            ],
		]);
	}
}
