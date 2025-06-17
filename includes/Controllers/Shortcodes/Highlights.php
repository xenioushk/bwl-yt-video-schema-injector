<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Highlights\HighlightsShortcodeCb;

/**
 * Class Highlights Shortcodes
 *
 * Registers the Highlights shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Highlights {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new HighlightsShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_highlights',
				'callback' => [ $shortcode_cb, 'kdesk_highlights' ],
			],
			[
				'tag'      => 'kdesk_highlights_item',
				'callback' => [ $shortcode_cb, 'kdesk_highlights_item' ],
			],
			[
				'tag'      => 'kdesk_single_highlight',
				'callback' => [ $shortcode_cb, 'kdesk_single_highlight' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
