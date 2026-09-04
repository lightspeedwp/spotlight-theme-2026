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
 * Query excludes the post being viewed via core/query's native
 * excludeCurrent (WP 7.1+), so it never appears in its own
 * recent-stories list.
 *
 * Title row reuses front-page.html's section-header markup (heading +
 * flex-filling divider, see section-header.css) with no "Read more"
 * button — the divider's flex:1 1 auto just fills the extra space.
 */

?>
<!-- wp:group {"className":"related-coverage","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group related-coverage alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--20)">
	<!-- wp:group {"className":"section-header","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
	<div class="wp-block-group section-header">
		<!-- wp:heading {"level":2,"textColor":"accent-500","fontSize":"500","style":{"typography":{"fontWeight":"var(--wp--custom--font-weight--medium)","lineHeight":"var(--wp--custom--line-height--heading)","letterSpacing":"0.3px"}}} -->
		<h2 class="wp-block-heading has-accent-500-color has-text-color has-500-font-size" style="font-weight:var(--wp--custom--font-weight--medium);line-height:var(--wp--custom--line-height--heading);letter-spacing:0.3px"><?php echo esc_html__( 'Recent stories', 'spotlight-theme-2026' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:separator {"className":"section-header__divider is-style-wide","backgroundColor":"neutral-300"} -->
		<hr class="wp-block-separator has-text-color has-neutral-300-color has-alpha-channel-opacity has-neutral-300-background-color has-background section-header__divider is-style-wide"/>
		<!-- /wp:separator -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"query":{"perPage":3,"postType":"post","order":"desc","orderBy":"date","inherit":false,"excludeCurrent":true}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3},"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
<?php require __DIR__ . '/story-card-editorial.php'; ?>
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
