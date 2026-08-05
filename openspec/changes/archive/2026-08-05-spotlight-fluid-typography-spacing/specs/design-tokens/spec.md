## MODIFIED Requirements

### Requirement: Font-size scale
`theme.json` SHALL define a `settings.typography.fontSizes` scale with 9 steps (slugs `100`–`900`) covering Tiny (12px) through Colossal (64px). Each step SHALL use WP core's native `fluid` field (`min`/`max` in `rem`) so core generates the responsive `clamp()` itself, replacing the earlier 7-step static scale.

#### Scenario: Heading sizes match the corrected, fluid scale
- **WHEN** the `h1` element style is inspected
- **THEN** its font size SHALL resolve to the `800` step (Gigantic, fluid between 2.25rem and 3rem), and `h2`/`h3` SHALL resolve to the `700` (Huge) and `600` (X-Large) steps respectively

#### Scenario: A font-size preset provides both a static and fluid value
- **WHEN** `settings.typography.fontSizes` is inspected
- **THEN** every entry SHALL have a `size` (rem) and a `fluid` object with `min` and `max` (rem)

### Requirement: Spacing scale
`theme.json` SHALL define a `settings.spacing.spacingSizes` scale with 11 explicit steps, each expressed as a `clamp(minRem, calc(A + Bvw), maxRem)` string in `rem`, replacing the earlier static px-based scale. The interpolation SHALL use a 768px–1320px viewport range.

#### Scenario: Spacing step resolves fluidly between its min and max
- **WHEN** the `90` (Gigantic) spacing step is evaluated at a viewport narrower than 768px
- **THEN** it SHALL resolve to its minimum bound (3.5rem), and at a viewport wider than 1320px it SHALL resolve to its maximum bound (5.625rem)
