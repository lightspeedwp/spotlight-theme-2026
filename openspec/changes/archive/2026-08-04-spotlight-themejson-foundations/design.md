## Context

See `proposal.md` for motivation. Relevant constraints:
- This repo's `theme.json` is currently placeholder-only (starter palette/type/spacing) — there is no live content or existing templates/patterns consuming those placeholder slugs, so this is a greenfield replacement, not a migration of in-use tokens.
- A sibling LightSpeed theme, `kwv-theme-2026`, establishes a structural pattern (semantic `settings.custom` token groups, self-hosted font-face, explicit non-generated preset lists, numeric `n00`-style slugs for native preset arrays) that this change follows for consistency across LightSpeed themes — but its actual values (colours, fluid clamp ranges) are theme-specific and not reused.
- The designer has since confirmed the type scale, heading typeface, body/button sizes, the full `accent-100`–`accent-900` colour mapping, and the proposed `250` slug for the `Card` radius step (raised during the LS-1709 audit; see proposal.md's Impact section). Figma's Code Syntax for the Accent ramp will be updated on the design side later — implementation proceeds now against the confirmed values rather than waiting on that.

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

**Drop the `kwv-theme-2026` blanket heading `uppercase` transform.** Spotlight's Libre Baskerville headlines are normal-case in every mockup reviewed; only the `H6`/Label style is uppercase. Copying kwv's shared `heading` element (which forces uppercase) would visibly misrender every headline on the site — this is a case where the reference theme's *structural* pattern (a shared `heading` element feeding h1–h6) is worth keeping, but its specific style value is not.

**Implement provisional values now rather than block on designer sign-off.** This paid off: the heading typeface (Libre Baskerville, not the poster's Libre Franklin), the full H1–H6 scale (48/40/32/24/20/20px), and the `Paragraph`/`Button` Large size (32px) were all confirmed by the designer during this change's drafting, so the "provisional" values in the original draft are now final. What's still genuinely open (the `Card` radius slug number, and the unfixed half of the Accent code-syntax bug) doesn't change the *shape* of the settings being added — only a slug label or an implementation-detail workaround — so it doesn't block finishing this change.

**Name the Accent ramp by its Figma variable name, not its (buggy) code syntax.** The Accent scale's Figma "Code Syntax" field was fixed for `accent-100`/`accent-200` but still reads `brand-300`…`brand-900` for the rest — a partially-applied fix, confirmed directly against the Figma variables doc. Slugging the whole ramp as `accent-100`…`accent-900` (matching the Figma variable *name* consistently across all 9 steps, not just the two that got corrected) avoids baking the remaining half of a known Figma-side bug into the theme.

## Risks / Trade-offs

- **[`Card` radius slug (`250`) may change at PR review]** → Mitigation: it's an insertion between existing slugs (`200`/`300`), not a renumbering, so if the designer requests a different slug during PR review it's a one-line change with no knock-on effect on the other radius steps.
- **[Removing legacy placeholder palette slugs (`base-2`, `accent-2`, `contrast-2`) is a breaking change]** → Mitigation: confirmed no templates, patterns, or styles in this repo currently reference them (the theme has no content built yet).
- **[Self-hosted Libre Baskerville / Source Sans 3 font files may not be sourced yet]** → Mitigation: tracked as an explicit task; if files aren't available at implementation time, fall back temporarily to a system-font stack and flag it rather than blocking the whole change.
- **[Static token values diverge from `kwv-theme-2026`'s fluid pattern]** → Mitigation: token *names* and grouping still mirror kwv (`custom.fontWeight`/`.lineHeight`/`.letterSpacing`, numeric `n00` slugs for native preset arrays), so the authoring pattern stays consistent across LightSpeed themes even though the scaling behaviour differs for now.

## Migration Plan

Greenfield replacement — no existing content depends on the current placeholder tokens.
1. Apply the new `settings.color`, `settings.typography`, `settings.spacing`, `settings.border`, `settings.custom`, and `settings.layout` blocks to `theme.json`.
2. Add font files under `assets/fonts/` and register their `@font-face` entries.
3. Run `npm run schema:validate` and `npm run theme:validate` (per this repo's `AGENTS.md`) to confirm the file is still schema-valid and passes theme consistency checks.
4. Rollback, if needed, is a plain `git revert` of the `theme.json`/`assets/fonts/` commit — no data migration involved.
