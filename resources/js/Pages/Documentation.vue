<template>
    <Head title="Documentation" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200"
    >
        <!-- Header con navegación -->
        <Navigation />

        <!-- Contenido principal con sidebar -->
        <div class="flex w-full max-w-7xl mt-16 mb-8 mx-auto flex-1">
            <!-- Sidebar -->
            <div class="w-64 flex-shrink-0 mr-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Contenido
                    </h3>
                    <nav class="space-y-2">
                        <div>
                            <a
                                href="#busqueda-rnc"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'busqueda-rnc'
                                        ? 'text-blue-600 bg-blue-50'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50',
                                ]"
                            >
                                Búsqueda Avanzada RNC
                            </a>
                            <!-- Sub-opciones de parámetros -->
                            <div class="ml-4 mt-2 space-y-1">
                                <a
                                    href="#param-rnc"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-rnc'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • RNC
                                </a>
                                <a
                                    href="#param-business-name"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-business-name'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Nombre Comercial
                                </a>
                                <a
                                    href="#param-economic-activity"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection ===
                                        'param-economic-activity'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Actividad Económica
                                </a>
                                <a
                                    href="#param-status"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-status'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Estado
                                </a>
                                <a
                                    href="#param-payment-regime"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-payment-regime'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Régimen de Pago
                                </a>
                                <a
                                    href="#param-start-date"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-start-date'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Fecha de Inicio
                                </a>
                                <a
                                    href="#ejemplos-uso"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'ejemplos-uso'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Ejemplos de Uso
                                </a>
                                <a
                                    href="#ejemplos-combinaciones"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection ===
                                        'ejemplos-combinaciones'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Ejemplos de Combinaciones
                                </a>
                            </div>
                        </div>

                        <div>
                            <a
                                href="#tipos-respuestas"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'tipos-respuestas'
                                        ? 'text-blue-600 bg-blue-50'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50',
                                ]"
                            >
                                Tipos de Respuestas
                            </a>
                            <!-- Sub-opciones de tipos de respuestas -->
                            <div class="ml-4 mt-2 space-y-1">
                                <a
                                    href="#respuesta-exitosa"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'respuesta-exitosa'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Respuesta Exitosa
                                </a>
                                <a
                                    href="#respuesta-error"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'respuesta-error'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Respuesta de Error
                                </a>
                                <a
                                    href="#codigos-estado"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'codigos-estado'
                                            ? 'text-blue-600 bg-blue-50 font-medium'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50',
                                    ]"
                                >
                                    • Códigos de Estado
                                </a>
                            </div>
                        </div>

                        <div>
                            <a
                                href="#ejemplos-integracion"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'ejemplos-integracion'
                                        ? 'text-blue-600 bg-blue-50'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50',
                                ]"
                            >
                                Ejemplos de Integración
                            </a>
                        </div>
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
                        Documentación de ConsultaRNC
                    </h1>
                    <p class="text-gray-500 mb-6">
                        Guía completa para integrar y utilizar nuestra API de
                        consulta tributaria.
                    </p>

                    <!-- Búsqueda Avanzada RNC -->
                    <div id="busqueda-rnc" class="mb-12 text-left">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
                            Búsqueda Avanzada RNC
                        </h2>
                        <!-- Leyenda de Badges con FeatureCard -->
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <FeatureCard
                                title="Exacta"
                                description="Coincidencia 100&nbsp;% del valor enviado. El parámetro debe coincidir exactamente con el valor almacenado en la base de datos, sin mayúsculas/minúsculas extra ni espacios."
                                fa-icon="fa-solid fa-crosshairs"
                                color="red"
                            />
                            <FeatureCard
                                title="Parcial"
                                description="Búsqueda flexible (LIKE) que permite coincidencias parciales. El valor ingresado puede encontrarse en cualquier parte del texto almacenado, ideal para búsquedas por nombre o actividad."
                                fa-icon="fa-solid fa-magnifying-glass"
                                color="blue"
                            />
                        </div>
                        <div class="space-y-4">
                            <ParamCard
                                param-id="param-rnc"
                                type="string"
                                name="rnc"
                                description="Número de RNC específico del contribuyente"
                                example="/api/rnc/search?rnc=123456789"
                                :is-exact="true"
                            />

                            <ParamCard
                                param-id="param-business-name"
                                type="string"
                                name="business_name"
                                description="Nombre o razón social de la empresa (búsqueda parcial)"
                                example="/api/rnc/search?business_name=empresa"
                                :is-exact="false"
                            />

                            <ParamCard
                                param-id="param-economic-activity"
                                type="string"
                                name="economic_activity"
                                description="Actividad económica del contribuyente (búsqueda parcial)"
                                example="/api/rnc/search?economic_activity=comercio"
                                :is-exact="false"
                            />

                            <ParamCard
                                param-id="param-status"
                                type="string"
                                name="status"
                                description="Estado del contribuyente (ej: Activo, Inactivo, Cancelado)"
                                example="/api/rnc/search?status=Activo"
                                :is-exact="true"
                            />

                            <ParamCard
                                param-id="param-payment-regime"
                                type="string"
                                name="payment_regime"
                                description="Régimen de pago (ej: General, Pequeño Contribuyente)"
                                example="/api/rnc/search?payment_regime=General"
                                :is-exact="true"
                            />

                            <ParamCard
                                param-id="param-start-date"
                                type="date | array"
                                name="start_date"
                                description="Fecha de inicio de operaciones. Puedes enviar un único valor (YYYY-MM-DD) para coincidencia exacta o un arreglo de dos fechas \[desde, hasta\] para filtrar por rango."
                                example="/api/rnc/search?start_date[]=2020-01-01&start_date[]=2024-12-31"
                                :is-exact="true"
                            />
                        </div>

                        <h5
                            id="ejemplos-uso"
                            class="font-semibold mb-2 mt-6 text-gray-700"
                        >
                            Ejemplos de uso:
                        </h5>
                        <div class="space-y-2">
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda de empresas por nombre
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >business_name</span
                                    >=<span class="text-red-600 font-semibold"
                                        >empresa</span
                                    >
                                </code>
                            </div>
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda de contribuyente por RNC
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >rnc</span
                                    >=<span class="text-red-600 font-semibold"
                                        >123456789</span
                                    >
                                </code>
                            </div>
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda por actividad económica
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >economic_activity</span
                                    >=<span class="text-red-600 font-semibold"
                                        >comercio</span
                                    >
                                </code>
                            </div>
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda con múltiples filtros
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >status</span
                                    >=<span class="text-red-600 font-semibold"
                                        >Activo</span
                                    >&<span class="font-semibold"
                                        >payment_regime</span
                                    >=<span class="text-red-600 font-semibold"
                                        >General</span
                                    >
                                </code>
                            </div>
                        </div>

                        <h5
                            id="ejemplos-combinaciones"
                            class="font-semibold mb-2 text-gray-700 mt-6"
                        >
                            Ejemplos de combinaciones:
                        </h5>
                        <div class="space-y-2">
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda de empresas activas por nombre
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >business_name</span
                                    >=<span class="text-red-600 font-semibold"
                                        >empresa</span
                                    >&<span class="font-semibold">status</span
                                    >=<span class="text-red-600 font-semibold"
                                        >Activo</span
                                    >
                                </code>
                                <p class="text-gray-600 text-xs mt-1">
                                    Buscar empresas activas con "empresa" en el
                                    nombre
                                </p>
                            </div>
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda de comercios con régimen general
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >economic_activity</span
                                    >=<span class="text-red-600 font-semibold"
                                        >comercio</span
                                    >&<span class="font-semibold"
                                        >payment_regime</span
                                    >=<span class="text-red-600 font-semibold"
                                        >General</span
                                    >
                                </code>
                                <p class="text-gray-600 text-xs mt-1">
                                    Buscar comercios con régimen general
                                </p>
                            </div>
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 mb-2"
                                >
                                    Búsqueda de contribuyentes activos por rango
                                    de fechas
                                </h6>
                                <code class="text-zinc-900 font-mono text-sm">
                                    GET /api/rnc/search?<span
                                        class="font-semibold"
                                        >start_date_from</span
                                    >=<span class="text-red-600 font-semibold"
                                        >2020-01-01</span
                                    >&<span class="font-semibold"
                                        >start_date_to</span
                                    >=<span class="text-red-600 font-semibold"
                                        >2024-12-31</span
                                    >&<span class="font-semibold">status</span
                                    >=<span class="text-red-600 font-semibold"
                                        >Activo</span
                                    >
                                </code>
                                <p class="text-gray-600 text-xs mt-1">
                                    Buscar contribuyentes activos registrados
                                    entre 2020 y 2024
                                </p>
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
                            <div class="bg-gray-100 p-6 rounded-lg">
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
                            <div class="bg-gray-100 p-6 rounded-lg">
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
                            <div class="bg-gray-100 p-6 rounded-lg">
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
                        <div class="space-y-6">
                            <div class="bg-gray-100 p-6 rounded-lg">
                                <h3 class="font-semibold text-gray-700 mb-3">
                                    JavaScript (Fetch) - Búsqueda
                                </h3>
                                <div
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                                >
                                    <div class="mb-2">
                                        <span
                                            class="text-green-400 font-semibold"
                                            >fetch</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300 font-mono"
                                            >'<span class="text-blue-200"
                                                >https://consultarnc.com.do/api/rnc/search?<span
                                                    class="text-blue-400 font-semibold"
                                                    >business_name</span
                                                >=<span class="text-blue-300"
                                                    >empresa</span
                                                ></span
                                            >'</span
                                        >
                                        <span class="text-yellow-400">)</span>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-purple-400"
                                            >.then</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300"
                                            >response</span
                                        >
                                        <span class="text-yellow-400"> =></span>
                                        <span class="text-blue-300">
                                            response</span
                                        >
                                        <span class="text-yellow-400">.</span>
                                        <span class="text-purple-400"
                                            >json</span
                                        >
                                        <span class="text-yellow-400">())</span>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-purple-400"
                                            >.then</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">data</span>
                                        <span class="text-yellow-400"> =></span>
                                        <span class="text-purple-400">
                                            console</span
                                        >
                                        <span class="text-yellow-400">.</span>
                                        <span class="text-purple-400">log</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">data</span>
                                        <span class="text-yellow-400">))</span>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-purple-400"
                                            >.catch</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">error</span>
                                        <span class="text-yellow-400"> =></span>
                                        <span class="text-purple-400">
                                            console</span
                                        >
                                        <span class="text-yellow-400">.</span>
                                        <span class="text-red-400">error</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">error</span>
                                        <span class="text-yellow-400">));</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-6 rounded-lg">
                                <h3 class="font-semibold text-gray-700 mb-3">
                                    PHP (cURL) - Búsqueda
                                </h3>
                                <div
                                    class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"
                                >
                                    <div class="mb-2">
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400"> =</span>
                                        <span class="text-green-400">
                                            curl_init</span
                                        >
                                        <span class="text-yellow-400">();</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-green-400"
                                            >curl_setopt</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-blue-300">
                                            CURLOPT_URL</span
                                        >
                                        <span class="text-yellow-400">,</span>
                                    </div>
                                    <div class="ml-4 mb-2">
                                        <span class="text-blue-200 font-mono"
                                            >'https://consultarnc.com.do/api/rnc/search?<span
                                                class="text-blue-400 font-semibold"
                                                >rnc</span
                                            >=<span class="text-blue-300"
                                                >123456789</span
                                            >'</span
                                        >
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-green-400"
                                            >curl_setopt</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-blue-300">
                                            CURLOPT_RETURNTRANSFER</span
                                        >
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-green-400">
                                            true</span
                                        >
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-purple-400"
                                            >$response</span
                                        >
                                        <span class="text-yellow-400"> =</span>
                                        <span class="text-green-400">
                                            curl_exec</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-green-400"
                                            >curl_close</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div>
                                        <span class="text-purple-400"
                                            >$data</span
                                        >
                                        <span class="text-yellow-400"> =</span>
                                        <span class="text-green-400">
                                            json_decode</span
                                        >
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400"
                                            >$response</span
                                        >
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-green-400">
                                            true</span
                                        >
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                </div>
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
        <Footer />
    </div>
</template>

<script setup>
import FeatureCard from "@/Components/FeatureCard.vue"; // Added FeatureCard import
import Footer from "@/Components/Footer.vue";
import Navigation from "@/Components/Navigation.vue";
import ParamCard from "@/Components/ParamCard.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted, onUnmounted, ref } from "vue";

const activeSection = ref("busqueda-rnc");

const sections = [
    "busqueda-rnc",
    "param-rnc",
    "param-business-name",
    "param-economic-activity",
    "param-status",
    "param-payment-regime",
    "param-start-date",
    "ejemplos-uso",
    "ejemplos-combinaciones",
    "tipos-respuestas",
    "respuesta-exitosa",
    "respuesta-error",
    "codigos-estado",
    "ejemplos-integracion",
    "informacion-adicional",
];

const updateActiveSection = () => {
    const scrollPosition = window.scrollY + 50; // Offset for header

    // Check parameter subsections first (they have priority when within their bounds)
    const paramSections = sections.filter((section) =>
        section.startsWith("param-")
    );
    for (let i = paramSections.length - 1; i >= 0; i--) {
        const section = document.getElementById(paramSections[i]);
        if (section) {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                activeSection.value = paramSections[i];
                return;
            }
        }
    }

    // Check response type subsections
    const responseSections = [
        "respuesta-exitosa",
        "respuesta-error",
        "codigos-estado",
    ];
    for (let i = responseSections.length - 1; i >= 0; i--) {
        const section = document.getElementById(responseSections[i]);
        if (section) {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                activeSection.value = responseSections[i];
                return;
            }
        }
    }

    // If no parameter or response section is active, check main sections
    const mainSections = sections.filter(
        (section) =>
            !section.startsWith("param-") && !responseSections.includes(section)
    );
    for (let i = mainSections.length - 1; i >= 0; i--) {
        const section = document.getElementById(mainSections[i]);
        if (section) {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                activeSection.value = mainSections[i];
                break;
            }
        }
    }
};

onMounted(() => {
    window.addEventListener("scroll", updateActiveSection);
    updateActiveSection(); // Initial check
});

onUnmounted(() => {
    window.removeEventListener("scroll", updateActiveSection);
});
</script>
