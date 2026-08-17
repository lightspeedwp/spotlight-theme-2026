<?php
/**
 * Title: Spotlight Badge
 * Slug: spotlight-theme-2026/spotlight-badge
 * Categories: spotlight
 * Keywords: badge, tag, label, category tag, in the spotlight
 * Description: A small solid-colour category label ("Button/Category Tag" in the Figma design) that displays the current post's category — e.g. "In the Spotlight", "Inside the Box". Internal partial, embedded via require() by other patterns (hero-lead-story, and later story-card / single-post header) — not meant to be inserted standalone.
 * Inserter: false
 *
 * @package spotlight-theme-2026
 *
 * Uses core/post-terms (WordPress core block), which needs post context
 * (postId) from an enclosing query loop or singular template — it renders
 * nothing if used somewhere without that context. Inserter is set to
 * false because it cannot function as a general-purpose standalone
 * pattern; it's only valid embedded inside a post-context block via
 * require(), as hero-lead-story.php does.
 *
 * Assumes a post has exactly one category assigned. core/post-terms
 * renders ALL of a post's assigned terms for the given taxonomy in one
 * wrapper, joined by a separator — WordPress core has no native "primary
 * category" concept (confirmed against core/Gutenberg source; Yoast/
 * RankMath add this as a plugin feature, neither is used by this theme).
 * If a post ever has more than one category, this will show them all
 * inside the same coloured box rather than a single clean pill. Flagged
 * as an open question pending confirmation of the site's actual editorial
 * category policy with Zared — do not assume this is resolved.
 *
 * Padding maps to the theme's spacing scale, not Figma's literal 12px/4px:
 * spacing--10 (~10px) horizontal, spacing--5 (~5px) vertical are the closest
 * presets on the theme's fluid clamp() scale.
 */

?>
<!-- wp:post-terms {"term":"category","className":"spotlight-badge","backgroundColor":"brand-500","textColor":"neutral-100","fontSize":"200","style":{"typography":{"fontWeight":"600","textDecoration":"none"},"spacing":{"padding":{"top":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}},"border":{"radius":"var:preset|border-radius|200"},"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"},"typography":{"textDecoration":"none"}}}}} /-->
