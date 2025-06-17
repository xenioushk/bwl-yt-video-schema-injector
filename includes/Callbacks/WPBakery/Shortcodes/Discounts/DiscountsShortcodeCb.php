<?php
namespace KDESKADDON\Callbacks\WPBakery\Shortcodes\Discounts;

use KDESKADDON\Helpers\OurProducts;

/**
 * Class Discounts ShortcodeCb
 *
 * @package KDESKADDON
 */
class DiscountsShortcodeCb {

    /**
     * Discounts Shortcode attributes.
     *
     * @var array
     */
    public $atts = [];

	/**
     * Products data attributes.
     *
     * @var array
     */
    public $products_data = [];

    /**
     * Discounts Shortcode Callback.
     *
     * @param array $atts Shortcode attributes.
     * @return string
     */
    public function get_shortcode_output( $atts ) {

        $atts = shortcode_atts(
            [
                'type'    => 'wp_plugins', // wp_themes, wp_plugins, wp_addons, html_templates, js_plugins
                'columns' => 2,
            ],
            $atts
        );

        extract( $atts ); // phpcs:ignore

        $this->atts = $atts;

        $this->set_the_data();

        if ( empty( $this->products_data ) ) {
            return '';
        }

        $output = '<div class="row">';

        $shortcode = '';

        foreach ( $this->products_data as $product ) {

            $preview     = $product['preview'] ?? '';
            $title       = $product['title'] ?? '';
            $reg_price   = $product['reg_price'] ?? '';
            $new_price   = $product['new_price'] ?? '';
            $btnurl      = $product['btnurl'] ?? '';
            $badge_html  = '<div class="d-flex gap-2 flex-row"><span class="badge text-bg-light fs-6"><s>$' . trim( $reg_price ) . '</s></span>';
            $badge_html .= '<span class="badge text-bg-success fs-4">$' . trim( $new_price ) . '</span></div>';

            $preview_image_string = ( ! empty( $preview ) ) ? sprintf( '<img src="%s" alt="%s">', $preview, $title ) : '';
            $btn_url_string       = ( ! empty( $btnurl ) ) ? sprintf( '<a href="%s" class="btn btn-theme btn-theme-small"target="_blank">Buy Now</a>', $btnurl ) : '';
            $title_string         = sprintf( '<h2><a href="%s" target="_blank">%s</a></h2>', $btnurl, $title );

            $shortcode .= sprintf('<div class="col-6">
            <div class="highlight-layout-3 highlight-box-shadow">
  %s
  <div class="d-flex flex-column gap-2 justify-content-center align-items-center">
    %s
    %s
    %s
  </div>
  </div>
</div>', $preview_image_string, $title_string, $badge_html, $btn_url_string );
        }

        $output .= $shortcode;

        $output .= '</div>';
        return do_shortcode( kdesk_cleanup_shortcode( $output ) );
    }

    /**
     * Get the data.
     *
     * @return void
     */
    private function set_the_data() {

        $all_products = OurProducts::get_products();

        $this->products_data = $all_products[ $this->atts['type'] ] ?? [];
    }
}
