<?php

namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Jumbotron\JumbotronShortcodeCb;

/**
 * Class Jumbotron
 *
 * This class handles the all shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Jumbotron {
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
				'tag'      => 'kdesk_jumbotron',
				'callback' => [ ( new JumbotronShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
