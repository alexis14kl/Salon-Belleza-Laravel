# Guia de Deploy - Salon de Belleza Laravel

## Datos del Proyecto

| Campo | Valor |
|-------|-------|
| **Dominio** | https://alianzasagroindustriales.com |
| **Repositorio** | https://github.com/alexis14kl/Salon-Belleza-Laravel |
| **Hosting** | Hostinger (Shared) |
| **PHP** | 8.2 |
| **Base de datos** | MariaDB 11.8.3 |

---

## 1. Estructura en el Servidor

```
~/domains/alianzasagroindustriales.com/
├── Mis_Sitios_WEB_Salon_Belleza/
│   └── Mis_Sitios_WEB_Salon_Belleza/   ← Proyecto Laravel
│       ├── app/
│       ├── bootstrap/
│       ├── config/
│       ├── database/
│       ├── public/                      ← Document root
│       ├── resources/
│       ├── routes/
│       ├── storage/
│       ├── vendor/
│       ├── .env
│       └── ...
└── public_html → symlink a .../public/
```

---

## 2. Conexion SSH

```bash
ssh -p 65002 u691277401@147.93.38.64
```

| Campo | Valor |
|-------|-------|
| **IP** | 147.93.38.64 |
| **Puerto** | 65002 |
| **Usuario** | u691277401 |

---

## 3. Conexion a Base de Datos MySQL

### Configuracion en .env (servidor)

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u691277401_bdslmaria
DB_USERNAME=u691277401_develop_Yil
DB_PASSWORD="?5SfR|t/El"
```

| Campo | Valor |
|-------|-------|
| **Motor** | MariaDB 11.8.3 |
| **Host** | localhost (NO usar IP externa desde el servidor) |
| **IP externa** | 193.203.175.217 (solo para conexion remota si esta habilitada) |
| **Puerto** | 3306 |
| **Base de datos** | u691277401_bdslmaria |
| **Usuario** | u691277401_develop_Yil |

### Verificar conexion por SSH

```bash
mysql -h localhost -u u691277401_develop_Yil -p'?5SfR|t/El' u691277401_bdslmaria -e "SHOW TABLES;"
```

### Comandos utiles de Laravel para la DB

```bash
php artisan db:show              # Ver info de la conexion
php artisan migrate:status       # Ver estado de migraciones
php artisan migrate --force      # Ejecutar migraciones pendientes
php artisan migrate:rollback     # Revertir ultima migracion
```

---

## 4. Deploy con Git

### Configuracion de Remotes (local)

```bash
# GitHub (origin) - repositorio principal
git remote add origin https://github.com/alexis14kl/Salon-Belleza-Laravel.git

# Hostinger (hostinger) - deploy directo (backup)
git remote add hostinger ssh://u691277401@147.93.38.64:65002/home/u691277401/repos/salon-belleza.git
```

### Flujo de Deploy Automatico

```
git add . → git commit -m "mensaje" → git push origin main → GitHub Action → Deploy en Hostinger
```

1. Haces cambios en tu codigo local
2. Commit y push a GitHub:
   ```bash
   git add .
   git commit -m "descripcion del cambio"
   git push origin main
   ```
3. El GitHub Action (.github/workflows/deploy.yml) se ejecuta automaticamente
4. Se conecta por SSH a Hostinger y ejecuta:
   - `git pull origin main`
   - `composer install --no-dev --optimize-autoloader`
   - `php artisan migrate --force`
   - `php artisan config:cache`
   - `php artisan route:cache`
   - `php artisan view:cache`

### Deploy Manual (alternativa)

Si el Action falla, puedes hacer deploy directo:

```bash
# Opcion 1: Push directo a Hostinger
git push hostinger main

# Opcion 2: Conectarse por SSH y hacer pull manual
ssh -p 65002 u691277401@147.93.38.64
cd ~/domains/alianzasagroindustriales.com/Mis_Sitios_WEB_Salon_Belleza/Mis_Sitios_WEB_Salon_Belleza
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache
```

---

## 5. GitHub Action (CI/CD)

El archivo `.github/workflows/deploy.yml` contiene el pipeline de deploy.

### Secret configurado en GitHub

| Secret | Descripcion |
|--------|-------------|
| `SSH_PASSWORD` | Contrasena SSH del servidor Hostinger |

Para actualizar el secret: GitHub > Repo > Settings > Secrets and variables > Actions

### Ver estado del deploy

- URL: https://github.com/alexis14kl/Salon-Belleza-Laravel/actions

---

## 6. Comandos Utiles en el Servidor

```bash
# Ruta del proyecto
PROJECT=~/domains/alianzasagroindustriales.com/Mis_Sitios_WEB_Salon_Belleza/Mis_Sitios_WEB_Salon_Belleza
cd $PROJECT

# Limpiar todo el cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Recachear todo
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Modo mantenimiento
php artisan down              # Activar
php artisan up                # Desactivar

# Logs de errores
tail -50 storage/logs/laravel.log
```

---

## 7. Notas Importantes

- **No usar `DB_HOST=193.203.175.217`** desde el servidor. Usar siempre `localhost`
- **No ejecutar `GRANT` por SSH** en Hostinger shared. Los permisos de DB se gestionan desde el panel hPanel
- **Regenerar tokens** de GitHub si fueron compartidos en algun chat
- **El .env NO se sube a Git** (esta en .gitignore). Si se cambia algo en el .env, debe hacerse manualmente en el servidor
- **Permisos**: Las carpetas `storage/` y `bootstrap/cache/` deben tener permisos 775
