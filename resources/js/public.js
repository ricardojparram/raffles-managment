/**
 * Behaviour for the public raffle pages. Alpine ships with Livewire, so the
 * components below only register themselves and never boot Alpine on their own.
 */

const PROOF_MAX_SIDE = 1600;
const PROOF_QUALITY = 0.82;
const PROOF_SKIP_BELOW_BYTES = 350_000;

/**
 * Phone cameras produce multi megabyte captures; shrinking them first keeps
 * uploads fast on mobile data and under small server upload limits.
 */
async function shrinkImage(file) {
    if (!file.type.startsWith('image/') || file.type === 'image/gif' || typeof createImageBitmap !== 'function') {
        return file;
    }

    try {
        const bitmap = await createImageBitmap(file);
        const scale = Math.min(1, PROOF_MAX_SIDE / Math.max(bitmap.width, bitmap.height));

        if (scale === 1 && file.size <= PROOF_SKIP_BELOW_BYTES) {
            bitmap.close?.();

            return file;
        }

        const canvas = document.createElement('canvas');
        canvas.width = Math.round(bitmap.width * scale);
        canvas.height = Math.round(bitmap.height * scale);

        const context = canvas.getContext('2d');
        context.fillStyle = '#ffffff';
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.drawImage(bitmap, 0, 0, canvas.width, canvas.height);
        bitmap.close?.();

        const blob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', PROOF_QUALITY));

        if (!blob || blob.size >= file.size) {
            return file;
        }

        return new File([blob], `${file.name.replace(/\.[^.]+$/, '') || 'comprobante'}.jpg`, { type: 'image/jpeg' });
    } catch {
        return file;
    }
}

async function copyText(text) {
    try {
        await navigator.clipboard.writeText(text);

        return true;
    } catch {
        const area = document.createElement('textarea');
        area.value = text;
        area.setAttribute('readonly', '');
        area.style.position = 'fixed';
        area.style.opacity = '0';
        document.body.appendChild(area);
        area.select();

        const copied = document.execCommand('copy');
        area.remove();

        return copied;
    }
}

/**
 * Sheets cover the whole viewport, so the page behind must not scroll and the
 * phone's back button should close the sheet instead of leaving the raffle.
 */
const sheets = {
    open: new Set(),

    lock(name) {
        this.open.add(name);
        document.documentElement.style.overflow = 'hidden';
    },

    unlock(name) {
        this.open.delete(name);

        if (this.open.size === 0) {
            document.documentElement.style.overflow = '';
        }
    },
};

document.addEventListener('alpine:init', () => {
    const Alpine = window.Alpine;

    Alpine.data('ticketPurchase', (config) => ({
        limitReached: false,
        limitTimer: null,
        proofUploading: false,

        init() {
            this.syncSheet(this.$wire.step);
            this.$watch('$wire.step', (step) => this.syncSheet(step));

            this.onPopState = () => {
                if (this.$wire.step === 'pay') {
                    this.$wire.backToNumbers();
                } else if (this.$wire.step === 'done') {
                    this.$wire.finish();
                }
            };

            window.addEventListener('popstate', this.onPopState);
        },

        destroy() {
            window.removeEventListener('popstate', this.onPopState);
            sheets.unlock('checkout');
        },

        get count() {
            return this.$wire.selected.length;
        },

        get total() {
            return config.prices[this.count] ?? config.prices[config.prices.length - 1];
        },

        get missing() {
            return Math.max(0, config.min - this.count);
        },

        get canContinue() {
            return this.count > 0 && this.missing === 0;
        },

        get sortedSelection() {
            return [...this.$wire.selected].sort();
        },

        has(number) {
            return this.$wire.selected.includes(number);
        },

        pick(event) {
            const tile = event.target.closest('button[data-number]');

            if (tile) {
                this.toggle(tile.dataset.number);
            }
        },

        paint(selected) {
            const chosen = new Set(selected);

            this.$refs.board.querySelectorAll('button[data-number]').forEach((tile) => {
                tile.setAttribute('aria-pressed', chosen.has(tile.dataset.number) ? 'true' : 'false');
            });
        },

        async send() {
            await this.$wire.submit();

            this.$nextTick(() => {
                this.$refs.sheet
                    ?.querySelector('[aria-invalid="true"]')
                    ?.scrollIntoView({ block: 'center', behavior: 'smooth' });
            });
        },

        toggle(number) {
            if (this.has(number)) {
                this.remove(number);

                return;
            }

            if (this.count >= config.max) {
                this.flagLimit();

                return;
            }

            this.$wire.selected = [...this.$wire.selected, number];
        },

        remove(number) {
            this.$wire.selected = this.$wire.selected.filter((selected) => selected !== number);
        },

        flagLimit() {
            this.limitReached = true;
            clearTimeout(this.limitTimer);
            this.limitTimer = setTimeout(() => (this.limitReached = false), 2600);
        },

        scrollToBoard() {
            document.getElementById('numeros')?.scrollIntoView({ block: 'start' });
        },

        syncSheet(step) {
            const isOpen = step !== 'pick';
            const hasEntry = window.history.state?.sheet === 'checkout';

            if (isOpen) {
                sheets.lock('checkout');

                if (!hasEntry) {
                    window.history.pushState({ sheet: 'checkout' }, '');
                }

                this.$nextTick(() => {
                    this.$refs.sheet?.scrollTo({ top: 0 });
                    this.$refs.sheet?.focus({ preventScroll: true });
                });

                return;
            }

            sheets.unlock('checkout');

            if (hasEntry) {
                window.history.back();
            }
        },
    }));

    Alpine.data('proofUpload', () => ({
        progress: 0,
        preview: null,
        failed: false,
        notAnImage: false,

        async pick(event) {
            const [file] = event.target.files;
            event.target.value = '';

            if (!file) {
                return;
            }

            this.failed = false;
            this.notAnImage = !file.type.startsWith('image/');

            if (this.notAnImage) {
                return;
            }

            this.proofUploading = true;
            this.progress = 0;

            const image = await shrinkImage(file);

            this.setPreview(URL.createObjectURL(image));

            this.$wire.upload(
                'proof',
                image,
                () => {
                    this.proofUploading = false;
                },
                () => {
                    this.proofUploading = false;
                    this.failed = true;
                    this.setPreview(null);
                },
                (event) => {
                    this.progress = event.detail.progress;
                },
            );
        },

        clear() {
            this.setPreview(null);
            this.failed = false;
            this.notAnImage = false;
            this.$wire.removeProof();
        },

        setPreview(url) {
            if (this.preview) {
                URL.revokeObjectURL(this.preview);
            }

            this.preview = url;
        },
    }));

    Alpine.data('copyable', (text) => ({
        copied: false,

        async copy() {
            if (!(await copyText(text))) {
                return;
            }

            this.copied = true;
            setTimeout(() => (this.copied = false), 1600);
        },
    }));

    Alpine.data('shareLink', (payload) => ({
        copied: false,

        async share() {
            if (navigator.share) {
                try {
                    await navigator.share(payload);
                } catch {
                    // The visitor dismissed the native share sheet.
                }

                return;
            }

            if (await copyText(payload.url)) {
                this.copied = true;
                setTimeout(() => (this.copied = false), 1600);
            }
        },
    }));

    Alpine.data('countdown', (target) => ({
        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',
        finished: false,
        timer: null,

        init() {
            this.tick();
            this.timer = setInterval(() => this.tick(), 1000);
        },

        destroy() {
            clearInterval(this.timer);
        },

        tick() {
            const remaining = Math.max(0, Math.floor((new Date(target).getTime() - Date.now()) / 1000));
            const pad = (value) => String(value).padStart(2, '0');

            this.days = pad(Math.floor(remaining / 86400));
            this.hours = pad(Math.floor((remaining % 86400) / 3600));
            this.minutes = pad(Math.floor((remaining % 3600) / 60));
            this.seconds = pad(remaining % 60);

            if (remaining === 0) {
                this.finished = true;
                clearInterval(this.timer);
            }
        },
    }));

    Alpine.data('expandable', () => ({
        expanded: false,
        overflowing: false,

        init() {
            this.$nextTick(() => {
                this.overflowing = this.$refs.content.scrollHeight > this.$refs.content.clientHeight + 8;
            });
        },
    }));

    Alpine.data('sheet', (name) => ({
        open: false,

        init() {
            this.$watch('open', (open) => {
                if (open) {
                    sheets.lock(name);
                    window.history.pushState({ sheet: name }, '');
                    this.$nextTick(() => this.$refs.focus?.focus({ preventScroll: true }));

                    return;
                }

                sheets.unlock(name);

                if (window.history.state?.sheet === name) {
                    window.history.back();
                }
            });

            this.onPopState = () => {
                this.open = false;
            };

            window.addEventListener('popstate', this.onPopState);
        },

        destroy() {
            window.removeEventListener('popstate', this.onPopState);
            sheets.unlock(name);
        },
    }));
});
