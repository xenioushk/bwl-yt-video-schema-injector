<?php
namespace BwlFaqManager\Base;

/**
 * Class AboutPluginRedirect
 *
 * After plugin activation, it will redirect the user to about plugin page
 *
 * @package BwlFaqManager
 */
class AboutPluginRedirect {

	/**
	 * URL to redirect after plugin activation
	 *
	 * @var string
	 */
	private $redirect_url;

	/**
	 * Constructor method
	 *
	 * @since 2.0.6
	 */
	public function __construct() {
		$this->redirect_url = 'edit.php?post_type=bwl_advanced_faq&page=bwl-advanced-faq-welcome';
	}

	/**
	 * Register the actions/hooks
	 *
	 * @since 2.0.6
	 */
	public function register() {
		add_action( 'admin_init', [ $this, 'get_the_page' ] );
	}

	/**
	 * Callback function for the about plugin page.
	 *
	 * @since 2.0.6
	 */
	public function get_the_page() {

		if ( get_transient( 'baf_activation_redirect' ) ) {

			delete_transient( 'baf_activation_redirect' );

			if ( is_admin() && ! isset( $_GET['activate-multi'] ) ) {
				wp_safe_redirect( admin_url( $this->redirect_url ) );
				exit;
			}
		}
	}
}
