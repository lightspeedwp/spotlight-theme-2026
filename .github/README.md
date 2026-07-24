# .github/

This folder contains GitHub-specific configuration, AI instructions, prompts, reports, tasks, and workflow files for this repository.

---

## Contents

### `copilot-instructions.md`

The primary GitHub Copilot instruction file for this repository.
Copilot reads this automatically when working in this repo.
It references `AGENTS.md` and the instruction files below.

### `instructions/`

Modular Copilot instruction files, scoped by file type or workflow.
These are referenced from `copilot-instructions.md`.

| File                          | Purpose                                      |
|-------------------------------|----------------------------------------------|
| `php.instructions.md`         | PHP coding guidance                          |
| `patterns.instructions.md`    | Block pattern guidance                       |
| `templates.instructions.md`   | Block template guidance                      |
| `theme-json.instructions.md`  | theme.json guidance                          |
| `workflows.instructions.md`   | GitHub Actions workflow guidance             |

### `prompts/`

Reusable GitHub Copilot prompt files for repeatable workflows.
Add new `.prompt.md` files here when you have a workflow worth repeating.

### `reports/`

Developer and AI-generated reports for this repository.
Do not write reports to the root or to `docs/`.
See `reports/README.md` for naming conventions.

### `tasks/`

Task lists and AI-maintained work tracking.
See `tasks/README.md` for conventions.

### `workflows/`

GitHub Actions workflow files.
These run CI, code quality checks, and release automation.
