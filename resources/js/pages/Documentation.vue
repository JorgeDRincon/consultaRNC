<template>
    <Head title="Documentation" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200"
    >
        <div
            class="bg-white rounded-2xl shadow-lg p-10 max-w-4xl w-full text-center mt-16"
        >
            <h1 class="text-3xl font-bold mb-2 text-gray-900">
                Bienvenido a la Documentación de la API DGII
            </h1>
            <p class="text-gray-500 mb-6">
                Esta aplicación provee una API moderna para consultar
                información tributaria y de RNC en República Dominicana.
            </p>

            <!-- Tecnologías -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Tecnologías
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Backend
                        </h3>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2">
                                <span>⚡</span> Laravel 12.15.0
                            </li>
                            <li class="flex items-center gap-2">
                                <span>📦</span> MySQL/MariaDB
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Frontend
                        </h3>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2">
                                <span>⚛️</span> Vue.js 3
                            </li>
                            <li class="flex items-center gap-2">
                                <span>🎨</span> Tailwind CSS
                            </li>
                            <li class="flex items-center gap-2">
                                <span>🔄</span> Inertia.js
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Características -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Características Principales
                </h2>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-gray-700">
                        <span>🔍</span> Búsqueda avanzada de RNC y
                        contribuyentes
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <span>📄</span> Documentación clara y ejemplos de uso
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <span>⚡</span> Respuestas rápidas y eficientes
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <span>🚀</span> Integración sencilla con tus sistemas
                    </li>
                </ul>
            </div>

            <!-- Tipos de Respuestas -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Tipos de Respuestas
                </h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">
                        Formato JSON
                    </h3>
                    <pre
                        class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto"
                    >
{
    "success": true,
    "data": {
        "rnc": "123456789",
        "nombre": "Empresa Ejemplo",
        "tipo": "Persona Jurídica",
        "estado": "Activo"
    },
    "message": "Consulta exitosa"
}</pre
                    >
                </div>
            </div>

            <!-- Endpoints Principales -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Endpoints Principales
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Consulta RNC
                        </h3>
                        <code class="bg-gray-800 text-gray-100 p-2 rounded"
                            >GET /api/v1/rnc/{numero}</code
                        >
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Búsqueda por Nombre
                        </h3>
                        <code class="bg-gray-800 text-gray-100 p-2 rounded"
                            >GET /api/v1/search?q={nombre}</code
                        >
                    </div>
                </div>
            </div>

            <a
                href="/documentation/introduccion"
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                >Ver documentación técnica completa</a
            >
        </div>
        <footer class="mt-8 text-gray-400 text-sm">
            Proyecto open source &copy; 2024 - Desarrollado por tu equipo
        </footer>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
// Página estática, no requiere lógica JS
</script>
