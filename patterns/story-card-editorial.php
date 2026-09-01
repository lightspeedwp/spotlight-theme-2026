<?php
/**
 * Title: Story Card (Editorial)
 * Slug: spotlight-theme-2026/story-card-editorial
 * Categories: spotlight
 * Keywords: story, blog, post, card, article, editorial, perspectives
 * Description: The "editorial" Card/Blog treatment from Figma — no card background, larger corner radius. Used for the front page's "Perspectives" and "Special Projects" rows, and home.html/archive.html's own post-listing grid.
 * Inserter: true
 * Block Types: core/post-template
 *
 * @package spotlight-theme-2026
 *
 * Sibling of story-card.php (boxed background, smaller radius — "Latest
 * news" row only). Confirmed directly against the Perspectives Figma
 * instances: same content structure as story-card.php, but no card
 * background (sits transparent on the section) and a larger radius —
 * border-radius--200 on the card, border-radius--300 on the image, versus
 * story-card.php's border-radius--100 on both.
 *
 * The badge overlay (spotlight-badge.php, require()'d) is conditional —
 * it renders nothing for a post with no special_project term, and the red
 * pill for one that does, regardless of which row/grid this card is in
 * (Zared confirmed 2026-09-01: badge is a property of the post, not the
 * section — story-card-featured.php, the old badge-always-shown variant
 * scoped to Special Projects only, was retired in favor of this).
 *
 * Also confirmed directly against Figma to be home.html/archive.html's
 * own grid style, not story-card.php's boxed one — checked two non-first
 * cards in that grid, both matched this editorial treatment exactly (no
 * background, same 8px/16px radius). The original assumption that the
 * general grid and "Latest news" shared the boxed style was wrong.
 *
 * core/post-featured-image's border support is __experimentalSkipSerialization
 * in its own block.json, so the image's corner radius is handled by
 * assets/css/story-card.css instead of a style.border.radius attribute.
 * That same file also positions the image absolute/inset:0 within
 * story-card__media (bleeding to its true edge, ignoring any padding) —
 * confirmed against Figma; no padding on this group by design.
 */

?>
<!-- wp:group {"tagName":"article","className":"story-card-editorial","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<article class="wp-block-group story-card-editorial" style="border-radius:var(--wp--preset--border-radius--200)">
	<!-- wp:group {"className":"story-card__media","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
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
			<!-- wp:post-title {"level":3,"isLink":true,"textColor":"contrast","fontSize":"300","style":{"typography":{"fontWeight":"var(--wp--custom--font-weight--medium)","lineHeight":"var(--wp--custom--line-height--heading)","letterSpacing":"-0.02px"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|brand-500"}}}}}} /-->

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
