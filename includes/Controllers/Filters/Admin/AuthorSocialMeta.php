<?php
namespace KDESKADDON\Controllers\Filters\Admin;

use Xenioushk\BwlPluginApi\Api\Filters\FiltersApi;
use KDESKADDON\Callbacks\Filters\Admin\AuthorSocialMetaCb;

/**
 * Class for registering the cron scheduler filters.
 *
 * @since: 2.1.9
 * @package KDESKADDON
 */
class AuthorSocialMeta {

    /**
	 * Register filters.
	 */
    public function register() {

        // Initialize API.
        $filters_api = new FiltersApi();

        // Filters.
        $filters = [
            [
				'tag'      => 'user_contactmethods',
				'callback' => [ ( new AuthorSocialMetaCb() ), 'set_author_social_links' ],
            ],
        ];

        $filters_api->add_filters( $filters )->register();
    }
}
