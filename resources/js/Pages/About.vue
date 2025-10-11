<template>
    <Head :title="$t('about.title')" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300"
    >
        <!-- Header con navegación -->
        <Navigation />

        <div class="flex w-full max-w-7xl mt-32 mb-8 mx-auto flex-1 px-4 sm:px-0">
            <div class="flex-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/20 p-6 sm:p-10 text-center transition-colors duration-300">
                    <h1 class="text-2xl lg:text-3xl font-bold mb-2 text-gray-900 dark:text-white">
                        {{ $t('about.title') }}
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        {{ $t('about.subtitle') }}
                        <img
                            src="/images/dominican-republic-flag.png"
                            alt="Bandera de República Dominicana"
                            class="inline-block w-5 h-4"
                        />
                    </p>

                    <!-- Por qué fue desarrollada -->
                    <div class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
                            {{ $t('about.why_developed_title') }}
                        </h2>
                        <div class="space-y-4 text-gray-700 dark:text-gray-300">
                            <p>
                                {{ $t('about.why_developed_text') }}
                            </p>
                            <p>
                                <strong>{{ $t('about.objectives_title') }}</strong>
                            </p>
                            <div
                                class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6"
                            >
                                <FeatureCard
                                    :title="$t('about.automation_title')"
                                    :description="$t('about.automation_description')"
                                    icon="M13 10V3L4 14h7v7l9-11h-7z"
                                    fa-icon="fa-solid fa-cogs"
                                    color="blue"
                                />

                                <FeatureCard
                                    :title="$t('about.accessibility_title')"
                                    :description="$t('about.accessibility_description')"
                                    icon="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                    fa-icon="fa-solid fa-universal-access"
                                    color="green"
                                />

                                <FeatureCard
                                    :title="$t('about.standardization_title')"
                                    :description="$t('about.standardization_description')"
                                    icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    fa-icon="fa-solid fa-layer-group"
                                    color="purple"
                                />

                                <FeatureCard
                                    :title="$t('about.transparency_title')"
                                    :description="$t('about.transparency_description')"
                                    icon="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    fa-icon="fa-solid fa-eye"
                                    color="orange"
                                />

                                <FeatureCard
                                    :title="$t('about.innovation_title')"
                                    :description="$t('about.innovation_description')"
                                    icon="M13 10V3L4 14h7v7l9-11h-7z"
                                    fa-icon="fa-solid fa-lightbulb"
                                    color="red"
                                />
                            </div>

                            <p>
                                {{ $t('about.conclusion_text') }}
                            </p>
                        </div>
                    </div>

                    <!-- Equipo -->
                    <div class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
                            {{ $t('about.who_we_are_title') }}
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                            {{ $t('about.who_we_are_text') }}
                        </p>

                        <p class="text-gray-700 dark:text-gray-300 mt-6">
                            {{ $t('about.commitment_text') }}
                        </p>
                    </div>

                    <!-- Contacto -->
                    <div v-if="false" class="mb-8">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
                            {{ $t('about.contact_title') }}
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            {{ $t('about.contact_text') }}
                        </p>
                        <div class="flex justify-center space-x-4">
                            <Link
                                href="mailto:contacto@consulta-rnc.com"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                            >
                                {{ $t('about.contact_button') }}
                            </Link>
                            <Link
                                href="/documentation"
                                class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                            >
                                {{ $t('about.view_docs_button') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
    
    <!-- Scroll to Top Button -->
    <ScrollToTop />
</template>

<script setup lang="ts">
import FeatureCard from '@/Components/FeatureCard.vue'
import Footer from '@/Components/Footer.vue'
import Navigation from '@/Components/Navigation.vue'
import ScrollToTop from '@/Components/ScrollToTop.vue'
import { Head, Link } from '@inertiajs/vue3'

// About page - No props needed for this static page
</script>
