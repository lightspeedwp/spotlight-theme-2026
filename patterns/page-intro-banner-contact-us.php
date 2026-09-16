<?php
/**
 * Title: Page Intro Banner (Contact Us)
 * Slug: spotlight-theme-2026/page-intro-banner-contact-us
 * Categories: spotlight
 * Keywords: page, intro, banner, hero, breadcrumbs, contact
 * Description: Contact-us-only variant of Page Intro Banner, with the subtitle Figma shows for that page (node 234:6734). page-intro-banner.php itself stays subtitle-free per Zared's 2026-09-04 "no intro copy under the title" note — that decision was about the shared banner every default page gets, not this one page's copy (BugHerd #16).
 * Inserter: false
 *
 * @package spotlight-theme-2026
 *
 * Referenced from templates/page-contact-us.html (picked up automatically
 * by WordPress's page-{slug}.html template hierarchy for the "contact-us"
 * page, no manual template assignment needed) instead of page.html's
 * generic page-intro-banner, so no other page picks up this copy.
 *
 * Subtitle style/spacing matches Figma exactly: fontSize--400/
 * neutral-300 for the text; the blockGap--30 already on the title's
 * wrapper group and the banner's own padding-bottom--100 already
 * matched Figma's measured gaps before this pattern existed, so
 * neither needed changing — see page-intro-banner.php's own header.
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
			<!-- wp:post-title {"level":1,"fontSize":"500","textColor":"neutral-100","style":{"typography":{"fontWeight":"var(--wp--custom--font-weight--semi-bold)"}}} /-->

			<!-- wp:paragraph {"textColor":"neutral-300","fontSize":"400"} -->
			<p class="has-neutral-300-color has-text-color has-400-font-size"><?php echo esc_html__( "Have a question, a story idea, or some feedback? We'd love to hear from you. Reach out and our team will get back to you as soon as possible.", 'spotlight-theme-2026' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
