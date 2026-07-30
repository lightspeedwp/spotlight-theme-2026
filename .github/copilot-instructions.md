# GitHub Copilot Instructions

This file provides GitHub Copilot with context and guidance for this repository.

For full AI and developer guidance, read [`AGENTS.md`](../AGENTS.md) at the root of this repository.

---

## Repo Overview

This is a **LightSpeed WordPress block theme starter repository**.
One theme, one repo. Not a monorepo.

The theme uses the WordPress Full Site Editing (FSE) / block theme approach:
- `theme.json` is the primary source of truth for design tokens.
- Templates live in `templates/`.
- Template parts live in `parts/`.
- Style variations live in `styles/`.
- Block patterns live in `patterns/`.
- PHP logic lives in `functions.php` and optionally `inc/`.

---

## Key Principles

- **theme.json first** — prefer `theme.json` for colours, typography, spacing, and layout over PHP or CSS.
- **Minimal PHP** — `functions.php` should stay small. Use `inc/` only for necessary PHP logic.
- **No unnecessary dependencies** — do not add npm or Composer packages without justification.
- **No build pipeline** — this repo does not use Webpack, Vite, or similar unless deliberately added.
- **Security** — escape all PHP output. Sanitise all input. See `AGENTS.md` for details.
- **Accessibility** — use semantic HTML, correct heading hierarchy, ARIA where needed.
- **Consistency** — keep text domain, slug, and placeholder tokens consistent across all files.

---

## File Structure Summary

| Path                          | Purpose                                           |
|-------------------------------|---------------------------------------------------|
| `style.css`                   | Block theme header                                |
| `theme.json`                  | Design tokens and settings                        |
| `functions.php`               | Minimal PHP setup                                 |
| `templates/`                  | Block templates (HTML)                            |
| `parts/`                      | Block template parts (HTML)                       |
| `patterns/`                   | Block patterns (PHP or HTML)                      |
| `styles/`                     | Style variations (JSON)                           |
| `assets/`                     | CSS, JS, fonts, icons, logos, images              |
| `inc/`                        | Optional PHP includes                             |
| `docs/`                       | End-user documentation                            |
| `.github/instructions/`       | These instruction files                           |
| `.github/prompts/`            | Reusable prompt files                             |
| `.github/reports/`            | Developer and AI reports                          |
| `.github/tasks/`              | Task lists                                        |
| `.agents/skills/`             | Portable AI skills                                |
| `.agents/agents/`             | Agent persona definitions                         |

---

## Instruction Files

When working on specific file types, also consult these instruction files:

- PHP: `.github/instructions/php.instructions.md`
- Patterns: `.github/instructions/patterns.instructions.md`
- Templates: `.github/instructions/templates.instructions.md`
- theme.json: `.github/instructions/theme-json.instructions.md`
- Workflows: `.github/instructions/workflows.instructions.md`

---

## Available Commands

```bash
npm run schema:validate   # Validate JSON schemas
npm run theme:validate    # Validate theme consistency
npm run patterns:escape   # Check PHP patterns for escaping issues
npm run security:scan     # Scan PHP for security issues
npm run lint              # Run all linting
composer run phpcs        # PHP code sniffer
composer run phpcbf       # Fix PHP issues automatically
composer run lint:php     # Lint PHP syntax
```

---

## Where Things Belong

| What                    | Where                        |
|-------------------------|------------------------------|
| AI prompts              | `.github/prompts/`           |
| Developer reports       | `.github/reports/`           |
| Task lists              | `.github/tasks/`             |
| End-user documentation  | `docs/`                      |
| Portable AI skills      | `.agents/skills/`            |
| Agent personas          | `.agents/agents/`            |

---

## Placeholder Tokens

Use explicit placeholder markers (for example `&#123;&#123;THEME_NAME&#125;&#125;`, `&#123;&#123;THEME_SLUG&#125;&#125;`) for unreplaced starter values.
Do not treat configured project values (for example `Spotlight Theme 2026` and `spotlight-theme-2026`) as placeholders.

Search for unreplaced placeholders:
```bash
grep -r "{{" . --include="*.php" --include="*.json" --include="*.css" --include="*.html" --include="*.md" --include="*.txt" --include="*.mjs"
```
