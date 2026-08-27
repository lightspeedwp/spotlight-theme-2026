<?php
/**
 * Title: Related Coverage (In-Article Callout)
 * Slug: spotlight-theme-2026/related-coverage-callout
 * Categories: spotlight
 * Keywords: recent, related, stories, coverage, callout, single post, more from spotlight
 * Description: single.html's mid-article "More from Spotlight" bordered callout — a bulleted list of recent post links, excluding the one being viewed.
 * Inserter: true
 * Template Types: single
 *
 * @package spotlight-theme-2026
 *
 * In-article companion to related-coverage.php's end-of-article card
 * row — same "related coverage" requirement, a link-list treatment
 * instead of cards, so it's its own file rather than a variant flag.
 *
 * Self-contained wp:query/wp:post-template — safe to reference via
 * wp:pattern from single.html; see related-coverage.php's header for why.
 *
 * Chevron icon is the exact SVG Figma provided; its #d92131 fill is an
 * exact match for this theme's brand-500 token (confirmed, not assumed).
 * Post-title hover colour (brand-500) matches every other post-title
 * link in the theme, though Figma's spec only covers the resting state.
 */

?>
<!-- wp:group {"className":"related-coverage-callout","backgroundColor":"neutral-200","style":{"border":{"radius":"var:preset|border-radius|200"},"spacing":{"padding":"var:preset|spacing|20","blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group related-coverage-callout has-neutral-200-background-color has-background" style="border-radius:var(--wp--preset--border-radius--200);padding:var(--wp--preset--spacing--20)">
	<!-- wp:heading {"level":3,"textColor":"accent-700","fontSize":"400","style":{"typography":{"fontWeight":"500","lineHeight":"var:custom|line-height|heading","letterSpacing":"0.3px"}}} -->
	<h3 class="wp-block-heading has-accent-700-color has-text-color has-400-font-size" style="font-weight:500;line-height:var(--wp--custom--line-height--heading);letter-spacing:0.3px">More from Spotlight</h3>
	<!-- /wp:heading -->

	<!-- wp:query {"query":{"perPage":5,"postType":"post","order":"desc","orderBy":"date","inherit":false,"exclude_current":true},"namespace":"advanced-query-loop"} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"related-coverage-callout__list","style":{"spacing":{"blockGap":"var:preset|spacing|10"}}} -->
			<!-- wp:group {"className":"related-coverage-callout__item","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
			<div class="wp-block-group related-coverage-callout__item">
				<!-- wp:outermost/icon-block {"iconName":"","width":8} -->
				<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:8px;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none" role="img" aria-hidden="true"><path d="M0.699219 0.0996094C0.858422 0.0996094 1.01145 0.162817 1.12402 0.275391L6.12402 5.27539C6.17967 5.33104 6.22376 5.39703 6.25391 5.46973C6.28407 5.54248 6.29977 5.62046 6.2998 5.69922C6.2998 5.77807 6.2841 5.85685 6.25391 5.92969C6.22372 6.00233 6.17968 6.06842 6.12402 6.12402L1.12402 11.124C1.0684 11.1796 1.00233 11.2237 0.929688 11.2539C0.856858 11.2841 0.778049 11.2998 0.699219 11.2998C0.620483 11.2998 0.54247 11.284 0.469727 11.2539C0.397033 11.2238 0.331061 11.1796 0.275391 11.124C0.219719 11.0684 0.174695 11.0024 0.144531 10.9297C0.114364 10.8569 0.0996094 10.778 0.0996094 10.6992C0.0996459 10.6205 0.114424 10.5424 0.144531 10.4697C0.174698 10.3969 0.21965 10.3311 0.275391 10.2754L4.85059 5.69922L0.275391 1.12402C0.162817 1.01145 0.0996094 0.858422 0.0996094 0.699219C0.099683 0.540116 0.162882 0.387899 0.275391 0.275391C0.387899 0.162882 0.540116 0.099683 0.699219 0.0996094Z" fill="#D92131" stroke="#D92131" stroke-width="0.2"/></svg></div></div>
				<!-- /wp:outermost/icon-block -->

				<!-- wp:post-title {"level":4,"isLink":true,"textColor":"accent-500","fontSize":"200","fontFamily":"body","style":{"typography":{"fontWeight":"600","lineHeight":"var:custom|line-height|heading"},"elements":{"link":{"color":{"text":"var:preset|color|accent-500"},":hover":{"color":{"text":"var:preset|color|brand-500"}}}}}} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-no-results -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html__( 'No other stories yet.', 'spotlight-theme-2026' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
