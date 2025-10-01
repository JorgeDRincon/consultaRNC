<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
        <!-- Header con navegación -->
        <Navigation />

        <div class="flex w-full max-w-7xl mt-24 mb-8 mx-auto flex-1">
            <div class="flex-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/20 p-10 text-center transition-colors duration-300">
                    <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                        Uso
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                        En esta sección aprenderás cómo utilizar la API y sus diferentes
                        endpoints.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup lang="ts">
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'
</script>
