<?php
namespace BwlFaqManager\Controllers\Filters;

use Xenioushk\BwlPluginApi\Api\Filters\FiltersApi;
use BwlFaqManager\Callbacks\Filters\CategorySortCb;

/**
 * Class for registering the custom category sort filters.
 *
 * @since: 2.1.9
 * @package BwlFaqManager
 */
class CategorySort {

    /**
	 * Register filters.
	 */
    public function register() {

        // Initialize API.
        $filters_api = new FiltersApi();

        // Filters.
        $filters = [
            [
				'tag'        => 'get_terms_orderby',
				'callback'   => [ ( new CategorySortCb() ), 'set_filter' ],
				'args_count' => 3,
				'priority'   => 10,
            ],
            [
                'tag'      => 'baf_set_taxonomy_orderby',
                'callback' => [ ( new CategorySortCb() ), 'set_taxonomy_orderby' ],
            ],
            [
                'tag'      => 'baf_tax_orderby',
                'callback' => [ ( new CategorySortCb() ), 'set_taxonomy_orderby' ],
            ],
        ];

        $filters_api->add_filters( $filters )->register();
    }
}
