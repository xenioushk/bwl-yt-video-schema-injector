<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Video;

/**
 * Class Video
 *
 * Handles Video WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Video {
    /**
	 * Register methods.
	 */
    public function register() {
        add_action( 'vc_before_init', [ $this, 'get_wpb_elem' ] );
    }

    /**
     * Get WPBakery element.
     */
	public function get_wpb_elem() {

		$layout = [
			esc_html__( 'Layout 01 (Video Link Option) ', 'kdesk_vc' ) => 'layout_1',
		];

		vc_map([
            'name'            => esc_html__( 'Video Box', 'kdesk_vc' ),
            'description'     => esc_html__( 'Display Video Box In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_vc_video',
            'icon'            => 'icon-kdesk-vc-addon',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'params'          => [

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'description' => esc_html__( 'Select Layout of Call To Action Box', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'               => 'attach_image',
					'heading'            => esc_html__( 'Video Background Image', 'kdesk_vc' ),
					'param_name'         => 'video_bg',
					'description'        => '',
					'param_holder_class' => 'vc_colored-dropdown',
					'group'              => 'General',
				],

				[
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Video Icon', 'kdesk_vc' ),
					'param_name'  => 'icon',
					'value'       => 'fa-play',
					'settings'    => [
						'emptyIcon'    => false, // default true, display an "EMPTY" icon?
						'type'         => 'fontawesome',
						'iconsPerPage' => 50, // default 100, how many icons per/page to display
					],
					'group'       => 'General',
					'description' => esc_html__( 'Select icon from library.', 'kdesk_vc' ),
				],

				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Video Link', 'kdesk_vc' ),
					'param_name'  => 'video_link',
					'value'       => '',
					'description' => esc_html__( 'Video CTA Link Example: https://www.youtube.com/watch?v=nrJtHemSPW4', 'kdesk_vc' ),
					'group'       => 'General',
				],

            ],
		]);
	}
}
