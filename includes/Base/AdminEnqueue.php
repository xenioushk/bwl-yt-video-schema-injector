<?php
namespace KDESKADDON\Base;

/**
 * Class for registering the plugin admin scripts and styles.
 *
 * @package KDESKADDON
 */
class AdminEnqueue {

	/**
	 * Admin script slug.
	 *
	 * @var string $admin_script_slug
	 */
	private $admin_script_slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->admin_script_slug = 'kdeskaddon-admin';
	}

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		// for admin.
		add_action( 'admin_enqueue_scripts', [ $this, 'get_the_scripts' ] );
	}
	/**
     * Load the plugin styles and scripts.
     */
	public function get_the_scripts() {

		// Load admin styles & scripts.
		wp_enqueue_style(
            $this->admin_script_slug,
            KDESKADDON_STYLES_ASSETS_DIR . 'admin.css',
            [],
            KDESKADDON_PLUGIN_VERSION
		);

		if ( is_rtl() ) {
			wp_enqueue_style(
				$this->admin_script_slug . '-rtl',
				KDESKADDON_STYLES_ASSETS_DIR . 'admin_rtl.css',
				[],
				KDESKADDON_PLUGIN_VERSION
			);
		}

            wp_enqueue_script(
                $this->admin_script_slug,
                KDESKADDON_SCRIPTS_ASSETS_DIR . 'admin.js',
                [ 'jquery', 'jquery-ui-core', 'jquery-ui-autocomplete' ],
                KDESKADDON_PLUGIN_VERSION,
                true
            );

						wp_enqueue_editor();
		// Load frontend variables used by the JS files.
		$this->get_the_localization_texts();
	}

	/**
	 * Load the localization texts.
	 */
	private function get_the_localization_texts() {

		// Localize scripts.
		// Frontend.
		// Access data: BptmAdminData.version
		wp_localize_script(
            $this->admin_script_slug,
            'KdeskAddonAdminData',
            [
				'ajaxurl'          => esc_url( admin_url( 'admin-ajax.php' ) ),
				'text_loading'     => esc_attr__( 'Loading .....', 'kdesk_vc' ),
				'pvc_required_msg' => esc_attr__( 'Purchase code is required!', 'kdesk_vc' ),
				'pvc_success_msg'  => esc_attr__( 'Purchase code verified. Reloading window in 3 seconds.', 'kdesk_vc' ),
				'pvc_failed_msg'   => esc_attr__( 'Unable to verify purchase code. Please try again or contact support team.', 'kdesk_vc' ),
				'pvc_remove_msg'   => esc_attr__( 'Are you sure to remove the license info?', 'kdesk_vc' ),
				'pvc_removed_msg'  => esc_attr__( 'Purchase code removed. Reloading window in 3 seconds.', 'kdesk_vc' ),
				'product_id'       => KDESKADDON_PRODUCT_ID,
			]
		);
	}
}
