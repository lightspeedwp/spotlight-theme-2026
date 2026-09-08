## Why

Spotlight currently ships only `templates/index.html` (a generic query-loop) and a two-block `header.html`/`footer.html`. Nothing shipped in LS-1709/1710/1711 (design tokens, base element/button/quote styles) has ever been verified on a real front-end page — only in the editor canvas — because there is no `single.html` or `page.html` to render one. LS-1704's remaining sub-issues (LS-1712, LS-1713) also can't be meaningfully worked until real templates exist. The Figma "Spotlight Design System" file now has front-page, posts-index, single-post, and page frames marked ready for dev, so the template hierarchy and shared template parts can be defined against real designs rather than placeholders.

## What Changes

- Add `front-page.html` — curated homepage composed entirely of pattern insertion points (hero, topic grid, latest-news row, dashboard CTA, special projects, provincial coverage + newsletter, perspectives, trust bar), no query loop.
- Add `home.html` — the site's Posts Page ("Latest News" in the design): page-header with search, topic-filter pills, 3-column post-card grid, pagination.
- Add `archive.html` — renders category/tag term URLs reached by clicking a topic pill (real page navigation, no JS filtering); shares the home.html grid/sidebar/trust-bar structure. Covers both category and tag archives; no per-taxonomy split yet.
- Add `single.html` — post template with category label, headline, byline/date, featured image, lead paragraph, body, pull-quote, "More from Spotlight" box, republish module, prev/next navigation, related-posts query, and a sidebar template-part slot.
- Add `page.html` — prose template with optional hero and the same sidebar template-part slot as `single.html`.
- Add `search.html` and `404.html` — no design source exists for either; both reuse the home/archive grid-and-trust-bar scaffolding (no pills) as a calm, functional default rather than inventing new layout.
- Keep `index.html` as WordPress's required fallback-of-last-resort; not redesigned in this change.
- Rework `parts/header.html` — add a utility bar (newsletter/republish links), search trigger, and a "Dashboards" CTA button alongside the existing site-logo/navigation.
- Rework `parts/footer.html` — add a logo/nav-links row, certification badge, and social-icons row alongside the existing copyright line.
- Add `parts/trust-bar.html` — the red credibility band (Independent / Evidence-based reporting / 10 years of impact / Free to republish / Focused on public health), reused above the footer on every template.
- Add `parts/sidebar-editorial.html` — the reusable dashboard-promo-card + newsletter-subscribe-card + explore-topics-list module, reused identically by `single.html` and `page.html`.
- Register all new templates and template parts in `theme.json`'s `templateParts`/`customTemplates` as needed.

Out of scope for this change (see design.md Non-Goals): actual pattern markup/content for the hero, card grids, dashboard modules, newsletter modules, provincial map, and republish module (no `patterns/` directory exists yet); resolving whether the dashboard-promo and explore-topics modules are one flexible pattern or two size-specific patterns; new design tokens; further button/quote styling (LS-1711 already covers this; a "FEATURED" quote variant spotted in the designs is flagged as a possible base-styles follow-up, not built here).

## Capabilities

### New Capabilities
- `templates`: The page-level template hierarchy (`front-page`, `home`, `archive`, `single`, `page`, `search`, `404`, `index`) — which WordPress template file renders which URL, and each template's structural composition (layout, column structure, template-part slots, pattern insertion points).
- `template-parts`: The reusable template parts (`header`, `footer`, `trust-bar`, `sidebar-editorial`) — their structural composition and which templates include them.

### Modified Capabilities
None — this change consumes the existing `design-tokens` and `base-styles` capabilities' presets/element styles without changing their requirements.

## Impact

- New files: `templates/front-page.html`, `templates/home.html`, `templates/archive.html`, `templates/single.html`, `templates/page.html`, `templates/search.html`, `templates/404.html`; `parts/trust-bar.html`, `parts/sidebar-editorial.html`.
- Modified files: `parts/header.html`, `parts/footer.html`, `theme.json` (`templateParts`/`customTemplates` registration).
- Unchanged: `templates/index.html` (kept as fallback), all `design-tokens`/`base-styles` settings and styles.
- No new dependencies, no build-pipeline changes (theme remains JS-build-free per AGENTS.md).
- Unblocks: real front-end verification of LS-1711's base styles/buttons; LS-1704's remaining sub-issues (LS-1712, LS-1713); future pattern-authoring work (dashboard-promo, explore-topics, hero, card-grid, newsletter, republish patterns).
