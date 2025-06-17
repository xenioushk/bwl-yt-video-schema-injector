<?php
namespace KDESKADDON\Controllers\Notices;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
use KDESKADDON\Callbacks\Notices\NoticeAjaxHandlerCb;

/**
 * PluginNoticesAjaxHandler class.
 *
 * @since: 1.1.1
 * @package KDESKADDON
 */
class PluginNoticesAjaxHandler {

	/**
	 * Ajax Handlers API.
	 *
	 * @var ajax_handlers_api
	 */
	public $ajax_handlers_api;

	/**
	 * Notice Ajax Handler Callback.
	 *
	 * @var notice_ajax_handler_cb
	 */
	public $notice_ajax_handler_cb;

	/**
	 * Settings array.
	 *
	 * @var $settings
	 */
	public $settings = [];

	/**
	 * Register PluginNoticesAjaxHandler.
	 */
	public function register() {

		// Initialize API.
		$this->ajax_handlers_api = new AjaxHandlersApi();

		// Initialize callbacks.
		$this->notice_ajax_handler_cb = new NoticeAjaxHandlerCb();

		// Add all the ajax handlers here.
		$this->settings = [
			[
				'tag'      => 'bwl_set_notice_status',
				'callback' => [ $this->notice_ajax_handler_cb, 'save_notice_settings' ],
			],
		];

		$this->ajax_handlers_api->add_ajax_handlers( $this->settings )->register();
	}
}
