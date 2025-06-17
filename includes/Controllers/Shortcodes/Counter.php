<?php

namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Counter\CounterShortcodeCb;

/**
 * Class Counter Shortcodes
 *
 * This class handles the all shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Counter {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new CounterShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_counter',
				'callback' => [ $shortcode_cb, 'get_the_counter_container' ],
			],
			[
				'tag'      => 'kdesk_counter_item',
				'callback' => [ $shortcode_cb, 'get_the_counter_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
