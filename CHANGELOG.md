# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased]

### Added

- `.wp-block-search__button` outline style and `.trust-bar__item` divider rule in `template-parts.css`, closing the visual gap between the built `header`/`trust-bar` parts and the Figma design (found during LS-1712's front-end review).
- `docs/foundation-exceptions.md` — documents every custom CSS exception beyond native `theme.json`/block-support styling (button icon states in `custom-button.css`/`core-button.css`, the trust-bar spacing helpers and FAIR-badge background-image in `template-parts.css`, and the `core/quote`/`core/pullquote` citation `css` overrides in `theme.json`), why each is necessary, and where it lives (see LS-1713).
- `.github/reports/2026-08-12-editor-styling-parity-verification.md` — verifies typography/spacing/width/core-style parity between the front end and the block editor across the real templates and parts landed under LS-1714–1718, confirming the `enqueue_block_assets` strategy from LS-1709–1711 holds up; documents the accepted phase-1 limitation that placeholder pattern content can't be fully parity-checked until the patterns phase (see LS-1712).
- `templates/front-page.html` — the curated homepage: hero, "Explore by topic," "Latest news," dashboard-CTA banner, "Special Projects," provincial coverage + newsletter, and "Perspectives" sections, each a structural placeholder pending pattern-authoring work; no `core/query` block, `header`/`trust-bar`/`footer` parts (see LS-1718).
- `templates/search.html` — reuses the home/archive card-grid structure with an inherited `core/query` block bound to the search query and a `core/query-title` showing the search term, no topic-filter pills (see LS-1718).
- `templates/404.html` — a calm "Page not found" message plus a `core/search` form, no post query loop (see LS-1718).
- `templates/single.html` — post content (category, title, byline/date, featured image, content) plus the shared `sidebar-editorial` template part and a single-post-specific "Explore topics" module — a `core/terms-query` scoped via `termQuery.include` to the 7 real categories matching the design's curated topic list (Latest, HIV/AIDS, TB, NHI, Access to Medicines, Healthcare system, NCDs), per Zared's PR #6 review feedback, rather than a static hand-typed list — a `[Republish pattern placeholder]` (the CC-licence republish box from the design, deferred to the patterns phase per `design.md`'s stated non-goals), previous/next post navigation, and a "Recent stories" query using the Advanced Query Loop plugin's "exclude current post" option, so the post being viewed never appears in its own recent-stories list (see LS-1717). No custom category matching — this is a plain latest-posts query, per Zared's PR #6 review feedback.
- `templates/page.html` — prose content plus the shared `sidebar-editorial` template part, with no post-meta elements (see LS-1717).
- `templates/home.html` — the site's Posts Page: page header (title + search), a real `core/categories` topic-filter list, an inherited/paginated `core/query` post grid, `header`/`trust-bar`/`footer` template parts (see LS-1716). Each card is a `[Blog Card pattern placeholder]`, pending the design-system pattern Zared confirmed will be authored in the upcoming patterns phase, per his review feedback on PR #5.
- `templates/archive.html` — shares `home.html`'s grid structure for category/tag/date archive URLs, with a dynamic `core/query-title` in place of the static "Latest news" heading; no separate `category.html`/`tag.html` needed yet (see LS-1716).
- Reworked `parts/header.html`: a utility bar (newsletter/republish links), the site logo, an icon-only `core/search` trigger, and a "Dashboards" CTA button (reusing the existing `is-style-dashboard` variation) (see LS-1714/LS-1715).
- Reworked `parts/footer.html`: site logo, a secondary-navigation links row, and a `core/social-links` row, alongside the existing copyright line (see LS-1714/LS-1715).
- `parts/trust-bar.html` — the five-item credibility band (Independent, Evidence-based reporting, 10 years of impact, Free to republish, Focused on public health), included above the footer (see LS-1714/LS-1715).
- `parts/sidebar-editorial.html` — the reusable dashboard-promo/newsletter-subscribe sidebar module, shared by `single.html`/`page.html`. Its inner content is explicitly placeholder pending pattern-authoring work; the "Explore topics" module seen in the same design frames is single-post-specific and lives in `single.html` itself, not this shared part (see LS-1714/LS-1715, corrected under LS-1717).
- `assets/logos/site-logo.svg` for the header/footer `wp:site-logo` blocks. Icons (header utility bar, trust-bar) are rendered via the Icon Block plugin (`outermost/icon-block`) directly in each template's markup, per Zared's review feedback on PR #4 — no custom CSS icon styling.
- `add_theme_support( 'custom-logo' )` in `functions.php` for the header/footer `wp:site-logo` blocks (no width/height constraints — each instance is sized in its own pattern markup, per Zared's review feedback on PR #4).
- `openspec/changes/spotlight-template-hierarchy/` proposal, design, `templates`/`template-parts` capability specs, and task list for LS-1714/LS-1715's template hierarchy work.
- Audited Spotlight design-token foundations in `theme.json`: colour palette (Brand Red, Accent Navy, and Neutral 9-step ramps, system colours, surface colours), self-hosted Libre Baskerville/Source Sans 3 variable fonts, a 7-step font-size scale, an 11-step spacing scale, a 7-step border-radius scale, and a `settings.custom.borderWidth` token family.
- `openspec/specs/design-tokens/` capability spec, documenting the design-token requirements for future template/pattern work to build on.
- Base element styling in `theme.json`: default button look, `core/quote`/`core/pullquote` border accent and citation styling, `core/list`/`core/list-item` marker colour and spacing, and heading top/bottom margin rhythm (see LS-1711). List marker/spacing and heading/paragraph spacing rhythm values are provisional (no design source yet) pending design confirmation.
- Three named `core/button` block-style variations — `styles/blocks/button/primary.json`, `dark.json`, `dark-pill.json` — matching the dashboard CTA, article action, and header nav CTA button treatments confirmed in Figma dev-mode frames.
- `openspec/specs/base-styles/` capability spec, documenting the base element/block styling requirements this change adds.
- `openspec/changes/archive/2026-08-05-spotlight-global-styles-and-block-rules/` proposal, design, and task artifacts for LS-1711.

### Changed

- `parts/header.html` finalized against a version built and adjusted directly in the Site Editor: the utility links, logo, and search/Dashboards row now use a `core/columns` layout (three vertically-centered columns) instead of a plain flex group; the site logo is larger (`width:290`, centered); the search block uses `isSearchFieldHidden` plus native `backgroundColor:"base"`/`textColor:"contrast"` attributes instead of relying on custom CSS for its color; the nav row explicitly zeroes its left/right border via block attributes; the nav references a real saved Navigation menu (`ref`) with its own type scale/spacing. Simplified the header search-button CSS in `template-parts.css` to add only the border (the one thing with no block-attribute equivalent) now that color comes from the block's own native attributes — the earlier `!important`-laden rule fighting over background/text color is gone.
- Fixed the actual root cause of the header's `align:"wide"` not taking effect: WordPress wraps a template part's rendered content in its own outer tag (`render_block_core_template_part()`), so `align` has to be set on the `<!-- wp:template-part /-->` **invocation** in each template — the direct child of the site's root content area — not on the part file's own internal root block, which sits one level too deep to ever match the alignment CSS. Moved `align:"wide"` onto every `<!-- wp:template-part {"slug":"header",...} /-->` call across all eight templates; `parts/header.html`'s own root group no longer sets its own `align`, and its two child rows (`site-header__top`, `site-header__nav`) now both carry `align:"wide"` so they fill that corrected width. The nav row's apparent "border on all four sides" was this same bug — it was centered and narrower than the row above it, not actually bordered on the sides.
- Removed the duplicate `wp:site-tagline` from the header — the tagline is already baked into the logo image; added `verticalAlignment:"center"` to the header's flex rows so the utility links, logo, and search/Dashboards line up now that the duplicate tagline isn't throwing off the row's height.
- `parts/header.html` restructured to match the design's actual two-row layout, corrected after a second front-end review: previously the utility bar (newsletter/republish links) was its own top row with the logo/nav/search/Dashboards bundled into a second row. The design instead puts utility links + logo/tagline + search + Dashboards together in **one** row, with the nav menu as a **separate** row below it, boxed in its own top-and-bottom border. `site-utility-bar` was folded into the header's single top row (`site-header__top`); the bordered band moved from under the utility links onto the new dedicated nav row (`site-header__nav`), and the nav itself now centers instead of right-aligning (LS-1712 follow-up).
- Every template's outer `<main>` group, plus its direct content children (post-listing header, `core/categories`, `core/query`, the single/page two-column grid, and each `front-page.html` section), now use `align:"wide"` instead of defaulting to the 800px `contentSize` column — the same "content too narrow" root cause as the header/footer/trust-bar fix below, found to apply site-wide once checked. `front-page.html`'s dashboard-CTA band now uses `align:"full"` for its coloured background with an inner `align:"wide"` wrapper around its text, matching the trust-bar's full-bleed-colour/wide-content pattern (LS-1712 follow-up).
- `parts/header.html`, `parts/footer.html`, `parts/trust-bar.html` — corrected against the Figma design after a front-end review flagged them as visually off (LS-1712 follow-up): the utility bar, header row, footer, and trust-bar's inner content row now use `align:"wide"` (the trust-bar's coloured band uses `align:"full"`) instead of defaulting to the 800px `contentSize` column, which was also why the trust bar's five items wrapped into two rows. Added a divider border under the header utility bar and above the footer copyright row; added the footer's site tagline; moved `core/social-links` into the copyright row with the built-in "Logos Only" style, forced to a monochrome `contrast` icon colour to match the design instead of each service's brand colour; un-styled the footer nav links' and header utility-bar links' default blue/underline via a block-level `elements.link` override; added vertical padding to the header row and utility bar for breathing room; set `fontFamily:"heading"` on the trust-bar's five item titles, which were rendering in the body typeface. Fixed the Press Council/FAIR badge — previously an empty, CSS-`background-image`-styled `<p>` (a `wp:html` block) — to a real `wp:image` referencing `assets/logos/fair-logo.png`. Fixed a spacing regression in the footer copyright row (©/2026/site-title/"All rights reserved." rendering with large gaps instead of a normal reading rhythm) introduced by an earlier restructuring that dropped its `blockGap` override.
- `functions.php` — the three enqueued custom stylesheets (`custom-button.css`, `core-button.css`, `template-parts.css`) are now versioned by `filemtime()` instead of the static theme version string, so front-end edits to these files aren't indefinitely browser-cached during active development.
- Replaced the placeholder colour palette, font sizes, and spacing scale in `theme.json` with the audited Spotlight values (see LS-1704/LS-1709/LS-1710).
- Updated `settings.layout.contentSize`/`wideSize` to 800px/1320px.
- Cleaned up `styles/light.json` and `styles/dark.json`, which duplicated the old placeholder palette; `dark.json`'s background/text inversion is preserved with updated colours.
- Corrected `styles.elements.link` colour from the brand ramp (`brand-500`/`brand-600`) to `accent-200`/`accent-300`, confirmed against real body-copy links; `brand-500` remains reserved for category badges/labels (see LS-1711).
- Updated `AGENTS.md`'s guidance on `styles/blocks/`/`styles/sections/` files: WordPress core auto-registers these as selectable block style variations (confirmed working), correcting the previous claim that they required manual PHP registration.

### Deprecated

### Removed

### Fixed

- Header navigation now uses the mobile overlay menu to keep narrow-screen navigation accessible.
- Footer markup no longer nests the Site Title block inside a paragraph, preventing invalid heading-in-paragraph output.
- Fixed `theme-utils.mjs`'s `validate-schema` command to check block-style-variation partial files (`styles/blocks/**/*.json`) at their real runtime position instead of the flat root `styles` shape, and to work around a confirmed upstream schema/`ajv` limitation with pseudo-selector property names.

### Security

---

## [1.0.0] - 2026-07-24

### Added

- Initial starter repository scaffold for LightSpeed WordPress block themes.
- Root theme files: `style.css`, `theme.json`, `functions.php`, `readme.txt`.
- Block template: `templates/index.html`.
- Block template parts: `parts/header.html`, `parts/footer.html`.
- Style variations: `styles/light.json`, `styles/dark.json`.
- Asset folders: `assets/fonts/`, `assets/icons/`, `assets/logos/`, `assets/images/`, `assets/css/`, `assets/js/`.
- Validation and utility script: `theme-utils.mjs`.
- Node-based tooling: `package.json`, `.lintstagedrc.json`, `.nvmrc`.
- PHP tooling: `composer.json`.
- GitHub config: `.editorconfig`, `.gitignore`, `.gitattributes`, `.coderabbit.yml`, `CODEOWNERS`.
- AI guidance: `AGENTS.md`, `CLAUDE.md`.
- GitHub Copilot instructions: `.github/copilot-instructions.md`, `.github/instructions/`.
- GitHub prompts: `.github/prompts/`.
- GitHub reports folder: `.github/reports/`.
- GitHub tasks folder: `.github/tasks/`.
- GitHub Actions workflows: `ci.yml`, `code-quality.yml`, `release.yml`.
- Portable agent assets: `.agents/skills/`, `.agents/agents/`.
- End-user documentation folder: `docs/`.

---

[Unreleased]: https://github.com/lightspeedwp/spotlight-theme-2026/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/lightspeedwp/spotlight-theme-2026/releases/tag/v1.0.0
