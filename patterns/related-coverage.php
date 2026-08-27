<?php
/**
 * Title: Related Coverage
 * Slug: spotlight-theme-2026/related-coverage
 * Categories: spotlight
 * Keywords: recent, related, stories, coverage, single post
 * Description: single.html's "Recent stories" card row — the three most recent posts, excluding the one being viewed.
 * Inserter: true
 * Template Types: single
 *
 * @package spotlight-theme-2026
 *
 * Replaces the ad-hoc, unstyled card markup single.html previously had
 * inline (plain post-featured-image/post-terms/post-title/post-excerpt
 * with no card treatment) with story-card-editorial.php's markup,
 * reused via require() rather than duplicated — this is a .php pattern
 * file, so require() is available here, unlike the .html templates
 * that had to inline story-card's markup directly when wiring it into
 * a query loop (see design.md).
 *
 * Self-contained: owns its own wp:query/wp:post-template, so
 * referencing this pattern via wp:pattern from single.html is safe.
 * The postId-context-loss bug documented in story-card's own header
 * only applies when a wp:pattern reference sits inside another
 * query's post-template loop, substituting per-item markup — this
 * pattern's query establishes its own context for its own loop
 * instead, the same as topic-band's safe case.
 *
 * Query uses the Advanced Query Loop plugin's exclude_current option
 * so the post being viewed never appears in its own recent-stories
 * list — same mechanism the replaced placeholder markup already used.
 */

?>
<!-- wp:group {"className":"related-coverage","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group related-coverage">
	<!-- wp:heading {"level":3,"fontSize":"300"} -->
	<h3 class="wp-block-heading has-300-font-size"><?php echo esc_html__( 'Recent stories', 'spotlight-theme-2026' ); ?></h3>
	<!-- /wp:heading -->

	<!-- wp:query {"query":{"perPage":3,"postType":"post","order":"desc","orderBy":"date","inherit":false,"exclude_current":true},"namespace":"advanced-query-loop"} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3},"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
<?php require __DIR__ . '/story-card-editorial.php'; ?>
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
