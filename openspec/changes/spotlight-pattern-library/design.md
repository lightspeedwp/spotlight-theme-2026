## Context

See `proposal.md` for motivation. Relevant constraints:
- No `patterns/` directory exists yet in this theme. This change defines the pattern inventory; it does not create any `patterns/*.html` or `patterns/*.php` file.
- `kwv-theme-2026` is a structural reference only (its `blog-card`/`blog-card-large` size-suffixed pattern naming) — its values and exact file set are not reused.
- The redevelopment analysis PDF referenced by LS-1706 does not exist in this repo or as a Linear attachment on LS-1706 or its sub-issues (confirmed during explore). This change is built from the merged template placeholders (`templates/*.html`, `parts/sidebar-editorial.html`) and the Figma "Spotlight Design System" file instead.
- A Figma client-feedback annotation on the "Provincial coverage" frame (file `XFmtkYUZ69HLFLzokvwif5`, frame `543:7632`) surfaced several requirements not captured when LS-1706's original sub-issues were written: the provincial map's hover/select interactivity, the confirmed CC BY-ND 4.0 republish copy, a question about pinning the dashboard-promo pattern to archive/category pages, and confirmation of the primary-navigation label order (resolving the open question LS-1705's design doc parked). The navigation and footer-redesign feedback items are out of this change's scope (patterns only); the map, republish-copy, and dashboard-placement items are captured in the spec above.
- The Figma file shows three variants of the provincial-map component (map+newsletter, map+dynamic-latest-post, map+province-count-grid), but only the map+newsletter variant is marked "Ready for Dev." The other two are noted as later-phase and explicitly not defined by this change.
- The Figma file's "Designs" section (node `234:8297`) lists exactly four Ready-for-Dev page frames: `Homepage`, `Blog Landing Page`, `About Page`, `Single Blog Post`. Cross-checking all four against the current templates surfaced two hero/banner-shaped sections with no owning pattern in the original six-group breakdown: the `Blog Landing Page` frame's dark-banner title-and-search header (currently authored as plain `wp:query-title`/`wp:search` core blocks in `home.html`/`archive.html`'s `post-listing-header` group, not a placeholder) and the `About Page` frame's full-bleed photo banner with title and intro copy (`page.html` currently has no hero section at all — just a bare `wp:post-title`). The `Single Blog Post` frame was also checked and needs no new pattern: its headline sits directly in the article flow, already covered by the existing `templates`/`template-parts` structure. Both gaps are added to LS-1719's scope as `archive-listing-header` and `page-intro-banner`, since they're page-header/hero-family patterns, not cards or section-bands.
- A follow-up visual fidelity audit (post-LS-1712/1713 merge, once Figma access was confirmed reliable) compared the four Ready-for-Dev frames pixel-by-pixel against the merged templates and CSS (`assets/css/*.css`, `theme.json`). It surfaced six gaps: (1) a reusable "In the Spotlight"/"Inside the Box" status-badge pill that doesn't exist anywhere in the current markup, appearing on the homepage hero, `story-card` placements, and the single-post header; (2) `sidebar-editorial.html` spacing/border/icon details that don't match the design despite correct structure; (3) `home.html`/`archive.html`'s topic-filter pills (`wp:categories`) rendering unstyled instead of the design's active/inactive pill treatment; (4) `home.html`/`archive.html`'s pagination (`wp:query-pagination`) rendering completely unstyled; (5) `single.html`'s two-column layout using an equal 50/50 split instead of the design's asymmetric article-wide/sidebar-narrow proportions, plus a missing in-article "More from Spotlight" related-coverage callout; (6) unverified global spacing/content-width across `single.html`/`home.html`/`archive.html`. These are folded into the existing six-PR breakdown below rather than tracked as a separate change, per the user's instruction to extend this plan, not fork a new one.

## Goals / Non-Goals

**Goals:**
- Map every existing template placeholder to exactly one named, phase-labeled pattern.
- Resolve the two pattern-sizing questions LS-1705's design doc deferred (dashboard-promo, topic/section-band) as single patterns with named size variants.
- Sequence the pattern groups into PR-sized units so implementation ships as several small, reviewable pull requests rather than one large one.
- Capture the provincial-map's interactivity requirement and the other Figma-annotation findings as documented, flagged decisions rather than losing them.

**Non-Goals:**
- Authoring any pattern's actual markup, CSS, or PHP — a follow-on implementation change per PR unit defined below.
- Deciding the provincial map's interaction technical approach (Interactivity API vs. non-JS fallback) — flagged as an open question for that pattern's implementation PR.
- Defining the two later-phase provincial-map variants (dynamic latest-post swap, province-count grid) — noted for a future change once they're confirmed Ready for Dev.
- Redesigning the primary navigation or footer — real feedback surfaced during this exploration, but out of this pattern-library change's scope; tracked separately.
- Deciding whether the dashboard-promo pattern should also appear on `archive.html` — recorded as an open question for that pattern's implementation PR, not a template-structure decision this change can make.

## Decisions

**Six pattern groups, six PR-sized implementation units — one Linear sub-issue (or the one closely-coupled pair below) per PR.** The user explicitly wants this shipped as several small, reviewable PRs rather than one large PR covering the whole pattern library. The six groups already have clean seams (no pattern is split across two groups, per the spec's inventory-completeness requirement), so each maps to one PR:

| PR | Pattern group | Sub-issue | Patterns delivered |
|----|---------------|-----------|---------------------|
| 1 | Lead-story hero + featured-story | LS-1719 | `hero-lead-story`, `featured-story`, `archive-listing-header`, `page-intro-banner` |
| 2 | Story-card, archive-card, section-band | LS-1720 | `story-card` (+ Perspectives/Recent-stories-shape variants), `topic-band` (2 size variants) |
| 3 | Trust, newsletter, editorial-utility | LS-1721 | `newsletter-signup` (2 size variants), `republish-notice` |
| 4 | Related-coverage, onward-journey | LS-1722 | `related-coverage` |
| 5 | Province, project, dashboard-entry | LS-1723 | `project-entry`, `dashboard-promo` (2 size variants) |
| 6 | Interactive provincial-map | LS-2616 | `provincial-map` (map+newsletter variant only) |
| 7 | Cross-cutting styling fidelity | none (spans LS-1719–1723) | `spotlight-badge`; global spacing/content-width pass across `single.html`/`home.html`/`archive.html` |

This is a *definition-level* change, so the "PRs" above are actually this change's own tasks.md checkpoints (each producing a reviewable slice of the spec/design), and the same six-way split is recommended to whoever picks up implementation next, so the definition work and the build work stay aligned PR-for-PR. Not merged into fewer, larger groups: LS-1720 and LS-1723 both touch "cards," but LS-1720's cards are content-grid patterns while LS-1723's are entry/promo patterns with different CTA intent — collapsing them would blur the acceptance-criteria boundary Linear already drew. Not split further: six PRs for a library this size is already granular; splitting each further (e.g., one PR per size variant) would fragment tightly-coupled work (a pattern and its own size variant belong in the same review).

**Dashboard-promo and topic-band are each one pattern with size variants, not two independent pattern files.** Confirmed directly with the user during exploration. This follows the `kwv-theme-2026` structural precedent (`blog-card`/`blog-card-large`) of size-suffixed pattern names sharing one definition rather than duplicated markup — the exact file-naming mechanism (e.g. `dashboard-promo.html` + `dashboard-promo-compact.html`, or a single pattern with a block-level size attribute) is left to the implementation PR, since it has no bearing on the pattern's definition, structure, or phase status.

**`parts/trust-bar.html` stays a template part, not a pattern.** Confirmed directly with the user. It is already fully authored, functional, and reused correctly as a shared template part — retroactively defining it as a pattern would add scope with no reader benefit. LS-1721's "trust panels" acceptance criteria is satisfied by the `republish-notice` and other utility patterns instead.

**`archive-listing-header` and `page-intro-banner` join LS-1719, not a new sub-issue.** Confirmed directly with the user after cross-checking all four Figma Ready-for-Dev page frames (`Homepage`, `Blog Landing Page`, `About Page`, `Single Blog Post`) against the merged templates. Both are page-level header/banner patterns — the same structural family as `hero-lead-story` — not cards or section-bands, so they belong with LS-1719 rather than LS-1720. Neither was previously named because both are authored as plain inline core blocks (or, for `page.html`, not authored at all) rather than a `[... placeholder]` marker, so the original six-group breakdown's placeholder-only sweep missed them. `Single Blog Post` was also checked and needs no new pattern — its headline sits directly in the article flow, already covered by the existing spec.

**"Perspectives" is a `story-card` variant under LS-1720, not a new sub-issue.** Confirmed directly with the user. Structurally identical to the Latest News and Special Projects card-rows already in LS-1720's scope; a dedicated sub-issue would duplicate `story-card`'s definition for no structural reason. LS-1720's Linear description has been updated to record this explicitly.

**"Explore topics" is the `topic-band` pattern's sidebar-list size variant (LS-1720), not `related-coverage` (LS-1722).** The list is static term navigation (no recommendation logic, no per-post binding) — structurally the same family as the front page's topic grid, just a compact variant. `single.html`'s "Recent stories" query loop, by contrast, is dynamic (excludes the current post, pulls latest N) and is the genuine `related-coverage` pattern. This resolves the LS-1705 design doc's deferred "one pattern or two variants" sizing question for the explore-topics module.

**The provincial-map pattern is scoped to only the Figma-confirmed "Ready for Dev" variant.** Confirmed directly with the user: of the three variants found in Figma (map+newsletter, map+dynamic-latest-post, map+province-count-grid), only map+newsletter is marked ready. Defining the other two now would be speculative work against unconfirmed designs — the same "ship what's confirmed, flag the rest" posture LS-1705's design doc established for `search.html`/`404.html`.

**The provincial map's interaction technical approach is an open question, not a decision made here.** The Figma annotation confirms a hover/select-tooltip requirement exists, but choosing between the Interactivity API (`data-wp-*` directives) and a simpler CSS-only/no-JS fallback is an implementation-level technical decision with no bearing on the pattern's structural definition — resolving it now would be guessing ahead of the LS-2616 implementation PR's own investigation.

**The republish pattern's copy is fixed to the Figma-confirmed CC BY-ND 4.0 text, not placeholder legal copy.** The client-provided attribution copy was found directly in the Figma design annotation during this exploration; using anything else (e.g. inventing generic Creative Commons boilerplate) would risk shipping incorrect legal language for an already-answered question.

**Styling-fidelity findings are distributed into the PR that already owns the affected page/pattern, plus one new cross-cutting PR (7) for the two genuinely global items.** Confirmed directly with the user: no separate OpenSpec change or Linear issue is created for this audit. Filter-pill and pagination styling go into PR 2 (LS-1720) since both live on `home.html`/`archive.html`, which that PR already owns. Sidebar spacing/icon fidelity goes into PR 3 (LS-1721) since the sidebar's newsletter module lives there. The missing "More from Spotlight" in-article callout and the single-post column-width asymmetry go into PR 4 (LS-1722) and are reflected in the `related-coverage` requirement above. The `spotlight-badge` pill and the cross-template spacing/content-width pass are reused across three or more pattern groups each, so neither belongs to a single PR — both become PR 7, a new cross-cutting group, rather than being arbitrarily owned by whichever PR happens to build first.

**Global spacing/content-width is a measurement task, not a guessed fix.** No pixel measurements were taken from Figma during this audit — the spacing/width mismatch was observed visually, not quantified. Resolving it requires measuring the actual Figma frame dimensions (column widths, section gaps) against `theme.json`'s `contentSize`/`wideSize` and spacing scale before changing any value, to avoid guessing a fix that's equally wrong in a different direction.

## Risks / Trade-offs

- **[No redevelopment analysis PDF was available]** → Mitigation: this change is built entirely from the merged template placeholders and the Figma design system, both of which already encode the homepage hierarchy and archive-logic decisions the PDF would have described. If the PDF surfaces later and conflicts with this spec, it is a scoped follow-up update to `specs/pattern-library/spec.md`, not a rebuild.
- **[The provincial map's interactivity requirement may need more technical investigation than a pattern-definition change can resolve]** → Mitigation: flagged explicitly as an open question for the LS-2616 implementation PR rather than guessed at here; the pattern's structural definition (SVG map + newsletter pairing) does not depend on which interaction approach is eventually chosen.
- **[Six PR-sized units may drift out of sync if implemented by different people/times, e.g. `story-card`'s shared structure diverging between LS-1720 and LS-1723's usage]** → Mitigation: the spec's `story-card` requirement explicitly documents it as one pattern with content-specific variants, giving implementers a single source of truth to check against regardless of which PR they're working from.
- **[The dashboard-CTA-on-archive-pages question raised in the Figma annotation has no answer yet]** → Mitigation: recorded as an open question in the spec and proposal for the LS-1723 implementation PR; does not block this change or any other PR unit.
- **[PR 7's cross-cutting items (badge, spacing) could be built inconsistently if each dependent PR implements its own copy before PR 7 lands]** → Mitigation: PR 7 is called out explicitly in tasks.md as needing early sequencing relative to the PRs that consume it (2, 3, 4), or at minimum a shared reference point implementers check before adding their own badge/spacing treatment.

## Migration Plan

This is a definition-only change — no theme code is added or modified.
1. Merge this change's `proposal.md`, `specs/pattern-library/spec.md`, `design.md`, and `tasks.md`.
2. Run `openspec sync-specs` (or `/opsx:sync`) to promote the delta spec into `openspec/specs/pattern-library/spec.md` once this change is archived, matching the LS-1704/1705 precedent.
3. Each of the six PR-sized units above becomes its own future implementation change (new `patterns/*.html` files, `theme.json` pattern-category registration if needed), scoped and reviewed independently against this spec.
4. Rollback, if needed, is a plain `git revert` of the OpenSpec change files — no theme code, no data migration involved.

## Open Questions

- Should the `dashboard-promo` pattern also appear on `archive.html`/category pages, per the Figma client annotation's question about pinning the dashboard block across category pages? Deferred to the LS-1723 implementation PR.
- Is the provincial-map tooltip built with the WordPress Interactivity API or a simpler non-JS fallback? Deferred to the LS-2616 implementation PR.
- What is the exact file-naming/authoring mechanism for the `dashboard-promo` and `topic-band` size variants (separate files à la `kwv-theme-2026`, or a single pattern with a variant attribute)? Deferred to whichever PR first authors each pattern — doesn't affect this change's spec.
- Will the dynamic latest-post-swap and province-count-grid map variants ever move from Figma exploration to "Ready for Dev"? Not tracked by this change; a future change would define them if/when confirmed.
