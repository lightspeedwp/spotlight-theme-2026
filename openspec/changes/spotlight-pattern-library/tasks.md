## 1. Lead-story hero and featured-story patterns (LS-1719 / PR 1)

- [ ] 1.1 Confirm `hero-lead-story` pattern definition: structure, content fields, and mapping to `front-page.html`'s `front-page__hero` insertion point
- [ ] 1.2 Confirm `featured-story` variant pattern(s): structure and distinction from `hero-lead-story`
- [ ] 1.3 Confirm `archive-listing-header` pattern definition (dark banner + title + search, per the Figma "Blog Landing Page" frame) and its mapping to `home.html`/`archive.html`'s `post-listing-header` group
- [ ] 1.4 Confirm `page-intro-banner` pattern definition (full-bleed photo + title + intro copy, per the Figma "About Page" frame) and its mapping to `page.html`'s currently-missing hero section
- [ ] 1.5 Record any dependencies on future homepage implementation issues in the spec/design docs

## 2. Story-card, archive-card, and section-band patterns (LS-1720 / PR 2)

- [ ] 2.1 Confirm `story-card` pattern definition covering: `home.html`/`archive.html` grid card, front-page Latest News/Special Projects/Perspectives rows, and `single.html` Recent Stories card
- [ ] 2.2 Confirm `topic-band` pattern definition with its two size variants: grid-with-counts (front page) and sidebar-list (`single.html` Explore topics)
- [ ] 2.3 Confirm CTA behaviour, hierarchy, and scanability consistency requirements across all `story-card` variants
- [ ] 2.4 Note any card-level decisions that depend on later template work
- [ ] 2.5 Style `home.html`/`archive.html`'s topic-filter pills (`wp:categories`) to match the Figma "Blog Landing Page" frame: rounded-full outline buttons, active state solid-filled
- [ ] 2.6 Style `home.html`/`archive.html`'s pagination (`wp:query-pagination`) to match the Figma "Blog Landing Page" frame: bordered previous/next controls, numbered page indicators, distinct active-page style

## 3. Trust, newsletter, and editorial-utility patterns (LS-1721 / PR 3)

- [ ] 3.1 Confirm `newsletter-signup` pattern definition with its two size variants: front-page (`front-page__provincial-newsletter`) and sidebar (`sidebar-editorial__newsletter`)
- [ ] 3.2 Confirm `republish-notice` pattern definition, including the CC BY-ND 4.0 attribution copy confirmed in the Figma client annotation
- [ ] 3.3 Confirm `parts/trust-bar.html` remains documented as an existing template part, explicitly out of this capability's pattern-definition scope
- [ ] 3.4 Note any dependencies on template parts or form-integration decisions (e.g. newsletter subscription handling)
- [ ] 3.5 Tighten `parts/sidebar-editorial.html` spacing, borders, and Explore-topics icon treatment to match the Figma "Single Blog Post" sidebar exactly

## 4. Related-coverage and onward-journey patterns (LS-1722 / PR 4)

- [ ] 4.1 Confirm `related-coverage` pattern definition covering `single.html`'s "Recent stories" query-loop card-row
- [ ] 4.2 Confirm the pattern's scope excludes recommendation logic/automation beyond the existing exclude-current/most-recent query shape
- [ ] 4.3 Identify any other contextual-callout or onward-journey surfaces for single articles and archive-adjacent pages
- [ ] 4.4 Add the missing "More from Spotlight" in-article callout to `single.html` (bordered box, heading, bulleted related-headline list) per the Figma "Single Blog Post" frame
- [ ] 4.5 Fix `single.html`'s two-column layout to an asymmetric article-wide/sidebar-narrow split (currently equal 50/50), matching the Figma frame's proportions
- [ ] 4.6 Reposition `single.html`'s article-header category label opposite the `spotlight-badge`, same row, per the Figma frame

## 5. Province, project, and dashboard-entry patterns (LS-1723 / PR 5)

- [ ] 5.1 Confirm `project-entry` pattern definition covering the front page's Special Projects card-row
- [ ] 5.2 Confirm `dashboard-promo` pattern definition with its two size variants: full banner (`front-page__dashboard-cta`) and compact card (`sidebar-editorial__dashboard-promo`)
- [ ] 5.3 Record the archive/category-page dashboard-placement question (raised in the Figma client annotation) as an open item for this pattern's implementation
- [ ] 5.4 Note any bespoke province/project surfaces that should become separate future issues rather than staying in the shared pattern library

## 6. Interactive provincial-map pattern (LS-2616 / PR 6)

- [ ] 6.1 Confirm `provincial-map` pattern definition scoped to the map+newsletter variant already placed in `front-page.html`
- [ ] 6.2 Document the hover/select province-tooltip interaction requirement, with technical approach (Interactivity API vs. non-JS fallback) flagged as open for the implementation PR
- [ ] 6.3 Confirm the "View our Provincial hub" CTA's destination content stays owned by the `project-entry`/province-hub pattern work, not duplicated here
- [ ] 6.4 Note the two later-phase map variants (dynamic latest-post swap, province-count grid) as explicitly deferred, not defined by this change

## 7. Cross-cutting styling fidelity (PR 7 — spans LS-1719–1723)

- [ ] 7.1 Define the `spotlight-badge` pattern once (solid brand-500 rounded-pill, white text, e.g. "In the Spotlight"/"Inside the Box") and reference it from every placement: front-page hero, `story-card` variants, single-post article header
- [ ] 7.2 Measure section spacing and content width directly against the Figma "Homepage", "Blog Landing Page", and "Single Blog Post" frames (do not guess) before adjusting `theme.json`'s `contentSize`/`wideSize`/spacing scale or any template's block gaps
- [ ] 7.3 Apply the measured spacing/content-width adjustments consistently across `single.html`, `home.html`, and `archive.html`
- [ ] 7.4 Sequence PR 7 early relative to PRs 2–4 (or establish it as a shared reference point) so those PRs don't each invent their own badge/spacing treatment before this one lands

## 8. Cross-cutting validation

- [ ] 8.1 Verify every `[... pattern placeholder]` marker across `templates/front-page.html`, `templates/home.html`, `templates/archive.html`, `templates/single.html`, and `parts/sidebar-editorial.html` maps to exactly one pattern in the spec
- [ ] 8.1a Cross-check all four Figma Ready-for-Dev page frames (`Homepage`, `Blog Landing Page`, `About Page`, `Single Blog Post` — node `234:8297`) against the templates to confirm no other hero/banner-shaped section is missing a pattern
- [ ] 8.2 Verify no pattern is defined without a corresponding insertion point or documented future need
- [ ] 8.3 Verify every pattern is labeled phase-1 or later, with none left unlabeled
- [ ] 8.4 Verify no podcast-specific, taxonomy/navigation, or SEO/migration pattern appears in the inventory
- [ ] 8.5 Run `openspec validate --strict spotlight-pattern-library` and resolve any reported issues

## 9. Review and archive

- [ ] 9.1 Share the spec/design with the user for review against the Figma design system and the seven PR-sized groupings
- [ ] 9.2 Confirm the seven-way PR split (or any adjustments) with whoever will implement LS-1719–1723, LS-2616, and the cross-cutting styling PR
- [ ] 9.3 Archive this change (`/opsx:archive`) once approved, promoting `specs/pattern-library/spec.md` into `openspec/specs/pattern-library/spec.md`
