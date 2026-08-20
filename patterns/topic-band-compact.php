<?php
/**
 * Title: Topic Band (Compact)
 * Slug: spotlight-theme-2026/topic-band-compact
 * Categories: spotlight
 * Keywords: topic, category, explore, sidebar, list
 * Description: single.html's "Explore topics" sidebar list — the same curated categories as topic-band.php, in a compact horizontal-row layout with no post count shown. A "Latest news" shortcut link (not a category) leads the list, matching Figma.
 * Inserter: true
 * Template Types: single
 *
 * @package spotlight-theme-2026
 *
 * Sibling of topic-band.php — see that file's header comment for the full
 * explanation of the render-time term resolution
 * (spotlight_theme_2026_resolve_topic_band_term() in functions.php) and
 * why the topic list is curated static markup rather than a live loop
 * over all categories.
 *
 * Two differences from topic-band.php, both confirmed against Figma's
 * "Single Blog Post" frame's sidebar:
 * - No "topic-band__term-info--with-count" class here, so the render
 *   filter never appends a post count — the sidebar design never shows
 *   one, unlike the front-page grid.
 * - The first item is "Latest news", not a category — a static shortcut
 *   link to the blog home, not run through the term-resolution filter at
 *   all (there's no "Latest news" taxonomy term to resolve).
 *
 * The heading here has no divider/"read more" link — confirmed against
 * Figma, the sidebar's "Explore topics" heading is plain text only.
 * Unlike topic-band.php's own heading (authored directly in front-page.html,
 * per design.md's Decisions), this one is baked into the pattern itself:
 * single.html uses this pattern in exactly one place, so there's no
 * cross-template duplication to avoid the way there is for the front
 * page's four repeated Category Header instances.
 *
 * The heading uses accent-500 (#10233f in theme.json), matching the
 * actual rendered color — confirmed directly with the user, same
 * value-over-label check already used in page-intro-banner.php.
 *
 * The outer wrapper has no background color, confirmed directly with the
 * user after testing.
 */

?>
<!-- wp:group {"className":"topic-band-compact","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group topic-band-compact" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"level":2,"textColor":"accent-500","fontSize":"500","style":{"typography":{"letterSpacing":"0.3px"},"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}}} -->
	<h2 class="wp-block-heading has-accent-500-color has-text-color has-500-font-size" style="letter-spacing:0.3px;padding-bottom:var(--wp--preset--spacing--40)"><?php echo esc_html__( 'Explore topics', 'spotlight-theme-2026' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-latest-news.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph -->
			<p><a class="topic-band__term-name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Latest news', 'spotlight-theme-2026' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-hiv-aids.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-hiv-aids","className":"topic-band__term-info","layout":{"type":"default"}} -->
			<div id="topic-band-hiv-aids" class="wp-block-group topic-band__term-info">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'HIV/AIDS', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-tuberculosis.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-tuberculosis","className":"topic-band__term-info","layout":{"type":"default"}} -->
			<div id="topic-band-tuberculosis" class="wp-block-group topic-band__term-info">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'Tuberculosis', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-nhi.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-nhi","className":"topic-band__term-info","layout":{"type":"default"}} -->
			<div id="topic-band-nhi" class="wp-block-group topic-band__term-info">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'NHI', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-access-to-medicines.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-access-to-medicines","className":"topic-band__term-info","layout":{"type":"default"}} -->
			<div id="topic-band-access-to-medicines" class="wp-block-group topic-band__term-info">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'Access to Medicines', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-healthcare-system.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-healthcare-system","className":"topic-band__term-info","layout":{"type":"default"}} -->
			<div id="topic-band-healthcare-system" class="wp-block-group topic-band__term-info">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'Healthcare System', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"topic-band-compact__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group topic-band-compact__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-ncds.svg' ) ); ?>" alt="" style="width:24px;height:24px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-ncds","className":"topic-band__term-info","layout":{"type":"default"}} -->
			<div id="topic-band-ncds" class="wp-block-group topic-band__term-info">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'NCDs', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
