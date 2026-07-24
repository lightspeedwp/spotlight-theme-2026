# Spotlight Theme 2026 — WordPress Block Theme Rebuild

Spotlight Theme 2026 is a new WordPress block theme rebuild for Spotlight. The goal is to replace the current legacy-style front end with a clearer editorial system that supports long-form reading, recurring content products, reusable page-building patterns, and stronger trust signals.

This repository is being delivered in small, reviewable implementation slices. The rebuild is planned as a block-theme-first project rather than a surface-level reskin.

---

## What This Repo Is

This repo is the working home for the Spotlight block theme rebuild.

It is intended to:
- establish the theme foundation and design tokens early
- define a reusable template hierarchy and shared editorial layout rules
- build a focused pattern library for repeatable editorial surfaces
- keep later decisions, such as taxonomy rationalisation and SEO or migration handling, as explicit follow-up work

---

## Delivery Approach

The current rebuild plan is organised into a few broad phases:

### Phase 1: Project foundations
- confirm the rebuild scope
- document the open decisions that still need stakeholder input
- define the first delivery slices and issue structure

### Phase 2: Theme architecture and tokens
- establish `theme.json` foundations
- define global styles, spacing, typography, colour, and shared theme settings
- set the base rules for template parts and editorial layout consistency

### Phase 3: Pattern and template breakdown
- break the work into reusable patterns and templates
- separate page-level work from shared components
- keep investigations, dashboards, newsletters, podcast modules, provinces, and campaign layouts in focused issues where needed

### Phase 4: Open questions and rollout planning
- confirm taxonomy rationalisation
- confirm SEO and content-migration handling
- prioritise the backlog so work can ship in frequent pull requests

---

## Follow-On Specs

The implementation backlog is expected to split into these main specs:

- `spotlight-theme-foundations`
- `spotlight-template-hierarchy`
- `spotlight-pattern-library`
- `spotlight-taxonomy-and-navigation`
- `spotlight-seo-and-migration`

---

## Repo Layout

- `style.css` and `readme.txt` carry the theme metadata
- `theme.json` defines the global block-theme settings and styles
- `functions.php` contains minimal theme setup
- `templates/` and `parts/` hold block templates and template parts
- `patterns/` holds reusable editorial patterns
- `styles/` holds style variations
- `docs/` is for end-user documentation
- `.github/` and `.agents/` contain repo guidance, prompts, and reusable agent assets

---

## Validation

Use the repo scripts before shipping changes:

- `npm run theme:validate`
- `npm run schema:validate`
- `npm run patterns:escape`
- `npm run security:scan`
- `composer run phpcs`
- `composer run lint:php`

---

## Notes

- `readme.txt` is the lightweight WordPress distribution file.
- This `README.md` is the developer-facing project overview and rebuild guide.
- Taxonomy, SEO, and migration handling will stay as separate decisions until they are confirmed.

---

## License

See [LICENSE](./LICENSE).
