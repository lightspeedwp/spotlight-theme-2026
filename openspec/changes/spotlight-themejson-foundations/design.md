## Context

See `proposal.md` for motivation. Relevant constraints:
- This repo's `theme.json` is currently placeholder-only (starter palette/type/spacing) — there is no live content or existing templates/patterns consuming those placeholder slugs, so this is a greenfield replacement, not a migration of in-use tokens.
- A sibling LightSpeed theme, `kwv-theme-2026`, establishes a structural pattern (semantic `settings.custom` token groups, self-hosted font-face, explicit non-generated preset lists) that this change follows for consistency across LightSpeed themes — but its actual values (colours, fluid clamp ranges) are theme-specific and not reused.
- Several audited values are provisional pending a designer review scheduled after this change is drafted (tracked in the proposal's Impact section and as a Linear comment on LS-1709).

## Goals / Non-Goals

**Goals:**
- Get the audited palette, typography, spacing, radius, border-width, and layout tokens into `theme.json` so template/pattern work (LS-1711+) isn't blocked.
- Keep the token *shape* consistent with `kwv-theme-2026` (same semantic custom-token groups, same self-hosted font pattern) so both themes stay maintainable by the same conventions.
- Make provisional values easy to correct in one place once the designer confirms them.

**Non-Goals:**
- Fluid/clamp-based responsive scaling for spacing or type. Figma provides one static px value per step; inventing fluid min/max ranges without design input would risk conflicting with actual intent. Static values now, fluid scaling is a candidate fast-follow once (if) the designer specifies fluid behavviour.
- Any `styles.blocks` per-block overrides, templates, template parts, or patterns — that's LS-1711/1712.
- Documenting custom CSS/JS exceptions — that's LS-1713.
- Fixing the Figma-side code-syntax bug on the Accent ramp — that's a Figma-file fix for the design team, not a theme.json concern.

## Decisions

**Single `design-tokens` capability, not split by token type.** Colour/type/spacing/radius all land in one `theme.json` settings pass and share one review/implementation lifecycle for phase 1. Splitting into `color-tokens`/`typography-tokens`/etc. would add spec overhead without a corresponding independent lifecycle — they're one foundation, not separable capabilities yet.

**Static values now, not fluid clamp().** `kwv-theme-2026` uses `clamp()` for every spacing/font-size step. Adopting that here would mean inventing fluid min/max bounds Spotlight's design system hasn't specified. Alternative considered: copy kwv's clamp *shape* with Spotlight's numbers as the max and an arbitrary ~80% as the min — rejected, since an invented min is exactly the kind of unconfirmed value this change is trying to avoid introducing silently.

**Border width as `settings.custom.borderWidth`, not inline literals.** Core `theme.json` has no preset list for border width, so without a custom token group every block style needing e.g. the "Large" (8px) border would hardcode `8px` directly. A custom token group gives one source of truth, consistent with how `border-width-400` already existed as a single custom variable in the Figma pull.

**Drop the `kwv-theme-2026` blanket heading `uppercase` transform.** Spotlight's Libre Franklin headlines are normal-case in every mockup reviewed; only the `H6`/Label style is uppercase. Copying kwv's shared `heading` element (which forces uppercase) would visibly misrender every headline on the site — this is a case where the reference theme's *structural* pattern (a shared `heading` element feeding h1–h6) is worth keeping, but its specific style value is not.

**Implement provisional values now rather than block on designer sign-off.** Libre Franklin (vs a stale `Libre Baskerville` variable), the 46/40/32px H1–H3 sizes (vs a stale 32/28 pull from mockup frames), the exact `Paragraph/Large` px, and the naming for tokens Figma marks "Not defined" (`neutral-450`, `accent-*`, `surface/dark-card`, `surface/dark-inner`, `data/positive`, the 90px "Gigantic" spacing step, the 12px "Card" radius step) are all treated as working values now, clearly flagged in the proposal, rather than blocking this change. None of these change the *shape* of the settings being added — only their exact numbers — so correcting them later (once confirmed on LS-1709) is a small, isolated diff to `theme.json`, not a rework.

**Name the Accent ramp by its Figma variable name, not its (buggy) code syntax.** The Accent scale's Figma "Code Syntax" field currently reads `brand-*` due to a documentation bug on the Figma side. Slugging these as `accent-100`…`accent-900` (matching the Figma variable *name*, and what the Brand & Design Style Guide poster actually documents) avoids baking a known Figma-side bug into the theme.

## Risks / Trade-offs

- **[Provisional values change after designer review]** → Mitigation: every provisional value is isolated to `theme.json`'s settings block and listed explicitly in the proposal's Impact section; correcting any of them is a targeted value edit, not a structural change.
- **[Removing legacy placeholder palette slugs (`base-2`, `accent-2`, `contrast-2`) is a breaking change]** → Mitigation: confirmed no templates, patterns, or styles in this repo currently reference them (the theme has no content built yet).
- **[Self-hosted Libre Franklin / Source Sans 3 font files may not be sourced yet]** → Mitigation: tracked as an explicit task; if files aren't available at implementation time, fall back temporarily to a system-font stack and flag it rather than blocking the whole change.
- **[Static token values diverge from `kwv-theme-2026`'s fluid pattern]** → Mitigation: token *names* and grouping still mirror kwv (`custom.fontWeight`/`.lineHeight`/`.letterSpacing`), so the authoring pattern stays consistent across LightSpeed themes even though the scaling behaviour differs for now.

## Migration Plan

Greenfield replacement — no existing content depends on the current placeholder tokens.
1. Apply the new `settings.color`, `settings.typography`, `settings.spacing`, `settings.border`, `settings.custom`, and `settings.layout` blocks to `theme.json`.
2. Add font files under `assets/fonts/` and register their `@font-face` entries.
3. Run `npm run schema:validate` and `npm run theme:validate` (per this repo's `AGENTS.md`) to confirm the file is still schema-valid and passes theme consistency checks.
4. Rollback, if needed, is a plain `git revert` of the `theme.json`/`assets/fonts/` commit — no data migration involved.

## Open Questions

- Exact px for `Paragraph/Large` / `Button/Large` (illegible on the design poster) — tracked on LS-1709, doesn't change the font-size scale's shape, only one value.
- Whether Libre Franklin (vs the stale `Libre Baskerville` Figma variable) is fully confirmed — tracked on LS-1709; implementation proceeds with Libre Franklin.
- Whether the designer wants the Accent ramp's Figma code-syntax bug fixed upstream — doesn't block this change either way.
