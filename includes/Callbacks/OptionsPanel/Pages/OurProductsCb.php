<?php
namespace KDESKADDON\Callbacks\OptionsPanel\Pages;

use Xenioushk\BwlPluginApi\Api\View\ViewApi;
use KDESKADDON\Helpers\OurProducts;

/**
 * Class for loading the settings page template.
 *
 * @package KDESKADDON
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class OurProductsCb extends ViewApi {

	/**
	 * Load the settings page template.
	 *
	 * @return void
	 */
	public function load_template() {

		$data = [
			'page_title' => 'BlueWindLab Products',
		];

		$data = array_merge( $data, OurProducts::get_products() );

		$this->render( KDESKADDON_VIEWS_DIR . 'Admin/Products/tpl_products.php',$data );

	}
}
