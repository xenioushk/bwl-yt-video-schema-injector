<?php
namespace KDESKADDON\Controllers\OptionsPanel;

use KDESKADDON\Callbacks\OptionsPanel\Pages\LicensePageCb;
use KDESKADDON\Callbacks\OptionsPanel\Pages\OurProductsCb;

/**
 * Class SettingsMenu
 *
 * @package KDESKADDON
 * @since 1.0.0
 * @author Mahbub Alam Khan
 */
class SettingsMenu {

    /**
     * Register the settings menu.
     */
    public function register() {

        add_action( 'admin_menu', [ $this, 'register_menu_pages' ] );
    }

    /**
     * Get the sub menu pages.
     *
     * @return array
     */
    public function get_the_sub_menu_pages() {

        // License Badge
        $license_activation_info = ( KDESKADDON_PRODUCT_VERIFIED_STATUS == 1 ) ?
        [ 'class' => 'activated', 'text' => esc_attr__( 'ACTIVE', 'kdesk_vc' ) ] :
        [ 'class' => 'inactive', 'text' => esc_attr__( 'INACTIVE', 'kdesk_vc' ) ];

        // Sale Badge.
        $our_products = get_option( KDESKADDON_CRON_BWL_PRODUCTS_OPTION_ID ) ?? [];
        $sale_badge   = ! empty( $our_products ) ? '<span class="bwl-license-activation-tag inactive">Sale</span>' : '';

        $sub_menu_pages = [
            [
                'page_title' => esc_attr__( 'License Page', 'kdesk_vc' ),
                'menu_title' => esc_attr__( 'License', 'kdesk_vc' ) . '<span class="bwl-license-activation-tag ' . $license_activation_info['class'] . '">' . $license_activation_info['text'] . '</span>',
                'menu_slug'  => 'kdesk-license-page',
                'cb'         => [ ( new LicensePageCb() ), 'load_template' ],
            ],
            [
				'page_title' => esc_attr__( 'More products from BlueWindLab !', 'kdesk_vc' ),
				'menu_title' => esc_attr__( 'More Products', 'kdesk_vc' ) . $sale_badge,
				'menu_slug'  => 'bwl-products',
				'cb'         => [ ( new OurProductsCb() ), 'load_template' ],
				'position'   => 121,
            ],

        ];

        return $sub_menu_pages;
    }

    /**
     * Register the sub menu pages.
     */
    public function register_menu_pages() {

        $parent_menu_link = 'themes.php';

        foreach ( $this->get_the_sub_menu_pages() as $sub_page ) {
            add_submenu_page(
                $parent_menu_link,
                $sub_page['page_title'],
                $sub_page['menu_title'],
                'manage_options',
                $sub_page['menu_slug'],
                $sub_page['cb'],
                $sub_page['position'] ?? null
            );
        }
    }
}
