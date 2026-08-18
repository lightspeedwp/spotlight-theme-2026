<?php
/**
 * Title: Story Card
 * Slug: spotlight-theme-2026/story-card
 * Categories: spotlight
 * Keywords: story, blog, post, card, article, grid
 * Description: The default "Card/Blog" treatment from Figma — white card background, small corner radius, no image-overlay badge. Used for home.html/archive.html's post-listing grid and the front page's "Latest news" row.
 * Inserter: true
 * Block Types: core/post-template
 *
 * @package spotlight-theme-2026
 *
 * Figma calls this component "Card/Blog", not "story-card" — the name here
 * is this theme's own, chosen to match the `story-card` requirement in
 * specs/pattern-library/spec.md. Two visually distinct sibling variants
 * exist: story-card-editorial.php (no card background, larger radius, no
 * badge — Perspectives) and story-card-featured.php (same editorial style,
 * plus the spotlight-badge overlay — Special Projects). Confirmed directly
 * against Figma instances across all three rows plus the Blog Landing
 * Page's own Cards Grid — content structure (image, category label, title,
 * excerpt, author/date) is identical across all three; only the outer
 * background/radius and the badge presence differ.
 *
 * core/post-featured-image's border support is __experimentalSkipSerialization
 * in its own block.json, so a style.border.radius attribute here would
 * silently not serialize — assets/css/story-card.css handles the image's
 * corner radius (and the featured variant's badge-overlay positioning)
 * with real CSS instead.
 *
 * The category label below the image is plain core/post-terms output
 * (brand-500 text, uppercase, no background/padding/border) — confirmed
 * distinct from the spotlight-badge pill (see spotlight-badge.php), not a
 * shared or duplicated component, per the Special Projects Figma section.
 *
 * Whether home.html/archive.html's grid should feature story-card-featured
 * for its first post (confirmed present in the Blog Landing Page Figma
 * frame) is an open question pending Zared's confirmation — see design.md.
 * This pattern renders every post identically until that's resolved.
 */

?>
<!-- wp:group {"className":"story-card","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|100"}},"layout":{"type":"default"}} -->
<div class="wp-block-group story-card has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--100)">
	<!-- wp:group {"className":"story-card__media","style":{"spacing":{"padding":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group story-card__media" style="padding:var(--wp--preset--spacing--10)">
		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","scale":"cover"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"story-card__content","style":{"spacing":{"padding":"var:preset|spacing|10","blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group story-card__content" style="padding:var(--wp--preset--spacing--10)">
		<!-- wp:post-terms {"term":"category","textColor":"brand-500","fontSize":"100","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.5px"},"elements":{"link":{"color":{"text":"var:preset|color|brand-500"},"typography":{"textDecoration":"none"}}}}} /-->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":4,"isLink":true,"fontSize":"300"} /-->

			<!-- wp:post-excerpt {"fontSize":"200"} /-->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"flex","flexWrap":"wrap"},"fontSize":"100","textColor":"neutral-600"} -->
			<div class="wp-block-group has-neutral-600-color has-text-color has-100-font-size">
				<!-- wp:post-author-name /-->

				<!-- wp:paragraph -->
				<p>·</p>
				<!-- /wp:paragraph -->

				<!-- wp:post-date /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
