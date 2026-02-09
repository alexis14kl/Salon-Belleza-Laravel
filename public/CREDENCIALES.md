# Credenciales del Proyecto - Salon de Belleza

> **IMPORTANTE:** Este archivo contiene informacion sensible. No compartir publicamente.

---

## SSH - Servidor Hostinger

| Campo | Valor |
|-------|-------|
| **IP** | 147.93.38.64 |
| **Puerto** | 65002 |
| **Usuario** | u691277401 |
| **Contrasena** | jEX\r2#d!HXL.M!S16 |

### Comando de conexion

```bash
ssh -p 65002 u691277401@147.93.38.64
```

---

## Base de Datos MySQL (MariaDB)

| Campo | Valor |
|-------|-------|
| **Host (interno)** | localhost |
| **Host (externo)** | 193.203.175.217 |
| **Puerto** | 3306 |
| **Base de datos** | u691277401_bdslmaria |
| **Usuario** | u691277401_develop_Yil |
| **Contrasena** | ?5SfR\|t/El |

### Conexion desde el servidor (SSH)

```bash
mysql -h localhost -u u691277401_develop_Yil -p'?5SfR|t/El' u691277401_bdslmaria
```

### Configuracion .env para Laravel

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u691277401_bdslmaria
DB_USERNAME=u691277401_develop_Yil
DB_PASSWORD="?5SfR|t/El"
```

---

## GitHub

| Campo | Valor |
|-------|-------|
| **Usuario** | alexis14kl |
| **Repositorio** | https://github.com/alexis14kl/Salon-Belleza-Laravel |
| **Email** | rapalexism@gmail.com |

---

## Dominio

| Campo | Valor |
|-------|-------|
| **URL** | https://alianzasagroindustriales.com |
| **Hosting** | Hostinger (Shared) |
| **PHP** | 8.2 |
| **MariaDB** | 11.8.3 |
