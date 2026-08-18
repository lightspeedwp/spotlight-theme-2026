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

	// Pages don't have excerpt support by default. page-intro-banner.php uses
	// core/post-excerpt for its intro copy so editors can write dedicated,
	// separate intro text per page; without this, the Excerpt field never
	// appears in the editor and the block silently falls back to
	// auto-generated content trimmed from the page body.
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'spotlight_theme_2026_setup' );

/**
 * Registers the theme's block pattern category.
 *
 * Guarded against an already-registered "spotlight" slug — registering a
 * duplicate category name triggers a PHP notice, and another plugin or a
 * future centralized registration could plausibly claim the same slug.
 */
function spotlight_theme_2026_register_pattern_categories() {
	if ( WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'spotlight' ) ) {
		return;
	}

	register_block_pattern_category(
		'spotlight',
		array( 'label' => __( 'Spotlight', 'spotlight-theme-2026' ) )
	);
}
add_action( 'init', 'spotlight_theme_2026_register_pattern_categories' );

/**
 * Resolves the "featured" tag's real term ID into the Hero Lead Story
 * pattern's query at render time.
 *
 * The core/query block's taxQuery attribute only accepts numeric term IDs,
 * never slugs, and the "featured" tag's ID isn't known when the pattern file is
 * authored (it varies per install and doesn't exist until an editor
 * creates it). This filter looks the ID up by slug just before the block
 * renders, so patterns/hero-lead-story.php can stay portable and
 * slug-based instead of hardcoding an ID.
 *
 * If the "featured" tag doesn't exist yet (a fresh install, or before an
 * editor has tagged anything), the query is forced to return zero results
 * rather than left unfiltered — otherwise the hero would silently show the
 * latest post as if it were featured, which is incorrect on every install
 * until the tag is actually created and used.
 *
 * @param array $parsed_block The block being rendered.
 * @return array
 */
function spotlight_theme_2026_resolve_hero_featured_tag( $parsed_block ) {
	if (
		'core/query' !== $parsed_block['blockName']
		|| 'spotlight/hero-lead-story' !== ( $parsed_block['attrs']['namespace'] ?? '' )
	) {
		return $parsed_block;
	}

	$featured_tag = get_term_by( 'slug', 'featured', 'post_tag' );

	// A term ID of 0 never matches a real term, forcing zero results instead
	// of an unfiltered (and therefore incorrectly "featured") query.
	$parsed_block['attrs']['query']['taxQuery'] = array(
		'post_tag' => array( $featured_tag instanceof WP_Term ? $featured_tag->term_id : 0 ),
	);

	return $parsed_block;
}
add_filter( 'render_block_data', 'spotlight_theme_2026_resolve_hero_featured_tag' );

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

	// Overrides core/navigation-link's own color:inherit rule, which out-specifies
	// theme.json's generated link color styles.
	wp_enqueue_style(
		'spotlight-theme-2026-core-navigation',
		get_theme_file_uri( 'assets/css/core-navigation.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/core-navigation.css' )
	);

	// Makes the Spotlight Badge (core/post-terms) hug its content width
	// instead of stretching to fill its block-level <div> wrapper.
	wp_enqueue_style(
		'spotlight-theme-2026-spotlight-badge',
		get_theme_file_uri( 'assets/css/spotlight-badge.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/spotlight-badge.css' )
	);

	// core/search's border support doesn't reliably serialize via block
	// attributes, and core/group has no max-width attribute — both need
	// real CSS for the archive-listing-header patterns' width/radius/icon.
	wp_enqueue_style(
		'spotlight-theme-2026-archive-listing-header',
		get_theme_file_uri( 'assets/css/archive-listing-header.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/archive-listing-header.css' )
	);

	// Shared line-height:0 fix for the breadcrumb separator icon
	// (core/image has no style support for it), reused by
	// archive-listing-header, archive-listing-header-archive, and
	// page-intro-banner instead of duplicating the rule per pattern.
	wp_enqueue_style(
		'spotlight-theme-2026-breadcrumb-icon',
		get_theme_file_uri( 'assets/css/spotlight-breadcrumb-icon.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/spotlight-breadcrumb-icon.css' )
	);

	// Add wp_enqueue_script() here when assets/js/main.js exists.
}
add_action( 'enqueue_block_assets', 'spotlight_theme_2026_enqueue_assets' );
