<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Heading;

/**
 * Class Heading
 *
 * Handles Heading WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Heading {
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
			esc_html__( 'Layout 01 ( Both Heading & Sub Heading )', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 02 ( Only Heading )', 'kdesk_vc' ) => 'layout_2',
			esc_html__( 'Inline Heading ( Best to Use In Post )', 'kdesk_vc' ) => 'layout_3',
			esc_html__( 'Light Heading ( For Dark Background )', 'kdesk_vc' ) => 'layout_light',
		];

		$theme = [
			esc_html__( 'Default', 'kdesk_vc' ) => '',
			esc_html__( 'Custom', 'kdesk_vc' )  => 'custom',
		];

		$border_height = [
			esc_html__( 'Select', 'kdesk_vc' ) => '',
			esc_html__( '1px', 'kdesk_vc' )    => '1',
			esc_html__( '2px', 'kdesk_vc' )    => '2',
			esc_html__( '3px', 'kdesk_vc' )    => '3',
			esc_html__( '4px', 'kdesk_vc' )    => '4',
			esc_html__( '5px', 'kdesk_vc' )    => '5',
			esc_html__( '6px', 'kdesk_vc' )    => '6',
		];

		// Wiz Heading Element.

		vc_map([
            'name'            => esc_html__( 'Heading Block', 'kdesk_vc' ),
            'description'     => esc_html__( 'Place Heading In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_vc_heading',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'icon'            => 'icon-kdesk-vc-addon',
            'params'          => [

				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Layout', 'kdesk_vc' ),
					'param_name' => 'layout',
					'value'      => $layout,
					'group'      => 'General',
				],

				[
					'admin_label' => true,
					'type'        => 'textarea',
					'class'       => '',
					'heading'     => esc_html__( 'Title', 'kdesk_vc' ),
					'param_name'  => 'title',
					'value'       => '',
					'description' => esc_html__( 'Add heading title', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'textarea',
					'class'       => '',
					'heading'     => esc_html__( 'Sub Title', 'kdesk_vc' ),
					'param_name'  => 'sub_title',
					'value'       => '',
					'description' => esc_html__( 'Add heading sub title', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1', 'layout_light' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Alter Heading Content Position', 'kdesk_vc' ),
					'param_name'  => 'alt_pos',
					'value'       => kdesk_boolean_term(),
					'description' => esc_html__( 'If you select Yes, then sub title will be displayed followed by the title.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_1', 'layout_light' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Content Alignment', 'kdesk_vc' ),
					'param_name'  => 'content_alignment',
					'value'       => kdesk_content_alignment(),
					'description' => esc_html__( 'Set the alignment of heading and sub-heading. Default: Center.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'bwl_cont_ext',
					'class'       => '',
					'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
					'param_name'  => 'cont_ext_class',
					'value'       => '',
					'description' => esc_html__( 'Add additional class for heading layout.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Theme', 'kdesk_vc' ),
					'param_name'  => 'theme',
					'value'       => $theme,
					'description' => esc_html__( 'Select custom to set your own heading, sub heading and seperator image.', 'kdesk_vc' ),
					'group'       => 'Design',
				],

				[
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Seperator Image', 'kdesk_vc' ),
					'param_name'  => 'sep_img',
					'description' => esc_html__( 'Recommended size: 100 X 24 px.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Title Color', 'kdesk_vc' ),
					'param_name'  => 'title_color',
					'value'       => KDESK_TEXT_COLOR,
					'description' => esc_html__( 'Add custom heading title', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Sub Title Color', 'kdesk_vc' ),
					'param_name'  => 'sub_title_color',
					'value'       => KDESK_TEXT_COLOR,
					'description' => esc_html__( 'Add sub-heading title', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Border Height', 'kdesk_vc' ),
					'param_name'  => 'border_height',
					'value'       => $border_height,
					'description' => esc_html__( 'Set border height.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'layout_3' ] ],
				],

				[
					'type'       => 'colorpicker',
					'class'      => '',
					'heading'    => esc_html__( 'Border Upper Color', 'kdesk_vc' ),
					'param_name' => 'border_upper',
					'value'      => '#40C1F0',
					'group'      => 'Design',
					'dependency' => [ 'element' => 'layout', 'value' => [ 'layout_3' ] ],
				],

				[
					'type'       => 'colorpicker',
					'class'      => '',
					'heading'    => esc_html__( 'Border Bottom Color', 'kdesk_vc' ),
					'param_name' => 'border_bottom',
					'value'      => '#EEEEEE',
					'group'      => 'Design',
					'dependency' => [ 'element' => 'layout', 'value' => [ 'layout_3' ] ],
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
