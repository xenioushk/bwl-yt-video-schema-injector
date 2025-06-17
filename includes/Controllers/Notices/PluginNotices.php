<?php

namespace KDESKADDON\Controllers\Notices;

use KDESKADDON\Callbacks\Notices\NoticeCb;
use Xenioushk\BwlPluginApi\Api\Notices\NoticesApi;
use KDESKADDON\Callbacks\Notices\NoticeBlocks\OfferNoticeBlockCb;
use KDESKADDON\Callbacks\Notices\NoticeBlocks\LicenseNoticeBlockCb;

/**
 * Class PluginNotices
 *
 * This class handles the registration of the plugin admin notices.
 *
 * @since: 1.1.1
 * @package KDESKADDON
 */
class PluginNotices {

	/**
	 * Notice callback.
	 *
	 * @var notice_cb
	 */
	private $notice_cb;

	/**
	 * Register PluginNotices.
	 */
	public function register() {

		add_action( 'admin_init', [ $this, 'initialize' ] );

	}

	/**
	 * Initialize PluginNotices.
	 */
	public function initialize() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// Initialize API.
		$notices_api = new NoticesApi();

		// Initialize callbacks.
		$this->notice_cb = new NoticeCb();

		$notices_api->add_notices( $this->get_notices() )->register();
	}

	/**
	 * Get the notices.
	 *
	 * @return array
	 */
	private function get_notices() {
		// All the notices will use the same callback.
		$notice_callback = [ $this->notice_cb, 'get_the_notice' ];

		// Register notices.
		$notice_classes = [
			LicenseNoticeBlockCb::class,
			OfferNoticeBlockCb::class,
		];

		$notices = [];

		foreach ( $notice_classes as $class_name ) {
			// Get all the notices from each class.
			$each_notice = ( new $class_name() )->get_the_notice();

			// Check if the notice is multidimensional.
			$is_multi_notices = array_filter( $each_notice, 'is_array' );

			if ( ! empty( $is_multi_notices ) ) {
				foreach ( $is_multi_notices as $notice ) {
					$notices[] = [
						'callback' => $notice_callback,
						'notice'   => $notice,
					];
				}
			} else {
				$notices[] = [
					'callback' => $notice_callback,
					'notice'   => $each_notice,
				];
			}
		}

		return $notices;
	}
}
