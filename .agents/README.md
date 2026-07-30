# .agents/

This folder contains portable AI agent assets for this repository.

It is designed to be usable across different AI tools and agent platforms.

---

## Subfolders

### `.agents/skills/`

Reusable, self-contained AI skills.
A skill is a structured prompt or workflow definition that an AI agent can execute.
Skills should be portable — they should work across tools where possible.

### `.agents/agents/`

Agent persona definitions.
A persona defines a specialist role that an AI agent can adopt when working in this repository.
Personas help ensure consistent behaviour across sessions.

---

## Why Both `.github/` and `.agents/`?

`.github/` is GitHub-specific:
- `copilot-instructions.md` is read by GitHub Copilot automatically.
- `instructions/` are used by Copilot Chat.
- `prompts/` are GitHub Copilot prompt files.
- `workflows/` are GitHub Actions CI/CD.

`.agents/` is portable:
- Skills and agent personas are not tied to GitHub.
- They can be used with Claude, Copilot, Cursor, Continue, or other AI tools.
- They are intended to be self-contained and reusable.

---

## Rules

- Keep skills focused and self-contained.
- Keep agent personas realistic and useful.
- Do not store reports, task lists, or prompts here — see `.github/` for those.
