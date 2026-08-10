## 1. LS-1714 + LS-1715 — shared template parts (branch: `feat/ls-1715-shared-template-parts-and-wrappers`, base: `develop`)

- [x] 1.1 Commit this OpenSpec change (`proposal.md`, `design.md`, `specs/`, `tasks.md`) as the LS-1714 audit/hierarchy-mapping deliverable
- [x] 1.2 Rework `parts/header.html`: add a utility bar (newsletter-prompt and republish-prompt links) positioned before the primary navigation
- [x] 1.3 Rework `parts/header.html`: add a search-trigger element and a "Dashboards" call-to-action button/link
- [x] 1.4 Rework `parts/footer.html`: add a secondary-navigation links row
- [x] 1.5 Rework `parts/footer.html`: add a social-icons row, keeping the existing copyright paragraph
- [x] 1.6 Create `parts/trust-bar.html` with the five credibility items (independence, evidence-based reporting, years of impact, free-to-republish, public-health focus), each as an icon-and-label group
- [x] 1.7 Create `parts/sidebar-editorial.html` bundling a dashboard-promo module placeholder, a newsletter-subscribe module placeholder, and an explore-topics list placeholder as three distinct content groups
- [x] 1.8 Register `trust-bar` and `sidebar-editorial` in `theme.json`'s `templateParts` array
- [x] 1.9 Run `npm run schema:validate` and `npm run theme:validate`
- [x] 1.10 Update `CHANGELOG.md` under `## [Unreleased]`
- [x] 1.11 Open PR against `develop` — "Closes LS-1714, LS-1715" (PR #4)

## 2. LS-1716 — archive template structure (branch: `feat/ls-1716-archive-template-structure`, base: `feat/ls-1715-shared-template-parts-and-wrappers`)

- [ ] 2.1 Create `templates/home.html`: page header (title + search), topic-filter pills, a `core/query` block (inherited query) rendering a post-card grid, `core/query-pagination`, with `header`, `trust-bar`, and `footer` template parts
- [ ] 2.2 Create `templates/archive.html`: same card-grid structure as `home.html` using an inherited `core/query` block, with `header`, `trust-bar`, and `footer` template parts
- [ ] 2.3 Add any needed `theme.json` `customTemplates` entry for `home`/`archive` if an editor-facing label/description is warranted
- [ ] 2.4 Run `npm run schema:validate` and `npm run theme:validate`
- [ ] 2.5 Verify in the Site Editor: `home.html` renders for the configured Posts Page, and a category/tag URL renders `archive.html`
- [ ] 2.6 Update `CHANGELOG.md` under `## [Unreleased]`
- [ ] 2.7 Open PR against `feat/ls-1715-shared-template-parts-and-wrappers` (note: depends on that PR, do not merge first) — "Closes LS-1716"

## 3. LS-1717 — single and page template structure (branch: `feat/ls-1717-single-and-page-template-structure`, base: `feat/ls-1715-shared-template-parts-and-wrappers`)

- [ ] 3.1 Create `templates/single.html`: content column (category label, title, byline/date, featured image, body) plus `sidebar-editorial` template-part column, previous/next post navigation, and a related-posts `core/query` block, with `header`, `trust-bar`, and `footer` template parts — ensure main content precedes the sidebar in markup order
- [ ] 3.2 Create `templates/page.html`: prose content column plus `sidebar-editorial` template-part column (no post-meta elements), with `header`, `trust-bar`, and `footer` template parts — ensure main content precedes the sidebar in markup order
- [ ] 3.3 Add any needed `theme.json` `customTemplates` entry for `single`/`page` if an editor-facing label/description is warranted
- [ ] 3.4 Run `npm run schema:validate` and `npm run theme:validate`
- [ ] 3.5 Verify in the Site Editor: `single.html` and `page.html` both render with the shared `sidebar-editorial` part
- [ ] 3.6 Update `CHANGELOG.md` under `## [Unreleased]`
- [ ] 3.7 Open PR against `feat/ls-1715-shared-template-parts-and-wrappers` (note: depends on that PR, do not merge first) — "Closes LS-1717"

## 4. LS-1718 — system templates and edge-case structure (branch: `feat/ls-1718-system-templates-and-edge-case-structure`, base: `feat/ls-1715-shared-template-parts-and-wrappers`)

- [ ] 4.1 Create `templates/front-page.html`: compose pattern insertion-point placeholders for hero, topic grid, latest-news row, dashboard CTA, special projects, provincial coverage + newsletter, and perspectives, with `header`, `trust-bar`, and `footer` template parts and no `core/query` block (bundled here rather than under 1716/1717, since it predates the dev-ready designs and doesn't map cleanly to either of those sub-issue titles)
- [ ] 4.2 Create `templates/search.html`: reuse the home/archive card-grid structure with a `core/query` block bound to the search query, no topic-filter pills, with `header`, `trust-bar`, and `footer` template parts
- [ ] 4.3 Create `templates/404.html`: calm message plus a search form element, no post query loop, with `header`, `trust-bar`, and `footer` template parts
- [ ] 4.4 Confirm `templates/index.html` is left unmodified as the fallback-of-last-resort
- [ ] 4.5 Add any needed `theme.json` `customTemplates` entry for `front-page`/`search`/`404` if an editor-facing label/description is warranted
- [ ] 4.6 Run `npm run schema:validate` and `npm run theme:validate`
- [ ] 4.7 Verify in the Site Editor: `front-page.html` renders for the site root, `search.html`/`404.html` render without fatal errors
- [ ] 4.8 Update `CHANGELOG.md` under `## [Unreleased]`
- [ ] 4.9 Open PR against `feat/ls-1715-shared-template-parts-and-wrappers` (note: depends on that PR, do not merge first) — "Closes LS-1718"

## 5. After LS-1715 merges to `develop`

- [ ] 5.1 Retarget the LS-1716, LS-1717, and LS-1718 PRs' base branch to `develop` (automatic if `feat/ls-1715-...` is deleted post-merge)
- [ ] 5.2 Confirm no rebase is needed — this repo merges via merge commits, so each sibling branch already contains LS-1715's commits as ancestors
