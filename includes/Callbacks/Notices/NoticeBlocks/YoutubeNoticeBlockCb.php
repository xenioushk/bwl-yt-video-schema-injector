<?php
namespace BwlFaqManager\Callbacks\Notices\NoticeBlocks;

use BwlFaqManager\Traits\TraitAdminNotice;

/**
 * Class Youtube Playlist Notice Block.
 *
 * Handles the notice message, key, and schedule.
 *
 * @package BwlFaqManager
 */
class YoutubeNoticeBlockCb {

	use TraitAdminNotice;

	/**
	 * The notice key.
	 *
	 * @var string
	 * @note change the key.
	 */
	private static $key    = 'baf_youtube_playlist_status';
	private static $yt_key = 'baf_youtube_';

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
	private static $interval = 2; // 1 day interval.

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
				'msg'      => '🎉 Good News ! We have added a <a href="' . BAF_PRODUCT_YOUTUBE_PLAYLIST . '" class="bwl_activation_link">YouTube Playlists</a> for the ' . BAF_PLUGIN_TITLE . ' plugin.',
				'key'      => self::$key,
				'schedule' => $schedule,
			],

			[
				'msg' => '✅ New Feature ! Easily organize your FAQ categories and sub-categories from the <a href="' . admin_url( 'edit.php?post_type=bwl_advanced_faq&page=bwl_advanced_faq_sort&sort_filter=category-sort' ) . '" class="bwl_activation_link">FAQ Category Sorting</a> page. Follow the <a href="https://youtu.be/vTB0n8lzjNc" class="bwl_activation_link" target="_blank">tutorial</a> to see how it works!',
				'key' => self::$yt_key . 'vTB0n8lzjNc',
			],
		];

		return $notice;
	}
}
