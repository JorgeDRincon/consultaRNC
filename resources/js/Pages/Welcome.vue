<template>
    <Head :title="$t('common.welcome')" />
    <div
        class="min-h-screen flex flex-col items-center bg-gradient-to-br from-slate-50 to-slate-200 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300"
    >
        <!-- Header con navegación -->
        <Navigation />

        <!-- Contenido principal -->
        <div class="flex w-full max-w-7xl mt-32 mb-8 mx-auto flex-1 px-4 sm:px-0">
            <div class="flex-1">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/20 px-6 sm:px-10 py-8 text-center relative overflow-hidden transition-colors duration-300"
                >
                    <div class="flex flex-col items-center relative z-0 mb-6">
                        <div class="flex justify-center items-center mb-4">
                            <img
                                src="/images/logo.png"
                                alt="Logo"
                                width="180"
                                class="dark:brightness-0 dark:invert mx-auto"
                            />
                        </div>

                        <div class="text-center space-y-2">
                            <p class="text-lg font-semibold" style="color: #D1D5D8;">
                                {{ $t('common.welcome_message') }}
                            </p>
                            
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed max-w-xl">
                                {{ $t('common.description') }}
                            </p>
                        </div>
                    </div>

                    <!-- Hero section -->
                    <div class="mb-8">
                        <div class="bg-blue-700 text-white p-8 rounded-xl">
                            <h2 class="text-2xl font-semibold mb-4">
                                {{ $t('features.api_capabilities') }}
                            </h2>

                            <div
                                class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center"
                            >
                                <div>
                                    <div class="text-3xl mb-2">
                                        🔍
                                    </div>
                                    <h3 class="font-semibold mb-2">
                                        {{ $t('features.search_rnc') }}
                                    </h3>
                                    <p class="text-sm opacity-90">
                                        {{ $t('features.search_rnc_description') }}
                                    </p>
                                </div>
                                <div>
                                    <div class="text-3xl mb-2">
                                        ⚡
                                    </div>
                                    <h3 class="font-semibold mb-2">
                                        {{ $t('features.fast_responses') }}
                                    </h3>
                                    <p class="text-sm opacity-90">
                                        {{ $t('features.fast_results') }}
                                    </p>
                                </div>
                                <div>
                                    <div class="text-3xl mb-2">
                                        🔗
                                    </div>
                                    <h3 class="font-semibold mb-2">
                                        {{ $t('features.easy_integration') }}
                                    </h3>
                                    <p class="text-sm opacity-90">
                                        {{ $t('features.easy_integration_description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg transition-colors duration-300">
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                                24/7
                            </div>
                            <div class="text-gray-600 dark:text-gray-300">
                                {{ $t('features.availability') }}
                            </div>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg transition-colors duration-300">
                            <div class="text-3xl font-bold text-red-600 dark:text-red-400 mb-2">
                                {{ $t('features.response_time_value') }}
                            </div>
                            <div class="text-gray-600 dark:text-gray-300">
                                {{ $t('features.response_time') }}
                            </div>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg transition-colors duration-300">
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                                {{ $t('features.update_frequency_value') }}
                            </div>
                            <div class="text-gray-600 dark:text-gray-300">
                                {{ $t('features.update_frequency') }}
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="space-y-4">
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ $t('common.get_started') }}
                        </p>
                        <div
                            class="flex flex-col sm:flex-row gap-4 justify-center"
                        >
                            <Link
                                href="/documentation"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition"
                            >
                                {{ $t('common.view_documentation') }}
                            </Link>
                            <Link
                                href="/documentation/about"
                                class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg transition"
                            >
                                {{ $t('common.learn_more') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <Footer />
    </div>
    
    <!-- Scroll to Top Button -->
    <ScrollToTop />
</template>

<script setup lang="ts">
import Footer from '@/Components/Footer.vue'
import Navigation from '@/Components/Navigation.vue'
import ScrollToTop from '@/Components/ScrollToTop.vue'
import { Head, Link } from '@inertiajs/vue3'

// Welcome page - No props needed for this static page
</script>
