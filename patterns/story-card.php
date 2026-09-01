<?php
/**
 * Title: Story Card
 * Slug: spotlight-theme-2026/story-card
 * Categories: spotlight
 * Keywords: story, blog, post, card, article, grid
 * Description: The default "Card/Blog" treatment from Figma — white card background, small corner radius, no image-overlay badge. Used for the front page's "Latest news" row only.
 * Inserter: true
 * Block Types: core/post-template
 *
 * @package spotlight-theme-2026
 *
 * Figma calls this component "Card/Blog", not "story-card" — the name here
 * is this theme's own, chosen to match the `story-card` requirement in
 * specs/pattern-library/spec.md. One visually distinct sibling variant
 * exists: story-card-editorial.php (no card background, larger radius —
 * Perspectives, and also home.html/archive.html's own grid). Content
 * structure (image, category label, title, excerpt, author/date) is
 * identical across both; only the outer background/radius differs.
 *
 * Confirmed directly against Figma that home.html/archive.html's grid uses
 * the editorial style, not this boxed one — checked two separate non-first
 * cards in that grid (not just the first/featured one), both had no
 * background and the 8px/16px editorial radius. The original assumption
 * that "Latest news" and the general grid shared this same boxed
 * treatment was wrong; only "Latest news" actually uses it.
 *
 * core/post-featured-image's border support is __experimentalSkipSerialization
 * in its own block.json, so a style.border.radius attribute here would
 * silently not serialize — assets/css/story-card.css handles the image's
 * corner radius (and the badge-overlay positioning) with real CSS instead.
 *
 * The badge overlay (spotlight-badge.php, require()'d) is conditional —
 * it renders nothing for a post with no special_project term, and the
 * red pill for one that does, regardless of which row/grid this card is
 * in (Zared confirmed 2026-09-01: badge is a property of the post, not
 * the section — story-card-featured.php, the old badge-always-shown
 * variant, was retired). Its inset assumes story-card__media has its own
 * padding, matching story-card-editorial.php — this card's image sits
 * flush at the top instead, so the badge's exact position here is
 * unverified against Figma and may need a follow-up tweak.
 *
 * The category label below the image is plain core/post-terms output
 * (brand-500 text, uppercase, no background/padding/border) — confirmed
 * distinct from the spotlight-badge pill, not a shared or duplicated
 * component. Carries the is-style-card-links style so
 * spotlight_theme_2026_show_primary_category_only() in functions.php
 * collapses it to the post's Yoast Primary Category when it has more
 * than one.
 */

?>
<!-- wp:group {"tagName":"article","className":"story-card","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|100"}},"layout":{"type":"default"}} -->
<article class="wp-block-group story-card has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--100)">
	<!-- wp:group {"className":"story-card__media","layout":{"type":"default"}} -->
	<div class="wp-block-group story-card__media">
		<!-- wp:post-featured-image {"className":"story-card__featured-image","isLink":true,"aspectRatio":"3/2","scale":"cover"} /-->

		<!-- wp:group {"className":"story-card__badge-overlay","layout":{"type":"default"}} -->
		<div class="wp-block-group story-card__badge-overlay">
<?php require __DIR__ . '/spotlight-badge.php'; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"story-card__content","style":{"spacing":{"padding":"var:preset|spacing|10","blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group story-card__content" style="padding:var(--wp--preset--spacing--10)">
		<!-- wp:post-terms {"term":"category","className":"is-style-card-links","textColor":"brand-500","fontSize":"100","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.5px"},"elements":{"link":{"color":{"text":"var:preset|color|brand-500"},"typography":{"textDecoration":"none"}}}}} /-->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":3,"isLink":true,"textColor":"contrast","fontSize":"300","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|brand-500"}}}}}} /-->

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
</article>
<!-- /wp:group -->
