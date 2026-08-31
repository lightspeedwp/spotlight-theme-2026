<?php
/**
 * Title: Archive Listing Header (Category/Tag)
 * Slug: spotlight-theme-2026/archive-listing-header-archive
 * Categories: spotlight
 * Keywords: archive, listing, banner, search, category, tag, breadcrumbs
 * Description: Full-width dark banner with breadcrumbs, title, and search, for archive.html (category/tag term pages). Uses wp:query-title since archive.html's queried object is a taxonomy term. home.html uses the separate archive-listing-header pattern instead, since its queried object is a real page.
 * Inserter: true
 * Template Types: archive
 *
 * @package spotlight-theme-2026
 *
 * wp:columns {"align":"wide"} with explicit percentages, same convention
 * as footer.html. Second column is 41.3% (545/1320, Figma's Dashboard
 * CTA width) — a fixed 545px starved the content column at in-between
 * viewport widths (cut off the search placeholder at 900px).
 * Embeds dashboard-promo-hero.php via require(), not wp:pattern — this
 * file is itself wp:pattern-referenced from archive.html, and a nested
 * wp:pattern silently drops on front-end render.
 *
 * Padding lives only on the outer group, not also on wp:columns (was
 * doubling the real vertical padding). Breadcrumb row's inline gap
 * ("Home" › caret › title) is a literal 3px per Figma, off the scale.
 * Breadcrumb→title/title→search gaps use padding-bottom, not margin or
 * blockGap — both proved unreliable here via DevTools.
 *
 * query-title stays level:1 (real H1, only font-size overridden) for
 * a11y; showPrefix:false since Figma never shows "Category:"/"Tag:".
 * No gap above the banner — confirmed flush against the nav in Figma.
 * Search radius/icon are CSS — core/search's border doesn't serialize.
 */

?>
<!-- wp:group {"align":"full","className":"archive-listing-header","backgroundColor":"accent-600","textColor":"neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull archive-listing-header has-neutral-100-color has-accent-600-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"bottom","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|100"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-bottom alignwide">
		<!-- wp:column {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|5"}}}} -->
		<div class="wp-block-column" style="padding-bottom:var(--wp--preset--spacing--5)">
			<!-- wp:group {"className":"archive-listing-header__breadcrumbs","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"blockGap":"3px"}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"100"} -->
			<div class="wp-block-group archive-listing-header__breadcrumbs has-100-font-size" style="padding-bottom:var(--wp--preset--spacing--30)">
				<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"}}}}} -->
				<p class="has-link-color"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--wp--preset--color--neutral-100)"><?php echo esc_html__( 'Home', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:image {"className":"spotlight-breadcrumb-icon","width":"12px","height":"12px","sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full is-resized spotlight-breadcrumb-icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/caret-right.svg' ) ); ?>" alt="" style="width:12px;height:12px" /></figure>
				<!-- /wp:image -->

				<!-- wp:query-title {"type":"archive","level":0,"showPrefix":false} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:query-title {"type":"archive","level":1,"fontSize":"500","className":"archive-listing-header__title","textColor":"neutral-100","showPrefix":false,"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|50"}}}} /-->

			<!-- wp:search
			<?php
			echo wp_json_encode(
				array(
					'label'          => __( 'Search', 'spotlight-theme-2026' ),
					'showLabel'      => false,
					'placeholder'    => __( 'Search articles, authors, or topics...', 'spotlight-theme-2026' ),
					'buttonText'     => __( 'Search', 'spotlight-theme-2026' ),
					'buttonPosition' => 'button-inside',
					'width'          => 550,
					'widthUnit'      => 'px',
				)
			);
			?>
			/-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"41.3%"} -->
		<div class="wp-block-column" style="flex-basis:41.3%">
<?php require __DIR__ . '/dashboard-promo-hero.php'; ?>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
