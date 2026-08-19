<?php
/**
 * Title: Story Card (Featured)
 * Slug: spotlight-theme-2026/story-card-featured
 * Categories: spotlight
 * Keywords: story, blog, post, card, article, special projects, featured, badge
 * Description: The editorial Card/Blog treatment plus the spotlight-badge image overlay. Used for the front page's "Special Projects" row, and for the Blog Landing Page grid's first card pending confirmation with Zared (see design.md).
 * Inserter: true
 * Block Types: core/post-template
 *
 * @package spotlight-theme-2026
 *
 * Sibling of story-card.php (default/boxed, no badge) and
 * story-card-editorial.php (same style as this one, no badge). This is the
 * only story-card variant with the image-overlay badge filled in, matching
 * every Special Projects instance checked in Figma ("In the Spotlight").
 * The badge is inlined via require(), not a nested wp:pattern block
 * reference — see hero-lead-story.php's header comment for why: a nested
 * wp:pattern loses the postId context spotlight-badge.php's core/post-terms
 * block needs inside a query loop.
 *
 * The badge overlay is positioned via assets/css/story-card.css
 * (.story-card__badge-overlay), not a block attribute — core/group has no
 * "position" style attribute, and the desired effect (floating over the
 * image's top-left corner) has no native block-attribute equivalent.
 *
 * core/post-featured-image's border support is __experimentalSkipSerialization
 * in its own block.json, so the image's corner radius is handled by
 * assets/css/story-card.css instead of a style.border.radius attribute.
 */

?>
<!-- wp:group {"tagName":"article","className":"story-card-featured","style":{"border":{"radius":"var:preset|border-radius|200"}},"layout":{"type":"default"}} -->
<article class="wp-block-group story-card-featured" style="border-radius:var(--wp--preset--border-radius--200)">
	<!-- wp:group {"className":"story-card__media","style":{"spacing":{"padding":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group story-card__media" style="padding:var(--wp--preset--spacing--10)">
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
		<!-- wp:post-terms {"term":"category","textColor":"brand-500","fontSize":"100","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.5px"},"elements":{"link":{"color":{"text":"var:preset|color|brand-500"},"typography":{"textDecoration":"none"}}}}} /-->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":4,"isLink":true,"textColor":"contrast","fontSize":"300","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|brand-500"}}}}}} /-->

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
