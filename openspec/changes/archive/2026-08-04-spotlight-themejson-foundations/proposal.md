## Why

`theme.json` currently ships with placeholder starter values (a generic 6-colour palette, unset font families, an auto-generated rem spacing scale) that don't reflect the real Spotlight brand. Linear issue [LS-1704](https://linear.app/lightspeedwp/issue/LS-1704) requires `theme.json` to become "the primary source of truth for colours, type, spacing, layout widths, border radius, shadows and shared visual tokens" for the rebuild, and later template/pattern work (LS-1711–1713) is blocked on these foundations existing first.

An audit against the Figma "Spotlight Design System" file (posted to [LS-1709](https://linear.app/lightspeedwp/issue/LS-1709)) has produced a resolved token mapping for colour, typography, spacing, radius, and border-width. A handful of values are still pending final designer sign-off (tracked as assumptions below and already raised as open questions on LS-1709 ahead of tomorrow's design review) — this change implements the audited mapping now so template work isn't blocked, with the provisional values clearly flagged for a fast follow-up once confirmed.

## What Changes

- Replace the placeholder colour palette with the audited Spotlight system: Brand Red (9-step), Accent Navy (9-step), Neutral (9-step + gap-fill `neutral-450`), `base`/`contrast`, 5 system colours (error/warning/information/success/positive, each fg + ~10%-alpha bg), and 2 surface colours (`dark-card`/`dark-inner`) for cards on dark sections. **BREAKING**: existing palette slugs (`base-2`, `accent`, `accent-2`, `contrast-2`) are removed since they don't correspond to any audited token — nothing in the theme currently references them.
- Register `heading` (Libre Baskerville) and `body` (Source Sans 3) font families with self-hosted `@font-face` definitions, replacing the theme's currently-unset font family list.
- Replace the placeholder font-size scale with the audited scale: `100`–`700` mapped to Tiny(12)/Base(16)/Small(20)/Card-Heading(24)/Large-and-Sub-heading(32)/Heading(40)/Display(48) — the same slug shape as `kwv-theme-2026`'s own font-size scale, just static instead of fluid. Heading element styles (h1–h6) set size/weight/line-height per the audited scale; unlike the `kwv-theme-2026` reference this theme's headings stay normal-case (no blanket `uppercase`) except the H6/Label style (Bold, uppercase, 20px).
- Replace the auto-generated geometric spacing scale with the audited 10-step px-based scale (`5`–`100`, named XXS→Colossal).
- Add a border-radius preset scale using numeric slugs matching the `kwv-theme-2026` convention (`0`/`100`/`200`/`250`/`300`/`400`/`500` → 0/4/8/12/16/24/9999px, named None/Small/Medium/Card/Large/X-Large/Round) — currently unconfigured. The `250` slug for the Card step is our own proposal (Figma has no defined code syntax for it yet), inserted between Medium (`200`) and Large (`300`) so it doesn't renumber the other steps.
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
- **Designer-confirmed as of this change** (previously provisional, now settled via LS-1709): heading typeface is Libre Baskerville (not Libre Franklin, which the design poster had stated); the full H1–H6 scale is 48/40/32/24/20/20px; `Paragraph`/`Button` sizes are Large 32px / Small 20px / Base 16px / Tiny 12px; `accent-100` and `accent-200` are confirmed-correct in Figma's Code Syntax.
- **Fully resolved**: the designer has confirmed the complete `accent-100`–`accent-900` mapping (Figma's Code Syntax will be updated on their end later; implementation proceeds now against the confirmed values regardless of when that lands). The `250` slug proposed for the `Card` radius step is approved to implement as-is, with formal design review deferred to the PR. Naming for other tokens Figma shows as "Not defined" (`neutral-450`, `surface/dark-card`, `surface/dark-inner`, `data/positive`, the `Gigantic` (90px) spacing step) follows the existing slug convention per the designer's "find the closest" guidance.
