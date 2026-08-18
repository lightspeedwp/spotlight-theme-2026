<?php
/**
 * Title: Page Intro Banner
 * Slug: spotlight-theme-2026/page-intro-banner
 * Categories: spotlight
 * Keywords: page, intro, banner, hero, breadcrumbs
 * Description: Full-width dark banner with breadcrumbs, page title, and intro copy, for page.html (static pages). Fills the hero section page.html currently has none of.
 * Inserter: true
 * Template Types: page
 *
 * @package spotlight-theme-2026
 *
 * Values confirmed via Figma get_design_context on the "About Page"
 * Ready-for-Dev frame's Hero (node 50:6889), not estimated from raw
 * coordinates:
 * - Background #0c1a30 — Figma labels this "brand-600", but that hex
 *   matches this theme's accent-600 (theme.json), not the red-toned
 *   brand-600. Figma's own variable naming is out of sync with the
 *   implemented theme.json here; the real color is used.
 * - Padding is deliberately asymmetric: top spacing--20, bottom
 *   spacing--100, left/right spacing--20 — not a guess, confirmed from the
 *   frame's own Tailwind export (pt-20 pb-100 px-20).
 * - Background photo (same "abdulai-sayni-craybH44oWU-unsplash 2" stock
 *   placeholder as the Blog Landing Page hero, with a dark gradient
 *   overlay) is deferred — solid accent-600 only for now, per the user
 *   pending confirmation with Zared on the real image tomorrow.
 * - Breadcrumb separator is a real CaretRight icon (assets/icons/caret-
 *   right.svg, extracted from the Figma frame), not a literal "&gt;"
 *   character like archive-listing-header's breadcrumb — the two patterns
 *   genuinely differ here per their respective Figma frames.
 * - The title/intro-copy block is a fixed 800px in the design — exactly
 *   theme.json's contentSize. It's deliberately NOT align:"wide": as a
 *   plain child of the wide wrapper's "constrained" layout below
 *   (contentSize:"800px", justifyContent:"left"), core's own layout
 *   support constrains and left-aligns it automatically — no custom CSS
 *   needed. contentSize is spelled out explicitly since bare
 *   {"type":"constrained"} in static markup has no max-width effect;
 *   WordPress only fills that in from theme.json via the editor UI.
 *
 * wp:post-title stays at its real level:1 here (unlike
 * archive-listing-header's level:3) — this is the page's actual, primary
 * heading, not a supplementary listing heading, so the semantic H1 is
 * kept for accessibility/SEO; only its visual font-size is overridden to
 * match the smaller font-size--500 shown in the design.
 *
 * post-excerpt is used for the intro copy so it stays dynamic/editable
 * per page (via the standard Excerpt field), not hardcoded static text —
 * matching the same "keep patterns dynamic" approach used throughout this
 * pattern library.
 */

?>
<!-- wp:group {"align":"full","className":"page-intro-banner","backgroundColor":"accent-600","textColor":"neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|100","left":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull page-intro-banner has-neutral-100-color has-accent-600-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--100);padding-left:var(--wp--preset--spacing--20)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50","padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"800px","justifyContent":"left"}} -->
	<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
		<!-- wp:group {"className":"page-intro-banner__breadcrumbs","style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"100"} -->
		<div class="wp-block-group page-intro-banner__breadcrumbs has-100-font-size" style="padding-bottom:var(--wp--preset--spacing--50)">
			<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"}}}}} -->
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--wp--preset--color--neutral-100)"><?php echo esc_html__( 'Home', 'spotlight-theme-2026' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:image {"className":"spotlight-breadcrumb-icon","width":"12px","height":"12px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized spotlight-breadcrumb-icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/caret-right.svg' ) ); ?>" alt="" style="width:12px;height:12px" /></figure>
			<!-- /wp:image -->

			<!-- wp:post-title {"level":0} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":1,"fontSize":"500","textColor":"neutral-100","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60"}}}} /-->

			<!-- wp:post-excerpt {"fontSize":"400","textColor":"neutral-300"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
