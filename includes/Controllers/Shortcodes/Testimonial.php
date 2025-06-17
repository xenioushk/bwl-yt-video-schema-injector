<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Testimonial\TestimonialShortcodeCb;

/**
 * Class Testimonial Shortcodes
 *
 * Registers the Testimonial shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Testimonial {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new TestimonialShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_testimonial',
				'callback' => [ $shortcode_cb, 'get_testimonial' ],
			],
			[
				'tag'      => 'kdesk_testimonial_item',
				'callback' => [ $shortcode_cb, 'get_testimonial_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
