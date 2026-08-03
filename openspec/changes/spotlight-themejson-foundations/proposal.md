## Why

`theme.json` currently ships with placeholder starter values (a generic 6-colour palette, unset font families, an auto-generated rem spacing scale) that don't reflect the real Spotlight brand. Linear issue [LS-1704](https://linear.app/lightspeedwp/issue/LS-1704) requires `theme.json` to become "the primary source of truth for colours, type, spacing, layout widths, border radius, shadows and shared visual tokens" for the rebuild, and later template/pattern work (LS-1711–1713) is blocked on these foundations existing first.

An audit against the Figma "Spotlight Design System" file (posted to [LS-1709](https://linear.app/lightspeedwp/issue/LS-1709)) has produced a resolved token mapping for colour, typography, spacing, radius, and border-width. A handful of values are still pending final designer sign-off (tracked as assumptions below and already raised as open questions on LS-1709 ahead of tomorrow's design review) — this change implements the audited mapping now so template work isn't blocked, with the provisional values clearly flagged for a fast follow-up once confirmed.

## What Changes

- Replace the placeholder colour palette with the audited Spotlight system: Brand Red (9-step), Accent Navy (9-step), Neutral (9-step + gap-fill `neutral-450`), `base`/`contrast`, 5 system colours (error/warning/information/success/positive, each fg + ~10%-alpha bg), and 2 surface colours (`dark-card`/`dark-inner`) for cards on dark sections. **BREAKING**: existing palette slugs (`base-2`, `accent`, `accent-2`, `contrast-2`) are removed since they don't correspond to any audited token — nothing in the theme currently references them.
- Register `heading` (Libre Franklin) and `body` (Source Sans 3) font families with self-hosted `@font-face` definitions, replacing the theme's currently-unset font family list.
- Replace the placeholder font-size scale with the audited scale: `100`–`600` mapped to Tiny(12)/Base(16)/Small(20)/Card-Heading(24)/Sub-heading(32)/Heading(40), plus a `700` step for Display(46). Heading element styles (h1–h6) set size/weight/line-height per the audited scale; unlike the `kwv-theme-2026` reference this theme's headings stay normal-case (no blanket `uppercase`) except the H6/Label style.
- Replace the auto-generated geometric spacing scale with the audited 10-step px-based scale (`5`–`100`, named XXS→Colossal).
- Add a border-radius preset scale (`0`/`4`/`8`/`12`/`16`/`24`/`9999`, named None/Small/Medium/Card/Large/X-Large/Round) — currently unconfigured.
- Add a new `settings.custom.borderWidth` token family (`0`/`1`/`2`/`4`/`8`) since core `theme.json` has no native border-width preset list.
- Update layout widths: `contentSize` 720px → 800px, `wideSize` 1200px → 1320px.
- Add `settings.custom.fontWeight`/`.lineHeight`/`.letterSpacing` semantic token groups (structural pattern borrowed from `kwv-theme-2026`, values authored for Spotlight) so element/block styles reference named tokens instead of literal numbers.

## Capabilities

### New Capabilities
- `design-tokens`: theme.json settings that define Spotlight's colour palette, typography (families, sizes, weights, line-height, letter-spacing), spacing scale, border radius, border width, and layout widths — the foundational token layer that templates, patterns, and block styles will build on.

### Modified Capabilities
_None — no existing specs in this repo yet._

## Impact

- **Affected files**: `theme.json` (settings.color.palette, settings.typography, settings.spacing, settings.border, settings.custom, settings.layout, styles.elements). `assets/fonts/` gains Source Sans 3 and Libre Franklin font files (self-hosted, matching this repo's existing font-file convention).
- **Not touched by this change**: templates, template parts, patterns, block-level `styles.blocks` overrides, editor-parity work, and documenting custom-CSS exceptions — these are LS-1711/1712/1713 and follow once this foundation lands.
- **Assumptions carried as provisional** (pending designer confirmation, tracked on LS-1709): Libre Franklin as the confirmed heading typeface (a stale Figma variable says Libre Baskerville); the H1–H3 sizes 46/40/32px (an earlier, likely-stale pull from Figma mockup frames suggested 32/28 for H1/H2); the exact px for `Paragraph/Large`/`Button/Large` (not fully legible on the design poster, currently estimated); and the naming for several tokens Figma itself shows as "Not defined" (`neutral-450`, all of `accent`, `surface/dark-card`, `surface/dark-inner`, `data/positive`, the `Gigantic` (90px) spacing step, the `Card` (12px) radius step) — named here using the existing slug convention, to be corrected if the designer specifies otherwise.
