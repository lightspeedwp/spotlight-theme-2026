## Purpose

Defines the theme.json settings that establish Spotlight's colour, typography, spacing, border-radius, border-width, and layout-width tokens — the foundational preset layer that templates, patterns, and block styles build on.

## ADDED Requirements

### Requirement: Colour palette
`theme.json` SHALL define a `settings.color.palette` containing the audited Spotlight colours: `base`, `contrast`, a 9-step `neutral` ramp (`neutral-100`…`neutral-900`) plus a `neutral-450` gap-fill step, a 9-step `brand` ramp (`brand-100`…`brand-900`), a 9-step `accent` ramp (`accent-100`…`accent-900`), 5 system colours (`error`, `warning`, `information`, `success`, `positive`, each with a `-foreground` and `-background` slug), and 2 surface colours (`surface-dark-card`, `surface-dark-inner`).

#### Scenario: Palette slug resolves to the audited value
- **WHEN** a block or style references `var:preset|color|brand-500`
- **THEN** it resolves to `#d92131`

#### Scenario: Legacy placeholder slugs are gone
- **WHEN** the palette is inspected after this change
- **THEN** it SHALL NOT contain the previous starter slugs `base-2`, `accent-2`, or `contrast-2`

### Requirement: Typography families
`theme.json` SHALL register a `heading` font family (Libre Franklin) and a `body` font family (Source Sans 3), each with self-hosted `@font-face` definitions under `assets/fonts/`, replacing the empty starter `fontFamilies` list.

#### Scenario: Heading family is available as a preset
- **WHEN** `settings.typography.fontFamilies` is inspected
- **THEN** it SHALL contain a `heading` entry whose `fontFamily` value starts with `Libre Franklin` and a `body` entry whose `fontFamily` value starts with `Source Sans 3`

### Requirement: Font-size scale
`theme.json` SHALL define a `settings.typography.fontSizes` scale covering Tiny (12px) through Display (46px), replacing the placeholder 6-size scale.

#### Scenario: Heading sizes match the audited scale
- **WHEN** the `h1` element style is inspected
- **THEN** its font size SHALL resolve to the Display step (46px), and `h2`/`h3` SHALL resolve to 40px/32px respectively

### Requirement: Heading case treatment
Heading elements (`h1`–`h5`) SHALL render in normal case. Only the `H6`/Label style SHALL apply an uppercase text transform.

#### Scenario: H1–H5 are not uppercased
- **WHEN** the `heading` or `h1`–`h5` element styles are inspected
- **THEN** none of them SHALL set `textTransform: uppercase`

### Requirement: Spacing scale
`theme.json` SHALL define a `settings.spacing.spacingSizes` scale with 10 explicit steps (5px–100px, named XXS through Colossal), replacing the auto-generated geometric `spacingScale`.

#### Scenario: Spacing step resolves to the audited px value
- **WHEN** a block references `var:preset|spacing|90`
- **THEN** it resolves to `90px` (the "Gigantic" step)

### Requirement: Border radius scale
`theme.json` SHALL define a `settings.border.radiusSizes` scale with 7 steps: `0` (None), `4` (Small), `8` (Medium), `12` (Card), `16` (Large), `24` (X-Large), `9999` (Round).

#### Scenario: Card radius is distinct from Medium
- **WHEN** the `Card` and `Medium` radius steps are compared
- **THEN** `Card` resolves to `12px` and `Medium` resolves to `8px` — they SHALL NOT be equal

### Requirement: Border width tokens
`theme.json` SHALL define a `settings.custom.borderWidth` token group (`none`/`base`/`small`/`medium`/`large` → `0`/`1px`/`2px`/`4px`/`8px`), since core theme.json has no native border-width preset list.

#### Scenario: Border width token is available for block styles
- **WHEN** a block style references `var:custom|border-width|large`
- **THEN** it resolves to `8px`

### Requirement: Layout widths
`theme.json` SHALL set `settings.layout.contentSize` to `800px` and `settings.layout.wideSize` to `1320px`, replacing the placeholder 720px/1200px values.

#### Scenario: Content width matches the audited layout token
- **WHEN** `settings.layout.contentSize` is inspected
- **THEN** it SHALL be `800px`
