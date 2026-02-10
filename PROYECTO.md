# Salon de Belleza - Backend (Laravel)

## Stack Tecnologico
- **Framework:** Laravel 11+ (PHP 8.2)
- **Base de Datos:** MariaDB 11.8.3
- **Autenticacion:** Laravel Sanctum (tokens)
- **Servidor:** Hostinger Shared Hosting

## Dominio y Servidor
- **URL Produccion:** https://alianzasagroindustriales.com
- **IP Servidor:** 147.93.38.64
- **Puerto SSH:** 65002
- **Usuario SSH:** u691277401
- **Ruta Proyecto en Servidor:** `/home/u691277401/domains/alianzasagroindustriales.com/Mis_Sitios_WEB_Salon_Belleza/Mis_Sitios_WEB_Salon_Belleza`
- **Symlink:** `public_html` apunta a la carpeta `public/` del proyecto

## Base de Datos
- **Host:** localhost
- **Nombre:** u691277401_bdslmaria
- **Usuario:** u691277401_develop_Yil
- **Motor:** MariaDB 11.8.3

## Repositorio Git
- **GitHub:** https://github.com/alexis14kl/Salon-Belleza-Laravel
- **Branch principal:** main
- **Usuario Git:** Rapalexism / rapalexism@gmail.com

## CI/CD (GitHub Actions)
El archivo `.github/workflows/deploy.yml` se ejecuta en cada push a `main`:
1. Se conecta al servidor via SSH
2. Hace backup del `.env` del servidor
3. `git pull origin main`
4. Restaura el `.env` del servidor (para no sobrescribirlo)
5. `composer install --no-dev --optimize-autoloader`
6. `php artisan migrate --force`
7. Limpia toda la cache (config, routes, views, cache)
8. Reconstruye la cache (config, routes, views)
9. `chmod -R 775 storage bootstrap/cache`

**Secreto GitHub:** `SSH_PASSWORD` - contraseña SSH del servidor

## Estructura de Rutas

### Rutas Web (`routes/web.php`)
| Metodo | URI | Descripcion |
|--------|-----|-------------|
| GET | `/` | Landing page del salon |
| GET | `/admin/{any?}` | Sirve el SPA de Angular (panel admin) |

### Rutas API (`routes/api.php`)
| Metodo | URI | Auth | Descripcion |
|--------|-----|------|-------------|
| GET | `/api/index` | No | Health check - verifica conexion |
| POST | `/api/auth` | No | Login - retorna token Sanctum |
| POST | `/api/logout` | Si (Sanctum) | Cierra sesion, elimina token |

### Formato de Respuesta API
Todas las respuestas siguen este formato:
```json
{
    "status": true/false,
    "message": "Descripcion del resultado",
    "data": null | { ... }
}
```

### Login (`POST /api/auth`)
**Request:**
```json
{
    "name_email": "usuario o correo",
    "password": "contraseña"
}
```
**Response exitoso:**
```json
{
    "status": true,
    "message": "Login exitoso",
    "data": {
        "user": {
            "id": 1,
            "name": "developElver",
            "email": "developerelver@admin.com",
            "role_id": 1,
            "role": "ADMINISTRADOR"
        },
        "token": "1|abc123..."
    }
}
```

### Logout (`POST /api/logout`)
**Header:** `Authorization: Bearer {token}`

## Arquitectura del Codigo

### Patron Service
- **Controller** (`app/Http/Controllers/Home.php`) → delega al Service
- **Service** (`app/Services/HomeService.php`) → contiene la logica de negocio

### Modelos
- **User** (`app/Models/User.php`) - Usa `HasApiTokens`, relacion `belongsTo(Role)`
- **Role** (`app/Models/Role.php`) - Relacion `hasMany(User)`

### Roles (tabla `roles`)
| ID | Nombre |
|----|--------|
| 1 | ADMINISTRADOR |
| 2 | CLIENTE |
| 3 | PROSPECTO |
| 4 | COLABORADOR |
| 5 | PROVEEDOR |

### Usuarios Admin
| Usuario | Email | Password | Rol |
|---------|-------|----------|-----|
| developElver | developerelver@admin.com | root | ADMINISTRADOR |
| developAlexis | developalexis@admin.com | root | ADMINISTRADOR |

## Frontend Angular
El panel de administracion (Angular) se despliega en `public/admin/`.
- **Repo:** https://github.com/alexis14kl/Salon-Belleza-Angular
- **URL:** https://alianzasagroindustriales.com/admin/
- El CI/CD del repo Angular copia el build directamente a `public/admin/` en este servidor

## Notas Importantes
- El `.env` esta trackeado en git pero el deploy hace backup/restore para no sobrescribir la config del servidor
- Los roles y usuarios admin se crean en la migracion `2026_02_09_000001_create_roles_table.php`, no en seeders
- La landing page esta en `resources/views/welcome.blade.php` (CSS inline, responsive)
- Para las rutas protegidas enviar header: `Authorization: Bearer {token}`
