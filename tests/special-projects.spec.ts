import { expect, test } from '@playwright/test';
import { go, URLS } from './fixtures';

test.describe('Special Projects page (LS-4717)', () => {
	test('LS-4717: /special-projects/ is a page with the category-archive layout', async ({ page }) => {
		const response = await go(page, URLS.specialProjects);
		expect(response?.status()).toBe(200);
		await expect(page.getByRole('heading', { level: 1, name: 'Special Projects' })).toBeVisible();
		await expect(page.locator('.archive-listing-header')).toBeVisible();
	});

	test('LS-4717: filter pills link to the individual project pages', async ({ page }) => {
		await go(page, URLS.specialProjects);
		const pills = page.locator('.topic-filter a');
		await expect(pills.first()).toBeVisible();
		for (const href of await pills.evaluateAll((links) => links.map((a) => a.getAttribute('href')))) {
			expect(href).toContain('/special-projects/');
		}
	});

	test('LS-4717: lists posts that carry a Special Project badge', async ({ page }) => {
		await go(page, URLS.specialProjects);
		const cards = page.locator('.post-listing-query .story-card-editorial');
		await expect(cards.first()).toBeVisible();
		await expect(cards.first().locator('.spotlight-badge')).toBeVisible();
	});

	test('LS-4717: the home "Read more" button in Special Projects points to the new page', async ({ page }) => {
		await go(page, URLS.home);
		const link = page.locator('.front-page__special-projects').getByRole('link', { name: 'Read more' });
		await expect(link).toHaveAttribute('href', URLS.specialProjects);
	});

	test('LS-4717: header menu comes from the theme (In Focus and Special Projects are not links)', async ({ page }) => {
		await go(page, URLS.home);
		const nav = page.locator('header nav').first();
		const inFocus = nav.locator('li', { hasText: 'In Focus' }).first();
		await expect(inFocus.locator(':scope > a[href]')).toHaveCount(0);
		await expect(nav.locator('a[href="/in-focus/covid-19/"]')).toHaveCount(1);
		await expect(nav.locator('a', { hasText: 'Access to Medicines' })).toHaveCount(0);
		const projects = nav.locator('li', { hasText: 'Special Projects' }).first();
		await expect(projects.locator('a[href^="/special-projects/"]')).toHaveCount(9);
	});

	test('LS-4717: the home topic grid no longer lists Access to Medicines', async ({ page }) => {
		await go(page, URLS.home);
		await expect(page.locator('.topic-band__term-name').first()).toBeVisible();
		await expect(page.locator('.topic-band__term-name', { hasText: 'Access to Medicines' })).toHaveCount(0);
	});
});
