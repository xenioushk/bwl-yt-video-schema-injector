<?php
namespace KDESKADDON\Controllers\WPBakery\Elements\BlogPosts;

/**
 * Class BlogPosts
 *
 * Handles BlogPosts WPBakery page builder element.
 *
 * @package KDESKADDON
 */
class BlogPosts {
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
			'taxonomy'         => 'category',
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

		$post_columns = [
			'Select'    => '',
			'1 Column'  => '1',
			'2 Columns' => '2',
			'3 Columns' => '3',
			'4 Columns' => '4',
		];

		$post_ordering = [
			'Select' => '',
			'Title'  => 'title',
			'ID'     => 'ID',
			'Date'   => 'date',
			'Random' => 'rand',
		];

		$post_ordering_type = [
			'Select'     => '',
			'Ascending'  => 'ASC',
			'Descending' => 'DESC',
		];

		$layouts = [
			'Layout 01'            => 'layout_1',
			'Layout 02 (Carousel)' => 'layout_2',
		];

		// Into VC Block

		vc_map([
            'name'            => esc_html__( 'Blog Posts', 'kdesk_vc' ),
            'description'     => esc_html__( 'Place Blog Posts In Page.', 'kdesk_vc' ),
            'base'            => 'kdesk_blog_post',
            'category'        => 'Kdesk Addon',
            'content_element' => true,
            'icon'            => 'icon-kdesk-vc-addon',
            'params'          => [
				[
					'admin_label' => true,
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Layout', 'kdesk_vc' ),
					'param_name'  => 'layout',
					'value'       => $layouts,
					'group'       => 'General',

				],
				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Category', 'kdesk_vc' ),
					'param_name' => 'category',
					'value'      => $categories_list,
					'group'      => 'General',

				],
				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Post Order', 'kdesk_vc' ),
					'param_name' => 'orderby',
					'value'      => $post_ordering,
					'group'      => 'General',

				],
				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Post Order By', 'kdesk_vc' ),
					'param_name' => 'order',
					'value'      => $post_ordering_type,
					'group'      => 'General',

				],
				[
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => esc_html__( 'Column', 'kdesk_vc' ),
					'param_name' => 'column',
					'value'      => $post_columns,
					'group'      => 'General',

				],
				[
					'type'       => 'textfield',
					'class'      => '',
					'heading'    => esc_html__( 'Description Length', 'kdesk_vc' ),
					'param_name' => 'desc_length',
					'value'      => '',
					'group'      => 'General',

				],
				[
					'type'       => 'textfield',
					'class'      => '',
					'heading'    => esc_html__( 'Post Limit', 'kdesk_vc' ),
					'param_name' => 'limit',
					'value'      => '',
					'group'      => 'General',

				],

				// Navigation Settings.

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Navigation', 'kdesk_vc' ),
					'param_name'  => 'carousel_nav',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Carousel Settings',
					'description' => esc_html__( 'You can show/hide two arrow will display beside the carousel items.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Hide Carousel Dots', 'kdesk_vc' ),
					'param_name'  => 'carousel_dots',
					'value'       => kdesk_boolean_term(),
					'group'       => 'Carousel Settings',
					'description' => esc_html__( 'You can show/hide bottom will display below the carousel items.', 'kdesk_vc' ),
				],

				[
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => esc_html__( 'Auto Play Time Out', 'kdesk_vc' ),
					'param_name'  => 'carousel_autoplaytimeout',
					'value'       => kdesk_carousel_timeout(),
					'group'       => 'Carousel Settings',
					'description' => esc_html__( 'Select scroll speed.', 'kdesk_vc' ),
				],

				// DESIGN TAB.

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
					'description' => esc_html__( 'This color will apply in carousel navigation button.', 'kdesk_vc' ),
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
		]);
	}
}
