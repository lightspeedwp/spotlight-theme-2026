---
applyTo: "{templates,parts}/**/*.html"
---

# Templates Instructions

## What Are Block Templates?

Block templates are HTML files that define page layouts using WordPress block markup.

- `templates/` — full page templates
- `parts/` — reusable template parts (header, footer, etc.)

---

## Template Markup

Templates use WordPress block comment syntax:

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group">
	<!-- wp:post-content /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

---

## Semantic HTML

Always use semantic HTML tags via the `tagName` attribute:

```html
<!-- wp:group {"tagName":"header"} --> → <header>
<!-- wp:group {"tagName":"main"} --> → <main>
<!-- wp:group {"tagName":"footer"} --> → <footer>
<!-- wp:group {"tagName":"section"} --> → <section>
<!-- wp:group {"tagName":"article"} --> → <article>
```

---

## Accessibility

- Use a logical heading hierarchy. Do not skip levels.
- Include a skip link in the header part if possible.
- Ensure navigation has a proper ARIA label or uses a `<nav>` element.
- Ensure images have descriptive alt text.

---

## Layout

Prefer `layout.type: "constrained"` for full-width page sections with a constrained inner width.
Use `layout.type: "flex"` for horizontal layouts.
Do not add inline styles in template markup — use `theme.json` spacing and colour presets.

---

## Template Parts

- Register template parts in `theme.json` under `templateParts`.
- Use the `area` field: `header`, `footer`, or `uncategorized`.
- Parts should be reusable — avoid template-specific logic in parts.
