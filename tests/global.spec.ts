import { expect, test, type Page } from '@playwright/test';
import { go, URLS } from './fixtures';

/** Reports every trace of the WordPress "View Transitions" plugin on the current page. */
async function viewTransitionTraces(page: Page) {
	return page.evaluate(() => {
		const rules: string[] = [];
		for (const sheet of Array.from(document.styleSheets)) {
			try {
				for (const rule of Array.from(sheet.cssRules)) {
					if (rule.cssText.includes('view-transition')) rules.push(rule.cssText.slice(0, 120));
				}
			} catch {
				/* cross-origin stylesheet: rules unreadable, skip */
			}
		}
		const generators = Array.from(document.querySelectorAll('meta[name="generator"]'))
			.map((m) => m.getAttribute('content') ?? '')
			.filter((c) => c.startsWith('view-transitions'));
		return {
			rules,
			scriptPresent: !!document.getElementById('plvt-view-transitions-js-after'),
			generators,
		};
	});
}

test.describe('Global: view transitions removed', () => {
	for (const [label, path] of [
		['latest news', URLS.latestNews],
		['home', URLS.home],
	] as const) {
		test(`BugHerd #38 / LS-4647: ${label} carries no view-transition CSS, script or generator tag`, async ({ page }) => {
			await go(page, path);
			await expect(page.locator('body')).toBeVisible();
			const traces = await viewTransitionTraces(page);
			expect(traces.rules).toEqual([]);
			expect(traces.scriptPresent).toBe(false);
			expect(traces.generators).toEqual([]);
		});
	}

	test('BugHerd #38 / LS-4647: opening an article and going back creates no view transition', async ({ page }) => {
		await go(page, URLS.latestNews);
		const link = page.locator('.wp-block-post-title a').first();
		await expect(link).toBeVisible();
		const listUrl = page.url();

		// pageswap fires on the outgoing document; record whether it carried a transition.
		const record = () =>
			window.addEventListener('pageswap', (e) => {
				sessionStorage.setItem('vt', String(!!(e as PageSwapEvent).viewTransition));
			});
		await page.evaluate(record);

		await Promise.all([
			page.waitForURL((url) => url.href !== listUrl, { waitUntil: 'domcontentloaded' }),
			link.click(),
		]);
		expect(await page.evaluate(() => sessionStorage.getItem('vt'))).toBe('false');

		// Same check for the way back: the article document is now the outgoing one.
		await page.evaluate(() => sessionStorage.removeItem('vt'));
		await page.evaluate(record);
		await page.goBack({ waitUntil: 'domcontentloaded' });
		await expect(page).toHaveURL(listUrl);
		expect(await page.evaluate(() => sessionStorage.getItem('vt'))).toBe('false');
	});
});

test.describe('Global: page body copy', () => {
	test('BugHerd #46 / LS-4648: contact page paragraphs use neutral-900 [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.contact);
		const paragraphs = page.locator('.wp-block-post-content p');
		await expect(paragraphs.first()).toBeVisible();

		const colours = await paragraphs.evaluateAll((els) =>
			els
				.filter((el) => (el.textContent ?? '').trim().length > 20)
				.map((el) => getComputedStyle(el).color),
		);
		expect(colours.length).toBeGreaterThanOrEqual(10);
		expect(colours.filter((c) => c !== 'rgb(24, 24, 24)')).toEqual([]);
	});
});

test.describe('Global: smoke', () => {
	test('Smoke: home answers 200 and is not a Cloudflare challenge', async ({ page }) => {
		const response = await go(page, URLS.home);
		expect(response?.status()).toBe(200);
		await expect(page).toHaveTitle(/Spotlight/);
		await expect(page.locator('body')).not.toContainText('Just a moment');
	});
});

// Minimal typing for the pageswap event (not in every TS lib.dom yet).
interface PageSwapEvent extends Event {
	viewTransition: unknown;
}
