import { expect, test, type Locator, type Page, type TestInfo } from '@playwright/test';

/** Stable URLs and IDs. Extend here, not inside specs. */
export const URLS = {
	home: '/',
	latestNews: '/latest-news/',
	contact: '/contact-us/',
	/** "News & Features", post ID 33263, one <h2>, no blockquotes. */
	article: '/2026/07/01/in-the-spotlight-what-is-in-sas-vaccination-schedule-and-how-does-it-measure-up/',
	/** Post ID 33875: 5 blockquotes, no <cite>, News & Features. Redirects to the permalink. */
	articleWithQuotes: '/?p=33875',
	/** Post ID 33791: article type "Comment & Analysis". */
	articleCommentAnalysis: '/?p=33791',
	/** Local database only: no article type, and a blockquote with a <cite>. */
	localOnlyNoTypeArticle: '/2026/08/11/test/',
} as const;

export const LOCAL_ONLY_REASON =
	'Needs data that only exists in the local database; run with npm run test:e2e:local.';

/** Skip the running test unless it belongs to the `local` project. */
export function skipUnlessLocal(testInfo: TestInfo) {
	test.skip(testInfo.project.name !== 'local', LOCAL_ONLY_REASON);
}

/** Navigate without waiting for `load`: third-party scripts make it slow or never fire. */
export async function go(page: Page, path: string) {
	return page.goto(path, { waitUntil: 'domcontentloaded' });
}

/**
 * Element-level screenshot check. Scrolls into view and waits for the network to
 * settle (best effort: analytics can keep it busy) before comparing to the shared baseline.
 */
export async function expectElementScreenshot(page: Page, target: Locator, name: string) {
	await expect(target).toBeVisible();
	await target.scrollIntoViewIfNeeded();
	await expect(target).toHaveScreenshot(`${name}.png`);
}
