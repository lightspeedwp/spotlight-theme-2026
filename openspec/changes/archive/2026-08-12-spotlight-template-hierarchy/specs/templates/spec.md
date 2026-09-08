## Purpose

Defines which WordPress template file renders which URL for Spotlight, and each template's structural composition — layout, template-part slots, and pattern insertion points — establishing the initial template hierarchy the theme has lacked since inception.

## ADDED Requirements

### Requirement: Front page template
`templates/front-page.html` SHALL render the curated homepage as a composition of pattern insertion points and template parts, with no query loop, distinct from the Posts Page.

#### Scenario: Front page contains no post query
- **WHEN** `templates/front-page.html` is inspected
- **THEN** it SHALL NOT contain a `core/query` block

#### Scenario: Front page includes header, trust bar, and footer parts
- **WHEN** `templates/front-page.html` is inspected
- **THEN** it SHALL include template-part references to `header`, `trust-bar`, and `footer`

### Requirement: Home (Posts Page) template
`templates/home.html` SHALL render the site's designated Posts Page as a paginated stream of posts with topic-filter navigation, structurally distinct from `front-page.html`'s curated composition.

#### Scenario: Home template includes a paginated, inherited query loop
- **WHEN** `templates/home.html` is inspected
- **THEN** it SHALL contain a `core/query` block configured with `query.inherit: true` and a `core/query-pagination` block

#### Scenario: Home template includes header, trust bar, and footer parts
- **WHEN** `templates/home.html` is inspected
- **THEN** it SHALL include template-part references to `header`, `trust-bar`, and `footer`

#### Scenario: Home template includes real topic-filter links
- **WHEN** `templates/home.html` is inspected
- **THEN** it SHALL contain real category/tag term links (server-rendered navigations to term archive URLs) and SHALL NOT implement topic filtering via client-side JavaScript

### Requirement: Archive template shared structure
`templates/archive.html` SHALL share the same post-listing structure as `templates/home.html` (query loop, card grid) so that category and tag term URLs — reached by following a topic-filter link — render consistently with the Posts Page, without requiring separate `category.html` or `tag.html` files.

#### Scenario: Archive resolves category and tag URLs without dedicated templates
- **WHEN** a category or tag archive URL is requested and no `category.html`/`tag.html` file exists in the theme
- **THEN** WordPress's template hierarchy SHALL fall back to and render `templates/archive.html`

#### Scenario: Archive contains an inherited query loop
- **WHEN** `templates/archive.html` is inspected
- **THEN** it SHALL contain a `core/query` block configured to inherit the current archive's query context

### Requirement: Single post template
`templates/single.html` SHALL render post content in a two-column layout — a constrained-width content column and a sidebar column (the shared `sidebar-editorial` template part plus a single-post-specific explore-topics module) — plus fixed post-navigation and related-posts elements that are not optional per-post.

#### Scenario: Single includes the sidebar-editorial part
- **WHEN** `templates/single.html` is inspected
- **THEN** it SHALL include a template-part reference to `sidebar-editorial`

#### Scenario: Single includes an explore-topics module not shared with Page
- **WHEN** `templates/single.html` is inspected
- **THEN** it SHALL contain an explore-topics content group in its sidebar column, positioned after the `sidebar-editorial` template-part reference, distinct from the shared part itself

#### Scenario: Single includes previous/next post navigation
- **WHEN** `templates/single.html` is inspected
- **THEN** it SHALL contain both a previous-post and a next-post navigation link element

#### Scenario: Single includes a related-posts query
- **WHEN** `templates/single.html` is inspected
- **THEN** it SHALL contain a `core/query` block distinct from the main post content, configured with `query.excludeCurrent: true` so the current post never appears among its own related posts, and identifiable (e.g. via a distinguishing `className`) so a `query_loop_block_query_vars` filter can scope it to categories shared with the current post — a post's categories vary per post and can't be expressed as a static `query` attribute value

### Requirement: Page template
`templates/page.html` SHALL render static page content in a two-column layout reusing the same `sidebar-editorial` template part as `templates/single.html`, with no post-meta elements.

#### Scenario: Page includes the sidebar-editorial part
- **WHEN** `templates/page.html` is inspected
- **THEN** it SHALL include a template-part reference to `sidebar-editorial`

#### Scenario: Page excludes post-meta elements
- **WHEN** `templates/page.html` is inspected
- **THEN** it SHALL NOT contain a post-date, post-author, or post-terms element bound to post data

### Requirement: Search and 404 fallback templates
`templates/search.html` and `templates/404.html` SHALL reuse the home/archive card-grid-and-chrome structure without topic-filter pills, since no distinct design source exists for either, keeping their layout consistent with the rest of the theme rather than introducing new patterns.

#### Scenario: Search results reuse the card grid without topic pills
- **WHEN** `templates/search.html` is inspected
- **THEN** it SHALL contain a `core/query` block using the search query and SHALL NOT contain topic-filter pill elements

#### Scenario: 404 offers a recovery path instead of a dead end
- **WHEN** `templates/404.html` is inspected
- **THEN** it SHALL contain a search form element and SHALL NOT contain a post query loop

### Requirement: Index retained as fallback
`templates/index.html` SHALL remain in place as WordPress's required fallback-of-last-resort template and SHALL NOT be relied upon as the primary render path for any URL once `home.html` and `archive.html` exist.

#### Scenario: Index file still exists after this change
- **WHEN** the `templates/` directory is inspected after this change
- **THEN** `templates/index.html` SHALL still be present
