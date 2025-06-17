<?php

namespace BwlFaqManager\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
use BwlFaqManager\Callbacks\FrontendAjaxHandlers\ViewsTrackerCb;
use BwlFaqManager\Callbacks\FrontendAjaxHandlers\FaqVotesCountCb;
use BwlFaqManager\Callbacks\FrontendAjaxHandlers\KeywordTrackerCb;

/**
 * Class for frontend ajax handlers.
 *
 * @package BwlFaqManager
 * @since: 1.1.0
 * @author: Mahbub Alam Khan
 */
class FrontendAjaxHandlers {

	/**
	 * Instance of the ajax handlers API.
	 *
	 * @var object $ajax_handlers_api AjaxHandlersApi.
	 */
	public $ajax_handlers_api;

	/**
	 * Instance of the ViewsTrackerCb.
	 *
	 * @var object $views_tracker_cb ViewsTrackerCb.
	 */
	public $views_tracker_cb;

	/**
	 * Instance of the FaqVotesCountCb.
	 *
	 * @var object $faq_votes_count_cb FaqVotesCountCb.
	 */
	public $faq_votes_count_cb;

	/**
	 * Instance of the KeywordTrackerCb.
	 *
	 * @var object $keyword_tracker_cb KeywordTrackerCb.
	 */
	public $keyword_tracker_cb;

	/**
	 * Register frontend ajax handlers.
	 */
	public function register() {

		$this->ajax_handlers_api = new AjaxHandlersApi();

		// Initalize Callbacks.
		$this->views_tracker_cb   = new ViewsTrackerCb();
		$this->faq_votes_count_cb = new FaqVotesCountCb();
		$this->keyword_tracker_cb = new KeywordTrackerCb();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$adminAjaxRequests = [

			[
				'tag'      => 'baf_track_views',
				'callback' => [ $this->views_tracker_cb, 'save_data' ],
			],
			[
				'tag'      => 'bwl_advanced_faq_apply_rating',
				'callback' => [ $this->faq_votes_count_cb, 'save_data' ],
			],
			[
				'tag'      => 'baf_track_search_keywords',
				'callback' => [ $this->keyword_tracker_cb, 'save_data' ],
			],

		];

		$this->ajax_handlers_api->add_ajax_handlers( $adminAjaxRequests )->register();
	}
}
