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
		new Block_Handler();
		$this->disable_discussion();
		add_action( 'wp_enqueue_scripts', array( $this->asset_handler, 'enqueue_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this->asset_handler, 'dequeue_scripts' ), 40 );
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
	}

	/**
	 * Load the required files
	 */
	private function load_required_files() {
		$helpers = array( 'asset-handler', 'block-handler' );
		foreach ( $helpers as $file ) {
			require_once get_theme_file_path( "/includes/theme-helpers/class-{$file}.php" );
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

	/** Remove comments, pings and trackbacks support from posts types. */
	private function disable_discussion() {
		// Close comments on the front-end.
		add_filter( 'comments_open', '__return_false', 20, 2 );
		add_filter( 'pings_open', '__return_false', 20, 2 );

		// Hide existing comments.
		add_filter( 'comments_array', '__return_empty_array', 10, 2 );

		// Remove comments page in menu.
		add_action(
			'admin_menu',
			function () {
				remove_menu_page( 'edit-comments.php' );
			}
		);

		// Remove comments links from admin bar.
		add_action(
			'init',
			function () {
				if ( is_admin_bar_showing() ) {
					remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
				}
			}
		);
	}

	/**
	 * Theme Setup
	 */
	public function theme_setup() {
		$this->add_image_sizes();
		remove_theme_support( 'core-block-patterns' );
	}

	/**
	 * Add custom image sizes
	 */
	private function add_image_sizes() {
		$image_sizes = array(
			'gallery-full'      => array(
				'width'  => 3840,
				'height' => 2160,
			),
			'gallery-thumbnail' => array(
				'width'  => 600,
				'height' => 600,
			),
		);
		foreach ( $image_sizes as $name => $size ) {
			add_image_size( $name, $size['width'], $size['height'] );
		}
	}
}
