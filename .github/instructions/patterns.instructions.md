---
applyTo: "patterns/**/*.php"
---

# Patterns Instructions

## What Is a Block Pattern?

A block pattern is a predefined block layout registered with WordPress.
Patterns live in `patterns/` and are typically PHP files.

---

## Pattern Header Comments

Every pattern file must start with a valid registration header:

```php
<?php
/**
 * Title: My Pattern Name
 * Slug: spotlight-theme-2026/my-pattern-name
 * Categories: featured, text
 * Description: A short description.
 * Keywords: hero, banner
 * Viewport Width: 1200
 */
```

---

## Output Escaping in Patterns

Patterns often contain PHP output. All output must be escaped:

```php
// Correct:
echo esc_html( get_bloginfo( 'name' ) );
echo esc_url( home_url( '/' ) );
echo esc_html__( 'Read more', 'spotlight-theme-2026' );

// Wrong:
echo get_bloginfo( 'name' );
echo home_url( '/' );
```

---

## Block Markup

Prefer block markup in patterns over raw HTML:

```php
?>
<!-- wp:paragraph -->
<p><?php echo esc_html__( 'Example text', 'spotlight-theme-2026' ); ?></p>
<!-- /wp:paragraph -->
<?php
```

---

## Keep Patterns Focused

- One pattern per file.
- Keep patterns self-contained — do not rely on other patterns.
- Keep patterns accessible — correct heading levels, alt text for images.
- Do not hard-code URLs in patterns — use WordPress functions.
