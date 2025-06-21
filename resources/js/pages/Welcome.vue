<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Bienvenido - API DGII" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200"
    >
        <!-- Header con navegación -->
        <header class="absolute top-0 left-0 right-0 p-6">
            <nav class="max-w-4xl mx-auto flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">API DGII</div>
                <div class="flex space-x-6">
                    <Link
                        href="/documentation"
                        class="text-gray-600 hover:text-gray-800 font-medium transition"
                    >
                        Documentación
                    </Link>
                    <Link
                        href="/about"
                        class="text-gray-600 hover:text-gray-800 font-medium transition"
                    >
                        About
                    </Link>
                </div>
            </nav>
        </header>

        <!-- Contenido principal -->
        <div
            class="bg-white rounded-2xl shadow-lg p-10 max-w-4xl w-full text-center"
        >
            <h1 class="text-4xl font-bold mb-4 text-gray-900">
                Bienvenido a la API DGII
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                La plataforma moderna para consultar información tributaria y de
                RNC en República Dominicana
            </p>

            <!-- Hero section -->
            <div class="mb-12">
                <div
                    class="bg-gradient-to-r from-red-600 to-red-700 text-white p-8 rounded-xl mb-8"
                >
                    <h2 class="text-2xl font-semibold mb-4">
                        ¿Qué puedes hacer con nuestra API?
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center"
                    >
                        <div>
                            <div class="text-3xl mb-2">🔍</div>
                            <h3 class="font-semibold mb-2">Buscar RNC</h3>
                            <p class="text-sm opacity-90">
                                Consulta información detallada de contribuyentes
                            </p>
                        </div>
                        <div>
                            <div class="text-3xl mb-2">⚡</div>
                            <h3 class="font-semibold mb-2">
                                Respuestas Rápidas
                            </h3>
                            <p class="text-sm opacity-90">
                                Obtén resultados en segundos, no en horas
                            </p>
                        </div>
                        <div>
                            <div class="text-3xl mb-2">🔗</div>
                            <h3 class="font-semibold mb-2">
                                Fácil Integración
                            </h3>
                            <p class="text-sm opacity-90">
                                Conecta con tus sistemas de forma sencilla
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-bold text-red-600 mb-2">24/7</div>
                    <div class="text-gray-600">Disponibilidad</div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-bold text-red-600 mb-2">
                        &lt;1s
                    </div>
                    <div class="text-gray-600">Tiempo de Respuesta</div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-bold text-red-600 mb-2">
                        99.9%
                    </div>
                    <div class="text-gray-600">Uptime</div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="space-y-4">
                <p class="text-gray-600 mb-6">
                    ¿Listo para empezar? Explora nuestra documentación completa
                    y comienza a integrar la API en tus proyectos.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link
                        href="/documentation"
                        class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg transition"
                    >
                        Ver Documentación
                    </Link>
                    <Link
                        href="/about"
                        class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-8 rounded-lg transition"
                    >
                        Conoce Más
                    </Link>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-gray-400 text-sm">
            Proyecto open source &copy; 2024 - Desarrollado por tu equipo
        </footer>
    </div>
</template>
