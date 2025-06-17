<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Portfolio;

use WP_Query;
use KAFWPB\Controllers\WPBakery\Support\Animation;

/**
 * Class Portfolio ShortcodeCb
 *
 * @package KDESKADDON
 */
class PortfolioShortcodeCb {

    /**
     * Portfolio Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts([
            'post_type'                => 'portfolio',
            'orderby'                  => 'ID',
            'order'                    => 'DESC',
            'limit'                    => -1,
            'portfolio_category'       => '',
            'related_current_id'       => 0, // exclude id. Use for related post.
            'column'                   => 2,
            'display_type'             => 'grid', // grid, filterable, carousel, single_category
            'carousel_status'          => 0,
            'carousel_nav'             => 1,
            'carousel_dots'            => 0,
            'carousel_autoplay'        => 'true',
            'carousel_autoplaytimeout' => 5000,
            'animation'                => '',
            'box_shadow_status'        => 0,
        ], $atts);

        extract( $atts ); //phpcs:ignore

        if ( isset( $display_type ) && $display_type == 'carousel' ) {
            $carousel_status = 1;
        }

        $output = '<div class="kdesk-portfolio">';

        /*------------------------------  Start Filterable Portfolio Buttons---------------------------------*/

        if ( isset( $display_type ) && $display_type == 'filterable' ) {

            $portfolio_category_args = [

                'taxonomy'   => 'portfolio_category',
                'hide_empty' => 0,
                'orderby'    => 'ID',
                'order'      => 'ASC',
            ];

            $portfolio_categories = get_categories( $portfolio_category_args );

            $output .= '<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="filter-items">';

            $output .= '<button class="btn btn-default filter-button active" data-filter="all">All</button>';

            foreach ( $portfolio_categories as $category ) :

                $output .= '<button class="btn btn-default filter-button" data-filter="' . $category->slug . '">' . $category->name . '</button>';

            endforeach;

            $output .= '</div> <!-- end .filter-items  -->
                            </div><!-- end .col-md-12  -->
                            </div> <!-- end .row  -->';

            wp_reset_postdata();
        }

        /*------------------------------  End filterable portfolio buttons ---------------------------------*/

        if ( ! is_numeric( $limit ) ) {
            $limit = '-1';
        }

        $args = [
            'post_status'    => 'publish',
            'post_type'      => $post_type,
            'orderby'        => $orderby,
            'order'          => $order,
            'posts_per_page' => $limit,
        ];

        if ( $related_current_id != '0' ) {
            $args['post__not_in'] = [ $related_current_id ];
        }

        // 'post__not_in' => array($id),

        if ( $display_type == 'single_category' && $portfolio_category != '' ) {

            $taxonomy = 'portfolio_category';

            $args['tax_query'] = [                     // (array) - use taxonomy parameters (available with Version 3.1).
                'relation' => 'AND',                      // (string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
                [
                    'taxonomy'         => $taxonomy,                // (string) - Taxonomy.
                    'field'            => 'slug',                    // (string) - Select taxonomy term by ('id' or 'slug')
                    'terms'            => explode( ',', trim( $portfolio_category ) ),    // (int/string/array) - Taxonomy term(s).
                    'include_children' => 0,           // (bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
                    'operator'         => 'IN',                    // (string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
                ],
            ];
        }

        if ( $column == 3 ) {

            $cols_class = 'col-lg-4';
        } elseif ( $column == 4 ) {

            $cols_class = 'col-lg-3';
        } else {

            $cols_class = 'col-lg-6';
        }

        $loop = new WP_Query( $args );

        $default_thumb = KDESKADDON_LIBS_DIR . 'images/cpt/portfolio/default.jpg';

        $output .= '<div class="row">';

        // Starting div condition for carousel.
        if ( $carousel_status == 1 ) {

            $carousel_nav_status  = ( $carousel_nav == 1 ) ? 'false' : 'true';
            $carousel_dots_status = ( $carousel_dots == 1 ) ? 'false' : 'true';

            $output .= '<div class="kdesk-portfolio-container owl-carousel" data-carousel="1" data-items="' . $column . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
        }

        // Animation Class

        $kdesk_portfolio_animation = '';

        if ( isset( $animation ) && $animation != '' ) {
            $animate_class             = new Animation( [ 'base' => 'kdesk_portfolio' ] );
            $kdesk_portfolio_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        /* ----- Box Shadow ---- */

        $box_shadow_class = '';

        if ( isset( $box_shadow_status ) && $box_shadow_status == 1 ) {

            $box_shadow_class .= ' theme-custom-box-shadow';
        }

        // Portfolio Container Class.

        $portfolio_container_class = 'portfolio-container' . $kdesk_portfolio_animation . $box_shadow_class;

        if ( $loop->have_posts() ) :

            while ( $loop->have_posts() ) :

                $loop->the_post();

                global $post;

                $portfolio_title = get_the_title();

                if ( has_post_thumbnail() ) {

                    $portfolio_image = kdesk_addon_get_img( get_post_thumbnail_id( $post->ID ) );
                } else {

                    $portfolio_featured_image_url = $default_thumb;

                    $portfolio_image = '<img src="' . $default_thumb . '" alt="' . $portfolio_title . '"/>';
                }

                $portfolio_category = '';

                $get_portfolio_cat = get_the_terms( $post->ID, 'portfolio_category' );

                if ( is_array( $get_portfolio_cat ) && count( $get_portfolio_cat ) > 0 ) {

                    foreach ( $get_portfolio_cat as $category ) {

                        $portfolio_category .= $category->slug . ' ';
                    }

                    $portfolio_category = substr( $portfolio_category, 0, strlen( $portfolio_category ) - 1 );
                } else {

                    $portfolio_category = 'all';
                }

                $output .= '<div class="' . $cols_class . ' portfolio-col-pad col-md-offset-0 col-sm-6 col-sm-offset-0 filter ' . $portfolio_category . '">
                                        <div class="' . $portfolio_container_class . '">
                                            <a href="' . get_the_permalink() . '" title="' . $portfolio_title . '">
                                                <figure class="portfolio-img img-responsive text-center">
                                                    <div class="portfolio-img-container">
                                                        ' . $portfolio_image . '
                                                    </div>
                                                    <figcaption class="portfolio-title text-center">
                                                        ' . $portfolio_title . '
                                                    </figcaption>
                                                </figure>
                                            </a>
                                          </div> 
                                    </div>';

            endwhile;

        else :

            return '';

        endif;

        // Ending div condition for carousel.
        if ( $carousel_status == 1 ) {
            $output .= '</div>';
        }

        $output .= '</div>';

        $output .= '</div>';

        wp_reset_postdata();

        return $output;
    }
}
