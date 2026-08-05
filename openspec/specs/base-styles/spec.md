# Base Styles Specification

## Purpose

Defines the base element styling (links, headings' spacing rhythm, lists, quotes) and the shared `core/button` block-style variations that consume the design-tokens capability's presets, giving Spotlight a calm editorial reading experience out of the box.

## Requirements

### Requirement: Link colour
`theme.json` SHALL style the `link` element with `accent-200` text and an `accent-300` `:hover` text colour, not the `brand` ramp (which is reserved for category badges/labels, a pattern-level concern outside this capability).

#### Scenario: In-body link resolves to the accent ramp
- **WHEN** the `link` element style is inspected
- **THEN** its text colour SHALL resolve to `var(--wp--preset--color--accent-200)` and its `:hover` text colour SHALL resolve to `var(--wp--preset--color--accent-300)`

#### Scenario: Brand ramp is untouched by link styling
- **WHEN** the `link` element style is inspected
- **THEN** it SHALL NOT reference any `brand-*` colour slug

### Requirement: Default button styling
`theme.json` SHALL style the `button` element with a filled background, text colour, border-radius, and padding, so a `core/button` block with no style variation applied renders with an intentional look rather than browser/core defaults.

#### Scenario: Unstyled button has an authored appearance
- **WHEN** a `core/button` block is inserted with no block-style variation selected
- **THEN** it SHALL render with a non-transparent background colour, a border-radius, and padding defined by the `button` element style

### Requirement: Button block-style variations
The theme SHALL register three named `core/button` block-style variations — `primary` (filled, full-pill radius), `dark` (filled dark, standard radius), and `dark-pill` (filled dark, full-pill radius) — each as a standalone file under `styles/blocks/button/`, so authors can select the correct look per context from the block style picker.

#### Scenario: Primary variation is selectable and fully specified
- **WHEN** the `primary` block-style variation is applied to a `core/button` block
- **THEN** it SHALL resolve a fill background colour, a full-pill (`Round`, slug `500`) border-radius, and its own padding — independent of any other variation's values

#### Scenario: Dark and Dark Pill variations share colour but differ in shape
- **WHEN** the `dark` and `dark-pill` block-style variations are compared
- **THEN** both SHALL resolve the same dark fill background colour, and only `dark-pill` SHALL resolve a full-pill (`Round`, slug `500`) border-radius

### Requirement: Quote and pullquote styling
`theme.json` SHALL style `core/quote` and `core/pullquote` with a border accent, quote-body typography, and a distinct, muted `cite` element style, so block quotations read as an intentional editorial callout rather than plain paragraph text.

#### Scenario: Quote has a border accent and styled citation
- **WHEN** the `core/quote` block style is inspected
- **THEN** it SHALL define a border and its nested `cite` element SHALL resolve a text colour distinct from the quote body's text colour

### Requirement: List styling
`theme.json` SHALL define a default `core/list` style (marker colour, item spacing, and start indent) using only tokens already defined by the design-tokens capability, since no design source exists for this element.

#### Scenario: List marker inherits the contrast colour
- **WHEN** the `core/list` block style is inspected
- **THEN** its marker colour SHALL resolve to `var(--wp--preset--color--contrast)`

### Requirement: Heading and paragraph spacing rhythm
`theme.json` SHALL define top and/or bottom margin values for heading elements and paragraph spacing rhythm, drawn from `settings.spacing.spacingSizes` steps already defined by the design-tokens capability, without introducing new spacing tokens.

#### Scenario: Heading margin resolves to an existing spacing token
- **WHEN** a heading element's margin is inspected
- **THEN** it SHALL resolve to one of the `size` or fluid values already defined in `settings.spacing.spacingSizes`, and SHALL NOT introduce a new spacing preset or a literal pixel/rem value outside that scale
