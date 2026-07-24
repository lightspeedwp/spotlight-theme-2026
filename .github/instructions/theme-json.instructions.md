---
applyTo: "{theme.json,styles/**/*.json}"
---

# theme.json Instructions

## Role of theme.json

`theme.json` is the **primary source of truth** for design tokens in this theme.

Prefer `theme.json` over:
- PHP `add_theme_support()` for colours, fonts, or spacing
- Hardcoded CSS values
- Inline block attributes

---

## Schema

Always include the `$schema` key at the top:

```json
{
	"$schema": "https://schemas.wp.org/trunk/theme.json",
	"version": 3
}
```

The schema version should match the minimum WordPress version the theme targets.

---

## Colour Palette

Define colours in `settings.color.palette`.
Use semantic slug names, not hex values as slugs:

```json
{
	"name": "Accent",
	"slug": "accent",
	"color": "#0066cc"
}
```

Reference palette colours using CSS custom properties:
```css
var(--wp--preset--color--accent)
```

---

## Typography

Define font sizes in `settings.typography.fontSizes`.
Define font families in `settings.typography.fontFamilies` only if custom fonts are registered.

Do not bundle web fonts by default — add them only when `.woff2` files exist in `assets/fonts/`.

---

## Spacing

Define spacing in `settings.spacing.spacingSizes` or via the spacing scale.
Reference spacing using:
```css
var(--wp--preset--spacing--40)
```

---

## Style Variations

- `styles/light.json` and `styles/dark.json` are registered style variations.
- Additional variations can be added as `styles/*.json`.
- `styles/blocks/` and `styles/sections/` are organisational conventions —
  WordPress does not auto-consume these as global style variations.
- Keep variation files focused — only override what differs from the base `theme.json`.

---

## What Not To Do

- Do not set `"defaultPalette": true` — use the custom palette only.
- Do not add font families without also registering the font files.
- Do not set global styles that are too opinionated for a starter.
- Do not copy-paste large theme.json files from other themes without review.
