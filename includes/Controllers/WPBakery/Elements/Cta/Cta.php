<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Cta;

/**
 * Class Cta
 *
 * Handles Cta WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Cta {
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
            esc_html__( 'Layout 01 (Video Link CTA) ', 'kdesk_vc' ) => 'layout_1',
            esc_html__( 'Layout 02 (Two Column CTA)', 'kdesk_vc' ) => 'layout_2',
            esc_html__( 'Layout 03 (Simple Text CTA)', 'kdesk_vc' ) => 'layout_3',
        ];

        vc_map([
            'name'            => esc_html__( 'CTA', 'kdesk_vc' ),
            'description'     => esc_html__( 'Display Call To Action Box In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_vc_cta',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [
                [
                    'admin_label' => true,
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__( 'Layout', 'kdesk_vc' ),
                    'param_name'  => 'layout',
                    'value'       => $layout,
                    'description' => esc_html__( 'Select Layout of Call To Action Box', 'kdesk_vc' ),
                    'group'       => 'General',
                ],
                [
                    'admin_label' => true,
                    'type'        => 'textarea',
                    'class'       => '',
                    'heading'     => esc_html__( 'Main Intro', 'kdesk_vc' ),
                    'param_name'  => 'main_intro',
                    'value'       => '',
                    'group'       => 'General',
                ],
                [
                    'type'       => 'textarea',
                    'class'      => '',
                    'heading'    => esc_html__( 'Sub Intro', 'kdesk_vc' ),
                    'param_name' => 'sub_intro',
                    'value'      => '',
                    'group'      => 'General',
                    'dependency' => [
                        'element' => 'layout',
                        'value'   => [ 'layout_1', 'layout_2' ],
                    ],
                ],

                [
                    'type'        => 'textfield',
                    'class'       => '',
                    'heading'     => esc_html__( 'CTA/Video Link', 'kdesk_vc' ),
                    'param_name'  => 'cta_link',
                    'value'       => '',
                    'description' => esc_html__( 'Video CTA Link Example: https://www.youtube.com/watch?v=nrJtHemSPW4', 'kdesk_vc' ),
                    'group'       => 'General',
                    'dependency'  => [
                        'element' => 'layout',
                        'value'   => [ 'layout_1', 'layout_2', 'layout_3' ],
                    ],
                ],
                [
                    'type'        => 'textfield',
                    'class'       => '',
                    'heading'     => esc_html__( 'CTA Button Text', 'kdesk_vc' ),
                    'param_name'  => 'button_text',
                    'value'       => '',
                    'description' => esc_html__( 'Example: Join With Us, Contact Today, Make A Call', 'kdesk_vc' ),
                    'group'       => 'General',
                    'dependency'  => [
                        'element' => 'layout',
                        'value'   => [ 'layout_2', 'layout_3' ],
                    ],
                ],

                [
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Video Icon', 'kdesk_vc' ),
                    'param_name'  => 'icon',
                    'value'       => 'fa-play',
                    'settings'    => [
                        'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                        'type'         => 'fontawesome',
                        'iconsPerPage' => 50, // default 100, how many icons per/page to display
                    ],
                    'group'       => 'General',
                    'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
                    'dependency'  => [
                        'element' => 'layout',
                        'value'   => [ 'layout_1' ],
                    ],
                ],

                [
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__( 'Video Button Style', 'kdesk_vc' ),
                    'param_name'  => 'video_btn_style',
                    'value'       => [
                        esc_html__( 'Rounded ( Default)', 'kdesk_vc' ) => 'cta-video-btn-round',
                        esc_html__( 'Semi Rounded', 'kdesk_vc' ) => 'cta-video-btn-semi-round',
                        esc_html__( 'Square', 'kdesk_vc' ) => 'cta-video-btn-square',
                    ],
                    'group'       => 'General',
                    'description' => esc_html__( 'Set video button style.', 'kdesk_vc' ),
                    'dependency'  => [
                        'element' => 'layout',
                        'value'   => [ 'layout_1' ],
                    ],
                ],

                [
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__( 'Video Button Position', 'kdesk_vc' ),
                    'param_name'  => 'video_btn_pos',
                    'value'       => [
                        esc_html__( 'Bottom ( Default)', 'kdesk_vc' ) => 'bottom',
                        esc_html__( 'Middle', 'kdesk_vc' ) => 'middle',
                        esc_html__( 'Top', 'kdesk_vc' )    => 'top',
                    ],
                    'group'       => 'General',
                    'description' => esc_html__( 'Set video button position.', 'kdesk_vc' ),
                    'dependency'  => [
                        'element' => 'layout',
                        'value'   => [ 'layout_1' ],
                    ],
                ],

                [
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__( 'Hide CTA Button', 'kdesk_vc' ),
                    'param_name'  => 'cta_btn_status',
                    'value'       => kdesk_boolean_term(),
                    'description' => esc_html__( 'Select Yes to hide CTA button.', 'kdesk_vc' ),
                    'group'       => 'General',
                    'dependency'  => [
                        'element' => 'layout',
                        'value'   => [ 'layout_3' ],
                    ],
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
                    'heading'     => esc_html__( 'Main Intro Color', 'kdesk_vc' ),
                    'param_name'  => 'main_intro_color',
                    'value'       => KDESK_TEXT_COLOR,
                    'description' => esc_html__( 'This color will apply in CTA heading text.', 'kdesk_vc' ),
                    'group'       => 'Design',
                    'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
                ],

                [
                    'type'        => 'colorpicker',
                    'class'       => '',
                    'heading'     => esc_html__( 'Sub Intro Color', 'kdesk_vc' ),
                    'param_name'  => 'sub_intro_color',
                    'value'       => KDESK_TEXT_COLOR,
                    'description' => esc_html__( 'This color will apply in CTA sub heading text.', 'kdesk_vc' ),
                    'group'       => 'Design',
                    'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
                ],

                [
                    'type'        => 'textfield',
                    'class'       => '',
                    'heading'     => esc_html__( 'Container Extra Class', 'kdesk_vc' ),
                    'param_name'  => 'cont_ext_class',
                    'value'       => '',
                    'description' => esc_html__( 'Add additional class of cta box.', 'kdesk_vc' ),
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
        ]);
    }
}
