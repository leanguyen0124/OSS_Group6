#!/usr/bin/env bash
# Shared helpers; source from export-demo.sh or restore-demo.sh.
set -euo pipefail
umask 077
DEMO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd -P)"
cd "$DEMO_ROOT"
for tool in docker node tar; do command -v "$tool" >/dev/null || { echo "Thiếu $tool." >&2; exit 1; }; done
docker info >/dev/null 2>&1 || { echo 'Hãy mở Docker Desktop trước.' >&2; exit 1; }
find_demo_container() {
    local candidate
    DEMO_CLI=''
    while IFS= read -r candidate; do
        if docker inspect "$candidate" | node -e '
            let s="";process.stdin.on("data",x=>s+=x).on("end",()=>{
                const root=process.argv[1];
                const ok=JSON.parse(s)[0].Mounts.some(m=>m.Source===root+"/bado-blog-child");
                process.exit(ok?0:1);
            });' "$DEMO_ROOT"; then DEMO_CLI="$candidate"; break; fi
    done < <(docker ps -q --filter label=com.docker.compose.service=cli)
    [ -n "$DEMO_CLI" ] || { echo 'Không tìm thấy môi trường dự án. Chạy wp-env start tại thư mục này.' >&2; exit 1; }
}
wp_demo() { docker exec "$DEMO_CLI" wp "$@"; }
checksum_demo() {
    node - "$1" "${2:-write}" <<'JS'
const fs=require('fs'),path=require('path'),crypto=require('crypto');
const dir=process.argv[2],mode=process.argv[3];
const hash=f=>crypto.createHash('sha256').update(fs.readFileSync(path.join(dir,f))).digest('hex');
if(mode==='write') {
 const names=fs.readdirSync(dir).filter(f=>fs.statSync(path.join(dir,f)).isFile()&&f!=='checksums.json');
 fs.writeFileSync(path.join(dir,'checksums.json'),JSON.stringify(Object.fromEntries(names.map(f=>[f,hash(f)])),null,2));
} else {
 const sums=JSON.parse(fs.readFileSync(path.join(dir,'checksums.json')));
 for(const f of ['database.sql','uploads.tar.gz','manifest.json'])if(!sums[f])throw Error('Missing checksum: '+f);
 for(const [f,h]of Object.entries(sums)) {
  if(path.basename(f)!==f||hash(f)!==h)throw Error('Checksum mismatch: '+f);
 }
 console.log('Checksum: OK');
}
JS
}
