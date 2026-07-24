# .github/reports/

This folder is for **developer and AI-generated reports** for this repository.

Do **not** write developer reports to the root directory or to `docs/`.

---

## What Counts as a Report?

- Theme audit results
- Security scan summaries
- Code quality review outputs
- Accessibility review outputs
- AI-generated analysis documents

End-user documentation belongs in `docs/`, not here.

---

## Filename Conventions

Use date-prefixed filenames in ISO 8601 format:

```
YYYY-MM-DD-description.md
```

Examples:
- `2024-11-01-theme-audit.md`
- `2024-11-15-security-scan.md`
- `2024-12-01-accessibility-review.md`

---

## Optional Monthly Subfolders

For larger projects, you may organise reports into monthly subfolders:

```
reports/
├── 2024-11/
│   ├── 2024-11-01-theme-audit.md
│   └── 2024-11-15-security-scan.md
└── 2024-12/
    └── 2024-12-01-accessibility-review.md
```

---

## Notes

- Reports are committed to the repository for team visibility.
- AI agents should save reports here after completing an audit or scan.
- Use `.github/tasks/` for follow-up task lists derived from report findings.
