# Spotlight Theme 2026 — LightSpeed WordPress Block Theme Starter

A lean, production-aware starter repository for building custom WordPress block themes at LightSpeed.

---

## What This Repo Is

This is a **GitHub template repository** for creating WordPress block themes for client and commercial projects.

It provides:
- A working WordPress block theme skeleton
- Validation and linting tooling
- AI guidance files and GitHub Copilot instructions
- Structured folders for prompts, reports, tasks, docs, and AI agents

> **Note:** This starter is not specifically packaged for WordPress.org submission. It is designed for client and commercial block theme development.

---

## Who It Is For

- WordPress theme developers at LightSpeed
- Developers creating custom block themes for clients
- AI agents building or maintaining block themes in this repo

---

## What It Includes

| Area              | Details                                                     |
|-------------------|-------------------------------------------------------------|
| Theme files       | `style.css`, `theme.json`, `functions.php`, `readme.txt`    |
| Templates         | `templates/index.html`                                      |
| Parts             | `parts/header.html`, `parts/footer.html`                    |
| Style variations  | `styles/light.json`, `styles/dark.json`                     |
| Assets            | `assets/fonts/`, `assets/css/`, `assets/js/`, etc.         |
| PHP includes      | `inc/` (empty, ready for use)                               |
| Patterns          | `patterns/` (empty, ready for use)                          |
| Validation        | `theme-utils.mjs`, `package.json`, `composer.json`          |
| AI guidance       | `AGENTS.md`, `CLAUDE.md`, `.github/copilot-instructions.md` |
| Copilot prompts   | `.github/prompts/`                                          |
| Reports           | `.github/reports/`                                          |
| Tasks             | `.github/tasks/`                                            |
| Docs              | `docs/`                                                     |
| Agent assets      | `.agents/skills/`, `.agents/agents/`                        |
| CI workflows      | `.github/workflows/`                                        |

---

## Requirements

- **PHP** 8.1+
- **WordPress** 6.4+
- **Node.js** (see `.nvmrc` for version)
- **Composer** 2.x

---

## Quick Start

```bash
# 1. Clone or use this repo as a template on GitHub

# 2. Replace all placeholder tokens
#    Search for {{ to find all placeholders
grep -r "{{" . --include="*.php" --include="*.json" --include="*.css" --include="*.html" --include="*.md" --include="*.txt" --include="*.mjs" --include="*.yml"

# 3. Install Node dependencies
npm install

# 4. Install Composer dependencies
composer install

# 5. Validate the theme
npm run theme:validate

# 6. Validate JSON schema
npm run schema:validate
```

---

## Repo Map

```
/
├── AGENTS.md                  # AI and developer guidance
├── CLAUDE.md                  # Points to AGENTS.md
├── CHANGELOG.md               # Keep a Changelog / SemVer
├── README.md                  # This file
├── readme.txt                 # Light distribution placeholder
├── style.css                  # Block theme header
├── theme.json                 # Primary theme settings
├── functions.php              # Minimal PHP
├── screenshot.png             # Create manually
├── CODEOWNERS
├── theme-utils.mjs            # Validation and utilities
├── package.json
├── composer.json
├── .editorconfig
├── .gitignore
├── .gitattributes
├── .nvmrc
├── .coderabbit.yml
├── .lintstagedrc.json
├── assets/
│   ├── fonts/
│   ├── icons/
│   ├── logos/
│   ├── images/
│   ├── css/
│   └── js/
├── docs/                      # End-user documentation
├── inc/                       # PHP includes
├── parts/
│   ├── header.html
│   └── footer.html
├── patterns/
├── styles/
│   ├── blocks/
│   ├── sections/
│   ├── light.json
│   └── dark.json
├── templates/
│   └── index.html
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

## Available Commands

### Node

| Command                   | Description                                  |
|---------------------------|----------------------------------------------|
| `npm run schema:validate` | Validate theme.json and styles JSON schemas  |
| `npm run theme:validate`  | Validate theme consistency                   |
| `npm run patterns:escape` | Check PHP patterns for escaping issues       |
| `npm run security:scan`   | Scan PHP files for security issues           |
| `npm run lint`            | Run all linting                              |
| `npm run lint:json`       | Lint JSON files                              |

### Composer

| Command                   | Description                                  |
|---------------------------|----------------------------------------------|
| `composer run phpcs`      | PHP code sniffer                             |
| `composer run phpcbf`     | Fix auto-fixable PHP issues                  |
| `composer run lint:php`   | Lint PHP syntax                              |

---

## How to Customise Placeholders

Search for `{{` across the repository and replace all placeholder tokens:

| Placeholder              | Replace with                        |
|--------------------------|-------------------------------------|
| `Spotlight Theme 2026`         | Human-readable theme name           |
| `spotlight-theme-2026`         | Kebab-case slug                     |
| `spotlight-theme-2026`        | Text domain (same as slug)          |
| `https://spotlight.dev`          | Theme URI                           |
| `LightSpeed`        | Author or agency name               |
| `https://lightspeedwp.agency`         | Author or agency URI                |
| `The Spotlight Theme 2026 WordPress block theme - a Full Site Editing theme for Spotlight.` | Short theme description              |
| `spotlight-theme-2026`          | GitHub repository name              |
| `lightspeedwp`         | GitHub organisation name            |

---

## What to Edit First

1. `style.css` — replace all header placeholders
2. `theme.json` — set your colour palette and typography
3. `functions.php` — add any theme supports you need
4. `parts/header.html` — build your header
5. `parts/footer.html` — build your footer
6. `templates/index.html` — build your main template
7. `CHANGELOG.md` — start tracking your changes
8. `CODEOWNERS` — set your team as owners

---

## AI Prompts, Reports, Tasks, Docs, Skills, and Agents

| What                   | Where                        |
|------------------------|------------------------------|
| Copilot prompts        | `.github/prompts/`           |
| Developer reports      | `.github/reports/`           |
| Task lists             | `.github/tasks/`             |
| End-user documentation | `docs/`                      |
| Portable AI skills     | `.agents/skills/`            |
| Agent personas         | `.agents/agents/`            |

See `AGENTS.md` for full guidance on AI workflow conventions.

---

## License

See [LICENSE](./LICENSE).
