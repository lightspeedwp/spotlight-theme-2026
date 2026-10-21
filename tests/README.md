# End-to-end tests (Playwright)

Anonymous browser checks for the rendered site: copy, computed styles and a few element-level screenshots. Nothing logs in or touches wp-admin. Specs are organised by site area (`home`, `article`, `global`) and every test title carries its BugHerd or Linear reference, so they double as regression tests. Set up under LS-4683.

## Setup

```bash
npm install
npx playwright install chromium   # once per machine (~150 MB, user cache, not the repo)
```

## Run

| Command | What it does |
| --- | --- |
| `npm run test:e2e` | Staging (`https://spotlightnsp.lightspeedwp.dev`), parallel. About 1 minute. |
| `npm run test:e2e:local` | Local (`http://spotlight.local`), one worker. About 4 minutes. |
| `npm run test:e2e:update` | Regenerates the screenshot baselines from the local site. |

Extra arguments go after `--`, for example `npm run test:e2e:local -- -g "BugHerd #46"` or `npm run test:e2e -- tests/home.spec.ts`.

Always use these scripts. The local site saturates under parallel page loads, so running the `local` project with several workers makes pages time out.

| Variable | Purpose |
| --- | --- |
| `BASE_URL` | Another staging URL for the `staging` project. |
| `LOCAL_URL` | Another local URL for the `local` project. |
| `PW_CHANNEL` | Use an installed browser (`chrome`, `msedge`) instead of the bundled Chromium. |

## Reading the results

| Title tag | Meaning |
| --- | --- |
| `[local-only]` | Needs data that only exists in the local database. Skipped on staging. |
| `[pending deploy on staging]` | Depends on code or DB templates not on staging yet. Passes on local and is expected to fail on staging until the PR is promoted and the staging `front-page` / `single` DB templates are reset (LS-4655). It is not marked `test.fail()`, so the first pass after the deploy is visible. |

Untagged tests should pass on both environments.

## Screenshot baselines

Three element-level `toHaveScreenshot()` checks: the dashboard promo cards, the provinces title and copy column, and the article meta row. There are no whole-page or hero screenshots on purpose, because the featured story changes.

- One shared baseline per check, generated from the **local** site, which renders straight from the theme files. Staging is compared against it.
- Baselines are named with the OS suffix (`-win32`) and come from Windows with the bundled Chromium. They will not match on macOS or Linux; regenerate them there with `npm run test:e2e:update`.
- Review the PNGs before committing, and only update against an environment you have checked by eye.

## Adding tests

- Put them in the spec for the area they belong to, and start the title with the reference, for example `BugHerd #46 / LS-4648: ...`.
- Keep URLs and IDs in `fixtures.ts`. Use posts that exist on both environments; mark anything that needs local-only data with `skipUnlessLocal` and `[local-only]`.
- Prefer `toHaveCSS`, `toHaveText` and `getByText` over fragile selectors, and web-first assertions instead of fixed waits.

## Known limits

- Not run in CI. A CI job and Linux baselines are future work.
- The local site is slow (3 to 4 seconds per page) and never reaches the `load` event reliably, so navigation waits for `domcontentloaded`.
- Screenshot checks do not wait for `networkidle` (analytics can keep it busy for 20 s); `toHaveScreenshot` retries until the element is stable.
- Tests that depend on fixed posts (33263, 33875, 33791) break if those posts are deleted or their author, date or type changes.
- `pageswap` (the view-transition check) needs Chromium 124 or newer.
