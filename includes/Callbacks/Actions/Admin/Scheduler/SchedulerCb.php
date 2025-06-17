<?php
namespace KDESKADDON\Callbacks\Actions\Admin\Scheduler;

/**
 * Class for registering all the schedulers.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class SchedulerCb {

	/**
	 * Set the cron schedule.
	 */
	public function register_cron_schedule() {
		// For Offers.
		// @check: Everyday
		if ( ! as_next_scheduled_action( KDESKADDON_CRON_OFFER_ID ) ) {
			as_schedule_recurring_action( time(), BWL_CRON_EVERY_DAY, KDESKADDON_CRON_OFFER_ID );
		}

		// For BWL Products.
		// @check: Every 1 Week
		if ( ! as_next_scheduled_action( KDESKADDON_CRON_BWL_PRODUCTS_ID ) ) {
			as_schedule_recurring_action( time(), BWL_CRON_EVERY_WEEK, KDESKADDON_CRON_BWL_PRODUCTS_ID );
		}
	}
}
