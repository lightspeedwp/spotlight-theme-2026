# AGENTS.md

This file provides guidance for AI agents working in this repository.
Human developers should also read this file before contributing.

---

## Repo Purpose

This is a **LightSpeed WordPress block theme starter repository**.
It is designed to be used as a GitHub template for building custom WordPress block themes for client and commercial work.

It is **not** specifically packaged for WordPress.org submission.
Do not add WordPress.org-specific bureaucracy unless there is clear value.

---

## Repo Structure

```
/
├── AGENTS.md                  # This file — AI and developer guidance
├── CLAUDE.md                  # Points to AGENTS.md
├── CHANGELOG.md               # Keep a Changelog / SemVer
├── README.md                  # Root developer README
├── readme.txt                 # Light distribution placeholder
├── style.css                  # Block theme header + minimal CSS
├── theme.json                 # Primary theme settings (theme-first)
├── functions.php              # Minimal PHP
├── screenshot.png             # Create manually
├── CODEOWNERS                 # GitHub code ownership
├── .editorconfig
├── .gitignore
├── .gitattributes
├── .nvmrc
├── .coderabbit.yml
├── .lintstagedrc.json
├── package.json
├── composer.json
├── theme-utils.mjs            # Validation and utility script
├── assets/
│   ├── fonts/                 # Binary font assets (.woff2 etc.)
│   ├── icons/
│   ├── logos/
│   ├── images/
│   ├── css/                   # Compiled or authored CSS
│   └── js/                    # Authored JS
├── docs/                      # End-user documentation
├── inc/                       # Optional PHP include files
├── parts/                     # Block template parts
├── patterns/                  # Block patterns (PHP or HTML)
├── styles/                    # Style variations
│   ├── blocks/
│   ├── sections/
│   ├── light.json
│   └── dark.json
├── templates/                 # Block templates
├── .github/
│   ├── copilot-instructions.md
│   ├── instructions/
│   ├── prompts/
│   ├── reports/
│   ├── tasks/
│   └── workflows/
└── .agents/
    ├── skills/
    └── agents/
```

---

## Theme-First Approach

- Prefer `theme.json` over PHP for colours, typography, spacing, and layout.
- Keep `functions.php` minimal. Only register block supports, enqueue assets, or add editor styles there.
- Use `inc/` only for genuine PHP logic that does not belong in `functions.php`.
- Do not invent PHP architecture that `theme.json` can handle.

---

## Slug and Text Domain Consistency

Replace all placeholder tokens before using this starter:

| Placeholder         | Description                              |
|---------------------|------------------------------------------|
| `Spotlight Theme 2026`    | Human-readable theme name                |
| `spotlight-theme-2026`    | Kebab-case slug (used in folder names)   |
| `spotlight-theme-2026`   | Text domain (must match slug)            |
| `https://spotlight.dev`     | Theme URI                                |
| `LightSpeed`   | Author or agency name                    |
| `https://lightspeedwp.agency`    | Author or agency URI                     |
| `The Spotlight Theme 2026 WordPress block theme - a Full Site Editing theme for Spotlight.` | Short theme description              |
| `spotlight-theme-2026`     | GitHub repository name                   |
| `lightspeedwp`    | GitHub organisation name                 |

Rules:
- `spotlight-theme-2026` must match `spotlight-theme-2026` everywhere.
- Keep the slug consistent in `style.css`, `theme.json`, `composer.json`, and `package.json`.
- Do not leave placeholder tokens blank — replace them with real values.
- Search the repo for `{{` to find all remaining placeholders.

---

## Accessibility Expectations

- Use semantic HTML in all templates and parts.
- Use correct heading hierarchy. Do not skip heading levels.
- Provide descriptive `alt` text for images.
- Ensure interactive elements are keyboard accessible.
- Follow WCAG 2.1 AA as a baseline.
- Use ARIA attributes only where genuinely needed — do not over-ARIA.
- Do not remove focus styles.

---

## Security Expectations

- **Always escape output** in PHP files. Use `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()` as appropriate.
- **Sanitise input** before using it. Use `sanitize_text_field()`, `absint()`, or similar.
- **Validate data** before acting on it.
- Never use `echo $_GET[...]` or similar unescaped output.
- Never use `eval()`.
- Avoid direct database queries. If necessary, use `$wpdb->prepare()`.
- Review `patterns/*.php`, `inc/**/*.php`, and `functions.php` with special care.
- Use translation functions correctly: `__()`, `esc_html__()`, `esc_attr__()`.

---

## PHP Minimalism

- Keep `functions.php` as short as sensibly possible.
- Use `inc/` for optional, well-named PHP includes.
- Do not add a plugin-like architecture to the theme.
- Do not add features that belong in plugins.
- Prefer hooks and filters from WordPress core over custom implementations.

---

## Where Assets Belong

| Asset type       | Folder            |
|------------------|-------------------|
| Font files       | `assets/fonts/`   |
| SVG/icon files   | `assets/icons/`   |
| Logo files       | `assets/logos/`   |
| Images           | `assets/images/`  |
| CSS              | `assets/css/`     |
| JavaScript       | `assets/js/`      |

- Font files are binary (`*.woff2`, `*.woff`, etc.). They are **not** JSON.
- Do not validate font files as JSON.
- Do not create schema validation that targets `assets/fonts/`.

---

## Style Variation Guidance

- Style variations live in `styles/`.
- Two starter variations are provided: `light.json` and `dark.json`.
- Additional variations can be added as `styles/*.json`.
- `styles/blocks/<block>/<variation-slug>.json` and `styles/sections/<variation-slug>.json` register **block style variations**: a JSON file with `slug`, `title`, `blockTypes`, and `styles` keys (see `styles/blocks/button/*.json`). WordPress core auto-registers these — confirmed working in this theme (LS-1711) — so they appear as selectable options in the block style picker for any block listed in `blockTypes`. No PHP registration is needed.
- Keep each variation file scoped to one block and one look — one file, one responsibility (do not combine multiple unrelated looks in a single file).
- Keep variation files small and focused.

---

## Validation and Linting Commands

Run these before committing:

```bash
# Install Node dependencies
npm install

# Validate JSON schema for theme.json and styles
npm run schema:validate

# Validate theme consistency (slugs, required files, etc.)
npm run theme:validate

# Check PHP patterns for escaping issues
npm run patterns:escape

# Run PHP security scan
npm run security:scan

# Run all linting
npm run lint

# Install Composer dependencies
composer install

# Run PHP code sniffer
composer run phpcs

# Fix auto-fixable PHP issues
composer run phpcbf

# Lint PHP syntax
composer run lint:php
```

---

## Changelog Expectations

- Follow [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).
- Follow [Semantic Versioning](https://semver.org/).
- Update `CHANGELOG.md` on every meaningful change.
- Add new entries under `## [Unreleased]`.
- Move entries to a versioned section on release.

---

## Docs Expectations

- `docs/` is for **end-user documentation** — setup guides, editor guides, client-facing notes.
- Developer reports belong in `.github/reports/`, not in `docs/`.
- Keep `docs/` clean and human-readable.

---

## AI Folder Expectations

| Folder                  | Purpose                                      |
|-------------------------|----------------------------------------------|
| `.github/prompts/`      | Reusable GitHub Copilot prompt files         |
| `.github/reports/`      | Developer and AI-generated reports           |
| `.github/tasks/`        | Task lists and AI-maintained work tracking   |
| `.github/instructions/` | Copilot instruction files per file type      |
| `.agents/skills/`       | Portable, reusable AI skills                 |
| `.agents/agents/`       | Agent persona definitions                    |

---

## Rules for AI Agents

1. **Prefer small diffs.** Make minimal, targeted changes. Do not rewrite files that do not need rewriting.
2. **Avoid unnecessary dependencies.** Do not add npm or Composer packages without justification.
3. **Avoid inventing a build pipeline.** This repo does not use Webpack, Vite, or similar unless explicitly added later.
4. **Keep the theme lean.** Do not add features beyond the scope of a block theme.
5. **Escape output correctly.** Every PHP `echo` must use an appropriate escaping function.
6. **Sanitise and validate input.** Do not trust data from `$_GET`, `$_POST`, or similar.
7. **Review pattern PHP carefully.** Patterns with PHP output are a common source of escaping issues.
8. **Keep reports in `.github/reports/`.** Do not write developer reports to the root or to `docs/`.
9. **Keep task lists in `.github/tasks/`.** Update `task-list.md` as tasks are created, in-progress, or completed.
10. **Keep prompt files in `.github/prompts/`.** Do not scatter prompt files across the repo.
11. **Keep portable skills in `.agents/skills/`.** Skills should be self-contained and reusable.
12. **Keep agent personas in `.agents/agents/`.** Agent persona files describe specialist roles.
13. **Do not modify `.github/workflows/` without understanding CI impacts.**
14. **Always update `CHANGELOG.md`** when making meaningful changes.
15. **Replace all placeholder tokens** before considering setup complete.
16. **Use placeholder tokens** (`spotlight-theme-2026` etc.) rather than leaving metadata blank.
