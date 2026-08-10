## Context

See `proposal.md` for motivation. Relevant constraints:
- Grounded in six screenshots reviewed and discussed directly with the requester during an explore-mode session: the Figma "Spotlight Design System" file's front-page, "Latest News" (posts index), single-post (×2 states), and Contact/About page frames, plus a components sheet confirming existing button/quote styling (LS-1711) rather than introducing new scope.
- `theme.json` already has the full token layer (LS-1709/1710) and base element/button/quote styles (LS-1711) — this change only consumes those; no new `settings.*` or `styles.*` entries.
- This theme has no JS build pipeline (`AGENTS.md` is explicit about not inventing one), which rules out client-side query filtering for the topic-filter pills — they must be real page navigations.
- `kwv-theme-2026` is a structural reference only (its `front-page.html`/`index.html` separation, page variants by structural need, `promo-bar.html` part, explicit per-taxonomy template files) — its values and exact file set are not reused.
- No `patterns/` directory exists in this theme yet. This change defines where pattern insertion points go in templates/parts; it does not author the patterns themselves.

## Goals / Non-Goals

**Goals:**
- Establish every template WordPress needs to render Spotlight's designed page types (front page, posts index, single post, static page) plus sane fallbacks for the undesigned ones (search, 404), and the shared template parts those templates depend on.
- Keep every template/part's structure traceable to a specific reviewed design frame, or explicitly flagged as a fallback default where no design exists.
- Resolve the template-hierarchy-level ambiguities surfaced during exploration (front-page vs. home vs. archive, sidebar reuse, trust-bar placement) so implementation isn't guessing mid-build.

**Non-Goals:**
- Authoring the actual pattern markup/content that fills each template's insertion points (hero, card grid, dashboard modules, newsletter modules, provincial map, republish module) — a follow-on change once `patterns/` is established.
- Deciding whether the dashboard-promo module (full banner vs. sidebar card) and the explore-topics module (grid-with-counts vs. sidebar list) are each one flexible pattern or two size-specific pattern files — a pattern-authoring decision with no bearing on template structure.
- Any new `design-tokens` or `base-styles` capability requirements. A "FEATURED" quote treatment (right-side border box) spotted on the components sheet, distinct from the existing left-border pull-quote, is noted as a possible `base-styles` follow-up, not built here.
- Resolving the primary-navigation label discrepancy on the "Latest News" frame (it reads "News/Provinces", missing "About us", where the other three reviewed frames agree on "Latest news/In Focus/.../About us") or the floating arrow-chip icon seen on several frames — both are parked as designer-confirmation items, not template-structure decisions, since WordPress's Navigation block is one global entity and can't structurally vary per template.

## Decisions

**`front-page.html` and `home.html` are two separate, deliberately different templates, not one file wearing two hats.** Confirmed directly with the requester: the front page and the "Latest News" posts index have distinct designs (curated modules vs. a filterable card stream). WordPress's Reading settings support this natively — a static front page plus a separate Posts Page — so no custom logic is needed, only the two template files.

**`archive.html` covers both category and tag, with no `category.html`/`tag.html` split.** The topic-filter pills on the Posts Page are confirmed to be real navigations to category/tag term URLs (no JS build pipeline exists to filter client-side), and no reviewed frame shows a taxonomy-specific visual treatment — every topic pill leads to the same card-grid layout. Splitting off a dedicated `category.html` later, if a taxonomy ever needs its own look, is a low-cost one-file addition; inventing the split now would be speculative.

**`sidebar-editorial` is one shared template part bundling the dashboard-promo and newsletter-subscribe modules — the two that are genuinely identical between `single.html` and `page.html`'s reviewed frames.** A shared part is the direct fulfillment of the acceptance criteria's "reusable editorial framing," and avoids the two templates drifting out of sync when that shared content changes. The "Explore topics" list is single-post-specific — it appears in the single-post frames but not the Contact/page frame — so it lives directly in `single.html`, after the shared part, rather than being bundled into content `page.html` would also render.

**`trust-bar` is its own template part, not folded into `footer.html`.** The credibility band appears identically positioned (directly above the footer) on every single reviewed screen, and the components sheet shows it with an independent compact variant — evidence it is treated as a standalone, reusable unit in the design system itself, matching the `kwv-theme-2026` structural precedent of a dedicated `promo-bar.html` part sitting outside of `header`/`footer`.

**`search.html` and `404.html` reuse the home/archive scaffolding rather than inventing new layout.** Neither appears in any reviewed frame. Rather than design something new unreviewed by the design team, both reuse the existing card-grid-and-chrome structure (minus topic pills), which keeps the "calmer editorial hierarchy" and "scalable archive patterns" acceptance criteria satisfied with zero new visual vocabulary. This is the same "ship a reasonable default now, flag it, correct later" posture the archived LS-1704 design docs already established for this theme.

**`index.html` is kept, unmodified in spirit, as the WordPress-mandated fallback.** Once `home.html` and `archive.html` exist, `index.html` is no longer the primary render path for any real URL on this site, but WordPress still requires it as the ultimate fallback. It is left as-is rather than redesigned, since redesigning a template that (by design) should rarely if ever render is not a good use of this change's scope.

**Main content renders before the sidebar in document order, regardless of visual placement.** `single.html` and `page.html` place `sidebar-editorial` after the main content column in markup order (even though CSS/flex layout may present it visually alongside or interleaved), so screen readers and search engines encounter the article/page content first. This is a structural default consistent with `AGENTS.md`'s accessibility expectations, not something the reviewed screenshots could confirm either way.

## Risks / Trade-offs

- **[`archive.html`'s shared category/tag structure may not survive contact with a taxonomy that needs a different treatment]** → Mitigation: WordPress's template hierarchy already supports `category.html`/`tag.html` as more-specific overrides; adding one later is additive, not a rework of `archive.html` itself.
- **[Reused, unreviewed layout for `search.html`/`404.html` may not match a future designer intent]** → Mitigation: both are flagged in `proposal.md` as explicitly fallback/no-design-source; correcting them later is a scoped, isolated change to two files.
- **[The primary-navigation discrepancy on the "Latest News" frame is left unresolved]** → Mitigation: the requester will confirm the correct set with the designer (Zared); the header template part is built against the 3-frame-agreeing version, which is a one-line content edit to correct if wrong.
- **[Trust-bar's compact/small variant seen on the components sheet has no confirmed usage context]** → Mitigation: only the full five-item band is built by this change; the compact variant is left as an open question below rather than guessed into an unused variant markup.

## Migration Plan

Additive only — no existing template or part is removed, and `templates/index.html` is unchanged.
1. Rework `parts/header.html` and `parts/footer.html` per the `template-parts` spec.
2. Add `parts/trust-bar.html` and `parts/sidebar-editorial.html`.
3. Add `templates/front-page.html`, `home.html`, `archive.html`, `single.html`, `page.html`, `search.html`, `404.html` per the `templates` spec, each including the relevant template parts and pattern insertion points (marked with placeholder content until patterns exist).
4. Register any new template parts in `theme.json`'s `templateParts`, and any custom template labels in `customTemplates`, if applicable.
5. Run `npm run schema:validate` and `npm run theme:validate`.
6. Manually verify in the Site Editor that each template renders without fatal errors and that `home.html`/`archive.html` are selected correctly for the Posts Page vs. a category URL.
7. Rollback, if needed, is a plain `git revert` of the templates/parts/theme.json commit(s) — no data migration involved.

## Open Questions

- Is the dashboard-promo module (full banner on the front page, compact card in the sidebar) one pattern with a size variant, or two separate pattern files (as `kwv-theme-2026` does with `blog-card`/`blog-card-large`)? Deferred to whichever change first authors patterns — doesn't affect where either insertion point sits in the templates defined here.
- Same deferral for the explore-topics module (grid-with-counts on the front page vs. a simple list in the sidebar).
- What is the trust-bar's compact/small variant (seen on the components sheet) actually used for? Not built in this change; needs a designer answer before it's added anywhere.
- Is the "Latest News" frame's primary-navigation labelling ("News/Provinces", no "About us") a genuine intended variant or a stale frame? Requester is confirming with the designer; the header part is built against the 3-frame-agreeing version in the meantime.
- Is the floating arrow-chip icon seen on several frames real site UI or a Figma-plugin artifact? Requester is confirming with the designer; ignored by this change either way.
