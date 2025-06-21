<template>
    <Head title="Documentation" />
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
                        class="text-red-600 font-medium transition"
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

        <!-- Contenido principal con sidebar -->
        <div class="flex w-full max-w-7xl mt-16 mb-8">
            <!-- Sidebar -->
            <div class="w-64 flex-shrink-0 mr-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Contenido
                    </h3>
                    <nav class="space-y-2">
                        <a
                            href="#introduccion"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            Introducción
                        </a>
                        <a
                            href="#por-que-desarrollada"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            ¿Por qué fue desarrollada?
                        </a>
                        <a
                            href="#caracteristicas"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            Características Principales
                        </a>
                        <a
                            href="#endpoints"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            Endpoints de la API
                        </a>
                        <a
                            href="#busqueda-rnc"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition ml-3"
                        >
                            • Búsqueda RNC
                        </a>
                        <a
                            href="#busqueda-nombre"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition ml-3"
                        >
                            • Búsqueda por Nombre
                        </a>
                        <a
                            href="#tipos-respuestas"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            Tipos de Respuestas
                        </a>
                        <a
                            href="#respuesta-exitosa"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition ml-3"
                        >
                            • Respuesta Exitosa
                        </a>
                        <a
                            href="#respuesta-error"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition ml-3"
                        >
                            • Respuesta de Error
                        </a>
                        <a
                            href="#codigos-estado"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition ml-3"
                        >
                            • Códigos de Estado
                        </a>
                        <a
                            href="#ejemplos-integracion"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            Ejemplos de Integración
                        </a>
                        <a
                            href="#informacion-adicional"
                            class="block px-3 py-2 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                        >
                            Información Adicional
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="flex-1">
                <div class="bg-white rounded-2xl shadow-lg p-10 text-center">
                    <h1
                        id="introduccion"
                        class="text-3xl font-bold mb-2 text-gray-900"
                    >
                        Bienvenido a la Documentación de la API DGII
                    </h1>
                    <p class="text-gray-500 mb-6">
                        Esta aplicación provee una API moderna para consultar
                        información tributaria y de RNC en República Dominicana.
                    </p>

                    <!-- Por qué fue desarrollada -->
                    <div id="por-que-desarrollada" class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            ¿Por qué fue desarrollada esta API?
                        </h2>
                        <div class="space-y-4 text-gray-700">
                            <p>
                                La API DGII nació de la necesidad de modernizar
                                y simplificar el acceso a la información
                                tributaria en República Dominicana.
                                Tradicionalmente, consultar datos del RNC
                                (Registro Nacional de Contribuyentes) requería
                                procesos manuales, tiempos de espera prolongados
                                y acceso limitado a la información actualizada.
                            </p>
                            <p>
                                <strong
                                    >Nuestros objetivos principales
                                    incluyen:</strong
                                >
                            </p>
                            <ul class="list-disc list-inside space-y-2 ml-4">
                                <li>
                                    <strong>Automatización:</strong> Eliminar
                                    procesos manuales y reducir el tiempo de
                                    consulta de información tributaria de horas
                                    a segundos.
                                </li>
                                <li>
                                    <strong>Accesibilidad:</strong> Proporcionar
                                    acceso 24/7 a datos actualizados del RNC
                                    para desarrolladores, empresas y sistemas
                                    integrados.
                                </li>
                                <li>
                                    <strong>Estandarización:</strong> Crear un
                                    formato consistente y estructurado para la
                                    información tributaria que facilite la
                                    integración con diferentes sistemas.
                                </li>
                                <li>
                                    <strong>Transparencia:</strong> Facilitar la
                                    verificación de información tributaria de
                                    manera rápida y confiable.
                                </li>
                                <li>
                                    <strong>Innovación:</strong> Impulsar el
                                    desarrollo de nuevas aplicaciones y
                                    servicios que aprovechen los datos
                                    tributarios de manera eficiente.
                                </li>
                            </ul>
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

                    <!-- Características -->
                    <div id="caracteristicas" class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            Características Principales
                        </h2>
                        <ul class="space-y-2">
                            <li class="flex items-center gap-2 text-gray-700">
                                <span>🔍</span> Búsqueda avanzada de RNC y
                                contribuyentes
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <span>📄</span> Documentación clara y ejemplos
                                de uso
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <span>⚡</span> Respuestas rápidas y eficientes
                            </li>
                            <li class="flex items-center gap-2 text-gray-700">
                                <span>🚀</span> Integración sencilla con tus
                                sistemas
                            </li>
                        </ul>
                    </div>

                    <!-- ENDPOINTS -->
                    <div id="endpoints" class="mb-12 text-left">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
                            Endpoints de la API
                        </h2>

                        <!-- Sección de Búsqueda RNC -->
                        <div id="busqueda-rnc" class="mb-8">
                            <h3
                                class="text-xl font-semibold mb-4 text-gray-800"
                            >
                                Búsqueda de RNC
                            </h3>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4
                                    class="text-lg font-medium mb-3 text-gray-700"
                                >
                                    GET /api/v1/rnc/{numero}
                                </h4>
                                <p class="text-gray-600 mb-4">
                                    Consulta información de un RNC específico.
                                </p>

                                <h5 class="font-semibold mb-2 text-gray-700">
                                    Parámetros:
                                </h5>
                                <ul
                                    class="list-disc list-inside mb-4 text-gray-600"
                                >
                                    <li>
                                        numero: Número de RNC a consultar
                                        (requerido)
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
                        <div id="busqueda-nombre" class="mb-8">
                            <h3
                                class="text-xl font-semibold mb-4 text-gray-800"
                            >
                                Búsqueda por Nombre
                            </h3>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4
                                    class="text-lg font-medium mb-3 text-gray-700"
                                >
                                    GET /api/v1/search
                                </h4>
                                <p class="text-gray-600 mb-4">
                                    Busca contribuyentes por nombre o razón
                                    social.
                                </p>

                                <h5 class="font-semibold mb-2 text-gray-700">
                                    Parámetros de consulta:
                                </h5>
                                <ul
                                    class="list-disc list-inside mb-4 text-gray-600"
                                >
                                    <li>q: Término de búsqueda (requerido)</li>
                                    <li>
                                        page: Número de página (opcional,
                                        default: 1)
                                    </li>
                                    <li>
                                        per_page: Resultados por página
                                        (opcional, default: 10)
                                    </li>
                                </ul>

                                <h5 class="font-semibold mb-2 text-gray-700">
                                    Ejemplo de uso:
                                </h5>
                                <pre
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                                >
GET /api/v1/search?q=empresa&page=1&per_page=20</pre
                                >
                            </div>
                        </div>
                    </div>

                    <!-- TIPOS DE RESPUESTAS -->
                    <div id="tipos-respuestas" class="mb-12 text-left">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
                            Tipos de Respuestas
                        </h2>

                        <!-- Respuesta Exitosa -->
                        <div id="respuesta-exitosa" class="mb-8">
                            <h3
                                class="text-xl font-semibold mb-4 text-gray-800"
                            >
                                Respuesta Exitosa
                            </h3>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4
                                    class="text-lg font-medium mb-3 text-gray-700"
                                >
                                    Estructura
                                </h4>
                                <pre
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
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
}</pre
                                >
                            </div>
                        </div>

                        <!-- Respuesta de Error -->
                        <div id="respuesta-error" class="mb-8">
                            <h3
                                class="text-xl font-semibold mb-4 text-gray-800"
                            >
                                Respuesta de Error
                            </h3>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4
                                    class="text-lg font-medium mb-3 text-gray-700"
                                >
                                    Estructura
                                </h4>
                                <pre
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                                >
{
    "success": false,
    "error": {
        "code": "RNC_NOT_FOUND",
        "message": "El RNC especificado no existe",
        "details": "No se encontró ningún registro con el RNC 123456789"
    }
}</pre
                                >
                            </div>
                        </div>

                        <!-- Códigos de Estado HTTP -->
                        <div id="codigos-estado" class="mb-8">
                            <h3
                                class="text-xl font-semibold mb-4 text-gray-800"
                            >
                                Códigos de Estado HTTP
                            </h3>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-green-600 mr-2"
                                            >200 OK:</span
                                        >
                                        <span class="text-gray-600"
                                            >La solicitud se procesó
                                            correctamente</span
                                        >
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-yellow-600 mr-2"
                                            >400 Bad Request:</span
                                        >
                                        <span class="text-gray-600"
                                            >La solicitud contiene parámetros
                                            inválidos</span
                                        >
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-red-600 mr-2"
                                            >404 Not Found:</span
                                        >
                                        <span class="text-gray-600"
                                            >El recurso solicitado no
                                            existe</span
                                        >
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-red-600 mr-2"
                                            >500 Internal Server Error:</span
                                        >
                                        <span class="text-gray-600"
                                            >Error interno del servidor</span
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Ejemplos de Integración -->
                    <div id="ejemplos-integracion" class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            Ejemplos de Integración
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-gray-700 mb-3">
                                    JavaScript (Fetch)
                                </h3>
                                <pre
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                                >
fetch('/api/v1/rnc/123456789')
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error(error));</pre
                                >
                            </div>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="font-semibold text-gray-700 mb-3">
                                    PHP (cURL)
                                </h3>
                                <pre
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                                >
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 
    'https://api.dgii.com/api/v1/rnc/123456789');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);</pre
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div id="informacion-adicional" class="mb-8 text-left">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            Información Adicional
                        </h2>
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg
                                        class="h-5 w-5 text-blue-400"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Nota:</strong> Esta API está en
                                        desarrollo activo. Para obtener la
                                        información más actualizada sobre nuevos
                                        endpoints y funcionalidades, consulta
                                        regularmente esta documentación.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
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
