# BlogPlatform - Plataforma Multi-Inquilino de Blogs

Plataforma de blogs personales estilo Blogspot construida con Laravel 11 y stancl/tenancy. Cada blogger obtiene su propio subdominio con diseño personalizable.

## Requisitos

- PHP 8.3+
- MySQL 8+
- Composer

## Instalación

**1. Clona el repositorio:**
```bash
git clone https://github.com/tzerk-last/blogplatform.git
cd blogplatform
```

**2. Instala dependencias:**
```bash
composer install --no-security-blocking
```

**3. Copia el archivo de entorno:**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Configura `.env` con tu base de datos:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogplatform
DB_USERNAME=root
DB_PASSWORD=tu_password
```

**5. Crea la base de datos en MySQL:**
```bash
mysql -u root -p
CREATE DATABASE blogplatform;
exit;
```

**6. Corre las migraciones:**
```bash
php artisan migrate
```

**7. Crea el link de storage:**
```bash
php artisan storage:link
```

**8. Agrega los dominios a `/etc/hosts`:**
```
127.0.0.1   blogplatform.test
127.0.0.1   tusubdominio.blogplatform.test
```

## Uso

Inicia el servidor:
```bash
php -S 0.0.0.0:8080 -t public
```

### URLs

| Acción | URL |
|--------|-----|
| Registro de nuevo blog | `http://blogplatform.test:8080/register` |
| Login | `http://blogplatform.test:8080/login` |
| Panel de admin | `http://blogplatform.test:8080/admin` |
| Blog público | `http://tusubdominio.blogplatform.test:8080` |
| Dashboard del blogger | `http://tusubdominio.blogplatform.test:8080/dashboard` |
| Crear post | `http://tusubdominio.blogplatform.test:8080/dashboard/posts/create` |
| Configuración del blog | `http://tusubdominio.blogplatform.test:8080/dashboard/settings` |

### Flujo de uso

1. Ve a `http://blogplatform.test:8080/register`
2. Regístrate con tu nombre, email, contraseña, nombre del blog y subdominio
3. Agrega tu subdominio a `/etc/hosts`: `127.0.0.1 tusubdominio.blogplatform.test`
4. Accede a tu blog en `http://tusubdominio.blogplatform.test:8080`
5. Gestiona tus posts desde el dashboard
6. Personaliza colores, fuente y avatar en `/dashboard/settings`

## Arquitectura

- **Multi-tenancy**: stancl/tenancy en modo single database
- **Identificación**: por dominio completo (`InitializeTenancyByDomain`)
- **Aislamiento**: trait `BelongsToTenant` en modelos Post y Category
- **CSS dinámico**: variables CSS inyectadas desde la BD en cada blog público
- **Dominio central**: `blogplatform.test` (registro, login, admin)
- **Dominios tenant**: `*.blogplatform.test` (blog público y dashboard)

## Estructura del proyecto

```
app/
├── Http/Controllers/
│   ├── Admin/AdminController.php
│   ├── Tenant/
│   │   ├── PublicBlogController.php
│   │   ├── PostController.php
│   │   └── BlogSettingsController.php
│   └── RegisterBlogController.php
├── Models/
│   ├── Tenant.php
│   ├── Post.php
│   ├── Category.php
│   └── User.php
└── Providers/
    └── TenancyServiceProvider.php
routes/
├── web.php      # Rutas centrales
└── tenant.php   # Rutas de cada blog
```