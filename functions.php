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
 * Resolves a tag slug encoded in a query block's namespace into that tag's
 * real term ID at render time.
 *
 * Generalizes the same technique as spotlight_theme_2026_resolve_hero_featured_tag()
 * for front-page.html's tag-filtered card rows (Special Projects, Perspectives)
 * instead of writing one dedicated filter per row. A query using this
 * mechanism sets its own "namespace" attribute to
 * "spotlight/tag-query/{tag-slug}" (e.g. "spotlight/tag-query/special-projects")
 * — the part after the last slash is the tag slug to resolve.
 *
 * Same safe-fallback behavior as the hero's filter: if the named tag
 * doesn't exist yet, the query is forced to zero results rather than left
 * unfiltered, so the row doesn't silently show unrelated latest posts.
 *
 * @param array $parsed_block The block being rendered.
 * @return array
 */
function spotlight_theme_2026_resolve_tag_query_namespace( $parsed_block ) {
	if ( 'core/query' !== $parsed_block['blockName'] ) {
		return $parsed_block;
	}

	$namespace = $parsed_block['attrs']['namespace'] ?? '';

	if ( ! str_starts_with( $namespace, 'spotlight/tag-query/' ) ) {
		return $parsed_block;
	}

	$slug = substr( $namespace, strlen( 'spotlight/tag-query/' ) );
	$tag  = get_term_by( 'slug', $slug, 'post_tag' );

	$parsed_block['attrs']['query']['taxQuery'] = array(
		'post_tag' => array( $tag instanceof WP_Term ? $tag->term_id : 0 ),
	);

	return $parsed_block;
}
add_filter( 'render_block_data', 'spotlight_theme_2026_resolve_tag_query_namespace' );

/**
 * Resolves a topic-band tile's target category into its real name, link,
 * and post count at render time.
 *
 * Each tile in patterns/topic-band.php and patterns/topic-band-compact.php
 * is a wp:group whose real WordPress `anchor` attribute (e.g.
 * "topic-band-hiv-aids") names which category slug it represents — a
 * curated, easy-to-edit list living directly in the pattern markup, not
 * this function. This filter looks that category up and swaps in its
 * live name/link/post-count, so a renamed category or a growing post
 * count is always shown correctly without ever needing a pattern-file
 * edit. Adding, removing, or reordering topics is done entirely in the
 * pattern files; this function only resolves whichever anchors it finds.
 *
 * If the named category doesn't exist yet (e.g. a fresh install), the
 * tile falls back to the pattern's own static placeholder content
 * instead of being resolved — matching this design's Figma content
 * exactly until the real category is created.
 *
 * The optional "topic-band__term-info--with-count" class on the same
 * group opts a tile into showing its post count (topic-band.php's
 * grid-with-counts variant); without it, only the name/link renders
 * (topic-band-compact.php's sidebar-list variant, which never shows a
 * count in the Figma design).
 *
 * @param array $parsed_block The block being rendered.
 * @return array
 */
function spotlight_theme_2026_resolve_topic_band_term( $parsed_block ) {
	if ( 'core/group' !== $parsed_block['blockName'] ) {
		return $parsed_block;
	}

	$anchor = $parsed_block['attrs']['anchor'] ?? '';

	if ( ! str_starts_with( $anchor, 'topic-band-' ) ) {
		return $parsed_block;
	}

	$slug = substr( $anchor, strlen( 'topic-band-' ) );
	$term = get_term_by( 'slug', $slug, 'category' );

	if ( ! ( $term instanceof WP_Term ) ) {
		return $parsed_block;
	}

	$class_name = $parsed_block['attrs']['className'] ?? '';
	$name_html  = sprintf(
		'<a class="topic-band__term-name" href="%1$s">%2$s</a>',
		esc_url( get_term_link( $term ) ),
		esc_html( $term->name )
	);
	$count_html = '';

	if ( str_contains( $class_name, 'topic-band__term-info--with-count' ) ) {
		$count_html = sprintf(
			'<span class="topic-band__term-count">%s</span>',
			esc_html(
				sprintf(
					/* translators: %s: number of articles in this topic (already formatted, e.g. "1,234"). */
					_n( '%s article', '%s articles', $term->count, 'spotlight-theme-2026' ),
					number_format_i18n( $term->count )
				)
			)
		);
	}

	$markup = sprintf(
		'<div id="%1$s" class="wp-block-group %2$s">%3$s%4$s</div>',
		esc_attr( $anchor ),
		esc_attr( $class_name ),
		$name_html,
		$count_html
	);

	$parsed_block['innerHTML']    = $markup;
	$parsed_block['innerContent'] = array( $markup );
	$parsed_block['innerBlocks']  = array();

	return $parsed_block;
}
add_filter( 'render_block_data', 'spotlight_theme_2026_resolve_topic_band_term' );

/**
 * Marks the topic-filter pill matching the current category archive.
 *
 * Core/term-template has no "current" class the way wp_list_categories()
 * does, so this compares the pill's own termId context against the page
 * actually being viewed.
 *
 * @param string   $block_content Rendered block HTML.
 * @param array    $parsed_block  The block being rendered.
 * @param WP_Block $block         Block instance (context is resolved by now).
 * @return string
 */
function spotlight_theme_2026_mark_current_topic_filter_pill( $block_content, $parsed_block, $block ) {
	$term_id = $block->context['termId'] ?? 0;

	if ( ! $term_id || ! is_category( $term_id ) ) {
		return $block_content;
	}

	$tags = new WP_HTML_Tag_Processor( $block_content );

	if ( $tags->next_tag( 'a' ) ) {
		$tags->add_class( 'is-current' );
	}

	return $tags->get_updated_html();
}
add_filter( 'render_block_core/term-name', 'spotlight_theme_2026_mark_current_topic_filter_pill', 10, 3 );

/**
 * Hides a story-card's featured-image link from assistive technology.
 *
 * Each story-card variant links both its featured image and its title to
 * the same post — a sighted user sees one obvious card, but a screen
 * reader announces the same destination twice per card. The title link
 * already provides an accessible, clearly-labelled way to reach the post,
 * so the image's own link is hidden from assistive tech rather than
 * removed outright (sighted/mouse users still get the larger, familiar
 * click target).
 *
 * Scoped to post-featured-image blocks carrying the "story-card__featured-image"
 * class, not applied globally — other patterns (e.g. hero-lead-story.php)
 * that link both an image and a title make their own accessibility
 * decisions independently.
 *
 * @param string $block_content The block's rendered HTML.
 * @param array  $block         The block being rendered.
 * @return string
 */
function spotlight_theme_2026_hide_duplicate_card_image_link( $block_content, $block ) {
	if ( 'core/post-featured-image' !== $block['blockName'] ) {
		return $block_content;
	}

	if ( ! str_contains( $block['attrs']['className'] ?? '', 'story-card__featured-image' ) ) {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( 'a' ) ) {
		$processor->set_attribute( 'aria-hidden', 'true' );
		$processor->set_attribute( 'tabindex', '-1' );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block', 'spotlight_theme_2026_hide_duplicate_card_image_link', 10, 2 );

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

	// core/post-featured-image's border support doesn't reliably serialize
	// via block attributes, and core/group has no "position" attribute —
	// both needed for story-card/-editorial/-featured's image radius and
	// badge-overlay placement.
	wp_enqueue_style(
		'spotlight-theme-2026-story-card',
		get_theme_file_uri( 'assets/css/story-card.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/story-card.css' )
	);

	// spotlight_theme_2026_resolve_topic_band_term()'s render-time markup
	// has no inline styling of its own; tile alignment and name/count
	// typography live here instead.
	wp_enqueue_style(
		'spotlight-theme-2026-topic-band',
		get_theme_file_uri( 'assets/css/topic-band.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/topic-band.css' )
	);

	// core/query has no spacing support at all — home.html/archive.html's
	// post-listing query needs real CSS for its own padding.
	wp_enqueue_style(
		'spotlight-theme-2026-post-listing',
		get_theme_file_uri( 'assets/css/post-listing.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/post-listing.css' )
	);

	wp_enqueue_style(
		'spotlight-theme-2026-topic-filter',
		get_theme_file_uri( 'assets/css/topic-filter.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/topic-filter.css' )
	);

	wp_enqueue_style(
		'spotlight-theme-2026-pagination',
		get_theme_file_uri( 'assets/css/pagination.css' ),
		array(),
		spotlight_theme_2026_asset_version( 'assets/css/pagination.css' )
	);

	// Add wp_enqueue_script() here when assets/js/main.js exists.
}
add_action( 'enqueue_block_assets', 'spotlight_theme_2026_enqueue_assets' );
