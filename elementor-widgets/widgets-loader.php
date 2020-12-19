<?php
/**
 * Elementor Widget Loader.
 *
 * @since 1.0.0
 */

namespace Elementor_Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

final class Widgets_Loader {

	// Plugin version.
	const VERSION = '1.0.0';

	// Minimum Elementor Version.
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	// Minimum PHP Version.
	const MINIMUM_PHP_VERSION = '5.2';

	// Instance.
	private static $_instance = null;

	/**
	 * SIngletone Instance Method
	 *
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Construct Method.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts_styles' ) );
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Scripts & Styles
	 *
	 * @since 1.0.0
	 */
	public function scripts_styles() {
		wp_register_style( 'myew-style', ELEMENTOR_TAB_WIDGET_PLUGIN_URL . 'assets/build/css/tab.css', array(), rand(), 'all' );
		wp_register_script( 'myew-script', ELEMENTOR_TAB_WIDGET_PLUGIN_URL . 'assets/build/js/tab.js', array(), rand(), true );

		wp_enqueue_style( 'myew-style' );
		wp_enqueue_script( 'myew-script' );
	}

	/**
	 * Load Text Domain
	 *
	 * @since 1.0.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'elementor-tab-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Load Widget Files.
	 *
	 * @since 1.0.0
	 */
	private function include_widgets_files() {

		require_once __DIR__ . '/tab-widget.php';

	}

	/**
	 * Register Widgets
	 *
	 * @since 1.0.0
	 */
	public function register_widgets() {

		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Tab_Widget() );

	}

	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Check if ELementor is installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );

			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );

			 return;
		}

		if ( ! version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );

			return;
		}

		// Load widgets.
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
	}

	/**
	 * Admin Notice
	 * Warning when the site doesn't have Elementor installed or activated
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated', 'elementor-tab-widget' ),
				'<strong>' . esc_html__( 'Elementor Tab Widget', 'elementor-tab-widget' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'elementor-tab-widget' ) . '</strong>'
			);

		printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin Notice
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'elementor-tab-widget' ),
			'<strong>' . esc_html__( 'Elementor Tab Widget', 'elementor-tab-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-tab-widget' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin Notice
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'elementor-tab-widget' ),
			'<strong>' . esc_html__( 'Elementor Tab Widget', 'elementor-tab-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-tab-widget' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
	}

}

Widgets_Loader::instance();