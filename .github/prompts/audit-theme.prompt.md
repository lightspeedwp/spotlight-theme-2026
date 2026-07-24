---
mode: "ask"
---

# Audit Theme

Perform a comprehensive audit of this WordPress block theme.

Check the following and provide a structured report:

## 1. Required Files
Confirm these files exist and are valid:
- `style.css` with a correct theme header
- `theme.json` with a valid `$schema`
- `functions.php`
- `templates/index.html`
- `parts/header.html`
- `parts/footer.html`
- `styles/light.json`
- `styles/dark.json`

## 2. Placeholder Tokens
Check for unreplaced placeholder markers (for example `&#123;&#123;THEME_NAME&#125;&#125;`, `&#123;&#123;THEME_SLUG&#125;&#125;`) in all text files.
Do not flag configured project values like `Spotlight Theme 2026`, `spotlight-theme-2026`, or the canonical text domain.

## 3. theme.json Quality
- Confirm the schema version is correct.
- Confirm colour slugs are consistent between `theme.json` and style variations.
- Flag any deprecated settings.
- Flag any unnecessary complexity.

## 4. PHP Security
- Review `functions.php`, `inc/**/*.php`, and `patterns/**/*.php`.
- Flag any unescaped output.
- Flag any unsanitised input.
- Flag any direct superglobal usage.

## 5. Accessibility
- Check heading hierarchy in templates and parts.
- Check for semantic HTML tags.
- Check for skip link in header.

## 6. Style Variations
- Confirm `styles/light.json` and `styles/dark.json` are valid JSON.
- Confirm colour references exist in `theme.json`.

## 7. Changelog
- Confirm `CHANGELOG.md` is up to date with recent changes.

## Output Format
Provide the report as a structured Markdown list with:
- ✅ for passing checks
- ⚠️ for warnings
- ❌ for errors

Save the report to `.github/reports/<current-iso-date>-theme-audit.md` using today's date in `YYYY-MM-DD` format.
