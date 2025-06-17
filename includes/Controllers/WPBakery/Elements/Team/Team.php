<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Team;

/**
 * Class Team
 *
 * Handles Team WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Team {
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
			esc_html__( 'Select', 'kdesk_vc' ) => '',
			esc_html__( 'Layout 01 (Social Button Animation Top To Bottom)', 'kdesk_vc' ) => 'layout_1',
			esc_html__( 'Layout 02 (Social Button Animation Bottom To Top)', 'kdesk_vc' ) => 'layout_2',
		];

		// Register "container" content element. It will hold all your inner (child) content elements
		vc_map([
            'name'                    => esc_html__( 'Team', 'kdesk_vc' ),
            'description'             => esc_html__( 'Add Team Members In Page.', 'kdesk_vc' ),
            'base'                    => 'kdesk_team',
            'category'                => 'Kdesk Addon',
            'as_parent'               => [ 'only' => 'kdesk_team_item' ], // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            'content_element'         => true,
            'show_settings_on_create' => true,
            'controls'                => 'full',
            'is_container'            => false,
            'icon'                    => 'icon-kdesk-vc-addon',
            'params'                  => [
				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Team Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layout,
					'description' => esc_html__( 'Select team layout style.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Items Per Row', 'kdesk_vc' ),
					'param_name'  => 'carousel_items',
					'value'       => kdesk_items_per_row( 4, 1 ),
					'group'       => 'General',
					'description' => esc_html__( 'Select no of item you like to show each row.', 'kdesk_vc' ),
					'group'       => 'General',
				],
				[
					'type'       => 'checkbox',
					'class'      => '',
					'heading'    => esc_html__( 'Enable Carousel Mode', 'kdesk_vc' ),
					'param_name' => 'carousel',
					'value'      => [ esc_html__( 'Yes', 'kdesk_vc' ) => '1' ],
					'group'      => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation Arrow?', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide arrow beside the carousel items.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots ?', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide dots below the carousel items.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
					'group'       => 'General',
					'dependency'  => [ 'element' => 'carousel', 'value' => [ '1' ] ],
				],

				// DESIGN TAB.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Select Theme', 'kdesk_vc' ),
					'param_name'  => 'theme',
					'value'       => [
						esc_html__( 'Default', 'kdesk_vc' ) => 'default',
						esc_html__( 'Custom', 'kdesk_vc' ) => 'custom',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'Choose Custom to create your own theme.', 'kdesk_vc' ),
				],

				[
					'type'        => 'colorpicker',
					'class'       => '',
					'heading'     => esc_html__( 'Theme Color', 'kdesk_vc' ),
					'param_name'  => 'theme_color',
					'value'       => KDESK_PRIMARY_COLOR,
					'description' => esc_html__( 'This color will apply in background, text color and navigation button.', 'kdesk_vc' ),
					'group'       => 'Design',
					'dependency'  => [ 'element' => 'theme', 'value' => [ 'custom' ] ],
				],

				[
					'type'        => 'animation_style',
					'heading'     => esc_html__( 'Animation Style', 'kdesk_vc' ),
					'param_name'  => 'animation',
					'description' => esc_html__( 'Choose your animation style', 'kdesk_vc' ),
					'admin_label' => false,
					'weight'      => 0,
					'group'       => 'Animation',
				],

            ],
            'js_view'                 => 'VcColumnView',
		]);

		vc_map([
            'name'            => esc_html__( 'Team Item', 'kdesk_vc' ),
            'description'     => 'Add team item',
            'base'            => 'kdesk_team_item',
            'icon'            => 'icon-kdesk-vc-addon',
            'content_element' => true,
            'as_child'        => [ 'only' => 'kdesk_team' ], // Use only|except attributes to limit parent (separate multiple values with comma)
            'params'          => [
				// add params same as with any other content element
				[
					'admin_label' => true,
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Member Name', 'kdesk_vc' ),
					'param_name'  => 'team_name',
					'description' => esc_html__( 'Add team member name.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Member Info', 'kdesk_vc' ),
					'param_name'  => 'team_info',
					'description' => esc_html__( 'Add team member designation. Example: CEO, ASOK VILLA', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'attach_image',
					'heading'     => esc_html__( 'Team Image', 'kdesk_vc' ),
					'param_name'  => 'team_image',
					'description' => esc_html__( 'Add team profile image.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'vc_link',
					'class'       => '',
					'heading'     => esc_html__( 'Custom Profile Link', 'kdesk_vc' ),
					'param_name'  => 'team_custom_link',
					'value'       => '',
					'description' => esc_html__( 'Add custom team profile link.', 'kdesk_vc' ),
					'group'       => 'General',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Disable Social Link?', 'kdesk_vc' ),
					'param_name'  => 'social_link_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => '0',
						esc_html__( 'Yes', 'kdesk_vc' ) => '1',
					],
					'group'       => 'Social Links',
					'description' => esc_html__( 'Hide social link button from team block.', 'kdesk_vc' ),
				],

				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Facebook', 'kdesk_vc' ),
					'param_name'  => 'team_facebook',
					'description' => esc_html__( 'Add team facebook profile link.', 'kdesk_vc' ),
					'group'       => 'Social Links',
					'dependency'  => [ 'element' => 'social_link_status', 'value' => [ '0' ] ],
				],
				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Twitter', 'kdesk_vc' ),
					'param_name'  => 'team_twitter',
					'description' => esc_html__( 'Add custom twitter profile link.', 'kdesk_vc' ),
					'group'       => 'Social Links',
					'dependency'  => [ 'element' => 'social_link_status', 'value' => [ '0' ] ],
				],
				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Instagram', 'kdesk_vc' ),
					'param_name'  => 'team_instagram',
					'description' => esc_html__( 'Add custom Instagram profile link.', 'kdesk_vc' ),
					'group'       => 'Social Links',
					'dependency'  => [ 'element' => 'social_link_status', 'value' => [ '0' ] ],
				],
				[
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Linkedin', 'kdesk_vc' ),
					'param_name'  => 'team_linkedin',
					'description' => esc_html__( 'Add custom team linkedin link.', 'kdesk_vc' ),
					'group'       => 'Social Links',
					'dependency'  => [ 'element' => 'social_link_status', 'value' => [ '0' ] ],
				],

            ],
		]);
	}
}
