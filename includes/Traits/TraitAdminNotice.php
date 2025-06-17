<?php
namespace KDESKADDON\Traits;

trait TraitAdminNotice {

	/**
	 * Display the admin notices.
	 *
	 * @param array $notice The notice to display.
	 */
    public function get_notice_html( $notice = [] ) {

		if ( empty( $notice ) ) {
			return;
		}

		// Key is the super important part of the notice.
		$key = $notice['key'] ?? '';

			// Set the schedule key.
			// Default: 0
			$schedule_status     = 0;
			$scheduled_date_time = $notice['schedule'] ?? 0;
			$is_schedule_set     = ( $scheduled_date_time !== 0 ) ? 1 : 0;

		if ( $is_schedule_set ) {

			// Now we will check the schedule date time.
			// For test we can add the date like "2025-04-01"
			$current_date = date( 'Y-m-d' );

			// Get the scheduled date
			list($scheduled_date) = explode( ' ', $scheduled_date_time );

			// Display the notice for the next 5 days
			$days_difference = ( strtotime( $current_date ) - strtotime( $scheduled_date ) ) / DAY_IN_SECONDS;

			if ( $days_difference >= 0 && $days_difference <= 5 ) {
				// The scheduled date is valid for the next 5 days (including today).
				$schedule_status = 1;
			}
		}

		// phpcs:disable
		/**
		 * @notes: status variable notes
		 * 3 Super important parts of the status.
		 * $notice['status] : this value is set by the user directly while declaring the notice. example: license activation.
		 * get_option( $key ) : this value is set by the user when he dismisses the notice. example: user click the close btn.
		 * $schedule_status : this value is set by the schedule. example: if the schedule expires, the notice will be closed.
		 */
		// phpcs:enable

			// 1= hide, 0/empty=show the notice
			$status = intval( $notice['status'] ?? get_option( $key ) );

		if ( $is_schedule_set ) {

			// Now check if the schedule status is valid
			if ( $schedule_status ) {
				$status = intval( $schedule_status && $status );
			} else {
				$status = 1;
			}
		}

			$is_dismissable     = $notice['is_dismissable'] ?? 1;
			$dismissable_string = '';
			$dismissable_class  = '';

		if ( $is_dismissable === 1 ) {
			$nonce = wp_create_nonce( 'dismiss_notice_' . $key );

			$btn_class = 'notice-dismiss bwl_remove_notice';

			$dismissable_string = "<button type='button' class='{$btn_class}' data-key='{$key}' data-nonce='{$nonce}'>
        <span class='screen-reader-text'>Dismiss this notice.</span>
        </button>";
			$dismissable_class  = ' is-dismissible';
		}

		// Finally, we will display the notice if the value of the status is 0/empty.
		if ( $status !== 1 ) {

			$notice_class = $notice['noticeClass'] ?? 'success';

			$dismissable_class .= " notice notice-{$notice_class}";
			$msg                = trim( $notice['msg'] );
			echo "<div class='{$dismissable_class}'>
                <p class='bwl_plugins_notice_text'>{$msg}</p>
                {$dismissable_string}
                </div>";
		}
	}

	/**
	 * Set the schedule.
	 *
	 * @param string $schedule_key The schedule key.
	 * @param string $schedule The schedule.
	 */
	public function set_schedule( $schedule_key, $schedule ) {
		if ( ! empty( $schedule_key ) && ! empty( $schedule ) ) {
			update_option( $schedule_key, $schedule );
		}
	}

	/**
	 * Get the schedule.
	 *
	 * @param string $schedule_key The schedule key.
	 * @return string The schedule.
	 */
	public function get_schedule( $schedule_key ) {
		return get_option( $schedule_key );
	}
}
