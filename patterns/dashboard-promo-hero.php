<?php
/**
 * Title: Dashboard Promo (Hero)
 * Slug: spotlight-theme-2026/dashboard-promo-hero
 * Categories: spotlight
 * Keywords: dashboard, data, HIV, TB, CTA, archive header
 * Description: The "Dashboard CTA" card in archive-listing-header.php/archive-listing-header-archive.php's hero column — eyebrow, heading + subtitle, and two buttons side by side (not stacked).
 * Inserter: true
 *
 * @package spotlight-theme-2026
 *
 * Third size variant of "dashboard-promo" (see dashboard-promo.php for
 * the full banner, dashboard-promo-compact.php for the sidebar card).
 * Genuinely distinct from both, not just a resize: light card on a white
 * background (vs. the other two variants' dark/navy cards), text and
 * buttons arranged side by side in two columns (vs. stacked), smaller
 * heading size (font-size--300) and tighter letter-spacing (-0.02px),
 * shorter button copy ("HIV Dashboard" / "TB Dashboard", no "View the"),
 * and a smaller eyebrow radius (radius--200, not radius--100) — all
 * confirmed against Figma node I234:6733;547:9538, not assumed from the
 * other variants.
 */

?>
<!-- wp:group {"className":"dashboard-promo-hero","backgroundColor":"base","style":{"border":{"color":"var:preset|color|accent-500","width":"1px","style":"solid","radius":"var:preset|border-radius|300"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
<div class="wp-block-group dashboard-promo-hero has-border-color has-base-background-color has-background" style="border-color:var(--wp--preset--color--accent-500);border-style:solid;border-width:1px;border-radius:var(--wp--preset--border-radius--300);padding:var(--wp--preset--spacing--20)">
	<!-- wp:group {"className":"dashboard-promo-hero__eyebrow","backgroundColor":"accent-400","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":{"top":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-group dashboard-promo-hero__eyebrow has-accent-400-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--10)">
		<!-- wp:paragraph {"textColor":"neutral-100","fontSize":"200","style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}}} -->
		<p class="has-neutral-100-color has-text-color has-200-font-size" style="font-weight:600;text-transform:uppercase"><?php echo esc_html__( 'Interactive Data Dashboards', 'spotlight-theme-2026' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3,"textColor":"accent-500","fontSize":"300","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"-0.02px"}}} -->
			<h3 class="wp-block-heading has-accent-500-color has-text-color has-300-font-size" style="font-weight:500;line-height:var(--wp--custom--line-height--heading);letter-spacing:-0.02px"><?php echo esc_html__( 'Track the HIV & TB response', 'spotlight-theme-2026' ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"100","style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} -->
			<p class="has-neutral-700-color has-text-color has-100-font-size" style="margin-top:var(--wp--preset--spacing--10)"><?php echo esc_html__( 'Live indicators, province breakdowns and downloadable data.', 'spotlight-theme-2026' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"width":100,"className":"is-style-secondary","fontSize":"300","style":{"spacing":{"padding":{"left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}}} -->
				<div class="wp-block-button has-custom-width has-custom-font-size wp-block-button__width-100 is-style-secondary has-300-font-size"><a class="wp-block-button__link has-300-font-size has-custom-font-size wp-element-button" href="<?php echo esc_url( 'https://www.spotlightnsp.co.za/hiv-dashboard/' ); ?>" style="padding-right:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><?php echo esc_html__( 'HIV Dashboard', 'spotlight-theme-2026' ); ?></a></div>
				<!-- /wp:button -->

				<!-- wp:button {"width":100,"className":"is-style-outline","textColor":"accent-300","fontSize":"300","style":{"spacing":{"padding":{"left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}}} -->
				<div class="wp-block-button has-custom-width has-custom-font-size wp-block-button__width-100 is-style-outline has-300-font-size"><a class="wp-block-button__link has-accent-300-color has-text-color has-300-font-size has-custom-font-size wp-element-button" href="<?php echo esc_url( 'https://www.spotlightnsp.co.za/tb-dashboard/' ); ?>" style="padding-right:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><?php echo esc_html__( 'TB Dashboard', 'spotlight-theme-2026' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
