<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Testimonial;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Testimonial Shortcode Callback.
 *
 * @package KDESKADDON
 */
class TestimonialShortcodeCb {

    /**
     * Primary Testimonials block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_testimonial( $atts, $content ) {

        $atts = shortcode_atts([
            'id'                       => '',
            'custom_class_id'          => wp_rand(),
            'layout'                   => 'layout_1',
            'alignment'                => 'left',
            'carousel'                 => 0,
            'item_per_row'             => 4,
            'carousel_nav'             => 1,
            'carousel_dots'            => 0,
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
            'theme'                    => '',
            'theme_color'              => KDESK_PRIMARY_COLOR,
            'animation'                => '',
            'cont_ext_class'           => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( ! empty( $theme ) && $theme === 'custom' ) {

            $custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
            $custom_class_data .= '.kc_' . $custom_class_id . ' .testimony-layout-1 div.testimony-content::after{color: ' . $theme_color . ';}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-prev,';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-next{color: ' . $theme_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-dots .active span{background: ' . $theme_color . ' !important;}';
        }

        // Wrapped By Data Attribute.

        if ( ! empty( $custom_class ) ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        $carousel = ( $layout === 'layout_1' ) ? 1 : 0;

        $output = '<div class="item_' . $item_per_row . ' row  g-3 g-lg-4 ' . $custom_class . '" ' . $custom_class_data . '>';

        // Starting div condition for carousel.
        if ( $carousel ) {

            $carousel_nav_status  = $carousel_nav ? false : true;
            $carousel_dots_status = $carousel_dots ? false : true;

            $output .= '<div class="testimonial-container owl-carousel" data-carousel="1" data-items="' . $item_per_row . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
        }

        // Modified shortcode.

        $content = str_replace( '[kdesk_testimonial_item', '[kdesk_testimonial_item layout="' . $layout . '" alignment="' . $alignment . '" cont_ext_class="' . $cont_ext_class . '" animation="' . $animation . '" item_per_row="' . $item_per_row . '" ', $content );

        $output .= do_shortcode( $content );

        if ( $carousel ) {
            $output .= '</div>';
        }

        $output .= '</div>';

        return $output;
    }

    /**
     * Single Testimonial block
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_testimonial_item( $atts ) {

        $atts = shortcode_atts([
            'layout'           => 'layout_1',
            'alignment'        => 'left',
            'item_per_row'     => 2,
            'testimonial_info' => '',
            'user_name'        => '',
            'user_designation' => '',
            'user_image'       => '',
            'animation'        => '',
            'cont_ext_class'   => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        $kdesk_testimonial_animation = '';

        if ( ! empty( $animation ) ) {
            $animate_class               = new Animation( [ 'base' => 'kdesk_testimonial_item' ] );
            $kdesk_testimonial_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        $column_class = ( $layout === 'layout_1' ) ? 'col-sm-12' : kdesk_column_class( $item_per_row );

        $column_class = $column_class . ' ' . $kdesk_testimonial_animation;

        // Featured Image For Testimonial.

        $feat_image_url_string = '';

        $feat_image_info = kdesk_addon_get_img( $user_image );

        if ( ! empty( $feat_image_info ) ) {

            $feat_image_url_string .= $feat_image_info;
        }

        $content_alignment = kdesk_alignment_class( $alignment );

        $content_alignment = ( isset( $cont_ext_class ) && $cont_ext_class != '' ) ? $content_alignment . ' ' . $cont_ext_class : $content_alignment;

        $output = '<div class="' . $column_class . '">
    
                                    <div class="testimony-layout-1 ' . $content_alignment . '">
    
                                        <div class="testimony-content">
                                            ' . $testimonial_info . '
                                        </div>
    
                                        <div class="testimony-meta">
    
                                           ' . $feat_image_url_string . '
                                                
                                            <div class="testimony-author">
                                                    <h6>' . $user_name . '</h6>
                                                    <span>' . $user_designation . '</span>
                                            </div>
    
                                        </div>
    
                                    </div>
    
                                </div>';

        return $output;
    }
}
