<?php
/**
 * Title: Project Entry
 * Slug: spotlight-theme-2026/project-entry
 * Categories: spotlight
 * Keywords: story, blog, post, card, article, special projects, badge
 * Description: The front page's "Special Projects" row card — Figma's "Card/Blog" component, given its own file per Zared (2026-09-01) since Special Projects owns this row even though the treatment matches story-card-editorial.php exactly.
 * Inserter: true
 * Block Types: core/post-template
 *
 * @package spotlight-theme-2026
 *
 * Reuses the story-card-editorial className, not a new one — confirmed
 * against Figma (node 234:6732) it's the same Card/Blog component as
 * story-card-editorial.php, so one shared CSS surface instead of a
 * duplicate selector set for an identical card.
 *
 * The "Special Projects" heading lives in front-page.html, not here.
 *
 * Badge overlay (spotlight-badge.php) is conditional on the post's
 * special_project term, same as every other story-card variant.
 *
 * Deferred, style-only, not yet applied here or in story-card-editorial.php/
 * story-card.php: Figma's title style adds font-weight 500, line-height
 * 1.25, letter-spacing -0.02px, not just the fontSize/textColor set below.
 *
 * blockGap:"0" on both the article and story-card__media, not omitted —
 * omitting it let WordPress's global flow-layout margin-block-start
 * (spacing--30) land on each group's second child (the badge, and
 * story-card__content), same class of bug as page-intro-banner.php's.
 *
 * story-card__media has no padding by design — assets/css/story-card.css
 * positions the image absolute/inset:0, bleeding to the wrapper's true
 * edge, confirmed against Figma; padding here would do nothing for the
 * image and only misalign the badge from it.
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
