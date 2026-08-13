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

	// Add support for a custom logo in the header/footer wp:site-logo blocks.
	// No width/height constraints here — each wp:site-logo instance is sized
	// directly in its own pattern markup instead.
	add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'spotlight_theme_2026_setup' );

/**
 * Returns a cache-busting version string for a theme file.
 *
 * Uses the file's own last-modified time — the theme `Version` header isn't
 * bumped per asset edit, so it goes stale exactly like a literal would.
 * Falls back to the theme version if the file isn't readable (a partial
 * deploy, a permissions issue), so enqueueing never triggers a PHP warning.
 * Matches the same pattern used in kwv-theme-2026.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function spotlight_theme_2026_asset_version( $relative_path ) {
	$file  = get_theme_file_path( $relative_path );
	$mtime = is_readable( $file ) ? filemtime( $file ) : false;

	return (string) ( false !== $mtime ? $mtime : wp_get_theme()->get( 'Version' ) );
}

/**
 * Enqueues block assets on both the front end and in the editor (post
 * editor and Site Editor canvas alike).
 *
 * Add CSS and JS files to assets/css/ and assets/js/ and uncomment
 * the relevant lines below once those files exist.
 */
function spotlight_theme_2026_enqueue_assets() {
	// Icon and hover states for Spotlight's own custom core/button block-style variations.
	// No dependency on 'global-styles' here — that handle is only registered
	// during the front end's wp_enqueue_scripts flow, which never runs in
	// wp-admin, so declaring it as a dependency silently drops this
	// stylesheet from the block editor's iframe.
	wp_enqueue_style(
		'spotlight-theme-2026-custom-button',
		get_theme_file_uri( 'assets/css/custom-button.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/custom-button.css' )
	);

	// Icon and hover states for WordPress core/button's own "Fill"/"Outline" styles.
	wp_enqueue_style(
		'spotlight-theme-2026-core-button',
		get_theme_file_uri( 'assets/css/core-button.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/core-button.css' )
	);

	// Structural spacing for the header utility bar, trust-bar, and footer parts.
	wp_enqueue_style(
		'spotlight-theme-2026-template-parts',
		get_theme_file_uri( 'assets/css/template-parts.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/template-parts.css' )
	);

	// Overrides core/navigation-link's own color:inherit rule, which out-specifies
	// theme.json's generated link color styles.
	wp_enqueue_style(
		'spotlight-theme-2026-core-navigation',
		get_theme_file_uri( 'assets/css/core-navigation.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/core-navigation.css' )
	);

	// Add wp_enqueue_script() here when assets/js/main.js exists.
}
add_action( 'enqueue_block_assets', 'spotlight_theme_2026_enqueue_assets' );
