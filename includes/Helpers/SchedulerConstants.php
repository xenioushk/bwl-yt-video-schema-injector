<?php
namespace KDESKADDON\Helpers;

/**
 * Class for plugin options panel constants.
 *
 * @package KDESKADDON
 */
class SchedulerConstants {

	/**
	 * Register the plugin constants.
	 */
	public static function register() {

		self::set_interval_constants();
		// Step 1: Define the cron job constants.
		self::set_cronjob_constants();
	}

	/**
	 * Set the plugin options panel fonts constants.
	 */
	private static function set_interval_constants() {

		if ( ! defined( 'BWL_CRON_EVERY_MINUTE' ) ) {
			define( 'BWL_CRON_EVERY_MINUTE', 60 );
			define( 'BWL_CRON_EVERY_HOUR', 3600 );
			define( 'BWL_CRON_EVERY_DAY', 24 * BWL_CRON_EVERY_HOUR );
			define( 'BWL_CRON_EVERY_WEEK', 7 * BWL_CRON_EVERY_DAY );
		}

	}

	/**
	 * Set the plugin options panel reading constants.
	 */
	private static function set_cronjob_constants() {
		// This is the action hook name for the cron job.
		// This should be unique to avoid conflicts with other plugins.
		define( 'KDESKADDON_CRON_OFFER_ID', 'kdesk_check_offer' );
		define( 'KDESKADDON_CRON_BWL_PRODUCTS_ID', 'bwl_check_products' );

		// Cron Data ID.
		// This is the option ID for storing the cron job data.

		define( 'KDESKADDON_CRON_OFFER_OPTION_ID', 'kdesk_scheduled_offer' );
		define( 'KDESKADDON_CRON_BWL_PRODUCTS_OPTION_ID', 'bwl_all_products' );

		// Step 2: Navigate to the the
	}
}
