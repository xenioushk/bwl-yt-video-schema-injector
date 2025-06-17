<?php
namespace KDESKADDON\Callbacks\Actions\Admin\Scheduler;

use KDESKADDON\Helpers\Common;

/**
 * Class for registering the offer scheduler callback.
 *
 * @package KDESKADDON
 * @since: 2.1.9
 * @author: Mahbub Alam Khan
 */
class OfferSchedulerCb {

	/**
	 * The cron job ID.
	 *
	 * @var string
	 * @note only change the option_id value.
	 */
	private $option_id = KDESKADDON_CRON_OFFER_OPTION_ID;

	/**
	 * Get the Offer API URL.
	 *
	 * @return string The API URL.
	 */
	private function get_api_url() {

		$api_url = Common::bwl_api_url() . 'wp-json/bwlapi/v1/offer?p_id=' . KDESKADDON_PRODUCT_ID;
		return $api_url;
	}

	/**
	 * Get the API updates.
	 *
	 * @return void
	 */
	public function fetch_api_data() {

		$response = wp_remote_get( $this->get_api_url() );

		if ( is_wp_error( $response ) ) {
			return;
		}

		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );

		if ( ! empty( $data['status'] ) && ! empty( $data['data'] ) ) {
			// Save to data to the database.
			$this->save_schedule_data( $data );
		} else {
			delete_option( $this->option_id );
		}
	}

	/**
	 * Save the schedule data.
	 *
	 * @param array $data The data to save.
	 * @return void
	 */
	private function save_schedule_data( $data = [] ) {
		if ( ! is_array( $data ) || empty( $data ) ) {
			return;
		}

		// Extract the offer_id from rest api response.
		$offer_id = $data['data']['offer_id'] ?? '';

		// Check the option exists or not
		$prev_data = get_option( $this->option_id );

		if ( ! empty( $prev_data ) ) {
			$prev_offer_id = $prev_data['data']['offer_id'] ?? '';

			// If the offer_id is same as the previous one, then return.
			if ( $prev_offer_id === $offer_id ) {
				return;
			}
		}

		// Finally save or update the data
		update_option( $this->option_id, $data );
	}
}
