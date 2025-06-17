<?php
namespace KDESKADDON\Callbacks\Notices;

use KDESKADDON\Traits\TraitAdminNotice;

/**
 * Class NoticeCb
 *
 * Handles the FAQ items shortcode callbacks.
 *
 * @package KDESKADDON
 */
class NoticeCb {

	use TraitAdminNotice;

	/**
	 * Display the plugin notices.
	 *
	 * @param array $notice The notice data.
	 */
	public function get_the_notice( $notice = [] ) {
		$this->get_notice_html( $notice );
	}
}
