<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Video;

/**
 * Class Video Shortcode Callback.
 *
 * @package KDESKADDON
 */
class VideoShortcodeCb {

    /**
     * Primary Videos block.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts(
            [
                'id'                => '',
                'video_link'        => '#',
                'video_bg'          => '',
                'icon'              => 'fa-play',
                'icon_tag'          => 'span',
                'layout'            => 'layout_1',
                'content_alignment' => 'center',
            ],
            $atts
        );

        extract( $atts ); // phpcs:ignore

        $alignment_class = kdesk_alignment_class( $content_alignment );

        $get_video_link = vc_build_link( $video_link );

        if ( isset( $get_video_link['url'] ) && $get_video_link['url'] != '' ) {

            $video_link_url = $get_video_link['url'];
        } else {

            $video_link_url = '#';
        }

        $icon = ( ! empty( $icon ) ) ? 'fa-play' : $icon;

        // Video Background Image

        $feat_image_url_string = '';

        $feat_image_info = kdesk_addon_get_img( $video_bg );

        if ( ! empty( $feat_image_info ) ) {

            $feat_image_url_string .= $feat_image_info;
        }

        $output = '<a class="video-box-layout-1 video-box" data-vbtype="youtube" href="' . $video_link_url . '">
                                 <figure class="video-box-container">
                                     ' . $feat_image_url_string . '
                                 </figure>
                             </a>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
