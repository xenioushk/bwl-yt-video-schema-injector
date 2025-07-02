<?php
namespace BWLYTVSI\Controllers\OptionsPanel;

use BWLYTVSI\Callbacks\OptionsPanel\Pages\LicensePageCb;

/**
 * Class SettingsMenu
 *
 * @package BWLYTVSI
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

        $sub_menu_pages = [
            [
                'page_title' => esc_attr__( 'API KEY Page', 'kdesk_vc' ),
                'menu_title' => esc_attr__( 'API KEY', 'kdesk_vc' ),
                'menu_slug'  => 'kdesk-api-key-page',
                'cb'         => [ ( new LicensePageCb() ), 'load_template' ],
            ],

        ];

        return $sub_menu_pages;
    }

    /**
     * Register the sub menu pages.
     */
    public function register_menu_pages() {

        $parent_menu_link = 'settings.php';

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
