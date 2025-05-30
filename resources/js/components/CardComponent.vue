<template>
  <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ title }}</h3>
    <p class="text-sm text-gray-600 mb-4">{{ description }}</p>
    <router-link :to="link" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
      Read more
      <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'CardComponent',
  props: {
    title: { type: String, required: true },
    description: { type: String, required: true },
    link: { type: String, default: '#' },
  },
};
</script>