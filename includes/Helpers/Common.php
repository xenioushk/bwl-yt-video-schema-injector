<?php
namespace KDESKADDON\Helpers;

use KDESKADDON\Helpers\PluginConstants;

use DateTime;

/**
 * Class for common helper functions
 *
 * @package KDESKADDON
 */
class Common {

    /**
     * Beautify date format.
     *
     * @param string $date the date to beautify.
     * @return string
     */
    public static function beautify_date( $date ) {

        $splitDate     = explode( 'T', $date );
        $rearrangeDate = explode( '-', $splitDate[0] );
        return $rearrangeDate[2] . '-' . $rearrangeDate[1] . '-' . $rearrangeDate[0];
    }

    /**
     * Get the renewal days left.
     *
     * @param string $renewalDate the renewal date.
     *
     * @return array
     */
    public static function get_renewal_days_left( $renewalDate ) {

        // Convert the renewal date to a DateTime object
        $renewalDateTime = new DateTime( $renewalDate );

        // Get the current date
        $currentDate = new DateTime();

        // Compare the renewal date with the current date
        if ( $renewalDateTime < $currentDate ) {
            // Renewal date has expired

            return [
                'status'    => 0,
                'days_left' => 0,
                'msg'       => esc_html__( 'Support period has expired.', 'bwl-adv-faq' ),
            ];
        } else {
            // Calculate the difference between the renewal date and the current date
            $interval  = $currentDate->diff( $renewalDateTime );
            $days_left = $interval->days;

            return [
                'status'    => 1,
                'days_left' => $days_left,
                'msg'       => $days_left . ' ' . esc_html__( 'days left for renewal.', 'bwl-adv-faq' ),
            ];
        }
    }

    /**
     * Get the license info.
     *
     * @return array
     */
	public static function get_license_info() {

		$status = get_option( KDESKADDON_PURCHASE_VERIFIED_KEY ) ?? 0;
		$info   = get_option( KDESKADDON_PURCHASE_INFO_KEY ) ?? [];

		$data = [
			'title'       => KDESKADDON_THEME_TITLE,
			'status'      => $status, // 1= active, 0=not active, 2=no license reqruired.
			'info'        => $info,
			'pluginId'    => KDESKADDON_PRODUCT_ID,
			'supportLink' => KDESKADDON_PRODUCT_SUPPORT,
		];

		return $data;
	}

    /**
     * Get the BWL API URL.
     *
     * @return string
     */
	public static function bwl_api_url() {
		$baseUrl = get_home_url();
		if ( preg_match( '/(localhost|\.local)/', $baseUrl ) ) {
			return 'http://bwlapi.local/';
		}  elseif ( strpos( $baseUrl, 'staging.bluewindlab.com' ) != false ) {
			return 'https://staging.bluewindlab.com/bwl_api/';
		} else {
			return 'https://api.bluewindlab.net/';
		}
	}

    /**
	 * Get the font-awesome icon code.
     *
     * @param string $icon_class the font-awesome icon class.
	 * @return string
	 */
    public static function get_the_fa_icon_code( string $icon_class = '' ): string {

        switch ( $icon_class ) {

            case 'fa-thumbs-o-up':
                return '\f164';

            case 'fa-thumbs-up':
                return '\f164';

            case 'fa-heart-o':
                return '\f004';

            case 'fa-heart':
                return '\f004';

            case 'fa-smile-o':
                return '\f118';

            case 'fa-level-up':
                return '\f3bf';

            case 'fa-arrow-circle-up':
                return '\f0aa';

            case 'fa-arrow-up':
                return '\f062';

            case 'fa-angle-up':
                return '\f106';

            case 'fa-angle-double-up':
                return '\f102';

            default:
                return '\f004';
        }
    }
}


// Solve apostrophe issue.

$texturized_text = [
    'term_name',
    'term_description',
    'the_title',
    'the_content',
    'the_excerpt',
];

foreach ( $texturized_text as $text ) {
    remove_filter( $text, 'wptexturize' );
}
