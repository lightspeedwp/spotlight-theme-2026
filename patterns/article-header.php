<?php
/**
 * Title: Article Header
 * Slug: spotlight-theme-2026/article-header
 * Categories: spotlight
 * Keywords: single post, article, header, hero, badge, byline, featured image
 * Description: single.html's full-width intro section — badge + category, title, author/tag/date meta row, featured image with caption, and a subtitle paragraph.
 * Inserter: true
 * Template Types: single
 *
 * @package spotlight-theme-2026
 *
 * Self-contained singular-post context (post-title/post-terms/post-author/
 * post-date/post-featured-image all resolve against the currently queried
 * post directly, not a query loop) — safe to reference via wp:pattern from
 * single.html, unlike story-card's query-loop case.
 *
 * Badge reused via require() (this is a .php pattern, unlike single.html
 * itself) instead of duplicated raw markup. It's conditional on the post's
 * special_project term (renders nothing if unset) and independent of the
 * plain-text category label beside it — same dual-label convention used
 * on story-card.php/story-card-editorial.php.
 *
 * The small text below the author name (a tag/section label per Figma,
 * exact source unconfirmed) is a placeholder pending Zared's confirmation
 * of what it actually represents — do not treat as resolved.
 *
 * Meta row's border and the featured image's radius are real CSS
 * (assets/css/article-header.css), not block style attributes — same
 * fix as republish-notice.php/newsletter-signup.php for borders, and
 * post-featured-image's own border support being unavailable as an
 * attribute (see story-card-editorial.php).
 *
 * Featured image height is fixed on desktop (34.375rem) but switches to
 * a 3/2 aspect-ratio below 782px instead of a second fixed number, since
 * Figma has no mobile frame for this section.
 *
 * Image caption comes from the attachment's own Caption field, not alt
 * text (alt is accessibility-only, not editorial copy) — appended via
 * spotlight_theme_2026_add_article_header_image_caption() in
 * functions.php, since core/post-featured-image has no native caption
 * display. Renders nothing until an editor fills that field in.
 */

?>
<!-- wp:group {"className":"article-header","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group article-header" style="margin-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"className":"article-header__intro","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group article-header__intro">
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group">
<?php require __DIR__ . '/spotlight-badge.php'; ?>

			<!-- wp:post-terms {"term":"category","className":"is-style-card-links","textColor":"brand-500","fontSize":"200","style":{"typography":{"fontWeight":"600","textTransform":"uppercase","letterSpacing":"0.5px"},"elements":{"link":{"color":{"text":"var:preset|color|brand-500"},"typography":{"textDecoration":"none"}}}}} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-title {"level":1,"textColor":"surface-dark-inner","fontSize":"600","style":{"typography":{"fontWeight":"600","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.5px"}}} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"article-header__meta","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"},"margin":{"top":"var:preset|spacing|20"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
	<div class="wp-block-group article-header__meta" style="margin-top:var(--wp--preset--spacing--20);padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:post-author {"showAvatar":false,"fontSize":"200"} /-->

			<!-- wp:paragraph {"className":"article-header__section-tag","fontSize":"100","textColor":"neutral-600"} -->
			<p class="article-header__section-tag has-neutral-600-color has-text-color has-100-font-size"><?php echo esc_html__( 'News & Features', 'spotlight-theme-2026' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-date {"fontSize":"100"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"article-header__media","style":{"spacing":{"blockGap":"var:preset|spacing|10","margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group article-header__media" style="margin-top:var(--wp--preset--spacing--40)">
		<!-- wp:post-featured-image {"className":"article-header__featured-image","isLink":false,"scale":"cover"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"article-header__subtitle","style":{"typography":{"fontWeight":"600","lineHeight":"var:custom|line-height|heading"},"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"neutral-900","fontSize":"300"} -->
	<p class="article-header__subtitle has-neutral-900-color has-text-color has-300-font-size" style="margin-top:var(--wp--preset--spacing--20);font-weight:600"><?php echo esc_html__( 'South Africa has launched the most promising new HIV-prevention tool in years. But the systems built to reach the people who need it most have been quietly dismantled.', 'spotlight-theme-2026' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
