# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased]

### Added

- `templates/single.html` — post content (category, title, byline/date, featured image, content) plus the shared `sidebar-editorial` template part and a single-post-specific "Explore topics" module (a curated static list, matching the specific topics shown in the design rather than every registered category), previous/next post navigation, and a "Recent stories" related-posts query scoped to the current post's categories via a new `query_loop_block_query_vars` filter in `functions.php` (see LS-1717).
- `templates/page.html` — prose content plus the shared `sidebar-editorial` template part, with no post-meta elements (see LS-1717).
- Reworked `parts/header.html`: a utility bar (newsletter/republish links), the site logo, an icon-only `core/search` trigger, and a "Dashboards" CTA button (reusing the existing `is-style-dashboard` variation) (see LS-1714/LS-1715).
- Reworked `parts/footer.html`: site logo, a secondary-navigation links row, and a `core/social-links` row, alongside the existing copyright line (see LS-1714/LS-1715).
- `parts/trust-bar.html` — the five-item credibility band (Independent, Evidence-based reporting, 10 years of impact, Free to republish, Focused on public health), included above the footer (see LS-1714/LS-1715).
- `parts/sidebar-editorial.html` — the reusable dashboard-promo/newsletter-subscribe sidebar module, shared by `single.html`/`page.html`. Its inner content is explicitly placeholder pending pattern-authoring work; the "Explore topics" module seen in the same design frames is single-post-specific and lives in `single.html` itself, not this shared part (see LS-1714/LS-1715, corrected under LS-1717).
- New icon assets in `assets/icons/` (`envelope`, `newspaper`, `shield`, `magnifying-glass`, `two-person`, `heart`) and `assets/logos/site-logo.svg`, plus `assets/css/template-parts.css` applying them via CSS `mask-image`.
- `add_theme_support( 'custom-logo' )` in `functions.php` for the header/footer `wp:site-logo` blocks.
- `openspec/changes/spotlight-template-hierarchy/` proposal, design, `templates`/`template-parts` capability specs, and task list for LS-1714/LS-1715's template hierarchy work.
- Audited Spotlight design-token foundations in `theme.json`: colour palette (Brand Red, Accent Navy, and Neutral 9-step ramps, system colours, surface colours), self-hosted Libre Baskerville/Source Sans 3 variable fonts, a 7-step font-size scale, an 11-step spacing scale, a 7-step border-radius scale, and a `settings.custom.borderWidth` token family.
- `openspec/specs/design-tokens/` capability spec, documenting the design-token requirements for future template/pattern work to build on.
- Base element styling in `theme.json`: default button look, `core/quote`/`core/pullquote` border accent and citation styling, `core/list`/`core/list-item` marker colour and spacing, and heading top/bottom margin rhythm (see LS-1711). List marker/spacing and heading/paragraph spacing rhythm values are provisional (no design source yet) pending design confirmation.
- Three named `core/button` block-style variations — `styles/blocks/button/primary.json`, `dark.json`, `dark-pill.json` — matching the dashboard CTA, article action, and header nav CTA button treatments confirmed in Figma dev-mode frames.
- `openspec/specs/base-styles/` capability spec, documenting the base element/block styling requirements this change adds.
- `openspec/changes/archive/2026-08-05-spotlight-global-styles-and-block-rules/` proposal, design, and task artifacts for LS-1711.

### Changed

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
