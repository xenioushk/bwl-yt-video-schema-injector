<?php
namespace KDESKADDON\Controllers\Shortcodes;

use Xenioushk\BwlPluginApi\Api\Shortcodes\ShortcodesApi;
use KDESKADDON\Callbacks\WPBakery\Shortcodes\Slider\SliderShortcodeCb;

/**
 * Class Slider Shortcodes
 *
 * Registers the Slider shortcodes for the Kdesk VC Addon.
 *
 * @package KDESKADDON
 */
class Slider {
	/**
	 * Register shortcodes.
	 *
	 * @since 1.0.0
	 */
	public function register() {

		// Initialize API.
		$shortcodes_api = new ShortcodesApi();

		$shortcode_cb = new SliderShortcodeCb();

		$shortcodes = [
			[
				'tag'      => 'kdesk_slider',
				'callback' => [ $shortcode_cb, 'get_sliders' ],
			],
			[
				'tag'      => 'slider_item',
				'callback' => [ $shortcode_cb, 'get_slider_item' ],
			],
		];

		$shortcodes_api->add_shortcodes( $shortcodes )->register();
	}
}
