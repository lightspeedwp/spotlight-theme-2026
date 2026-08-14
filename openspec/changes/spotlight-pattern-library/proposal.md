## Why

The template hierarchy shipped in LS-1705/LS-1714–1718 reserved insertion points for editorial content — `[Featured-story hero pattern placeholder]`, `[Blog Card pattern placeholder]`, `[Provincial-map pattern placeholder]`, and eleven others across `front-page.html`, `home.html`, `archive.html`, `single.html`, and `parts/sidebar-editorial.html` — but no `patterns/` directory exists yet and no pattern has been named, scoped, or sequenced. Editors cannot assemble real pages, and pattern-authoring work cannot start, until this breakdown exists. LS-1706 and its Linear sub-issues (LS-1719–1723, LS-2616) already describe the target pattern groups; this change turns that into a concrete, reviewable definition — pattern names, structure, phase-1-vs-later split, and dependencies — matching the planning discipline already used for LS-1704 (theme.json foundations) and LS-1705 (template hierarchy).

## What Changes

- Define the **lead-story hero and featured-story** pattern group (LS-1719): the front-page hero and its supporting featured-story variants.
- Define the **story-card, archive-card, and section-band** pattern group (LS-1720): secondary story cards used in `home.html`/`archive.html`'s grid and the front page's Latest News/Special Projects/Perspectives rows, plus topic/section-band patterns covering the front page's topic grid and `single.html`'s sidebar "Explore topics" list (its sidebar-list size variant).
- Define the **trust, newsletter, and editorial-utility** pattern group (LS-1721): the newsletter-signup pattern (front-page and sidebar size variants), the republish module (using the exact CC BY-ND 4.0 copy confirmed in the Figma client annotation), and other recurring credibility/utility surfaces. `parts/trust-bar.html` is confirmed already-built and out of scope for re-definition here.
- Define the **related-coverage and onward-journey** pattern group (LS-1722): `single.html`'s "Recent stories" query-loop card-row and any other contextual-callout/onward-journey surfaces, explicitly excluding recommendation-logic/automation decisions.
- Define the **province, project, and dashboard-entry** pattern group (LS-1723): the front page's Special Projects row, the dashboard-CTA banner, and the sidebar dashboard-promo module (its two confirmed size variants — full banner vs. compact card).
- Define the **interactive provincial-map** pattern (LS-2616), scoped to the single Figma variant confirmed "Ready for Dev" — the map paired side-by-side with the newsletter pattern — including its hover/select-tooltip interaction requirement as a flagged, unresolved implementation question (Interactivity API vs. simpler fallback).
- Resolve the two open pattern-sizing questions the LS-1705 design doc deferred: the dashboard-promo module is one pattern with a full/compact size variant (not two separate files), and the topic/section-band pattern is one pattern with a grid-with-counts/sidebar-list size variant (not two separate files) — both following the `kwv-theme-2026` structural precedent of size-suffixed pattern names rather than duplicated markup.
- Sequence the six pattern groups so each corresponds to one PR-sized unit of implementation work (see design.md), rather than one large PR covering the whole library.
- Explicitly exclude podcast-specific patterns, taxonomy/navigation rationalization, and SEO/migration concerns — all separate, not-yet-started LS-1696 work streams.

Out of scope for this change (see design.md Non-Goals): authoring any pattern's actual markup/content — this is a definition-only change, matching how LS-1705 preceded LS-1714–1718's implementation. No `patterns/*.html` or `patterns/*.php` files are created here.

## Capabilities

### New Capabilities
- `pattern-library`: The editorial pattern inventory for Spotlight — each pattern's name, purpose, structural composition, which template insertion point(s) it fills, its phase-1-vs-later status, and its dependencies on other patterns, template parts, or not-yet-built template/form/data integrations.

### Modified Capabilities
None — this change does not alter the `templates` or `template-parts` capabilities' requirements. It consumes their existing insertion points without changing template structure, and consumes `design-tokens`/`base-styles` presets without changing their requirements.

## Impact

- New files: `openspec/specs/pattern-library/spec.md` (this change's delta spec, later merged to the main spec tree).
- No theme code changes — no `patterns/`, `templates/`, `parts/`, or `theme.json` files are added or modified by this change.
- Unblocks: pattern-authoring implementation work for LS-1719, LS-1720, LS-1721, LS-1722, LS-1723, and LS-2616, each shippable as its own PR against this definition.
- Downstream dependency: the dashboard-CTA-on-archive-pages question raised in the Figma client annotation (pinning the dashboard block to category/archive pages, not just the front page and sidebar) is recorded as an open question for the LS-1723 implementation PR, not resolved here.
