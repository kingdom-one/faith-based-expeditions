<?php
/**
 * Class Theme_Init
 *
 * @package KingdomOne
 */

namespace KingdomOne;

/**
 * Theme Initialization
 * Enqueues styles and scripts
 */
class Theme_Init {
	/**
	 * Asset Handler
	 *
	 * @var Asset_Handler $asset_handler
	 */
	private Asset_Handler $asset_handler;

	/**
	 * Theme_Init constructor.
	 */
	public function __construct() {
		$this->load_required_files();
		$this->asset_handler = new Asset_Handler( true );
		add_action( 'wp_enqueue_scripts', array( $this->asset_handler, 'enqueue_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this->asset_handler, 'dequeue_scripts' ), 40 );
	}

	/**
	 * Load the required files
	 */
	private function load_required_files() {
		$helpers = array( 'asset-handler' => null );
		foreach ( $helpers as $file => $class ) {
			require_once get_theme_file_path( "/includes/theme-helpers/class-{$file}.php" );
			if ( $class ) {
				$class = "KingdomOne\\{$class}";
				new $class();
			}
		}
		$files = array(
			'login-handler'           => 'Login_Handler',
			'admin-dashboard-handler' => 'Admin_Dashboard_Handler',
		);

		foreach ( $files as $file => $class ) {
			require_once get_theme_file_path( "/includes/class-{$file}.php" );
			if ( $class ) {
				$class = "KingdomOne\\{$class}";
				new $class();
			}
		}
	}
}