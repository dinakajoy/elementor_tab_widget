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

	// Return plugin version.
	public function etw_get_version() {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];

		return $plugin_version;

	}

	// Deactivate plugin.
	public function deactivate_plugin() {
		if ( is_plugin_active( '../elementor-tab-widget.php' ) ) {
			deactivate_plugins( '../elementor-tab-widget.php' );
		}
	}

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
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
	}

	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_plugins_loaded() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', array( $this, 'init' ) );
		}

	}

	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Load widgets.
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );

		// Load i18n.
		$this->i18n();

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'widget_styles' ) );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );

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
	 * Load Styles
	 *
	 * @since 1.0.0
	 */
	public function widget_styles() {

		wp_register_style( 'elementor-tab-widget-style', ELEMENTOR_TAB_WIDGET_PLUGIN_URL . 'assets/build/css/tab.css', array(), $this->etw_get_version(), 'all' );
		wp_register_style( 'font-awesome', ELEMENTOR_TAB_WIDGET_PLUGIN_URL . 'assets/build/fonts/font-awesome.min.css', array(), '4.7.0', null );

		wp_enqueue_style( 'elementor-tab-widget-style' );
		wp_enqueue_style( 'font-awesome' );

	}

	/**
	 * Load Scripts
	 *
	 * @since 1.0.0
	 */
	public function widget_scripts() {

		wp_register_script( 'elementor-tab-widget-script', ELEMENTOR_TAB_WIDGET_PLUGIN_URL . 'assets/build/js/tab.js', array( 'jquery' ), $this->etw_get_version(), true );

		wp_enqueue_script( 'elementor-tab-widget-script' );

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function is_compatible() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );

			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );

			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );

			return false;
		}

		return true;
	}

	/**
	 * Admin Notice
	 * Warning when the site doesn't have Elementor installed or activated
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_missing_main_plugin() {
		$this->deactivate_plugin();

			$message = sprintf(
				/* translators: %s: error message */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated', 'elementor-tab-widget' ),
				'<strong>' . esc_html__( 'Elementor Tab Widget', 'elementor-tab-widget' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'elementor-tab-widget' ) . '</strong>'
			);

		printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', esc_html( $message ) );
	}

	/**
	 * Admin Notice
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_elementor_version() {
		$this->deactivate_plugin();

		$message = sprintf(
			/* translators: %s: error message */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'elementor-tab-widget' ),
			'<strong>' . esc_html__( 'Elementor Tab Widget', 'elementor-tab-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-tab-widget' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', esc_html( $message ) );
	}

	/**
	 * Admin Notice
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_php_version() {
		$this->deactivate_plugin();

		$message = sprintf(
			/* translators: %s: error message */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'elementor-tab-widget' ),
			'<strong>' . esc_html__( 'Elementor Tab Widget', 'elementor-tab-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-tab-widget' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', esc_html( $message ) );
	}

}

Widgets_Loader::instance();
