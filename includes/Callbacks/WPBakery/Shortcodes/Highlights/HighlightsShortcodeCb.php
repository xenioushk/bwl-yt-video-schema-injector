<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Highlights;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Highlights Shortcode Callback.
 *
 * @package KDESKADDON
 */
class HighlightsShortcodeCb {

    /**
     * Primary highlights block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function kdesk_highlights( $atts, $content ) {

        $atts = shortcode_atts([
            'id'                       => '',
            'custom_class_id'          => wp_rand(),
            'layout'                   => 'layout_1',
            'content_alignment'        => 'center',
            'columns'                  => 4, // this value will used for carousel item_per_row.
            'rm_link_status'           => 0,
            'carousel'                 => 0,
            'carousel_nav'             => 1,
            'carousel_dots'            => 0,
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
            'box_shadow_status'        => 0,
            'theme'                    => '',

            'theme_color'              => KDESK_PRIMARY_COLOR,
            'theme_bg'                 => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_bg'           => '#FBFBFB', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_color'        => '#CEEFFB', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0,
            'theme_border'             => '#EBEBEB', // Apply in to box border, button border
            'border_status'            => 1,

            'theme_color_2'            => '#254559',
            'theme_bg_2'               => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_bg_2'         => '#111111', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_color_2'      => '#FFFFFF', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0,
            'theme_border_2'           => '#EBEBEB', // Apply in to box border, button border
            'border_status_2'          => 1,

            'animation'                => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

            $btn_border = $theme_border;

            if ( isset( $border_status ) && $border_status == 0 ) {
                $theme_border = 'transparent';
            }

            $custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-prev,';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-next{color: ' . $theme_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-dots .active span{background: ' . $theme_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' h2::after{background: ' . $theme_color . ' !important;}';

            if ( $layout == 'layout_1' ) {

                $custom_class_id .= ' .highlight-layout-1';

                $custom_class_data .= '.kc_' . $custom_class_id . ' {border-color: ' . $theme_border . '; background: ' . $theme_bg . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover {background: ' . $theme_hover_bg . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' span.fa{color: ' . $theme_bg . '; background: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover span.fa{color: ' . $theme_hover_color . '; background: ' . $theme_hover_bg . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' h2::after{background: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover h2::after{background: ' . $theme_hover_color . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn-theme{background: ' . $theme_color . ' !important; }';
                $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn-theme:hover{background: ' . $theme_hover_color . ' !important; }';

                $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn-theme.btn-2{background: ' . $theme_color . ' !important; }';
                $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn-theme.btn-2:hover{background: ' . $theme_hover_color . ' !important; }';
            } elseif ( $layout == 'layout_2' ) {

                $custom_class_id .= ' .highlight-layout-2';

                $custom_class_data .= '.kc_' . $custom_class_id . ' {border-color: ' . $theme_border . '; background: ' . $theme_bg . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover {background: ' . $theme_hover_bg . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' span.fa{color: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover span.fa{color: ' . $theme_hover_color . ';}';
            } elseif ( $layout == 'layout_3' ) {

                $custom_class_id .= ' .highlight-layout-3';

                $custom_class_data .= '.kc_' . $custom_class_id . ' {border-color: ' . $theme_border . '; background: ' . $theme_bg . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover {background: ' . $theme_hover_bg . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' span.fa{color: ' . $theme_color . '; }';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover span.fa{color: ' . $theme_hover_color . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' h2::after{background: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover h2::after{background: ' . $theme_hover_color . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn-theme{background: ' . $theme_color . ' !important; }';
                $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn-theme:hover{background: ' . $theme_hover_color . ' !important; }';
            }
        }

        // Wrapped By Data Attribute.

        if ( $custom_class != '' ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        $output = '<div class="item_' . $columns . ' row' . $custom_class . '" ' . $custom_class_data . ' data-item_page="' . $columns . '">';

        // @Since: Version 1.0.2

        if ( $carousel == 1 ) {

            $carousel_nav_status  = ( $carousel_nav == 1 ) ? 'false' : 'true';
            $carousel_dots_status = ( $carousel_dots == 1 ) ? 'false' : 'true';

            $output .= '<div class="highlight-carousel owl-carousel" data-carousel="' . $carousel . '" data-items="' . $columns . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
        }

        // Modified shortcode.

        $content = str_replace('[kdesk_highlights_item', '[kdesk_highlights_item layout="' . $layout . '"  '
            . 'box_shadow_status="' . $box_shadow_status . '" '
            . 'theme="' . $theme . '" '
            . 'theme_color="' . $theme_color . '" '
            . 'theme_bg="' . $theme_bg . '" '
            . 'theme_hover_color="' . $theme_hover_color . '" '
            . 'theme_hover_bg="' . $theme_hover_bg . '" '
            . 'theme_border="' . $theme_border . '" '
            . 'border_status="' . $border_status . '" '
            . 'theme_color_2="' . $theme_color_2 . '" '
            . 'theme_bg_2="' . $theme_bg_2 . '" '
            . 'theme_hover_color_2="' . $theme_hover_color_2 . '" '
            . 'theme_hover_bg_2="' . $theme_hover_bg_2 . '" '
            . 'theme_border_2="' . $theme_border_2 . '" '
            . 'border_status_2="' . $border_status_2 . '" '
            . 'columns="' . $columns . '" '
            . 'animation="' . $animation . '" '
            . 'content_alignment="' . $content_alignment . '" '
        . 'rm_link_status="' . $rm_link_status . '" "', $content);

        $output .= do_shortcode( kdesk_cleanup_shortcode( $content ) );

        // Ending div condition for carousel.
        if ( $carousel == 1 ) {
            $output .= '</div>';
        }

        $output .= '</div>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }

    /**
     * Generate child highlight blocks.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function kdesk_highlights_item( $atts ) {

        $atts = shortcode_atts([
            'custom_class_id'     => wp_rand(),
            'layout'              => '',
            'content_alignment'   => 'center',
            'columns'             => '4',
            'title'               => '',
            'title_tag'           => 'h2',
            'highlights_content'  => '',
            'rm_link_status'      => 0,
            'url_text'            => __( 'Read More', 'kdesk_vc' ),
            'read_more_link'      => '#',
            'ext_btn_class'       => '',

            'rm_link_status_2'    => 0,
            'url_text_2'          => __( 'Live Demo', 'kdesk_vc' ),
            'read_more_link_2'    => '#',
            'ext_btn_class_2'     => '',

            'icon_type'           => 'fa_icon',
            'icon'                => 'fa fa-book',
            'highlights_img'      => '',
            'single'              => 0,
            'box_shadow_status'   => 0,
            'cont_ext_class'      => '',
            'theme'               => '',

            'theme_bg'            => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_bg'      => '#FBFBFB', // Apply in to box background and box icon color (For Layout 1)
            'theme_color'         => '#40C1F0', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_hover_color'   => '#CEEFFB', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_border'        => '#EBEBEB', // Apply in to box border, button border
            'border_status'       => 1,

            'theme_bg_2'          => '#254559', // Apply in to box background and box icon color (For Layout 1)
            'theme_color_2'       => '#FFFFFF', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_hover_bg_2'    => '#111111', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_color_2' => '#FFFFFF', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_border_2'      => '#EBEBEB', // Apply in to box border, button border
            'border_status_2'     => 1,

            'animation'           => '',
            'badge_status'        => 0,
            'badge_text'          => '',
            'badge_theme'         => 'label-secondary',
        ], $atts);

        extract( $atts );

        // Replace the badge_theme class.

        if ( ! empty( $badge_theme ) ) {
            $badge_theme = str_replace( 'label-', 'text-bg-', $badge_theme );
        }

        // Animation Class

        $kdesk_highlight_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class             = new Animation( [ 'base' => 'kdesk_highlights_item' ] );
            $kdesk_highlight_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        // Alignment.

        $content_alignment = kdesk_alignment_class( $content_alignment );

        $custom_class      = '';
        $custom_class_data = '';

        if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

            $btn_border = $theme_border;

            if ( isset( $border_status ) && $border_status == 0 ) {
                $theme_border = 'transparent';
            }

            $custom_class .= ' kdesk_custom kc_' . $custom_class_id;

            $custom_class_data .= '.kc_' . $custom_class_id . '{border-color: ' . $theme_border . '; background: ' . $theme_bg . ';}';
            $custom_class_data .= '.kc_' . $custom_class_id . ':hover{background: ' . $theme_hover_bg . ';}';

            $custom_class_data .= '.kc_' . $custom_class_id . ' a.btn{border-color: ' . $btn_border . ';}';

            if ( $layout == 'layout_1' ) {

                $custom_class_data .= '.kc_' . $custom_class_id . ' span.fa{color: ' . $theme_bg . '; background: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover span.fa{color: ' . $theme_hover_color . '; background: ' . $theme_hover_bg . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' h2::after{background: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover h2::after{background: ' . $theme_hover_color . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ':hover a.btn{background: ' . $theme_color . '; border-color: ' . $theme_color . '; }';
            } elseif ( $layout == 'layout_2' ) {

                $custom_class_data .= '.kc_' . $custom_class_id . ' span.fa{color: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover span.fa{color: ' . $theme_hover_color . ';}';
            } elseif ( $layout == 'layout_3' ) {

                $custom_class_data .= '.kc_' . $custom_class_id . ' span.fa{color: ' . $theme_color . '; }';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover span.fa{color: ' . $theme_hover_color . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ' h2::after{background: ' . $theme_color . ';}';
                $custom_class_data .= '.kc_' . $custom_class_id . ':hover h2::after{background: ' . $theme_hover_color . ';}';

                $custom_class_data .= '.kc_' . $custom_class_id . ':hover a.btn{background: ' . $theme_color . '; border-color: ' . $theme_color . '; }';
            }

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        /*----- Read More Button/Link ----*/

        $read_more_html = '';

        $read_more_link_string = vc_build_link( $read_more_link );

        $highlight_link = ( isset( $read_more_link_string['url'] ) && $read_more_link_string['url'] != '' ) ? esc_url( $read_more_link_string['url'] ) : '#';

        $highlight_target = ( isset( $read_more_link_string['target'] ) && $read_more_link_string['target'] != '' ) ? ' target="_blank"' : '';

        if ( $rm_link_status == 1 ) {

            $read_more_btn_class = ( isset( $ext_btn_class ) && $ext_btn_class != '' ) ? 'btn btn-theme-small btn-theme ' . $ext_btn_class : 'btn btn-theme-small btn-theme';

            $read_more_html .= '<a href="' . $highlight_link . '" ' . $highlight_target . ' class="' . $read_more_btn_class . '" title="' . $title . '">' . $url_text . '</a>';
        }

        /*-----  Read More Link #2 ----*/

        $read_more_html_2 = '';

        if ( $rm_link_status_2 == 1 ) {

            $read_more_link_2_string = vc_build_link( $read_more_link_2 );

            $highlight_link_2 = ( isset( $read_more_link_2_string['url'] ) && $read_more_link_2_string['url'] != '' ) ? esc_url( $read_more_link_2_string['url'] ) : '#';

            $highlight_target_2 = ( isset( $read_more_link_2_string['target'] ) && $read_more_link_2_string['target'] != '' ) ? ' target="_blank"' : '';

            $read_more_btn_class_2 = ( isset( $ext_btn_class_2 ) && $ext_btn_class_2 != '' ) ? 'btn btn-2 btn-theme-small btn-theme btn-theme-invert ' . $ext_btn_class_2 : 'btn btn-2 btn-theme-small btn-theme btn-theme-invert';

            $read_more_html_2 .= '<a href="' . $highlight_link_2 . '" ' . $highlight_target_2 . ' class="' . $read_more_btn_class_2 . '">' . $url_text_2 . '</a>';
        }

        /*----- End Read More Link#2 ----*/

        /*----- Highlight Heading ----*/

        $highlight_heading = ( isset( $read_more_link_string['url'] ) && $read_more_link_string['url'] != '' ) ? '<h2><a href="' . esc_url( $read_more_link_string['url'] ) . '" title="' . $title . '" ' . $highlight_target . ' >' . $title . '</a></h2>' : '<h2>' . $title . '</h2>';

        /*----- Highlight Content ----*/

        $highlights_content = ( isset( $highlights_content ) && $highlights_content != '' ) ? '<p>' . $highlights_content . '</p>' : '';

        /*-----  Icon/Image Settings ----*/

        $highlight_icon_string = '';

        if ( isset( $icon_type ) && $icon_type == 'img_icon' ) {

            $feat_image_info = kdesk_addon_get_img( $highlights_img );

            if ( ! empty( $feat_image_info ) ) {

                $highlight_icon_string .= '<a href="' . $highlight_link . '" ' . $highlight_target . ' class="img-responsive" title="' . $title . '">' . $feat_image_info . '</a>';
            }
        } else {

            $icon = ( isset( $icon ) && $icon == '' ) ? 'fa fa-book' : $icon;

            $highlight_icon_string .= '<span class="' . $icon . '"></span>';
        }

        /*----- Badge HTML  ----*/

        $badge_html = '';

        if ( isset( $badge_status ) && $badge_status == 1 && isset( $badge_text ) && $badge_text != '' ) {

            $badge_html .= "<span class='custom-badge badge {$badge_theme}'>" . trim( $badge_text ) . '</span>';
        }

        /*----- Box Shadow ----*/

        $box_shadow_class = '';

        if ( isset( $box_shadow_status ) && $box_shadow_status == 1 ) {

            $box_shadow_class .= ' highlight-box-shadow';
        }

        /*-----  Extra Class ----*/

        if ( $layout == 'layout_3' ) {

            // For Highlight Layout 01
            // @Since: Version 1.0.0

            if ( $single == 1 ) {
                $column_class = ''; // Full width column
            } else {
                $column_class = kdesk_column_class( $columns );
            }

            // Custom Highlight Box Link.
            // @Since: Version 1.0.1

            $column_class = $column_class . ' ' . $kdesk_highlight_animation;

            $content_alignment = $content_alignment . $box_shadow_class . ' ' . $cont_ext_class;

            $output = '<div class="' . $column_class . '">
                                <div class="highlight-layout-3' . ' ' . $content_alignment . '" ' . $custom_class_data . '>
                                    ' . $badge_html . '
                                    ' . $highlight_icon_string . '
                                    ' . $highlight_heading . '
                                    ' . $highlights_content . '
                                    ' . $read_more_html . '
                                    ' . $read_more_html_2 . '
                                </div>
                            </div>';
        } elseif ( $layout == 'layout_2' ) {

            // For Highlight Layout 02
            // @Since: Version 1.0.0

            if ( $single == 1 ) {
                $column_class = 'col-lg-12 col-md-12 col-sm-12 no-padding'; // Full width column
            } else {
                $column_class = kdesk_column_class( $columns );
            }

            $column_class = $column_class . ' ' . $kdesk_highlight_animation;

            $content_alignment = $content_alignment . $box_shadow_class . ' ' . $cont_ext_class;

            $output = '<div class="' . $column_class . '">
                            <div class="highlight-layout-2' . ' ' . $content_alignment . '"' . $custom_class_data . '>
                                ' . $badge_html . '
                                ' . $highlight_icon_string . '
                                ' . $highlight_heading . '
                                ' . $highlights_content . '
                                ' . $read_more_html . '
                                ' . $read_more_html_2 . '
                            </div>
                        </div>';
        } else {

            // For Highlight Layout 01
            // @Since: Version 1.0.0

            if ( $single == 1 ) {
                $column_class = ''; // Full width column
            } else {
                $column_class = kdesk_column_class( $columns );
            }

            $column_class = $column_class . ' ' . $kdesk_highlight_animation;

            $content_alignment = $content_alignment . $box_shadow_class . ' ' . $cont_ext_class;

            $output = '<div class="' . $column_class . '">
                                <div class="highlight-layout-1' . ' ' . $content_alignment . '"' . $custom_class_data . '>
                                    ' . $badge_html . '
                                    ' . $highlight_icon_string . '
                                    ' . $highlight_heading . '
                                    ' . $highlights_content . '
                                    ' . $read_more_html . '
                                    ' . $read_more_html_2 . '
                                </div>
                            </div>';
        }

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }

    /**
     * Single Hightlight block
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function kdesk_single_highlight( $atts, $content ) {

        $atts = shortcode_atts([
            'layout'              => 'layout_1',
            'content_alignment'   => 'center',
            'columns'             => '4',
            'title'               => '',
            'title_tag'           => 'h2',
            'highlights_content'  => '',

            'url_text'            => __( 'Read More', 'kdesk_vc' ),
            'rm_link_status'      => 0,
            'read_more_link'      => '#',
            'ext_btn_class'       => '',

            'rm_link_status_2'    => 0,
            'url_text_2'          => __( 'Live Demo', 'kdesk_vc' ),
            'read_more_link_2'    => '#',
            'ext_btn_class_2'     => '',

            'icon_type'           => 'fa_icon',
            'icon'                => 'fa fa-book',
            'highlights_img'      => '',
            'single'              => 1,
            'box_shadow_status'   => 0,
            'cont_ext_class'      => '',
            'theme'               => '',

            'theme_bg'            => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
            'theme_color'         => '#40C1F0', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_hover_bg'      => '#FBFBFB', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_color'   => '#CEEFFB', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_border'        => '#EBEBEB', // Apply in to box border, button border
            'border_status'       => 1,

            'theme_bg_2'          => '#254559', // Apply in to box background and box icon color (For Layout 1)
            'theme_color_2'       => '#FFFFFF', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_hover_bg_2'    => '#111111', // Apply in to box background and box icon color (For Layout 1)
            'theme_hover_color_2' => '#FFFFFF', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
            'theme_border_2'      => '#EBEBEB', // Apply in to box border, button border
            'border_status_2'     => 1,

            'animation'           => 'none',
            'badge_status'        => 0,
            'badge_text'          => '',
            'badge_theme'         => 'badge-secondary',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        // Modified shortcode.
        $icon = $icon ?? 'fa fa-book';

        $content = '[kdesk_highlights_item '
            . ' layout="' . $layout . '" '
            . ' content_alignment="' . $content_alignment . '" '
            . ' title="' . $title . '" '
            . ' highlights_content="' . $highlights_content . '" '
            . ' icon_type="' . $icon_type . '" '
            . ' icon="' . $icon . '" '
            . ' highlights_img="' . $highlights_img . '" '
            . ' url_text="' . $url_text . '" '
            . ' rm_link_status="' . $rm_link_status . '" '
            . ' read_more_link="' . $read_more_link . '" '
            . ' ext_btn_class="' . $ext_btn_class . '" '
            . ' url_text_2="' . $url_text_2 . '" '
            . ' rm_link_status_2="' . $rm_link_status_2 . '" '
            . ' read_more_link_2="' . $read_more_link_2 . '" '
            . ' ext_btn_class_2="' . $ext_btn_class_2 . '" '
            . ' single="' . $single . '" '
            . ' box_shadow_status="' . $box_shadow_status . '" '
            . ' cont_ext_class="' . $cont_ext_class . '" '
            . ' theme="' . $theme . '" '
            . ' theme_bg="' . $theme_bg . '" '
            . ' theme_hover_bg="' . $theme_hover_bg . '" '
            . ' theme_color="' . $theme_color . '"'
            . ' theme_hover_color="' . $theme_hover_color . '" '
            . ' theme_border="' . $theme_border . '" '
            . ' border_status="' . $border_status . '" '
            . ' animation="' . $animation . '" '
            . ' badge_status="' . $badge_status . '" '
            . ' badge_text="' . $badge_text . '" '
            . ' badge_theme="' . $badge_theme . '" '
            . ']';

        $output = do_shortcode( $content );

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
