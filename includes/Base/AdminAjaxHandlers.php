<?php
namespace KDESKADDON\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
use KDESKADDON\Callbacks\AdminAjaxHandlers\PurchaseVerifyCb;
/**
 * Class for admin ajax handlers.
 *
 * @package KDESKADDON
 */
class AdminAjaxHandlers {

	/**
	 * Register admin ajax handlers.
	 */
	public function register() {

		$ajax_handlers_api         = new AjaxHandlersApi();
		$plugin_purchase_verify_cb = new PurchaseVerifyCb();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$adminAjaxRequests = [
			[
				'tag'      => 'BwlThemeVerifyPurchaseData',
				'callback' => [ $plugin_purchase_verify_cb, 'verify' ],
			],
			[
				'tag'      => 'BwlThemeRemoveLicenseData',
				'callback' => [ $plugin_purchase_verify_cb, 'remove' ],
			],

		];

		$ajax_handlers_api->add_ajax_handlers( $adminAjaxRequests )->register();
	}
}
