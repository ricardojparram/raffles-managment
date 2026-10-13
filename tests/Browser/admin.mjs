/**
 * Smoke test of the admin pieces the public page depends on.
 * Uses the seeded local account (admin@admin.com / admin123).
 */
import { BASE, RAFFLE, open, report } from './lib.mjs';

const { check, finish } = report();
const { browser, page, problems, settle, shot } = await open({ width: 1440, height: 900, mobile: false });

await page.goto(`${BASE}/admin/login`);
await settle();
await page.locator('input[type=email]').fill('admin@admin.com');
await page.locator('input[type=password]').fill('admin123');
await page.locator('button[type=submit]').click();
await page.waitForURL((url) => !url.pathname.endsWith('/login'), { timeout: 15000 });

await page.goto(`${BASE}/admin/rifas-el-chamo/raffles`);
await settle();
await shot('admin-raffles');

const publicLinks = await page.locator('a[href*="/r/rifas-el-chamo"]').evaluateAll((links) => links.map((link) => link.getAttribute('href')));
check('the panel links to the organizer public page', publicLinks.includes(`${BASE}/r/rifas-el-chamo`));

await page.getByRole('button', { name: 'Compartir' }).first().click();
await page.waitForTimeout(300);
check('a raffle row offers its public page', (await page.getByRole('link', { name: 'Página pública', exact: true }).first().getAttribute('href')) === RAFFLE);
check('a raffle row offers to copy its link', (await page.getByRole('button', { name: 'Copiar enlace' }).count()) > 0);
await page.keyboard.press('Escape');

const tableOverflow = await page.evaluate(() => {
    const scroller = [...document.querySelectorAll('*')].find((element) => element.querySelector('table') && getComputedStyle(element).overflowX !== 'visible' && element.scrollWidth > element.clientWidth + 2);

    return scroller ? scroller.scrollWidth - scroller.clientWidth : 0;
});
check('the raffles table fits at 1440px', tableOverflow === 0, `overflow=${tableOverflow}`);

await page.getByRole('link', { name: 'Editar' }).first().click();
await settle();
await page.waitForTimeout(1200);
check('the ticket count is locked once numbers are sold', await page.locator('[id="form.ticket_amount"]').isDisabled());
check('the price is edited in major units', (await page.locator('[id="form.ticket_price"]').inputValue()) === '10.00');
await page.screenshot({ path: `${process.env.OUT_DIR ?? '/out'}/admin-raffle-edit.png`, fullPage: true });

await browser.close();

// Filament draws default avatars through ui-avatars.com, which is outside this app.
finish(problems.filter((problem) => !problem.includes('ui-avatars.com')));
