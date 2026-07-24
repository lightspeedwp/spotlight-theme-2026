# .github/tasks/

This folder is for **task lists and AI-maintained work tracking** for this repository.

---

## Task File Naming Conventions

Use descriptive filenames:

```
YYYY-MM-DD-description.md
```

Examples:
- `2024-11-01-setup-tasks.md`
- `2024-11-15-audit-followup.md`

---

## When to Create Task Lists

- After an audit or review when there are follow-up items.
- When starting a new feature or sprint.
- When an AI agent generates a report with actionable findings.

---

## How Tasks Relate to Reports

- Reports in `.github/reports/` may generate task lists here.
- Reference the source report in the task file header.
- Keep tasks actionable — each task should be a concrete step.

---

## How Agents Should Update task-list.md

Agents should:
- Add new tasks under the appropriate heading in `task-list.md`.
- Mark tasks as complete with `[x]` when done.
- Add context notes under tasks where helpful.
- Not delete completed tasks — they serve as history.

---

## Task Status Markers

```markdown
- [ ] Pending task
- [x] Completed task
- [~] In progress
```
