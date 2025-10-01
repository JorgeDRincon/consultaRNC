<template>
    <Head title="About" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300"
    >
        <!-- Header con navegación -->
        <Navigation />

        <div class="flex w-full max-w-7xl mt-24 mb-8 mx-auto flex-1">
            <div class="flex-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/20 p-10 text-center transition-colors duration-300">
                    <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">
                        Acerca de ConsultaRNC
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
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
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
                            ¿Por qué fue desarrollada esta API?
                        </h2>
                        <div class="space-y-4 text-gray-700 dark:text-gray-300">
                            <p>
                                <span class="font-bold">ConsultaRNC</span> nació
                                de la necesidad de modernizar y simplificar el
                                acceso a la información tributaria en República
                                Dominicana. Tradicionalmente, consultar datos
                                del RNC (Registro Nacional de Contribuyentes)
                                requería procesos manuales y aunque la DGII
                                ofrece un servicio web completo, nuestra API
                                facilita la integración programática de estos
                                datos.
                            </p>
                            <p>
                                <strong>Nuestros objetivos principales
                                    incluyen:</strong>
                            </p>
                            <div
                                class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6"
                            >
                                <FeatureCard
                                    title="Automatización"
                                    description="Eliminar procesos manuales y reducir el tiempo de consulta de información tributaria de horas a segundos."
                                    icon="M13 10V3L4 14h7v7l9-11h-7z"
                                    fa-icon="fa-solid fa-cogs"
                                    color="blue"
                                />

                                <FeatureCard
                                    title="Accesibilidad"
                                    description="Proporcionar acceso 24/7 a datos actualizados del RNC para desarrolladores, empresas y sistemas integrados."
                                    icon="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                    fa-icon="fa-solid fa-universal-access"
                                    color="green"
                                />

                                <FeatureCard
                                    title="Estandarización"
                                    description="Crear un formato consistente y estructurado para la información tributaria que facilite la integración con diferentes sistemas."
                                    icon="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    fa-icon="fa-solid fa-layer-group"
                                    color="purple"
                                />

                                <FeatureCard
                                    title="Transparencia"
                                    description="Facilitar la verificación de información tributaria de manera rápida y confiable."
                                    icon="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    fa-icon="fa-solid fa-eye"
                                    color="orange"
                                />

                                <FeatureCard
                                    title="Innovación"
                                    description="Impulsar el desarrollo de nuevas aplicaciones y servicios que aprovechen los datos tributarios de manera eficiente."
                                    icon="M13 10V3L4 14h7v7l9-11h-7z"
                                    fa-icon="fa-solid fa-lightbulb"
                                    color="red"
                                />
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
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
                            Quienes Somos
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                            Somos desarrolladores apasionados por la tecnología,
                            comprometidos con ofrecer soluciones innovadoras y
                            fáciles de implementar que generen un impacto
                            positivo en la sociedad dominicana. Nos motiva la
                            curiosidad y la búsqueda constante de aprendizaje,
                            <b>
                                transformando ideas en herramientas que
                                simplifican la vida de las personas.</b>
                            Creemos firmemente en el trabajo colaborativo y en
                            el poder de la comunidad para impulsar la creación
                            de software de calidad.
                        </p>

                        <p class="text-gray-700 dark:text-gray-300 mt-6">
                            Nuestro compromiso es mejorar y mantener
                            continuamente esta API, optimizando el acceso a la
                            información tributaria para
                            <b>la comunidad de desarrolladores dominicanos</b>
                            al mismo tiempo que continuamos desarrollando nuevas
                            soluciones que impulsen el crecimiento y
                            modernización del ecosistema tecnológico del país
                            <img
                                src="/images/dominican-republic-flag.png"
                                alt="Bandera de República Dominicana"
                                class="inline-block w-5 h-4"
                            />
                        </p>
                    </div>

                    <!-- Contacto -->
                    <div v-if="false" class="mb-8">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
                            ¿Tienes alguna pregunta?
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Estamos aquí para ayudarte. Si tienes alguna
                            consulta sobre nuestros servicios o quieres
                            colaborar con el proyecto, no dudes en contactarnos.
                        </p>
                        <div class="flex justify-center space-x-4">
                            <Link
                                href="mailto:contacto@consulta-rnc.com"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                            >
                                Contactar
                            </Link>
                            <Link
                                href="/documentation"
                                class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition"
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
