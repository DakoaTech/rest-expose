<?php
/**
 * Plugin Name:       REST Expose
 * Plugin URI:        TBD
 * Description:       Make fields available in the REST API
 * Version:           0.0.1
 * Requires at least: 4.6
 * Requires PHP:      7.1
 */

defined('ABSPATH') || exit;
define('PLUGIN_PATH', dirname(__FILE__));
include_once PLUGIN_PATH . '/includes/consts.php';
include_once PLUGIN_PATH . '/includes/util.php';
include_once PLUGIN_PATH . '/includes/admin_functions.php';
include_once PLUGIN_PATH . '/includes/main_functions.php';
