<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-10">
      <div class="flex items-center">
        <h1 class="text-xl font-semibold text-gray-800">Protocol</h1>
        <div class="relative ml-8">
          <input type="text" placeholder="Find something..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
          <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          </span>
          <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs bg-gray-100 px-2 py-1 rounded">Ctrl K</span>
        </div>
      </div>
      <nav class="flex items-center space-x-6 text-sm font-medium text-gray-600">
        <router-link to="/api-documentation" class="hover:text-gray-900">API Documentation</router-link>
        <a href="/support" class="hover:text-gray-900">Support</a>
        <a href="/sign-in" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Sign In</a>
      </nav>
    </header>

    <div class="flex flex-1">
      <aside class="w-64 bg-white border-r border-gray-200 py-6 px-4 flex-shrink-0 overflow-y-auto">
        <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Guides</h2>
        <nav class="space-y-1 mb-8">
          <router-link to="/guides/introduction" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Introduction</router-link>
          <router-link to="/guides" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Guides</router-link>
          <router-link to="/resources" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Resources</router-link>
        </nav>

        <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Quickstart</h2>
        <nav class="space-y-1 mb-8">
          <router-link to="/quickstart/sdks" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">SDKs</router-link>
          <router-link to="/quickstart/authentication" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Authentication</router-link>
          <router-link to="/quickstart/pagination" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Pagination</router-link>
          <router-link to="/quickstart/errors" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Errors</router-link>
          <router-link to="/quickstart/webhooks" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Webhooks</router-link>
        </nav>

        <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Resources</h2>
        <nav class="space-y-1">
          <router-link to="/resources/contacts" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Contacts</router-link>
          <router-link to="/resources/conversations" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Conversations</router-link>
          <router-link to="/resources/messages" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Messages</router-link>
          <router-link to="/resources/groups" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Groups</router-link>
          <router-link to="/resources/attachments" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">Attachments</router-link>
        </nav>
      </aside>

      <main class="flex-1 p-6 overflow-y-auto">
        <router-view></router-view> </main>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Layout',
  // No necesitas importar las páginas aquí, Vue Router las gestiona.
};
</script>

<style>
/*
  ESTILOS GLOBALES PARA ASEGURAR 100% DE ALTURA
  Idealmente, estos estilos deberían ir en tu archivo CSS principal (resources/css/app.css)
  para que afecten a todo el documento y no solo a este componente.
*/
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  /* overflow: hidden;  <-- Descomenta si tienes scrollbars duplicadas y no quieres scroll en la ventana principal */
}

#app {
  height: 100%;
}

/* Puedes añadir cualquier estilo base no cubierto por Tailwind aquí, o en app.css */
</style>