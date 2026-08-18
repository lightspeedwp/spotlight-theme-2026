## 1. Lead-story hero patterns (LS-1719 / PR 1)

- [x] 1.1 Fetch the Figma "Homepage" Ready-for-Dev frame's hero section (`get_design_context`) and create `patterns/hero-lead-story.php`, satisfying the `hero-lead-story` requirement in `specs/pattern-library/spec.md`
- [x] 1.2 ~~Create `patterns/featured-story.php`~~ — removed: confirmed via Figma walkthrough that no distinct featured-story element exists separate from the hero; see design.md Decisions
- [x] 1.3 Fetch the Figma "Blog Landing Page" frame's banner+search header and create `patterns/archive-listing-header.php` (home.html, wp:post-title) and `patterns/archive-listing-header-archive.php` (archive.html, wp:query-title) — two files, not one, since home.html's queried object is a real page and archive.html's is a taxonomy term; confirmed against kwv-theme-2026's equivalent two-file-per-template-type precedent
- [ ] 1.4 Fetch the Figma "About Page" frame's full-bleed photo banner and create `patterns/page-intro-banner.php`, satisfying the `page-intro-banner` requirement
- [x] 1.5 Update `templates/front-page.html` to reference `hero-lead-story` via `wp:pattern`, replacing `[Featured-story hero pattern placeholder]`
- [x] 1.6 Update `templates/home.html` and `templates/archive.html`'s `post-listing-header` group to reference `archive-listing-header`/`archive-listing-header-archive` via `wp:pattern`
- [ ] 1.7 Update `templates/page.html` to add `page-intro-banner` via `wp:pattern` as its hero section (currently has none)
- [ ] 1.8 Record any dependencies on future homepage implementation issues in design.md
- [x] 1.9 Run `npm run schema:validate` and `npm run theme:validate`; manually verify all patterns render correctly in the Site Editor — hero-lead-story confirmed working in Site Editor; archive-listing-header and page-intro-banner still pending (see 1.3/1.4)

## 2. Story-card, archive-card, and section-band patterns (LS-1720 / PR 2)

- [ ] 2.1 Create `patterns/story-card.php` covering: `home.html`/`archive.html` grid card, front-page Latest News/Special Projects/Perspectives rows, and `single.html` Recent Stories card — satisfying the `story-card` requirement, with content-specific variants as needed
- [ ] 2.2 Create `patterns/topic-band.php` (grid-with-counts, for the front page) and `patterns/topic-band-compact.php` (sidebar-list, for `single.html` Explore topics) — satisfying the `topic-band` requirement's two size variants
- [ ] 2.3 Verify CTA behaviour, hierarchy, and scanability consistency across all `story-card` variants
- [ ] 2.4 Update `templates/home.html`/`templates/archive.html`'s post-template loop to reference `story-card` via `wp:pattern`, replacing `[Blog Card pattern placeholder]`
- [ ] 2.5 Update `templates/front-page.html`'s Latest News/Special Projects/Perspectives sections to reference `story-card` via `wp:pattern`, replacing their placeholders
- [ ] 2.6 Update `templates/front-page.html`'s topic-grid section to reference `topic-band` via `wp:pattern`, replacing `[Topic-grid pattern placeholder]`
- [ ] 2.7 Update `templates/single.html`'s Explore-topics sidebar section to reference `topic-band-compact` via `wp:pattern`
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

## 7. Cross-cutting styling fidelity (PR 7 — spans LS-1719–1723, sequence early)

- [ ] 7.1 Create `patterns/spotlight-badge.php` (solid brand-500 rounded-pill, white text, term/label as a variable e.g. "In the Spotlight"/"Inside the Box") — satisfying the `spotlight-badge` requirement
- [ ] 7.2 Reference `spotlight-badge` via `wp:pattern` from every placement: front-page hero (PR 1), `story-card` variants (PR 2), single-post article header (PR 4) — coordinate with those PRs if built out of order
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
