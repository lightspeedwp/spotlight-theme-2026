## Context

See `proposal.md` for motivation. Relevant constraints:
- `theme.json` already has the full audited token layer from LS-1710 (palette, typography, spacing, radius, border-width) — this change only adds `styles` that *consume* those tokens; no new `settings.*` entries.
- Grounding evidence for this change is four dev-ready Figma frames (home, article×2 states, contact) rather than a dedicated design-tokens-style audit document — some decisions here are confirmed against real screenshots (link colour, blockquote shape, button instances), others are explicitly provisional because no Figma source exists (lists, exact heading/paragraph margins).
- `kwv-theme-2026` is used as a *structural* reference only (its `styles.blocks` patterns, its `styles/blocks/button/*.json` file convention, itself following the Ollie theme's separation-of-concerns approach) — its values are theme-specific and not reused.
- `AGENTS.md` currently states that `styles/blocks/`/`styles/sections/` JSON files "are not automatically consumed by WordPress as global style variations." This change's approach (one file per named `core/button` variation) depends on the opposite being true — WordPress core auto-registering block-style-variation JSON files placed at `styles/blocks/<block>/<variation-slug>.json`. This needs empirical verification during implementation, not assumption.

## Goals / Non-Goals

**Goals:**
- Finish the `styles` layer for the elements and blocks that recur across the four available frames: links, buttons (default + 3 named variations), quotes/pullquotes, lists, and heading/paragraph spacing rhythm.
- Keep every value sourced from existing `settings.*` tokens — no new colour, spacing, or radius presets.
- Structure button variations as separate, single-responsibility files (one combination per file), matching the `kwv-theme-2026`/Ollie convention, rather than one large `core/button` object trying to express multiple looks via nested overrides.
- Stay entirely inside `theme.json`'s own schema (`styles.elements`, `styles.blocks`, and the scoped `css` property within a style object) — no new authored stylesheet.

**Non-Goals:**
- Any pattern/component-level styling (category badges, icon-list cards, section-header-with-rule) — these are block-level gaps noted for later pattern work, not solved here.
- New design tokens of any kind — if a value isn't already in `settings.*`, this change doesn't add it as a preset; it either reuses an existing token or (for lists/spacing-rhythm) picks a literal-free value from the existing scale.
- Resolving the exact provisional values (list spacing, heading margins, final variation names) with the designer — these ship as reasonable, flagged defaults per this repo's established "provisional now, correct later" precedent (see the two archived LS-1704 design docs).

## Decisions

**One capability, `base-styles`, not folded into `design-tokens`.** `design-tokens` is settings/presets; this change is `styles` consumption of those presets. Same separation the archived LS-1709/1710 change made when it kept "no `styles.blocks` overrides" explicitly out of scope for itself — that scope boundary is what this change now fills in.

**Button variations as one file per fully-specified combination, not composable axes.** The four real button instances found in the Figma frames resolve into a 2×2 shape/colour matrix, but WordPress block styles are mutually exclusive selections (a block has one active style at a time), so composable independent axes aren't expressible as two small partial overrides — each combination needs its own complete style object. This matches exactly how `kwv-theme-2026`'s `cta.json`, `outline-dark.json`, and `add-to-cart.json` are each a fully-specified look, not a shared base plus modifier. Alternative considered: a single `styles.blocks["core/button"].variations` block inside `theme.json` itself (also a valid core mechanism) — rejected in favour of separate files, since the separation-of-concerns benefit (one file, one responsibility, easy to hand to a designer for review or swap independently) is the whole reason this pattern was raised for adoption.

**Default (unstyled) button matches the "Subscribe" look; named variations cover the other three.** Rather than inventing a fourth named variation for the most common case, the plain `core/button` default (`styles.elements.button`) is styled to match the button instance that appears with no special treatment (filled colour, standard radius) — consistent with treating "default" as a real, intentional look rather than a fallback.

**Icons via each variation's own scoped `css` property, not a new stylesheet.** `core/button` has no native icon slot, and two of the three named variations (`primary`, `dark`) have an arrow/leading icon in the source frames. `theme.json`'s style objects support a `css` property scoped to that block (kwv uses this for e.g. hover transitions) — using it for a `content`-based icon keeps the addition inside the same schema-validated, single-responsibility file as the rest of that variation's look, rather than opening `assets/css/main.css` for the first time in this theme (which AGENTS.md's theme-first posture and this repo's total absence of authored CSS both argue against doing lightly).

**Blockquote border stays brand-red despite the initial worry that it might read as too loud.** A real article screenshot confirms a thin brand-500 left border on a pull-quote reads calmly, not alarmingly — thin weight + serif italic body offsets the colour's intensity. No change from the structural pattern kwv also uses (left border accent + muted cite).

**Lists and heading/paragraph spacing rhythm are explicitly provisional, using only the existing scale.** No Figma source exists for either (confirmed absent for lists after a full-file designer inspection; heading/paragraph margins were never part of the LS-1710 typography audit, which only covered font-size/weight/line-height). Rather than block on new design input, both use values drawn from `settings.spacing.spacingSizes` — the same "ship a reasonable default now, flag it, correct later" posture the two archived design docs already established for this theme.

**Button variation names (`primary`/`dark`/`dark-pill`) are provisional.** No Figma component-naming data was available during this exploration (Figma MCP access was rate-limited). Names describe shape/colour rather than the design system's own vocabulary; renaming later is a one-line `slug`/`title` change in a standalone file with no knock-on effect, so it does not block implementation.

## Risks / Trade-offs

- **[`styles/blocks/<block>/<variation>.json` may not auto-register as a selectable block style]** → Mitigation: verify empirically during implementation (add one file, confirm it appears in the block style picker in the Site Editor). If it doesn't auto-register, add the minimal `wp_register_block_style()` call needed in `functions.php` and correct `AGENTS.md`'s claim either way (confirm it if the current wording turns out to be right after all, or fix it if stale).
- **[Provisional list/spacing-rhythm values diverge from an eventual designer-specified value]** → Mitigation: sourced entirely from the existing spacing scale, so correcting them later is a slug swap, not a structural change — same mitigation pattern already used successfully for LS-1704's provisional typography values.
- **[Button variation names get renamed by the designer]** → Mitigation: isolated to each variation's own `slug`/`title` fields; no other file references them by name.
- **[Icon-via-`css`-content-rule may not visually match a real SVG icon asset if the design system has one]** → Mitigation: flagged as a follow-up review item once the actual icon asset (if any) is confirmed; the `content` rule can be swapped for a background-image reference without changing the variation's structure.

## Migration Plan

Additive only — no existing styling is removed except the link colour correction (`brand-500`/`brand-600` → `accent-200`/`accent-300`), which has no live content depending on it (greenfield theme, consistent with the posture in both archived LS-1704 changes).
1. Apply the `styles.elements.link` colour correction.
2. Add `styles.elements.button` default styling.
3. Add `styles.blocks["core/quote"]`, `["core/pullquote"]`, and `["core/list"]` to `theme.json`.
4. Add heading/paragraph spacing-rhythm values.
5. Create `styles/blocks/button/primary.json`, `dark.json`, `dark-pill.json`.
6. Verify block-style auto-registration in the Site Editor; adjust `functions.php`/`AGENTS.md` only if verification shows it's needed.
7. Run `npm run schema:validate` and `npm run theme:validate`.
8. Rollback, if needed, is a plain `git revert` of the `theme.json`/`styles/blocks/button/` commit.
