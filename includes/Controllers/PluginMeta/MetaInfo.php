<?php
namespace KDESKADDON\Controllers\PluginMeta;

/**
 * Class displays options panel, addons, documentation links below the plugin information.
 *
 * @since: 1.1.1
 * @package KDESKADDON
 */
class MetaInfo {

	/**
	 * Register meta links.
	 */
	public function register() {
		add_filter( 'plugin_row_meta', [ $this, 'get_meta_links' ], null, 2 );
	}

	/**
	 * Filters the plugin action links.
	 *
	 * @param array  $links An array of plugin action links.
	 * @param string $file  The path to the plugin file.
	 *
	 * @return array Filtered array of plugin action links.
	 */
	public function get_meta_links( $links, $file ) {

		if ( strpos( $file, KDESKADDON_ROOT_FILE ) !== false && is_plugin_active( $file ) ) {

			// nt = 1 // new tab.

			$additional_links = [

				[
					'title' => '📘 ' . esc_html__( 'Documentation', 'bwl-adv-faq' ),
					'url'   => KDESKADDON_PRODUCT_DOC,
					'nt'    => 1,
				],
				[
					'title' => '🛟 ' . esc_html__( 'Support', 'bwl-adv-faq' ),
					'url'   => KDESKADDON_PRODUCT_SUPPORT,
					'nt'    => 1,
				],

			];
			if ( KDESKADDON_PRODUCT_VERIFIED_STATUS != 1 ) {
				$additional_links[] = [
					'title' => '<span class="dashicons dashicons-privacy"></span>' . esc_html__( 'Active License', 'bwl-adv-faq' ),
					'url'   => get_admin_url() . 'themes.php?page=kdesk-license-page',
					'class' => 'bwl_activation_meta_link',
				];
			}

			$new_links = [];

			foreach ( $additional_links as $link ) {

				$new_tab = isset( $link['nt'] ) ? 'target="_blank"' : '';
				$class   = isset( $link['class'] ) ? 'class="' . $link['class'] . '"' : '';

				$url   = esc_url( $link['url'] );
				$title = $link['title'];

				$new_links[] = "<a href='{$url}' {$new_tab} {$class}>{$title}</a>";
			}

			$links = array_merge( $links, $new_links );
		}

		return $links;
	}
}
