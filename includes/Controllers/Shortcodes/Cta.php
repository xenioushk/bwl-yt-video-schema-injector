<?php

namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Cta\CtaShortcodeCb;

/**
 * Class Cta
 *
 * This class handles the all shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Cta {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcodes = [
			[
				'tag'      => 'kdesk_vc_cta',
				'callback' => [ ( new CtaShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
