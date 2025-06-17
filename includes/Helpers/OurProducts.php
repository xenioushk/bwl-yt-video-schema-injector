<?php
namespace KDESKADDON\Helpers;

use KDESKADDON\Callbacks\Actions\Admin\ProductsSchedulerCb;

/**
 * Class for common helper functions
 *
 * @package KDESKADDON
 */
class OurProducts {

    /**
	 * Get the products data.
	 *
	 * @return array
	 */
	public static function get_products() {

		$our_products = get_option( KDESKADDON_CRON_BWL_PRODUCTS_OPTION_ID ) ?? [];

		if ( empty( $our_products ) ) {
			$our_products = ( new ProductsSchedulerCb() )->fetch_api_data( true );
		}

		$general    = [];
		$wp_plugins = [];
		$wp_themes  = [];

		if ( ! empty( $our_products ) ) {
			foreach ( $our_products['data'] as $product ) {
				switch ( $product['tag'] ) {
					case 'wp-plugin':
						$wp_plugins[] = $product;
						break;
					case 'wp-theme':
						$wp_themes[] = $product;
						break;
					default:
						$general[] = $product;
						break;
				}
			}
		}

		$data = [
			'wp_plugins' => $wp_plugins,
			'wp_themes'  => $wp_themes,
			'general'    => $general,
		];

		return $data;
	}
}
