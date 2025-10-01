<template>
    <header class="absolute top-0 left-0 right-0 p-6 z-10">
        <nav class="max-w-7xl mx-auto flex justify-between items-center">
            <Link href="/">
                <img src="/images/logo.png" alt="Logo" width="200" class="dark:brightness-0 dark:invert" />
            </Link>
            <div class="flex items-center space-x-6">
                <Link
                    href="/documentation"
                    :class="[
                        'font-medium transition-colors duration-200',
                        isActive('/documentation')
                            ? 'text-blue-600 dark:text-blue-400'
                            : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100',
                    ]"
                >
                    Documentación
                </Link>
                <Link
                    href="/documentation/about"
                    :class="[
                        'font-medium transition-colors duration-200',
                        isActive('/documentation/about')
                            ? 'text-blue-600 dark:text-blue-400'
                            : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100',
                    ]"
                >
                    About
                </Link>
                <!-- Theme Toggle -->
                <ThemeToggle />
            </div>
        </nav>
    </header>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import ThemeToggle from './ThemeToggle.vue'

const page = usePage()

const isActive = (path: string): boolean => {
    return page.url === path
}
</script>
