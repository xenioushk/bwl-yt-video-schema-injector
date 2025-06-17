<?php
namespace KDESKADDON\Controllers\Cpt;

use Xenioushk\BwlPluginApi\Api\Cpt\CptApi;

/**
 * Class for Testimonial custom post type.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class Testimonial {

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
	 * Register custom post type.
	 */
	public function register() {

		$this->cpt_api = new CptApi();
		$this->set_cpt();

		$this->cpt_api
		->add_cpt( $this->cpt_settings )
		->register();

		$this->flush_rewrite_rules();

	}

	/**
	 * Set CPT settings.
	 * return void
	 */
	private function set_cpt() {

		$labels = [
			'name'               => esc_html__( 'All Testimonial', 'kdesk_vc' ),
			'singular_name'      => esc_html__( 'Testimonial', 'kdesk_vc' ),
			'add_new'            => esc_html__( 'Add New Testimonial', 'kdesk_vc' ),
			'add_new_item'       => esc_html__( 'Add New Testimonial', 'kdesk_vc' ),
			'edit_item'          => esc_html__( 'Edit Testimonial', 'kdesk_vc' ),
			'new_item'           => esc_html__( 'New Testimonial', 'kdesk_vc' ),
			'all_items'          => esc_html__( 'All Testimonial', 'kdesk_vc' ),
			'view_item'          => esc_html__( 'View Testimonial', 'kdesk_vc' ),
			'search_items'       => esc_html__( 'Search Testimonial', 'kdesk_vc' ),
			'not_found'          => esc_html__( 'No Testimonial found', 'kdesk_vc' ),
			'not_found_in_trash' => esc_html__( 'No Testimonial found in Trash', 'kdesk_vc' ),
			'parent_item_colon'  => '',
			'menu_name'          => KDESK_CPT_TESTIMONIAL_TITLE,
		];

		$this->cpt_settings = [
			[
				'labels'             => $labels,
				'query_var'          => KDESK_CPT_TESTIMONIAL_SLUG,
				'post_type'          => KDESK_CPT_TESTIMONIAL,
				'menu_name'          => KDESK_CPT_TESTIMONIAL_TITLE,
				'singular_name'      => KDESK_CPT_TESTIMONIAL_TITLE,
				'slug'               => KDESK_CPT_TESTIMONIAL_SLUG,
				'show_in_rest'       => true,
				'supports'           => $this->get_cpt_supports(),
				'menu_icon'          => 'dashicons-format-quote',
				'has_archive'        => false,
				'hierarchical'       => true,
				'publicly_queryable' => true,
				'rewrite'            => [
					'slug'       => KDESK_CPT_TESTIMONIAL_SLUG,
					'with_front' => true,
				],
			],
		];
	}

	/**
	 * Get CPT supports.
	 *
	 * @return array
	 */
	private function get_cpt_supports() {

		$supports = [ 'title', 'editor' ];
		return $supports;
	}

	/**
	 * Flush rewrite rules.
	 */
	private function flush_rewrite_rules() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$flush_status = intval( get_option( 'kdesk_cpt_testimonial_flush_status' ) );

		if ( $flush_status ) {

				flush_rewrite_rules();
				update_option( 'kdesk_cpt_testimonial_flush_status', 1 );
		}
	}
}
