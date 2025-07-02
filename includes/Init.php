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
			'actions' => self::get_action_classes(),
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
			Helpers\PluginConstants::class,
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
}
