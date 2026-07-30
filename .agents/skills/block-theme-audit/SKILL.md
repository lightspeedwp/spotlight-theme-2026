# SKILL: Block Theme Audit

**Version:** 1.0.0
**Scope:** WordPress block theme repositories

---

## Purpose

Perform a structured audit of a WordPress block theme repository.
Identify missing files, unreplaced placeholders, escaping issues, accessibility problems, and structural inconsistencies.

---

## Inputs

| Input            | Description                                          |
|------------------|------------------------------------------------------|
| `theme_root`     | The root directory of the WordPress block theme      |
| `report_path`    | Where to save the report (default: `.github/reports/YYYY-MM-DD-theme-audit.md`) |

---

## Steps

### 1. Required File Check

Confirm these files exist:
- `style.css`
- `theme.json`
- `functions.php`
- `templates/index.html`
- `parts/header.html`
- `parts/footer.html`
- `styles/light.json`
- `styles/dark.json`
- `CHANGELOG.md`
- `README.md`
- `AGENTS.md`

### 2. Placeholder Check

Scan all text files for unreplaced placeholder tokens matching `{{[A-Z_]+}}`.
Report the file path and token for each finding.

### 3. theme.json Quality Check

- Confirm `$schema` is present.
- Confirm `version` is 3.
- Confirm colour palette slugs are consistent with style variations.
- Flag deprecated properties.

### 4. Style Variation Check

- Confirm `styles/light.json` and `styles/dark.json` are valid JSON.
- Confirm colour references use slugs defined in `theme.json`.

### 5. PHP Escaping Check

- Scan `functions.php`, `inc/**/*.php`, `patterns/**/*.php`.
- Flag `echo` statements without escaping wrappers.
- Flag translation functions missing the text domain.
- Flag direct superglobal output.

### 6. Accessibility Check

- Check `templates/` and `parts/` for semantic `tagName` usage.
- Check heading hierarchy.
- Note any missing skip links.

### 7. CHANGELOG Check

- Confirm `CHANGELOG.md` follows Keep a Changelog format.
- Flag if there are no entries under `## [Unreleased]`.

---

## Output

A Markdown report saved to the `report_path` with:
- ✅ passing checks
- ⚠️ warnings
- ❌ errors

And a follow-up task list saved to `.github/tasks/YYYY-MM-DD-audit-followup.md` for any actionable findings.

---

## Notes

- This skill is advisory only. It flags likely issues but is not a replacement for human review.
- Do not make destructive changes automatically. Surface findings and let a human decide.
- Run `node theme-utils.mjs validate-theme` and `node theme-utils.mjs security-scan` alongside this skill for tooling-supported checks.
