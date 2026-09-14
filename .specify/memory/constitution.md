<!--
SYNC IMPACT REPORT
Version change: [TEMPLATE] → 1.0.0 (initial ratification)
Modified principles: n/a — first ratification, all principles newly defined from AGENTS.md
Added sections: Core Principles (I–VII), Site Identity & Scope Constraints,
  Spec-Driven Workflow & Branching, Governance
Removed sections: none
Templates requiring updates: none — plan/spec/tasks templates reference the constitution
  generically and need no direct edits
Follow-up TODOs: none
This report is scratch material for human review; remove it once the amendment is reviewed.
-->

# Spotlight Theme 2026 Constitution

## Core Principles

### I. Theme-First Architecture
`theme.json` is the primary source of truth for colour, typography, spacing, and layout —
prefer it over PHP or CSS for anything it can express. `functions.php` MUST stay minimal:
only block-support registration, asset enqueuing, or editor styles belong there. `inc/` is
for genuine PHP logic that does not fit `functions.php`; it MUST NOT grow into a plugin-like
architecture. Do not invent PHP mechanisms that `theme.json` already handles natively.

### II. PHP Minimalism
Keep PHP surface area as small as sensibly possible. Prefer WordPress core hooks and filters
over custom implementations. Do not add features that belong in a plugin rather than a theme.

### III. Accessibility as a Baseline, Not an Add-On
All templates and patterns MUST use semantic HTML with correct heading hierarchy (no skipped
levels). Images MUST carry descriptive `alt` text. Interactive elements MUST be keyboard
accessible. WCAG 2.1 AA is the minimum bar for every new template, pattern, or style
variation. ARIA attributes are used only where genuinely needed — never as decoration, never
as a substitute for semantic markup. Focus styles MUST NOT be removed.

### IV. Security by Default
Every PHP `echo` MUST use the correct escaping function (`esc_html()`, `esc_attr()`,
`esc_url()`, `wp_kses_post()`). All external input MUST be sanitised (`sanitize_text_field()`,
`absint()`, etc.) and validated before use. `eval()` is forbidden. Raw output of `$_GET`,
`$_POST`, or similar superglobals is forbidden. Direct database queries MUST use
`$wpdb->prepare()`. `patterns/*.php`, `inc/**/*.php`, and `functions.php` receive extra review
scrutiny because they are the theme's most common source of escaping defects.

### V. Small Diffs and Dependency Discipline
Changes MUST be minimal and targeted — do not rewrite files that do not need rewriting. Do
not add npm or Composer dependencies without clear justification. Do not introduce a build
pipeline (Webpack, Vite, or similar) unless it is explicitly and deliberately added as its own
decision, never as a side effect of another task. Do not add abstractions, feature flags, or
speculative generality beyond what the current task requires.

### VI. Verify WordPress Core Behavior Before Implementing
WordPress core mechanics that silently no-op on a wrong assumption (layout types, `blockGap`
and margin handling, attribute serialization, DB template overrides shadowing file edits) MUST
be verified against actual core source (`wp-includes/block-supports/*.php`, a block's own
`block.json`) or against `.agents/skills/wp-block-pattern-gotchas/SKILL.md` before being
implemented. Do not guess at core behavior from memory when the source is one read away.

### VII. Conventions Have a Fixed Home
Reports go in `.github/reports/`. Task lists live in `.github/tasks/` and are kept current as
work starts, progresses, and completes. Reusable AI skills live in `.agents/skills/`. Agent
persona definitions live in `.agents/agents/`. Copilot prompt files live in `.github/prompts/`.
End-user documentation lives in `docs/` and stays human-readable — developer reports do not
belong there. `CHANGELOG.md` (Keep a Changelog / SemVer) is updated under `## [Unreleased]`
for every meaningful change and moved to a versioned section on release.

## Site Identity & Scope Constraints

Spotlight is a specific WordPress block theme for a specific client site
(spotlightnsp.co.za) — not a reusable starter or a WordPress.org submission. Its identity
(`spotlight-theme-2026` slug and text domain, theme name, author, URIs) is final, not a
placeholder awaiting replacement; keep it consistent across `style.css`, `theme.json`,
`composer.json`, and `package.json`. Do not reintroduce `{{...}}`-style placeholder tokens —
those belong to the starter theme this project was bootstrapped from. Do not flag real,
hard-coded, site-specific values (a navigation menu `ref`, real asset paths, real content) as
portability gaps; they are correct for this site. Do not add WordPress.org-specific
bureaucracy unless it has clear, concrete value.

## Spec-Driven Workflow & Branching

This project uses GitHub Spec Kit (`/speckit-*` skills, artifacts under `specs/`) as its
active spec-driven workflow for all feature work from 2026-09-14 onward: `/speckit-specify` →
`/speckit-clarify` (recommended) → `/speckit-plan` → `/speckit-tasks` → `/speckit-checklist`
and/or `/speckit-analyze` (optional) → `/speckit-implement` → `/speckit-converge` (optional).
Do not skip `spec.md` and go straight to `/speckit-plan`. Prefer running `/speckit-clarify`
before `/speckit-plan`, not after. If scope changes mid-feature, update `spec.md` first and
re-run `/speckit-plan` and `/speckit-tasks` so downstream artifacts stay consistent — they do
not auto-update.

`openspec/` is a **frozen historical record** of work already designed and shipped before this
constitution's ratification (`base-styles`, `design-tokens`, `pattern-library`,
`template-parts`, `templates`, and their archived change proposals). It MUST NOT be edited,
extended, or treated as active guidance going forward; it exists purely so past decisions and
their rationale remain traceable.

Create or switch to the feature's branch before running any `/speckit-*` command — specs are
written against the current branch/feature directory. Feature branches for spec work branch
off `develop`, never `main`, matching this repository's existing branching convention. Before
a spec's tasks are considered complete, the validation commands in `AGENTS.md` (`npm run
lint`, `schema:validate`, `theme:validate`, `patterns:escape`, `security:scan`, `composer run
phpcs`) MUST pass.

## Governance

`AGENTS.md` remains the canonical, day-to-day contributor and AI-agent guidance document for
this repository; this constitution is derived from it and governs how Spec Kit artifacts
(`spec.md`, `plan.md`, `tasks.md`) are checked for compliance. When a change to deep
engineering rules is needed, amend `AGENTS.md` first, then sync the corresponding principle
here — this constitution should never drift ahead of `AGENTS.md` as the source of truth.

Amendments require: a documented reason for the change, a version bump under the rules below,
and an updated `Last Amended` date. Every `/speckit-plan` and `/speckit-tasks` output SHOULD be
checked against these principles before `/speckit-implement` runs; `/speckit-analyze` is the
recommended tool for that cross-artifact check.

Versioning follows semantic versioning: MAJOR for backward-incompatible principle removals or
redefinitions, MINOR for a new principle or materially expanded guidance, PATCH for wording or
clarification-only edits.

**Version**: 1.0.0 | **Ratified**: 2026-09-14 | **Last Amended**: 2026-09-14
