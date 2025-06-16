# Configuración de SPA con Vue en Laravel

Esta guía te ayudará a convertir tu proyecto Laravel en una Single Page Application (SPA) usando Vue, con rutas para documentación y API.

---

## 1. Instalar Vue y Vite

Ejecuta estos comandos en la raíz del proyecto:

```bash
composer require laravel/breeze --dev
php artisan breeze:install vue
npm install
npm run dev
```

Esto instalará Vue, Vite y archivos de ejemplo para autenticación y SPA.

---

## 2. Configurar la Ruta SPA en Laravel

Para que todas las rutas bajo `/documentation/*` sean manejadas por Vue, agrega en `routes/web.php`:

```php
Route::get('/documentation/{any}', function () {
    return view('spa');
})->where('any', '.*');
```

Esto hará que cualquier ruta bajo `/documentation/` cargue una vista Blade llamada `spa.blade.php`.

---

## 3. Crear la Vista SPA

Crea el archivo `resources/views/spa.blade.php` con el siguiente contenido:

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Documentation SPA</title>
        @vite('resources/js/app.js')
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
```

---

## 4. Configurar Vue Router

En `resources/js/app.js`, configura Vue Router para manejar las rutas internas de la documentación:

```js
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";

const routes = [
    {
        path: "/documentation/:page?",
        component: () => import("./pages/Documentation.vue"),
    },
    // Puedes agregar más rutas aquí
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount("#app");
```

Crea el componente `resources/js/pages/Documentation.vue` para mostrar la documentación.

---

## 5. API

Las rutas `/api/endpoint` ya están reservadas para API en Laravel. Crea tus endpoints en `routes/api.php` y consúmelos desde Vue usando `fetch` o `axios`.

---

## 6. Probar

-   Accede a `dominio.com/documentation/introduccion` y deberías ver tu SPA de Vue.
-   Accede a `dominio.com/api/endpoint` para tus endpoints de API.

---

¡Listo! Comparte este archivo con tu colaborador para que pueda seguir los pasos.
