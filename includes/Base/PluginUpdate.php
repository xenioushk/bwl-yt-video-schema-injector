<?php
namespace KDESKADDON\Base;

use Xenioushk\BwlPluginApi\Api\PluginUpdate\WpAutoUpdater;

/**
 * Class for plugin update.
 *
 * @since: 1.1.0
 * @package KDESKADDON
 */
class PluginUpdate {

  	/**
     * Register the plugin text domain.
     */
	public function register() {
		add_action( 'admin_init', [ $this, 'check_for_the_update' ] );
	}

	/**
     * Check for the plugin update.
     */
	public function check_for_the_update() {

		$base          = 'https://projects.bluewindlab.net/wpplugin/zipped/themes/';
		$notifier_file = $base . 'knowledgedesk/notifier_knowledgedesk.php';
		new WpAutoUpdater( KDESKADDON_PLUGIN_VERSION, $notifier_file, KDESKADDON_UPDATER_SLUG );
	}
}
