import fs from 'node:fs';
import { chromium } from 'playwright';

export const BASE = process.env.BASE_URL ?? 'http://localhost:8001';
export const OUT = process.env.OUT_DIR ?? '/out';
export const TEAM = `${BASE}/r/rifas-el-chamo`;
export const RAFFLE = `${TEAM}/toyota-fortuner-2012-combo-playero`;
export const SMALL_RAFFLE = `${TEAM}/iphone-16-pro-max-256gb`;
export const FINISHED_RAFFLE = `${TEAM}/moto-empire-keeway-horse-150`;
export const CAPTURE = new URL('./fixtures/capture.png', import.meta.url).pathname;

fs.mkdirSync(OUT, { recursive: true });

/**
 * Open a page that behaves like a mid-range Android phone and records every
 * console error, uncaught exception, failed request and HTTP error it sees.
 */
export async function open({ width = 390, height = 844, scheme = 'light', mobile = true } = {}) {
    const browser = await chromium.launch();
    const context = await browser.newContext({
        viewport: { width, height },
        deviceScaleFactor: 2,
        isMobile: mobile,
        hasTouch: mobile,
        colorScheme: scheme,
        locale: 'es-VE',
    });
    const page = await context.newPage();
    const problems = [];

    page.on('console', (message) => message.type() === 'error' && problems.push(`console: ${message.text()}`));
    page.on('pageerror', (error) => problems.push(`exception: ${error.stack ?? error}`));
    page.on('requestfailed', (request) => problems.push(`request failed: ${request.url()}`));
    page.on('response', (response) => response.status() >= 400 && problems.push(`HTTP ${response.status()}: ${response.url()}`));

    const settle = async () => {
        await page.waitForLoadState('networkidle');
        await page.waitForTimeout(350);
    };

    const shot = async (name) => {
        // Smooth scrolling is on, so let it finish or the capture comes out shifted.
        await page.waitForTimeout(700);
        await page.screenshot({ path: `${OUT}/${name}.png` });
    };

    /** Capture the whole document by growing the viewport, so fixed bars land where they belong. */
    const whole = async (name) => {
        const full = await page.evaluate(() => document.documentElement.scrollHeight);

        await page.setViewportSize({ width, height: Math.min(full, 9000) });
        await page.evaluate(() => window.scrollTo(0, 0));
        await shot(name);
        await page.setViewportSize({ width, height });
    };

    const tall = async (name, tallHeight = 2600) => {
        await page.setViewportSize({ width, height: tallHeight });
        await shot(name);
        await page.setViewportSize({ width, height });
    };

    const step = () => page.evaluate(() => window.Livewire.all().find((c) => c.name === 'ticket-purchase').$wire.step);

    return { browser, page, problems, settle, shot, whole, tall, step };
}

/** Collect named pass/fail results and exit non-zero when any of them failed. */
export function report() {
    const results = [];

    return {
        check(name, passed, detail = '') {
            results.push({ name, passed, detail });
        },
        finish(problems = []) {
            for (const { name, passed, detail } of results) {
                console.log(`${passed ? 'PASS' : 'FAIL'}  ${name}${detail ? `  (${detail})` : ''}`);
            }

            const unique = [...new Set(problems)];

            if (unique.length) {
                console.log(`\nBROWSER PROBLEMS:\n${unique.join('\n')}`);
            }

            const failed = results.filter((result) => !result.passed).length;

            console.log(`\n${results.length - failed}/${results.length} checks passed, ${unique.length} browser problems`);
            process.exit(failed || unique.length ? 1 : 0);
        },
    };
}
