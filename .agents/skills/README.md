# .agents/skills/

This folder contains portable, reusable AI skills for this repository.

---

## What Is a Skill?

A skill is a structured, self-contained prompt or workflow that an AI agent can execute.
Skills are designed to be portable — they should work with different AI tools.

---

## Skill Folder Structure

Each skill has its own subfolder:

```text
skills/
├── block-theme-audit/
│   └── SKILL.md
└── wp-block-pattern-gotchas/
    └── SKILL.md
```

`SKILL.md` defines:
- The skill's purpose
- The inputs it expects
- The steps it performs
- The output it produces

---

## Available Skills

| Skill folder                 | Purpose                                                     |
|------------------------------|--------------------------------------------------------------|
| `block-theme-audit/`         | Audit a WordPress block theme                                |
| `wp-block-pattern-gotchas/`  | Known WordPress core pitfalls when writing patterns/templates |

---

## Adding a New Skill

1. Create a new subfolder under `.agents/skills/`.
2. Add a `SKILL.md` file describing the skill.
3. Update this README with the new entry.
