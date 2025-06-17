<?php
namespace KDESKADDON\Controllers\Cmb\Portfolio;

use KDESKADDON\Libs\Cmb\KdeskMetaBox;

/**
 * Class for Portfolio CMB.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PortfolioCmb {

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
		add_action( 'save_post_' . KDESK_CPT_PORTFOLIO, [ $this, 'save_data' ] );
	}

	/**
	 * Initalize CMB Fields.
	 */
	public function initalize() {
		$this->register_post_types();
	}

	public function register_post_types() {
		$this->post_types = [ KDESK_CPT_PORTFOLIO ];
		return $this->post_types;
	}

	// Register Custom Meta Box

	public function init_meta_boxes() {

		foreach ( $this->post_types as $post_type ) {

			$this->post_type = $post_type;

			$this->register_version_fields();
			$this->register_links_fields();
			$this->register_price_fields();
			$this->register_faq_fields();

			$this->get_the_meta_box_layout();
		}
	}

	/**
	 * Portfolio Release & Version
	 */
	public function register_version_fields() {

		$kdesk_version_fields = [

			'meta_box_id'      => 'cmb_kdesk_portfolio_version',
			'meta_box_heading' => 'Portfolio Meta Info',
			'post_type'        => $this->post_type,
			'context'          => 'side',
			'priority'         => 'low',
			'fields'           => [

				$this->prefix . 'portfolio_ver' => [
					'title' => esc_html__( 'Version', 'kdesk_vc' ),
					'id'    => $this->prefix . 'portfolio_ver',
					'name'  => $this->prefix . 'portfolio_ver',
				],
				$this->prefix . 'portfolio_update' => [
					'title' => esc_html__( 'Last Update', 'kdesk_vc' ),
					'id'    => $this->prefix . 'portfolio_update',
					'name'  => $this->prefix . 'portfolio_update',
					'type'  => 'text',
				],
				$this->prefix . 'portfolio_release' => [
					'title' => esc_html__( 'Release Date', 'kdesk_vc' ),
					'id'    => $this->prefix . 'portfolio_release',
					'name'  => $this->prefix . 'portfolio_release',
					'type'  => 'text',
				],
				$this->prefix . 'portfolio_review' => [
					'title' => esc_html__( 'Review Point', 'kdesk_vc' ),
					'id'    => $this->prefix . 'portfolio_review',
					'name'  => $this->prefix . 'portfolio_review',
					'type'  => 'text',
				],
				$this->prefix . 'portfolio_review_url' => [
					'title' => esc_html__( 'Review URL', 'kdesk_vc' ),
					'id'    => $this->prefix . 'portfolio_review_url',
					'name'  => $this->prefix . 'portfolio_review_url',
					'type'  => 'text',
				],
			],
		];

		$this->register_fields[] = $kdesk_version_fields;
	}

	/**
	 * Register preview and download link
	 */
	public function register_links_fields() {

		$kdesk_intro_fields = [

			'meta_box_id'      => 'cmb_kdesk_portfolio_intro',
			'meta_box_heading' => 'Portfolio Links',
			'post_type'        => $this->post_type,
			'context'          => 'normal',
			'priority'         => 'high',
			'fields'           => [

				$this->prefix . 'live_link' => [
					'title' => esc_html__( 'Preview link', 'kdesk_vc' ),
					'id'    => $this->prefix . 'live_link',
					'name'  => $this->prefix . 'live_link',
					'type'  => 'text',
				],

				$this->prefix . 'doc_link' => [
					'title' => esc_html__( 'Documentation link', 'kdesk_vc' ),
					'id'    => $this->prefix . 'doc_link',
					'name'  => $this->prefix . 'doc_link',
					'type'  => 'text',
				],

				$this->prefix . 'purchase_link' => [
					'title' => esc_html__( 'Purchase link', 'kdesk_vc' ),
					'id'    => $this->prefix . 'purchase_link',
					'name'  => $this->prefix . 'purchase_link',
					'type'  => 'text',
				],

			],
		];

		$this->register_fields[] = $kdesk_intro_fields;
	}

	/**
	 * Register Price Fields.
	 */
	public function register_price_fields() {
		$kdesk_price_fields = [
			'meta_box_id'      => 'cmb_kdesk_portfolio_price',
			'meta_box_heading' => 'Portfolio Price & Discount',
			'post_type'        => $this->post_type,
			'context'          => 'side',
			'priority'         => 'low',
			'fields'           => [

				$this->prefix . 'portfolio_price' => [
					'title' => esc_html__( 'Price', 'kdesk_vc' ),
					'id'    => $this->prefix . 'portfolio_price',
					'name'  => $this->prefix . 'portfolio_price',
					'type'  => 'text',
				],
				$this->prefix . 'discount_status' => [
					'title'   => esc_html__( 'Enable Discount?', 'kdesk_vc' ),
					'id'      => $this->prefix . 'discount_status',
					'name'    => $this->prefix . 'discount_status',
					'type'    => 'select',
					'options' => [
						'0' => 'No',
						'1' => 'Yes',
					],
				],

				$this->prefix . 'discount_percentage' => [
					'title' => esc_html__( 'Discount Price', 'kdesk_vc' ),
					'id'    => $this->prefix . 'discount_percentage',
					'name'  => $this->prefix . 'discount_percentage',
					'type'  => 'text',
				],
			],
		];

		$this->register_fields[] = $kdesk_price_fields;
	}

	/**
	 * Register Faq Fields.
	 */
	public function register_faq_fields() {
		$kdesk_about_fields = [
			'meta_box_id'      => 'cmb_kdesk_portfolio_faq',
			'meta_box_heading' => 'Portfolio FAQ',
			'post_type'        => $this->post_type,
			'context'          => 'normal',
			'priority'         => 'low',
			'fields'           => [

				$this->prefix . 'faq_title' => [
					'title' => esc_html__( 'FAQ title', 'kdesk_vc' ),
					'id'    => $this->prefix . 'faq_title',
					'name'  => $this->prefix . 'faq_title',
					'type'  => 'text',
				],

				$this->prefix . 'faq_shortcode' => [
					'title'         => esc_html__( 'FAQ Shortcode', 'kdesk_vc' ),
					'id'            => $this->prefix . 'faq_shortcode',
					'name'          => $this->prefix . 'faq_shortcode',
					'type'          => 'wpeditor',
					'height'        => '100',
					'value'         => '',
					'default_value' => '',
					'class'         => 'wide-fat',
					'placeholder'   => '',
					'desc'          => '',
				],
			],
		];
		$this->register_fields[] = $kdesk_about_fields;
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
						update_post_meta( $post_id, $field['name'], wp_filter_post_kses( $_POST[ $field['name'] ] ) );
					}
				}
			}
		}
	}
}
