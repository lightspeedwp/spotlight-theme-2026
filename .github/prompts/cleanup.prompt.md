---
mode: "ask"
---

# Cleanup Theme

Review the theme codebase for common quality issues and suggest targeted improvements.

## Tasks

1. **Find dead code** — unused PHP functions, commented-out code blocks, orphaned CSS rules.
2. **Find redundant files** — empty files that should not exist, duplicate patterns.
3. **Check placeholder tokens** — identify any placeholder-style tokens not yet replaced.
4. **Check file naming** — ensure PHP, HTML, and JSON files follow consistent naming conventions.
5. **Check text domain** — confirm all translation calls use the correct text domain consistently.
6. **Check escaping** — flag any unescaped PHP output that was missed in previous reviews.
7. **Check theme.json** — remove any unused colour or font size entries.
8. **Check CHANGELOG.md** — confirm recent changes are documented.

## Rules

- Do not make destructive changes without confirmation.
- Flag issues as suggestions, not automatic fixes, unless clearly safe.
- Keep changes minimal and targeted.

## Output

Provide a short summary of issues found and suggest next steps.
Create a task list in `.github/tasks/` if there are items requiring follow-up.
