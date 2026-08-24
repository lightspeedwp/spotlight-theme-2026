<?php
/**
 * Title: Newsletter Signup
 * Slug: spotlight-theme-2026/newsletter-signup
 * Categories: spotlight
 * Keywords: newsletter, subscribe, email, signup
 * Description: front-page.html's "Read our latest newsletters" card — heading, a short list of recent issues, and a Subscribe CTA. Front-page size variant; see newsletter-signup-compact.php for the sidebar variant.
 * Inserter: true
 * Template Types: front-page
 *
 * @package spotlight-theme-2026
 *
 * The three issues below are static placeholder copy, not a real query.
 * This site has real "Edition"/"Spotlight Edition" categories that could
 * back a genuine "latest newsletters" list later, but going dynamic is
 * deferred pending Zared's feedback on whether it's actually needed —
 * edit the three list items directly in the Site Editor for now. The
 * "Subscribe for the latest news" button's destination (real form
 * submission vs. linking elsewhere) is also unresolved; see design.md.
 *
 * Border lives in assets/css/newsletter-signup.css, not a block style
 * attribute — a hand-typed border width+style+color+radius combination
 * doesn't byte-match WordPress's own style-engine serialization (missing
 * the auto-added has-border-color class, wrong width/style property
 * order), which shows as "Block contains unexpected or invalid content"
 * in the editor. Same fix already used in republish-notice.php.
 */

?>
<!-- wp:group {"className":"newsletter-signup","backgroundColor":"neutral-100","style":{"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group newsletter-signup has-neutral-100-background-color has-background" style="padding:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"level":3,"fontSize":"400","style":{"typography":{"fontWeight":"500"}}} -->
	<h3 class="wp-block-heading has-400-font-size" style="font-weight:500"><?php echo esc_html__( 'Read our latest newsletters', 'spotlight-theme-2026' ); ?></h3>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"newsletter-signup__list","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group newsletter-signup__list">
		<!-- wp:group {"className":"newsletter-signup__item","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
		<div class="wp-block-group newsletter-signup__item">
			<!-- wp:outermost/icon-block {"iconName":"","width":24} -->
			<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="23.25" viewBox="0 0 24 23.25" fill="none" role="img" aria-hidden="true"><path d="M14.25 11.625C14.25 12.1442 14.096 12.6517 13.8076 13.0834C13.5192 13.5151 13.1092 13.8515 12.6295 14.0502C12.1499 14.2489 11.6221 14.3008 11.1129 14.1996C10.6037 14.0983 10.136 13.8483 9.76885 13.4812C9.40173 13.114 9.15173 12.6463 9.05044 12.1371C8.94915 11.6279 9.00114 11.1001 9.19982 10.6205C9.3985 10.1408 9.73495 9.73083 10.1666 9.44239C10.5983 9.15395 11.1058 9 11.625 9C12.3212 9 12.9889 9.27656 13.4812 9.76884C13.9734 10.2611 14.25 10.9288 14.25 11.625Z" fill="#181818"></path></svg></div></div>
			<!-- /wp:outermost/icon-block -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"fontSize":"200","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-200-font-size" style="font-weight:500"><?php echo esc_html__( 'A peek at the future if HIV prevention', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"100","textColor":"neutral-600"} -->
				<p class="has-neutral-600-color has-text-color has-100-font-size">07/31/2026</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"newsletter-signup__item","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
		<div class="wp-block-group newsletter-signup__item">
			<!-- wp:outermost/icon-block {"iconName":"","width":24} -->
			<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="23.25" viewBox="0 0 24 23.25" fill="none" role="img" aria-hidden="true"><path d="M14.25 11.625C14.25 12.1442 14.096 12.6517 13.8076 13.0834C13.5192 13.5151 13.1092 13.8515 12.6295 14.0502C12.1499 14.2489 11.6221 14.3008 11.1129 14.1996C10.6037 14.0983 10.136 13.8483 9.76885 13.4812C9.40173 13.114 9.15173 12.6463 9.05044 12.1371C8.94915 11.6279 9.00114 11.1001 9.19982 10.6205C9.3985 10.1408 9.73495 9.73083 10.1666 9.44239C10.5983 9.15395 11.1058 9 11.625 9C12.3212 9 12.9889 9.27656 13.4812 9.76884C13.9734 10.2611 14.25 10.9288 14.25 11.625Z" fill="#181818"></path></svg></div></div>
			<!-- /wp:outermost/icon-block -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"fontSize":"200","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-200-font-size" style="font-weight:500"><?php echo esc_html__( 'Is one pill, once a week the future of HIV treatment?', 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"100","textColor":"neutral-600"} -->
				<p class="has-neutral-600-color has-text-color has-100-font-size">07/24/2026</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"newsletter-signup__item","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
		<div class="wp-block-group newsletter-signup__item">
			<!-- wp:outermost/icon-block {"iconName":"","width":24} -->
			<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:24px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="23.25" viewBox="0 0 24 23.25" fill="none" role="img" aria-hidden="true"><path d="M14.25 11.625C14.25 12.1442 14.096 12.6517 13.8076 13.0834C13.5192 13.5151 13.1092 13.8515 12.6295 14.0502C12.1499 14.2489 11.6221 14.3008 11.1129 14.1996C10.6037 14.0983 10.136 13.8483 9.76885 13.4812C9.40173 13.114 9.15173 12.6463 9.05044 12.1371C8.94915 11.6279 9.00114 11.1001 9.19982 10.6205C9.3985 10.1408 9.73495 9.73083 10.1666 9.44239C10.5983 9.15395 11.1058 9 11.625 9C12.3212 9 12.9889 9.27656 13.4812 9.76884C13.9734 10.2611 14.25 10.9288 14.25 11.625Z" fill="#181818"></path></svg></div></div>
			<!-- /wp:outermost/icon-block -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"fontSize":"200","style":{"typography":{"fontWeight":"500"}}} -->
				<p class="has-200-font-size" style="font-weight:500"><?php echo esc_html__( "Who's thinking what about South Africa's big health questions?", 'spotlight-theme-2026' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"100","textColor":"neutral-600"} -->
				<p class="has-neutral-600-color has-text-color has-100-font-size">07/17/2026</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-secondary"} -->
		<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html__( 'Subscribe for the latest news', 'spotlight-theme-2026' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
