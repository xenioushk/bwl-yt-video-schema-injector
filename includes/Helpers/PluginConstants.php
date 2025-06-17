<?php
namespace BWLYTVSI\Helpers;

/**
 * Class for plugin constants.
 *
 * @package BWLYTVSI
 */
class PluginConstants {

	/**
     * Static property to hold plugin options.
     *
     * @var array
     */
    public static $plugin_options = [];

		/**
         * Get the absolute path to the plugin root.
         *
         * @return string
         * @example wp-content/plugins/bwl-advanced-faq-manager/
         */
    public static function get_plugin_path(): string {
        return dirname( dirname( __DIR__ ) ) . '/';
    }

    /**
     * Get the plugin URL.
     *
     * @return string
     * @example http://bafwp.local/wp-content/plugins/bwl-advanced-faq-manager/
     */
    public static function get_plugin_url(): string {
		return plugin_dir_url( self::get_plugin_path() . BWLYTVSI_ROOT_FILE );
	}

	/**
	 * Register the plugin constants.
	 */
	public static function register() {
		self::set_paths_constants();
		self::set_base_constants();
		self::set_assets_constants();
	}

	/**
	 * Set the plugin base constants.
	 */
	private static function set_base_constants() {

		// This is super important to check if the get_plugin_data function is already loaded or not.
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin_data = get_plugin_data( BWLYTVSI_DIR . BWLYTVSI_ROOT_FILE );

		define( 'BWLYTVSI_PLUGIN_VERSION', $plugin_data['Version'] ?? '1.0.0' );
		define( 'BWLYTVSI_PLUGIN_TITLE', $plugin_data['Name'] ?? 'BWL YouTube Video Schema Injector' );
		define( 'BWLYTVSI_TRANSLATION_DIR', $plugin_data['DomainPath'] ?? '/languages/' );
		define( 'BWLYTVSI_TEXT_DOMAIN', $plugin_data['TextDomain'] ?? '' );

		define( 'BWLYTVSI_PLUGIN_FOLDER', 'bwl-yt-video-schema-injector' );
		define( 'BWLYTVSI_CURRENT_VERSION', BWLYTVSI_PLUGIN_VERSION );
	}

	/**
	 * Set the plugin paths constants.
	 */
	private static function set_paths_constants() {
		define( 'BWLYTVSI_ROOT_FILE', 'bwl-yt-video-schema-injector.php' );
		define( 'BWLYTVSI_DIR', self::get_plugin_path() );
		define( 'BWLYTVSI_FILE_PATH', BWLYTVSI_DIR );
		define( 'BWLYTVSI_URL', self::get_plugin_url() );
		define( 'BWLYTVSI_CONTROLLER_DIR', BWLYTVSI_DIR . 'includes/Controllers/' );
		define( 'BWLYTVSI_VIEWS_DIR', BWLYTVSI_DIR . 'includes/Views/' );
	}

	/**
	 * Set the plugin assets constants.
	 */
	private static function set_assets_constants() {
		define( 'BWLYTVSI_STYLES_ASSETS_DIR', BWLYTVSI_URL . 'assets/styles/' );
		define( 'BWLYTVSI_SCRIPTS_ASSETS_DIR', BWLYTVSI_URL . 'assets/scripts/' );
		define( 'BWLYTVSI_LIBS_DIR', BWLYTVSI_URL . 'libs/' );
	}
}
