<?php
/**
 * Spotlight Theme 2026 functions and definitions.
 *
 * @package spotlight-theme-2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme supports.
 */
function spotlight_theme_2026_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'spotlight-theme-2026', get_template_directory() . '/languages' );

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'spotlight_theme_2026_setup' );

/**
 * Enqueues front-end assets.
 *
 * Add CSS and JS files to assets/css/ and assets/js/ and uncomment
 * the relevant lines below once those files exist.
 */
function spotlight_theme_2026_enqueue_assets() {
	// Main stylesheet (the theme header stylesheet is loaded automatically).
	// Add wp_enqueue_style() here when assets/css/main.css exists.

	// Add wp_enqueue_script() here when assets/js/main.js exists.
}
add_action( 'wp_enqueue_scripts', 'spotlight_theme_2026_enqueue_assets' );
