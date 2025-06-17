<?php
namespace KDESKADDON\Callbacks\Notices\NoticeBlocks;

use KDESKADDON\Traits\TraitAdminNotice;

/**
 * Class Addon Notice Block.
 *
 * Handles the notice message, key, and schedule.
 *
 * @package KDESKADDON
 */
class OfferNoticeBlockCb {

	use TraitAdminNotice;

	/**
	 * The notice key.
	 *
	 * @var string
	 * @note change the key.
	 */
	private $key;

	/**
	 * The schedule key.
	 *
	 * @var string
	 * @note This key will set into the constructor automatically.
	 */
	private static $schedule_key;

	/**
	 * Notice interval.
	 *
	 * @var int
	 * @note adjust the interval as needed.
	 */
	private static $interval = 1; // 1 day interval.

	/**
	 * Display the plugin notices.
	 */
	public function get_the_notice() {

		$notice = [];

		// Fetch the offer data.
		$option_data = get_option( KDESKADDON_CRON_OFFER_OPTION_ID );

		// Return if the offer data is empty.
		if ( empty( $option_data ) ) {
			return $notice;
		}

		$offer_data = $option_data['data'];

		$this->key = $offer_data['offer_id'];

			// This is the default date time.
			$now    = date( 'Y-m-d' );
			$stdate = $offer_data['stdate'] ?? $now;
			$exdate = $offer_data['exdate'] ?? $now;

			$show_offer = strtotime( $now ) >= strtotime( $stdate ) && strtotime( $now ) <= strtotime( $exdate );
		if ( ! $show_offer ) {
			return $notice;
		}

		$cta_btn = sprintf(
			'<a href="%s" class="bwl-text-bold bwl-text-success" target="_blank">Get Now</a>',
			$offer_data['btnurl']
		);

		$msg = sprintf(
			'🎉 <strong>%s</strong> %s',
			$offer_data['details'],
			$cta_btn
		);

		// Set notice parameters.
		// @params: msg, key, start, status, is_dismissable, noticeClass
		$notice = [
			'msg'    => $msg,
			'key'    => $this->key,
			'status' => ( intval( get_option( $this->key ) ) === 1 ) ? 1 : 0,
		];

		return $notice;
	}
}
