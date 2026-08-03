## 1. Colour palette

- [ ] 1.1 Replace `settings.color.palette` with the audited `base`/`contrast`, `neutral-100`…`neutral-900` + `neutral-450`, `brand-100`…`brand-900`, and `accent-100`…`accent-900` slugs and values
- [ ] 1.2 Add the 5 system colour pairs (`error`/`warning`/`information`/`success`/`positive`, each `-foreground` + `-background`)
- [ ] 1.3 Add the 2 surface colours (`surface-dark-card`, `surface-dark-inner`)
- [ ] 1.4 Remove the legacy placeholder slugs (`base-2`, `accent-2`, `contrast-2`) and confirm nothing in the repo references them

## 2. Typography — families and font files

- [ ] 2.1 Source Libre Franklin and Source Sans 3 `.woff2` files (the weights used by the audited type scale: Bold/SemiBold/Regular) and add them under `assets/fonts/`
- [ ] 2.2 Register `heading` (Libre Franklin) and `body` (Source Sans 3) in `settings.typography.fontFamilies` with `@font-face` entries pointing at the added files

## 3. Typography — sizes and element styles

- [ ] 3.1 Replace `settings.typography.fontSizes` with the audited scale (Tiny 12 / Base 16 / Small 20 / Card-Heading 24 / Sub-heading 32 / Heading 40 / Display 46)
- [ ] 3.2 Set `styles.elements.h1`–`h6` typography (size/weight/line-height) per the audited heading scale, without a blanket uppercase transform
- [ ] 3.3 Apply the `H6`/Label uppercase treatment only to that specific style, not to `heading` generally

## 4. Spacing

- [ ] 4.1 Replace the auto-generated `settings.spacing.spacingScale` with an explicit `spacingSizes` list matching the audited 10-step scale (5–100px, XXS→Colossal)

## 5. Border radius and width

- [ ] 5.1 Add `settings.border.radiusSizes` with the 7-step scale (0/4/8/12/16/24/9999, None→Round)
- [ ] 5.2 Add `settings.custom.borderWidth` (none/base/small/medium/large → 0/1/2/4/8px)

## 6. Layout widths

- [ ] 6.1 Update `settings.layout.contentSize` to `800px` and `settings.layout.wideSize` to `1320px`

## 7. Semantic custom tokens

- [ ] 7.1 Add `settings.custom.fontWeight` (named weight scale used by the heading/body styles)
- [ ] 7.2 Add `settings.custom.lineHeight` and `settings.custom.letterSpacing` groups, and reference them from the `styles.elements.h1`–`h6` entries added in task 3.2 rather than hardcoding literals

## 8. Validation

- [ ] 8.1 Run `npm run schema:validate` and confirm `theme.json` still validates
- [ ] 8.2 Run `npm run theme:validate` and confirm no consistency errors
- [ ] 8.3 Spot-check in the Site Editor (or a quick WP install) that the palette, fonts, spacing, and radius presets appear as expected in the block editor UI
