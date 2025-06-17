<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Gallery;

/**
 * Class Gallery
 *
 * Handles Gallery WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Gallery {
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
			esc_html__( 'SELECT', 'kdesk_vc' )             => '',
			esc_html__( 'Layout 01 (Simple)', 'kdesk_vc' ) => 'simple',
			esc_html__( 'Layout 02 (Carousel)', 'kdesk_vc' ) => 'carousel',
		];

		$columns = [
			esc_html__( '4 Columns (Default)', 'kdesk_vc' ) => 4,
			esc_html__( '3 Columns', 'kdesk_vc' ) => 3,
			esc_html__( '2 Columns', 'kdesk_vc' ) => 2,
			esc_html__( '1 Column', 'kdesk_vc' )  => 1,
		];

		// Register "container" content element. It will hold all your inner (child) content elements
		vc_map([
            'name'                    => esc_html__( 'Gallery', 'kdesk_vc' ),
            'description'             => esc_html__( 'Place Gallery In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_gallery',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_gallery_item' ], // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            'content_element'         => true,
            'show_settings_on_create' => true,
            'controls'                => 'full',
            'is_container'            => false,
            'icon'                    => 'icon-kdesk-vc-addon',
            'params'                  => [
				// add params same as with any other content element
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select gallery layout style.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Column', 'kdesk_vc' ),
					'param_name'  => 'column',
					'value'       => $columns,
					'group'       => 'General',
					'description' => esc_html__( 'Select number columns each row.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation Arrow?', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide arrow beside the carousel items.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'carousel' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots ?', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide dots below the carousel items.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'carousel' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'carousel' ] ],
				],

				// DESIGN TAB.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable No Padding Gallery', 'kdesk_vc' ),
					'param_name'  => 'no_padding',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Design',
					'description' => esc_html__( 'If you select yes, then there will no space between each column.', 'kdesk_vc' ),
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
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'kdesk_vc' ),
					'param_name'  => 'icon',
					'settings'    => [
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'Design',
					'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'This color will apply in overlay & Icon color button.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
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
            'name'            => esc_html__( 'Gallery Item', 'kdesk_vc' ),
            'description'     => 'Add Gallery Item',
            'base'            => 'kdesk_gallery_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_gallery' ], // Use only|except attributes to limit parent (separate multiple values with comma)
            'params'          => [
				[
					'holder'      => 'image',
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Choose Image', 'kdesk_vc' ),
					'param_name'  => 'gallery_img',
					'description' => esc_html__( 'Select gallery image.', 'kdesk_vc' ),
					'group'       => 'General',
				],

            ],
		]);
	}
}
