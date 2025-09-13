<template>
    <Head title="Tipos de Respuestas API" />
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h1 class="text-3xl font-bold mb-8 text-gray-900">
                    Tipos de Respuestas
                </h1>

                <!-- Respuesta Exitosa -->
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                        Respuesta Exitosa
                    </h2>
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-xl font-medium mb-3 text-gray-700">
                            Estructura
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
        "estado": "Activo",
        "fecha_registro": "2024-01-01"
    },
    "message": "Consulta exitosa"
}</pre>
                    </div>
                </div>

                <!-- Respuesta de Error -->
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                        Respuesta de Error
                    </h2>
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <h3 class="text-xl font-medium mb-3 text-gray-700">
                            Estructura
                        </h3>
                        <pre
                            class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto"
                        >
{
    "success": false,
    "error": {
        "code": "RNC_NOT_FOUND",
        "message": "El RNC especificado no existe",
        "details": "No se encontró ningún registro con el RNC 123456789"
    }
}</pre>
                    </div>
                </div>

                <!-- Códigos de Estado HTTP -->
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                        Códigos de Estado HTTP
                    </h2>
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <span class="font-semibold text-green-600 mr-2">200 OK:</span>
                                <span class="text-gray-600">La solicitud se procesó correctamente</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold text-yellow-600 mr-2">400 Bad Request:</span>
                                <span class="text-gray-600">La solicitud contiene parámetros
                                    inválidos</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold text-red-600 mr-2">404 Not Found:</span>
                                <span class="text-gray-600">El recurso solicitado no existe</span>
                            </li>
                            <li class="flex items-start">
                                <span class="font-semibold text-red-600 mr-2">500 Internal Server Error:</span>
                                <span class="text-gray-600">Error interno del servidor</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Navegación -->
                <div class="mt-8 flex justify-between">
                    <Link
                        href="/documentation/endpoints"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition"
                    >
                        ← Ver Endpoints
                    </Link>
                    <Link
                        href="/documentation"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition"
                    >
                        Volver a Inicio
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'

// Responses page - Static documentation page with no props
</script>
