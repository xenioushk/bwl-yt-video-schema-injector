<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Pricetable;

use KDESKADDON\Controllers\WPBakery\Support\Animation;

/**
 * Class Pricetable Shortcode Callback.
 *
 * @package KDESKADDON
 */
class PricetableShortcodeCb {

	/**
	 * Pricetable Shortcode Callback.
	 *
	 * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
	 */
    public function kdesk_pricetable( $atts, $content ) {

        $atts = shortcode_atts([
            'id'     => wp_rand(),
            'layout' => 'simple', // simple, no_padding
            'column' => '4',
        ], $atts);

        extract( $atts ); //phpcs:ignore

        $output = '<div class="item_' . $column . ' row">';

        // Modified shortcode.

        $content = str_replace( '[kdesk_pricetable_item', '[kdesk_pricetable_item layout="' . $layout . '" column="' . $column . '"', $content );

        $output .= do_shortcode( $content );

        $output .= '</div><!-- end .row  -->';

        return $output;
    }

    /**
	 * Generate Each Pricing Column Block.
	 *
	 * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
	 */
    public function kdesk_pricetable_item( $atts, $content ) {

        $atts = shortcode_atts([
            'id'                         => '',
            'layout'                     => 'simple', // simple, no_padding
            'column'                     => '4',
            'content_alignment'          => 'center',

            'pricetable_type'            => '',
            'pricetable_currency'        => '$',
            'pricetable_price'           => '',
            'pricetable_period'          => 'month',
            'pricetable_details_type'    => 'list', // list/compact

            'pt_theme_status'            => 0,
            'pt_box_bg'                  => '#FAFAFA',
            'pt_currency_color'          => '#40C1F0',
            'pt_price_color'             => '#40C1F0',
            'pt_period_color'            => '#646E7A',
            'pt_details_color'           => '#2C2C2C',
            'pt_type_color'              => '#000000',

            'pt_btn_border'              => '1',
            'pt_btn_border_radius'       => '0',
            'pt_btn_bg'                  => '#FFFFFF',
            'pt_btn_color'               => '#40C1F0',
            'pt_btn_border_color'        => '#40C1F0',
            'pt_btn_hover_bg'            => '#40C1F0',
            'pt_btn_hover_color'         => '#FFFFFF',
            'pt_btn_hover_border_color'  => '#40C1F0',

            'fpt_box_bg'                 => '#40C1F0',
            'fpt_currency_color'         => '#FFFFFF',
            'fpt_type_color'             => '#FFFFFF',
            'fpt_price_color'            => '#FFFFFF',
            'fpt_period_color'           => '#FFFFFF',
            'fpt_details_color'          => '#FFFFFF',

            'fpt_btn_border'             => '1',
            'fpt_btn_border_radius'      => '0',
            'fpt_btn_bg'                 => '#FFFFFF',
            'fpt_btn_color'              => '#40C1F0',
            'fpt_btn_border_color'       => '#40C1F0',
            'fpt_btn_hover_bg'           => '#40C1F0',
            'fpt_btn_hover_color'        => '#FFFFFF',
            'fpt_btn_hover_border_color' => '#40C1F0',

            'pricetable_link'            => '#',
            'pricetable_link_text'       => __( 'Buy Now', 'kdesk_vc' ),
            'featured_status'            => 0,
            'fpt_theme_status'           => 0,
            'animation'                  => '',
        ], $atts);

        extract( $atts ); //phpcs:ignore

        $column_class = kdesk_pricing_table_column_class( $column );

        $content_alignment_class = kdesk_alignment_class( $content_alignment );

        // Custom Design Style.

        // Box Bg
        if ( $pt_theme_status == 1 && $pt_box_bg != '#FAFAFA' ) {

            // For regular.
            $cs_box_bg = ' style="background: ' . $pt_box_bg . ' ;"';
        } elseif ( $fpt_theme_status == 1 && $fpt_box_bg != '#40C1F0' ) {

            // For Featured.
            $cs_box_bg = ' style="background: ' . $fpt_box_bg . ' ;"';
        } else {

            // Default.
            $cs_box_bg = '';
        }

        // Price Type Color
        if ( $pt_theme_status == 1 && $pt_type_color != '#000000' ) {

            // For regular.
            $cs_type_color = ' style="color: ' . $pt_type_color . ' ;"';
        } elseif ( $fpt_theme_status == 1 && $fpt_type_color != '#FFFFFF' ) {

            // For Featured.
            $cs_type_color = ' style="color: ' . $fpt_type_color . ' ;"';
        } else {

            // Default.
            $cs_type_color = '';
        }

        // Price Currency Color
        if ( $pt_theme_status == 1 && $pt_currency_color != '#40C1F0' ) {

            // For regular.
            $cs_currency_color = ' style="color: ' . $pt_currency_color . ' ;"';
        } elseif ( $fpt_theme_status == 1 && $fpt_currency_color != '#FFFFFF' ) {

            // For Featured.
            $cs_currency_color = ' style="color: ' . $fpt_currency_color . ' ;"';
        } else {

            // Default.
            $cs_currency_color = '';
        }

        // Price Text Color
        if ( $pt_theme_status == 1 && $pt_price_color != '#40C1F0' ) {

            // For regular.
            $cs_price_color = ' style="color: ' . $pt_price_color . ' ;"';
        } elseif ( $fpt_theme_status == 1 && $fpt_price_color != '#FFFFFF' ) {

            // For Featured.
            $cs_price_color = ' style="color: ' . $fpt_price_color . ' ;"';
        } else {

            // Default.
            $cs_price_color = '';
        }

        // Plan Period Text Color
        if ( $pt_theme_status == 1 && $pt_period_color != '#646E7A' ) {

            // For regular.
            $cs_period_color = ' style="color: ' . $pt_period_color . ' ;"';
        } elseif ( $fpt_theme_status == 1 && $fpt_period_color != '#FFFFFF' ) {

            // For Featured.
            $cs_period_color = ' style="color: ' . $fpt_period_color . ' ;"';
        } else {

            // Default.
            $cs_period_color = '';
        }

        // Plan Details Text Color
        if ( $pt_theme_status == 1 && $pt_details_color != '#646E7A' ) {

            // For regular.
            $cs_details_color = ' style="color: ' . $pt_details_color . ' ;"';
        } elseif ( $fpt_theme_status == 1 && $fpt_details_color != '#FFFFFF' ) {

            // For Featured.
            $cs_details_color = ' style="color: ' . $fpt_details_color . ' ;"';
        } else {

            // Default.
            $cs_details_color = '';
        }

        // Parse Pricing Table Links.

        if ( $featured_status == 1 ) {

            $fpt_theme_class = ( isset( $fpt_theme_status ) && $fpt_theme_status == 1 ) ? 'custom' : '';

            $pricetable_link_html = do_shortcode('[kdesk_vc_button title="' . $pricetable_link_text . '" '
                . 'theme="' . $fpt_theme_class . '" '
                . 'cont_ext_class="kdesk-price-plan-btn btn-theme-invert" '
                . 'btn_info="' . $pricetable_link . '" '
                . 'btn_border="' . $fpt_btn_border . '" '
                . 'btn_border_radius="' . $fpt_btn_border_radius . '" '
                . 'btn_bg="' . $fpt_btn_bg . '" '
                . 'btn_color="' . $fpt_btn_color . '" '
                . 'btn_border_color="' . $fpt_btn_border_color . '" '
                . 'btn_hover_bg="' . $fpt_btn_hover_bg . '" '
                . 'btn_hover_color="' . $fpt_btn_hover_color . '" '
                . 'btn_hover_border_color="' . $fpt_btn_hover_border_color . '" '
            . '/]');
        } else {

            $pt_theme_class = ( isset( $pt_theme_status ) && $pt_theme_status == 1 ) ? 'custom' : '';

            $pricetable_link_html = do_shortcode('[kdesk_vc_button title="' . $pricetable_link_text . '" '
                . 'theme="' . $pt_theme_class . '" '
                . 'cont_ext_class="kdesk-price-plan-btn" '
                . 'btn_info="' . $pricetable_link . '" '
                . 'btn_border="' . $pt_btn_border . '" '
                . 'btn_border_radius="' . $pt_btn_border_radius . '" '
                . 'btn_bg="' . $pt_btn_bg . '" '
                . 'btn_color="' . $pt_btn_color . '" '
                . 'btn_border_color="' . $pt_btn_border_color . '" '
                . 'btn_hover_bg="' . $pt_btn_hover_bg . '" '
                . 'btn_hover_color="' . $pt_btn_hover_color . '" '
                . 'btn_hover_border_color="' . $pt_btn_hover_border_color . '" '
            . '/]');
        }

        // Pricing Table Details Type.
        if ( $pricetable_details_type == 'compact' ) {

            $pricing_table_items = '<div class="kdesk-pricing-container-details" ' . $cs_details_color . '>
                                                ' . do_shortcode( kdesk_cleanup_shortcode( trim( $content ) ) ) . '
                                                </div>';
        } else {

            $pricing_table_items = '<ul class="price-table-item" ' . $cs_details_color . '>
                                                ' . do_shortcode( kdesk_cleanup_shortcode( trim( $content ) ) ) . '
                                            </ul>';
        }

        // No Padding Pricing Table Class

        $layout_class = '';

        if ( $layout == 'no_padding' ) {
            $layout_class .= ' kdesk-no-padding-pricing-column';
        }

        // Featured Pricing Table Class

        $kdesk_pricing_highlight = '';

        if ( $featured_status == 1 ) {
            $kdesk_pricing_highlight .= 'kdesk-pricing-highlight';
        }

        // Animation Class

        $kdesk_pricing_animation = '';

		if ( ! empty( $animation ) ) {
            $animate_class           = new Animation( [ 'base' => 'kdesk_pricetable_item' ] );
            $kdesk_pricing_animation = $animate_class->getCSSAnimation( $animation );
        }

        $output = '<div class="' . $column_class . $layout_class . $kdesk_pricing_animation . '">

                        <div class="kdesk-pricing-container ' . $kdesk_pricing_highlight . ' ' . $content_alignment_class . '"  ' . $cs_box_bg . '>
                            <h3 class="plan-title" ' . $cs_type_color . '>' . $pricetable_type . '</h3>
                            <div class="kdesk-pricing-info">
                                <span class="plan-currency" ' . $cs_currency_color . '>' . $pricetable_currency . '</span>
                                <span class="plan-price" ' . $cs_price_color . '>' . $pricetable_price . '</span>
                                <span class="plan-period" ' . $cs_period_color . '>' . kdesk_price_table_title( $pricetable_period ) . '</span>
                            </div>
                            ' . $pricing_table_items . '
                            ' . $pricetable_link_html . '
                        </div>

                    </div>';

        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }

    /**
	 * Generate Each Pricing Item row.
	 *
	 * @param array $atts Shortcode attributes.
     * @return string
	 */
    public function kdesk_pt_item( $atts ) {

        $atts = shortcode_atts([
            'title' => '',
        ], $atts);

        extract( $atts ); //phpcs:ignore

        if ( ! empty( $title ) ) {
            return '<li>' . $title . '</li>';
        }
    }
}
