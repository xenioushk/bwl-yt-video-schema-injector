<?php
namespace KDESKADDON\Base;

/**
 * Class for registering the plugin frontend scripts and styles.
 *
 * @package KDESKADDON
 */
class Enqueue {

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
		add_action( 'wp_enqueue_scripts', [ $this, 'get_the_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'get_the_scripts' ] );
	}

	/**
	 * Load the plugin styles.
	 */
	public function get_the_styles() {
		// Register Styles.

		$third_party_styles = [
			'animate' => [
				'src' => 'animate',
			],
			'owl.carousel' => [
				'src' => 'owl.carousel,owl.theme,owl.transitions',
			],
			'venobox' => [
				'src' => 'venobox',
			],
		];
		foreach ( $third_party_styles as $style_key => $style_info ) {

			$multi_styles = explode( ',', $style_info['src'] );
			$is_array     = ( count( $multi_styles ) ) > 1 ? 1 : 0;
			if ( $is_array ) {
				foreach ( $multi_styles as $style ) {
					wp_enqueue_style(
						$this->frontend_script_slug . '-' . $style,
						KDESKADDON_LIBS_DIR . "{$style_key}/styles/{$style}.css",
						[],
						KDESKADDON_PLUGIN_VERSION
					);
				}
			} else {
				// Enqueue the style

				wp_enqueue_style(
                    $style_key,
                    KDESKADDON_LIBS_DIR . "{$style_key}/styles/{$style_info['src']}.css",
                    [],
                    KDESKADDON_PLUGIN_VERSION
				);
			}
		}

		wp_enqueue_style(
            $this->frontend_script_slug,
            KDESKADDON_STYLES_ASSETS_DIR . 'frontend.css',
            [],
            KDESKADDON_PLUGIN_VERSION
		);

		if ( is_rtl() ) {

			wp_enqueue_style(
				$this->frontend_script_slug . '-frontend-rtl',
				KDESKADDON_STYLES_ASSETS_DIR . 'frontend_rtl.css',
				[],
				KDESKADDON_PLUGIN_VERSION
			);
		}

	}

	/**
	 * Load the plugin scripts.
	 */
	public function get_the_scripts() {

		$third_party_scripts = [
			'jquery.backTop' => [
				'src' => 'jquery.backTop.min',
			],
			'jquery.counterup' => [
				'src' => 'jquery.counterup.min',
			],
			'waypoints' => [
				'src' => 'waypoints.min',
			],
			'owl.carousel' => [
				'src' => 'owl.carousel.min',
			],
			'venobox' => [
				'src' => 'venobox.min',
			],
		];

		foreach ( $third_party_scripts as $script_key => $script_info ) {
			wp_enqueue_script(
                $script_key,
                KDESKADDON_LIBS_DIR . "{$script_key}/scripts/{$script_info['src']}.js",
                [ 'jquery' ],
            KDESKADDON_PLUGIN_VERSION, true );
		}

            wp_enqueue_script(
                $this->frontend_script_slug,
                KDESKADDON_SCRIPTS_ASSETS_DIR . 'frontend.js',
                [ 'jquery' ],
                KDESKADDON_PLUGIN_VERSION,
                true
            );

		// Load frontend variables used by the JS files.
		$this->get_the_localization_texts();
	}

	/**
	 * Load the localization texts.
	 */
	private function get_the_localization_texts() {

		// Localize scripts.
		// Frontend.
		// Access data: BptmFrontendData.version
		wp_localize_script(
            $this->frontend_script_slug,
            'KdeskAddonFrontendData',
            [
				'ajaxurl'  => esc_url( admin_url( 'admin-ajax.php' ) ),
				'title'    => KDESKADDON_PLUGIN_TITLE,
				'url'      => KDESKADDON_PRODUCT_URL,
				'verified' => KDESKADDON_PRODUCT_VERIFIED_STATUS,
            ]
		);
	}
}
