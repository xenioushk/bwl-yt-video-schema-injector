<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\ContactInfo\ContactInfoShortcodeCb;

/**
 * Class Contact Info Shortcodes
 *
 * Registers the Contact Info shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class ContactInfo {
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
				'tag'      => 'kdesk_contact_info',
				'callback' => [ ( new ContactInfoShortcodeCb() ), 'get_shortcode_output' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
