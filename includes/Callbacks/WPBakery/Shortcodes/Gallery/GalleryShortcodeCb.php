<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Gallery;

use KAFWPB\Controllers\WPBakery\Support\Animation;
/**
 * Class Gallery Shortcode Callback.
 *
 * @package KDESKADDON
 */
class GalleryShortcodeCb {

    /**
     * Primary Gallery block.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */
    public function get_the_gallery( $atts, $content ) {
        $atts = shortcode_atts([
            'id'                       => wp_rand(),
            'custom_class_id'          => wp_rand(),
            'layout'                   => 'simple', // simple, carousel
            'column'                   => '4',
            'no_padding'               => 0,
            'icon'                     => 'fa file-search',
            'carousel_nav'             => 1,
            'carousel_dots'            => 0,
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
            'theme'                    => '',
            'theme_color'              => KDESK_PRIMARY_COLOR,
            'animation'                => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

            $custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
            $custom_class_data .= '.kc_' . $custom_class_id . ' .gallery-box:after{background: ' . $theme_color . ';}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .gallery-box .gallery-icon-container li a:hover{color: ' . $theme_color . ';}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .gallery-carousel .owl-controls i.nav-icon:after{background: ' . $theme_color . ';}';
        }

        // Wrapped By Data Attribute.

        if ( $custom_class != '' ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        $carousel = ( $layout == 'carousel' ) ? 1 : 0;

        $output = '<div class="item_' . $column . ' row ' . $custom_class . '" ' . $custom_class_data . '>';

        // Starting div condition for carousel.
        if ( $carousel == 1 ) {

            $carousel_nav_status  = ( $carousel_nav == 1 ) ? 'false' : 'true';
            $carousel_dots_status = ( $carousel_dots == 1 ) ? 'false' : 'true';

            $output .= '<div class="gallery-carousel owl-carousel" data-carousel="1" data-items="' . $column . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '"  data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
        }

        // Modified shortcode.

        $content = str_replace( '[kdesk_gallery_item', '[kdesk_gallery_item layout="' . $layout . '" animation="' . $animation . '" column="' . $column . '" no_padding="' . $no_padding . '" icon="' . $icon . '" ', $content );

        $output .= do_shortcode( $content );

        // Ending div condition for carousel.
        if ( $carousel == 1 ) {
            $output .= '</div>';
        }

        $output .= '</div>';

        return $output;
    }

    /**
	 * Single Gallery block
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
    public function get_gallery_item( $atts ) {

        $atts = shortcode_atts([
            'layout'      => 'simple', // simple, carousel
            'column'      => '4',
            'gallery_img' => '',
            'no_padding'  => 0,
            'icon'        => 'fa file-search',
            'animation'   => '',
        ], $atts);

        extract( $atts ); // phpcs:ignore

        // Animation Class

        $kdesk_gallery_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class           = new Animation( [ 'base' => 'kdesk_gallery_item' ] );
            $kdesk_gallery_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        $column_class = kdesk_gallery_column_class( $column );

        $column_class = $column_class . ' ' . $kdesk_gallery_animation;

        $feat_image_url = wp_get_attachment_url( $gallery_img );

        // Featured Image For Gallery.

        $feat_image_url_string = '';

        $feat_image_info = kdesk_addon_get_img( $gallery_img );

        if ( ! empty( $feat_image_info ) ) {

            $feat_image_url_string .= $feat_image_info;
        }

        $no_padding_class = '';

        if ( isset( $no_padding ) && $no_padding == 1 ) {
            $no_padding_class = 'no-padding-gallery';
        }

        $output = '<div class="' . $column_class . ' gallery-container ' . $no_padding_class . '">
                        <div class="gallery-box">
                            ' . $feat_image_url_string . '
                            <ul class="gallery-icon-container">
                                <li><a class="gallery-light-box" data-gall="myGallery" href="' . $feat_image_url . '"><i class="' . $icon . '"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    ';

        return $output;
    }
}
