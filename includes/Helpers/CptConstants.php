<?php
namespace KDESKADDON\Helpers;

/**
 * Class for plugin constants.
 *
 * @package KDESKADDON
 */
class CptConstants {


	/**
     * Static property to hold plugin cpts.
     *
     * @var array
     */
    public static $kdesk_cpts = [];

	/**
	 * Register the plugin constants.
	 */
	public static function register() {

		self::set_custom_post_types();
		self::set_portfolio_constants();
		self::set_testimonial_constants();
	}

	/**
	 * Set the custom post types.
	 */
	private static function set_custom_post_types() {
		self::$kdesk_cpts = [ 'portfolio', 'kdesk_testimonial' ];
	}


	/**
	 * Set the portfolio cpt constants.
	 */
	private static function set_portfolio_constants() {
		define( 'KDESK_CPT_PORTFOLIO_TITLE', 'Portfolio' );
		define( 'KDESK_CPT_PORTFOLIO', 'portfolio' );
		define( 'KDESK_CPT_PORTFOLIO_SLUG', 'portfolio' );
		define( 'KDESK_CPT_PORTFOLIO_TAX_CAT', 'portfolio_category' );
		define( 'KDESK_CPT_PORTFOLIO_TAX_CAT_SLUG', 'portfolio_category' );
	}

	/**
	 * Set the testimonial cpt constants.
	 */
	private static function set_testimonial_constants() {
		define( 'KDESK_CPT_TESTIMONIAL_TITLE', 'Testimonial' );
		define( 'KDESK_CPT_TESTIMONIAL', 'kdesk_testimonial' );
		define( 'KDESK_CPT_TESTIMONIAL_SLUG', 'kdesk_testimonial' );
		define( 'KDESK_CPT_TESTIMONIAL_TAX_CAT', 'kdesk_testimonial' );
		define( 'KDESK_CPT_TESTIMONIAL_TAX_CAT_SLUG', 'kdesk_testimonial' );
	}
}
