<?php
namespace BwlFaqManager\Callbacks\OptionsPanel;

use Xenioushk\BwlPluginApi\Api\View\ViewApi;

/**
 * Class for loading the settings page template.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class SettingsPageCb extends ViewApi {

	/**
	 * Load the settings page template.
	 *
	 * @return void
	 */
	public function load_template() {

		$data = [
			'page_title' => 'BWL Advanced FAQ Manager Settings',
			'options_id' => BAF_OPTIONS_ID,
			'page_id'    => 'bwl-advanced-faq-settings',
		];

		$this->render( BAF_VIEWS_DIR . 'Admin/OptionsPanel/tpl_settings_page.php',$data );

	}
}
