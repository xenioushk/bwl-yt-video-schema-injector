<?php

namespace BwlFaqManager\Controllers\DashboardWidgets;

use Xenioushk\BwlPluginApi\Api\DashboardWidgets\DashboardWidgetsApi;
use BwlFaqManager\Callbacks\DashboardWidgets\DashboardWidgetsCb;
/**
 * Class for PluginDashboardWidgets
 *
 * @package BwlFaqManager
 */
class PluginDashboardWidgets {

	/**
	 * Register the dashboard widgets.
	 *
	 * @return void
	 */
	public function register() {

		// Initialize API.
		$dashboard_widgets_api = new DashboardWidgetsApi();

		// Initialize callbacks.
		$dashboardWidgetsCb = new DashboardWidgetsCb();

		// Add all the dashwidgets here.
		$dashboard_widgets = [
			[
				'slug'  => 'baf-analytics-summary',
				'title' => 'Advanced FAQ Manager',
				'cb'    => [ $dashboardWidgetsCb, 'get_faq_analytics_summary' ],
			],
		];

		$dashboard_widgets_api->add_dash_widgets( $dashboard_widgets )->register();
	}
}
