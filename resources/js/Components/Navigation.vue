<template>
    <header class="absolute top-0 left-0 right-0 px-4 py-6 sm:px-6 lg:px-8 z-10">
        <nav class="max-w-7xl mx-auto flex justify-between items-end">
            <Link href="/" class="flex items-center">
                <img
                    src="/images/logo.png"
                    alt="Logo"
                    width="160"
                    class="dark:brightness-0 dark:invert"
                />
            </Link>
            <div class="flex items-center space-x-3">
                <!-- Desktop navigation links -->
                <div class="hidden md:flex items-center space-x-4">
                    <Link
                        href="/documentation"
                        :class="[
                            'font-medium transition-colors duration-200',
                            isActive('/documentation')
                                ? 'text-blue-600 dark:text-blue-400'
                                : 'text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100',
                        ]"
                    >
                        {{ $t('navigation.documentation') }}
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
                        {{ $t('navigation.about') }}
                    </Link>
                </div>
                
                <!-- All buttons grouped together with same spacing -->
                <div class="flex items-center space-x-2">
                    <LanguageSelector />
                    <ThemeToggle />
                    <!-- Mobile menu button -->
                    <button 
                        @click="toggleMobileMenu"
                        class="md:hidden p-2 rounded-lg bg-gray-100/80 dark:bg-gray-700/80 backdrop-blur-sm shadow-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200"
                    >
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile menu dropdown -->
        <div 
            v-show="mobileMenuOpen" 
            class="md:hidden mt-4 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 relative z-50"
        >
            <div class="px-4 py-3 space-y-2 relative z-50">
                <Link
                    href="/documentation"
                    @click="closeMobileMenu"
                    :class="[
                        'block font-medium transition-colors duration-200 px-4 py-3 rounded-lg cursor-pointer relative z-50',
                        isActive('/documentation')
                            ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20'
                            : 'text-gray-600 hover:text-gray-800 hover:bg-gray-50 dark:text-gray-300 dark:hover:text-gray-100 dark:hover:bg-gray-700/50',
                    ]"
                    style="pointer-events: auto; touch-action: manipulation; position: relative; z-index: 9999;"
                >
                    {{ $t('navigation.documentation') }}
                </Link>
                <Link
                    href="/documentation/about"
                    @click="closeMobileMenu"
                    :class="[
                        'block font-medium transition-colors duration-200 px-4 py-3 rounded-lg cursor-pointer relative z-50',
                        isActive('/documentation/about')
                            ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20'
                            : 'text-gray-600 hover:text-gray-800 hover:bg-gray-50 dark:text-gray-300 dark:hover:text-gray-100 dark:hover:bg-gray-700/50',
                    ]"
                    style="pointer-events: auto; touch-action: manipulation; position: relative; z-index: 9999;"
                >
                    {{ $t('navigation.about') }}
                </Link>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import ThemeToggle from './ThemeToggle.vue'
import LanguageSelector from './LanguageSelector.vue'

const page = usePage()
const mobileMenuOpen = ref(false)

const isActive = (path: string): boolean => {
    return page.url === path
}

const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value
}

const closeMobileMenu = () => {
    mobileMenuOpen.value = false
}
</script>
