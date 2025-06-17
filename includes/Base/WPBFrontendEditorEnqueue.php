<?php
namespace KDESKADDON\Base;

/**
 * Class for registering the plugin frontend scripts and styles.
 *
 * @package KDESKADDON
 */
class WPBFrontendEditorEnqueue {

	/**
	 * Frontend script slug.
	 *
	 * @var string $frontend_script_slug
	 */
	private $frontend_script_slug;
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->frontend_script_slug = 'kdeskaddon-frontend';
	}

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		add_action( 'vc_load_iframe_jscss', [ $this, 'kdesk_load_front_editor_scripts' ] );
	}


	/**
     * Front End WP Bakery Page Builder Style & Scripts.
     */
    public function kdesk_load_front_editor_scripts() {
			wp_enqueue_style(
                $this->frontend_script_slug,
                KDESKADDON_STYLES_ASSETS_DIR . 'frontend.css',
                [],
                KDESKADDON_PLUGIN_VERSION
            );
			wp_enqueue_script(
                $this->frontend_script_slug,
                KDESKADDON_SCRIPTS_ASSETS_DIR . 'frontend.js',
                [ 'jquery' ],
                KDESKADDON_PLUGIN_VERSION,
                true
            );
	}
}
