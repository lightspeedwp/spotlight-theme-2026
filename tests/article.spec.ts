import { expect, test } from '@playwright/test';
import { expectElementScreenshot, go, skipUnlessLocal, URLS } from './fixtures';

const content = '.wp-block-post-content';

test.describe('Article: body typography', () => {
	test('BugHerd #46 / LS-4648: body paragraphs are neutral-900 20px [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.article);
		const paragraphs = page.locator(`${content} > p:not(.has-text-color)`);
		await expect(paragraphs.first()).toBeVisible();
		for (const paragraph of await paragraphs.all()) {
			await expect(paragraph).toHaveCSS('color', 'rgb(24, 24, 24)');
			await expect(paragraph).toHaveCSS('font-size', '20px');
		}
	});

	test('BugHerd #46 / LS-4648: a colour set on a parent block is kept by the paragraphs inside it', async ({ page }) => {
		await go(page, URLS.article);
		const colour = await page.evaluate((selector) => {
			const group = document.createElement('div');
			group.className = 'wp-block-group has-text-color';
			group.style.color = 'rgb(255, 0, 0)';
			group.innerHTML = '<p id="pw-group-paragraph">Paragraph inside a coloured Group</p>';
			document.querySelector(selector)!.appendChild(group);
			return getComputedStyle(group.querySelector('p')!).color;
		}, content);
		expect(colour).toBe('rgb(255, 0, 0)');
	});

	test('BugHerd #46 / LS-4648: content headings stay black', async ({ page }) => {
		await go(page, URLS.article);
		await expect(page.locator(`${content} h2`).first()).toHaveCSS('color', 'rgb(0, 0, 0)');
	});

	test('BugHerd #46 / LS-4648: quotes and list items stay black, paragraph links stay blue', async ({ page }) => {
		await go(page, URLS.articleWithQuotes);
		await expect(page.locator(`${content} blockquote p`).first()).toHaveCSS('color', 'rgb(0, 0, 0)');
		await expect(page.locator(`${content} li`).first()).toHaveCSS('color', 'rgb(0, 0, 0)');
		await expect(page.locator(`${content} p a`).first()).toHaveCSS('color', 'rgb(29, 102, 222)');
	});
});

test.describe('Article: header meta row', () => {
	test('BugHerd #32 / LS-4649: author name is 16px semibold grey', async ({ page }) => {
		await go(page, URLS.article);
		const author = page.locator('.article-header__meta .wp-block-post-author__name').first();
		await expect(author).toBeVisible();
		await expect(author).toHaveCSS('color', 'rgb(80, 80, 80)');
		await expect(author).toHaveCSS('font-size', '16px');
		await expect(author).toHaveCSS('font-weight', '600');
	});

	test('BugHerd #32 / LS-4649: date is 16px semibold grey [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.article);
		const date = page.locator('.article-header__meta .wp-block-post-date').first();
		await expect(date).toBeVisible();
		await expect(date).toHaveCSS('color', 'rgb(112, 112, 112)');
		await expect(date).toHaveCSS('font-size', '16px');
		await expect(date).toHaveCSS('font-weight', '600');
	});

	test('BugHerd #32 / LS-4649: article type shows "News & Features" in brand red [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.article);
		const tag = page.locator('.article-header__section-tag');
		await expect(tag).toHaveText('News & Features');
		await expect(tag).toHaveCSS('color', 'rgb(217, 33, 49)');
		await expect(tag).toHaveCSS('font-size', '12px');
		await expect(tag).toHaveCSS('font-weight', '600');
		await expect(tag).toHaveCSS('letter-spacing', '0.5px');
	});

	test('BugHerd #32 / LS-4649: article type shows "Comment & Analysis" on such an article [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.articleCommentAnalysis);
		await expect(page.locator('.article-header__section-tag')).toHaveText('Comment & Analysis');
	});

	test('BugHerd #32 / LS-4649: no subtitle element or hardcoded HIV tagline [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.article);
		await expect(page.locator('.article-header__meta')).toBeVisible();
		await expect(page.locator('.article-header__subtitle')).toHaveCount(0);
		await expect(page.getByText('most promising new HIV-prevention tool')).toHaveCount(0);
	});

	test('BugHerd #32 / LS-4649: article without a type hides the tag [local-only]', async ({ page }, testInfo) => {
		skipUnlessLocal(testInfo);
		await go(page, URLS.localOnlyNoTypeArticle);
		const tag = page.locator('.article-header__section-tag');
		await expect(tag).toHaveText('');
		await expect(tag).toHaveCSS('display', 'none');
	});

	test('BugHerd #32 / LS-4649: article meta row visual baseline [pending deploy on staging]', async ({ page }) => {
		await go(page, URLS.article);
		await expectElementScreenshot(page, page.locator('.article-header__meta'), 'article-header-meta');
	});
});

test.describe('Article: quote citation', () => {
	test('BugHerd #46 / LS-4648: blockquote cite is 16px semibold grey, upright, Source Sans 3 [local-only]', async ({ page }, testInfo) => {
		skipUnlessLocal(testInfo);
		await go(page, URLS.localOnlyNoTypeArticle);
		const cite = page.locator(`${content} blockquote cite`).first();
		await expect(cite).toBeVisible();
		await expect(cite).toHaveCSS('color', 'rgb(112, 112, 112)');
		await expect(cite).toHaveCSS('font-size', '16px');
		await expect(cite).toHaveCSS('font-weight', '600');
		await expect(cite).toHaveCSS('font-style', 'normal');
		await expect(cite).toHaveCSS('font-family', /Source Sans 3/);
	});
});
