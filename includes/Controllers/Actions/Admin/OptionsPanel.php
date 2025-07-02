<?php
namespace BWLYTVSI\Controllers\Actions\Admin;

use Xenioushk\BwlPluginApi\Api\Actions\ActionsApi;
use BWLYTVSI\Callbacks\Actions\Admin\OptionsPanel\OptionsPanelCb;

/**
 * Class for registering the admin options panel actions.
 *
 * @since: 1.0.0
 * @package BWLYTVSI
 */
class OptionsPanel {

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
                'callback' => [ ( new OptionsPanelCb() ), 'register_options' ],
            ],
        ];
        $actions_api->add_actions( $actions )->register();
    }
}
