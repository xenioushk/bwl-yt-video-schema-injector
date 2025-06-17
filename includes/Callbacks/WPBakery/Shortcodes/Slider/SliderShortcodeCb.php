<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Slider;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Slider Shortcode Callback.
 *
 * @package KDESKADDON
 */
class SliderShortcodeCb {

    /**
     * Primary Sliders block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_sliders( $atts, $content ) {

        $atts = shortcode_atts([
            'id'                       => wp_rand(),
            'custom_class_id'          => wp_rand(),
            'theme'                    => 'custom',
            'nav_bg'                   => '#FFFFFF',
            'nav_color'                => '#000000',
            'layout'                   => 'slider_1',
            'carousel_nav'             => 0,
            'carousel_nav_icon_left'   => 'fa-angle-left',
            'carousel_nav_icon_right'  => 'fa-angle-right',
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
        ], $atts);

        extract( $atts ); // phpcs:ignore

        $carousel_nav_icon_left  = ! empty( $carousel_nav_icon_left ) ? $carousel_nav_icon_left : 'fa-angle-left';
        $carousel_nav_icon_right = ! empty( $carousel_nav_icon_right ) ? $carousel_nav_icon_right : 'fa-angle-right';

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

            $custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
            $custom_class_data .= 'div.kc_' . $custom_class_id . ' #slider_1 .owl-controls .owl-nav div{background: ' . $nav_bg . ' !important; color: ' . $nav_color . ' !important;}';
        }

        // Wrapped By Data Attribute.

        if ( ! empty( $custom_class ) ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        // One more checking about parameters.
        $carousel_nav_status = ( $carousel_nav == 1 ) ? 'false' : 'true';

        $output = '<div class="item_1 slider-wrap ' . $custom_class . '" ' . $custom_class_data . '>
                                            <div id="' . $layout . '" class="' . $layout . ' owl-carousel owl-theme" data-nav="' . $carousel_nav_status . '" data-nav_icon_left="' . $carousel_nav_icon_left . '" data-nav_icon_right="' . $carousel_nav_icon_right . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';

        // Modified shortcode.

        $content = str_replace( '[slider_item', '[slider_item layout="' . $layout . '" layout="' . $layout . '" layout="' . $layout . '" ', $content );

        $output .= do_shortcode( $content );

        $output .= '</div>';

        $output .= '</div>';

        return $output;
    }

    /**
     * Single Slider block
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_slider_item( $atts, $content ) {

        $atts = shortcode_atts([
            'layout'                   => 'slider_1',
            'content_alignment'        => 'left',
            'content_animation_in'     => 'zoomIn',
            'content_animation_out'    => 'zoomOut',
            'content_color'            => '#FFFFFF',

            'slider_sub_title_status'  => 0, // if status value is 1 then slider sub title will be hidden.
            'slider_sub_title'         => '',
            'slider_sub_title_color'   => '#FFFFFF',

            'bg_type'                  => 'image',  // image/solid/gradient
            'slider_image'             => '',
            'bg_color'                 => '#000000',
            'bg_opacity'               => '0.1',
            'solid_bg'                 => '#000000',

            'feat_img_status'          => 0, // If 1, Featured image will be displayed.
            'slider_feat_img'          => '',

            'alt_content_position'     => 0, // If 1, Image will show on left side and content on right side.
            'cols_content'             => 1,
            'cols_feat_img'            => 2,

            'ctrl_btn_1'               => 0,
            'btn_1_class'              => '',
            'btn_1_cont_ext_class'     => 'btn-theme margin-top-24',
            'btn_1_text'               => esc_attr__( 'Button#1', 'kdesk_vc' ),
            'btn_1_url'                => '#',
            'btn_1_theme'              => '',
            'btn_1_border'             => '1',
            'btn_1_border_radius'      => '0',
            'btn_1_bg'                 => '#FFFFFF',
            'btn_1_color'              => '#40C1F0',
            'btn_1_border_color'       => '#40C1F0',
            'btn_1_hover_bg'           => '#40C1F0',
            'btn_1_hover_color'        => '#FFFFFF',
            'btn_1_hover_border_color' => '#40C1F0',

            'ctrl_btn_2'               => 0,
            'btn_2_class'              => '',
            'btn_2_cont_ext_class'     => 'btn-theme btn-theme-invert margin-top-24',
            'btn_2_text'               => esc_attr__( 'Button#2', 'kdesk_vc' ),
            'btn_2_url'                => '#',
            'btn_2_theme'              => '', // default, custom.
            'btn_2_border'             => '1',
            'btn_2_border_radius'      => '0',
            'btn_2_bg'                 => '#FFFFFF',
            'btn_2_color'              => '#40C1F0',
            'btn_2_border_color'       => '#40C1F0',
            'btn_2_hover_bg'           => '#40C1F0',
            'btn_2_hover_color'        => '#FFFFFF',
            'btn_2_hover_border_color' => '#40C1F0',

        ], $atts);

        extract( $atts ); // phpcs:ignore

        // Cotent Alignment Class.

        $content_alignment_class = kdesk_alignment_class( $content_alignment );
        $slider_bg_image         = wp_get_attachment_url( $slider_image );

        // SLIDER TITLE

        $title_color = ( $content_color !== '#FFFFFF' ) ?
                                                sprintf( 'style="color:%s !important;"',$content_color ) :
                                                '';

        $title_html = sprintf( '<div class="slider_title_content" %s>%s</div>', $title_color,$content );

        // SLIDER SUB TITLE
        $sub_title_html  = '';
        $sub_title_color = '';

        $is_subtitle_disabled = intval( $slider_sub_title_status );

        if ( ! $is_subtitle_disabled && ! empty( $slider_sub_title ) ) {

            $sub_title_color = ( $slider_sub_title_color !== '#FFFFFF' ) ?
                                                    sprintf( 'style="color:%s !important;"',$slider_sub_title_color ) :
                                                    '';

			$sub_title_html = sprintf( '<h3 %s>%s</h3>', $sub_title_color, $slider_sub_title );
        }

        // Generate Button#1

        $btn_1_html = '';

        if ( $ctrl_btn_1 ) {

            $btn_1_cont_ext_class = ( ! empty( $btn_1_class ) ) ? $btn_1_cont_ext_class . ' ' . $btn_1_class : $btn_1_cont_ext_class;

            if ( $btn_1_theme === 'custom' ) {

                $btn_1_html .= do_shortcode('[kdesk_vc_button title="' . $btn_1_text . '" '
                    . 'theme="custom" '
                    . 'cont_ext_class="' . $btn_1_cont_ext_class . '" '
                    . 'btn_info="' . $btn_1_url . '" '
                    . 'btn_border="' . $btn_1_border . '" '
                    . 'btn_border_width="2" '
                    . 'btn_border_radius="' . $btn_1_border_radius . '" '
                    . 'btn_bg="' . $btn_1_bg . '" '
                    . 'btn_color="' . $btn_1_color . '" '
                    . 'btn_border_color="' . $btn_1_border_color . '" '
                    . 'btn_hover_bg="' . $btn_1_hover_bg . '" '
                    . 'btn_hover_color="' . $btn_1_hover_color . '" '
                    . 'btn_hover_border_color="' . $btn_1_hover_border_color . '" '
                . '/]');
            } else {

                $btn_1_url_string = vc_build_link( $btn_1_url );
                $btn_1_html      .= '<a href="' . $btn_1_url_string['url'] . '" class="btn ' . $btn_1_cont_ext_class . '">' . $btn_1_text . '</a>';
            }
        }

        // Generate Button#2

        $btn_2_html = '';

        if ( $ctrl_btn_2 ) {

            $btn_2_cont_ext_class = ( ! empty( $btn_2_class ) ) ? $btn_2_cont_ext_class . ' ' . $btn_2_class : $btn_2_cont_ext_class;

            if ( $btn_2_theme === 'custom' ) {

                $btn_2_html .= do_shortcode('[kdesk_vc_button title="' . $btn_2_text . '" '
                    . 'theme="custom" '
                    . 'cont_ext_class="' . $btn_2_cont_ext_class . '" '
                    . 'btn_info="' . $btn_2_url . '" '
                    . 'btn_border="' . $btn_2_border . '" '
                    . 'btn_border_width="2" '
                    . 'btn_border_radius="' . $btn_2_border_radius . '" '
                    . 'btn_bg="' . $btn_2_bg . '" '
                    . 'btn_color="' . $btn_2_color . '" '
                    . 'btn_border_color="' . $btn_2_border_color . '" '
                    . 'btn_hover_bg="' . $btn_2_hover_bg . '" '
                    . 'btn_hover_color="' . $btn_2_hover_color . '" '
                    . 'btn_hover_border_color="' . $btn_2_hover_border_color . '" '
                . '/]');
            } else {

                $btn_2_url_string = vc_build_link( $btn_2_url );
                $btn_2_html      .= '<a href="' . $btn_2_url_string['url'] . '" class="btn ' . $btn_2_cont_ext_class . '">' . $btn_2_text . '</a>';
            }
        }

        // Button Wrapper
        $output_btn_html = '';

        if ( ! empty( $btn_1_html ) || ! empty( $btn_2_html ) ) {

            $output_btn_html .= sprintf( '<div class="slider-button">%s%s</div>',$btn_1_html, $btn_2_html );
        }

        $feat_img_status = intval( $feat_img_status );

        $feat_img_content = '';

        if ( $feat_img_status ) {

            $cols_content       = 2;
            $feat_img_col_class = kdesk_column_class( $cols_feat_img );
            $content_col_class  = kdesk_column_class( $cols_content );

            $feat_image_info = kdesk_addon_get_img( $slider_feat_img );

            $feat_img_content .= '<div class="mt-2 mt-md-1 ' . $feat_img_col_class . ' ' . $content_alignment_class . '" data-animation-in="' . $content_animation_in . '" data-animation-out="animate-out ' . $content_animation_out . '">
                                            ' . $feat_image_info . '
                                        </div>';
        } else {
            $content_col_class = kdesk_column_class( $cols_content );
        }

        $content = '<div class="' . $content_col_class . ' ' . $content_alignment_class . '" data-animation-in="' . $content_animation_in . '" data-animation-out="animate-out ' . $content_animation_out . '">
                                            ' . $title_html . '
                                            ' . $sub_title_html . '
                                            ' . $output_btn_html . '
                                        </div>';

		$slider_final_content = ( intval( $alt_content_position ) ) ?
                                            $feat_img_content . $content :
                                            $content . $feat_img_content;

        $slider_html = '<div class="slider_item_container" data-bg_type="' . $bg_type . '" data-bg_img="' . $slider_bg_image . '" data-bg_color="' . $bg_color . '" data-bg_opacity="' . $bg_opacity . '" data-solid_bg="' . $solid_bg . '">
                        <div class="item">
                            <div class="slider-content">
                                <div class="container">
                                    <div class="row">
                                        ' . $slider_final_content . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $slider_html;
    }
}
