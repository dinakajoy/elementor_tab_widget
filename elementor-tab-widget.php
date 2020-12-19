<?php
/**
 * Plugin Name: Elementor Tab Widget
 * Plugin URI: http://dinakajoy.com
 * Description: A custom elementor tab widget
 * Version: 1.0.0
 * Author: Odinaka Joy
 * Author URI: http://dinakajoy.com
 * Text Domain: elementor-tab-widget
 *
 * @package Elementor_Tab_Widget
 */

/**
 * Define Plugin Constants
 *
 * @since 1.0.0
 */

if ( ! defined( 'ELEMENTOR_TAB_WIDGET_PLUGIN_URL' ) ) {
	define( 'ELEMENTOR_TAB_WIDGET_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
}
if ( ! defined( 'ELEMENTOR_TAB_WIDGET_PLUGIN_PATH' ) ) {
	define( 'ELEMENTOR_TAB_WIDGET_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

require_once ELEMENTOR_TAB_WIDGET_PLUGIN_PATH . '/elementor-widgets/widgets-loader.php';
