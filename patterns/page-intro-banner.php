<?php
/**
 * Title: Page Intro Banner
 * Slug: spotlight-theme-2026/page-intro-banner
 * Categories: spotlight
 * Keywords: page, intro, banner, hero, breadcrumbs
 * Description: Full-width dark banner with breadcrumbs, page title, and intro copy, for page.html (static pages). Fills the hero section page.html currently has none of.
 * Inserter: true
 * Template Types: page
 *
 * @package spotlight-theme-2026
 *
 * Padding: outer spacing--20/100/20/20 (asymmetric, per Figma). Background
 * photo deferred (accent-600 solid for now) — Zared hasn't confirmed the
 * real image yet. Breadcrumb gap is a literal 3px per Figma, off the
 * scale. The wide wrapper's blockGap is explicitly "0", not omitted —
 * omitting it let theme.json's global constrained-layout default
 * (margin-block-start:spacing--30 on every non-first child) sneak in on
 * top of the breadcrumb's own padding-bottom, doubling the gap.
 *
 * post-title stays level:1 (real H1, only font-size overridden) for a11y.
 *
 * post-excerpt removed 2026-09-04 per Zared — no intro copy under the title.
 */

?>
<!-- wp:group {"align":"full","className":"page-intro-banner","backgroundColor":"accent-600","textColor":"neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|100","left":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull page-intro-banner has-neutral-100-color has-accent-600-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--100);padding-left:var(--wp--preset--spacing--20)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"800px","justifyContent":"left"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"page-intro-banner__breadcrumbs","style":{"spacing":{"blockGap":"3px","padding":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"100"} -->
		<div class="wp-block-group page-intro-banner__breadcrumbs has-100-font-size" style="padding-bottom:var(--wp--preset--spacing--50)">
			<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"},"typography":{"textDecoration":"none"}}}}} -->
			<p class="has-link-color"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--wp--preset--color--neutral-100)"><?php echo esc_html__( 'Home', 'spotlight-theme-2026' ); ?></a></p>
			<!-- /wp:paragraph -->

			<!-- wp:image {"className":"spotlight-breadcrumb-icon","width":"12px","height":"12px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized spotlight-breadcrumb-icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/caret-right.svg' ) ); ?>" alt="" style="width:12px;height:12px" /></figure>
			<!-- /wp:image -->

			<!-- wp:post-title {"level":0} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":1,"fontSize":"500","textColor":"neutral-100"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
