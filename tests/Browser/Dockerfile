# Headless Chromium for the checks in this folder. Roboto stands in for the
# Android system font so screenshots match what most buyers see.
FROM node:24-bookworm-slim

ENV PLAYWRIGHT_BROWSERS_PATH=/ms-playwright

RUN mkdir -p /work && cd /work && npm init -y >/dev/null \
    && npm install playwright@1.56 >/dev/null 2>&1 \
    && npx playwright install --with-deps chromium \
    && apt-get update && apt-get install -y --no-install-recommends fonts-roboto fontconfig \
    && rm -rf /var/lib/apt/lists/* \
    && printf '<?xml version="1.0"?>\n<!DOCTYPE fontconfig SYSTEM "fonts.dtd">\n<fontconfig>\n<alias binding="strong"><family>system-ui</family><prefer><family>Roboto</family></prefer></alias>\n<alias binding="strong"><family>ui-sans-serif</family><prefer><family>Roboto</family></prefer></alias>\n<alias binding="strong"><family>sans-serif</family><prefer><family>Roboto</family></prefer></alias>\n</fontconfig>\n' > /etc/fonts/local.conf \
    && fc-cache -f && chmod -R 777 /ms-playwright /work

WORKDIR /work
