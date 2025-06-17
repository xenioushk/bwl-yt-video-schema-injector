<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Team\TeamShortcodeCb;

/**
 * Class Team Shortcodes
 *
 * Registers the Team shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Team {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new TeamShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_team',
				'callback' => [ $shortcode_cb, 'get_team' ],
			],
			[
				'tag'      => 'kdesk_team_item',
				'callback' => [ $shortcode_cb, 'get_team_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
