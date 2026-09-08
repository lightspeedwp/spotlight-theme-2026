<?php
/**
 * Title: Newsletter Signup (Compact)
 * Slug: spotlight-theme-2026/newsletter-signup-compact
 * Categories: spotlight
 * Keywords: newsletter, subscribe, email, signup, sidebar
 * Description: parts/sidebar-editorial.html's newsletter module — heading, description, and the site's real "Sign up to get stories that matter in your inbox" Gravity Form (ID 1, already wired to Mailchimp). Sidebar/compact size variant; see newsletter-signup.php for the front-page variant.
 * Inserter: true
 *
 * @package spotlight-theme-2026
 *
 * Embeds the real Gravity Form rather than static markup — it already
 * exists with a working Mailchimp integration (confirmed in wp-admin).
 * title/description are disabled on the block since this pattern authors
 * its own heading/copy above the form instead. Gravity Forms' own
 * input/button markup is restyled in assets/css/newsletter-signup.css to
 * match the design instead of rebuilding the form from scratch — the
 * same CSS-bridge approach already used for the CC Post Republisher
 * plugin's button in republish-notice.php.
 */

?>
<!-- wp:group {"className":"newsletter-signup-compact","backgroundColor":"neutral-300","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group newsletter-signup-compact has-neutral-300-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"level":3,"fontSize":"300"} -->
		<h3 class="wp-block-heading has-300-font-size"><?php echo esc_html__( 'Stories that matter, in your inbox', 'spotlight-theme-2026' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"fontSize":"200","textColor":"neutral-700"} -->
		<p class="has-neutral-700-color has-text-color has-200-font-size"><?php echo esc_html__( "Spotlight's free newsletter delivers in-depth health journalism — no spam, unsubscribe anytime.", 'spotlight-theme-2026' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:gravityforms/form {"formId":"1","title":false,"description":false} /-->
</div>
<!-- /wp:group -->
