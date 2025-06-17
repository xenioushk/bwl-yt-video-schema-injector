<?php
namespace BwlFaqManager\Callbacks\Notices\NoticeBlocks;

use BwlFaqManager\Traits\TraitAdminNotice;

/**
 * Class Addon Notice Block.
 *
 * Handles the notice message, key, and schedule.
 *
 * @package BwlFaqManager
 */
class AddonNoticeBlockCb {

	use TraitAdminNotice;

	/**
	 * The notice key.
	 *
	 * @var string
	 * @note change the key.
	 */
	private static $key = 'baf_addons_prompt';

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

		// Set the schedule key.
		$schedule_key = self::$key . '_schedule';

		// Get the schedule. (if exists)
		$schedule = $this->get_schedule( $schedule_key );

		if ( empty( $schedule ) ) {
			// This is the default date time.
			$now      = date( 'Y-m-d H:i:s' );
			$schedule = date( 'Y-m-d H:i:s', strtotime( $now ) + ( self::$interval * DAY_IN_SECONDS ) );

			$this->set_schedule( $schedule_key, $schedule );
		}

		// Set notice parameters.
		// @params: msg, key, start, status, is_dismissable, noticeClass
		$notice = [
			[
				'msg'      => '🎉 Enhance your site with our free addons! <a href="' . admin_url( 'edit.php?post_type=bwl_advanced_faq&page=baf-addons' ) . '" class="bwl_activation_link">Install Now</a> for the ' . BAF_PLUGIN_TITLE . '.',
				'key'      => self::$key,
				'schedule' => $schedule,
			],
		];

		return $notice;
	}
}
