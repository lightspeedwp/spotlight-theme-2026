---
applyTo: "**/*.php"
---

# PHP Instructions

## Scope

These instructions apply to all PHP files in this repository:
- `functions.php`
- `inc/**/*.php`
- `patterns/**/*.php`

---

## Escaping

Always escape PHP output using the appropriate function:

| Context                  | Function                          |
|--------------------------|-----------------------------------|
| Plain text               | `esc_html()`                      |
| HTML attribute           | `esc_attr()`                      |
| URL                      | `esc_url()`                       |
| JavaScript               | `esc_js()`                        |
| Rich HTML                | `wp_kses_post()` or `wp_kses()`   |
| Translatable text        | `esc_html__()` or `esc_attr__()`  |

Never use bare `echo $variable;` without escaping.
Use `absint()` and `intval()` as input normalisation helpers, then apply output escaping for the render context.

---

## Sanitisation

Always sanitise input before using it:

| Input type     | Function                        |
|----------------|---------------------------------|
| Text           | `sanitize_text_field()`         |
| Email          | `sanitize_email()`              |
| Integer        | `absint()`                      |
| Key/slug       | `sanitize_key()`                |
| URL            | `esc_url_raw()`                 |
| HTML content   | `wp_kses_post()`                |

---

## Translation

Always include the text domain in translation functions:

```php
// Correct:
esc_html__( 'Read more', 'spotlight-theme-2026' );
esc_attr__( 'Search', 'spotlight-theme-2026' );
__( 'Hello', 'spotlight-theme-2026' );

// Wrong — missing text domain:
__( 'Hello' );
_e( 'Hello' );
```

---

## Functions.php

- Keep `functions.php` minimal.
- Only add theme setup, block supports, asset enqueueing.
- Do not add plugin-like features.
- Use `inc/` for logical groupings of larger PHP code.

---

## Security

- Never use `eval()`.
- Never output superglobals directly (`$_GET`, `$_POST`, etc.).
- Use `$wpdb->prepare()` for any database queries.
- Verify nonces for any form submissions.
- Check user capabilities before sensitive operations.
