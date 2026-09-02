<?php
/**
 * Title: Spotlight Badge
 * Slug: spotlight-theme-2026/spotlight-badge
 * Categories: spotlight
 * Keywords: badge, tag, label, category tag, in the spotlight
 * Description: A small solid-colour label ("Button/Category Tag" in the Figma design) that displays the current post's Special Project, e.g. "In The Spotlight", "Inside The Box" — empty if the post isn't part of one. Internal partial, embedded via require() by other patterns (hero-lead-story, story-card / story-card-editorial, project-entry) — not meant to be inserted standalone.
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
 * Points at the special_project ACF taxonomy, not category — resolved
 * 2026-09-01 with Zared: Special Projects membership/badge is driven by a
 * dedicated single-select field (Radio Buttons appearance in ACF), never
 * by a post's regular categories. Since a post can carry at most one
 * special_project term, core/post-terms naturally renders zero or one
 * link here — no "primary term" filtering needed for this block. Renders
 * nothing for a post with no special_project term assigned, which is the
 * desired behavior (badge is opt-in per post, not automatic).
 *
 * Padding maps to the theme's spacing scale, not Figma's literal 12px/4px:
 * spacing--10 (~10px) horizontal, spacing--5 (~5px) vertical are the closest
 * presets on the theme's fluid clamp() scale.
 */

?>
<!-- wp:post-terms {"term":"special_project","className":"spotlight-badge","backgroundColor":"brand-500","textColor":"neutral-100","fontSize":"200","style":{"typography":{"fontWeight":"600","textDecoration":"none"},"spacing":{"padding":{"top":"var:preset|spacing|5","bottom":"var:preset|spacing|5","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}},"border":{"radius":"var:preset|border-radius|200"},"elements":{"link":{"color":{"text":"var:preset|color|neutral-100"},"typography":{"textDecoration":"none"}}}}} /-->
