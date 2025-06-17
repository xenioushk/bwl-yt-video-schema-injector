<?php

namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\BlogPosts;

use WP_Query;
use KAFWPB\Controllers\WPBakery\Support\Animation;

/**
 * Class Blog Posts Shortcode Callback.
 *
 * @package KDESKADDON
 */
class BlogPostsShortcodeCb {

    /**
     * CTA Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts(
            [
                'custom_class_id'          => wp_rand(),
                'post_type'                => 'post',
                'layout'                   => 'layout_1',
                'meta_key'                 => '',
                'meta_value'               => '',
                'orderby'                  => 'ID',
                'order'                    => 'ASC',
                'limit'                    => -1,
                'category'                 => '',
                'posts_count'              => 0,
                'column'                   => '3',
                'desc_length'              => 20,
                'carousel'                 => 0,
                'carousel_items'           => 4,
                'carousel_nav'             => 1,
                'carousel_dots'            => 0,
                'carousel_autoplay'        => 'true',
                'carousel_autoplaytimeout' => 5000,
                'theme'                    => '',
                'theme_color'              => KDESK_PRIMARY_COLOR,
                'animation'                => '',
                'box_shadow_status'        => 1,
            ],
            $atts
        );

        extract( $atts ); // phpcs:ignore

        // Animation Class

        $kdesk_blog_post_animation = '';

        if ( ! empty( $animation ) ) {
            $animate_class             = new Animation( [ 'base' => 'kdesk_blog_post' ] );
            $kdesk_blog_post_animation = ' ' . $animate_class->getCSSAnimation( $animation );
        }

        /* ----- Box Shadow ---- */

        $box_shadow_class = '';

        if ( isset( $box_shadow_status ) && $box_shadow_status == 1 ) {

            $box_shadow_class .= ' theme-custom-box-shadow';
        }

        // For Custom Theme.

        $custom_class      = '';
        $custom_class_data = '';

        if ( ! empty( $theme ) && $theme === 'custom' ) {

            $custom_class      .= ' kdesk_custom kc_' . $custom_class_id;
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-prev,';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-next{color: ' . $theme_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . '  figure:after {color: ' . $theme_color . ' !important;}';
            $custom_class_data .= '.kc_' . $custom_class_id . ' .owl-dots .active span{background: ' . $theme_color . ' !important;}';
        }

        // Wrapped By Data Attribute.

        if ( ! empty( $custom_class ) ) {

            $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        }

        $output = "<div class='row g-3 g-lg-4 {$custom_class}' {$custom_class_data}>";

        $carousel       = ( $layout === 'layout_2' ) ? 1 : 0;
        $carousel_items = $column;

        // Starting div condition for carousel.
        if ( $carousel ) {

            $carousel_nav_status  = ( $carousel_nav ) ? 0 : 1;
            $carousel_dots_status = ( $carousel_dots ) ? 0 : 1;

            $output .= '<div class="latest-news-carousel owl-carousel" data-carousel="1" data-items="' . $carousel_items . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '"  data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
        }

        $args = [
            'category_name'       => $category,
            'post_status'         => 'publish',
            'post_type'           => $post_type,
            'orderby'             => $orderby,
            'order'               => $order,
            'posts_per_page'      => $limit,
            'ignore_sticky_posts' => 1,
        ];

        $column_class = kdesk_column_class( $column );

        $loop = new WP_Query( $args );

        if ( $loop->have_posts() ) :

            while ( $loop->have_posts() ) :

                $loop->the_post();

                $post_id = get_the_ID();

                $publised_date = get_the_time( 'd, F Y' );

                $permalink = get_the_permalink();

                $post_title = '<a href="' . $permalink . '">' . get_the_title() . '</a>';

                if ( has_excerpt() ) {
                    $post_excerpt = get_the_excerpt();
                } else {
                    $post_excerpt = get_the_content();

                    $crop_content = wp_trim_words( $post_excerpt, $desc_length );
                    $post_excerpt = substr( $crop_content, 0, strlen( $crop_content ) - 8 ) . '...';
                }

                $featured_img = '';

                if ( has_post_thumbnail() ) {

                    $featured_img = get_the_post_thumbnail( $post_id, 'large' );
                }

                $column_class = $column_class . ' ' . $kdesk_blog_post_animation;

                $latest_news_container_class = 'latest-news-container' . $box_shadow_class;

                $output .= '<div class="' . $column_class . '">

                                    <div class="' . $latest_news_container_class . '"> 

                                        <a href="' . $permalink . '" title="">
                                            <figure>
                                        ' . $featured_img . '
                                            </figure>
                                        </a>

                                    <div class="news-content">

                                            <h3>
                                                ' . $post_title . '
                                            </h3>

                                            <div class="news-meta-info">
                                            <span>
                                                <i class="fa fa-clock-o"></i> ' . $publised_date . '
                                                  </span>
                                                  <span> 
                                                  <i class="fa fa-comment-o"></i> ' . $loop->comment_count . ' Comments
                                                  </span>
                                            </div>                                

                                            <div class="update-details">                                     
                                                ' . $post_excerpt . '
                                            </div>

                                        </div>

                                    </div>

                                </div>';

            endwhile;

        else :

            // Regular View.
            $output .= '<div>' . esc_html__( 'Sorry, No blog posts found!', 'kdesk_vc' ) . '</div>';

        endif;

        // Ending div condition for carousel.
        if ( $carouse ) {
            $output .= '</div>';
        }

        $output .= '</div>';

        wp_reset_postdata();
        return $output;
    }
}
