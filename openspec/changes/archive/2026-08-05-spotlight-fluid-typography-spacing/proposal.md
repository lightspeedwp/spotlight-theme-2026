## Why

The design/dev review of `theme.json` (post-PR #2) flagged that font-size and spacing values need to be fluid (viewport-responsive), stored as `rem`, not the static `px` values implemented in the original foundations work. Pulling the dedicated Figma variables-documentation nodes for Typography and Spacing surfaced the actual min/max bounds needed for this — and also revealed the font-size scale itself has 9 steps (Tiny→Colossal), not the 7 originally implemented, with several preset names mismatched against their values (e.g. 32px is `X-Large`, not `Large`).

## What Changes

- Replace the 7-step static `settings.typography.fontSizes` scale with the audited 9-step scale (slugs `100`–`900`), each using WP core's native `fluid: {min, max}` field (core generates the `clamp()` itself) — no manual viewport math needed for typography.
- **BREAKING**: re-slug the font-size scale to fit the corrected 9 steps. `h1`–`h6` and the `button` element's font-size references are remapped to match (e.g. H1 48px moves from slug `700` to `800`, since `X-Large`/`Huge`/`Gigantic` shift by one position each).
- Replace the 11-step static `settings.spacing.spacingSizes` scale with hand-authored `clamp(min, calc(A + Bvw), max)` strings per step (core has no native fluid field for spacing), converted to `rem`, using a viewport interpolation range of 768px–1320px.
- Fix `settings.custom.lineHeight.body` from `1.6` (an uncorrected placeholder carryover) to `1.5`, per the audited Typography variables.

## Capabilities

### Modified Capabilities
- `design-tokens`: the Font-size scale requirement changes from 7 static steps to 9 fluid steps with corrected names; a new requirement covers the spacing scale's fluid `clamp()` behavior (the original spacing requirement only specified static px values).

## Impact

- **Affected files**: `theme.json` (`settings.typography.fontSizes`, `settings.spacing.spacingSizes`, `settings.custom.lineHeight`, `styles.elements.h1`–`h6`/`button`).
- **Consumers of the old font-size slugs**: only `theme.json` itself (the `h1`–`h6`/`button` element styles) — no templates or patterns exist yet to carry a dangling reference.
- **Viewport bounds for spacing's manual clamp (768px–1320px) are our own choice**, not a Figma-specified value — 768px matches WP core's own default minimum viewport for its native fluid-typography feature, and 1320px matches this theme's configured `wideSize`, so spacing scales in sync with the same responsive assumptions core already applies to type.
- This PR (#2) is still open under review — this change is implemented as a follow-up commit on the same branch, not a separate PR.
