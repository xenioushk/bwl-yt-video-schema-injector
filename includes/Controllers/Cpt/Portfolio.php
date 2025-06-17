<?php
namespace KDESKADDON\Controllers\Cpt;

use Xenioushk\BwlPluginApi\Api\Cpt\CptApi;

/**
 * Class for Portfolio custom post type.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class Portfolio {

	/**
	 *  Instance of the CPT API.
	 *
	 * @var object $cpt_api
	 */
	public $cpt_api;

	/**
	 * CPT settings.
	 *
	 * @var array
	 */
	public $cpt_settings = [];

	/**
	 * Taxonomy settings.
	 *
	 * @var array
	 */
	public $tax_settings = [];

	/**
	 * Taxonomy labels.
	 *
	 * @var array
	 */
	public $tax_labels = [];

	/**
	 * Plugin options.
	 *
	 * @var array
	 */

	public $options = [];

	/**
	 * Register custom post type.
	 */
	public function register() {

		$this->cpt_api = new CptApi();
		$this->set_cpt();
		$this->set_taxonomy();

		$this->cpt_api
		->add_cpt( $this->cpt_settings )
		->with_taxonomy( $this->tax_settings )
		->register();

		$this->set_image_sizes();
		$this->flush_rewrite_rules();

	}

	/**
	 * Set CPT settings.
	 * return void
	 */
	private function set_cpt() {

		$labels = [
			'name'               => esc_html__( 'All Portfolio', 'kdesk_vc' ),
			'singular_name'      => esc_html__( 'Portfolio', 'kdesk_vc' ),
			'add_new'            => esc_html__( 'Add New Portfolio', 'kdesk_vc' ),
			'add_new_item'       => esc_html__( 'Add New Portfolio', 'kdesk_vc' ),
			'edit_item'          => esc_html__( 'Edit Portfolio', 'kdesk_vc' ),
			'new_item'           => esc_html__( 'New Portfolio', 'kdesk_vc' ),
			'all_items'          => esc_html__( 'All Portfolio', 'kdesk_vc' ),
			'view_item'          => esc_html__( 'View Portfolio', 'kdesk_vc' ),
			'search_items'       => esc_html__( 'Search Portfolio', 'kdesk_vc' ),
			'not_found'          => esc_html__( 'No Portfolio found', 'kdesk_vc' ),
			'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash', 'kdesk_vc' ),
			'parent_item_colon'  => '',
			'menu_name'          => KDESK_CPT_PORTFOLIO_TITLE,
		];

		$this->cpt_settings = [
			[
				'labels'             => $labels,
				'query_var'          => KDESK_CPT_PORTFOLIO_SLUG,
				'post_type'          => KDESK_CPT_PORTFOLIO,
				'menu_name'          => KDESK_CPT_PORTFOLIO_TITLE,
				'singular_name'      => KDESK_CPT_PORTFOLIO_TITLE,
				'slug'               => KDESK_CPT_PORTFOLIO_SLUG,
				'show_in_rest'       => true,
				'supports'           => $this->get_cpt_supports(),
				'menu_icon'          => 'dashicons-list-view',
				'has_archive'        => false,
				'hierarchical'       => true,
				'publicly_queryable' => true,
				'rewrite'            => [
					'slug'       => KDESK_CPT_PORTFOLIO_SLUG,
					'with_front' => true,
				],
			],
		];
	}

	/**
	 * Set taxonomy labels.
	 *
	 * @return void
	 */
	private function set_tax_labels() {

		$this->tax_labels = [

			KDESK_CPT_PORTFOLIO_TAX_CAT => [
				'name'                         => esc_html__( 'Portfolio Category', 'kdesk_vc' ),
				'singular_name'                => esc_html__( 'Category', 'bwl-adv-faq' ),
				'edit_item'                    => esc_html__( 'Edit Category', 'bwl-adv-faq' ),
				'update_item'                  => esc_html__( 'Update category', 'bwl-adv-faq' ),
				'add_new_item'                 => esc_html__( 'Add Category', 'bwl-adv-faq' ),
				'new_item_name'                => esc_html__( 'Add New category', 'bwl-adv-faq' ),
				'all_items'                    => esc_html__( 'All categories', 'bwl-adv-faq' ),
				'search_items'                 => esc_html__( 'Search categories', 'bwl-adv-faq' ),
				'popular_items'                => esc_html__( 'Popular categories', 'bwl-adv-faq' ),
				'separate_items_with_comments' => esc_html__( 'Separate categories with commas', 'bwl-adv-faq' ),
				'add_or_remove_items'          => esc_html__( 'Add or remove category', 'bwl-adv-faq' ),
				'choose_from_most_used'        => esc_html__( 'Choose from most used categories', 'bwl-adv-faq' ),
			],
		];
	}

	/**
	 * Set taxonomy settings.
     *
	 * @return void
	 */
	private function set_taxonomy() {

		$this->set_tax_labels();

		$this->tax_settings = [
			[
				'tax_title'       => KDESK_CPT_PORTFOLIO_TITLE . ' Category',
				'tax_slug'        => KDESK_CPT_PORTFOLIO_TAX_CAT_SLUG,
				'custom_tax_slug' => KDESK_CPT_PORTFOLIO_TAX_CAT_SLUG,
				'labels'          => $this->tax_labels[ KDESK_CPT_PORTFOLIO_TAX_CAT ],
			],
		];
	}

	/**
	 * Get CPT supports.
	 *
	 * @return array
	 */
	private function get_cpt_supports() {

		$supports = [ 'title', 'editor', 'thumbnail', 'author', 'thumbnail' ];
		return $supports;
	}

	/**
	 * Set image sizes.
	 *
	 * @return void
	 */
	public function set_image_sizes() {
		add_image_size( 'kdesk_portfolio_thumb', 80, 80 );
	}

	/**
	 * Flush rewrite rules.
	 */
	private function flush_rewrite_rules() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$flush_status = intval( get_option( 'kdesk_cpt_portfolio_flush_status' ) );

		if ( $flush_status ) {

				flush_rewrite_rules();
				update_option( 'kdesk_cpt_portfolio_flush_status', 1 );
		}
	}
}
