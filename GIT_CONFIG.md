# Configuracion Git y GitHub API

## Credenciales Git
- **Usuario:** Rapalexism
- **Email:** rapalexism@gmail.com
- **GitHub Token:** `TU_TOKEN_GITHUB`
- **Permisos del token:** Todos (full access)

## Repositorios

| Proyecto | Repositorio | URL |
|----------|------------|-----|
| Backend (Laravel) | Salon-Belleza-Laravel | https://github.com/alexis14kl/Salon-Belleza-Laravel |
| Frontend (Angular) | Salon-Belleza-Angular | https://github.com/alexis14kl/Salon-Belleza-Angular |

## Configuracion inicial de Git en un proyecto

```bash
# Configurar usuario (por repo, sin --global)
git config user.name "Rapalexism"
git config user.email "rapalexism@gmail.com"

# Agregar remote con token embebido para no pedir password
git remote add origin https://TU_TOKEN_GITHUB@github.com/alexis14kl/NOMBRE_REPO.git

# Push inicial
git push -u origin main
```

## Conexion a la API de GitHub via curl

Cuando `gh` CLI no esta disponible, se usa `curl` directamente con la API REST de GitHub.

### Header de autenticacion
```bash
-H "Authorization: token TU_TOKEN_GITHUB"
```

### Crear un repositorio
```bash
curl -s \
  -H "Authorization: token TU_TOKEN_GITHUB" \
  https://api.github.com/user/repos \
  -d '{"name":"NOMBRE_REPO","description":"Descripcion","public":true}'
```

### Ver estado de workflows (GitHub Actions)
```bash
# Ultimo run del workflow - Backend
curl -s \
  -H "Authorization: token TU_TOKEN_GITHUB" \
  "https://api.github.com/repos/alexis14kl/Salon-Belleza-Laravel/actions/runs?per_page=1"

# Ultimo run del workflow - Frontend
curl -s \
  -H "Authorization: token TU_TOKEN_GITHUB" \
  "https://api.github.com/repos/alexis14kl/Salon-Belleza-Angular/actions/runs?per_page=1"
```

### Parsear respuesta con Python
```bash
curl -s \
  -H "Authorization: token TU_TOKEN_GITHUB" \
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
curl -s -X POST \
  -H "Authorization: token TU_TOKEN_GITHUB" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/runs/RUN_ID/rerun"
```

### Ver detalle de jobs de un workflow
```bash
curl -s \
  -H "Authorization: token TU_TOKEN_GITHUB" \
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
curl -s -L \
  -H "Authorization: token TU_TOKEN_GITHUB" \
  -H "Accept: application/vnd.github.v3+json" \
  "https://api.github.com/repos/alexis14kl/REPO/actions/runs/RUN_ID/logs" \
  -o /tmp/logs.zip

# Extraer errores del zip con Python
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

Los secretos se encriptan con la llave publica del repo usando `pynacl`.

### 1. Obtener llave publica del repo
```bash
curl -s \
  -H "Authorization: token TU_TOKEN_GITHUB" \
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
curl -s -X PUT \
  -H "Authorization: token TU_TOKEN_GITHUB" \
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
git push origin main
  → GitHub Actions (.github/workflows/deploy.yml)
    → SSH al servidor
    → git pull + composer install + migrate + cache
```

### Frontend (Angular)
```
git push origin main
  → GitHub Actions (.github/workflows/deploy.yml)
    → npm ci + ng build --base-href /admin/
    → SCP copia dist/ a public/admin/ en el servidor
```

## Servidor SSH
- **Host:** 147.93.38.64
- **Puerto:** 65002
- **Usuario:** u691277401
- **Password:** (guardado en secreto SSH_PASSWORD de ambos repos)

## Notas
- `gh` CLI no esta disponible en el entorno WSL, por eso se usa `curl` con la API REST
- El token va embebido en la URL del remote para evitar prompts de password
- Los workflows se disparan automaticamente en cada push a `main`
- Para passwords con caracteres especiales (como `\`, `!`, `#`), usar `r'...'` en Python para evitar escape
