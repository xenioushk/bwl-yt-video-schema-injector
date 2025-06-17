<?php
namespace KDESKADDON\Controllers\Actions\Admin;

use Xenioushk\BwlPluginApi\Api\Actions\ActionsApi;
use KDESKADDON\Callbacks\Actions\Admin\Scheduler\SchedulerCb;
use KDESKADDON\Callbacks\Actions\Admin\Scheduler\OfferSchedulerCb;
use KDESKADDON\Callbacks\Actions\Admin\Scheduler\ProductsSchedulerCb;

/**
 * Class for registering the admin scheduler actions.
 *
 * @since: 2.1.9
 * @package KDESKADDON
 */
class Scheduler {

    /**
	 * Register actions.
	 */
    public function register() {

        // Initialize API.
        $actions_api = new ActionsApi();

        // Actions.
        $actions = [
            [
                'tag'      => 'admin_init',
                'callback' => [ ( new SchedulerCb() ), 'register_cron_schedule' ],
            ],
            [
				'tag'      => KDESKADDON_CRON_OFFER_ID,
				'callback' => [ ( new OfferSchedulerCb() ), 'fetch_api_data' ],
            ],
            [
				'tag'      => KDESKADDON_CRON_BWL_PRODUCTS_ID,
				'callback' => [ ( new ProductsSchedulerCb() ), 'fetch_api_data' ],
            ],
        ];
        $actions_api->add_actions( $actions )->register();
    }
}
