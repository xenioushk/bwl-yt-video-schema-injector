<?php
namespace KDESKADDON\Callbacks\Cpt\Portfolio;

use WP_Query;

/**
 * Class for registering the portfolio custom columns callabck.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class PortfolioColumnsCb {

	/**
     * Add custom columns to the post type.
     *
     * @param array $columns The columns.
     *
     * @return array
     */
    public function columns_header( $columns ) {

        $new_columns = [
            'portfolio_thumbnail' => esc_html__( 'Image', 'kdesk_vc' ),
            'portfolio_ver'       => esc_html__( 'Version', 'kdesk_vc' ),
            'portfolio_price'     => esc_html__( 'Price', 'kdesk_vc' ),
            'reviews'         => esc_html__( 'Reviews', 'kdesk_vc' ),
            'recent_update'       => esc_html__( 'Updated', 'kdesk_vc' ),
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

        $portfoliocurrency = '$';

		$prefix = 'kdesk_';

        switch ( $column ) {

            case 'portfolio_thumbnail':
				echo ( has_post_thumbnail( $post->ID ) ) ?
                get_the_post_thumbnail( $post->ID, 'kdesk_portfolio_thumb' )
				: '<span class="na">&ndash;</span>';
	            break;

			case 'portfolio_ver':
				$portfolio_ver = get_post_meta( $post->ID, $prefix . 'portfolio_ver', true ) ?? '';
                echo (!empty($portfolio_ver)) ? $portfolio_ver : '1.0.0'; //phpcs:ignore
				break;

			case 'portfolio_price':
				$portfolio_price = get_post_meta( $post->ID, $prefix . 'portfolio_price', true );
				$discount_status = get_post_meta( $post->ID, $prefix . 'discount_status', true );

				$portfolio_price = ( strpos( $portfolio_price, '$' ) !== false ) ? str_replace( '$', '', $portfolio_price ) : 0;

				echo ( ! empty( $discount_status ) && $discount_status == 1 ) ? "<s>{$portfoliocurrency}{$portfolio_price}</s>" : $portfoliocurrency . $portfolio_price;   //phpcs:ignore

				if ( ! empty( $discount_status ) && $discount_status == 1 ) {

					$discounted_price       = get_post_meta( $post->ID, $prefix . 'discount_percentage', true );
					$final_discounted_price = ( strpos( $discounted_price, '$' ) !== false ) ? str_replace( '$', '', $discounted_price ) : 0;
					echo "<span class='kdesk_discount_percentage'>{$portfoliocurrency}{$final_discounted_price}</span>"; //phpcs:ignore
				}

	            break;

			case 'recent_update':
				echo \get_the_modified_date( get_option( 'date_format' ) );  //phpcs:ignore
                break;
			case 'reviews':
                $args = [
					'post_type'   => KDESK_CPT_TESTIMONIAL,
					'limit'       => -1,
					'post_status' => 'publish',
					'meta_query'  => [
						[
							'key'     => 'kdesk_portfolio_id',
							'value'   => $post->ID,
							'compare' => '=',
						],
					],
				];

				$testimonials = new WP_Query( $args );
				echo $testimonials->post_count ?? 0; //phpcs:ignore
                break;
        }
    }
}
