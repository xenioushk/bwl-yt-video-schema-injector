<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Discounts\DiscountsShortcodeCb;

/**
 * Class Discounts Shortcodes
 *
 * Registers the Discounts shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Discounts {
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
				'tag'      => 'kdesk_discounts',
				'callback' => [ ( new DiscountsShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
