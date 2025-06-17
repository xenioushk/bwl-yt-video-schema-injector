<?php

namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Cta;

use KAFWPB\Controllers\WPBakery\Support\Animation;

/**
 * Class Cta ShortcodeCb
 *
 * @package KDESKADDON
 */
class CtaShortcodeCb {

    /**
     * CTA Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts(
            [
                'id'               => '',
                'custom_class_id'  => wp_rand(),
                'sub_intro'        => '',
                'sub_intro_tag'    => 'h5',
                'sub_intro_color'  => '#333333',
                'main_intro'       => '',
                'main_intro_tag'   => 'h2',
                'main_intro_color' => '#111111',
                'cta_link'         => '#',
                'icon'             => 'fa-play',
                'icon_tag'         => 'span',
                'button_text'      => __( 'JOIN WITH US', 'kdesk_vc' ),
                'cta_btn_status'   => 0, // 0=show, 1= hide (Tag: Hide CTA Button?)
                'video_btn_pos'    => '', // bottom(default), middle, top
                'video_btn_style'  => '', // rounded(default), semi_rounded, square
                'layout'           => 'layout_1',
                'alignment'        => 'center',
                'theme'            => '',
                'theme_color'      => KDESK_PRIMARY_COLOR,
                'animation'        => '',
                'cont_ext_class'   => '',
            ],
            $atts
        );

        extract( $atts ); // phpcs:ignore

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

            $custom_class .= ' kdesk_custom kc_' . $custom_class_id;

            if ( $layout == 'layout_3' ) {

                $custom_class_data .= '.kc_' . $custom_class_id . ' .cta-layout-3 h2{color: ' . $main_intro_color . ';}';
            } elseif ( $layout == 'layout_2' ) {

                $custom_class_data .= '.kc_' . $custom_class_id . ' .cta-layout-2 h2{color: ' . $main_intro_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ' .cta-layout-2 h5{color: ' . $sub_intro_color . ';}';
            } else {

                $custom_class_data .= '.kc_' . $custom_class_id . ' .cta-layout-1 h5{color: ' . $sub_intro_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ' .cta-layout-1 h2{color: ' . $main_intro_color . ';}';
            }
        }

        // Wrapped By Data Attribute.

        if ( $custom_class != '' ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        // CTA Link.

        $cta_link = ( isset( $cta_link ) && $cta_link != '' ) ? kdesk_addhttp( $cta_link ) : '#';

        // CTA Main Intro String.

        $cta_main_intro_string = '';

        if ( isset( $main_intro ) && $main_intro != '' ) {
            $cta_main_intro_string .= '<h2>' . $main_intro . '</h2>';
        }

        // CTA Sub Intro String.

        $cta_sub_intro_string = '';

        if ( isset( $sub_intro ) && $sub_intro != '' ) {
            $cta_sub_intro_string .= '<h5>' . $sub_intro . '</h5>';
        }

        // Animation Class

        $kdesk_cta_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class       = new Animation( [ 'base' => 'kdesk_vc_cta' ] );
            $kdesk_cta_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        $content_alignment = kdesk_alignment_class( $alignment );

        $column_class = 'col-md-12 col-sm-12 ' . $kdesk_cta_animation;

        $output = '<div class="container"><div class="row' . $custom_class . '" ' . $custom_class_data . '>';

        if ( $layout == 'layout_3' ) {

            $custom_style = ' style="color: ' . $main_intro_color . '; "';

            $cta_btn_string = '';

            if ( isset( $cta_btn_status ) && $cta_btn_status == 0 ) {

                $cta_btn_string .= '<div class="margin-top-32">
                                                  <a href="' . $cta_link . '" class="btn btn-theme">' . $button_text . '</a>
                                              </div>';
            }

            // @Since: 1.0.7
            // @Date: 10-04-18

            $layout_class = 'cta-layout-3';
            $layout_class = ( isset( $cont_ext_class ) && $cont_ext_class != '' ) ? $layout_class . ' ' . $cont_ext_class : $layout_class;

            $output .= '<div class="' . $column_class . '">
                              <div class="' . $content_alignment . ' ' . $layout_class . '">
                                  ' . $cta_main_intro_string . '
                                  ' . $cta_btn_string . '
                              </div>
                          </div>';
        } elseif ( $layout == 'layout_2' ) {

            // @Since: 1.0.7
            // @Date: 10-04-18

            $layout_class = 'cta-layout-2';
            $layout_class = ( isset( $cont_ext_class ) && $cont_ext_class != '' ) ? $layout_class . ' ' . $cont_ext_class : $layout_class;

            $output .= '<div class="' . $column_class . '">
                                  <div class="' . $layout_class . '">
                                      <div class="cta-info text-left">
                                          ' . $cta_main_intro_string . '
                                          ' . $cta_sub_intro_string . '
                                      </div>
  
                                      <div class="cta-btn-container">
                                          <a href="' . $cta_link . '" class="btn btn-theme">' . $button_text . '</a>
                                      </div>
                                  </div>
                              </div> ';
        } else {

            $icon = ( $icon == '' ) ? 'fa-play' : $icon;

            // @Since: 1.0.7
            // @Date: 10-04-18

            $layout_class = 'cta-layout-1';
            $layout_class = ( isset( $cont_ext_class ) && $cont_ext_class != '' ) ? $layout_class . ' ' . $cont_ext_class : $layout_class;

            $cta_video_link_string = '';

            if ( isset( $cta_link ) && $cta_link != '' ) {

                $video_btn_style_class = ( isset( $video_btn_style_class ) && ( $video_btn_style_class == '' ) ) ? '' : ' ' . $video_btn_style;

                $icon = $icon . $video_btn_style_class;

                $cta_video_link_string .= '<a class="video-icon venobox vbox-item" data-vbtype="video" data-autoplay="true" href="' . $cta_link . '">
                                                          <' . $icon_tag . ' class="fa ' . $icon . ' fa-4x"></' . $icon_tag . '>
                                                      </a>';
            }

            // Video Link Position.
            // @Since: 1.0.7
            // @Date: 10-04-18

            $cta_video_html = '';

            if ( isset( $video_btn_pos ) && $video_btn_pos == 'top' ) {

                $cta_video_html .= $cta_video_link_string . $cta_main_intro_string . $cta_sub_intro_string;
            } elseif ( isset( $video_btn_pos ) && $video_btn_pos == 'middle' ) {

                $cta_video_html .= $cta_main_intro_string . $cta_video_link_string . $cta_sub_intro_string;
            } else {
                $cta_video_html .= $cta_main_intro_string . $cta_sub_intro_string . $cta_video_link_string;
            }

            $output .= '<div class="' . $column_class . '">
                              <div class="' . $content_alignment . ' ' . $layout_class . '">
                                  ' . $cta_video_html . '
                              </div>
                          </div>';
        }

        $output .= '</div> </div>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
