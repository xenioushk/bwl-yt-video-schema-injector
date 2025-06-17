<?php
namespace KDESKADDON\Controllers\Cpt;

use KDESKADDON\Callbacks\Cpt\Portfolio\PortfolioColumnsCb;
use KDESKADDON\Callbacks\Cpt\Testimonial\TestimonialColumnsCb;

/**
 * Controller for Portfolio Custom Columns.
 *
 * @package KDESKADDON
 */
class CustomColumns {

	/**
     * Register the columns.
     */
    public function register() {
        add_action( 'admin_init', [ $this, 'initialize' ] );
    }

    /**
     * Initialize column actions.
     */
    public function initialize() {
        $this->register_portfolio_custom_columns();
        $this->register_testimonial_custom_columns();
    }

    /**
     * Register the portfolio custom columns.
     */
    public function register_portfolio_custom_columns() {
        $portfolio_columns_cb = new PortfolioColumnsCb();
        $cpt                  = KDESK_CPT_PORTFOLIO;
		add_filter( "manage_{$cpt}_posts_columns", [ $portfolio_columns_cb, 'columns_header' ] );
        add_action( "manage_{$cpt}_posts_custom_column", [ $portfolio_columns_cb, 'columns_content' ] );
    }

    /**
     * Register the testimonial custom columns.
     */
    public function register_testimonial_custom_columns() {
        $testimonial_columns_cb = new TestimonialColumnsCb();
        $cpt                    = KDESK_CPT_TESTIMONIAL;
		add_filter( "manage_{$cpt}_posts_columns", [ $testimonial_columns_cb, 'columns_header' ] );
        add_action( "manage_{$cpt}_posts_custom_column", [ $testimonial_columns_cb, 'columns_content' ] );
    }
}
