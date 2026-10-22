#!/usr/bin/env bash
# Restore only into this repository's local wp-env, with a pre-import backup.
source "$(dirname "$0")/demo-common.sh"
if [ "${1:-}" = '--help' ]; then echo 'Usage: bash scripts/restore-demo.sh [snapshot-directory] [--yes]'; exit 0; fi
DEMO_INPUT="$DEMO_ROOT/demo/current"
DEMO_YES=0
for arg in "$@"; do if [ "$arg" = '--yes' ]; then DEMO_YES=1; else DEMO_INPUT="$arg"; fi; done
DEMO_INPUT="$(cd "$DEMO_INPUT" && pwd -P)"
checksum_demo "$DEMO_INPUT" verify
if [ "$DEMO_YES" != 1 ]; then
    echo 'Lệnh này thay database và uploads của wp-env local. Một bản sao lưu sẽ được tạo trước.'
    read -r -p 'Nhập RESTORE để tiếp tục: ' answer
    [ "$answer" = RESTORE ] || exit 1
fi
command -v wp-env >/dev/null || { echo 'Cài wp-env theo README trước.' >&2; exit 1; }
wp-env start
find_demo_container
DEMO_BACKUP="$DEMO_ROOT/demo/backups/before-restore-$(date +%Y%m%d-%H%M%S)-$$"
bash "$DEMO_ROOT/scripts/export-demo.sh" "$DEMO_BACKUP"
DEMO_TEMP="/tmp/oss-demo-restore-$(date +%s)-$$"
trap 'docker exec "$DEMO_CLI" rm -rf "$DEMO_TEMP" >/dev/null 2>&1 || true' EXIT
docker exec "$DEMO_CLI" mkdir -p "$DEMO_TEMP"
for file in database.sql uploads.tar.gz manifest.json; do docker cp "$DEMO_INPUT/$file" "$DEMO_CLI:$DEMO_TEMP/$file" >/dev/null; done
# Reject absolute/parent paths before unpacking a trusted private snapshot.
for archive in "$DEMO_INPUT/uploads.tar.gz" "$DEMO_INPUT/plugins-extra.tar.gz"; do
    [ -f "$archive" ] || continue
    tar -tzf "$archive" | node -e 'let s="";process.stdin.on("data",x=>s+=x).on("end",()=>{for(const p of s.trim().split("\n"))if(p.startsWith("/")||p.split("/").includes(".."))process.exit(1)})'
done
if [ -f "$DEMO_INPUT/plugins-extra.tar.gz" ]; then
    docker cp "$DEMO_INPUT/plugins-extra.tar.gz" "$DEMO_CLI:$DEMO_TEMP/plugins-extra.tar.gz" >/dev/null
    docker exec "$DEMO_CLI" tar -xzf "$DEMO_TEMP/plugins-extra.tar.gz" -C wp-content/plugins
fi
DEMO_OLD_URL="$(node -p 'JSON.parse(require("fs").readFileSync(process.argv[1])).site_url' "$DEMO_INPUT/manifest.json")"
# Read the running local port; never hard-code a container name or a tester's folder.
DEMO_PROJECT="$(docker inspect "$DEMO_CLI" --format '{{index .Config.Labels "com.docker.compose.project"}}')"
DEMO_WORDPRESS="$(docker ps -q --filter "label=com.docker.compose.project=$DEMO_PROJECT" --filter label=com.docker.compose.service=wordpress)"
DEMO_PORT="$(docker inspect "$DEMO_WORDPRESS" --format '{{(index (index .NetworkSettings.Ports "80/tcp") 0).HostPort}}')"
DEMO_URL="http://localhost:$DEMO_PORT"
DEMO_CORE_VERSION="$(node -p 'JSON.parse(require("fs").readFileSync(process.argv[1])).wordpress' "$DEMO_INPUT/manifest.json")"
DEMO_CURRENT_CORE="$(wp_demo core version --skip-plugins --skip-themes)"
if [ "$DEMO_CURRENT_CORE" != "$DEMO_CORE_VERSION" ]; then
    wp_demo core update --version="$DEMO_CORE_VERSION" --force --skip-plugins --skip-themes
fi
wp_demo db import "$DEMO_TEMP/database.sql" --skip-plugins --skip-themes
if [ "$DEMO_OLD_URL" != "$DEMO_URL" ]; then wp_demo search-replace "$DEMO_OLD_URL" "$DEMO_URL" --all-tables-with-prefix --skip-columns=guid --precise --skip-plugins --skip-themes; fi
wp_demo option update home "$DEMO_URL" --skip-plugins --skip-themes
wp_demo option update siteurl "$DEMO_URL" --skip-plugins --skip-themes
# Replace uploads exactly; the previous files are in DEMO_BACKUP.
docker exec "$DEMO_CLI" rm -rf /var/www/html/wp-content/uploads
docker exec "$DEMO_CLI" tar -xzf "$DEMO_TEMP/uploads.tar.gz" -C wp-content
wp_demo cache flush
wp_demo rewrite flush
docker cp "$DEMO_ROOT/scripts/demo-manifest.php" "$DEMO_CLI:$DEMO_TEMP/manifest.php" >/dev/null
wp_demo eval-file "$DEMO_TEMP/manifest.php" "$DEMO_TEMP/actual.json"
docker cp "$DEMO_CLI:$DEMO_TEMP/actual.json" "$DEMO_BACKUP/restored-check.json" >/dev/null
node - "$DEMO_INPUT/manifest.json" "$DEMO_BACKUP/restored-check.json" <<'JS'
const fs=require('fs');const [a,b]=process.argv.slice(2).map(p=>JSON.parse(fs.readFileSync(p)));
for(const k of ['format','wordpress','theme','plugins','counts','users','ledger','activity','likes']) {
 if(JSON.stringify(a[k])!==JSON.stringify(b[k]))throw Error('Verification mismatch: '+k+'; backup retained.');
}
console.log('Kiểm tra OK: '+b.users.length+' tài khoản; '+b.counts.forum.publish+' forum; '+b.counts.topic.publish+' topic; '+b.counts.reply.publish+' trả lời; '+b.ledger.total+' điểm.');
JS
printf '\nMàn chào: %s/\nTrang chủ: %s/home/\nBản sao trước restore: %s\n' "$DEMO_URL" "$DEMO_URL" "$DEMO_BACKUP"
