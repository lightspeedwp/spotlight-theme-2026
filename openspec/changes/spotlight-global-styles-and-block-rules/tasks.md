## 1. Link colour correction

- [x] 1.1 Update `styles.elements.link.color.text` to `var(--wp--preset--color--accent-200)`
- [x] 1.2 Update `styles.elements.link[":hover"].color.text` to `var(--wp--preset--color--accent-300)`

## 2. Default button styling

- [x] 2.1 Add `styles.elements.button.color.background` and `.color.text` (filled look matching the "Subscribe" instance)
- [x] 2.2 Add `styles.elements.button.border.radius` (standard radius, not full-pill)
- [x] 2.3 Add `styles.elements.button.spacing.padding`
- [x] 2.4 Add a `:hover` state for the default button

## 3. Button block-style variations

- [x] 3.1 Create `styles/blocks/button/primary.json` — filled colour, full-pill (`500`/Round) radius, padding, `:hover` state
- [x] 3.2 Add the trailing-arrow `css` rule to `primary.json`
- [x] 3.3 Create `styles/blocks/button/dark.json` — dark filled colour, standard radius, padding, `:hover` state
- [x] 3.4 Add the leading-icon `css` rule to `dark.json`
- [x] 3.5 Create `styles/blocks/button/dark-pill.json` — dark filled colour, full-pill radius, padding, `:hover` state
- [x] 3.6 In the Site Editor, confirm all three variations appear in the `core/button` block style picker (verifies WP core auto-registration from `styles/blocks/<block>/<variation>.json`) — confirmed working, all three appear
- [x] 3.7 If auto-registration does not work: add the minimal `wp_register_block_style()` wiring in `functions.php` needed to register them — not needed, auto-registration works
- [x] 3.8 Update `AGENTS.md`'s `styles/blocks/`/`styles/sections/` note to match whatever behaviour was actually confirmed in 3.6/3.7
- [x] 3.9 Fix `theme-utils.mjs`'s `validate-schema` to check block-style-variation partial files (any JSON with a `blockTypes` array) at their real runtime position (`styles.blocks.<blockType>.variations.<slug>`) instead of the flat root `styles` shape, working around a confirmed upstream schema/ajv limitation with pseudo-selector property names (`:hover` etc.) reproduced against kwv-theme-2026's own production `cta.json`

## 4. Quote and pullquote styling

- [x] 4.1 Add `styles.blocks["core/quote"]` — border accent, quote-body typography, spacing
- [x] 4.2 Add the `cite` element override inside `core/quote` (muted text colour, smaller font size)
- [x] 4.3 Add `styles.blocks["core/pullquote"]` — border accent, quote-body typography, spacing
- [x] 4.4 Add the `cite` element override inside `core/pullquote`

## 5. List styling

- [x] 5.1 Add `styles.blocks["core/list"]` marker colour (`contrast`) — inherited via CSS `::marker` default color inheritance from `color.text`
- [x] 5.2 Add `<li>` spacing/gap using an existing `settings.spacing.spacingSizes` step — implemented as `styles.blocks["core/list-item"].spacing.margin.bottom` (`10`/XS), since `core/list-item` is the real per-`<li>` block and `core/list` has no `blockGap` support
- [x] 5.3 Add start-indent using an existing spacing step — implemented as `styles.blocks["core/list"].spacing.padding.left` (`30`/M); WP's structured `spacing.padding` maps to physical `padding-left`, not the logical `padding-inline-start` property, functionally equivalent for this LTR-only starter theme
- [x] 5.4 Note in a code comment or CHANGELOG entry that these values are provisional pending design confirmation — covered in the `CHANGELOG.md` entry added in Group 7

## 6. Heading and paragraph spacing rhythm

- [x] 6.1 Add heading top/bottom margin values sourced from `settings.spacing.spacingSizes` — `styles.elements.heading.spacing.margin`: top `40`/L (generous separation from preceding content), bottom `20`/S (tighter coupling to the paragraph that follows it) — applies to all headings via the shared `heading` element, no per-level overrides needed
- [x] 6.2 Confirm paragraph-to-paragraph rhythm reads correctly in the Site Editor against the article frame's body copy — confirmed working
- [x] 6.3 Note in a code comment or CHANGELOG entry that these values are provisional pending design confirmation — covered in the `CHANGELOG.md` entry added in Group 7

## 7. Validation

- [x] 7.1 Run `npm run schema:validate`
- [x] 7.2 Run `npm run theme:validate`
- [x] 7.3 Spot-check link, button (all 4 looks), quote, pullquote, list, and heading/paragraph rendering in the Site Editor against the four reference frames — confirmed working, including both ordered and unordered lists
- [x] 7.4 Update `CHANGELOG.md` under `## [Unreleased]`
