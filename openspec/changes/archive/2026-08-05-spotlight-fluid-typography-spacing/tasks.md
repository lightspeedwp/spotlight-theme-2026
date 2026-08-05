## 1. Font sizes

- [x] 1.1 Rebuild `settings.typography.fontSizes` as a 9-step scale (slugs `100`–`900`: Tiny/Base/Small/Medium/Large/X-Large/Huge/Gigantic/Colossal), each with a `size` (rem) and a `fluid: {min, max}` (rem) pair converted from the Figma px values
- [x] 1.2 Remap `styles.elements.h1`–`h6` and `button` font-size references to the corrected slugs — only `h1`/`h2`/`h3` actually needed changing (`700`→`800`, `600`→`700`, `500`→`600`); `h4`/`h5`/`h6`/button (`400`/`300`/`300`/`200`) kept the same meaning in the new scale
- [x] 1.3 Fix `settings.custom.lineHeight.body` from `1.6` to `1.5`

## 2. Spacing

- [x] 2.1 Rebuild `settings.spacing.spacingSizes` with hand-authored `clamp(minRem, calc(A + Bvw), maxRem)` strings for all 11 steps, using a 768px–1320px interpolation range
- [x] 2.2 Verify each formula evaluates to its Figma min at 768px and max at 1320px — checked programmatically (not by eye), all 11 within 0.02px of target

## 3. Validation

- [x] 3.1 Run `npm run schema:validate` and `npm run theme:validate` — both pass
- [x] 3.2 Run `npm run lint` — passes
- [x] 3.3 Spot-check in the Site Editor at a few viewport widths (narrow, mid, wide) to confirm type and spacing actually scale fluidly, not just that the static fallback renders — confirmed, everything resizes smoothly
