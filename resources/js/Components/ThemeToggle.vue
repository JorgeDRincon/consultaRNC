<template>
    <button
        :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
        class="relative inline-flex items-center justify-center w-9 h-9 rounded-full bg-gray-200/80 dark:bg-gray-700/80 hover:bg-gray-300/90 dark:hover:bg-gray-600/90 text-gray-700 dark:text-gray-200 transition-all duration-300 ease-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/60 focus:ring-offset-2 dark:focus:ring-offset-gray-800 backdrop-blur-sm border border-gray-300/20 dark:border-gray-600/20"
        @click="toggleTheme"
    >
        <!-- Sun Icon (Light Mode) -->
        <i v-if="!isDark" class="fa-solid fa-sun text-gray-700 dark:text-gray-200 text-sm transition-transform duration-200" />

        <!-- Moon Icon (Dark Mode) -->
        <i v-else class="fa-solid fa-moon text-gray-700 dark:text-gray-200 text-sm transition-transform duration-200" />
    </button>
</template>

<script setup lang="ts">
import { useTheme } from '@/stores/theme'

const { isDark, toggleTheme } = useTheme()
</script>