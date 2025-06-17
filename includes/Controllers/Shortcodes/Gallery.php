<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Gallery\GalleryShortcodeCb;

/**
 * Class Gallery Shortcodes
 *
 * Registers the Gallery shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Gallery {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new GalleryShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_gallery',
				'callback' => [ $shortcode_cb, 'get_the_gallery' ],
			],
			[
				'tag'      => 'kdesk_gallery_item',
				'callback' => [ $shortcode_cb, 'get_gallery_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
