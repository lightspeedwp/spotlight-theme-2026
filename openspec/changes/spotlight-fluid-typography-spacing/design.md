## Context

See `proposal.md` for motivation. The corrected data comes from two dedicated Figma variables-documentation nodes (Spacing, Typography), each exposing Min/Mid/Max columns per token rather than the single static value the original audit captured. For nearly every step, `Mid ≈ (Min + Max) / 2` — confirming these are simple two-point linear interpolations (a value at a small viewport, a value at a large viewport), not a more complex curve. `Mid` is therefore fully derivable from `Min`/`Max` under any consistent linear viewport mapping and isn't a separate constraint.

## Goals / Non-Goals

**Goals:**
- Convert font-size and spacing presets to fluid, viewport-responsive values in `rem`, matching the corrected Figma data.
- Fix the font-size scale's step count (7→9) and slug-to-name mapping, which the original audit got wrong independent of the fluid question.

**Non-Goals:**
- Changing which font-size steps are actually used by `h1`–`h6`/paragraph/button (the *pixel* values for those roles are unchanged — only their slug numbers and whether they're static or fluid changes).
- Adopting `kwv-theme-2026`'s own viewport bounds or fluid coefficients — only its structural pattern (native `fluid` field for type, hand-rolled `clamp()` for spacing) is reused.

## Decisions

**Typography uses WP core's native `fluid` field; spacing uses a hand-written `clamp()`.** Core has a built-in fluid-typography mechanism for `fontSizes` (supply `min`/`max`, core generates the `clamp()`), but no equivalent for `spacingSizes`. This isn't a stylistic choice — it's the only way each one currently supports fluid values in theme.json 6.9, and it's exactly the split `kwv-theme-2026` reflects (its `fontSizes` use `fluid: {min,max}`; its `spacingSizes` use literal `clamp()` strings).

**Spacing's viewport interpolation range: 768px–1320px.** Figma's Min/Max data gives the two *value* endpoints per step, but not the two *viewport width* endpoints — that pair is a free choice for any linear clamp (confirmed by the `Mid` check above: any consistent choice reproduces the same midpoint value). Alternatives considered: copying `kwv-theme-2026`'s own viewport assumptions — rejected, since reverse-engineering their exact bounds from the published coefficients didn't resolve cleanly and would just be borrowing an arbitrary number instead of choosing a reasoned one; inventing an unrelated pair (e.g. 320–1600) — rejected in favor of reusing values already meaningful to this theme: 768px is WP core's own default minimum viewport for its native fluid-typography feature (so spacing and type share the same "starts scaling here" point), and 1320px is this theme's own configured `settings.layout.wideSize`.

**Re-slug the font-size scale to `100`–`900` rather than patching the existing `100`–`700`.** The corrected scale has 9 real steps, not 7 — inserting the two new ones (`Large` 28px, `Colossal` 64px) without renumbering would require a non-sequential slug (like the `250` radius insertion), but here every existing step's *name* also shifts by one position (32px stops being `Large` and becomes `X-Large`, etc.), so a clean renumber is more accurate than a patch. This is a `theme.json`-only, pre-release change — no templates or patterns exist yet to hold a stale slug reference.

## Risks / Trade-offs

- **[Re-slugging breaks anything that already referenced the old `100`–`700` font-size slugs]** → Mitigation: confirmed the only consumers are `theme.json`'s own `h1`–`h6`/`button` element styles (updated as part of this change); no templates/patterns exist yet.
- **[Chosen viewport bounds (768–1320) don't match a designer-specified pair]** → Mitigation: documented explicitly here and in the proposal's Impact section; changing them later is a mechanical recompute of the `calc()` coefficients, not a structural change.
- **[Hand-computed `clamp()` coefficients could contain arithmetic errors]** → Mitigation: every step's formula was verified by evaluating it at both 768px and 1320px and confirming it reproduces the Figma min/max within rounding tolerance.

## Migration Plan

Same as the original foundations change: greenfield, no live content depends on the current values. Apply the new `fontSizes`/`spacingSizes`/`lineHeight.body` values, re-point the `h1`–`h6`/`button` slug references, run `npm run schema:validate` and `npm run theme:validate`, spot-check in the Site Editor, commit as a follow-up on the existing PR #2 branch.
