<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Jumbotron;

/**
 * Class Jumbotron
 *
 * Handles Jumbotron WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Jumbotron {
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
			esc_html__( 'Layout 01( Display heading, sub heading & search box)', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 02( Display heading, sub heading & buttons) ', 'kdesk_vc' ) => 'layout_2',
			esc_html__( 'Layout 03( Display sub heading & buttons) ', 'kdesk_vc' ) => 'layout_3',
		];

		// Knowledgebase Jumbotron Element.

		vc_map([
            'name'            => esc_html__( 'Jumbo Search Box', 'bkb_vc' ),
            'description'     => esc_html__( 'Place large search box in home page.', 'kdesk_vc' ),
            'base'            => 'kdesk_jumbotron',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Choose Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'group'       => 'General',
					'description' => esc_html__( 'Select search box layout style.', 'kdesk_vc' ),
				],

				[
					'admin_label' => true,
					'type'        => 'textarea',
					'class'       => '',
					'heading'     => esc_html__( 'Heading Text', 'kdesk_vc' ),
					'param_name'  => 'heading_text',
					'value'       => '',
					'description' => esc_html__( 'Add heading text.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1', 'layout_2' ] ],
				],

				[
					'admin_label' => true,
					'type'        => 'textarea',
					'class'       => '',
					'heading'     => esc_html__( 'Sub-heading Text', 'kdesk_vc' ),
					'param_name'  => 'sub_heading_text',
					'value'       => '',
					'description' => esc_html__( 'Add sub heading text.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Search Placeholder Text', 'kdesk_vc' ),
					'param_name'  => 'search_placeholder_text',
					'value'       => '',
					'description' => esc_html__( 'Add sub heading text.', 'kdesk_vc' ),
					'group'       => 'Search Box',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1', 'layout_3' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Search Box Additional Class', 'kdesk_vc' ),
					'param_name'  => 'sbox_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional search box classes.', 'kdesk_vc' ),
					'group'       => 'Search Box',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1', 'layout_3' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Navigation Button?', 'bkb_vc' ),
					'param_name'  => 'nav_btn_status',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Buttons',
					'description' => 'Display rounded navigation button below the search box.',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Navigation Button Target ID', 'kdesk_vc' ),
					'param_name'  => 'nav_btn_target',
					'value'       => '',
					'description' => esc_html__( 'Set the target section when clicn on the button.', 'kdesk_vc' ),
					'group'       => 'Buttons',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1' ] ],
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Enable Button#1', 'kdesk_vc' ),
					'param_name' => 'btn_1_status',
					'value'      => kdesk_boolean_term(),
					'group'      => 'General',
					'dependency' => [ 'element' => 'layout', 'value' => [ 'layout_2', 'layout_3' ] ],
				],

				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Button#1 Text', 'kdesk_vc' ),
					'param_name'  => 'btn_1_text',
					'value'       => esc_html__( 'BROWSE CATEGORIES', 'kdesk_vc' ),
					'description' => '',
					'group'       => 'General',
					'dependency'  => [ 'element' => 'btn_1_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'vc_link',
					'heading'     => esc_html__( 'Button#1 URL', 'kdesk_vc' ),
					'param_name'  => 'btn_1_url',
					'value'       => '',
					'description' => '',
					'group'       => 'General',
					'dependency'  => [ 'element' => 'btn_1_status', 'value' => [ '1' ] ],
				],

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Enable Button#2', 'kdesk_vc' ),
					'param_name' => 'btn_2_status',
					'value'      => kdesk_boolean_term(),
					'group'      => 'General',
					'dependency' => [ 'element' => 'layout', 'value' => [ 'layout_2', 'layout_3' ] ],
				],

				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Button#2 Text', 'kdesk_vc' ),
					'param_name'  => 'btn_2_text',
					'value'       => esc_html__( 'ASK QUESTION', 'kdesk_vc' ),
					'description' => '',
					'group'       => 'General',
					'dependency'  => [ 'element' => 'btn_2_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'vc_link',
					'heading'     => esc_html__( 'Button#2 URL', 'kdesk_vc' ),
					'param_name'  => 'btn_2_url',
					'value'       => '',
					'description' => '',
					'group'       => 'General',
					'dependency'  => [ 'element' => 'btn_2_status', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class of jumbotron search box.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Heading Text Class', 'kdesk_vc' ),
					'param_name'  => 'heading_text_class',
					'value'       => '',
					'description' => esc_html__( 'Add heading text class.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1', 'layout_2' ] ],
				],

				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Sub-heading Class', 'kdesk_vc' ),
					'param_name'  => 'sub_heading_text_class',
					'value'       => '',
					'description' => esc_html__( 'Add sub heading text class.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'       => 'attach_image',
					'class'      => '',
					'heading'    => esc_html__( 'Background Image', 'kdesk_vc' ),
					'param_name' => 'jumbotron_img',
					'value'      => '',
					'group'      => 'Design',
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Overlay Color', 'kdesk_vc' ),
					'param_name'  => 'overlay_color',
					'value'       => '',
					'description' => esc_html__( 'Set overlay color', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Overlay Opacity', 'kdesk_vc' ),
					'param_name'  => 'opacity',
					'value'       => kdesk_overlay_opacity(),
					'group'       => 'Design',
					'description' => esc_html__( 'Set overlay color opacity', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Background Repeat', 'kdesk_vc' ),
					'param_name'  => 'bg_repeat',
					'value'       => [
						esc_html__( 'Repeat', 'kdesk_vc' ) => 'repeat',
						esc_html__( 'No Repeat', 'kdesk_vc' ) => 'no-repeat',
						esc_html__( 'Repeat-X', 'kdesk_vc' ) => 'repeat-x',
						esc_html__( 'Repeat-Y', 'kdesk_vc' ) => 'repeat-y',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'Set background repeat mode.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Background Size', 'kdesk_vc' ),
					'param_name'  => 'bg_size',
					'value'       => [
						esc_html__( 'Cover', 'kdesk_vc' ) => 'cover',
						esc_html__( 'Contain', 'kdesk_vc' ) => 'contain',
						esc_html__( 'Initial', 'kdesk_vc' ) => 'initial',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'Set background size mode.', 'kdesk_vc' ),
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
