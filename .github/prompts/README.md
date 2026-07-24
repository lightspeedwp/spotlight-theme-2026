# .github/prompts/

This folder contains reusable GitHub Copilot prompt files for repeatable workflows in this repository.

---

## What Are Prompt Files?

Prompt files are `.prompt.md` files that wrap repeatable Copilot Chat workflows.
They provide a consistent starting point for common tasks.

---

## Using a Prompt

In GitHub Copilot Chat, reference a prompt file with:
```
@workspace #file:.github/prompts/audit-theme.prompt.md
```

Or open the file and use it as the basis for a Copilot Chat session.

---

## Adding a New Prompt

1. Create a new `.prompt.md` file in this folder.
2. Give it a descriptive name (e.g. `new-template.prompt.md`).
3. Add a short description at the top of what the prompt does.
4. Update this README to include the new prompt.

---

## Available Prompts

| File                    | Purpose                                         |
|-------------------------|-------------------------------------------------|
| `audit-theme.prompt.md` | Audit the theme for issues and improvements     |
| `cleanup.prompt.md`     | Clean up and tidy the theme codebase            |
| `new-pattern.prompt.md` | Generate a new block pattern                    |
| `release.prompt.md`     | Prepare a new release                           |
