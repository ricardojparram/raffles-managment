/**
 * Things PHPUnit cannot see: what a real phone browser does with the page.
 * Run it after touching Blade, Alpine or wire:model attributes.
 */
import { CAPTURE, RAFFLE, open, report } from './lib.mjs';

const { check, finish } = report();
const { browser, page, problems, settle, shot, step } = await open({ width: 320, height: 640 });
const overflow = () => page.evaluate(() => document.documentElement.scrollWidth - document.documentElement.clientWidth);

await page.goto(RAFFLE);
await settle();
check('page fits a 320px screen', (await overflow()) <= 0, `overflow=${await overflow()}`);
check('display font loaded', await page.evaluate(() => document.fonts.check('800 20px "Big Shoulders Display"')));

await page.locator('#numeros').scrollIntoViewIfNeeded();
const free = page.locator('button[data-number]');
await free.nth(0).tap();
await free.nth(1).tap();
check('a tap selects without waiting for the server', (await free.nth(0).getAttribute('aria-pressed')) === 'true');
await free.nth(1).tap();
check('a second tap unselects', (await free.nth(1).getAttribute('aria-pressed')) === 'false');

await page.getByRole('button', { name: /Continuar/ }).tap();
await page.waitForSelector('#sheet-title');
await settle();
check('checkout opens', (await step()) === 'pay');
check('page behind the sheet cannot scroll', (await page.evaluate(() => document.documentElement.style.overflow)) === 'hidden');
check('sheet fits a 320px screen', (await page.evaluate(() => { const sheet = document.querySelector('[role=dialog]'); return sheet.scrollWidth - sheet.clientWidth; })) <= 0);

await page.goBack();
await settle();
check('phone back button closes the sheet instead of leaving', page.url() === RAFFLE && (await step()) === 'pick', `step=${await step()}`);
check('scrolling is restored', (await page.evaluate(() => document.documentElement.style.overflow)) === '');
check('selection survives going back', (await free.nth(0).getAttribute('aria-pressed')) === 'true');

await page.getByRole('button', { name: /Continuar/ }).tap();
await page.waitForSelector('#sheet-title');
await settle();
await page.locator('label', { hasText: 'Zelle' }).tap();
await page.locator('#buyer-dni').fill('20333444');
await page.locator('#buyer-name').fill('ana');
await page.locator('#buyer-lastname').fill('rojas');
await page.locator('#buyer-phone').fill('04241234567');
const reference = `ZL${Date.now()}`.slice(0, 14);
await page.locator('#payment-reference').fill(reference);
await page.locator('#payment-reference').blur();
await settle();

// Switching to the bank app often makes the phone reload the tab.
await page.reload();
await settle();
check('a reload keeps the buyer in checkout', (await step()) === 'pay');
check(
    'a reload keeps what was typed',
    (await page.locator('#buyer-dni').inputValue()) === '20333444'
        && (await page.locator('#buyer-name').inputValue()) === 'Ana'
        && (await page.locator('#payment-reference').inputValue()) === reference,
    `name=${await page.locator('#buyer-name').inputValue()}`,
);
check('a reload keeps the payment method', (await page.locator('input[type=radio]:checked').count()) === 1 && (await page.getByText('pagos@rifaselchamo.com').isVisible()));

await page.getByRole('button', { name: 'Reportar pago' }).tap();
await settle();
await page.waitForTimeout(700);
const invalid = await page.locator('[role=dialog] [aria-invalid="true"]').first().boundingBox();
check('a failed submit scrolls to the first problem', invalid !== null && invalid.y >= 0 && invalid.y + invalid.height <= 640, JSON.stringify(invalid));

await page.locator('input[type=file]').first().setInputFiles(CAPTURE);
await page.getByText('Comprobante listo').waitFor();
await settle();
await page.getByRole('button', { name: 'Reportar pago' }).tap();

try {
    await page.getByText('¡Pago reportado!').waitFor({ timeout: 10000 });
} catch {
    await shot('behaviour-stuck');
}

await settle();
check('the purchase completes', (await step()) === 'done');

await page.goBack();
await settle();
check('back from the confirmation returns to a clean board', page.url() === RAFFLE && (await step()) === 'pick' && (await page.locator('button[data-number][aria-pressed="true"]').count()) === 0);

await page.reload();
await settle();
check('a reload after buying starts clean', (await step()) === 'pick');

await page.getByRole('button', { name: 'Consultar', exact: true }).scrollIntoViewIfNeeded();
await page.getByRole('button', { name: 'Consultar', exact: true }).tap();
await page.waitForTimeout(400);
check('the checker opens with its field focused', await page.evaluate(() => document.activeElement?.id === 'checker-dni'));
await page.goBack();
await page.waitForTimeout(400);
check('back closes the checker', page.url() === RAFFLE && !(await page.locator('#checker-dni').isVisible()));

await browser.close();

// Typing faster than the server answers must not lose a field. Livewire 4 sends
// wire:model.live updates in parallel, so a late answer could overwrite a newer one.
const hurried = await open();
await hurried.page.goto(RAFFLE);
await hurried.settle();
await hurried.page.locator('button[data-number]').nth(2).tap();
await hurried.page.getByRole('button', { name: /Continuar/ }).tap();
await hurried.page.waitForSelector('#sheet-title');
await hurried.settle();
await hurried.page.locator('label', { hasText: 'Pago Móvil' }).tap();
await hurried.page.locator('#buyer-dni').fill('V-19.555.666');
await hurried.page.locator('#buyer-name').fill('luis');
await hurried.page.locator('#buyer-lastname').fill('gómez');
await hurried.page.locator('#buyer-phone').fill('0414 5556677');
await hurried.page.locator('#payment-reference').fill(`PM${Date.now()}`.slice(0, 14));
await hurried.page.locator('#payment-reference').blur();
await hurried.page.locator('input[type=file]').first().setInputFiles(CAPTURE);
await hurried.page.getByText('Comprobante listo').waitFor();
await hurried.settle();
const typed = await hurried.page.evaluate(() => ['buyer-dni', 'buyer-name', 'buyer-lastname', 'buyer-phone', 'payment-reference'].map((id) => document.getElementById(id).value));
check('typing fast keeps every field', typed.every((value) => value !== ''), JSON.stringify(typed));
await hurried.page.getByRole('button', { name: 'Reportar pago' }).tap();
const completed = await hurried.page.getByText('¡Pago reportado!').waitFor({ timeout: 10000 }).then(() => true, () => false);
check('a hurried purchase completes on the first try', completed);
await hurried.browser.close();

// A mouse cannot swipe: nothing on the page may depend on horizontal scrolling.
const desktop = await open({ width: 1280, height: 800, mobile: false });
await desktop.page.goto(RAFFLE);
await desktop.settle();
const scrollers = await desktop.page.evaluate(() => [...document.querySelectorAll('main *')]
    .filter((element) => element.scrollWidth > element.clientWidth + 1 && ['auto', 'scroll'].includes(getComputedStyle(element).overflowX))
    .map((element) => element.className.toString().slice(0, 60)));
check('nothing needs sideways scrolling with a mouse', scrollers.length === 0, scrollers.join(' | '));
const prizes = await desktop.page.locator('#prizes-title + ol > li').evaluateAll((items) => items.map((item) => {
    const box = item.getBoundingClientRect();

    return box.left >= 0 && box.right <= window.innerWidth;
}));
check('every prize is fully visible', prizes.length === 3 && prizes.every(Boolean), `prizes=${prizes.length}`);
await desktop.shot('desktop-raffle');
await desktop.browser.close();

finish([...problems, ...hurried.problems, ...desktop.problems]);
