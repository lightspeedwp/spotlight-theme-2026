## 1. Lead-story hero patterns (LS-1719 / PR 1)

- [x] 1.1 Fetch the Figma "Homepage" Ready-for-Dev frame's hero section (`get_design_context`) and create `patterns/hero-lead-story.php`, satisfying the `hero-lead-story` requirement in `specs/pattern-library/spec.md`
- [x] 1.2 ~~Create `patterns/featured-story.php`~~ — removed: confirmed via Figma walkthrough that no distinct featured-story element exists separate from the hero; see design.md Decisions
- [x] 1.3 Fetch the Figma "Blog Landing Page" frame's banner+search header and create `patterns/archive-listing-header.php` (home.html, wp:post-title) and `patterns/archive-listing-header-archive.php` (archive.html, wp:query-title) — two files, not one, since home.html's queried object is a real page and archive.html's is a taxonomy term; confirmed against kwv-theme-2026's equivalent two-file-per-template-type precedent
- [x] 1.4 Fetch the Figma "About Page" frame's full-bleed photo banner and create `patterns/page-intro-banner.php`, satisfying the `page-intro-banner` requirement — background photo deferred to a solid accent-600 placeholder pending Zared's confirmation on the real image
- [x] 1.5 Update `templates/front-page.html` to reference `hero-lead-story` via `wp:pattern`, replacing `[Featured-story hero pattern placeholder]`
- [x] 1.6 Update `templates/home.html` and `templates/archive.html`'s `post-listing-header` group to reference `archive-listing-header`/`archive-listing-header-archive` via `wp:pattern`
- [x] 1.7 Update `templates/page.html` to add `page-intro-banner` via `wp:pattern` as a direct child of `main` (for its own align:"full" to apply correctly); removed the template's standalone `wp:post-title` to avoid a duplicate H1, since the pattern now owns the page's title
- [x] 1.8 Record any dependencies on future homepage implementation issues in design.md
- [x] 1.9 Run `npm run schema:validate` and `npm run theme:validate`; manually verify all patterns render correctly in the Site Editor — hero-lead-story, archive-listing-header, archive-listing-header-archive, and page-intro-banner all confirmed working in the Site Editor and on the front end

## 2. Story-card, archive-card, and section-band patterns (LS-1720 / PR 2)

- [x] 2.1 Create `story-card.php` (boxed, default — Latest News only), `story-card-editorial.php` (no card background, larger radius, no badge — Perspectives, and home.html/archive.html's grid), and `story-card-featured.php` (editorial style + spotlight-badge overlay — Special Projects, and the Blog Landing Page grid's first card) — satisfying the `story-card` requirement's content-specific variants. `single.html`'s Recent Stories card is out of scope here — confirmed against spec.md's `related-coverage` requirement and design.md's Decisions, it belongs to PR 4 (LS-1722), not `story-card`; the original wording here was stale. Three files instead of one, confirmed directly against Figma: all three placements use the same "Card/Blog" component and content structure, but differ in card background/radius and badge presence — not documentation categories, real distinct visual treatments. Correction during task 2.4: the initial assignment of `story-card.php` (boxed) to home.html/archive.html's grid was wrong — only one example card (the featured one) was checked there; two separate non-first cards confirmed the grid actually uses the editorial style.
- [x] 2.2 Create `patterns/topic-band.php` (grid-with-counts, six curated categories confirmed against Figma's "Explore by topic" section) and `patterns/topic-band-compact.php` (sidebar-list, same categories with no count shown, plus a "Latest news" shortcut — confirmed against Figma's "Single Blog Post" sidebar) — satisfying the `topic-band` requirement's two size variants. Each tile's name/link/post-count is resolved live at render time from the real category by `spotlight_theme_2026_resolve_topic_band_term()` (functions.php), matched via the tile's own `anchor` attribute — the curated topic list stays easy to edit (a plain markup edit per tile) while the displayed data never goes stale. The "Category Header" component (heading + divider + "Read more" button) is deliberately NOT part of either pattern — confirmed with the user it's authored directly in each template instead, since each instance is used exactly once with its own text; see design.md's Decisions for the confirmed values (font-size, divider mechanism, new `is-style-text-link` button) to apply when `front-page.html` is wired in task 2.5/2.6.
- [x] 2.3 Verify CTA behaviour, hierarchy, and scanability consistency across all `story-card` variants — confirmed consistent: identical click targets/destinations (image, title, category label), identical heading level (H4) and font-size scale, identical spacing values across all three files. Found and fixed two accessibility items affecting all three equally: the outer wrapper now renders as `<article>` (`tagName` attribute) instead of a plain `<div>`, and the featured image's link is hidden from assistive tech (`aria-hidden`/`tabindex="-1"` via a new `spotlight_theme_2026_hide_duplicate_card_image_link()` render filter in functions.php) since the title link already provides an accessible path to the post, avoiding an announced-twice duplicate link per card.
- [x] 2.4 Update `templates/home.html`/`templates/archive.html`'s post-template loop with `story-card-editorial`'s markup, replacing `[Blog Card pattern placeholder]`. NOT via `wp:pattern` — confirmed against `wp-includes/blocks/pattern.php`'s actual render function that `render_block_core_pattern()` calls `do_blocks()` with no inherited context, so any `wp:pattern` reference left inside a query loop's post-template loses `postId` for every context-dependent block inside it (post-title, post-excerpt, post-terms, post-featured-image, post-author-name, post-date). This isn't scoped to "nested inside another pattern" as originally understood in hero-lead-story.php's comment — it's universal to any unexpanded `wp:pattern` reference, template-authored or not. `.html` templates can't use `require()` either, so the fix is expanding the markup directly into the template (accepting some duplication) rather than referencing it — see design.md's Decisions. Corrected from the initially-wired `story-card` (boxed) to `story-card-editorial` (no background) after live testing showed the grid's real cards have no card background — see task 2.1's note. Also fixed the title's color (defaulting to the theme's link blue) across all three `story-card` variants: setting `textColor` alone colors the wrapping `<h4>` but not the nested `isLink` `<a>` inside it — `style.elements.link.color.text` is the attribute that actually controls the link's own color (the same mechanism `hero-lead-story.php` already used correctly; `story-card` just didn't replicate it), paired with a `brand-500` hover in `story-card.css`. Also added scoped spacing to `home.html`/`archive.html`'s post-listing query (a `.post-listing-query` class + real CSS, since `core/query` has no spacing support at all) and post-template (a real `style.spacing.padding` attribute, which `core/post-template` does support) — confirmed with the user this is a targeted fix for now, with a broader site-wide spacing consistency pass deferred to a later styling task.
- [ ] 2.5 Update `templates/front-page.html`'s Latest News/Special Projects/Perspectives sections with `story-card`'s markup, replacing their placeholders — same as task 2.4, expand the markup directly rather than using `wp:pattern`, since these are also query loops
- [ ] 2.6 Update `templates/front-page.html`'s topic-grid section to reference `topic-band` via `wp:pattern`, replacing `[Topic-grid pattern placeholder]` — `wp:pattern` is fine here: `topic-band`'s dynamic behavior comes from `spotlight_theme_2026_resolve_topic_band_term()`, a custom filter matched on the block's own static `anchor` attribute, not on inherited `postId` context, so it isn't affected by the same limitation as `story-card`
- [ ] 2.7 Update `templates/single.html`'s Explore-topics sidebar section to reference `topic-band-compact` via `wp:pattern` — same reasoning as 2.6, safe to reference directly
- [ ] 2.8 Style `home.html`/`archive.html`'s topic-filter pills (`wp:categories`) to match the Figma "Blog Landing Page" frame: rounded-full outline buttons, active state solid-filled
- [ ] 2.9 Style `home.html`/`archive.html`'s pagination (`wp:query-pagination`) to match the Figma "Blog Landing Page" frame: bordered previous/next controls, numbered page indicators, distinct active-page style
- [ ] 2.10 Note any card-level decisions that depend on later template work in design.md
- [ ] 2.11 Run `npm run schema:validate` and `npm run theme:validate`; manually verify in the Site Editor and front end

## 3. Trust, newsletter, and editorial-utility patterns (LS-1721 / PR 3)

- [ ] 3.1 Create `patterns/newsletter-signup.php` (front-page size) and `patterns/newsletter-signup-compact.php` (sidebar size) — satisfying the `newsletter-signup` requirement's two size variants
- [ ] 3.2 Create `patterns/republish-notice.php`, including the CC BY-ND 4.0 attribution copy confirmed in the Figma client annotation — satisfying the `republish-notice` requirement
- [ ] 3.3 Confirm `parts/trust-bar.html` remains an existing template part, not converted to a pattern
- [ ] 3.4 Update `templates/front-page.html`'s `front-page__provincial-newsletter` section to reference `newsletter-signup` via `wp:pattern`
- [ ] 3.5 Update `parts/sidebar-editorial.html`'s newsletter module to reference `newsletter-signup-compact` via `wp:pattern`
- [ ] 3.6 Update `templates/single.html`'s republish section to reference `republish-notice` via `wp:pattern`, replacing `[Republish pattern placeholder]`
- [ ] 3.7 Tighten `parts/sidebar-editorial.html` spacing, borders, and Explore-topics icon treatment to match the Figma "Single Blog Post" sidebar exactly
- [ ] 3.8 Note any dependencies on form-integration decisions (e.g. real newsletter subscription handling vs. static markup) in design.md
- [ ] 3.9 Run `npm run schema:validate` and `npm run theme:validate`; manually verify in the Site Editor and front end

## 4. Related-coverage and onward-journey patterns (LS-1722 / PR 4)

- [ ] 4.1 Create `patterns/related-coverage.php` covering `single.html`'s "Recent stories" query-loop card-row — satisfying the `related-coverage` requirement, scope limited to the existing exclude-current/most-recent query shape (no recommendation logic/automation)
- [ ] 4.2 Create the in-article variant (either a distinct pattern file, e.g. `patterns/related-coverage-callout.php`, or a documented variant within the same file) for the "More from Spotlight" bordered callout (heading + bulleted related-headline list) per the Figma "Single Blog Post" frame
- [ ] 4.3 Update `templates/single.html`'s "Recent stories" section to reference `related-coverage` via `wp:pattern`
- [ ] 4.4 Add the "More from Spotlight" callout to `templates/single.html` via `wp:pattern`, in the mid-article position shown in the Figma frame (no equivalent markup exists today)
- [ ] 4.5 Fix `templates/single.html`'s two-column layout to an asymmetric article-wide/sidebar-narrow split (currently equal 50/50), matching the Figma frame's proportions
- [ ] 4.6 Reposition `templates/single.html`'s article-header category label opposite the `spotlight-badge` (see PR 7), same row, per the Figma frame
- [ ] 4.7 Identify any other contextual-callout or onward-journey surfaces for single articles and archive-adjacent pages; add patterns if found
- [ ] 4.8 Run `npm run schema:validate` and `npm run theme:validate`; manually verify in the Site Editor and front end

## 5. Province, project, and dashboard-entry patterns (LS-1723 / PR 5)

- [ ] 5.1 Resolve the archive/category-page dashboard-placement open question (raised in the Figma client annotation) with the user before building `dashboard-promo`'s placements
- [ ] 5.2 Create `patterns/project-entry.php` covering the front page's Special Projects card-row — satisfying the `project-entry` requirement
- [ ] 5.3 Create `patterns/dashboard-promo.php` (full banner) and `patterns/dashboard-promo-compact.php` (sidebar card) — satisfying the `dashboard-promo` requirement's two size variants
- [ ] 5.4 Update `templates/front-page.html`'s Special Projects section to reference `project-entry` via `wp:pattern`
- [ ] 5.5 Update `templates/front-page.html`'s `front-page__dashboard-cta` section to reference `dashboard-promo` via `wp:pattern`
- [ ] 5.6 Update `parts/sidebar-editorial.html`'s `sidebar-editorial__dashboard-promo` module to reference `dashboard-promo-compact` via `wp:pattern`
- [ ] 5.7 If task 5.1 resolved to "yes," update `templates/archive.html` to include `dashboard-promo-compact` per the agreed placement
- [ ] 5.8 Note any bespoke province/project surfaces that should become separate future issues rather than staying in the shared pattern library
- [ ] 5.9 Run `npm run schema:validate` and `npm run theme:validate`; manually verify in the Site Editor and front end

## 6. Interactive provincial-map pattern (LS-2616 / PR 6)

- [ ] 6.1 Resolve the Interactivity API vs. non-JS fallback technical approach for the hover/select province-tooltip requirement with the user (short spike if needed) before building
- [ ] 6.2 Create `patterns/provincial-map.php`: SVG map of South Africa's nine provinces + heading/copy block + CTA, matching the Figma "Provincial coverage" frame's map+newsletter variant — satisfying the `provincial-map` requirement
- [ ] 6.3 Implement the hover/select province-tooltip interaction per the resolved technical approach from 6.1
- [ ] 6.4 Update `templates/front-page.html`'s `front-page__provincial-newsletter` section to reference `provincial-map` (paired with `newsletter-signup` from PR 3) via `wp:pattern`, replacing `[Provincial-map pattern placeholder]`
- [ ] 6.5 Confirm the "View our Provincial hub" CTA links to wherever the `project-entry`/province-hub pattern work (PR 5) resolves, not a duplicated destination
- [ ] 6.6 Note the two later-phase map variants (dynamic latest-post swap, province-count grid) as explicitly deferred, not built in this PR
- [ ] 6.7 Run `npm run schema:validate` and `npm run theme:validate`; manually verify the map and tooltip interaction in the Site Editor and front end

## 7. Cross-cutting styling fidelity (PR 7 — spans LS-1719–1723, runs after PR 6)

- [x] 7.1 ~~Create `patterns/spotlight-badge.php`~~ — already delivered in PR 1 (task 1.1's `hero-lead-story.php` needed a working badge immediately); satisfies the `spotlight-badge` requirement, see design.md Risks/Trade-offs
- [ ] 7.2 Confirm `spotlight-badge` is inlined via PHP `require()` (never `wp:pattern`) at every post-context placement: front-page hero (PR 1, done), `story-card` variants (PR 2), single-post article header (PR 4) — `require()` is mandatory here, not a style choice, since `wp:pattern` loses the query loop's `postId` context that the badge's `core/post-terms` block needs; coordinate with those PRs if built out of order
- [ ] 7.3 Measure section spacing and content width directly against the Figma "Homepage", "Blog Landing Page", and "Single Blog Post" frames (do not guess) before adjusting `theme.json`'s `contentSize`/`wideSize`/spacing scale or any template's block gaps
- [ ] 7.4 Apply the measured spacing/content-width adjustments consistently across `templates/single.html`, `templates/home.html`, and `templates/archive.html`
- [ ] 7.5 Run `npm run schema:validate` and `npm run theme:validate`; manually verify spacing/badge rendering across all affected templates

## 8. Cross-cutting validation

- [ ] 8.1 Verify every `[... pattern placeholder]` marker across `templates/front-page.html`, `templates/home.html`, `templates/archive.html`, `templates/single.html`, `templates/page.html`, and `parts/sidebar-editorial.html` has been replaced with a real `wp:pattern` reference
- [ ] 8.2 Cross-check all four Figma Ready-for-Dev page frames (`Homepage`, `Blog Landing Page`, `About Page`, `Single Blog Post` — node `234:8297`) against the built templates to confirm nothing was missed
- [ ] 8.3 Verify every pattern file in `patterns/` has a valid header comment (Title, Slug, Categories) and registers correctly (visible in the Site Editor's pattern inserter)
- [ ] 8.4 Verify no podcast-specific, taxonomy/navigation, or SEO/migration pattern was built
- [ ] 8.5 Run `openspec validate --strict spotlight-pattern-library` and resolve any reported issues
- [ ] 8.6 Run the full validation suite (`npm run lint`, `composer run phpcs`, `composer run lint:php`) across all new `patterns/*.php` files

## 9. Review and archive

- [ ] 9.1 Share each PR with the user for review against the Figma design system before merging
- [ ] 9.2 Confirm the seven-PR split (or any adjustments) held up through implementation
- [ ] 9.3 Archive this change (`/opsx:archive`) once all seven PRs are merged, promoting `specs/pattern-library/spec.md` into `openspec/specs/pattern-library/spec.md`
