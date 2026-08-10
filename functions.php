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
	add_theme_support(
		'custom-logo',
		array(
			'width'       => 291,
			'height'      => 72,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'spotlight_theme_2026_setup' );

/**
 * Registers a block-bindings source that outputs the current year, so the
 * footer copyright line never needs an annual manual update.
 *
 * register_block_bindings_source() requires WordPress 6.5+; this theme
 * declares 6.4 as its minimum, so the guard below lets the footer's bound
 * paragraph fall back to its static placeholder text on older WordPress
 * instead of a fatal error.
 */
function spotlight_theme_2026_register_block_bindings() {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}

	register_block_bindings_source(
		'spotlight-theme-2026/current-year',
		array(
			'label'              => __( 'Current Year', 'spotlight-theme-2026' ),
			'get_value_callback' => function () {
				return wp_date( 'Y' );
			},
		)
	);
}
add_action( 'init', 'spotlight_theme_2026_register_block_bindings' );

/**
 * Scopes single.html's "Recent stories" query to posts sharing a category
 * with the post currently being viewed. A post's categories vary per post,
 * so this can't be expressed as a static value in the query block's saved
 * attributes — the block's className marks which query loop to target.
 */
function spotlight_theme_2026_related_posts_query_vars( $query, $block ) {
	if ( empty( $block->attributes['className'] ) || false === strpos( $block->attributes['className'], 'related-posts-query' ) ) {
		return $query;
	}

	$categories = wp_get_post_categories( get_the_ID() );
	if ( ! empty( $categories ) ) {
		$query['category__in'] = $categories;
	}

	return $query;
}
add_filter( 'query_loop_block_query_vars', 'spotlight_theme_2026_related_posts_query_vars', 10, 2 );

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
		wp_get_theme()->get( 'Version' )
	);

	// Icon and hover states for WordPress core/button's own "Fill"/"Outline" styles.
	wp_enqueue_style(
		'spotlight-theme-2026-core-button',
		get_theme_file_uri( 'assets/css/core-button.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Icon treatment for the header utility bar, Dashboards CTA, and trust-bar parts.
	wp_enqueue_style(
		'spotlight-theme-2026-template-parts',
		get_theme_file_uri( 'assets/css/template-parts.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Add wp_enqueue_script() here when assets/js/main.js exists.
}
add_action( 'enqueue_block_assets', 'spotlight_theme_2026_enqueue_assets' );
