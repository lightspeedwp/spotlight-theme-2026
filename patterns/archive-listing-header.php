<?php
/**
 * Title: Archive Listing Header (Posts Page)
 * Slug: spotlight-theme-2026/archive-listing-header
 * Categories: spotlight
 * Keywords: archive, listing, banner, search, posts page, breadcrumbs
 * Description: Full-width dark banner with breadcrumbs, title, and search, for home.html (the Posts Page). Uses wp:post-title since home.html's queried object is a real page. archive.html uses the separate archive-listing-header-archive pattern instead, since its queried object is a taxonomy term.
 * Inserter: true
 * Template Types: home
 *
 * @package spotlight-theme-2026
 *
 * Structure matches this theme's own trust-bar.html/footer.html: an
 * align:full outer band, then wp:columns {"align":"wide"} directly (no
 * extra wrapping group), with an explicit column width percentage — the
 * same mechanism footer.html already uses ("width":"30%" columns).
 *
 * The second (empty) column reserves space for the future dashboard-promo
 * pattern (PR 5), matching the Figma "Hero" frame's actual two-part layout
 * (content column + Dashboard CTA card).
 *
 * Breadcrumb→title gap is spacing--30; title→search gap is spacing--50 —
 * confirmed directly by the user against the Figma dev-mode spacing
 * annotations. Both use padding-bottom set directly on the block's own
 * style attribute, not margin/blockGap: WordPress's layout support zeroes
 * margin-block-end on every child of a default/constrained container and
 * doesn't reliably apply margin-block-start from blockGap either once a
 * competing rule (even one at similar specificity) is present — margin was
 * proven unreliable here through direct DevTools inspection. Padding has no
 * such conflict, and both wp:group and wp:post-title/wp:query-title
 * support spacing.padding as a real, serializing attribute.
 *
 * The column's own spacing--5 bottom padding matches the Figma "Content"
 * frame's own pb-[5px].
 *
 * post-title stays at its real level:1 — this heading is the only H1 on
 * home.html (there's no separate page title elsewhere on this template),
 * so the semantic H1 is kept for accessibility/SEO; only its visual
 * font-size is overridden to font-size--500, matching the Figma frame,
 * rather than changing heading level to get a smaller size.
 * No gap is added between this banner and the site header — confirmed
 * against the full "Blog Landing Page" Figma frame that the dark banner
 * sits flush against the nav with zero gap in the real design.
 * The search border-radius/icon are handled by
 * assets/css/archive-listing-header.css — core/search's border support
 * doesn't reliably serialize via attributes (__experimentalSkipSerialization).
 */

?>
<!-- wp:group {"align":"full","className":"archive-listing-header","backgroundColor":"accent-600","textColor":"neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull archive-listing-header has-neutral-100-color has-accent-600-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:column {"width":"45%","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|5"}}}} -->
		<div class="wp-block-column" style="padding-bottom:var(--wp--preset--spacing--5);flex-basis:45%">
			<!-- wp:group {"className":"archive-listing-header__breadcrumbs","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"100"} -->
			<div class="wp-block-group archive-listing-header__breadcrumbs has-100-font-size" style="padding-bottom:var(--wp--preset--spacing--30)">
				<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"}}}}} -->
				<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--wp--preset--color--neutral-100)"><?php echo esc_html__( 'Home', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:image {"className":"spotlight-breadcrumb-icon","width":"12px","height":"12px","sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full is-resized spotlight-breadcrumb-icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/caret-right.svg' ) ); ?>" alt="" style="width:12px;height:12px" /></figure>
				<!-- /wp:image -->

				<!-- wp:post-title {"level":0} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:post-title {"level":1,"fontSize":"500","className":"archive-listing-header__title","textColor":"neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|50"}}}} /-->

			<!-- wp:search
			<?php
			echo wp_json_encode(
				array(
					'label'          => __( 'Search', 'spotlight-theme-2026' ),
					'showLabel'      => false,
					'placeholder'    => __( 'Search articles, authors, or topics...', 'spotlight-theme-2026' ),
					'buttonText'     => __( 'Search', 'spotlight-theme-2026' ),
					'buttonPosition' => 'button-inside',
				)
			);
			?>
			/-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"55%"} -->
		<div class="wp-block-column" style="flex-basis:55%"></div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
