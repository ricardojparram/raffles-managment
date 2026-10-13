#!/usr/bin/env bash
#
# Runs one of the browser checks against a throwaway copy of the app.
#
#   tests/Browser/run.sh behaviour        pass/fail checks on a phone and a desktop
#   tests/Browser/run.sh screens          screenshots of every state (SCHEME=dark for dark)
#   tests/Browser/run.sh admin            smoke test of the admin pieces
#
# It needs Docker and the built assets (npm run build). Nothing here touches
# database/database.sqlite: the checks use their own database/qa.sqlite.
#
# The server runs several workers on purpose. With a single worker requests
# are answered in order and races between them never show up.

set -euo pipefail

script="${1:-behaviour}"
root="$(cd "$(dirname "$0")/../.." && pwd)"
port="${QA_PORT:-8001}"
out="${OUT_DIR:-$root/storage/app/private/browser-checks}"
php_image="${PHP_IMAGE:-raffles-dev:8.4}"
browser_image="raffles-browser:latest"
server="raffles-qa-$port"

docker image inspect "$php_image" >/dev/null 2>&1 || {
    echo "PHP image $php_image not found. Build it first, see docs/TRASPASO.md." >&2
    exit 1
}

docker image inspect "$browser_image" >/dev/null 2>&1 || docker build -t "$browser_image" "$root/tests/Browser"

mkdir -p "$out"
touch "$root/database/qa.sqlite"

app() {
    docker run --rm --security-opt label=disable -u "$(id -u):$(id -g)" \
        -e HOME=/tmp -e DB_DATABASE=/app/database/qa.sqlite -e APP_URL="http://localhost:$port" \
        -v "$root":/app -w /app "$php_image" "$@"
}

app php artisan migrate:fresh --seed --force --no-interaction >/dev/null
app php artisan db:seed --class=DemoSeeder --force --no-interaction >/dev/null

docker rm -f "$server" >/dev/null 2>&1 || true
docker run -d --name "$server" --security-opt label=disable -u "$(id -u):$(id -g)" \
    -p "127.0.0.1:$port:8000" \
    -e HOME=/tmp -e DB_DATABASE=/app/database/qa.sqlite -e APP_URL="http://localhost:$port" \
    -e PHP_CLI_SERVER_WORKERS=4 \
    -v "$root":/app -w /app "$php_image" \
    php artisan serve --host=0.0.0.0 --port=8000 --no-reload >/dev/null

trap 'docker rm -f "$server" >/dev/null 2>&1 || true' EXIT

for _ in $(seq 1 30); do
    curl -fs -o /dev/null "http://localhost:$port/up" && break
    sleep 0.5
done

docker run --rm --network host --security-opt label=disable -u "$(id -u):$(id -g)" \
    -e HOME=/tmp -e BASE_URL="http://localhost:$port" -e OUT_DIR=/out -e SCHEME="${SCHEME:-light}" \
    -v "$root/tests/Browser":/checks:ro -v "$out":/out -w /work "$browser_image" \
    sh -c "cp /checks/*.mjs /work/ && cp -r /checks/fixtures /work/ && node /work/$script.mjs"

echo "Output: $out"
