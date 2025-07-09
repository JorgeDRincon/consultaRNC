<template>
    <Head title="Endpoints API" />
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold mb-8 text-gray-900">
                    Endpoints de la API
                </h1>

                <!-- Sección de Búsqueda RNC -->
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                        Búsqueda de RNC
                    </h2>
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h4 class="text-lg font-medium mb-3 text-gray-700">
                            GET /api/v1/rnc/{numero}
                        </h4>
                        <p class="text-gray-600 mb-4">
                            Consulta información de un RNC específico.
                        </p>

                        <h5 class="font-semibold mb-2 text-gray-700">
                            Parámetros:
                        </h5>
                        <ul class="list-disc list-inside mb-4 text-gray-600">
                            <li>
                                numero: Número de RNC a consultar (requerido)
                            </li>
                        </ul>

                        <h5 class="font-semibold mb-2 text-gray-700">
                            Ejemplo de uso:
                        </h5>
                        <pre
                            class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                        >
GET /api/v1/rnc/123456789</pre
                        >
                    </div>
                </div>

                <!-- Sección de Búsqueda por Nombre -->
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                        Búsqueda por Nombre
                    </h2>
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-xl font-medium mb-3 text-gray-700">
                            GET /api/v1/search
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Busca contribuyentes por nombre o razón social.
                        </p>

                        <h4 class="font-semibold mb-2 text-gray-700">
                            Parámetros de consulta:
                        </h4>
                        <ul class="list-disc list-inside mb-4 text-gray-600">
                            <li>q: Término de búsqueda (requerido)</li>
                            <li>
                                page: Número de página (opcional, default: 1)
                            </li>
                            <li>
                                per_page: Resultados por página (opcional,
                                default: 10)
                            </li>
                        </ul>

                        <h4 class="font-semibold mb-2 text-gray-700">
                            Ejemplo de uso:
                        </h4>
                        <pre
                            class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto"
                        >
GET /api/v1/search?q=empresa&page=1&per_page=20</pre
                        >
                    </div>
                </div>

                <!-- Navegación -->
                <div class="mt-8 flex justify-between">
                    <Link
                        href="/documentation"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition"
                    >
                        ← Volver a Inicio
                    </Link>
                    <Link
                        href="/documentation/responses"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition"
                    >
                        Ver Tipos de Respuestas →
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>
