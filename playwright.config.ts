import { defineConfig } from '@playwright/test';

// Two projects, one per environment. Always run them through the npm scripts
// (test:e2e, test:e2e:local): the local script forces a single worker because
// the Local by Flywheel site saturates under parallel page loads.
const STAGING_URL = process.env.BASE_URL || 'https://spotlightnsp.lightspeedwp.dev';
const LOCAL_URL = process.env.LOCAL_URL || 'http://spotlight.local';
const channel = process.env.PW_CHANNEL || undefined;

export default defineConfig({
	testDir: './tests',
	fullyParallel: true,
	retries: 0,
	forbidOnly: !!process.env.CI,
	reporter: process.env.CI ? [['list']] : [['list'], ['html', { open: 'never' }]],
	// Baselines are shared by both projects: the theme files (local) are the
	// source of truth and staging is compared against them. OS suffix is kept.
	snapshotPathTemplate: '{snapshotDir}/{testFileDir}/{testFileName}-snapshots/{arg}{-snapshotSuffix}{ext}',
	expect: {
		timeout: 10_000,
		toHaveScreenshot: {
			animations: 'disabled',
			maxDiffPixelRatio: 0.002,
		},
	},
	use: {
		browserName: 'chromium',
		...(channel ? { channel } : {}),
		viewport: { width: 1440, height: 900 },
		trace: 'retain-on-failure',
		screenshot: 'only-on-failure',
	},
	projects: [
		{
			name: 'staging',
			timeout: 60_000,
			use: { baseURL: STAGING_URL, navigationTimeout: 45_000 },
		},
		{
			name: 'local',
			timeout: 90_000,
			use: { baseURL: LOCAL_URL, navigationTimeout: 60_000 },
		},
	],
});
