<?php
namespace KDESKADDON\Base;

/**
 * Class Deactivate
 *
 * After plugin Deactivate, it flush the rewrite rules.
 *
 * @package KDESKADDON
 */
class Deactivate {
	/**
	 * Callback function for the plugin deactivation
	 *
	 * @since 2.0.6
	 */
	public static function deactivate() { // phpcs:ignore
		flush_rewrite_rules();
	}
}
