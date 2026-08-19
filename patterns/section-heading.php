<?php
/**
 * Title: Section Heading
 * Slug: spotlight-theme-2026/section-heading
 * Categories: spotlight
 * Keywords: heading, section header, category header, read more
 * Description: The "Category Header" component from Figma (heading, divider line, "Read more" link) — confirmed identical across the front page's topic grid, Latest News, Special Projects, and Perspectives sections. Internal partial, embedded via require() — not meant to be inserted standalone.
 * Inserter: false
 *
 * @package spotlight-theme-2026
 *
 * Set $section_heading_title and $section_heading_link_text (and
 * optionally $section_heading_link_url, which defaults to the blog home)
 * before require()-ing this file — the same set-a-variable-then-require()
 * convention already used by hero-lead-story.php/spotlight-badge.php for
 * passing per-instance content into a shared partial.
 *
 * The divider approximates Figma's decorative line asset with core/separator
 * rather than an exported image — a plain horizontal rule reads the same
 * here and avoids depending on a purely decorative asset.
 */

$section_heading_link_url = $section_heading_link_url ?? home_url( '/' );

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group">
	<!-- wp:heading {"level":2,"textColor":"brand-500","style":{"typography":{"letterSpacing":"0.3px"}}} -->
	<h2 class="wp-block-heading has-brand-500-color has-text-color" style="letter-spacing:0.3px"><?php echo esc_html( $section_heading_title ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:separator {"className":"is-style-wide"} -->
	<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>
	<!-- /wp:separator -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"textColor":"brand-500","style":{"elements":{"link":{"color":{"text":"var:preset|color|brand-500"}}}}} -->
		<p class="has-brand-500-color has-text-color"><a href="<?php echo esc_url( $section_heading_link_url ); ?>" style="color:var(--wp--preset--color--brand-500)"><?php echo esc_html( $section_heading_link_text ); ?></a></p>
		<!-- /wp:paragraph -->

		<!-- wp:image {"width":"18px","height":"18px","sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/arrow-right.svg' ) ); ?>" alt="" style="width:18px;height:18px" /></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
