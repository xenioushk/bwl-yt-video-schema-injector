<?php

namespace KDESKADDON\Controllers\WPBakery\Elements\CustomElements;

/**
 * Class CustomElements
 *
 * Handles CustomElements WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class CustomElements {
    /**
	 * Register methods.
	 */
    public function register() {
        $this->register_wpb_custom_elem();
    }

    /**
     * Get WPBakery element.
     */
	public function register_wpb_custom_elem() {

		$attributes = [
			'type'        => 'dropdown',
			'heading'     => 'Add Container Wrapper',
			'param_name'  => 'acw',
			'value'       => [ 'Enable' => '1', 'Disable' => '0' ],
			'description' => esc_html__( 'Disable it if you want to get full width row.', 'kdesk_vc' ),
		];

		vc_add_param( 'vc_row', $attributes ); // Note: 'vc_row' was used as a base for "ROW" element

		// Custom Classes.

		$common_class = 'section-content-block';

		$kdesk_custom_class = [
			esc_html__( 'Select', 'kdesk_vc' )             => '',
			esc_html__( 'Section Layout Class', 'kdesk_vc' ) => $common_class,
			esc_html__( 'Page Heading Class', 'kdesk_vc' ) => 'page-heading',
			esc_html__( 'KB Category Layout Class', 'kdesk_vc' ) => $common_class . ' section-kb-categories',
			esc_html__( 'Counter Layout Class', 'kdesk_vc' ) => $common_class . ' section-counter',
			esc_html__( 'CTA  Layout Class', 'kdesk_vc' )  => 'section-cta',
			esc_html__( 'Highlights Layout Class', 'kdesk_vc' ) => $common_class . ' section-highlights',
			esc_html__( 'Logo Layout Class', 'kdesk_vc' )  => $common_class . ' section-client-logo',
			esc_html__( 'Testimonial Layout Class', 'kdesk_vc' ) => $common_class . ' section-client-testimonial',
			esc_html__( 'Team Layout Class', 'kdesk_vc' )  => $common_class . ' section-our-team',
			esc_html__( 'Newsletter Layout Class', 'kdesk_vc' ) => 'newsletter-area-bg',
			esc_html__( 'Ask Question Layout#1 With Image', 'kdesk_vc' ) => 'ask-question-section',
			esc_html__( 'Ask Question Layout#2 Without Image', 'kdesk_vc' ) => $common_class . ' ask-question-section',
		];

		$custom_attributes = [
			'type'        => 'dropdown',
			'heading'     => 'Select Custom Class',
			'param_name'  => 'kdesk_custom_class',
			'value'       => $kdesk_custom_class,
			'description' => esc_html__( 'Select Custom Class For Row', 'kdesk_vc' ),
		];
		vc_add_param( 'vc_row', $custom_attributes ); // Note: 'vc_row' was used as a base for "ROW" element
    }
}
