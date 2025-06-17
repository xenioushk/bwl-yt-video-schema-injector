<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Logos;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Logos Shortcode Callback.
 *
 * @package KDESKADDON
 */
class LogosShortcodeCb {

    /**
     * Primary Logos block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_logos( $atts, $content ) {

        $atts = shortcode_atts([
            'id'                       => 'logo_' . wp_rand(),
            'layout'                   => 'layout_1',
            'carousel'                 => 0,
            'carousel_items'           => 6,
            'carousel_nav'             => 1,
            'carousel_dots'            => 0,
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
            'animation'                => '',
        ], $atts);

        extract( $atts );

        $carousel          = ( $layout == 'layout_2' ) ? 1 : 0;
        $logo_layout_class = ( $layout == 'layout_2' ) ? 'logo-items logo-carousel owl-carousel' : '';

        $output = "<div class='row item_{$carousel_items}'>";

        // Starting div condition for carousel.
        $carousel_nav_status  = $carousel_nav ? true : false;
        $carousel_dots_status = $carousel_dots ? true : false;

        if ( $carousel ) {
            $output .= "<div class='text-center {$logo_layout_class}' data-carousel='{$carousel}' data-items='{$carousel_items}' data-nav='{$carousel_nav_status}' data-dots='{$carousel_dots_status}' data-autoplay='{$carousel_autoplay}' data-autoplaytimeout='{$carousel_autoplaytimeout}'>";
        }

        $content = str_replace( '[kdesk_logo_item', "[kdesk_logo_item layout='{$layout}' animation='{$animation}' carousel_items='{$carousel_items}'", $content );

        $output .= do_shortcode( $content );

        $output .= '</div>';
        if ( $carousel ) {
            $output .= '</div>';
        }

        return $output;
    }

	/**
	 * Single Logo block
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
    public function get_logo_item( $atts ) {

        $atts = shortcode_atts([
            'layout'           => '',
            'logo_title'       => '',
            'slider_image'     => '',
            'logo_custom_link' => '#',
            'carousel_items'   => 6,
            'animation'        => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        $output = '';

        // Featured Image For Logos.
        $feat_image_url_string = '';

        $feat_image_info = kdesk_addon_get_img( $slider_image );

        if ( ! empty( $feat_image_info ) ) {

            $feat_image_url_string .= "<div class='client-logo'>{$feat_image_info}</div>";
        }

        // Logo URL.
        $logo_custom_url = $logo_custom_link;

        $logo_custom_url_target = '';

        if ( isset( $logo_custom_link ) && $logo_custom_link != '#' ) {

            $logo_custom_string     = vc_build_link( $logo_custom_link );
            $logo_custom_url        = esc_url( $logo_custom_string['url'] );
            $logo_custom_url_target = ( isset( $logo_custom_string['target'] ) && $logo_custom_string['target'] != '' ) ? " target='_blank'" : '';
            $feat_image_url_string  = "<a href='{$logo_custom_url}' title='{$logo_title}' {$logo_custom_url_target}>{$feat_image_url_string}</a>";
        }

        // Animation Class
        $kdesk_logo_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class        = new Animation( [ 'base' => 'kdesk_logo_item' ] );
            $kdesk_logo_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        if ( $layout == 'layout_2' ) {

            $output .= "<div class='logo-container col-xs-12 col-sm-2 col-md-2 col-lg-2 {$kdesk_logo_animation}'>
                                {$feat_image_url_string}
                            </div>";
        } else {

            $column_class = kdesk_column_class( $carousel_items );

            $output .= "<div class='logo-container {$column_class} {$kdesk_logo_animation}'>
                                {$feat_image_url_string} 
                            </div>";
        }

        return $output;
    }
}
