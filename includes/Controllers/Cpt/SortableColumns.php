<?php
namespace KDESKADDON\Controllers\Cpt;

/**
 * FAQ Manager Sortable Columns.
 *
 * @package KDESKADDON
 */
class SortableColumns {

	public $prefix = 'kdesk_';

	/**
     * Register the columns.
     */
    public function register() {
        add_action( 'admin_init', [ $this, 'initialize' ] );
    }

    /**
     * Initialize sortable column filter and action.
     */
    public function initialize() {
        add_filter( 'manage_edit-' . KDESK_CPT_PORTFOLIO . '_sortable_columns',  [ $this, 'sortable_columns' ] );
        add_action( 'pre_get_posts', [ $this, 'cb_sortable_columns' ] );
    }

	/**
	 * Register sortable columns.
	 *
	 * @param array $columns columns array.
	 * @return array
	 */
	public function sortable_columns( $columns ) {
        $new_columns = [
            'portfolio_price' => 'portfolio_price',
            'portfolio_ver'   => 'portfolio_ver',
        ];

        return array_merge( $columns, $new_columns );
	}

	/**
	 * Sortable columns callback.
     *
	 * @param object $query query object.
	 * @return object
	 */
	public function cb_sortable_columns( $query ) {

		if ( is_admin() && $query->is_main_query() ) {

            $post_type = $query->get( 'post_type' ) ?? '';
            $orderby   = $query->get( 'orderby' ) ?? '';

			if ( empty( $post_type ) || empty( $orderby ) ) {
				return $query;
			}

			switch ( $orderby ) {

				case 'portfolio_price':
					$query->set( 'meta_key', $this->prefix . 'portfolio_price' );
					$query->set( 'orderby', 'meta_value_num' );
					break;

				case 'portfolio_ver':
					$query->set( 'meta_key', $this->prefix . 'portfolio_ver' );
					$query->set( 'orderby', 'meta_value_num' );
					break;

				default:
                    break;
			}

            return $query;
		}
	}
}
