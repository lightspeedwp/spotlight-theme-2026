---
mode: "ask"
---

# Prepare Release

Prepare a new versioned release of this theme.

## Steps

1. **Determine the new version number** following Semantic Versioning:
   - Patch (`0.1.x`) for bug fixes.
   - Minor (`0.x.0`) for new features that are backwards-compatible.
   - Major (`x.0.0`) for breaking changes.

2. **Update `CHANGELOG.md`**:
   - Move all entries from `## [Unreleased]` to a new versioned section.
   - Set the correct date (ISO 8601 format: YYYY-MM-DD).
   - Leave a new empty `## [Unreleased]` section at the top.
   - Update the compare links at the bottom.

3. **Update `style.css`**:
   - Update the `Version:` field in the theme header.

4. **Update `readme.txt`**:
   - Update the `Stable tag:` field.

5. **Update `package.json`**:
   - Update the `version` field.

6. **Commit the changes**:
   - Use a commit message like: `Release v0.x.x`

7. **Create a Git tag**:
   - Tag format: `v0.x.x`

8. **Review the PR or push**:
   - Confirm the GitHub release is created from the tag.

## Output

Provide a summary of the changes made for the release.
