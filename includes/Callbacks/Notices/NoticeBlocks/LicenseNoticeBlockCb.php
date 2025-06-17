<?php
namespace KDESKADDON\Callbacks\Notices\NoticeBlocks;

use KDESKADDON\Traits\TraitAdminNotice;

/**
 * Class License Notice Block.
 *
 * Handles the notice message, key, and schedule.
 *
 * @package KDESKADDON
 */
class LicenseNoticeBlockCb {

	use TraitAdminNotice;

	/**
	 * The notice key.
	 *
	 * @var string
	 * @note change the key.
	 */
	private static $key = 'kdesk_license_activation_status';

	/**
	 * Display the plugin notices.
	 */
	public function get_the_notice() {

		// Set notice parameters.
		// @params: msg, key, start, status, is_dismissable, noticeClass
		$notice = [
			'noticeClass'    => 'error',
			'msg'            => '🔐 Please <a href="' . esc_url( get_admin_url() ) . 'themes.php?page=kdesk-license-page" class="bwl_plugins_notice_text--danger bwl_plugins_notice_text--bold">ACTIVATE YOUR COPY</a> of the plugin to unlock premium options and support of ' . KDESKADDON_THEME_TITLE . '.',
			'key'            => self::$key,
			'status'         => ( KDESKADDON_PRODUCT_VERIFIED_STATUS === 1 ) ? 1 : 0,
			'is_dismissable' => 0,
		];

		return $notice;
	}
}
