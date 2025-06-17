<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Logos\LogosShortcodeCb;

/**
 * Class Logos Shortcodes
 *
 * Registers the Logos shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Logos {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new LogosShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_logos',
				'callback' => [ $shortcode_cb, 'get_logos' ],
			],
			[
				'tag'      => 'kdesk_logo_item',
				'callback' => [ $shortcode_cb, 'get_logo_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
