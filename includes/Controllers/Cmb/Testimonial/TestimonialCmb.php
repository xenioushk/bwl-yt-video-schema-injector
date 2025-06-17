<?php
namespace KDESKADDON\Controllers\Cmb\Testimonial;

use WP_Query;
use KDESKADDON\Libs\Cmb\KdeskMetaBox;

/**
 * Class for Testimonial CMB.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class TestimonialCmb {

	public $prefix          = 'kdesk_';
	public $register_fields = [];
	public $post_types      = [];
	public $post_type;

	/**
	 * Register CMB Fields.
	 */
	public function register() {
		$this->initalize();
		add_action( 'admin_init', [ $this, 'init_meta_boxes' ] );
		add_action( 'save_post_' . KDESK_CPT_TESTIMONIAL, [ $this, 'save_data' ] );
	}

	/**
	 * Initalize CMB Fields.
	 */
	public function initalize() {
		$this->register_post_types();
	}

	/**
	 * Register post types.
	 */
	public function register_post_types() {
		$this->post_types = [ KDESK_CPT_TESTIMONIAL ];
		return $this->post_types;
	}

	/**
	 * Initialize meta boxes.
	 */
	public function init_meta_boxes() {
		foreach ( $this->post_types as $post_type ) {
			$this->post_type = $post_type;
			$this->register_testimonial_fields();
			$this->get_the_meta_box_layout();
		}
	}

	/**
	 * Register Testimonial Fields.
	 */
	public function register_testimonial_fields() {

		$kdesk_intro_fields = [

			'meta_box_id'      => 'cmb_kdesk_testimonial_intro',
			'meta_box_heading' => 'Testimonial Info',
			'post_type'        => $this->post_type,
			'context'          => 'normal',
			'priority'         => 'high',
			'fields'           => [
				$this->prefix . 'portfolio_id' => [
					'title'   => esc_html__( 'Select Portfolio', 'kdesk_vc' ),
					'id'      => $this->prefix . 'portfolio_id',
					'name'    => $this->prefix . 'portfolio_id',
					'type'    => 'select',
					'options' => $this->get_portfolio_options(),
				],
				$this->prefix . 'review_user' => [
					'title' => esc_html__( 'Review User', 'kdesk_vc' ),
					'id'    => $this->prefix . 'review_user',
					'name'  => $this->prefix . 'review_user',
					'type'  => 'text',
				],
				$this->prefix . 'review_user_designation' => [
					'title' => esc_html__( 'User Designation', 'kdesk_vc' ),
					'id'    => $this->prefix . 'review_user_designation',
					'name'  => $this->prefix . 'review_user_designation',
					'type'  => 'text',
				],
				$this->prefix . 'review_link' => [
					'title' => esc_html__( 'Review link', 'kdesk_vc' ),
					'id'    => $this->prefix . 'review_link',
					'name'  => $this->prefix . 'review_link',
					'type'  => 'text',
				],

			],
		];

		$this->register_fields[] = $kdesk_intro_fields;
	}

	/**
	 * Get portfolio options.
	 *
	 * @return array
	 */
	public function get_portfolio_options() {

		$portfolio_options = [
			'' => esc_html__( 'Select Portfolio', 'kdesk_vc' ),
		];
		$portfolio_args    = [
			'post_type'      => KDESK_CPT_PORTFOLIO,
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		];

		$portfolio_query = new WP_Query( $portfolio_args );

		if ( $portfolio_query->have_posts() ) {
			while ( $portfolio_query->have_posts() ) {
				$portfolio_query->the_post();
				$portfolio_options[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
		}

		return $portfolio_options;
	}

	/**
     * Get the meta box layout.
     */
	public function get_the_meta_box_layout() {
		foreach ( $this->register_fields as $field ) {
			new KdeskMetaBox( $field );
		}
	}

	/**
	 * Save CMB data.
	 *
	 * @param int $post_id The post ID.
	 */
	public function save_data( $post_id ) {

		// Stop the script when doing autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Stop the script if the user does not have edit permissions
		if ( ! current_user_can( 'edit_post', get_the_ID() ) ) {
			return;
		}

		if ( ! empty( $this->register_fields ) ) {

			foreach ( $this->register_fields as $blocks ) {

				$block = $blocks['fields'] ?? [];

				if ( ! empty( $block ) ) {

					foreach ( $block as $field ) {
						if ( isset( $_POST[ $field['name'] ] ) ) {
							update_post_meta( $post_id, $field['name'], wp_filter_post_kses( $_POST[ $field['name'] ] ) );
						}
					}
				}
			}
		}
	}
}
