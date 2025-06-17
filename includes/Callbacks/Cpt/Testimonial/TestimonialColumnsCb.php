<?php
namespace KDESKADDON\Callbacks\Cpt\Testimonial;

/**
 * Class for registering the testimonial custom columns callabck.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class TestimonialColumnsCb {

	/**
     * Add custom columns to the post type.
     *
     * @param array $columns The columns.
     *
     * @return array
     */
    public function columns_header( $columns ) {

        $new_columns = [
            'kdesk_portfolio_id' => esc_html__( 'Portfolio', 'kdesk_vc' ),
        ];

        return array_merge( $columns, $new_columns );
    }

		/**
         * Add content to the custom columns.
         *
         * @param string $column The column.
         */
    public function columns_content( $column ) {

        global $post;

		$prefix = 'kdesk_';

        switch ( $column ) {

			case "{$prefix}portfolio_id":
				$portfolio_id = get_post_meta( $post->ID,  $prefix . 'portfolio_id', true ) ?? 0;
                get_post( $portfolio_id );
                $portfolio_title = get_the_title( $portfolio_id );
                echo $portfolio_title; //phpcs:ignore
				break;

        }
    }
}
