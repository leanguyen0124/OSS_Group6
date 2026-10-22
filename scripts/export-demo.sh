#!/usr/bin/env bash
# Export a private, complete demo snapshot. Does not change website content.
source "$(dirname "$0")/demo-common.sh"
if [ "${1:-}" = '--help' ]; then echo 'Usage: bash scripts/export-demo.sh [output-directory]'; exit 0; fi
DEMO_OUTPUT="${1:-$DEMO_ROOT/demo/current}"
[ ! -e "$DEMO_OUTPUT" ] || { echo "Thư mục đã tồn tại: $DEMO_OUTPUT. Chọn tên mới để giữ bản cũ." >&2; exit 1; }
find_demo_container
mkdir -p "$(dirname "$DEMO_OUTPUT")"
DEMO_STAGE="$(mktemp -d "$(dirname "$DEMO_OUTPUT")/.export-XXXXXX")"
DEMO_TEMP="/tmp/oss-demo-export-$(date +%s)-$$"
cleanup() { docker exec "$DEMO_CLI" rm -rf "$DEMO_TEMP" >/dev/null 2>&1 || true; [ -z "${DEMO_STAGE:-}" ] || rm -rf "$DEMO_STAGE"; }
trap cleanup EXIT
docker exec "$DEMO_CLI" mkdir -p "$DEMO_TEMP"
docker cp "$DEMO_ROOT/scripts/demo-manifest.php" "$DEMO_CLI:$DEMO_TEMP/manifest.php" >/dev/null
wp_demo eval-file "$DEMO_TEMP/manifest.php" "$DEMO_TEMP/manifest.json"
wp_demo db export "$DEMO_TEMP/database.sql" --add-drop-table --skip-plugins --skip-themes
docker exec "$DEMO_CLI" sh -c 'mkdir -p wp-content/uploads; tar -czf "$1/uploads.tar.gz" -C wp-content uploads' sh "$DEMO_TEMP"
for file in database.sql uploads.tar.gz manifest.json; do docker cp "$DEMO_CLI:$DEMO_TEMP/$file" "$DEMO_STAGE/$file" >/dev/null; done
# Include active plugins installed in Docker but not supplied as repository folders.
node - "$DEMO_STAGE/manifest.json" "$DEMO_ROOT" > "$DEMO_STAGE/extra-plugins.txt" <<'JS'
const fs=require('fs');const m=JSON.parse(fs.readFileSync(process.argv[2]));
const dirs=fs.readdirSync(process.argv[3]).map(s=>s.toLowerCase());
for(const root of new Set(m.plugins.map(p=>p.file.split('/')[0]))) {
 if(!/^[A-Za-z0-9_-]+$/.test(root))throw Error('Unsupported plugin path: '+root);
 if(!dirs.includes(root.toLowerCase()))console.log(root);
}
JS
if [ -s "$DEMO_STAGE/extra-plugins.txt" ]; then
    docker cp "$DEMO_STAGE/extra-plugins.txt" "$DEMO_CLI:$DEMO_TEMP/extra-plugins.txt" >/dev/null
    docker exec "$DEMO_CLI" tar -czf "$DEMO_TEMP/plugins-extra.tar.gz" -C wp-content/plugins -T "$DEMO_TEMP/extra-plugins.txt"
    docker cp "$DEMO_CLI:$DEMO_TEMP/plugins-extra.tar.gz" "$DEMO_STAGE/plugins-extra.tar.gz" >/dev/null
fi
checksum_demo "$DEMO_STAGE"
mv "$DEMO_STAGE" "$DEMO_OUTPUT"
DEMO_STAGE=''
printf '\nĐã xuất: %s\nKhôi phục bằng: bash scripts/restore-demo.sh "%s" --yes\n' "$DEMO_OUTPUT" "$DEMO_OUTPUT"
echo 'Gói có dữ liệu tài khoản/cấu hình riêng tư. Chỉ chia sẻ cùng source cho người kiểm thử.'
