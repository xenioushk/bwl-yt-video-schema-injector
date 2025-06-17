<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Banner\BannerShortcodeCb;

/**
 * Class Banner Shortcodes
 *
 * Registers the Banner shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Banner {
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
				'tag'      => 'kdesk_vc_banner',
				'callback' => [ ( new BannerShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
