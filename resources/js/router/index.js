// resources/js/router/index.js

import { createRouter, createWebHistory } from 'vue-router';

// 1. Importa tus componentes de página/vista
// Estos son los componentes que representarán las diferentes "páginas" de tu SPA.
// Te recomiendo crearlos en una nueva carpeta 'resources/js/pages' para una buena organización.
// Creamos 3 ejemplos básicos para empezar.
// import HomePage from '../pages/HomePage.vue';
// import AboutPage from '../pages/AboutPage.vue';
// import ContactPage from '../pages/ContactPage.vue';

// Más adelante, importarás tus componentes reales para las secciones de la imagen:
import APIDocumentationPage from '../pages/APIDocumentationPage.vue';
import NotFoundPage from '../pages/NotFoundPage.vue';
// import GuidesOverviewPage from '../pages/GuidesOverviewPage.vue';

// 2. Define tus rutas
// Cada objeto de ruta mapea una URL (path) a un componente (component).
const routes = [
    {
        path: '/api-documentation',
        name: 'APIDocs',
        component: APIDocumentationPage,
    },

    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: NotFoundPage,
    },
];

// 3. Crea la instancia del router
const router = createRouter({
  // `createWebHistory()` usa el historial del navegador para URLs limpias (ej. 'misitio.com/about').
  // Esto es lo más común para SPAs.
  history: createWebHistory(),
  routes, // Pasa tus rutas definidas aquí

  // Opcional: Clases CSS que se aplicarán automáticamente a los <router-link> activos.
  // Útil para estilizar el elemento de navegación actual.
  linkActiveClass: 'active-link',
  linkExactActiveClass: 'exact-active-link',
});

// 4. Exporta el router para que puedas usarlo en tu app.js
export default router;