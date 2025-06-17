<?php
namespace KDESKADDON\Base;

/**
 * Class PluginInstallation
 *
 * @package KDESKADDON
 */
class PluginInstallation {

	/**
	 * Register the plugin installation date.
	 */
	public function register() {
		add_action( 'admin_init', [ $this, 'set_plugin_installation_date' ] );
	}

	/**
	 * Sets the plugin installation date if it is not already set.
	 */
	public function set_plugin_installation_date() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// Plugin Installation Date Time.
		if ( empty( get_option( KDESKADDON_PRODUCT_INSTALLATION_DATE ) ) ) {
			update_option( KDESKADDON_PRODUCT_INSTALLATION_DATE, date( 'Y-m-d H:i:s' ) );
		}
	}
}
