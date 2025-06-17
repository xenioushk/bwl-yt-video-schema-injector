<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\SocialLink;

/**
 * Class SoicalLink Shortcode Callback.
 *
 * @package KDESKADDON
 */
class SocialLinkShortcodeCb {

    /**
     * SoicalLink Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts([
			'custom_class_id'   => wp_rand(),
			'id'                => '',
			'twitter_link'      => '',
			'facebook_link'     => '',
			'pinterest_link'    => '',
			'theme'             => '',
			'theme_color'       => KDESK_PRIMARY_COLOR,
			'theme_icon_color'  => '#FFFFFF',
			'theme_hover_color' => '#22AFE6',
        ],$atts );

        extract( $atts ); // phpcs:ignore

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( isset( $theme ) && ! empty( $theme ) && $theme == 'custom' ) {

            $custom_class .= ' kdesk_custom kc_' . $custom_class_id;

            $custom_class_data .= '.kc_' . $custom_class_id . ' .btn-social-icon{background: ' . $theme_color . ' !important; color: ' . $theme_icon_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .btn-social-icon .fa{color: ' . $theme_icon_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .btn-social-icon:hover{background: ' . $theme_hover_color . ' !important; color: ' . $theme_icon_color . ' !important;}';
        }

        // Wrapped By Data Attribute.

        if ( $custom_class != '' ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        $output = '<div class="custom-social-icons ' . $custom_class . '" ' . $custom_class_data . '>
            
                            <a title="Tweet It" href="' . kdesk_addhttp( $twitter_link ) . '" target="_blank" class="btn btn-social-icon">
                                <i class="fa fa-twitter"></i>
                            </a>
    
                            <a title="Share at Facebook" href="' . kdesk_addhttp( $facebook_link ) . '" target="_blank" class="btn btn-social-icon">
                                <i class="fa fa-facebook"></i>
                            </a>
    
                            <a title="Share at Pinterest" href="' . kdesk_addhttp( $pinterest_link ) . '" target="_blank" class="btn btn-social-icon">
                                <i class="fa fa-pinterest"></i>
                            </a>
                     </div>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
