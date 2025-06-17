<?php
namespace BwlFaqManager\Controllers\Themes;

use BwlFaqManager\Helpers\PluginConstants;
use BwlFaqManager\Helpers\Common;

/**
 * Class FaqCustomThemes
 *
 * @package BwlFaqManager
 */
class FaqCustomThemes {

	/**
	 * Register the custom themes.
	 */
	public function register() {
		add_action( 'wp_head', [ $this, 'set_custom_themes' ] );
	}

	/**
	 * Set the custom themes.
	 */
	public function set_custom_themes() {

		$options = PluginConstants::$plugin_options;

		$theme_id = 'default';

		$bwl_advanced_faq_collapsible_accordion_status = 1; // Introduced in version 1.4.4

		$enable_rtl_support = 0; // Introduced in version 1.5.3

		$enable_custom_theme = $options['enable_custom_theme'] ?? 0;

		if ( is_rtl() ) {

			$enable_rtl_support = 1;
		}

		if ( isset( $options['bwl_advanced_faq_theme'] ) ) {

			$theme_id = $options['bwl_advanced_faq_theme'];
		}

		if ( isset( $options['bwl_advanced_faq_collapsible_accordion_status'] ) && $options['bwl_advanced_faq_collapsible_accordion_status'] != 0 ) {

			$bwl_advanced_faq_collapsible_accordion_status = $options['bwl_advanced_faq_collapsible_accordion_status'];
		}

		if ( $theme_id == 'light' && $enable_custom_theme == 0 ) {

			// LIGHT COLOR SCHEME.
			$gradient_first_color    = '#F7F7F7';
			$gradient_second_color   = '#FAFAFA';
			$active_background_color = '#F7F7F7';
			$label_text_color        = '#555555';
			$hover_background        = '#FFFFFF';
			$label_hover_text_color  = '#3a3a3a';
			$tab_top_border          = '#2C2C2C';
		} elseif ( $theme_id == 'red' && $enable_custom_theme == 0 ) {

			// RED COLOR SCHEME.

			$gradient_first_color    = '#FF3019';
			$gradient_second_color   = '#CF0404';
			$active_background_color = '#CF0404';
			$label_text_color        = '#FFFFFF';
			$hover_background        = '#FF3019';
			$label_hover_text_color  = '#FFFFFF';
			$tab_top_border          = $gradient_first_color;
		} elseif ( $theme_id == 'blue' && $enable_custom_theme == 0 ) {

			// BLUE COLOR SCHEME.

			$gradient_first_color    = '#49C0F0';
			$gradient_second_color   = '#2CAFE3';
			$active_background_color = '#2CAFE3';
			$label_text_color        = '#FFFFFF';
			$hover_background        = '#49C0F0';
			$label_hover_text_color  = '#FFFFFF';
			$tab_top_border          = $gradient_first_color;
		} elseif ( $theme_id == 'green' && $enable_custom_theme == 0 ) {

			// GREEN COLOR SCHEME.

			$gradient_first_color    = '#0EB53D';
			$gradient_second_color   = '#299A0B';
			$active_background_color = '#299A0B';
			$label_text_color        = '#FFFFFF';
			$hover_background        = '#0EB53D';
			$label_hover_text_color  = '#FFFFFF';
			$tab_top_border          = $gradient_first_color;
		} elseif ( $theme_id == 'pink' && $enable_custom_theme == 0 ) {

			// GREEN COLOR SCHEME.

			$gradient_first_color    = '#FF5DB1';
			$gradient_second_color   = '#EF017C';
			$active_background_color = '#EF017C';
			$label_text_color        = '#FFFFFF';
			$hover_background        = '#FF5DB1';
			$label_hover_text_color  = '#FFFFFF';
			$tab_top_border          = $gradient_first_color;
		} elseif ( $theme_id == 'orange' && $enable_custom_theme == 0 ) {

			// GREEN COLOR SCHEME.

			$gradient_first_color    = '#FFA84C';
			$gradient_second_color   = '#FF7B0D';
			$active_background_color = '#FF7B0D';
			$label_text_color        = '#FFFFFF';
			$hover_background        = '#FFA84C';
			$label_hover_text_color  = '#FFFFFF';
			$tab_top_border          = $gradient_first_color;
		} elseif ( $enable_custom_theme == 1 ) {

			// CUSTOM COLOR SCHEME.

			$hover_background = '#FFA84C';

			$gradient_first_color = $options['gradient_first_color'] ?? '#FFA84C';

			$gradient_second_color = $options['gradient_second_color'] ?? '#FF7B0D';

			$label_text_color = $options['label_text_color'] ?? '#777777';

			$label_hover_text_color = $options['label_hover_text_color'] ?? '#777777';

			$active_background_color = $options['active_background_color'] ?? '#FF7B0D';

			$tab_top_border = $gradient_first_color;

			$hover_background = $gradient_first_color;

		} else {

			// DEFAULT COLOR SCHEME.

			$tab_top_border          = '#2C2C2C';
			$gradient_first_color    = '#FFFFFF';
			$gradient_second_color   = '#EAEAEA';
			$active_background_color = '#C6E1EC';
			$label_text_color        = '#777777';
			$hover_background        = '#FFFFFF';
			$label_hover_text_color  = '#777777';
		}

		if ( strtoupper( $gradient_first_color ) == '#FFFFFF' ) {

			$tab_top_border = '#2C2C2C';
		}

		// Font Settings (Version : 1.4.5)

		$label_font_size = '';

		if ( isset( $options['bwl_advanced_label_font_size'] ) && $options['bwl_advanced_label_font_size'] != '' ) {

			$label_font_size = 'font-size: ' . $options['bwl_advanced_label_font_size'] . 'px !important;';
		}

		$output = '';

		$output .= '.ac-container .baf_schema{color:blue;';
		$output .= $label_font_size;
		$output .= '}';

		$output .= '#baf_page_navigation .active_page{
                              background: ' . $gradient_first_color . ';
                              color: ' . $label_text_color . ' !important;
                      }';

		$output .= 'div.baf-ctrl-btn span.baf-expand-all, div.baf-ctrl-btn span.baf-collapsible-all{
                              background: ' . $gradient_first_color . ';
                              color: ' . $label_text_color . ';
                      }';

		$output .= 'div.baf-ctrl-btn span.baf-expand-all:hover, div.baf-ctrl-btn span.baf-collapsible-all:hover{
                              background: ' . $gradient_second_color . ';
                              color: ' . $label_text_color . ';
                      }';

		if ( isset( $options['bwl_advanced_content_font_size'] ) && $options['bwl_advanced_content_font_size'] != '' ) {

			// Change Font Settings: Introduced in Version: 1.4.5
			$output .= '.ac-container .bwl-faq-container article div,
                      .ac-container .bwl-faq-container article p {
                              font-size: ' . $options['bwl_advanced_content_font_size'] . 'px;
                     }';
		}

		// Change Font Settings: Introduced in Version: 1.4.5

		$output .= '.bwl-faq-wrapper ul.bwl-faq-tabs li.active{                            
                              border-color: ' . $tab_top_border . ';
                     }';

		// Add Custom CSS CODE : Introduced in Version: 1.5.3

		if ( isset( $options['bwl_advanced_faq_custom_css'] ) && $options['bwl_advanced_faq_custom_css'] != '' ) {

			$output .= esc_html( $options['bwl_advanced_faq_custom_css'] );
		}

		// Voting Icon.

		$baf_like_icon_color = '#228AFF';

		if ( isset( $options['baf_like_icon_color'] ) && ! empty( $options['baf_like_icon_color'] ) && $options['baf_like_icon_color'] != '#228AFF' ) {
			$baf_like_icon_color = $options['baf_like_icon_color'];
			$output             .= '.post-like-container a .post-like i{ color: ' . $baf_like_icon_color . '; }';
		}

		$baf_like_icon_hover_color = '#333333';

		if ( isset( $options['baf_like_icon_hover_color'] ) && ! empty( $options['baf_like_icon_hover_color'] ) && $options['baf_like_icon_hover_color'] != '#333333' ) {
			$baf_like_icon_hover_color = $options['baf_like_icon_hover_color'];
			$output                   .= '.post-like-container a:hover .post-like i, .post-like-container a .post-like i.liked{ color: ' . $baf_like_icon_hover_color . '; }';
		}

		// Voting Icon Class.

		$thumb_icon_class = ( isset( $options['baf_like_icon'] ) && $options['baf_like_icon'] != '' ) ? $options['baf_like_icon'] : 'fa-thumbs-up';
		$likeIconCode     = Common::get_the_fa_icon_code( $thumb_icon_class );

		$output .= '.post-like i::before,
                      .post-like i::after,
                      .post-like i.liked ::before {
                          content: "' . $likeIconCode . '";
                      }';
		$output .= 'i.faq-liked{
                          color: ' . $baf_like_icon_color . ';
                      }';

		// RTL STATUS.
		$baf_rtl_status = 0;

		if ( is_rtl() ) {

			$baf_rtl_status = 1;

			$output .= '.ac-container .bwl-faq-search-panel span.baf-btn-clear{
                      left: 5px;
                 }';
		} else {

			$output .= '.ac-container .bwl-faq-search-panel span.baf-btn-clear{
                      right: 11px;
                }';
		}

		// Output the CSS styles.
		printf(
			'<style type="text/css" id="baf-custom-themes">%s</style>',
			$output //phpcs:ignore
		);

		$color_scheme_output = 'var baf_rtl_status = ' . $baf_rtl_status . ",
                                                 first_color = '" . $gradient_first_color . "',   
                                                 checked_background = '" . $active_background_color . "',
                                                 hover_background = '" . $hover_background . "',
                                                 bwl_advanced_faq_collapsible_accordion_status = '" . $bwl_advanced_faq_collapsible_accordion_status . "',
                                                 text_nothing_found = '" . esc_html__( 'Nothing Found !', 'bwl-adv-faq' ) . "',
                                                 text_faqs = '" . esc_html__( 'FAQs', 'bwl-adv-faq' ) . "',
                                                 text_faq = '" . esc_html__( 'FAQ', 'bwl-adv-faq' ) . "',                                               
                                                 second_color = '" . $gradient_second_color . "'";

		echo '<script type="text/javascript" id="baf-inline-js">' . $color_scheme_output . '</script>';
	}
}
