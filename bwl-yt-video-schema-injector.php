<?php
/**
 * Plugin Name: BWL YouTube Video Schema Injector
 * Plugin URI: https://bluewindlab.net
 * Description: Injects schema markup for YouTube videos in WordPress posts, pages, or custom post types.
 * Author: BlueWindLab
 * Version: 1.0.0
 * Author URI: https://bluewindlab.net
 * WP Requires at least: 6.0+
 * Text Domain: bwl_yt_video_schema
 * Domain Path: /languages/
 *
 * @package BWLYTVSI
 * @author Mahbub Alam Khan
 * @license GPL-2.0+
 * @link https://codecanyon.net/user/xenioushk
 * @copyright 2025 BlueWindLab
 */

namespace BWLYTVSI;

// security check.
defined( 'ABSPATH' ) || die( 'Unauthorized access' );

// Once we get here, We have passed all validation checks so we can safely include our plugin

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Function to handle the initialization of the plugin.
 *
 * @return mixed
 */
function init_bwlytvsi() {

	if ( class_exists( 'BWLYTVSI\\Init' ) ) {
		Init::register_services();
	}
}

add_action( 'init', __NAMESPACE__ . '\\init_bwlytvsi' );
