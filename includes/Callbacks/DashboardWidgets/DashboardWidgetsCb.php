<?php
namespace BwlFaqManager\Callbacks\DashboardWidgets;

use BwlFaqManager\Helpers\Common;
use Xenioushk\BwlPluginApi\Api\View\ViewApi;
use BwlFaqManager\Controllers\Analytics\BafAnalyticsSummary;
use BwlFaqManager\Controllers\Analytics\BafAnalyticsLikesCount;
use BwlFaqManager\Controllers\Analytics\BafAnalyticsViewsCount;

/**
 * Class for DashboardWidgetsCb
 *
 * @package BwlFaqManager
 */
class DashboardWidgetsCb extends ViewApi {

	/**
	 * Get the plugin analytics summary.
	 *
	 * @return void
	 */
	public function get_faq_analytics_summary() {

		$bafAnalyticsSummaryData = new BafAnalyticsSummary();

		// Get All The FAQ Summary Data. (Total FAQs, Total Categories and Topics)
		$bafSummaryData = $bafAnalyticsSummaryData->register();

		$bafAnalyticsLikesCountData = new BafAnalyticsLikesCount();
		$faqLikesCount              = $bafAnalyticsLikesCountData->register();

		$bafAnalyticsViewsCountData = new BafAnalyticsViewsCount();
		$faqViewsCount              = $bafAnalyticsViewsCountData->register();

		$totalFaqsPublished = $bafSummaryData['totalFaqs']['published'];

		$data = [
			'faqs_count'        => $totalFaqsPublished,
			'likes_count'       => $faqLikesCount,
			'views_count'       => $faqViewsCount,
			'bafSummaryData'    => $bafSummaryData,
			'plugin_usage_info' => $this->get_plugin_usage_info(),
			'license_info'      => Common::get_license_info(),
			'footer_links'      => $this->get_dashboard_footer_links(),
			'offer_info'        => $this->get_offer_info(),
		];

		$this->render( BAF_VIEWS_DIR . 'Admin/DashboardWidgets/tpl_plugin_summary.php', $data );
	}


	/**
	 * Get the plugin usage info.
	 *
	 * @return array
	 */
    private function get_plugin_usage_info() {

        $plugin_installation_date = date( 'Y-m-d H:i:s', strtotime( get_option( BAF_PRODUCT_INSTALLATION_DATE ) ) );

        $date_diff = strtotime( date( 'Y-m-d H:i:s' ) ) - strtotime( $plugin_installation_date );
        $days_diff = round( $date_diff / ( 60 * 60 * 24 ) );

        $usage_info = [
            'status'    => $days_diff > 15 ? 1 : 0,
			// translators: %d is the number of days the plugin has been used.
			'msg'       => '🎉 ' . sprintf(esc_html__( 'You\'ve been using the plugin for %d days.', 'bwl-adv-faq' ),
                $days_diff
            ),
            'days_used' => $days_diff, // Include the days count for further use if needed
		];

        return $usage_info;

    }
	/**
	 * Get the footer links for the dashboard.
	 *
	 * @return array
	 */
	private function get_dashboard_footer_links() {
		$footer_links = [
			[
				'title' => '📊 ' . esc_html__( 'Analytics', 'bwl-adv-faq' ),
				'url'   => admin_url( 'edit.php?post_type=' . BAF_POST_TYPE . '&page=bwl-advanced-faq-analytics' ),
			],
			[
				'title' => '🛠️ ' . esc_html__( 'Options', 'bwl-adv-faq' ),
				'url'   => admin_url( 'edit.php?post_type=' . BAF_POST_TYPE . '&page=bwl-advanced-faq-settings' ),
			],
			[
				'title' => '🧩 ' . esc_html__( 'Addons', 'bwl-adv-faq' ),
				'url'   => admin_url( 'edit.php?post_type=' . BAF_POST_TYPE . '&page=baf-addons' ),
			],
			[
				'title' => '📘 ' . esc_html__( 'Documentation', 'bwl-adv-faq' ),
				'url'   => BAF_PRODUCT_DOC,
				'nt'    => 1,
			],
		];
		return $footer_links;
	}

	/**
	 * Get the offer information.
	 *
	 * @return array
	 */
	private function get_offer_info() {

		$offer = [
			'status' => 0,
		];

		// Fetch the offer data.
		$option_data = get_option( BAF_CRON_OFFER_OPTION_ID );

		// Return if the offer data is empty.
		if ( empty( $option_data ) ) {
			return $offer;
		}

		$offer_data = $option_data['data'];

		// This is the default date time.
		$now    = date( 'Y-m-d' );
		$stdate = $offer_data['stdate'] ?? $now;
		$exdate = $offer_data['exdate'] ?? $now;

		$show_offer = strtotime( $now ) >= strtotime( $stdate ) && strtotime( $now ) <= strtotime( $exdate );

		if ( ! $show_offer ) {
			return $offer;
		}

		$cta_btn = sprintf(
			'<br><a href="%s" class="button bwl-text-bold bwl-text-success" target="_blank">Get Now</a>',
			$offer_data['btnurl']
		);

		$msg = sprintf(
			'🎉 <strong>%s</strong> %s',
			$offer_data['details'],
			$cta_btn
		);

		return [
			'status' => 1,
			'msg'    => $msg,
		];

	}
}
