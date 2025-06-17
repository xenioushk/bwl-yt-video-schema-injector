<?php

namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Heading\HeadingShortcodeCb;

/**
 * Class Heading
 *
 * This class handles the all shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Heading {
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
				'tag'      => 'kdesk_vc_heading',
				'callback' => [ ( new HeadingShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
