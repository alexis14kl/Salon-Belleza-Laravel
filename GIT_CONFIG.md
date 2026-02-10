# Configuracion Git y GitHub API

## Credenciales Git
- **Usuario:** Rapalexism
- **Email:** rapalexism@gmail.com
- **Permisos del token:** Todos (full access)

### Token de GitHub
El token esta guardado en `public/.htaccess` (linea 21, en un comentario).
Para obtenerlo:
```bash
grep 'token git' public/.htaccess | awk '{print $NF}'
```
Para usarlo en los comandos:
```bash
TOKEN=$(grep 'token git' public/.htaccess | awk '{print $NF}')
```

## Repositorios

| Proyecto | Repositorio | URL |
|----------|------------|-----|
| Backend (Laravel) | Salon-Belleza-Laravel | https://github.com/alexis14kl/Salon-Belleza-Laravel |
| Frontend (Angular) | Salon-Belleza-Angular | https://github.com/alexis14kl/Salon-Belleza-Angular |

## Configuracion inicial de Git en un proyecto

```bash
# Obtener token del remote del repo actual
TOKEN=$(grep 'token git' public/.htaccess | awk '{print $NF}')

git config user.name "Rapalexism"
git config user.email "rapalexism@gmail.com"
git remote add origin https://${TOKEN}@github.com/alexis14kl/NOMBRE_REPO.git
git push -u origin main
```

## Conexion a la API de GitHub via curl

Cuando `gh` CLI no esta disponible, se usa `curl` con la API REST de GitHub.

### Definir token (ejecutar primero)
```bash
TOKEN=$(grep 'token git' public/.htaccess | awk '{print $NF}')
```

### Crear un repositorio
```bash
curl -s -H "Authorization: token $TOKEN" \
  https://api.github.com/user/repos \
  -d '{"name":"NOMBRE_REPO","description":"Descripcion","public":true}'
```

### Ver estado de workflows (GitHub Actions)
```bash
# Backend
curl -s -H "Authorization: token $TOKEN" \
  "https://api.github.com/repos/alexis14kl/Salon-Belleza-Laravel/actions/runs?per_page=1"

# Frontend
curl -s -H "Authorization: token $TOKEN" \
  "https://api.github.com/repos/alexis14kl/Salon-Belleza-Angular/actions/runs?per_page=1"
```

### Parsear respuesta con Python
```bash
curl -s -H "Authorization: token $TOKEN" \
  "https://api.github.com/repos/alexis14kl/Salon-Belleza-Angular/actions/runs?per_page=1" \
  > /tmp/run.json && python3 -c "
import json
with open('/tmp/run.json') as f:
    d = json.load(f)
r = d['workflow_runs'][0]
print(f'Status: {r[\"status\"]}')
print(f'Conclusion: {r.get(\"conclusion\",\"en progreso\")}')
"
```

### Re-ejecutar un workflow fallido
```bash
curl -s -X POST -H "Authorization: token $TOKEN" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/runs/RUN_ID/rerun"
```

### Ver detalle de jobs de un workflow
```bash
curl -s -H "Authorization: token $TOKEN" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/runs/RUN_ID/jobs" \
  > /tmp/jobs.json && python3 -c "
import json
with open('/tmp/jobs.json') as f:
    d = json.load(f)
for job in d['jobs']:
    for step in job['steps']:
        print(f'[{step.get(\"conclusion\",\"N/A\")}] {step[\"name\"]}')
"
```

### Descargar y analizar logs de un workflow
```bash
curl -s -L -H "Authorization: token $TOKEN" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/runs/RUN_ID/logs" \
  -o /tmp/logs.zip

python3 -c "
import zipfile
with zipfile.ZipFile('/tmp/logs.zip', 'r') as z:
    for name in z.namelist():
        content = z.read(name).decode('utf-8', errors='replace')
        for line in content.split('\n'):
            if 'error' in line.lower() or 'fail' in line.lower():
                print(line.strip())
"
```

## Configurar Secretos de GitHub Actions

### 1. Obtener llave publica del repo
```bash
curl -s -H "Authorization: token $TOKEN" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/secrets/public-key"
```

### 2. Encriptar el secreto con Python
```bash
pip3 install pynacl

python3 << 'PYEOF'
from base64 import b64encode
from nacl import encoding, public

def encrypt(public_key: str, secret_value: str) -> str:
    pk = public.PublicKey(public_key.encode('utf-8'), encoding.Base64Encoder())
    sealed_box = public.SealedBox(pk)
    encrypted = sealed_box.encrypt(secret_value.encode('utf-8'))
    return b64encode(encrypted).decode('utf-8')

key = 'LLAVE_PUBLICA_DEL_PASO_1'
secret = r'VALOR_DEL_SECRETO'
print(encrypt(key, secret))
PYEOF
```

### 3. Crear/actualizar el secreto
```bash
curl -s -X PUT -H "Authorization: token $TOKEN" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/secrets/SSH_PASSWORD" \
  -d '{"encrypted_value":"VALOR_ENCRIPTADO","key_id":"KEY_ID_DEL_PASO_1"}'
```

## Secretos configurados

| Repositorio | Secreto | Descripcion |
|------------|---------|-------------|
| Salon-Belleza-Laravel | SSH_PASSWORD | Password SSH del servidor Hostinger |
| Salon-Belleza-Angular | SSH_PASSWORD | Password SSH del servidor Hostinger |

## Flujo de Deploy

### Backend (Laravel)
```
git push origin main -> GitHub Actions -> SSH al servidor -> git pull + composer install + migrate + cache
```

### Frontend (Angular)
```
git push origin main -> GitHub Actions -> npm ci + ng build -> SCP a public/admin/ en servidor
```

## Servidor SSH
- **Host:** 147.93.38.64
- **Puerto:** 65002
- **Usuario:** u691277401
- **Password:** guardado en secreto SSH_PASSWORD de ambos repos

## Notas
- `gh` CLI no esta disponible en WSL, se usa `curl` con API REST
- El token esta en `public/.htaccess` linea 21 (como comentario en el RewriteRule)
- GitHub Push Protection bloquea tokens en texto plano y en base64 en commits
- Los workflows se disparan automaticamente en cada push a main
- Para passwords con caracteres especiales usar r'...' en Python
