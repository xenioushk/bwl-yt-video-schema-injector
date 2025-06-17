<?php
namespace KDESKADDON\Base;

/**
 * Class for registering the WPB editor Admin scripts and styles.
 *
 * @package KDESKADDON
 */
class WPBAdminEditorEnqueue {

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		if ( function_exists( 'vc_add_shortcode_param' ) ) {
			vc_add_shortcode_param(
				'bwl_cont_ext',
				[ $this, 'cb_bwl_cont_ext' ],
				KDESKADDON_SCRIPTS_ASSETS_DIR . 'admin.js'
			);
		}
	}

	/**
     * Admin End WP Bakery Page Builder Style & Scripts.
     *
     * @param array  $settings Settings.
     * @param string $value Value.
     */
    public function cb_bwl_cont_ext( $settings, $value ) {
			return '<div class="my_param_block">'
					. '<input name="' . esc_attr( $settings['param_name'] ) . '" class="bwl_cont_ext wpb_vc_param_value wpb-textinput ' .
					esc_attr( $settings['param_name'] ) . ' ' .
					esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />'
					. '</div>'; // New button element
	}
}
