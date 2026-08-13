# template-parts Specification

## Purpose

Defines the reusable template parts Spotlight's templates share — header, footer, trust bar, and the editorial sidebar — so shared chrome and reusable editorial framing are authored once and included consistently across templates.

## Requirements

### Requirement: Header template part
`parts/header.html` SHALL include a utility bar (newsletter and republish links), the primary site navigation, a search trigger, and a "Dashboards" call-to-action, in addition to the existing site logo.

#### Scenario: Header includes utility links ahead of primary navigation
- **WHEN** `parts/header.html` is inspected
- **THEN** it SHALL contain link elements for a newsletter prompt and a republish prompt, positioned before the primary navigation block

#### Scenario: Header includes a search trigger and Dashboards CTA
- **WHEN** `parts/header.html` is inspected
- **THEN** it SHALL contain a search-trigger element and a button or link labelled for the Dashboards call-to-action

### Requirement: Footer template part
`parts/footer.html` SHALL include a secondary-navigation links row and a social-icons row, in addition to the existing copyright line.

#### Scenario: Footer includes secondary navigation and social rows
- **WHEN** `parts/footer.html` is inspected
- **THEN** it SHALL contain a group of secondary navigation links and a group of social-icon links, alongside the existing copyright paragraph

### Requirement: Trust bar template part
`parts/trust-bar.html` SHALL render a five-item credibility band (independence, evidence-based reporting, years of impact, free-to-republish, public-health focus) and SHALL be included directly above the footer on every template.

#### Scenario: Trust bar renders five credibility items
- **WHEN** `parts/trust-bar.html` is inspected
- **THEN** it SHALL contain exactly five icon-and-label item groups

#### Scenario: Trust bar precedes the footer on every template
- **WHEN** any of `front-page.html`, `home.html`, `archive.html`, `single.html`, `page.html`, `search.html`, or `404.html` is inspected
- **THEN** each SHALL include a template-part reference to `trust-bar` immediately before its template-part reference to `footer`

### Requirement: Sidebar editorial template part
`parts/sidebar-editorial.html` SHALL bundle a dashboard-promo module and a newsletter-subscribe module — the two sidebar modules common to both `single.html` and `page.html` — and SHALL be the single shared source for those modules.

#### Scenario: Sidebar bundles two distinct modules
- **WHEN** `parts/sidebar-editorial.html` is inspected
- **THEN** it SHALL contain two distinct content groups: a dashboard-promo module and a newsletter-subscribe module

#### Scenario: Sidebar is shared, not duplicated per template
- **WHEN** `templates/single.html` and `templates/page.html` are inspected
- **THEN** both SHALL reference the same `sidebar-editorial` template part rather than each defining its own inline sidebar markup
