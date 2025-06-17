<?php
namespace KDESKADDON\Controllers\Cpt;

/**
 * Class to Filter All Portfolio Category.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class TaxonomyFilters {

    /**
     * Register Taxonomy Filters
     */
    public function register() {
        add_action( 'admin_init', [ $this, 'initialize' ] );
    }

    /**
     * Initialize Taxonomy Filters
     */
    public function initialize() {
        add_action( 'restrict_manage_posts', [ $this, 'taxonomy_filters_dropdown' ] );
        add_filter( 'parse_query', [ $this, 'taxonomy_filters_query' ] );
    }

    /**
     * Generates and displays a dropdown menu for taxonomy filters.
     *
     * @return void
     */
    public function taxonomy_filters_dropdown() {
        global $typenow;
        $args       = [ 'public' => true, '_builtin' => false ];
        $post_types = get_post_types( $args );

        if ( $typenow === KDESK_CPT_PORTFOLIO ) {

            $filters = get_object_taxonomies( $typenow );
            foreach ( $filters as $tax_slug ) {
                $tax_obj = get_taxonomy( $tax_slug );

                if ( isset( $_GET[ $tax_obj->query_var ] ) ) {
                    $selected_value = sanitize_text_field( $_GET[ $tax_obj->query_var ] ); // phpcs:ignore
                } else {
                    $selected_value = '';
                }

                wp_dropdown_categories([
                    'show_option_none' => esc_html__( 'All', 'kdesk_vc' ) . ' ' . $tax_obj->label,
                    'taxonomy'         => $tax_slug,
                    'name'             => $tax_obj->name,
                    'selected'         => $selected_value,
                    'hierarchical'     => $tax_obj->hierarchical,
                    'show_count'       => true,
                    'hide_empty'       => false,
                ]);
            }
        }
    }

    /**
     * Modifies the query to filter by taxonomy.
     *
     * @param WP_Query $query The WordPress query object.
     *
     * @return void
     */
    public function taxonomy_filters_query( $query ) {
        global $pagenow;
        global $typenow;
        if ( $pagenow == 'edit.php' && $typenow == KDESK_CPT_PORTFOLIO ) {
            $filters = get_object_taxonomies( $typenow );
            foreach ( $filters as $tax_slug ) {
                $var = &$query->query_vars[ $tax_slug ];
                if ( isset( $var ) ) {
                    $term = get_term_by( 'id', $var, $tax_slug );
                    if ( isset( $term->slug ) ) {
                        $var = $term->slug;
                    } else {
                        $var = '';
                    }
                }
            }
        }
    }
}
