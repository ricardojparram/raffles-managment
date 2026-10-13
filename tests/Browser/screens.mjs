/**
 * Walks the whole purchase on a phone-sized viewport and saves a screenshot of
 * every state, so a design change can be reviewed without clicking through.
 *
 * SCHEME=dark captures the dark theme. Files land in OUT_DIR as <scheme>-NN-name.png.
 */
import { CAPTURE, FINISHED_RAFFLE, RAFFLE, SMALL_RAFFLE, TEAM, open } from './lib.mjs';

const scheme = process.env.SCHEME ?? 'light';
const { browser, page, problems, settle, shot, whole, tall } = await open({ scheme });
const name = (label) => `${scheme}-${label}`;

await page.goto(TEAM);
await settle();
await whole(name('01-team'));

await page.goto(RAFFLE);
await settle();
await shot(name('02-raffle-top'));
await whole(name('03-raffle-full'));

await page.locator('#numeros').scrollIntoViewIfNeeded();
const free = page.locator('button[data-number]');

for (const index of [0, 3, 5]) {
    await free.nth(index).tap();
}

await page.getByRole('button', { name: /Agregar 2 números al azar/ }).tap();
await settle();
await page.evaluate(() => document.getElementById('numeros').scrollIntoView());
await shot(name('04-board-selected'));
await tall(name('05-board-tall'), 2000);

await page.locator('#number-search').fill('999');
await page.getByRole('button', { name: 'Agregar', exact: true }).tap();
await settle();
await page.locator('#number-search').scrollIntoViewIfNeeded();
await shot(name('06-search-taken'));
await page.locator('#number-search').fill('');

await page.getByRole('button', { name: /Continuar/ }).tap();
await page.waitForSelector('#sheet-title');
await settle();
await shot(name('07-checkout-top'));

await page.getByRole('button', { name: 'Reportar pago' }).tap();
await settle();
await tall(name('08-checkout-errors'));

await page.locator('label', { hasText: 'Pago Móvil' }).tap();
await page.locator('#buyer-dni').fill('V-18.222.333');
await page.locator('#buyer-name').fill('maría josé');
await page.locator('#buyer-lastname').fill('pérez');
await page.locator('#buyer-phone').fill('0412 1234567');
await page.locator('#payment-reference').fill(`00${Date.now()}`.slice(-12));
await page.locator('#payment-reference').blur();
await page.locator('input[type=file]').first().setInputFiles(CAPTURE);
await page.getByText('Comprobante listo').waitFor();
await settle();
await tall(name('09-checkout-filled'));

await page.getByRole('button', { name: 'Reportar pago' }).tap();

try {
    await page.getByText('¡Pago reportado!').waitFor({ timeout: 12000 });
} catch (error) {
    const alerts = await page.locator('[role=alert]').evaluateAll((nodes) => nodes.filter((node) => node.offsetParent !== null).map((node) => node.innerText));

    console.log(`purchase did not complete. Visible errors: ${JSON.stringify(alerts)}`);
    await tall(name('99-stuck'));
    throw error;
}

await settle();
await shot(name('10-done'));

await page.getByRole('button', { name: 'Listo' }).tap();
await settle();
await page.getByRole('button', { name: 'Consultar', exact: true }).scrollIntoViewIfNeeded();
await page.getByRole('button', { name: 'Consultar', exact: true }).tap();
await page.locator('#checker-dni').fill('18222333');
await page.locator('#checker-dni').press('Enter');
await page.getByText('Por confirmar').first().waitFor();
await settle();
await shot(name('11-checker'));

await page.goto(SMALL_RAFFLE);
await settle();
await page.locator('#numeros').scrollIntoViewIfNeeded();
await page.locator('button[data-number]').first().tap();
await shot(name('12-minimum-not-met'));

await page.goto(FINISHED_RAFFLE);
await settle();
await whole(name('13-finished'));

await browser.close();

if (problems.length) {
    console.log(`BROWSER PROBLEMS:\n${[...new Set(problems)].join('\n')}`);
    process.exit(1);
}

console.log(`screens saved for ${scheme}`);
