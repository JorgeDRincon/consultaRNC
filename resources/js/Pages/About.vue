<template>
    <Head title="About" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200"
    >
        <!-- Header con navegación -->
        <header class="absolute top-0 left-0 right-0 p-6">
            <nav class="max-w-4xl mx-auto flex justify-between items-center">
                <Link href="/" class="text-2xl font-bold text-gray-800">
                    API DGII
                </Link>
                <div class="flex space-x-6">
                    <Link
                        href="/documentation"
                        class="text-gray-600 hover:text-gray-800 font-medium transition"
                    >
                        Documentación
                    </Link>
                    <Link
                        href="/about"
                        class="text-red-600 font-medium transition"
                    >
                        About
                    </Link>
                </div>
            </nav>
        </header>

        <div
            class="bg-white rounded-2xl shadow-lg p-10 max-w-4xl w-full text-center mt-16"
        >
            <h1 class="text-3xl font-bold mb-2 text-gray-900">
                Acerca de la API DGII
            </h1>
            <p class="text-gray-500 mb-6">
                Conoce más sobre nuestro proyecto y el equipo detrás de esta
                iniciativa
            </p>

            <!-- Misión -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Nuestra Misión
                </h2>
                <p class="text-gray-700 mb-4">
                    Transformar la forma en que se accede y utiliza la
                    información tributaria en República Dominicana, creando una
                    plataforma moderna, eficiente y accesible que beneficie a
                    toda la comunidad tecnológica y empresarial del país.
                </p>
            </div>

            <!-- Visión -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Nuestra Visión
                </h2>
                <p class="text-gray-700 mb-4">
                    Ser la plataforma de referencia para el acceso a información
                    tributaria en República Dominicana, facilitando la
                    innovación tecnológica y promoviendo la transparencia en el
                    sector tributario.
                </p>
            </div>

            <!-- Valores -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Nuestros Valores
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            🚀 Innovación
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Buscamos constantemente nuevas formas de mejorar y
                            optimizar nuestros servicios
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            🔒 Confiabilidad
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Garantizamos datos precisos y actualizados en todo
                            momento
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            🌐 Accesibilidad
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Nuestros servicios están disponibles para todos los
                            desarrolladores y empresas
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            🤝 Colaboración
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Trabajamos en conjunto con la comunidad para crear
                            soluciones mejores
                        </p>
                    </div>
                </div>
            </div>

            <!-- Equipo -->
            <div class="mb-8 text-left">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Nuestro Equipo
                </h2>
                <p class="text-gray-700 mb-4">
                    Somos un equipo apasionado por la tecnología y comprometido
                    con el desarrollo de soluciones que generen un impacto
                    positivo en la sociedad dominicana.
                </p>
                <p class="text-gray-700">
                    Nuestro objetivo es continuar innovando y mejorando nuestros
                    servicios para satisfacer las necesidades cambiantes de
                    nuestros usuarios.
                </p>
            </div>

            <!-- Contacto -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    ¿Tienes alguna pregunta?
                </h2>
                <p class="text-gray-700 mb-4">
                    Estamos aquí para ayudarte. Si tienes alguna consulta sobre
                    nuestros servicios o quieres colaborar con el proyecto, no
                    dudes en contactarnos.
                </p>
                <div class="flex justify-center space-x-4">
                    <a
                        href="mailto:contacto@dgii-api.com"
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
        <footer class="mt-8 text-gray-400 text-sm">
            Proyecto open source &copy; 2024 - Desarrollado por tu equipo
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>
