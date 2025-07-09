<template>
    <Head title="About" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200"
    >
        <!-- Header con navegación -->
        <Navigation />

        <div class="flex w-full max-w-7xl mt-16 mb-8 mx-auto flex-1">
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-lg p-10 text-center">
                    <h1 class="text-3xl font-bold mb-2 text-gray-900">
                        Acerca de ConsultaRNC
                    </h1>
                    <p class="text-gray-500 mb-6">
                        Conectando el futuro tributario dominicano con
                        tecnología moderna y transparencia
                        <img
                            src="/images/dominican-republic-flag.png"
                            alt="Bandera de República Dominicana"
                            class="inline-block w-5 h-4"
                        />
                    </p>

                    <!-- Por qué fue desarrollada -->
                    <div class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            ¿Por qué fue desarrollada esta API?
                        </h2>
                        <div class="space-y-4 text-gray-700">
                            <p>
                                <span class="font-bold">ConsultaRNC</span> nació
                                de la necesidad de modernizar y simplificar el
                                acceso a la información tributaria en República
                                Dominicana. Tradicionalmente, consultar datos
                                del RNC (Registro Nacional de Contribuyentes)
                                requería procesos manuales, tiempos de espera
                                prolongados y acceso limitado a la información
                                actualizada.
                            </p>
                            <p>
                                <strong
                                    >Nuestros objetivos principales
                                    incluyen:</strong
                                >
                            </p>
                            <div
                                class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6"
                            >
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-200/50 cursor-pointer"
                                >
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-110"
                                        >
                                            <svg
                                                class="w-6 h-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <h3
                                            class="text-lg font-semibold text-blue-900"
                                        >
                                            Automatización
                                        </h3>
                                    </div>
                                    <p class="text-blue-800 text-sm">
                                        Eliminar procesos manuales y reducir el
                                        tiempo de consulta de información
                                        tributaria de horas a segundos.
                                    </p>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-green-200/50 cursor-pointer"
                                >
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-110"
                                        >
                                            <svg
                                                class="w-6 h-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <h3
                                            class="text-lg font-semibold text-green-900"
                                        >
                                            Accesibilidad
                                        </h3>
                                    </div>
                                    <p class="text-green-800 text-sm">
                                        Proporcionar acceso 24/7 a datos
                                        actualizados del RNC para
                                        desarrolladores, empresas y sistemas
                                        integrados.
                                    </p>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-purple-200/50 cursor-pointer"
                                >
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-110"
                                        >
                                            <svg
                                                class="w-6 h-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <h3
                                            class="text-lg font-semibold text-purple-900"
                                        >
                                            Estandarización
                                        </h3>
                                    </div>
                                    <p class="text-purple-800 text-sm">
                                        Crear un formato consistente y
                                        estructurado para la información
                                        tributaria que facilite la integración
                                        con diferentes sistemas.
                                    </p>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-orange-200/50 cursor-pointer"
                                >
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-110"
                                        >
                                            <svg
                                                class="w-6 h-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                ></path>
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <h3
                                            class="text-lg font-semibold text-orange-900"
                                        >
                                            Transparencia
                                        </h3>
                                    </div>
                                    <p class="text-orange-800 text-sm">
                                        Facilitar la verificación de información
                                        tributaria de manera rápida y confiable.
                                    </p>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-red-200/50 cursor-pointer"
                                >
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-110"
                                        >
                                            <svg
                                                class="w-6 h-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                                ></path>
                                            </svg>
                                        </div>
                                        <h3
                                            class="text-lg font-semibold text-red-900"
                                        >
                                            Innovación
                                        </h3>
                                    </div>
                                    <p class="text-red-800 text-sm">
                                        Impulsar el desarrollo de nuevas
                                        aplicaciones y servicios que aprovechen
                                        los datos tributarios de manera
                                        eficiente.
                                    </p>
                                </div>
                            </div>
                            <p>
                                Esta API representa un paso hacia la
                                digitalización del sector tributario dominicano,
                                ofreciendo herramientas modernas que benefician
                                tanto al sector público como al privado,
                                promoviendo la eficiencia y transparencia en los
                                procesos relacionados con la información
                                tributaria.
                            </p>
                        </div>
                    </div>

                    <!-- Equipo -->
                    <div class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            Quienes Somos
                        </h2>
                        <p class="text-gray-700 mb-6">
                            Somos desarrolladores apasionados por la tecnología,
                            comprometidos con ofrecer soluciones innovadoras y
                            fáciles de implementar que generen un impacto
                            positivo en la sociedad dominicana.
                        </p>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Miembro 1 -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-200/50 cursor-pointer"
                            >
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-4 transition-transform duration-300 group-hover:scale-110"
                                    >
                                        <svg
                                            class="w-6 h-6 text-white"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="text-lg font-semibold text-blue-900"
                                        >
                                            Jorge Rincón
                                        </h3>
                                        <p class="text-blue-700 text-sm">
                                            Full Stack Developer
                                        </p>
                                    </div>
                                </div>
                                <p class="text-blue-800 text-sm mb-4">
                                    Desarrollador web apasionado con más de 5
                                    años de experiencia, especializado en
                                    desarrollo Full-Stack. Ha colaborado con
                                    equipos internacionales, especialmente en
                                    España, utilizando tecnologías como Vue.js,
                                    Angular, Spring y Laravel para crear
                                    soluciones eficientes y escalables.
                                </p>
                                <a
                                    href="https://www.linkedin.com/in/jorge-rincón-941830110"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors"
                                >
                                    <svg
                                        class="w-4 h-4 mr-2"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                                        />
                                    </svg>
                                    LinkedIn
                                </a>
                            </div>

                            <!-- Miembro 2 -->
                            <div
                                class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-green-200/50 cursor-pointer"
                            >
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4 transition-transform duration-300 group-hover:scale-110"
                                    >
                                        <svg
                                            class="w-6 h-6 text-white"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="text-lg font-semibold text-green-900"
                                        >
                                            Nombre de tu Compañero
                                        </h3>
                                        <p class="text-green-700 text-sm">
                                            Desarrollador Backend
                                        </p>
                                    </div>
                                </div>
                                <p class="text-green-800 text-sm mb-4">
                                    Experto en arquitectura de software y
                                    desarrollo de APIs robustas. Especializado
                                    en bases de datos, seguridad y optimización
                                    de rendimiento.
                                </p>
                                <a
                                    href="https://www.linkedin.com/in/perfil-companero-linkedin"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center text-green-600 hover:text-green-800 transition-colors"
                                >
                                    <svg
                                        class="w-4 h-4 mr-2"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                                        />
                                    </svg>
                                    LinkedIn
                                </a>
                            </div>
                        </div>

                        <p class="text-gray-700 mt-6">
                            Nuestro compromiso es mantener y mejorar
                            continuamente esta API, optimizando el acceso a la
                            información tributaria para la comunidad de
                            desarrolladores dominicana al mismo tiempo que
                            continuamos desarrollando nuevas soluciones que
                            impulsen el crecimiento y modernización del
                            ecosistema tecnológico del país.
                        </p>
                    </div>

                    <!-- Contacto -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            ¿Tienes alguna pregunta?
                        </h2>
                        <p class="text-gray-700 mb-4">
                            Estamos aquí para ayudarte. Si tienes alguna
                            consulta sobre nuestros servicios o quieres
                            colaborar con el proyecto, no dudes en contactarnos.
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a
                                href="mailto:contacto@consulta-rnc.com"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                            >
                                Contactar
                            </a>
                            <Link
                                href="/documentation"
                                class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                            >
                                Ver Documentación
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>

<script setup>
import Footer from "@/Components/Footer.vue";
import Navigation from "@/Components/Navigation.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>
