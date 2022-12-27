<?php
/**
 * Plugin Name: CBS
 * Plugin URI: https://CBS/
 * Description: displays Grids
 * Version: 1.0
 * Author: Muhammad Afeen
 * Author URI: https://
 * Text Domain: hello
 * Domain Path: /i18n/languages/muhammadAfeen
 * Requires at least: 5.8
 * Requires PHP: 7.2
 *
 *
 */

/**
 * Security purpose
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Including autoLoad File
 */

require_once dirname( __FILE__ ) . '/vendor/autoload.php';
use Inc;

/**
 * Creating Instance of CBS
 *
 */


if( class_exists("Inc\CBS")) {

	$cbs = Inc\CBS::instance();
	$cbs->register();
}









