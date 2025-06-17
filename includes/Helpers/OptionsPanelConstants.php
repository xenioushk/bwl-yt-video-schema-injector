<?php
namespace BwlFaqManager\Helpers;

/**
 * Class for plugin options panel constants.
 *
 * @package BwlFaqManager
 */
class OptionsPanelConstants {


	/**
	 * Register the plugin constants.
	 */
	public static function register() {

		self::set_fonts_constants();
		self::set_reading_constants();
		self::set_advanced_constants();
	}

	/**
	 * Set the plugin options panel fonts constants.
	 */
	private static function set_fonts_constants() {
		define( 'BAF_FONT_AWESOME_STATUS', 'bwl_advanced_fa_status' );
	}

	/**
	 * Set the plugin options panel reading constants.
	 */
	private static function set_reading_constants() {
		define( 'BAF_DISABLE_SINGLE_FAQ_STATUS', 'baf_disable_single_faq_status' );
	}

	/**
	 * Set the plugin options panel advanced constants.
	 */
	private static function set_advanced_constants() {
		define( 'BAF_CPT_CUSTOM_SLUG', 'bwl_advanced_faq_custom_slug' );
		define( 'BAF_SUB_CAT_STATUS', 'baf_sub_cat_status' );
		define( 'BAF_GUTENBERG_STATUS', 'baf_gutenberg_status' );
		define( 'BAF_COMMENT_STATUS', 'baf_comment_status' );
		define( 'BAF_FAQ_SCHEMA_STATUS', 'baf_faq_schema_status' );
		define( 'BAF_INLINE_CUSTOM_CSS', 'bwl_advanced_faq_custom_css' );
	}
}
