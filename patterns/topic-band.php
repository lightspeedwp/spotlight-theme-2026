<?php
/**
 * Title: Topic Band
 * Slug: spotlight-theme-2026/topic-band
 * Categories: spotlight
 * Keywords: topic, category, explore, grid, counts
 * Description: The front page's "Explore by topic" grid — six curated category tiles with icon, name, and live post count. Sibling of topic-band-compact.php (sidebar-list, no counts, single.html's Explore topics).
 * Inserter: true
 * Template Types: front-page
 *
 * @package spotlight-theme-2026
 *
 * Confirmed directly against Figma's Homepage frame ("Explore by topic"
 * section, six "Spotlight/Article Card" tiles): HIV/AIDS, Tuberculosis,
 * NHI, Access to Medicines, Healthcare System, NCDs — each with a distinct
 * hand-drawn icon (assets/icons/topic-*.svg, extracted directly from
 * Figma's exported vector assets, some reassembled from multiple
 * overlapping vector fragments where Figma exported a composite icon as
 * separate pieces).
 *
 * The topic list (which categories appear, in what order, with which
 * icon) is intentionally curated here as static markup — WordPress has no
 * built-in way to attach a custom icon to a category, so there's no
 * "loop over all categories automatically" mechanism available. Adding,
 * removing, or reordering a topic is a plain edit to this file: copy one
 * wp:column block, change its icon path, anchor slug, and placeholder
 * text.
 *
 * What is NOT static: each tile's displayed name, link, and post count.
 * The wp:group wrapping each tile's text carries a real "anchor"
 * attribute naming the target category's slug (e.g. "topic-band-hiv-aids")
 * — spotlight_theme_2026_resolve_topic_band_term() in functions.php
 * resolves that slug into the category's live name/link/count at render
 * time, the same render-time-resolution technique hero-lead-story.php
 * uses for its featured-tag lookup. If a category is renamed or gains
 * posts, this pattern reflects that automatically; if the named category
 * doesn't exist yet, the tile falls back to the placeholder text below
 * (matching Figma) instead of showing broken output.
 *
 * The "topic-band__term-info--with-count" class opts these tiles into
 * showing a post count — topic-band-compact.php's sidebar tiles omit it,
 * since the Figma sidebar design never shows a count.
 */

?>
<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:group {"className":"topic-band__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group topic-band__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
			<!-- wp:image {"width":"52px","height":"52px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-hiv-aids.svg' ) ); ?>" alt="" style="width:52px;height:52px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-hiv-aids","className":"topic-band__term-info topic-band__term-info--with-count","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div id="topic-band-hiv-aids" class="wp-block-group topic-band__term-info topic-band__term-info--with-count">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'HIV/AIDS', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"topic-band__term-count"} -->
				<p class="topic-band__term-count"><?php echo esc_html__( '187 articles', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:group {"className":"topic-band__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group topic-band__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
			<!-- wp:image {"width":"52px","height":"52px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-tuberculosis.svg' ) ); ?>" alt="" style="width:52px;height:52px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-tb-response","className":"topic-band__term-info topic-band__term-info--with-count","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div id="topic-band-tb-response" class="wp-block-group topic-band__term-info topic-band__term-info--with-count">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'Tuberculosis', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"topic-band__term-count"} -->
				<p class="topic-band__term-count"><?php echo esc_html__( '68 articles', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:group {"className":"topic-band__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group topic-band__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
			<!-- wp:image {"width":"52px","height":"52px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-nhi.svg' ) ); ?>" alt="" style="width:52px;height:52px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-nhi","className":"topic-band__term-info topic-band__term-info--with-count","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div id="topic-band-nhi" class="wp-block-group topic-band__term-info topic-band__term-info--with-count">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'NHI', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"topic-band__term-count"} -->
				<p class="topic-band__term-count"><?php echo esc_html__( '122 articles', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:group {"className":"topic-band__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group topic-band__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
			<!-- wp:image {"width":"52px","height":"52px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-access-to-medicines.svg' ) ); ?>" alt="" style="width:52px;height:52px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-access-to-medicines","className":"topic-band__term-info topic-band__term-info--with-count","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div id="topic-band-access-to-medicines" class="wp-block-group topic-band__term-info topic-band__term-info--with-count">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'Access to Medicines', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"topic-band__term-count"} -->
				<p class="topic-band__term-count"><?php echo esc_html__( '136 articles', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:group {"className":"topic-band__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group topic-band__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
			<!-- wp:image {"width":"52px","height":"52px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-healthcare-system.svg' ) ); ?>" alt="" style="width:52px;height:52px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-healthcare-system","className":"topic-band__term-info topic-band__term-info--with-count","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div id="topic-band-healthcare-system" class="wp-block-group topic-band__term-info topic-band__term-info--with-count">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'Healthcare System', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"topic-band__term-count"} -->
				<p class="topic-band__term-count"><?php echo esc_html__( '65 articles', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:group {"className":"topic-band__tile","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group topic-band__tile has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
			<!-- wp:image {"width":"52px","height":"52px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-ncds.svg' ) ); ?>" alt="" style="width:52px;height:52px" /></figure>
			<!-- /wp:image -->

			<!-- wp:group {"anchor":"topic-band-ncds","className":"topic-band__term-info topic-band__term-info--with-count","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div id="topic-band-ncds" class="wp-block-group topic-band__term-info topic-band__term-info--with-count">
				<!-- wp:paragraph -->
				<p><a class="topic-band__term-name" href="#"><?php echo esc_html__( 'NCDs', 'spotlight-theme-2026' ); ?></a></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"topic-band__term-count"} -->
				<p class="topic-band__term-count"><?php echo esc_html__( '125 articles', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->
