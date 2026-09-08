## Why

LS-1710 finished the design-token layer (palette, typography, spacing, radius, border-width) but left `theme.json`'s `styles` section only partially built out — headings and body typography are in place, but links point at the wrong colour role, and buttons, quotes, and lists have no authored look at all. Real dev-ready Figma frames (home, article, contact) are now available and show concrete, buildable treatments for these elements, so this is the point to finish the base styling layer before any templates or patterns are built on top of it.

## What Changes

- Correct `styles.elements.link` to use `accent-200`/`accent-300` (confirmed against real body-copy links) instead of the placeholder `brand-500`/`brand-600`, which is reserved for category badges/labels, not hyperlinks.
- Add `styles.blocks["core/quote"]` and `styles.blocks["core/pullquote"]` styling: left border accent, quote body typography, muted `cite` element — structural pattern borrowed from `kwv-theme-2026`, values Spotlight's own.
- Add a default `core/button` look via `styles.elements.button` (fill colour, border-radius, padding) matching the newsletter "Subscribe" treatment.
- Add three new named `core/button` block-style-variation files under `styles/blocks/button/` (`primary.json`, `dark.json`, `dark-pill.json`), each a fully-specified combination of fill colour and corner radius, matching the four distinct button instances found in the Figma frames. Arrow/leading icons on two of these are added via each variation's own scoped `css` property (a `content` rule), not a new stylesheet.
- Add a provisional `core/list` default (marker colour, `<li>` spacing, indent) — no Figma source exists for this; flagged explicitly as a reasonable calm-editorial default rather than a transcribed value.
- Add provisional heading/paragraph spacing-rhythm values (margins) derived from the existing `settings.spacing.spacingSizes` scale — no new spacing tokens, no exact Figma source; flagged provisional.
- Verify whether WordPress core auto-registers `styles/blocks/<block>/<variation>.json` files as selectable block styles (the mechanism `kwv-theme-2026`'s button files rely on). If it does, correct `AGENTS.md`'s current claim that these files are "not automatically consumed." If it doesn't, add the minimal `wp_register_block_style()` wiring needed in `functions.php`.

## Capabilities

### New Capabilities
- `base-styles`: Base element styling (links, headings' spacing rhythm, lists, quotes) and shared `core/button` block-style variations that sit on top of the design-tokens capability's presets.

### Modified Capabilities
(none — `design-tokens` settings/presets are unchanged; only `styles` consumption of those tokens is added)

## Impact

- `theme.json`: `styles.elements.link`, `styles.elements.button`, `styles.blocks["core/quote"]`, `styles.blocks["core/pullquote"]`, `styles.blocks["core/list"]`, heading/paragraph spacing additions.
- New files: `styles/blocks/button/primary.json`, `styles/blocks/button/dark.json`, `styles/blocks/button/dark-pill.json`.
- Possibly `functions.php` (only if block-style-variation auto-registration doesn't work as expected) and `AGENTS.md` (correcting the `styles/blocks/` auto-registration claim).
- No changes to `settings.*` (palette, typography, spacing, radius, border-width tokens all stay as LS-1710 left them).
- No templates, template parts, or patterns are touched — block-level gaps found during exploration (card, badge, icon-list, section-header-with-rule) are explicitly out of scope, noted as candidates for later pattern work (likely LS-1712).
