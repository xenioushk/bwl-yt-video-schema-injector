<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Video\VideoShortcodeCb;

/**
 * Class Video Shortcodes
 *
 * Registers the Video shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Video {
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
				'tag'      => 'kdesk_vc_video',
				'callback' => [ ( new VideoShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
