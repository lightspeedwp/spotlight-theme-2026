import { expect, test } from '@playwright/test';
import { expectElementScreenshot, go, URLS } from './fixtures';

const HIV_TEXT =
	'Explore comprehensive estimates of HIV prevalence, treatment access, and prevention programmes across all nine provinces.';
const TB_TEXT =
	'How many people are falling ill with tuberculosis, how many of them are diagnosed, and how many lives are lost? Find out.';
const PROVINCES_TEXT =
	'Stories from all 9 of South Africa’s provinces, covering provincial health governance, the realities in our hospitals and clinics, and the people who keep our health system going. Click on the province of your choice to learn more.';

test.describe('Home: dashboard promo cards', () => {
	test.beforeEach(async ({ page }) => {
		await go(page, URLS.home);
	});

	test('BugHerd #41/#42 / LS-4655: HIV and TB promo cards show the updated copy', async ({ page }) => {
		const cards = page.locator('.dashboard-promo__cards');
		await expect(cards.getByText(HIV_TEXT, { exact: true })).toBeVisible();
		await expect(cards.getByText(TB_TEXT, { exact: true })).toBeVisible();
	});

	test('BugHerd #41/#42 / LS-4655: retired promo copy is gone', async ({ page }) => {
		await expect(page.locator('.dashboard-promo__cards')).toBeVisible();
		await expect(page.getByText('Explore comprehensive data on HIV')).toHaveCount(0);
		await expect(page.getByText('Track Tuberculosis diagnosis rates')).toHaveCount(0);
	});

	test('BugHerd #41/#42 / LS-4655: dashboard promo cards visual baseline', async ({ page }) => {
		await expectElementScreenshot(page, page.locator('.dashboard-promo__cards'), 'home-dashboard-promo-cards');
	});
});

test.describe('Home: provinces section', () => {
	test.beforeEach(async ({ page }) => {
		await go(page, URLS.home);
	});

	test('BugHerd #48/#49 / LS-4655: provinces heading and intro copy', async ({ page }) => {
		const row = page.locator('.provincial-map__row');
		await expect(row.getByRole('heading', { level: 2, name: 'Province by Province' })).toBeVisible();
		await expect(row.getByText(PROVINCES_TEXT, { exact: true })).toBeVisible();
	});

	test('BugHerd #48/#49 / LS-4655: retired provinces copy is gone', async ({ page }) => {
		await expect(page.locator('.provincial-map__row')).toBeVisible();
		await expect(page.getByText('Provincial coverage')).toHaveCount(0);
		await expect(page.getByText('Peer-reviewed research and clinical data')).toHaveCount(0);
	});

	test('BugHerd #48/#49 / LS-4655: "Click on a province" caption is centred below the map', async ({ page }) => {
		const caption = page.locator('p').filter({ hasText: /^Click on a province$/ });
		await expect(caption).toBeVisible();
		await expect(caption).toHaveCSS('text-align', 'center');

		const map = page.locator('.south-africa-province-map').first();
		const mapBox = await map.boundingBox();
		const captionBox = await caption.boundingBox();
		expect(mapBox).not.toBeNull();
		expect(captionBox).not.toBeNull();
		expect(captionBox!.y).toBeGreaterThanOrEqual(mapBox!.y + mapBox!.height - 2);
		const mapCenterX = mapBox!.x + mapBox!.width / 2;
		const captionCenterX = captionBox!.x + captionBox!.width / 2;
		expect(Math.abs(captionCenterX - mapCenterX)).toBeLessThanOrEqual(2);
	});

	test('BugHerd #48/#49 / LS-4655: province map has the nine provinces, each with its own link', async ({ page }) => {
		const links = page.locator('.south-africa-province-map a');
		await expect(links).toHaveCount(9);
		const labels = await links.evaluateAll((anchors) => anchors.map((a) => a.getAttribute('aria-label')).sort());
		expect(labels).toEqual(
			[
				'Eastern Cape',
				'Free State',
				'Gauteng',
				'KwaZulu-Natal',
				'Limpopo',
				'Mpumalanga',
				'North West',
				'Northern Cape',
				'Western Cape',
			].sort()
		);
		// A missing category makes the pattern fall back to "#", so reject it before checking uniqueness.
		const rawHrefs = await links.evaluateAll((anchors) => anchors.map((a) => a.getAttribute('href')));
		for (const href of rawHrefs) {
			expect(href).toBeTruthy();
			expect(href).not.toBe('#');
		}
		const destinations = await links.evaluateAll((anchors) =>
			anchors.map((a) => new URL(a.getAttribute('href') ?? '', document.baseURI).href)
		);
		expect(new Set(destinations).size).toBe(9);
		// Each label must point at its own province, so two swapped slugs do not pass.
		const labelAndPaths = await links.evaluateAll((anchors) =>
			anchors.map((a) => ({
				label: a.getAttribute('aria-label') ?? '',
				path: new URL(a.getAttribute('href') ?? '', document.baseURI).pathname,
			}))
		);
		for (const { label, path } of labelAndPaths) {
			const slug = label.toLowerCase().replace(/\s+/g, '-');
			expect(path).toMatch(new RegExp(`/${slug}/?$`));
		}
	});

	test('BugHerd #48/#49 / LS-4655: province title and copy column visual baseline', async ({ page }) => {
		const column = page.locator('.provincial-map__row .wp-block-column').first();
		await expectElementScreenshot(page, column, 'home-provincial-map-copy-column');
	});
});

test.describe('Home: hero meta', () => {
	test.beforeEach(async ({ page }) => {
		await go(page, URLS.home);
	});

	test('BugHerd #18 / LS-4646: hero author and date are 12px grey', async ({ page }) => {
		const hero = page.locator('.front-page__hero');
		for (const selector of ['.wp-block-post-author-name', '.wp-block-post-date']) {
			const el = hero.locator(selector).first();
			await expect(el).toBeVisible();
			await expect(el).toHaveCSS('color', 'rgb(112, 112, 112)');
			await expect(el).toHaveCSS('font-size', '12px');
		}
	});

	test('BugHerd #18 / LS-4646: hero meta colour equals the list-card meta colour', async ({ page }) => {
		const hero = page.locator('.front-page__hero');
		const card = page.locator('li.wp-block-post:not(:first-child)').first();
		for (const selector of ['.wp-block-post-author-name', '.wp-block-post-date']) {
			const heroEl = hero.locator(selector).first();
			const cardEl = card.locator(selector).first();
			await expect(cardEl).toBeVisible();
			const cardColor = await cardEl.evaluate((el) => getComputedStyle(el).color);
			await expect(heroEl).toHaveCSS('color', cardColor);
		}
	});
});
