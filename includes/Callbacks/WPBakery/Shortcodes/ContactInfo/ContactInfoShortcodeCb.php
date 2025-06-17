<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\ContactInfo;

/**
 * Class ContactInfo Shortcode Callback.
 *
 * @package KDESKADDON
 */
class ContactInfoShortcodeCb {

    /**
     * ContactInfo Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts([
			'id'              => '',
			'contact_address' => '',
			'contact_phone'   => '',
			'contact_email'   => '',
			'contact_web'     => '',
		],$atts );

        extract( $atts ); // phpcs:ignore

        $output = '<ul class="contact-info">
                        <li>
                            <span class="icon-container"><i class="fa fa-home"></i></span>
                            <address>' . $contact_address . '</address>
                        </li>
                        <li>
                            <span class="icon-container"><i class="fa fa-phone"></i></span>
                            <address>' . $contact_phone . '</address>
                        </li>
                        <li>
                            <span class="icon-container"><i class="fa fa-envelope"></i></span>
                            <address><a href="mailto:' . $contact_email . '">' . $contact_email . '</a></address>
                        </li>
                        <li>
                            <span class="icon-container"><i class="fa fa-globe"></i></span>
                            <address><a href="' . kdesk_addhttp( $contact_web ) . '" target="_blank">' . $contact_web . '</a></address>
                        </li>
                    </ul>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }
}
