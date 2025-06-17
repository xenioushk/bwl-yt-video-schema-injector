<?php
namespace KDESKADDON\Base;

/**
 * Class Active
 *
 * After plugin activation, it flush the rewrite rules.
 * Also, set the transient value for activation redirect page.
 *
 * @package KDESKADDON
 */
class Activate {

	/**
	 * Callback function for the about plugin page.
	 *
	 * @since 2.0.6
	 */
	public function activate() {
		flush_rewrite_rules();

	}
}
