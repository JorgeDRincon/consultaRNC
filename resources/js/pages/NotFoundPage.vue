<template>
  <div class="flex items-center justify-center min-h-[calc(100vh-4rem)] bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 text-center bg-white p-10 rounded-lg shadow-md border border-gray-100">
      <div>
        <h1 class="text-6xl font-extrabold text-gray-900">404</h1>
        <h2 class="mt-4 text-3xl font-bold text-gray-800">Page Not Found</h2>
        <p class="mt-2 text-lg text-gray-600">
          Lo sentimos, la página que estás buscando no existe.
        </p>
      </div>
      <div class="mt-6">
        <router-link
          to="/"
          class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
        >
          <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Volver al inicio
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotFoundPage',
};
</script>

<style scoped></style>