# pattern-library Specification

## Purpose

Defines the reusable editorial pattern inventory for the Spotlight theme — each pattern's name, purpose, structural composition, which template insertion point(s) it fills, its phase-1-vs-later status, and its dependencies — so pattern-authoring implementation work has an agreed, reviewable target instead of ad hoc decisions made per PR.

## Requirements

### Requirement: Pattern inventory covers every existing template insertion point
Every `[... pattern placeholder]` marker present in `templates/front-page.html`, `templates/home.html`, `templates/archive.html`, `templates/single.html`, and `parts/sidebar-editorial.html` SHALL be mapped to exactly one named pattern defined by this capability. Every hero/banner-shaped section confirmed on a Figma Ready-for-Dev frame (`Homepage`, `Blog Landing Page`, `About Page`, `Single Blog Post` — node `234:8297`) SHALL also be mapped to a named pattern, even where the corresponding template currently authors that section as inline core blocks rather than a placeholder marker. No insertion point may be left unmapped, and no pattern may be defined without a corresponding insertion point or explicitly documented future template need.

#### Scenario: Every placeholder has an owning pattern
- **WHEN** a template file contains a `[... pattern placeholder]` marker
- **THEN** the pattern inventory names exactly one pattern responsible for filling it

#### Scenario: Perspectives and Explore-topics are not orphaned
- **WHEN** the front page's "Perspectives" card-row placeholder or `single.html`'s "Explore topics" sidebar list is reviewed
- **THEN** both resolve to a defined pattern (a `story-card` variant and a `topic-band` sidebar-list variant, respectively) rather than being left unmapped

#### Scenario: Non-placeholder hero sections are not orphaned
- **WHEN** `home.html`/`archive.html`'s inline `post-listing-header` markup or `page.html`'s bare `wp:post-title` (no banner) is reviewed against the matching Figma Ready-for-Dev frame
- **THEN** both resolve to a defined pattern (`archive-listing-header` and `page-intro-banner`, respectively) rather than being left as unmapped inline markup

#### Scenario: The in-article "More from Spotlight" callout is not orphaned
- **WHEN** the Figma "Single Blog Post" Ready-for-Dev frame's mid-article bordered callout box (heading + bulleted related-headline list) is reviewed against `single.html`
- **THEN** it resolves to a defined pattern (the `related-coverage` pattern's in-article variant) rather than being left unmapped, since no equivalent markup exists in `single.html` today

### Requirement: Spotlight status badge pattern
The pattern inventory SHALL define a `spotlight-badge` pattern for the solid brand-colored rounded-pill label (e.g. "In the Spotlight", "Inside the Box") confirmed as an overlay on featured images and article headers across the `Homepage`, `Blog Landing Page`, and `Single Blog Post` Ready-for-Dev frames. Because this badge is reused across multiple pattern groups rather than owned by a single one, it SHALL be defined once and referenced by every pattern that displays it, not redefined per placement.

#### Scenario: Badge is defined once and reused
- **WHEN** the `spotlight-badge` pattern is placed on the front-page hero, a `story-card` variant (e.g. Special Projects), and the single-post article header
- **THEN** all three placements reference the same `spotlight-badge` pattern definition, differing only by which term/label value is displayed

### Requirement: Lead-story hero pattern
The pattern inventory SHALL define a `hero-lead-story` pattern for the front page's primary headline treatment, structured to support a calm, curated editorial front page rather than a stacked latest-posts feed. No separate "featured-story" pattern is defined — confirmed by walking the Figma "Homepage" Ready-for-Dev frame section by section, every homepage element after the hero belongs to another pattern group (`story-card`, `topic-band`, `dashboard-promo`, `project-entry`, or `provincial-map`).

#### Scenario: Hero pattern fills the front-page hero insertion point
- **WHEN** `front-page.html`'s `front-page__hero` section is rendered
- **THEN** the `hero-lead-story` pattern supplies its content, replacing `[Featured-story hero pattern placeholder]`

### Requirement: Archive-listing header patterns
The pattern inventory SHALL define two dark-banner title-and-search patterns matching the Figma "Blog Landing Page" Ready-for-Dev frame: `archive-listing-header` for `home.html` (using `wp:post-title`, since the Posts Page is a real queried page object) and `archive-listing-header-archive` for `archive.html` (using `wp:query-title`, since a category/tag page's queried object is a taxonomy term, not a page). `core/query-title` has no mode that renders a static Posts Page title, so one shared pattern cannot correctly serve both templates.

#### Scenario: Archive-listing header fills the home page-header insertion point
- **WHEN** `home.html`'s `post-listing-header` group is reviewed
- **THEN** the `archive-listing-header` pattern supplies the banner, dynamic post-title, and search treatment shown in the Figma "Blog Landing Page" frame

#### Scenario: Archive-listing header (archive) fills the archive page-header insertion point
- **WHEN** `archive.html`'s `post-listing-header` group is reviewed
- **THEN** the `archive-listing-header-archive` pattern supplies the banner, dynamic term title, and search treatment shown in the Figma "Blog Landing Page" frame

### Requirement: Page-intro banner pattern
The pattern inventory SHALL define a `page-intro-banner` pattern for the full-bleed photo banner with title and intro copy confirmed on the Figma "About Page" Ready-for-Dev frame, filling `page.html`'s currently-missing hero section (today `page.html` renders only a bare `wp:post-title` with no banner).

#### Scenario: Page-intro banner fills the missing page.html hero
- **WHEN** `page.html` is reviewed
- **THEN** the `page-intro-banner` pattern is documented as its hero-section insertion point, resolving the gap where no hero pattern was previously mapped to static pages

### Requirement: Story-card, archive-card, and section-band patterns
The pattern inventory SHALL define a `story-card` pattern (covering `home.html`/`archive.html`'s grid card, the front page's Latest News/Special Projects/Perspectives card-rows, and `single.html`'s Recent Stories card, as shared structure with content-specific variants) and a `topic-band` pattern (covering the front page's topic grid and `single.html`'s sidebar "Explore topics" list as a full-grid-with-counts variant and a compact sidebar-list variant of the same pattern, not two independent patterns). CTA behavior, visual hierarchy, and scanability SHALL be consistent across all `story-card` variants.

The `story-card` pattern SHALL reuse the `spotlight-badge` pattern (via `require()`) for its image-overlay status label where present, and SHALL define a separate plain-text category label (brand-500 colored text, uppercase, no background/padding/border) for the label shown below the image — confirmed against the Figma "Special Projects" section as two distinct elements, not two styles of the same badge.

#### Scenario: Blog Card placeholder resolves to story-card
- **WHEN** `home.html` or `archive.html`'s post-template loop is reviewed
- **THEN** the `[Blog Card pattern placeholder]` resolves to the `story-card` pattern's default grid variant

#### Scenario: Topic-band has exactly two size variants
- **WHEN** the `topic-band` pattern is placed on the front page versus in `single.html`'s sidebar
- **THEN** both placements use the same `topic-band` pattern definition, differing only by a documented size variant (grid-with-counts vs. sidebar-list)

#### Scenario: Story-card's two category labels are distinct
- **WHEN** a `story-card` instance has both an image-overlay status badge and a below-image category label
- **THEN** the overlay badge reuses the existing `spotlight-badge` pattern, and the below-image label uses a separate plain-text category-label treatment, not a shared or duplicated component

### Requirement: Trust, newsletter, and editorial-utility patterns
The pattern inventory SHALL define a `newsletter-signup` pattern (with a front-page size variant and a sidebar/compact size variant), a `republish-notice` pattern using the Creative Commons BY-ND 4.0 attribution copy confirmed in the Figma design annotation, and any other recurring credibility/utility pattern needed by `parts/sidebar-editorial.html` or `single.html`. The already-built `parts/trust-bar.html` template part SHALL NOT be redefined as a pattern by this capability.

#### Scenario: Newsletter pattern covers both placements
- **WHEN** the front page's `front-page__provincial-newsletter` section and `parts/sidebar-editorial.html`'s newsletter module are both reviewed
- **THEN** both resolve to the `newsletter-signup` pattern, differing only by documented size variant

#### Scenario: Republish pattern carries confirmed legal copy
- **WHEN** the `republish-notice` pattern is defined
- **THEN** its content includes the CC BY-ND 4.0 attribution copy confirmed in the Figma client annotation, not placeholder or invented legal text

#### Scenario: Trust-bar stays a template part
- **WHEN** the pattern inventory is reviewed for completeness
- **THEN** `parts/trust-bar.html` is explicitly noted as an existing template part outside this capability's scope, not listed as a pattern requiring definition

### Requirement: Related-coverage and onward-journey patterns
The pattern inventory SHALL define a `related-coverage` pattern for `single.html`'s "Recent stories" query-loop card-row and an in-article variant for the bordered "More from Spotlight" callout (heading + bulleted related-headline list) confirmed on the Figma "Single Blog Post" frame, plus any other contextual-callout or onward-journey surface for single articles and archive-adjacent pages. This pattern's definition SHALL NOT specify recommendation logic or automation beyond the existing "exclude current post, most recent N" behavior already present in `single.html`.

#### Scenario: Recent stories resolves to related-coverage
- **WHEN** `single.html`'s "Recent stories" section is reviewed
- **THEN** it resolves to the `related-coverage` pattern, distinct from the `story-card` pattern used elsewhere

#### Scenario: More from Spotlight is a documented in-article variant
- **WHEN** the "More from Spotlight" bordered callout is reviewed
- **THEN** it resolves to the `related-coverage` pattern's in-article variant, distinct in structure (bordered box + bulleted list) from the "Recent stories" card-row variant, and is added to `single.html` where no equivalent markup exists today

#### Scenario: No recommendation automation is specified
- **WHEN** the `related-coverage` pattern's behavior is defined
- **THEN** it describes only the existing exclude-current/most-recent query shape, with any personalized or algorithmic recommendation approach left as an explicitly out-of-scope future decision

### Requirement: Province, project, and dashboard-entry patterns
The pattern inventory SHALL define a `project-entry` pattern for the front page's Special Projects card-row, and a `dashboard-promo` pattern for the dashboard-CTA banner and sidebar dashboard-promo module as a single pattern with a full-banner size variant and a compact-card size variant (not two independent pattern files).

#### Scenario: Dashboard-promo has exactly two size variants
- **WHEN** the front page's `front-page__dashboard-cta` section and `parts/sidebar-editorial.html`'s `sidebar-editorial__dashboard-promo` module are both reviewed
- **THEN** both resolve to the `dashboard-promo` pattern, differing only by documented size variant (full banner vs. compact card)

#### Scenario: Archive-page dashboard placement is deferred, not decided
- **WHEN** the dashboard-promo pattern's placements are enumerated
- **THEN** placing it on `archive.html`/category pages (raised in the Figma client annotation) is recorded as an open question for the pattern's implementation PR, not resolved by this capability

### Requirement: Interactive provincial-map pattern
The pattern inventory SHALL define a `provincial-map` pattern scoped to the single Figma-confirmed "Ready for Dev" variant: an SVG map of South Africa's nine provinces paired side-by-side with the `newsletter-signup` pattern, matching `front-page.html`'s `front-page__provincial-newsletter` section. The pattern's hover/select province-tooltip interaction SHALL be documented as a requirement with its technical approach left as an explicitly flagged open question, not resolved by this capability.

#### Scenario: Provincial-map placement matches the confirmed Figma variant
- **WHEN** the `provincial-map` pattern is defined
- **THEN** it specifies only the map-plus-newsletter layout already placed in `front-page.html`, excluding the dynamic latest-post-swap and province-count-grid variants seen in Figma but not marked Ready for Dev

#### Scenario: Tooltip interaction is a documented, unresolved requirement
- **WHEN** the `provincial-map` pattern's interactivity is reviewed
- **THEN** the requirement for a hover/select province-name tooltip is documented, and the choice between the WordPress Interactivity API and a simpler non-JS fallback is recorded as an open question for the pattern's implementation PR

#### Scenario: Province-hub destination stays out of scope
- **WHEN** the `provincial-map` pattern's "View our Provincial hub" CTA is reviewed
- **THEN** the destination page's content is defined by the `project-entry`/province-hub pattern work, not duplicated inside the `provincial-map` pattern definition

### Requirement: Phase-1 versus later pattern split
Every pattern in the inventory SHALL be explicitly labeled as phase-1 (required to complete the existing template placeholders) or later (deferred), with no pattern left unlabeled.

#### Scenario: All patterns tied to an existing placeholder are phase-1
- **WHEN** a pattern fills a placeholder already present in a merged template file
- **THEN** it is labeled phase-1

#### Scenario: Deferred map variants are labeled later, not phase-1
- **WHEN** the dynamic latest-post-swap and province-count-grid map variants are recorded
- **THEN** they are labeled later, since no template placeholder currently requires them

**Pattern inventory phase labels:**

| Pattern | Phase | PR |
|---------|-------|-----|
| `hero-lead-story` | Phase 1 | PR 1 |
| `archive-listing-header` | Phase 1 | PR 1 |
| `archive-listing-header-archive` | Phase 1 | PR 1 |
| `page-intro-banner` | Phase 1 | PR 1 |
| `spotlight-badge` | Phase 1 | PR 1 |
| `story-card` (grid, Latest News/Special Projects/Perspectives, Recent Stories variants) | Phase 1 | PR 2 |
| `topic-band` (grid-with-counts + sidebar-list-compact size variants) | Phase 1 | PR 2 |
| `newsletter-signup` (front-page + sidebar-compact size variants) | Phase 1 | PR 3 |
| `republish-notice` | Phase 1 | PR 3 |
| `related-coverage` (card-row + in-article "More from Spotlight" variants) | Phase 1 | PR 4 |
| `project-entry` | Phase 1 | PR 5 |
| `dashboard-promo` (full-banner + sidebar-compact size variants) | Phase 1 | PR 5 |
| `provincial-map` (map+newsletter, confirmed Ready for Dev) | Phase 1 | PR 6 |
| `provincial-map` (dynamic latest-post-swap variant) | Later | not Ready for Dev in Figma |
| `provincial-map` (province-count-grid variant) | Later | not Ready for Dev in Figma |

### Requirement: Archive filter and pagination styling parity
`home.html`/`archive.html`'s topic-filter pills (`wp:categories`) and pagination controls (`wp:query-pagination`) SHALL be styled to match the Figma "Blog Landing Page" Ready-for-Dev frame's rounded-pill filter buttons (active/inactive states) and bordered previous/next-plus-numbered-page pagination control, since both currently render as unstyled default core-block markup.

#### Scenario: Filter pills show active/inactive states
- **WHEN** the topic-filter pills on `home.html`/`archive.html` are reviewed against the Figma "Blog Landing Page" frame
- **THEN** the currently-selected filter is styled as a solid accent-filled pill and all other filters as bordered outline pills, matching the design

#### Scenario: Pagination is styled, not default
- **WHEN** `home.html`/`archive.html`'s pagination control is reviewed against the Figma "Blog Landing Page" frame
- **THEN** it displays bordered previous/next controls and numbered page indicators with a distinct active-page style, rather than unstyled default core-block markup

### Requirement: Single-post layout and spacing parity
`single.html`'s two-column layout SHALL use an asymmetric article/sidebar column split (article wider than sidebar) matching the Figma "Single Blog Post" Ready-for-Dev frame, rather than the current equal-width two-column grid. The article header's category label SHALL be positioned per the design (opposite the `spotlight-badge`, same row), and global section/content spacing across `single.html`, `home.html`, and `archive.html` SHALL be measured against the Figma frames rather than assumed.

#### Scenario: Article column is wider than the sidebar
- **WHEN** `single.html`'s two-column layout is reviewed
- **THEN** the article column occupies a visibly larger share of the row than the `sidebar-editorial` column, matching the Figma frame's proportions

#### Scenario: Spacing is measured, not guessed
- **WHEN** section spacing and content width are adjusted on `single.html`, `home.html`, or `archive.html`
- **THEN** the adjustment is based on a direct measurement against the corresponding Figma frame, not an unverified assumption

### Requirement: Podcast and undecided-direction patterns excluded
The pattern inventory SHALL NOT define any podcast-specific pattern, and SHALL NOT define taxonomy/navigation-rationalization or SEO/migration patterns, since those product directions remain undecided per LS-1696.

#### Scenario: No podcast pattern appears in the inventory
- **WHEN** the pattern inventory is reviewed for completeness
- **THEN** no pattern references podcast-specific content or layout
