<?php
namespace BWLYTVSI\Controllers\Actions\Frontend;

use Xenioushk\BwlPluginApi\Api\Actions\ActionsApi;
use BWLYTVSI\Callbacks\Actions\Frontend\YtSchemaInjectorCb;

/**
 * Class for registering YouTube schema injector actions.
 *
 * @since: 2.1.9
 * @package BWLYTVSI
 */
class YtSchemaInjector {

    /**
	 * Register actions.
	 */
    public function register() {

        // Initialize API.
        $actions_api = new ActionsApi();

        // Actions.
        $actions = [
            [
                'tag'      => 'wp_footer',
                'callback' => [ ( new YtSchemaInjectorCb() ), 'generate_video_schema' ],
            ],
        ];
        $actions_api->add_actions( $actions )->register();
    }
}
