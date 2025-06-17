<?php
namespace KDESKADDON\Callbacks\AdminAjaxHandlers;

use KDESKADDON\Helpers\Common;
/**
 * Class for purchase verify callback.
 *
 * @package KDESKADDON
 */
class PurchaseVerifyCb {

	/**
	 * Verify purchase code.
	 *
	 * @since: 2.0.0
	 */
	public function verify() {

		$apiURL        = Common::bwl_api_url();
		$site_url      = get_site_url();
		$purchase_code = trim( $_REQUEST['purchase_code'] );
		$product_id    = KDESKADDON_PRODUCT_ID;
		$ip            = $_SERVER['REMOTE_ADDR'];

		$requestUrl = $apiURL . "wp-json/bwlapi/v1/verify/purchase?purchase_code=$purchase_code&product_id=$product_id&site=$site_url&referer=$ip";

		$apiResponse = wp_remote_get( $requestUrl );

		$data = [
			'status' => 0,
		];

		if ( is_array( $apiResponse ) && ! is_wp_error( $apiResponse ) && wp_remote_retrieve_response_code( $apiResponse ) === 200 ) {

			$apiData = json_decode( wp_remote_retrieve_body( $apiResponse ), true ); // Get the response body.

			if ( isset( $apiData['status'] ) && $apiData['status'] == 1 ) {

				update_option( KDESKADDON_PURCHASE_VERIFIED_KEY, 1 );
				update_option( KDESKADDON_PURCHASE_INFO_KEY, $apiData );
			}

			$data['status'] = $apiData['status'];
			$data['msg']    = $apiData['msg'];
		} elseif ( is_wp_error( $apiResponse ) ) {
			// Handle WP_Error case.
			$error_message = $apiResponse->get_error_message();
			$data          = [
				'msg' => $error_message,
			];

		} else {
			// Handle non-200 status codes.
			$status_code = wp_remote_retrieve_response_code( $apiResponse );

			$data = [
				'msg' => "Request failed with status code: $status_code",
			];

		}

		echo wp_json_encode( $data );

		die();
	}

	/**
	 * Remove purchase data.
	 *
	 * @since: 2.0.0
	 */
	public function remove() {

		$apiURL      = Common::bwl_api_url();
		$verify_hash = sanitize_text_field( $_REQUEST['verify_hash'] );

		// For Offline Code Removal.

		if ( $verify_hash == 'offline' ) {
			delete_option( KDESKADDON_PURCHASE_VERIFIED_KEY );
			delete_option( KDESKADDON_PURCHASE_INFO_KEY );
			$data['status'] = 1;
			echo wp_json_encode( $data );
			die();
		}

		// Remove offline code to API server.

		$requestUrl = $apiURL . "wp-json/bwlapi/v1/verify/remove?verify_hash=$verify_hash";

		$apiResponse = wp_remote_get( $requestUrl );

		$data = [
			'status' => 0,
		];

		if ( is_array( $apiResponse ) && ! is_wp_error( $apiResponse ) && wp_remote_retrieve_response_code( $apiResponse ) === 200 ) {

			$apiData = wp_remote_retrieve_body( $apiResponse ); // Get the response body.

			$apiData = json_decode( $apiData, true );

			if ( isset( $apiData['status'] ) && $apiData['status'] == 1 ) {
				delete_option( KDESKADDON_PURCHASE_VERIFIED_KEY );
				delete_option( KDESKADDON_PURCHASE_INFO_KEY );
			}

			$data['status'] = $apiData['status'];
			$data['msg']    = $apiData['msg'];
		} elseif ( is_wp_error( $apiResponse ) ) {
			// Handle WP_Error case.
			$error_message = $apiResponse->get_error_message();
			$data          = [
				'msg' => $error_message,
			];

		} else {
			// Handle non-200 status codes.
			$status_code = wp_remote_retrieve_response_code( $apiResponse );

			$data = [
				'msg' => "Request failed with status code: $status_code",
			];

		}

		echo wp_json_encode( $data );

		die();
	}
}
