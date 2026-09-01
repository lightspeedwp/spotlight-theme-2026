<?php
/**
 * Title: Dashboard Promo
 * Slug: spotlight-theme-2026/dashboard-promo
 * Categories: spotlight
 * Keywords: dashboard, data, HIV, TB, CTA, banner
 * Description: front-page.html's full-width "Interactive Data Dashboards" banner — gradient background, heading, subtitle, and two stat cards linking to the HIV and TB dashboards.
 * Inserter: true
 * Template Types: front-page
 *
 * @package spotlight-theme-2026
 *
 * Full-banner size variant (dashboard-promo-compact.php is the sidebar
 * variant; dashboard-promo-hero.php is the third, archive-header variant).
 *
 * Gradient uses the native style.color.gradient attribute, no CSS.
 * Card border-color and the decorative watermark icon are real CSS
 * (assets/css/dashboard-promo.css) — combined border attributes don't
 * reliably serialize, and absolute positioning has no block attribute.
 * Icons reuse assets/icons/topic-hiv-aids.svg / topic-tuberculosis.svg,
 * the same assets topic-band-compact.php already uses.
 * Button reuses is-style-secondary with a per-instance size override.
 *
 * Stat numbers are static Figma content, not live data — the real
 * source (an R Shiny app, session-scoped WebSocket only, no public
 * API) can't be fetched reliably. Whether these become editable is
 * being decided with Zared separately.
 */

?>
<!-- wp:group {"className":"dashboard-promo","align":"full","style":{"color":{"gradient":"linear-gradient(113.44deg, var(--wp--preset--color--accent-500) 7.66%, var(--wp--preset--color--accent-600) 92.35%)"},"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group dashboard-promo alignfull has-background" style="background:linear-gradient(113.44deg, var(--wp--preset--color--accent-500) 7.66%, var(--wp--preset--color--accent-600) 92.35%);padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--20)">
	<!-- wp:group {"className":"dashboard-promo__content","align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group dashboard-promo__content alignwide">
		<!-- wp:group {"className":"dashboard-promo__header","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group dashboard-promo__header">
			<!-- wp:group {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-group">
				<!-- wp:group {"className":"dashboard-promo__eyebrow","backgroundColor":"accent-400","style":{"border":{"radius":"var:preset|border-radius|100"},"spacing":{"padding":{"top":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-group dashboard-promo__eyebrow has-accent-400-background-color has-background" style="border-radius:var(--wp--preset--border-radius--100);padding-top:var(--wp--preset--spacing--5);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--5);padding-left:var(--wp--preset--spacing--10)">
					<!-- wp:paragraph {"textColor":"neutral-100","fontSize":"300","style":{"typography":{"fontWeight":"600","textTransform":"uppercase"}}} -->
					<p class="has-neutral-100-color has-text-color has-300-font-size" style="font-weight:600;text-transform:uppercase"><?php echo esc_html__( 'Interactive Data Dashboards', 'spotlight-theme-2026' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"textAlign":"center","level":2,"textColor":"neutral-100","fontSize":"500","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
			<h2 class="wp-block-heading has-text-align-center has-neutral-100-color has-text-color has-500-font-size" style="font-weight:500;line-height:var(--wp--custom--line-height--heading);letter-spacing:0.3px"><?php echo esc_html__( 'Follow the numbers behind the headlines', 'spotlight-theme-2026' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"align":"center","textColor":"neutral-300","fontSize":"400","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-text-align-center has-neutral-300-color has-text-color has-400-font-size" style="font-weight:500"><?php echo esc_html__( "Our dashboards track South Africa's HIV and TB response over time.", 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"align":"center","textColor":"neutral-300","fontSize":"400","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-text-align-center has-neutral-300-color has-text-color has-400-font-size" style="font-weight:500"><?php echo esc_html__( 'Explore the indicators, drill into provinces, and download the underlying data.', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"className":"dashboard-promo__cards","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-columns dashboard-promo__cards">
			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:group {"className":"dashboard-promo__card dashboard-promo__card--hiv","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|400"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group dashboard-promo__card dashboard-promo__card--hiv has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--400);padding:var(--wp--preset--spacing--40)">
				<!-- wp:group {"layout":{"type":"flex","justifyContent":"left"}} -->
				<div class="wp-block-group">
				<!-- wp:group {"className":"dashboard-promo__card-icon","backgroundColor":"brand-100","style":{"border":{"radius":"var:preset|border-radius|500"},"spacing":{"padding":"var:preset|spacing|10"}},"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-group dashboard-promo__card-icon has-brand-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--500);padding:var(--wp--preset--spacing--10)">
					<!-- wp:image {"width":"36px","height":"36px","sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-hiv-aids.svg' ) ); ?>" alt="" style="width:36px;height:36px" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:heading {"level":3,"textColor":"accent-500","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
				<h3 class="wp-block-heading has-accent-500-color has-text-color has-400-font-size" style="font-weight:500;line-height:var(--wp--custom--line-height--heading);letter-spacing:0.3px"><?php echo esc_html__( 'HIV Dashboard', 'spotlight-theme-2026' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"300"} -->
				<p class="has-neutral-700-color has-text-color has-300-font-size"><?php echo esc_html__( 'Explore comprehensive data on HIV prevalence, treatment access, and prevention programs across all nine provinces.', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"dashboard-promo__stats","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
				<div class="wp-block-group dashboard-promo__stats">
					<!-- wp:group {"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:paragraph {"textColor":"accent-500","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
						<p class="has-accent-500-color has-text-color has-400-font-size" style="font-weight:500;letter-spacing:0.3px"><?php echo esc_html__( '6.1m', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"200"} -->
						<p class="has-neutral-700-color has-text-color has-200-font-size"><?php echo esc_html__( 'On Antiretroviral Treatment', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"dashboard-promo__stats-divider"} -->
					<div class="wp-block-group dashboard-promo__stats-divider"></div>
					<!-- /wp:group -->

					<!-- wp:group {"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:paragraph {"textColor":"accent-500","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
						<p class="has-accent-500-color has-text-color has-400-font-size" style="font-weight:500;letter-spacing:0.3px"><?php echo esc_html__( '145k', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"200"} -->
						<p class="has-neutral-700-color has-text-color has-200-font-size"><?php echo esc_html__( 'New Infections Per Year', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"className":"is-style-secondary","fontSize":"300","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} -->
					<div class="wp-block-button has-custom-font-size is-style-secondary has-300-font-size"><a class="wp-block-button__link has-300-font-size has-custom-font-size wp-element-button" href="<?php echo esc_url( 'https://www.spotlightnsp.co.za/hiv-dashboard/' ); ?>" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><?php echo esc_html__( 'Open the HIV Dashboard', 'spotlight-theme-2026' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
			<!-- wp:group {"className":"dashboard-promo__card dashboard-promo__card--tb","backgroundColor":"neutral-100","style":{"border":{"radius":"var:preset|border-radius|400"},"spacing":{"padding":"var:preset|spacing|40","blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group dashboard-promo__card dashboard-promo__card--tb has-neutral-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--400);padding:var(--wp--preset--spacing--40)">
				<!-- wp:group {"layout":{"type":"flex","justifyContent":"left"}} -->
				<div class="wp-block-group">
				<!-- wp:group {"className":"dashboard-promo__card-icon","backgroundColor":"brand-100","style":{"border":{"radius":"var:preset|border-radius|500"},"spacing":{"padding":"var:preset|spacing|10"}},"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-group dashboard-promo__card-icon has-brand-100-background-color has-background" style="border-radius:var(--wp--preset--border-radius--500);padding:var(--wp--preset--spacing--10)">
					<!-- wp:image {"width":"36px","height":"36px","sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/icons/topic-tuberculosis.svg' ) ); ?>" alt="" style="width:36px;height:36px" /></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:heading {"level":3,"textColor":"accent-500","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
				<h3 class="wp-block-heading has-accent-500-color has-text-color has-400-font-size" style="font-weight:500;line-height:var(--wp--custom--line-height--heading);letter-spacing:0.3px"><?php echo esc_html__( 'TB Dashboard', 'spotlight-theme-2026' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"300"} -->
				<p class="has-neutral-700-color has-text-color has-300-font-size"><?php echo esc_html__( 'Track Tuberculosis diagnosis rates, treatment success metrics, and drug-resistant strains across health districts.', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"dashboard-promo__stats","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
				<div class="wp-block-group dashboard-promo__stats">
					<!-- wp:group {"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:paragraph {"textColor":"accent-500","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
						<p class="has-accent-500-color has-text-color has-400-font-size" style="font-weight:500;letter-spacing:0.3px"><?php echo esc_html__( '74%', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"200"} -->
						<p class="has-neutral-700-color has-text-color has-200-font-size"><?php echo esc_html__( 'Treatment Completion Rate', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"dashboard-promo__stats-divider"} -->
					<div class="wp-block-group dashboard-promo__stats-divider"></div>
					<!-- /wp:group -->

					<!-- wp:group {"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:paragraph {"textColor":"accent-500","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
						<p class="has-accent-500-color has-text-color has-400-font-size" style="font-weight:500;letter-spacing:0.3px"><?php echo esc_html__( '50k', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"textColor":"neutral-700","fontSize":"200"} -->
						<p class="has-neutral-700-color has-text-color has-200-font-size"><?php echo esc_html__( 'Estimated TB Deaths Per Year', 'spotlight-theme-2026' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->

				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"className":"is-style-secondary","fontSize":"300","style":{"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} -->
					<div class="wp-block-button has-custom-font-size is-style-secondary has-300-font-size"><a class="wp-block-button__link has-300-font-size has-custom-font-size wp-element-button" href="<?php echo esc_url( 'https://www.spotlightnsp.co.za/tb-dashboard/' ); ?>" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><?php echo esc_html__( 'Open the TB Dashboard', 'spotlight-theme-2026' ); ?></a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
