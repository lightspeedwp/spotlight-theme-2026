---
mode: "ask"
---

# New Block Pattern

Generate a new WordPress block pattern for this theme.

## Instructions

Provide the following details before generating:
- **Pattern name**: (human-readable, e.g. "Hero with Image")
- **Pattern slug**: (e.g. `spotlight-theme-2026/hero-with-image`)
- **Category**: (e.g. `featured`, `text`, `call-to-action`)
- **Description**: (short description of what the pattern does)

## Requirements

The generated pattern must:

1. Be saved in `patterns/` as a PHP file with a descriptive filename (e.g. `hero-with-image.php`).
2. Include a valid pattern registration header comment.
3. Use WordPress block markup, not raw HTML.
4. Escape all PHP output using `esc_html()`, `esc_attr()`, `esc_url()`, etc.
5. Use `esc_html__()` or `esc_attr__()` for translatable strings with the correct text domain.
6. Use semantic HTML (`tagName` attributes on block groups).
7. Use correct heading levels appropriate to the pattern's context.
8. Use colour and spacing presets from `theme.json` where possible.
9. Not hard-code URLs — use WordPress functions like `home_url()`, `esc_url()`.
10. Be self-contained — do not depend on other patterns.

## Output

Provide the full pattern file contents ready to save.
After creating the pattern, update `CHANGELOG.md` under `[Unreleased]`.
