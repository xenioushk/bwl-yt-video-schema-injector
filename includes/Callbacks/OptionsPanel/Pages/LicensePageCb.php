<?php
namespace KDESKADDON\Callbacks\OptionsPanel\Pages;

use KDESKADDON\Helpers\Common;
use Xenioushk\BwlPluginApi\Api\View\ViewApi;

/**
 * Class for loading the about plugin page template.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class LicensePageCb extends ViewApi {

	/**
	 * Load the about plugin page template.
	 *
	 * @return void
	 */
	public function load_template() {

		$data = [
			'page_title'        => 'License Page',
			'pluginLicenseData' => Common::get_license_info(),
			'licenseFaqs'       => $this->get_license_faqs(),
		];

		$this->render( KDESKADDON_VIEWS_DIR . 'Admin/License/tpl_verify_license.php',$data );
	}

	/**
	 * Get the license faqs data.
	 *
	 * @return array
	 */
	private function get_license_faqs() {
		$faqs = [
			[
				'ques' => 'How to download the purchase code?',
				'ans'  => "Check <a href=' https://bluewindlab.net/knowledgebase/general/where-i-can-get-the-purchase-code/' target='_blank'>this article</a> for step-by-step instructions.",
			],
			[
				'ques' => 'My six-month premium support period has expired. How to extend it?',
				'ans'  => "Follow <a href='" . KDESKADDON_PRODUCT_URL . "' target='_blank'>this link</a> and click the Renew Support button.",
			],
			[
				'ques' => 'I downloaded the plugin from Envato Elements. How can I get the purchase code?',
				'ans'  => 'Unfortunately, you can not. However, you can use all the features of the plugin without issue. The only exception is that we do not provide customer support if you download the plugin from Envato Elements.',
			],
			[
				'ques' => 'Can I get customer support If I download the plugin from Envato Elements?',
				'ans'  => "No. To get the author's premium support, please consider purchasing the plugin from <a href='" . KDESKADDON_PRODUCT_URL . "' target='_blank'>Themeforest</a>.",
			],
		];
			return $faqs;
	}
}
