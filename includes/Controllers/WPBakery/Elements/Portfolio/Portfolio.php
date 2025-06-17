<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\Portfolio;

/**
 * Class Portfolio
 *
 * Handles Portfolio WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class Portfolio {
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

		$category_args = [
			'taxonomy'         => 'portfolio_category',
			'hide_empty'       => 1,
			'orderby'          => 'title',
			'order'            => 'ASC',
			'suppress_filters' => false,
		];

		$categories = get_categories( $category_args );

		$categories_list = [
			'Select' => '',
		];

		foreach ( $categories as $category ) :

			$categories_list[ $category->name ] = $category->slug;

    endforeach;

		wp_reset_postdata();

		// Into VC Block

		vc_map([
            'name'            => esc_html__( 'Portfolio', 'kdesk_vc' ),
            'description'     => esc_html__( 'Place portfolio items in page.', 'kdesk_vc' ),
            'base'            => 'kdesk_portfolio',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'icon'            => 'icon-kdesk-vc-addon',
            'params'          => [
				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Layout', 'kdesk_vc' ),
					'param_name'  => 'display_type',
					'value'       => [
						esc_html__( 'Simple Grid', 'kdesk_vc' ) => 'grid',
						esc_html__( 'Filterable Grid', 'kdesk_vc' ) => 'filterable',
						esc_html__( 'Carousel Grid', 'kdesk_vc' ) => 'carousel',
						esc_html__( 'Single Category', 'kdesk_vc' ) => 'single_category',
					],
					'group'       => 'General',
					'description' => '',
				],

				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Category', 'kdesk_vc' ),
					'param_name'  => 'portfolio_category',
					'value'       => $categories_list,
					'group'       => 'General',
					'description' => '',
					'dependency'  => [ 'element' => 'display_type', 'value' => [ 'single_category' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Column', 'kdesk_vc' ),
					'param_name'  => 'column',
					'value'       => kdesk_items_per_row( 4, 2 ),
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Post Order', 'kdesk_vc' ),
					'param_name'  => 'orderby',
					'value'       => kdesk_order_by(),
					'group'       => 'General',
					'description' => '',
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Post Order By', 'kdesk_vc' ),
					'param_name'  => 'order',
					'value'       => kdesk_order_type(),
					'group'       => 'General',
					'description' => '',
				],
				[
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => esc_html__( 'Post Limit', 'kdesk_vc' ),
					'param_name'  => 'limit',
					'value'       => '',
					'group'       => 'General',
					'description' => '',
					'dependency'  => [ 'element' => 'display_type', 'value' => [ 'grid', 'carousel', 'single_category' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'General',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'carousel' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide two arrow will display beside the carousel items.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'carousel' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'General',
					'description' => esc_html__( 'You can show/hide bottom will display below the carousel items.', 'kdesk_vc' ),
					'dependency'  => [ 'element' => 'layout', 'value' => [ 'carousel' ] ],
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Enable Box Shadow?', 'kdesk_vc' ),
					'param_name'  => 'box_shadow_status',
					'value'       => [
						esc_html__( 'No', 'kdesk_vc' )  => '0',
						esc_html__( 'Yes', 'kdesk_vc' ) => '1',
					],
					'group'       => 'Design',
					'description' => esc_html__( 'You can add box shadow animation in blog post box.', 'kdesk_vc' ),
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
		]);
	}
}
