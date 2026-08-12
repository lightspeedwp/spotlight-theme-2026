# Editor Styling Parity Verification (LS-1712)

**Date:** 2026-08-12
**Scope:** Verify front-end/editor parity for typography, spacing, widths, and core reusable styles across the real templates and template parts landed under LS-1705 (LS-1714–1718), now that they exist to check against. Prior verification (LS-1709–1711) could only exercise the editor canvas in isolation, with no real templates to render.

## Method

Read every file under `templates/` and `parts/`, plus `theme.json`, `functions.php`, `style.css`, and the three files in `assets/css/`, checking for:

- Hardcoded typography/spacing/colour values that bypass `theme.json` presets
- Any enqueue path that would apply a style on the front end but not in the block editor (post editor or Site Editor canvas), or vice versa
- Layout/width usage inconsistent with `settings.layout.contentSize`/`wideSize`
- Block markup or attributes that would render differently between contexts

## Findings

### 1. All authored styling is token-driven — no parity gap found

Every `style="..."` attribute in `templates/*.html` and `parts/*.html` resolves to a `var(--wp--preset--...)` custom property (spacing, colour, font-size), not a literal value. Custom properties are emitted from the same `theme.json` in both the front end and the editor, so these render identically in both places. No raw hex colours or unitless/hardcoded px values were found in template or template-part markup, aside from block-level `width` attributes on `wp:site-logo` and `outermost/icon-block` (e.g. `{"width":140}`, `{"width":20}`) — these are ordinary block attributes honoured identically by both renderers, not theme styling.

### 2. Custom CSS is enqueued identically on the front end and in the editor

`functions.php` enqueues all three stylesheets (`custom-button.css`, `core-button.css`, `template-parts.css`) via the `enqueue_block_assets` hook, which fires in both contexts. The code comment at `functions.php:43-47` notes this was deliberate: none of the three declares `global-styles` as a dependency, because that handle only exists during the front end's `wp_enqueue_scripts` flow and would silently drop the stylesheet inside `wp-admin` if depended on. This is the correct, and only, mechanism keeping these three files in parity — confirmed still correct against the now-real templates that consume the classes they style (`.trust-bar__item`, `.site-footer__certification`, button style-variation icons).

### 3. `add_editor_style('style.css')` contributes nothing (harmless, not a gap)

`style.css` contains only the required theme-header comment block — no actual rules. `add_theme_support('editor-styles')` plus `add_editor_style('style.css')` therefore have no effect on parity either way; there is nothing here to diverge. Not flagged as an exception for LS-1713 since no custom CSS actually ships through this path.

### 4. Two-column and grid layouts use core layout types only

`templates/single.html` and `templates/page.html` use `"layout":{"type":"grid","columnCount":2}` for the content/sidebar split; `templates/home.html`/`archive.html`/the "Recent stories" query in `single.html` use `"layout":{"type":"grid","columnCount":3}` for card grids. These are native Group/Query block layout types under `settings.appearanceTools`, rendered by the same block supports code in both contexts. No custom grid CSS exists or is needed.

## Known parity limitations accepted for phase 1

- **Pattern placeholders aren't visually representative yet.** `front-page.html`'s seven sections, `home.html`'s card template, `single.html`'s republish box, and `sidebar-editorial.html`'s newsletter form are real block structures (headings, groups, paragraphs) using real tokens, but their content is literal placeholder text (e.g. `[Blog Card pattern placeholder]`) rather than the finished patterns from Figma. Structural parity (spacing, widths, layout type) is verified and correct; the finished patterns' own internal styling can't be parity-checked until the patterns phase authors them. Re-verify typography/spacing on these specific sections once each pattern is built.
- **Icon rendering depends on the Icon Block plugin, not theme CSS.** `outermost/icon-block` serialises full inline SVG + a `width` inline style at save time, so there is nothing for the theme to keep in sync — both renderers show the same saved markup. Documented here because it's a real editor-availability dependency (the plugin must be active in both environments), even though it's not a styling risk.

No editor-specific adjustments were required as a result of this verification — the enqueue strategy and token discipline already in place from LS-1709–1711 held up against the real templates.
