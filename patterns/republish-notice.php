<?php
/**
 * Title: Republish Notice
 * Slug: spotlight-theme-2026/republish-notice
 * Categories: spotlight
 * Keywords: republish, creative commons, cc, license, attribution
 * Description: single.html's in-article "Republish this article, for free" notice — the CC BY-ND 4.0 attribution copy plus plugin-compatible button/modal markup matching the Creative Commons Post Republisher plugin's expected structure, so the button and its modal actually work.
 * Inserter: false
 * Template Types: single
 *
 * @package spotlight-theme-2026
 *
 * The button/modal markup below is plain HTML, not a wp:cc/post-republisher
 * block comment — that block's save() returns real content, and a
 * self-closing reference stores none, which both breaks the front-end
 * button and shows "invalid content" in the editor. The plugin's modal
 * JS only looks for these element IDs, not a real block instance, so
 * plain HTML works identically. Everything else here is authored
 * directly, confirmed against Figma — the plugin itself only ever
 * renders the button/modal, nothing else.
 *
 * The button's look reuses styles/blocks/button/republish-article.json's
 * exact values; that style variation's class can't apply directly since
 * the plugin's button isn't a core/button — see
 * assets/css/republish-notice.css instead.
 *
 * Inserter: false — single.html already inserts this pattern on every
 * post. Leaving it inserter-visible would let an editor drag a second
 * copy into a post's content, duplicating the plugin's fixed DOM IDs
 * and reintroducing the exact "which modal opens" bug already fixed
 * once by removing the plugin's own auto-injected duplicate.
 *
 * Heading is h3, not h4 — this sits after arbitrary wp:post-content with
 * no guaranteed heading hierarchy above it, so h4 could skip a level
 * depending on the article body. h3 matches single.html's sibling
 * "Recent stories" heading, treating both as parallel in-article
 * utility sections rather than nested under unpredictable content.
 */

?>
<!-- wp:group {"className":"republish-notice","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group republish-notice" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
	<!-- wp:group {"className":"republish-notice__icon","layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-group republish-notice__icon">
		<!-- wp:paragraph {"fontSize":"100","style":{"typography":{"fontWeight":"var(--wp--custom--font-weight--extra-bold)"}}} -->
		<p class="has-100-font-size" style="font-weight:var(--wp--custom--font-weight--extra-bold)"><?php echo esc_html__( 'CC', 'spotlight-theme-2026' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":3,"fontSize":"200","style":{"typography":{"fontWeight":"500"}}} -->
			<h3 class="wp-block-heading has-200-font-size" style="font-weight:500"><?php echo esc_html__( 'Republish this article, for free', 'spotlight-theme-2026' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"100"} -->
			<p class="has-100-font-size"><?php echo esc_html__( "Spotlight publishes under a Creative Commons Attribution-NoDerivatives 4.0 licence. You're welcome to republish our articles online or in print, free of charge, provided you credit Spotlight and the author and don't edit the text.", 'spotlight-theme-2026' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<div>
			<button id="cc-post-republisher-modal-button-open"><span><?php echo esc_html__( 'Republish article', 'spotlight-theme-2026' ); ?></span></button>
			<div id="cc-post-republisher-modal-container">
				<div id="cc-post-republisher-modal"></div>
			</div>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
