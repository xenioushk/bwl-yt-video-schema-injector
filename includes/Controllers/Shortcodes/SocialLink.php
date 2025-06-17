<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\SocialLink\SocialLinkShortcodeCb;

/**
 * Class Social Link Shortcodes
 *
 * Registers the SocialLink shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class SocialLink {
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
				'tag'      => 'kdesk_social_link',
				'callback' => [ ( new SocialLinkShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
