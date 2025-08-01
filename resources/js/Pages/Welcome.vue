<template>
    <Head title="Bienvenido - ConsultaRNC" />
    <div
        class="min-h-screen flex flex-col items-center bg-gradient-to-br from-slate-50 to-slate-200"
    >
        <!-- Header con navegación -->
        <Navigation />

        <!-- Contenido principal -->
        <div class="flex w-full max-w-7xl mt-16 mb-8 mx-auto flex-1">
            <div class="flex-1">
                <div
                    class="bg-white rounded-2xl shadow-lg px-10 py-8 text-center relative overflow-hidden"
                >
                    <!-- Background decoration -->
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-red-50 rounded-full -translate-y-16 translate-x-16 opacity-50"
                    ></div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-red-50 to-blue-50 rounded-full translate-y-12 -translate-x-12 opacity-50"
                    ></div>

                    <div class="relative z-10 mb-8">
                        <h1 class="text-6xl font-bold mb-3">
                            <span
                                class="bg-gradient-to-r from-blue-700 from-50% via-blue-600 to-red-600 to-70% bg-clip-text text-transparent"
                                >ConsultaRNC</span
                            >
                        </h1>
                        <p class="text-lg text-gray-500 font-medium">
                            Bienvenido a la plataforma de consulta tributaria
                        </p>
                    </div>

                    <p class="text-xl text-gray-600 mb-8 relative z-10">
                        Una plataforma moderna para consultar información
                        tributaria y de RNC en República Dominicana
                    </p>

                    <!-- Hero section -->
                    <div class="mb-12">
                        <div class="bg-blue-700 text-white p-8 rounded-xl">
                            <h2 class="text-2xl font-semibold mb-4">
                                ¿Qué puedes hacer con nuestra API?
                            </h2>

                            <div
                                class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center"
                            >
                                <div>
                                    <div class="text-3xl mb-2">🔍</div>
                                    <h3 class="font-semibold mb-2">
                                        Buscar RNC
                                    </h3>
                                    <p class="text-sm opacity-90">
                                        Consulta información detallada de
                                        contribuyentes
                                    </p>
                                </div>
                                <div>
                                    <div class="text-3xl mb-2">⚡</div>
                                    <h3 class="font-semibold mb-2">
                                        Respuestas Rápidas
                                    </h3>
                                    <p class="text-sm opacity-90">
                                        Obtén resultados en segundos
                                    </p>
                                </div>
                                <div>
                                    <div class="text-3xl mb-2">🔗</div>
                                    <h3 class="font-semibold mb-2">
                                        Fácil Integración
                                    </h3>
                                    <p class="text-sm opacity-90">
                                        Conecta con tus sistemas de forma
                                        sencilla
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                        <div class="bg-gray-100 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-blue-600 mb-2">
                                24/7
                            </div>
                            <div class="text-gray-600">Disponibilidad</div>
                        </div>
                        <div class="bg-gray-100 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-red-600 mb-2">
                                &lt;3s
                            </div>
                            <div class="text-gray-600">Tiempo de Respuesta</div>
                        </div>
                        <div class="bg-gray-100 p-6 rounded-lg">
                            <div class="text-3xl font-bold text-blue-600 mb-2">
                                99.9%
                            </div>
                            <div class="text-gray-600">Uptime</div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="space-y-4">
                        <p class="text-gray-600 mb-6">
                            ¿Listo para empezar? Explora nuestra documentación
                            completa y comienza a integrar la API en tus
                            proyectos.
                        </p>
                        <div
                            class="flex flex-col sm:flex-row gap-4 justify-center"
                        >
                            <Link
                                href="/documentation"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition"
                            >
                                Ver Documentación
                            </Link>
                            <Link
                                href="/documentation/about"
                                class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg transition"
                            >
                                Conoce Más
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import Footer from "@/Components/Footer.vue";
import Navigation from "@/Components/Navigation.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>
