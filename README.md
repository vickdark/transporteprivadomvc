# Transporte Privado MVC

## Visión General
- Estructura MVC con rutas amigables.
- Router decide qué controlador ejecutar según la URL.
- Cada controlador renderiza su vista dentro del template común.

## Router
- Ubicación: `app/core/Router.php`.
- Registro de rutas: `public/index.php:1`.
- Soporta `GET`/`POST`, parámetros `{id}` y barra final opcional.
- Si no hay coincidencia, responde 404.

Ejemplo de registro:
```php
$router->get('/', [controllerhome::class, 'index']);
$router->get('/usuarios', [controllerusuarios::class, 'index']);
$router->get('/vehiculos', [controllervehiculos::class, 'index']);
$router->get('/viajes', [controllerviajes::class, 'index']);
```

## Controladores
- Ejemplo: `app/controllers/home/home.controller.php:1`.
- Patrón de render:
```php
private function render($view, $data = []) {
  extract($data);
  ob_start();
  include "../app/views/$view.php";
  $content = ob_get_clean();
  include "../app/views/template.php";
}
```
- Cada acción arma `$title` y `$content` para el template.

## Template
- Ubicación: `app/views/template.php:1`.
- Es la cápsula del layout: incluye `header`, `navbar`, `sidebar` y pinta el contenido del módulo.
- Puntos clave:
  - Título: `app/views/template.php:12`
  - Contenido: `app/views/template.php:15`

## Menú
- Enlaces del sidebar: `app/views/partials/sidebar.php:1`.
- Apuntan a `/home`, `/usuarios`, `/vehiculos`, `/viajes`.

## Reescritura (.htaccess)
- Ubicación: `.htaccess:1`.
- Enruta todo a `public/index.php` y establece `DirectoryIndex public/index.php`.

## Añadir un Módulo
1. Crear controlador en `app/controllers/<modulo>/<modulo>.controller.php`.
2. Crear vistas en `app/views/<modulo>/...`.
3. Registrar rutas en `public/index.php`:
```php
$router->get('/<modulo>', [ControllerModulo::class, 'index']);
```
4. Añadir enlace en `app/views/partials/sidebar.php`.

## Home por Defecto
- Rutas: `'/'` y `'/home'` → `controllerhome::index` (`public/index.php:7-8`).
- Página: `app/views/home/index.php:1`.