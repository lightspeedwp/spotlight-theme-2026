<?php
/**
 * Title: Story Card (Editorial)
 * Slug: spotlight-theme-2026/story-card-editorial
 * Categories: spotlight
 * Keywords: story, blog, post, card, article, editorial, perspectives
 * Description: The "editorial" Card/Blog treatment from Figma — no card background, larger corner radius, no image-overlay badge. Used for the front page's "Perspectives" row.
 * Inserter: true
 * Block Types: core/post-template
 *
 * @package spotlight-theme-2026
 *
 * Sibling of story-card.php (default/boxed, no badge) and
 * story-card-featured.php (this same editorial style, plus the
 * spotlight-badge overlay). Confirmed directly against the Perspectives
 * Figma instances: same content structure as story-card.php, but no card
 * background (sits transparent on the section) and a larger radius —
 * border-radius--200 on the card, border-radius--300 on the image, versus
 * story-card.php's border-radius--100 on both. The badge-overlay slot
 * exists in the Figma component here too, but is empty in every
 * Perspectives instance checked — Special Projects is the only row that
 * fills it, hence story-card-featured.php being a separate file rather
 * than a toggle on this one.
 *
 * core/post-featured-image's border support is __experimentalSkipSerialization
 * in its own block.json, so the image's corner radius is handled by
 * assets/css/story-card.css instead of a style.border.radius attribute.
 */

?>
<!-- wp:group {"className":"story-card-editorial","style":{"border":{"radius":"var:preset|border-radius|200"}},"layout":{"type":"default"}} -->
<div class="wp-block-group story-card-editorial" style="border-radius:var(--wp--preset--border-radius--200)">
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
