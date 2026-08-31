<?php
/**
 * Title: Dashboard Promo (Compact)
 * Slug: spotlight-theme-2026/dashboard-promo-compact
 * Categories: spotlight
 * Keywords: dashboard, data, HIV, TB, CTA, sidebar
 * Description: parts/sidebar-editorial.html's "Track the HIV & TB response" sidebar module — eyebrow, heading, subtitle, and two full-width buttons linking to the HIV and TB dashboards.
 * Inserter: true
 *
 * @package spotlight-theme-2026
 *
 * Sidebar size variant of "dashboard-promo" (see dashboard-promo.php for
 * the full banner; dashboard-promo-hero.php is the third, not-yet-built
 * variant for archive headers).
 *
 * No icon or stats here — Figma's sidebar card is just eyebrow, heading,
 * subtitle, and two full-width buttons (core/button's native `width:100`
 * attribute, not CSS).
 *
 * Both buttons reuse existing style variations: `is-style-secondary` for
 * the filled HIV button (exact match), `is-style-outline` for the TB
 * button with only its text colour overridden per-instance (accent-300
 * here vs. that style's default accent-200) — the border/bg still come
 * from the class, so this doesn't hit the hand-typed-border
 * serialization issue documented in newsletter-signup.php.
 */

?>
<!-- wp:group {"className":"dashboard-promo-compact","backgroundColor":"accent-500","style":{"border":{"radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
<div class="wp-block-group dashboard-promo-compact has-accent-500-background-color has-background" style="border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
	<!-- wp:group {"className":"dashboard-promo-compact__eyebrow","backgroundColor":"accent-400","style":{"border":{"radius":"var:preset|border-radius|100"},"spacing":{"padding":{"top":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-group dashboard-promo-compact__eyebrow has-accent-400-background-color has-background" style="border-radius:var(--wp--preset--border-radius--100);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--10)">
		<!-- wp:paragraph {"textColor":"neutral-100","fontSize":"200","style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}}} -->
		<p class="has-neutral-100-color has-text-color has-200-font-size" style="font-weight:600;text-transform:uppercase"><?php echo esc_html__( 'Interactive Data Dashboards', 'spotlight-theme-2026' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"level":3,"textColor":"neutral-100","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
		<h3 class="wp-block-heading has-neutral-100-color has-text-color has-400-font-size" style="font-weight:500;line-height:var(--wp--custom--line-height--heading);letter-spacing:0.3px"><?php echo esc_html__( 'Track the HIV & TB response', 'spotlight-theme-2026' ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"neutral-400","fontSize":"100"} -->
		<p class="has-neutral-400-color has-text-color has-100-font-size"><?php echo esc_html__( 'Live indicators, province breakdowns and downloadable data.', 'spotlight-theme-2026' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"width":100,"className":"is-style-secondary","fontSize":"300","style":{"spacing":{"padding":{"left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}}} -->
		<div class="wp-block-button has-custom-width has-custom-font-size wp-block-button__width-100 is-style-secondary has-300-font-size"><a class="wp-block-button__link has-300-font-size has-custom-font-size wp-element-button" href="<?php echo esc_url( 'https://www.spotlightnsp.co.za/hiv-dashboard/' ); ?>" style="padding-right:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><?php echo esc_html__( 'View the HIV Dashboard', 'spotlight-theme-2026' ); ?></a></div>
		<!-- /wp:button -->

		<!-- wp:button {"width":100,"className":"is-style-outline","textColor":"accent-300","fontSize":"300","style":{"spacing":{"padding":{"left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}}} -->
		<div class="wp-block-button has-custom-width has-custom-font-size wp-block-button__width-100 is-style-outline has-300-font-size"><a class="wp-block-button__link has-accent-300-color has-text-color has-300-font-size has-custom-font-size wp-element-button" href="<?php echo esc_url( 'https://www.spotlightnsp.co.za/tb-dashboard/' ); ?>" style="padding-right:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><?php echo esc_html__( 'View the TB Dashboard', 'spotlight-theme-2026' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
