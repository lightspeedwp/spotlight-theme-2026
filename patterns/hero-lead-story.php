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
 * wp:pattern block reference — a wp:pattern reference nested inside
 * another pattern's content silently fails to resolve on front-end
 * template render (WordPress pattern-nesting limitation). require() keeps
 * spotlight-badge.php independently registered and reusable elsewhere
 * while inlining its markup here.
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
 */

?>
<!-- wp:query {"align":"wide","style":{"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"namespace":"spotlight/hero-lead-story"} -->
<div class="wp-block-query alignwide" style="padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:post-template -->
		<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-columns">
			<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
			<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}}},"layout":{"type":"default"}} -->
					<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--20)">
						<?php require __DIR__ . '/spotlight-badge.php'; ?>
					</div>
					<!-- /wp:group -->

					<!-- wp:post-title {"level":3,"isLink":true,"textColor":"surface-dark-inner","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}},"elements":{"link":{"color":{"text":"var:preset|color|surface-dark-inner"}}}}} /-->

					<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:post-excerpt {"fontSize":"300","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|20"}}}} /-->

						<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
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
				<!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"var:preset|border-radius|250"}}} /-->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
