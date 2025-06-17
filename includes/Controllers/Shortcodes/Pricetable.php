<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Pricetable\PricetableShortcodeCb;

/**
 * Class Pricetable Shortcodes
 *
 * Registers the Pricetable shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Pricetable {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new PricetableShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_pricetable',
				'callback' => [ $shortcode_cb, 'kdesk_pricetable' ],
			],
			[
				'tag'      => 'kdesk_pricetable_item',
				'callback' => [ $shortcode_cb, 'kdesk_pricetable_item' ],
			],
			[
				'tag'      => 'kdesk_pt_item',
				'callback' => [ $shortcode_cb, 'kdesk_pt_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
