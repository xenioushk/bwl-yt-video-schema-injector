<?php
namespace BWLYTVSI;

/**
 * Class Init
 *
 * Initializes and registers all the services for the plugin.
 *
 * @package BWLYTVSI
 */
class Init {

	/**
	 * Retrieves the list of services to be registered
	 *
	 * @since 2.0.6
	 */
	public static function get_services() {

		/**
		 * Add plugin required classes.
		 *
		 * @since 1.0.0
		 */

		$services = [];

		$service_classes = [
			'helpers' => self::get_helper_classes(),
			// 'base'    => self::get_base_classes(),
			// 'meta'          => self::get_meta_classes(),
			'actions' => self::get_action_classes(),
			// 'filters'       => self::get_filter_classes(),
			// 'cpt'           => self::get_cpt_classes(),
			// 'cmb'           => self::get_cmb_classes(),
			// 'shortcode'     => self::get_shortcode_classes(),
			// 'wpbakery'      => self::get_wpbakery_classes(),
			// 'notices'       => self::get_notices_classes(),
			// 'options_panel' => self::get_options_panel_classes(),
		];

		foreach ( $service_classes as $service_class ) {
			$services = array_merge( $services, $service_class );
		}

		return $services;
	}

	/**
	 * Registered all the classes.
	 *
	 * @since 1.0.0
	 */
	public static function register_services() {

		if ( empty( self::get_services() ) ) {
			return;
		}

		foreach ( self::get_services() as $service ) {

			$service = self::instantiate( $service );

			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Instantiate all the registered service classes.
	 *
	 * @param   class $service The class to instantiate.
	 * @author   Md Mahbub Alam Khan
	 * @return  object
	 * @since   1.1.0
	 */
	private static function instantiate( $service ) {
		return new $service();
	}

	/**
	 * Get Helper classes.
	 *
	 * @return array
	 * @note Ordering of the classes is important.
	 *    The classes should be ordered in a way that the dependencies are loaded first.
	 */
	private static function get_helper_classes() {
		$classes = [
			// Helpers\SchedulerConstants::class,
			Helpers\PluginConstants::class,
			// Helpers\CptConstants::class,
			// Helpers\Common::class,
			// Helpers\OurProducts::class,
		];
		return $classes;
	}

	/**
	 * Get Meta classes.
	 *
	 * @return array
	 */
	private static function get_meta_classes() {
		$classes = [
			Controllers\PluginMeta\MetaInfo::class,
		];
		return $classes;
	}

	/**
	 * Get Base classes.
	 *
	 * @return array
	 */
	private static function get_base_classes() {
		$classes = [
			Base\Enqueue::class,
			Base\WPBFrontendEditorEnqueue::class,
			Base\AdminEnqueue::class,
			Base\WPBAdminEditorEnqueue::class,
			Base\Language::class,
			Base\PluginInstallation::class,
			// Base\FrontendAjaxHandlers::class,
			Base\AdminAjaxHandlers::class,
			// Base\AboutPluginRedirect::class,
			Base\PluginUpdate::class,
			Base\IncludePluginFiles::class,
		];
		return $classes;
	}

	/**
	 * Get Action classes.
	 *
	 * @return array
	 */
	private static function get_action_classes() {

		$classes = [
			Controllers\Actions\Frontend\YtSchemaInjector::class,
			Controllers\Actions\Admin\OptionsPanel::class,
		];
		return $classes;
	}

	/**
	 * Get Filter classes.
	 *
	 * @return array
	 */
	private static function get_filter_classes() {

		$classes = [
			Controllers\Filters\Admin\AuthorSocialMeta::class,
		];
		return $classes;
	}

	/**
	 * Get CPT classes.
	 *
	 * @return array
	 */
	private static function get_cpt_classes() {
		$classes = [
			Controllers\Cpt\Portfolio::class,
			Controllers\Cpt\Testimonial::class,
			Controllers\Cpt\CustomColumns::class,
			// Controllers\Cpt\QuickBulkEdit::class,
			Controllers\Cpt\TaxonomyFilters::class,
			Controllers\Cpt\SortableColumns::class,
		];
		return $classes;
	}

	/**
	 * Get CMB classes.
	 *
	 * @return array
	 */
	private static function get_cmb_classes() {
		$classes = [
			Controllers\Cmb\Portfolio\PortfolioCmb::class,
			Controllers\Cmb\Testimonial\TestimonialCmb::class,
		];
		return $classes;
	}
		/**
         * Get WPBakery classes.
         *
         * @return array
         */
	private static function get_wpbakery_classes() {

		$classes = [
			Controllers\WPBakery\Elements\Banner\Banner::class,
			Controllers\WPBakery\Elements\BlogPosts\BlogPosts::class,
			Controllers\WPBakery\Elements\Button\Button::class,
			Controllers\WPBakery\Elements\ContactInfo\ContactInfo::class,
			Controllers\WPBakery\Elements\Counter\Counter::class,
			Controllers\WPBakery\Elements\Cta\Cta::class,
			Controllers\WPBakery\Elements\CustomElements\CustomElements::class,
			Controllers\WPBakery\Elements\Gallery\Gallery::class,
			Controllers\WPBakery\Elements\Heading\Heading::class,
			Controllers\WPBakery\Elements\Highlights\Highlights::class,
			Controllers\WPBakery\Elements\Jumbotron\Jumbotron::class,
			Controllers\WPBakery\Elements\Logos\Logos::class,
			Controllers\WPBakery\Elements\Portfolio\Portfolio::class,
			Controllers\WPBakery\Elements\Pricetable\Pricetable::class,
			Controllers\WPBakery\Elements\Slider\Slider::class,
			Controllers\WPBakery\Elements\SocialLink\SocialLink::class,
			Controllers\WPBakery\Elements\Team\Team::class,
			Controllers\WPBakery\Elements\Testimonial\Testimonial::class,
			Controllers\WPBakery\Elements\Video\Video::class,
		];

		return $classes;
	}

	/**
	 * Get Shortcode classes.
	 *
	 * @return array
	 */
	private static function get_shortcode_classes() {
		$classes = [
			Controllers\Shortcodes\Banner::class,
			Controllers\Shortcodes\Button::class,
			Controllers\Shortcodes\BlogPosts::class,
			Controllers\Shortcodes\ContactInfo::class,
			Controllers\Shortcodes\Counter::class,
			Controllers\Shortcodes\Cta::class,
			Controllers\Shortcodes\Gallery::class,
			Controllers\Shortcodes\Highlights::class,
			Controllers\Shortcodes\Heading::class,
			Controllers\Shortcodes\Jumbotron::class,
			Controllers\Shortcodes\Logos::class,
			Controllers\Shortcodes\Portfolio::class,
			Controllers\Shortcodes\Pricetable::class,
			Controllers\Shortcodes\Slider::class,
			Controllers\Shortcodes\SocialLink::class,
			Controllers\Shortcodes\Team::class,
			Controllers\Shortcodes\Testimonial::class,
			Controllers\Shortcodes\Video::class,
			Controllers\Shortcodes\Discounts::class,
		];
		return $classes;
	}

	/**
	 * Get Notices classes.
	 *
	 * @return array
	 */
	private static function get_notices_classes() {
		$classes = [
			Controllers\Notices\PluginNotices::class,
			Controllers\Notices\PluginNoticesAjaxHandler::class,
		];
		return $classes;
	}

	/**
	 * Get Options Panel classes.
	 *
	 * @return array
	 */
	private static function get_options_panel_classes() {
		$classes = [
			Controllers\OptionsPanel\SettingsMenu::class,
			// Controllers\OptionsPanel\SettingsPage::class,
		];
		return $classes;
	}
}
