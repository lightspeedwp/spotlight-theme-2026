# Foundation Exceptions

Spotlight is built theme-first: `theme.json` settings and styles, block supports, and style variations cover almost everything. This page lists every place the theme steps outside that native system with authored CSS (there is currently no custom JS), why each exception exists, and where it lives — so the list stays a deliberate, reviewed set rather than growing by accident.

There is no custom JavaScript in the theme. `functions.php` has a placeholder comment for where `wp_enqueue_script()` would go once `assets/js/` has a file to enqueue.

## `assets/css/custom-button.css`

Icon and `:hover` states for Spotlight's own `core/button` style variations (`republish-article`, `secondary`, `dashboard` — registered in `styles/blocks/button/*.json`).

**Why this can't be native:** block style variation JSON (`styles/blocks/button/*.json`) can set colour, border, spacing, and typography, but it has no way to add a `::before`/`::after` pseudo-element or a CSS `mask-image` for an icon glyph. Each variation here needs an icon rendered from an SVG mask, which only a stylesheet rule can express.

## `assets/css/core-button.css`

Icon and `:hover` states for WordPress core's own built-in `core/button` "Fill" (default) and "Outline" styles, restyled to match Spotlight's palette.

**Why this can't be native:** same constraint as above — the Outline style's arrow icon needs a `mask-image` pseudo-element that block style variation JSON can't express.

## `assets/css/template-parts.css`

One remaining exception:

- **Header search-button outline style** (`.site-header .wp-block-search__button`) — the design shows the header's search trigger as a plain outline circle, not the filled colour `core/search`'s button-only mode otherwise inherits from `styles.elements.button`. There's no per-instance override for a single `core/search` block's button sub-element in theme.json, so this is scoped narrowly to `.site-header` to avoid touching `core/search` usage elsewhere.

Two exceptions this file used to carry are now gone:

- **Trust-bar item dividers and vertical-centering helper** — `parts/trust-bar.html` was rebuilt as a real `core/columns` block, with each item as its own column; the divider between items is now each column's native `border-left`, and each item's icon/text row uses the group layout's own `verticalAlignment:"center"` instead of a `.trust-bar__item { align-items: center; }` rule.
- **The Press Council/FAIR certification badge** — now a real `wp:image` block in `parts/footer.html`, referencing a real Media Library attachment. The prior `background-image`-on-an-empty-`<p>` hack (and a later PHP-pattern workaround) has both been removed — there's nothing left to work around once the image is a genuine upload rather than a theme-bundled file. Same for the "10 years of impact" item's numeral — no longer a text substitute needing its own sizing rule, it's a real inline SVG in the same 60×60 box as the other four icons (an SVG `<text>` element set in the heading typeface).

**Why the remaining one can't be native:** it's not expressible through theme.json settings/styles or a block's own supports — a small, targeted CSS rule scoped to a specific block context.

## `theme.json` → `styles.blocks."core/quote".css` and `styles.blocks."core/pullquote".css`

Raw CSS (via theme.json's supported `css` field) forcing the citation element's colour, font, style, weight, and line-height, overriding the block's own default citation styling.

**Why this can't be native:** `core/quote`/`core/pullquote`'s citation sub-element isn't independently themeable through the standard `styles.elements`/`styles.blocks` schema — there's no dedicated citation style target, so reaching it requires a raw selector. Because this lives inside `theme.json`'s own `css` field rather than an enqueued stylesheet, it's part of the generated global-styles output and applies identically on the front end and in the editor with no separate enqueue to keep in sync (see the [editor styling parity report](../.github/reports/2026-08-12-editor-styling-parity-verification.md) for how enqueue-based parity is otherwise maintained).

## Not an exception: Icon Block plugin (`outermost/icon-block`)

Icons throughout the header, trust bar, and buttons come from the third-party Icon Block plugin, not custom CSS — it serialises the SVG and sizing directly into saved block markup. It's listed here only because it's a real dependency the theme relies on (the plugin must be active), not because it's a styling exception.

## Keeping this list constrained

Before adding a new custom rule, check whether a block style variation (`styles/blocks/<block>/*.json` or `styles/sections/*.json`), a `theme.json` block/element style, or a core block support already covers it. If a genuinely new exception is needed, add it here with the same "why this can't be native" justification, and keep the owning stylesheet scoped to one concern per file the way `custom-button.css`/`core-button.css` already are.

Nothing found during this audit was flagged as warranting its own follow-on issue — the current exception set is small, each item is single-purpose, and none of it duplicates functionality `theme.json` could otherwise provide.
