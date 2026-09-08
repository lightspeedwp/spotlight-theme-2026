<?php
/**
 * Title: Hero Lead Story
 * Slug: spotlight-theme-2026/hero-lead-story
 * Categories: spotlight
 * Keywords: hero, featured, lead story, homepage
 * Description: The front page's primary lead-story treatment — pulls the post tagged "featured" and displays its badge, headline, excerpt, byline, date, and featured image in a two-column layout.
 * Inserter: true
 * Viewport Width: 1440
 *
 * @package spotlight-theme-2026
 *
 * Editorial convention: tag exactly one published post "featured" (built-in
 * post_tag taxonomy, no custom taxonomy needed). The core/query block's
 * taxQuery attribute only accepts numeric term IDs, never slugs, and the
 * "featured" tag's ID isn't known when the pattern file is authored (it
 * varies per install and doesn't exist until an editor creates it).
 * spotlight_theme_2026_resolve_hero_featured_tag() in functions.php
 * resolves the "featured" tag's real ID into this query at render time via
 * the render_block_data filter, matched by the "namespace" attribute below.
 *
 * Heading renders at level 3 — the Figma frame's font-size--600 is this
 * theme's global H3 style (see theme.json styles.elements.h3), not a
 * one-off override; using an actual H3 keeps this in sync with the theme's
 * type scale automatically.
 *
 * The Spotlight Badge below is inlined via require(), not a nested
 * wp:pattern block reference. core/pattern's render_block_core_pattern()
 * renders a referenced pattern's content through a fresh do_blocks() call
 * with no parent block context, so spotlight-badge.php's core/post-terms
 * block (which needs the postId context this query loop provides) would
 * render no terms if referenced that way instead. This is a context-loss
 * issue specific to context-dependent blocks, not a general pattern-nesting
 * failure — require() sidesteps it by inlining the markup directly into
 * this query loop's own render pass, while keeping spotlight-badge.php
 * independently registered and reusable elsewhere.
 *
 * core/group's layout attribute only accepts "default", "constrained",
 * "flex", or "grid" as its type — "flow" is not a real value and silently
 * breaks block preview/validation. Use "default" for plain vertical
 * stacking with no special layout behaviour.
 *
 * align:"wide" is set on the wp:query block, not the nested wp:columns.
 * wp:pattern inlines this file's content with no wrapper div, so wp:query
 * is the actual direct child of front-page.html's constrained-layout hero
 * group — confirmed via DevTools that wp-block-query, not wp-block-columns,
 * was the element getting max-width:content-size (800px) from WordPress's
 * layout support, which only targets direct children. align:"wide" on the
 * deeply-nested columns block was a no-op; its ancestor was already capped.
 *
 * The wp:query's own left/right spacing|50 padding (pre-dating the
 * theme.json blockGap fix) and several internal padding+blockGap pairs
 * doubling the same gap (badge→title measured 40px live, Figma wants 20px)
 * have been removed — verified against Figma node 234:6732. Text column
 * uses verticalAlignment:"center" instead of a fixed top/bottom padding,
 * matching Figma's exact center point against the image column.
 */

?>
<!-- wp:query {"align":"wide","query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"namespace":"spotlight/hero-lead-story"} -->
<div class="wp-block-query alignwide">
	<!-- wp:post-template -->
		<!-- wp:columns {"className":"hero-lead-story__row","verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-columns are-vertically-aligned-center hero-lead-story__row">
			<!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center">
				<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}}},"layout":{"type":"default"}} -->
					<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--20)">
						<?php require __DIR__ . '/spotlight-badge.php'; ?>
					</div>
					<!-- /wp:group -->

					<!-- wp:post-title {"level":3,"isLink":true,"textColor":"surface-dark-inner","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}},"elements":{"link":{"color":{"text":"var:preset|color|surface-dark-inner"}}}}} /-->

					<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:post-excerpt {"fontSize":"300"} /-->

						<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
						<div class="wp-block-group">
							<!-- wp:post-author-name {"fontSize":"100"} /-->

							<!-- wp:paragraph {"fontSize":"100"} -->
							<p class="has-100-font-size">·</p>
							<!-- /wp:paragraph -->

							<!-- wp:post-date {"fontSize":"100"} /-->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","scale":"cover","style":{"border":{"radius":"var:preset|border-radius|250"}}} /-->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
