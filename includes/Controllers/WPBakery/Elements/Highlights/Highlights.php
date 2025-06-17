<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Highlights;

/**
 * Class Highlights
 *
 * Handles Highlights WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Highlights {
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
			esc_html__( 'Layout 01 ( Icon Box Top )', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 02 ( Transparent Icon Box Top )', 'kdesk_vc' ) => 'layout_2',
			esc_html__( 'Layout 03 ( Transparent Icon Box Right )', 'kdesk_vc' ) => 'layout_3',
		];

		$columns = [
			esc_html__( '4 Columns (Default)', 'kdesk_vc' ) => 4,
			esc_html__( '3 Columns', 'kdesk_vc' ) => 3,
			esc_html__( '2 Columns', 'kdesk_vc' ) => 2,
			esc_html__( '1 Column', 'kdesk_vc' )  => 1,
		];

		// Register "container" content element. It will hold all your inner (child) content elements
		vc_map([
            'name'                    => esc_html__( 'Highlight Box', 'kdesk_vc' ),
            'description'             => esc_html__( 'Add Multiple Highlight Blocks.', 'kdesk_vc' ),
            'base'                    => 'kdesk_highlights',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_highlights_item' ], // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
					'heading'     => esc_html__( 'Highlight Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select highlight layout style.', 'kdesk_vc' ),
				],
				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Column', 'kdesk_vc' ),
					'param_name'  => 'columns',
					'value'       => $columns,
					'group'       => 'General',
					'description' => esc_html__( 'Select number columns each row.', 'kdesk_vc' ),
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Content Alignment', 'kdesk_vc' ),
					'param_name' => 'content_alignment',
					'value'      => kdesk_content_alignment(),
					'group'      => 'General',
				],

				[
					'type'       => 'checkbox',
					'class'      => '',
					'heading'    => esc_html__( 'Enable Carousel?', 'kdesk_vc' ),
					'param_name' => 'carousel',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide two arrow will display beside the carousel items.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide bottom will display below the carousel items.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				// DESIGN TAB.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Box Shadow?', 'kdesk_vc' ),
					'param_name'  => 'box_shadow_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => '0',
						esc_html__( 'Yes', 'kdesk_vc' ) => '1',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'You can add box shadow animation in highlight box.', 'kdesk_vc' ),
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
					'heading'     => esc_html__( 'Navigation Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'This color will apply in seperator line, carousel navigation arrows and dots.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Box Background', 'kdesk_vc' ),
					'param_name'  => 'theme_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Regular highlight box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Box Hover Background', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_bg',
					'value'       => '#FBFBFB',
					'description' => esc_html__( 'On mouse hover highlight box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'This color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Hover Color', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_color',
					'value'       => '#FAFAFA',
					'description' => esc_html__( 'On mouse hover this color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Show Border?', 'kdesk_vc' ),
					'param_name'  => 'border_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Design',
					'description' => esc_html__( 'Hide border from highlight box.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Border Color', 'kdesk_vc' ),
					'param_name'  => 'theme_border',
					'value'       => '#EBEBEB',
					'description' => esc_html__( 'Set border color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'border_status', 'value' => [ '1' ] ],
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
            'name'            => esc_html__( 'Highlight Item', 'kdesk_vc' ),
            'description'     => 'Add highlights item',
            'base'            => 'kdesk_highlights_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_highlights' ], // Use only|except attributes to limit parent (separate multiple values with comma)
            'params'          => [
				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Title', 'kdesk_vc' ),
					'param_name'  => 'title',
					'value'       => '',
					'description' => esc_html__( 'Set the heading of highlights box. Example - Support Forum.', 'kdesk_vc' ),
					'group'       => 'General',
				],
				[
					'type'        => 'textarea',
					'class'       => '',
					'heading'     => esc_html__( 'Content', 'kdesk_vc' ),
					'param_name'  => 'highlights_content',
					'value'       => '',
					'description' => esc_html__( 'Write a brief about highlight content.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Icon Type', 'kdesk_vc' ),
					'param_name'  => 'icon_type',
					'value'       => [
						esc_html__( 'Font Awesome Icon ( Default )', 'kdesk_vc' ) => 'fa_icon',
						esc_html__( 'Custom Image', 'kdesk_vc' ) => 'img_icon',
					],
					'group'       => 'General',
					'description' => esc_html__( 'Display read more button in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'kdesk_vc' ),
					'param_name'  => 'icon',
					'settings'    => [
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 20, // default 100, how many icons per/page to display
					],
					'group'       => 'General',
					'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'icon_type', 'value' => [ 'fa_icon' ] ],
				],

				[
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Highlight Image', 'kdesk_vc' ),
					'param_name'  => 'highlights_img',
					'description' => esc_html__( 'Add Highlight image', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'icon_type', 'value' => [ 'img_icon' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Badge Box?', 'kdesk_vc' ),
					'param_name'  => 'badge_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'Display Badge Box in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Badge Box Text', 'kdesk_vc' ),
					'param_name'  => 'badge_text',
					'value'       => '',
					'description' => esc_html__( 'Example - New, Hot, Speical etc.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'badge_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Badge Theme?', 'kdesk_vc' ),
					'param_name'  => 'badge_theme',
					'value'       => [
						'Gray'       => 'label-secondary',
						'Blue'       => 'label-primary',
						'Green'      => 'label-success',
						'Red'        => 'label-danger',
						'Yellow'     => 'label-warning',
						'Light Blue' => 'label-info',
						'White'      => 'label-light',
						'Black'      => 'label-dark',
					],
					'group'       => 'General',
					'description' => esc_html__( 'Select badge theme.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'badge_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Read More Button', 'kdesk_vc' ),
					'param_name'  => 'rm_link_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Button',
					'description' => esc_html__( 'Display read more button in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text', 'kdesk_vc' ),
					'param_name'  => 'url_text',
					'value'       => esc_html__( 'Read More', 'kdesk_vc' ),
					'description' => esc_html__( 'Set custom text for button. Default - Read more', 'kdesk_vc' ),
					'group'       => 'Button',
					'dependency'  => [ 'element' => 'rm_link_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Read More Link', 'kdesk_vc' ),
					'param_name'  => 'read_more_link',
					'value'       => '',
					'description' => esc_html__( 'You can set custom link of heading/read more button.', 'kdesk_vc' ),
					'group'       => 'Button',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button Extra Class', 'kdesk_vc' ),
					'param_name'  => 'ext_btn_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of button.', 'kdesk_vc' ),
					'group'       => 'Button',
					'dependency'  => [ 'element' => 'rm_link_status', 'value' => [ '1' ] ],
				],

				// Read More BUtton#2

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Read More Button 2', 'kdesk_vc' ),
					'param_name'  => 'rm_link_status_2',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Button 02',
					'description' => esc_html__( 'Display read more button 2 in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button 2 Text', 'kdesk_vc' ),
					'param_name'  => 'url_text_2',
					'value'       => esc_html__( 'Live Demo', 'kdesk_vc' ),
					'description' => esc_html__( 'Set custom text for button. Default - Live Demo', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'rm_link_status_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Read More 2 Link', 'kdesk_vc' ),
					'param_name'  => 'read_more_link_2',
					'value'       => '',
					'description' => esc_html__( 'You can set custom link of heading/read more button.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'rm_link_status_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button 02 Extra Class', 'kdesk_vc' ),
					'param_name'  => 'ext_btn_class_2',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of button 02.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'rm_link_status_2', 'value' => [ '1' ] ],
				],

				// DESIGN TAB.

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of highlight box.', 'kdesk_vc' ),
					'group'       => 'Design',
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
					'description' => esc_html__( 'Choose Custom to create your own highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Box Background', 'kdesk_vc' ),
					'param_name'  => 'theme_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Regular highlight box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Box Hover Background', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_bg',
					'value'       => '#FBFBFB',
					'description' => esc_html__( 'On mouse hover highlight box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'This color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Hover Color', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_color',
					'value'       => '#FAFAFA',
					'description' => esc_html__( 'On mouse hover this color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Show Border?', 'kdesk_vc' ),
					'param_name'  => 'border_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Design',
					'description' => esc_html__( 'Hide border from highlight box.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Border Color', 'kdesk_vc' ),
					'param_name'  => 'theme_border',
					'value'       => '#EBEBEB',
					'description' => esc_html__( 'Set border color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'border_status', 'value' => [ '1' ] ],
				],
            ],
		]);

		// SINGLE HIGHLIGHT VC BLOCK.

		vc_map([
            'name'            => esc_html__( 'Single Highlight Box', 'kdesk_vc' ),
            'description'     => esc_html__( 'Add Single Highlight Block.', 'kdesk_vc' ),
            'base'            => 'kdesk_single_highlight',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [
				// add params same as with any other content element

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select layout style.', 'kdesk_vc' ),
				],
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Title', 'kdesk_vc' ),
					'param_name'  => 'title',
					'value'       => '',
					'group'       => 'General',
				],
				[
					'type'       => 'textarea',
					'class'      => '',
					'heading'    => esc_html__( 'Content', 'kdesk_vc' ),
					'param_name' => 'highlights_content',
					'value'      => '',
					'group'      => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Icon Type', 'kdesk_vc' ),
					'param_name'  => 'icon_type',
					'value'       => [
						esc_html__( 'Font Awesome Icon ( Default )', 'kdesk_vc' ) => 'fa_icon',
						esc_html__( 'Custom Image', 'kdesk_vc' ) => 'img_icon',
					],
					'group'       => 'General',
					'description' => esc_html__( 'Display read more button in highlight box.', 'kdesk_vc' ),
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
					'dependency'  => [ 'element' => 'icon_type', 'value' => [ 'fa_icon' ] ],
				],

				[
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Highlight Image', 'kdesk_vc' ),
					'param_name'  => 'highlights_img',
					'description' => esc_html__( 'Add Highlight image', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'icon_type', 'value' => [ 'img_icon' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Badge Box?', 'kdesk_vc' ),
					'param_name'  => 'badge_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'Display Badge Box in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Badge Box Text', 'kdesk_vc' ),
					'param_name'  => 'badge_text',
					'value'       => '',
					'description' => esc_html__( 'Example - New, Hot, Speical etc.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'badge_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Badge Theme?', 'kdesk_vc' ),
					'param_name'  => 'badge_theme',
					'value'       => [
						'Gray'       => 'label-secondary',
						'Blue'       => 'label-primary',
						'Green'      => 'label-success',
						'Red'        => 'label-danger',
						'Yellow'     => 'label-warning',
						'Light Blue' => 'label-info',
						'White'      => 'label-light',
						'Black'      => 'label-dark',
					],
					'group'       => 'General',
					'description' => esc_html__( 'Select badge theme.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'badge_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Read More Button', 'kdesk_vc' ),
					'param_name'  => 'rm_link_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Button',
					'description' => esc_html__( 'Display read more button in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button Text', 'kdesk_vc' ),
					'param_name'  => 'url_text',
					'value'       => esc_html__( 'Read More', 'kdesk_vc' ),
					'description' => esc_html__( 'Set custom text for button. Default - Read more', 'kdesk_vc' ),
					'group'       => 'Button',
					'dependency'  => [ 'element' => 'rm_link_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Read More Link', 'kdesk_vc' ),
					'param_name'  => 'read_more_link',
					'value'       => '',
					'description' => esc_html__( 'You can set custom link of heading/read more button.', 'kdesk_vc' ),
					'group'       => 'Button',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button Extra Class', 'kdesk_vc' ),
					'param_name'  => 'ext_btn_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of button.', 'kdesk_vc' ),
					'group'       => 'Button',
					'dependency'  => [ 'element' => 'rm_link_status', 'value' => [ '1' ] ],
				],

				// Read More BUtton#2

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Read More Button 2', 'kdesk_vc' ),
					'param_name'  => 'rm_link_status_2',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Button 02',
					'description' => esc_html__( 'Display read more button 2 in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button 2 Text', 'kdesk_vc' ),
					'param_name'  => 'url_text_2',
					'value'       => esc_html__( 'Live Demo', 'kdesk_vc' ),
					'description' => esc_html__( 'Set custom text for button. Default - Live Demo', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'rm_link_status_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Read More 2 Link', 'kdesk_vc' ),
					'param_name'  => 'read_more_link_2',
					'value'       => '',
					'description' => esc_html__( 'You can set custom link of heading/read more button.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'rm_link_status_2', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Button 02 Extra Class', 'kdesk_vc' ),
					'param_name'  => 'ext_btn_class_2',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of button 02.', 'kdesk_vc' ),
					'group'       => 'Button 02',
					'dependency'  => [ 'element' => 'rm_link_status_2', 'value' => [ '1' ] ],
				],

				// DESIGN TAB.

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of highlight box.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Box Shadow?', 'kdesk_vc' ),
					'param_name'  => 'box_shadow_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => '0',
						esc_html__( 'Yes', 'kdesk_vc' ) => '1',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'You can add box shadow animation in highlight box.', 'kdesk_vc' ),
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Content Alignment', 'kdesk_vc' ),
					'param_name' => 'content_alignment',
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
					'description' => esc_html__( 'Choose Custom to create your own highlight box.', 'kdesk_vc' ),
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Box Background', 'kdesk_vc' ),
					'param_name'  => 'theme_bg',
					'value'       => '#FFFFFF',
					'description' => esc_html__( 'Regular highlight box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Box Hover Background', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_bg',
					'value'       => '#FBFBFB',
					'description' => esc_html__( 'On mouse hover highlight box background.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => '#40C1F0',
					'description' => esc_html__( 'This color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Hover Color', 'kdesk_vc' ),
					'param_name'  => 'theme_hover_color',
					'value'       => '#FAFAFA',
					'description' => esc_html__( 'On mouse hover this color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Show Border?', 'kdesk_vc' ),
					'param_name'  => 'border_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Design',
					'description' => esc_html__( 'Hide border from highlight box.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Border Color', 'kdesk_vc' ),
					'param_name'  => 'theme_border',
					'value'       => '#EBEBEB',
					'description' => esc_html__( 'Set border color.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'border_status', 'value' => [ '1' ] ],
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
