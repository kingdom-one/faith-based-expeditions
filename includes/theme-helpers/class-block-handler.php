<?php
/**
 * Block Handler
 * Helper class for handling WordPress Blocks
 *
 * @package KingdomOne
 */

namespace KingdomOne;

/**
 * Class Block_Handler
 */
class Block_Handler {
	/**
	 * Block_Handler constructor.
	 */
	public function __construct() {
		$this->load_required_files();
		add_action( 'init', array( $this, 'register_tour_patterns_category' ) );
		add_action( 'init', array( $this, 'register_tour_blocks' ), 20 );
		add_filter(
			'block_editor_settings_all',
			array( $this, 'hide_block_locking_ui' ),
			10,
			2
		);
		add_filter( 'should_load_remote_block_patterns', '__return_false' );
	}

	/**
	 * Load the required files
	 */
	private function load_required_files() {
		$files = array(
			'tour-meta-handler',
		);

		foreach ( $files as $file ) {
			require_once __DIR__ . "/class-{$file}.php";

		}
	}

	/**
	 * Registers a "Tours" Category to place all the Tour related block patterns.
	 */
	public function register_tour_patterns_category() {
		register_block_pattern_category(
			'tour',
			array(
				'label'       => esc_html__( 'Tours', 'kingdomone' ),
				'description' => esc_html__( 'Blocks for Tours', 'kingdomone' ),
			)
		);
	}

	/**
	 * Registers the Tour Blocks.
	 */
	public function register_tour_blocks() {
		$block_path = ( dirname( __DIR__, 2 ) ) . '/build/blocks';
		$blocks     = array(
			'dates',
			'test-block',
		);

		foreach ( $blocks as $block ) {
			register_block_type_from_metadata( "$block_path/{$block}/" );
		}
	}

	/**
	 * Hides the Block Lock settings for non-admin users on Tour post type.
	 *
	 * @param array                    $settings Default editor settings.
	 * @param \WP_Block_Editor_Context $context the block context object.
	 *
	 * @return array
	 */
	public function hide_block_locking_ui( $settings, $context ): array {
		$is_tour  = $context->post && 'tour' === get_post_type( $context->post->ID );
		$is_admin = current_user_can( 'edit_files' );
		if ( $is_tour && ! $is_admin ) {
			$settings['canLockBlocks']      = false;
			$settings['codeEditingEnabled'] = false;
		}
		return $settings;
	}
}
