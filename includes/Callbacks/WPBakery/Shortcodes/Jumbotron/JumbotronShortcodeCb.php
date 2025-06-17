<?php

namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Jumbotron;

use KAFWPB\Controllers\WPBakery\Support\Animation;

/**
 * Class Jumbotron Shortcode Callback.
 *
 * @package KDESKADDON
 */
class JumbotronShortcodeCb {

    /**
     * Jumbotron Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     */
    public function get_shortcode_output( $atts ) {
        $atts = shortcode_atts(
            [
                'jsb_id'                  => wp_rand( 999, 2350 ),
                'layout'                  => 'layout_1',
                'jumbotron_img'           => '',
                'overlay_color'           => '#000000',
                'opacity'                 => '0.1',
                'bg_repeat'               => 'repeat',
                'bg_size'                 => 'cover',
                'heading_text'            => '',
                'heading_text_class'      => '',
                'heading_status'          => 1,

                'sub_heading_text'        => '',
                'sub_heading_text_class'  => '',
                'sub_heading_status'      => 1,

                'search_box_status'       => 0,
                'search_placeholder_text' => esc_html__( 'Search Keywords ..... ', 'kdesk_vc' ),
                'sbox_class'              => '',

                'button_status'           => 1,
                'btn_1_status'            => 1,
                'btn_1_text'              => esc_html__( 'BROWSE CATEGORIES', 'kdesk_vc' ),
                'btn_1_url'               => '#',
                'btn_2_status'            => 1,
                'btn_2_text'              => esc_html__( 'ASK QUESTION', 'kdesk_vc' ),
                'btn_2_url'               => '#',
                'nav_btn_status'          => 0,
                'nav_btn_target'          => 'feature',
                'animation'               => '',
                'cont_ext_class'          => '',
            ],
            $atts
        );

        extract( $atts ); //phpcs:ignore

        // Background image repeat.

        $bg_repeat = isset( $bg_repeat ) ? $bg_repeat : 'repeat';

        // Background image size.

        $bg_size = isset( $bg_size ) ? $bg_size : 'cover';

        // Image

        $large_img_src = wp_get_attachment_image_src( $jumbotron_img, 'full' );

        if ( isset( $large_img_src[0] ) ) {
            $large_img_src = $large_img_src[0];
        } else {
            $large_img_src = 0;
        }

        $overlay_color = kdesk_hex_to_rgb( $overlay_color );

        // Heading Text.

        $heading_text_class = ( isset( $heading_text_class ) && $heading_text_class != '' ) ? ' class="' . $heading_text_class . '"' : '';

        $heading_text = ( $heading_text == '' ) ? '' : '<h2' . $sub_heading_text_class . '>' . $heading_text . '</h2>';

        // Sub Heading Text.

        $sub_heading_text_class = ( isset( $sub_heading_text_class ) && $sub_heading_text_class != '' ) ? ' class="' . $sub_heading_text_class . '"' : '';

        $sub_heading_text = ( $sub_heading_text == '' ) ? '<h3' . $sub_heading_text_class . '>The Ultimate Knowledgebase Management Solution Helps Customer To Get Quick Self Care Support And Boost Customer Satisfaction.</h3>' : '<h3' . $sub_heading_text_class . '>' . $sub_heading_text . '</h3>';

        // Search Box.

        $sbox_class = ( isset( $sbox_class ) && $sbox_class != '' ) ? ' bkb-jumbo-search-box ' . $sbox_class : 'bkb-jumbo-search-box';

        $search_box = ( $layout == 'layout_2' ) ? '' : '<div class="search-form-container">' . do_shortcode( '[bkb_search placeholder="' . $search_placeholder_text . '" cont_ext_class="' . $sbox_class . '"]' ) . '</div>';

        // Regular Button.

        $btn_display_status = 0;
        $btn_1_html         = '';

        if ( $btn_1_status == 1 ) {

            $btn_display_status = 1;
            $btn_1_url_string   = vc_build_link( $btn_1_url );
            $btn_1_html        .= '<a href="' . $btn_1_url_string['url'] . '" class="btn btn-jumbotron-2 nav_menu">' . $btn_1_text . '</a>';
        }

        $btn_2_html = '';

        if ( $btn_2_status == 1 ) {

            $btn_display_status = 1;
            $btn_2_url_string   = vc_build_link( $btn_2_url );
            $btn_2_html        .= '<a href="' . $btn_2_url_string['url'] . '" class="btn btn-jumbotron nav_menu">' . $btn_2_text . '</a>';
        }

        if ( $btn_display_status == 0 ) {

            $regular_btn = '';
        } else {
            $regular_btn = '<div class=" jumbotron-btn-container">'
                . $btn_1_html
                . $btn_2_html
                . '</div>';
        }

        // Naviation Button.

        $nav_btn = '<div class="hidden-sm hidden-xs">
                                <a href="#' . $nav_btn_target . '" class="btn btn-animated nav_menu"><i class="fa fa-angle-double-down"></i></a>
                            </div>';

        if ( isset( $nav_btn_status ) && $nav_btn_status == 1 ) {

            $nav_btn = '';
        }

        $regular_btn = ( $layout == 'layout_1' ) ? '' : $regular_btn;

        $nav_btn = ( $layout == 'layout_1' ) ? $nav_btn : '';

        // Added in version 1.0.1
        $layout_class = $layout;

        // Animation Class

        $kdesk_jumbotron_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class             = new Animation( [ 'base' => 'kdesk_jumbotron' ] );
            $kdesk_jumbotron_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        $layout_class = $layout_class . $kdesk_jumbotron_animation;

        // Background.

        $jumbotorn_bg = ' style="background:linear-gradient( rgba(' . $overlay_color . ', ' . $opacity . '),  rgba(' . $overlay_color . ', ' . $opacity . ') ), url(' . $large_img_src . '); background-repeat: ' . $bg_repeat . '; background-size: ' . $bg_size . ';" ';

        // @Since: 1.0.0
        // @Date: 10-04-16

        $jumbotron_wrap_layout_class = 'jumbotron-wrap';
        $jumbotron_wrap_layout_class = ( isset( $cont_ext_class ) && $cont_ext_class != '' ) ? $jumbotron_wrap_layout_class . ' ' . $cont_ext_class : $jumbotron_wrap_layout_class;

        $output = '<div class="' . $jumbotron_wrap_layout_class . '">
                            <div class="jumbo_search_box jsb_' . $jsb_id . '" ' . $jumbotorn_bg . ' id="jumbotron_1">                                    
                                <div class="container jumbotron-content ' . $layout_class . '">                                      
                                    ' . $heading_text . '
                                    ' . $sub_heading_text . '                                         
                                    ' . $search_box . '
                                    ' . $regular_btn . '
                                    ' . $nav_btn . '                              
                                </div>
                            </div>
                        </div>';

        return $output;
    }
}
