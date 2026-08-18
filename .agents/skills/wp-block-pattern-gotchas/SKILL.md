# SKILL: WordPress Block Pattern Gotchas

**Version:** 1.0.0
**Scope:** Any WordPress block theme — `patterns/*.php`, `templates/*.html`, `parts/*.html`

---

## Purpose

A checklist of WordPress core behaviors that look intuitive but aren't, learned the expensive way (hours of debugging) while building this theme's pattern library. Read this **before** writing or debugging a pattern, template, or part — most of these fail silently (no error, no exception) rather than loudly, which is what makes them slow to diagnose.

## Governing rule: verify against source, don't assume

Before implementing a WordPress core layout/attribute/block-support mechanism, **read the actual source** rather than relying on training-data memory or a summarized description:
- Layout support: `wp-includes/block-supports/layout.php`
- Any block's real attributes/supports: its `block.json`
- If unsure whether an attribute serializes into saved markup: grep the block's `block.json` for `__experimentalSkipSerialization`

A wrong assumption here doesn't error — it silently produces no visual effect, which burns far more time to trace than reading the ~50 lines of core source up front.

---

## Pitfall: `layout.type` accepts a limited, specific set of values

**Symptom:** Block preview/validation breaks silently ("Block contains unexpected or invalid content" or the block just won't render), with no obvious cause in the markup.

**Fix:** `layout.type` only accepts `"default"`, `"constrained"`, `"flex"`, or `"grid"`. There is no `"flow"` — that is not a real value. Use `"default"` for plain vertical stacking with no special layout behavior.

**Working example:** `patterns/hero-lead-story.php`'s inner `wp:group` blocks using `"layout":{"type":"default"}`.

---

## Pitfall: `{"type":"constrained"}` alone does nothing in static pattern markup

**Symptom:** A group with `"layout":{"type":"constrained"}` and no explicit size renders its children full-width instead of constrained — the "auto-centers to theme.json's contentSize" behavior everyone expects from the Site Editor doesn't happen.

**Why:** `wp_get_layout_style()` (`wp-includes/block-supports/layout.php`) only outputs `max-width` when the block's own `layout` attribute already contains an explicit `contentSize` (and/or `wideSize`). It does **not** fall back to `theme.json`'s global settings at render time. That merge normally happens in the editor's JS UI when a person picks "constrained" visually — the resolved value gets baked into the saved attribute. Hand-authored PHP pattern markup skips that step entirely.

**Fix:** Spell out the real value explicitly, matching `theme.json`: `"layout":{"type":"constrained","contentSize":"800px"}`. To left-align instead of center (without a custom CSS override), add `"justifyContent":"left"` — this produces `margin-left:0` instead of the type's centered default, verified directly against the same core file.

**Working example:** `patterns/page-intro-banner.php`'s wide wrapper group.

---

## Pitfall: a nested `wp:pattern` reference loses its parent's block context

**Symptom:** A pattern embedded via `<!-- wp:pattern {"slug":"..."} /-->` inside another pattern renders empty/wrong on the **front end** — but a WP-CLI `do_blocks()` test of the same markup looks fine, which hides the bug until it's live.

**Why:** `render_block_core_pattern()` renders the referenced pattern's content through a fresh `do_blocks()` call with **no parent block context** passed in. Any block that needs context from an ancestor (e.g. `core/post-terms`/`core/post-title` needing `postId` inside a query loop) gets nothing, so it renders empty. This is a context-loss issue specific to context-dependent blocks, not a blanket "nested patterns don't work" rule — a context-independent nested pattern renders fine.

**Fix:** For a pattern that needs query-loop (or other block) context, inline it with PHP `require __DIR__ . '/other-pattern.php';` instead of `wp:pattern`. The required file stays independently registered and reusable elsewhere. Always test on the actual rendered front-end page for this one — CLI `do_blocks()` will not reproduce it.

**Working example:** `patterns/hero-lead-story.php` requiring `patterns/spotlight-badge.php` inside its query loop.

---

## Pitfall: margin / `blockGap` between siblings is unreliable inside `default`/`constrained` layouts

**Symptom:** A `style.spacing.margin` or a group's `blockGap` value is set correctly in the markup, but the visual gap doesn't match — confirmed via DevTools that the computed margin is `0` or otherwise overridden.

**Why:** WordPress's layout support auto-applies `margin-block-end: 0` to every child of a `default`/`constrained`-layout container, and a `blockGap`-driven `margin-block-start` can be beaten by a competing rule at similar specificity.

**Fix:** Use `style.spacing.padding` instead — it's a real, always-serializing attribute with no such override, on `wp:group`, `wp:post-title`, `wp:query-title`, and most other blocks.

**Working example:** `patterns/archive-listing-header.php`'s breadcrumb and title padding-bottom values.

---

## Pitfall: not every block attribute actually serializes into saved markup

**Symptom:** A style attribute (e.g. `style.border.radius` on `core/search`) is set in the pattern's JSON, but the rendered HTML has no matching inline style — the attribute is silently dropped.

**Why:** A block's `block.json` can mark a support as `__experimentalSkipSerialization`, meaning the attribute exists (and shows correctly in the editor) but is deliberately excluded from the saved/rendered output.

**Fix:** Check the block's `block.json` before assuming an attribute will serialize. When it's skip-serialized, use real enqueued CSS targeting the block's rendered class/markup instead of a block attribute.

**Working example:** `assets/css/archive-listing-header.css`'s `.wp-block-search__inside-wrapper`/`.wp-block-search__button` border-radius rules, enqueued in `functions.php`.

---

## Pitfall: bare HTML tags inside pattern PHP break block validation

**Symptom:** An unwrapped `<img>` (or other bare tag) inside a pattern's static markup causes WordPress's block-children reconciliation to fail validation.

**Fix:** Every visual element needs a real, matching block-comment wrapper — e.g. `<!-- wp:image {...} --><figure class="wp-block-image">...<img /></figure><!-- /wp:image -->` — never a bare tag dropped into the markup.

**Working example:** the breadcrumb separator icon in `patterns/archive-listing-header.php`, `patterns/archive-listing-header-archive.php`, and `patterns/page-intro-banner.php` (shared `spotlight-breadcrumb-icon` class, styled in `assets/css/spotlight-breadcrumb-icon.css`).

---

## Pitfall: a DB-stored template/pattern override shadows file edits

**Symptom:** Editing a `patterns/*.php` or `templates/*.html` file has no visible effect, even after cache clears, because it was previously edited in the Site Editor canvas.

**Why:** Editing a template/pattern directly in the Site Editor creates a frozen database copy that takes rendering priority over the theme file, regardless of subsequent file edits.

**Fix:** Appearance → Editor → Manage all templates (or Patterns) → find the item → Reset, to restore the theme file as the source of truth. See the `wp-db-override-reconciliation` skill for the full diagnostic flow.

---

## Pitfall: caching layers mask file edits

**Symptom:** A pattern/CSS file is clearly changed on disk, hard refresh doesn't help, and the live page still shows old output.

**Fix:** Before assuming the code is wrong, rule out caching — WP Super Cache, Perfmatters (or similar), and PHP OPcache are common culprits and each needs its own clear/flush step.

---

## Verification habits that catch these early

- Render a pattern in isolation with plain PHP stubs for `esc_html__`/`esc_url`/etc. and assert the output block comments parse as valid JSON — catches malformed attribute JSON before it ever reaches WordPress.
- Test dynamic/context-dependent patterns on the actual rendered front-end page, not just a CLI `do_blocks()` call.
- After any pattern/CSS edit, confirm the relevant cache is actually cleared before judging whether a fix worked.
- Run `npm run schema:validate`, `npm run theme:validate`, `composer run lint:php`, and `composer run phpcs` after every pattern/template change — several of the pitfalls above (invalid layout type, bare HTML tags) are caught immediately by these.

## Related

- `wp-pattern-runtime-pitfalls` — a broader pattern-runtime skill covering registration-vs-render timing and block bindings for per-request data, if available in the environment.
- `wp-db-override-reconciliation` — full diagnostic flow for the DB-override pitfall above.

## Further Reading

Background context for the concepts above — none of these document the specific silent-failure pitfalls in this file (those came from reading `wp-includes/block-supports/layout.php` and each block's own `block.json` directly, not from the handbook). Use the source files as the authoritative check; use these for general orientation.

- [Patterns handbook](https://developer.wordpress.org/themes/patterns/) — pattern registration, header comment fields, categories
- [Global Settings & Styles (`theme.json`)](https://developer.wordpress.org/themes/global-settings-and-styles/) — `contentSize`/`wideSize`, spacing scale, and other tokens referenced above
- [Block Supports reference](https://developer.wordpress.org/block-editor/reference-guides/block-api/block-supports/) — the `layout`, `spacing`, and `__experimentalSkipSerialization` mechanics behind several pitfalls above
