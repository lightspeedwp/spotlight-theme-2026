## 1. Colour palette

- [x] 1.1 Replace `settings.color.palette` with the audited `base`/`contrast`, `neutral-100`…`neutral-900` + `neutral-450`, `brand-100`…`brand-900`, and `accent-100`…`accent-900` slugs and values
- [x] 1.2 Add the 5 system colour pairs (`error`/`warning`/`information`/`success`/`positive`, each `-foreground` + `-background`) — note: `positive` is a single colour in the Figma source (no matching background variant), implemented as one slug rather than a pair
- [x] 1.3 Add the 2 surface colours (`surface-dark-card`, `surface-dark-inner`)
- [x] 1.4 Remove the legacy placeholder slugs (`base-2`, `accent-2`, `contrast-2`) and confirm nothing in the repo references them — also fixed the dangling `accent`/`accent-2` references in `theme.json`'s link element (now `brand-500`/`brand-600`), and cleaned up `styles/light.json` and `styles/dark.json`, which both duplicated the old placeholder palette

## 2. Typography — families and font files

- [x] 2.1 Source Libre Baskerville and Source Sans 3 `.woff2` files and add them under `assets/fonts/` — both are variable fonts on Google Fonts (Libre Baskerville: `wght` axis 400–700, Source Sans 3: 200–900), so a single variable file per subset covers the full Bold/SemiBold/Regular range rather than needing discrete per-weight files; sourced latin + latin-ext subsets only (no other scripts needed for this site)
- [x] 2.2 Register `heading` (Libre Baskerville) and `body` (Source Sans 3) in `settings.typography.fontFamilies` with `@font-face` entries pointing at the added files, using `fontWeight` ranges ("400 700" / "400 600") matching kwv-theme-2026's own variable-font pattern (e.g. its Bodoni Moda entry)

## 3. Typography — sizes and element styles

- [x] 3.1 Replace `settings.typography.fontSizes` with the audited 7-step scale — named to match `kwv-theme-2026`'s own labels for the same slug shape (`100` Tiny 12px / `200` Base 16px / `300` Small 20px / `400` Medium 24px / `500` Large 32px / `600` X-Large 40px / `700` Huge 48px) rather than role-specific names, since these are general-purpose presets selectable on any block, not just headings. Also fixed a dangling reference to the removed `font-size--medium` slug in the global default typography (now `font-size--200`, i.e. Base/16px)
- [x] 3.2 Set `styles.elements.h1`–`h6` typography (size/weight) per the audited heading scale, plus a shared `heading` element carrying `fontFamily`/`lineHeight` (1.25, matching kwv's own heading line-height) so it isn't repeated 6 times — no blanket uppercase transform
- [x] 3.3 Applied uppercase only to `h6`'s own style block
- [x] 3.4 Added a `button` element with `fontWeight: 600` (SemiBold) and a Base (16px) default font size — Large/Small/Tiny button sizes are just the same font-size presets from 3.1, selectable per-instance once buttons appear in patterns; no dedicated "Paragraph" override was needed since Regular/Source Sans 3 is already the global default typography

## 4. Spacing

- [ ] 4.1 Replace the auto-generated `settings.spacing.spacingScale` with an explicit `spacingSizes` list matching the audited 10-step scale (5–100px, XXS→Colossal)

## 5. Border radius and width

- [ ] 5.1 Add `settings.border.radiusSizes` with numeric slugs matching `kwv-theme-2026`'s convention: `0`/`100`/`200`/`250`/`300`/`400`/`500` → 0/4/8/12/16/24/9999px (None/Small/Medium/Card/Large/X-Large/Round) — `250` (Card) approved by the designer, to be reviewed formally at PR time
- [ ] 5.2 Add `settings.custom.borderWidth` (none/base/small/medium/large → 0/1/2/4/8px), following `kwv-theme-2026`'s descriptive-key convention for `settings.custom` groups

## 6. Layout widths

- [ ] 6.1 Update `settings.layout.contentSize` to `800px` and `settings.layout.wideSize` to `1320px`

## 7. Semantic custom tokens

- [ ] 7.1 Add `settings.custom.fontWeight` (named weight scale used by the heading/body styles)
- [ ] 7.2 Add `settings.custom.lineHeight` and `settings.custom.letterSpacing` groups, and reference them from the `styles.elements.h1`–`h6` entries added in task 3.2 rather than hardcoding literals

## 8. Validation

- [ ] 8.1 Run `npm run schema:validate` and confirm `theme.json` still validates
- [ ] 8.2 Run `npm run theme:validate` and confirm no consistency errors
- [ ] 8.3 Spot-check in the Site Editor (or a quick WP install) that the palette, fonts, spacing, and radius presets appear as expected in the block editor UI
