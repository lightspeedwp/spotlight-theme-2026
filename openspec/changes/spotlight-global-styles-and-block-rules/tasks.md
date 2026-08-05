## 1. Link colour correction

- [x] 1.1 Update `styles.elements.link.color.text` to `var(--wp--preset--color--accent-200)`
- [x] 1.2 Update `styles.elements.link[":hover"].color.text` to `var(--wp--preset--color--accent-300)`

## 2. Default button styling

- [ ] 2.1 Add `styles.elements.button.color.background` and `.color.text` (filled look matching the "Subscribe" instance)
- [ ] 2.2 Add `styles.elements.button.border.radius` (standard radius, not full-pill)
- [ ] 2.3 Add `styles.elements.button.spacing.padding`
- [ ] 2.4 Add a `:hover` state for the default button

## 3. Button block-style variations

- [ ] 3.1 Create `styles/blocks/button/primary.json` — filled colour, full-pill (`500`/Round) radius, padding, `:hover` state
- [ ] 3.2 Add the trailing-arrow `css` rule to `primary.json`
- [ ] 3.3 Create `styles/blocks/button/dark.json` — dark filled colour, standard radius, padding, `:hover` state
- [ ] 3.4 Add the leading-icon `css` rule to `dark.json`
- [ ] 3.5 Create `styles/blocks/button/dark-pill.json` — dark filled colour, full-pill radius, padding, `:hover` state
- [ ] 3.6 In the Site Editor, confirm all three variations appear in the `core/button` block style picker (verifies WP core auto-registration from `styles/blocks/<block>/<variation>.json`)
- [ ] 3.7 If auto-registration does not work: add the minimal `wp_register_block_style()` wiring in `functions.php` needed to register them
- [ ] 3.8 Update `AGENTS.md`'s `styles/blocks/`/`styles/sections/` note to match whatever behaviour was actually confirmed in 3.6/3.7

## 4. Quote and pullquote styling

- [ ] 4.1 Add `styles.blocks["core/quote"]` — border accent, quote-body typography, spacing
- [ ] 4.2 Add the `cite` element override inside `core/quote` (muted text colour, smaller font size)
- [ ] 4.3 Add `styles.blocks["core/pullquote"]` — border accent, quote-body typography, spacing
- [ ] 4.4 Add the `cite` element override inside `core/pullquote`

## 5. List styling

- [ ] 5.1 Add `styles.blocks["core/list"]` marker colour (`contrast`)
- [ ] 5.2 Add `<li>` spacing/gap using an existing `settings.spacing.spacingSizes` step
- [ ] 5.3 Add start-indent (`padding-inline-start`) using an existing spacing step
- [ ] 5.4 Note in a code comment or CHANGELOG entry that these values are provisional pending design confirmation

## 6. Heading and paragraph spacing rhythm

- [ ] 6.1 Add heading top/bottom margin values sourced from `settings.spacing.spacingSizes`
- [ ] 6.2 Confirm paragraph-to-paragraph rhythm reads correctly in the Site Editor against the article frame's body copy
- [ ] 6.3 Note in a code comment or CHANGELOG entry that these values are provisional pending design confirmation

## 7. Validation

- [ ] 7.1 Run `npm run schema:validate`
- [ ] 7.2 Run `npm run theme:validate`
- [ ] 7.3 Spot-check link, button (all 4 looks), quote, pullquote, list, and heading/paragraph rendering in the Site Editor against the four reference frames
- [ ] 7.4 Update `CHANGELOG.md` under `## [Unreleased]`
