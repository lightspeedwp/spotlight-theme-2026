---
applyTo: ".github/workflows/**/*.yml"
---

# Workflows Instructions

## Purpose

GitHub Actions workflows in `.github/workflows/` handle:
- CI validation on pull requests
- PHP code quality checks
- Release automation

---

## Workflow Files

| File              | Purpose                              |
|-------------------|--------------------------------------|
| `ci.yml`          | Install deps and validate theme      |
| `code-quality.yml`| Run PHP linting and code sniffer     |
| `release.yml`     | Tag releases and create GitHub releases |

---

## Rules

- Do not add unnecessary steps to workflows.
- Keep workflows focused — one concern per workflow where practical.
- Cache `node_modules` and `vendor/` to improve run times.
- Use pinned action versions (e.g. `actions/checkout@v4`).
- Do not store secrets in workflow files — use GitHub Secrets.
- Do not add Docker, Playwright, Storybook, or other heavy tooling unless explicitly justified.

---

## Adding a New Workflow

1. Create a new `.yml` file in `.github/workflows/`.
2. Document its purpose at the top with a `name:` and inline comments.
3. Ensure it targets the correct branches.
4. Test it by opening a pull request.
5. Update `.github/README.md` to describe the new workflow.

---

## Modifying Existing Workflows

- Review the impact on CI before removing or changing steps.
- If a workflow step is slow, consider caching.
- Do not disable security-related checks.
