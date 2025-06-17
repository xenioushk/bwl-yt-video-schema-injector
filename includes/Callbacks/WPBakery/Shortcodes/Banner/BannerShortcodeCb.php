<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Banner;

use KAFWPB\Controllers\WPBakery\Support\Animation;

/**
 * Class Banner ShortcodeCb
 *
 * @package KDESKADDON
 */
class BannerShortcodeCb {

    /**
     * Banner Shortcode Callback.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_shortcode_output( $atts, $content ) {

        $atts = shortcode_atts(
            [
                'id'                       => '',
                'sub_intro'                => '',
                'sub_intro_tag'            => 'h5',
                'main_intro'               => '',
                'main_intro_tag'           => 'h2',
                'main_intro_color'         => '#FFFFFF',
                'banner_link'              => '#',
                'banner_image'             => '#',
                'icon'                     => 'fa-play',
                'icon_tag'                 => 'span',
                'button_text'              => __( 'JOIN WITH US', 'kdesk_vc' ),
                'layout'                   => 'layout_1',
                'content_alignment'        => 'center',
                'theme'                    => '',

                'bg_type'                  => 'image',  // image/solid/gradient
                'banner_bg'                => '',
                'bg_color'                 => '#555555',
                'bg_opacity'               => '0.3',
                'solid_bg'                 => '#555555',

                'ctrl_btn_1'               => 0,
                'btn_1_cont_ext_class'     => 'btn-theme',
                'btn_1_text'               => __( 'BOOK APPOINTMENT', 'kdesk_vc' ),
                'btn_1_url'                => '#',
                'btn_1_theme'              => '', // default, custom.
                'btn_1_border'             => '0',
                'btn_1_border_radius'      => '32',
                'btn_1_bg'                 => '#FFFFFF',
                'btn_1_color'              => KDESK_PRIMARY_COLOR,
                'btn_1_border_color'       => KDESK_PRIMARY_COLOR,
                'btn_1_hover_bg'           => KDESK_PRIMARY_COLOR,
                'btn_1_hover_color'        => '#FFFFFF',
                'btn_1_hover_border_color' => KDESK_PRIMARY_COLOR,

                'ctrl_btn_2'               => 0,
                'btn_2_cont_ext_class'     => 'btn-theme',
                'btn_2_text'               => __( 'JOIN WITH US', 'kdesk_vc' ),
                'btn_2_url'                => '#',
                'btn_2_theme'              => '', // default, custom.
                'btn_2_border'             => '0',
                'btn_2_border_radius'      => '32',
                'btn_2_bg'                 => '#FFFFFF',
                'btn_2_color'              => KDESK_PRIMARY_COLOR,
                'btn_2_border_color'       => KDESK_PRIMARY_COLOR,
                'btn_2_hover_bg'           => KDESK_PRIMARY_COLOR,
                'btn_2_hover_color'        => '#FFFFFF',
                'btn_2_hover_border_color' => KDESK_PRIMARY_COLOR,

                'animation'                => '',

                'cont_ext_class'           => '',
            ],
            $atts
        );

        extract( $atts ); // phpcs:ignore

        // Animation Class

        $kdesk_banner_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class          = new Animation( [ 'base' => 'kdesk_vc_banner' ] );
            $kdesk_banner_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        // Generate Button#1

        $btn_1_html = '';

        if ( $ctrl_btn_1 == 1 ) {

            if ( isset( $btn_1_theme ) && $btn_1_theme == 'custom' ) {

                $btn_1_html .= do_shortcode('[kdesk_vc_button title="' . $btn_1_text . '" '
                    . 'theme="custom" '
                    . 'cont_ext_class="' . $btn_1_cont_ext_class . '" '
                    . 'btn_info="' . $btn_1_url . '" '
                    . 'btn_border="' . $btn_1_border . '" '
                    . 'btn_border_width="0" '
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
                $btn_1_html      .= '<a href="' . $btn_1_url_string['url'] . '" class="btn btn-theme">' . $btn_1_text . '</a>';
            }
        }

        // Generate Button#2

        $btn_2_html = '';

        if ( $ctrl_btn_2 == 1 ) {

            if ( isset( $btn_2_theme ) && $btn_2_theme == 'custom' ) {

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
                $btn_2_html      .= '<a href="' . $btn_2_url_string['url'] . '" class="btn btn-theme btn-theme-invert">' . $btn_2_text . '</a>';
            }
        }

        // Button Wrapper.

        $output_btn_html = '';

        if ( $btn_1_html != '' || $btn_2_html != '' ) {

            $output_btn_html .= '<div class="static-banner-button">';
            $output_btn_html .= $btn_1_html;
            $output_btn_html .= $btn_2_html;
            $output_btn_html .= '</div>';
        }

        // BG TYPE.

        if ( isset( $bg_type ) && $bg_type == 'solid' ) {
            $bg_color   = $solid_bg;
            $bg_opacity = 1;
        }

        $alignment_class = kdesk_alignment_class( $content_alignment );

        $banner_bg_url = wp_get_attachment_url( $banner_bg );

        if ( $banner_bg_url == '' ) {
            $banner_bg_url = KDESK_VC_PLUGIN_DIR . 'public/images/banner_bg.jpg';
        }

        $output = '<div class="static-banner banner-content' . $kdesk_banner_animation . '" data-bg_img="' . $banner_bg_url . '" data-bg_color="' . $bg_color . '" data-bg_opacity="' . $bg_opacity . '" >       
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 ' . $alignment_class . '">
                                        ' . $content . '
                                        ' . $output_btn_html . '    
                                        </div>
                                    </div>
                                </div>
                            </div>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
