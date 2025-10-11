<template>
    <Head :title="$t('documentation.title')" />
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-slate-50 to-slate-200 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300"
    >
        <!-- Header con navegación -->
        <Navigation />

        <!-- Contenido principal con sidebar -->
        <div
            class="flex w-full max-w-7xl mt-32 mb-8 mx-auto flex-1 px-4 lg:px-0"
        >
            <!-- Sidebar - Hidden on mobile, visible on large screens -->
            <div class="hidden lg:block w-64 flex-shrink-0 lg:mr-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/20 p-6 sticky top-8 transition-colors duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        {{ $t('documentation.content') }}
                    </h3>
                    <nav class="space-y-2">
                        <div>
                            <a
                                href="#url-base"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'url-base'
                                        ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                ]"
                            >
                                {{ $t('documentation.base_url') }}
                            </a>
                        </div>
                        <div>
                            <a
                                href="#busqueda-rnc"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'busqueda-rnc'
                                        ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                ]"
                            >
                                {{ $t('forms.rnc_search') }}
                            </a>
                            <!-- Sub-opciones de parámetros -->
                            <div class="ml-4 mt-2 space-y-1">
                                <a
                                    href="#param-rnc"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-rnc'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.rnc_param') }}
                                </a>
                                <a
                                    href="#param-business-name"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-business-name'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.business_name_param') }}
                                </a>
                                <a
                                    href="#param-economic-activity"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection ===
                                            'param-economic-activity'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.economic_activity_param') }}
                                </a>
                                <a
                                    href="#param-status"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-status'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.status_param') }}
                                </a>
                                <a
                                    href="#param-payment-regime"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-payment-regime'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.payment_regime_param') }}
                                </a>
                                <a
                                    href="#param-start-date"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'param-start-date'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.start_date_param') }}
                                </a>
                                <a
                                    href="#ejemplos-uso"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'ejemplos-uso'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.usage_examples') }}
                                </a>
                                <a
                                    href="#ejemplos-combinaciones"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection ===
                                            'ejemplos-combinaciones'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.combination_examples') }}
                                </a>
                            </div>
                        </div>

                        <div>
                            <a
                                href="#tipos-respuestas"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'tipos-respuestas'
                                        ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                ]"
                            >
                                {{ $t('documentation.response_format_title') }}
                            </a>
                            <!-- Sub-opciones de tipos de respuestas -->
                            <div class="ml-4 mt-2 space-y-1">
                                <a
                                    href="#respuesta-exitosa"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'respuesta-exitosa'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.successful_response') }}
                                </a>
                                <a
                                    href="#codigos-estado"
                                    :class="[
                                        'block px-3 py-2 text-sm rounded transition',
                                        activeSection === 'codigos-estado'
                                            ? 'text-blue-600 bg-blue-50 font-medium dark:bg-blue-900/20 dark:text-blue-400'
                                            : 'text-gray-500 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                    ]"
                                >
                                    • {{ $t('documentation.status_codes') }}
                                </a>
                            </div>
                        </div>

                        <div>
                            <a
                                href="#ejemplos-integracion"
                                :class="[
                                    'block px-3 py-2 text-sm rounded-lg transition font-medium',
                                    activeSection === 'ejemplos-integracion'
                                        ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400'
                                        : 'text-gray-600 hover:text-blue-600 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-400 dark:hover:bg-blue-900/10',
                                ]"
                            >
                                {{ $t('documentation.integration_examples') }}
                            </a>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="flex-1 w-full">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/20 p-6 lg:p-10 text-center transition-colors duration-300"
                >
                    <h1
                        id="introduccion"
                        class="text-2xl lg:text-3xl font-bold mb-2 text-gray-900 dark:text-white"
                    >
                        {{ $t('documentation.title') }}
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        {{ $t('documentation.subtitle') }}<span>📚</span>
                    </p>

                    <!-- URL Base -->
                    <div id="url-base" class="mb-12 text-left">
                        <h2
                            class="text-xl lg:text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200"
                        >
                            {{ $t('documentation.base_url_title') }}
                        </h2>
                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-400 dark:border-blue-500 p-4 lg:p-6 rounded-lg transition-colors duration-300"
                        >
                            <div class="flex items-start">
                                <div class="w-full">
                                    <p
                                        class="text-gray-700 dark:text-gray-300 mb-2 text-sm lg:text-base"
                                    >
                                        {{ $t('documentation.base_url_description') }}
                                    </p>
                                    <div
                                        class="flex flex-col sm:flex-row items-start sm:items-center gap-2"
                                    >
                                        <code
                                            class="text-blue-700 dark:text-blue-300 font-mono text-xs lg:text-sm bg-white dark:bg-gray-800 px-3 py-2 rounded-lg shadow-sm dark:shadow-gray-900/20 flex-1 break-all transition-colors duration-300"
                                        >
                                            https://consultarnc.com.do/api/search?
                                        </code>
                                        <button
                                            class="bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 p-2 rounded-lg shadow-sm dark:shadow-gray-900/20 transition-colors duration-200 flex items-center justify-center flex-shrink-0"
                                            :title="$t('documentation.copy_url')"
                                            @click="copyBaseUrl"
                                        >
                                            <i class="fa-regular fa-copy" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Búsqueda Avanzada RNC -->
                    <div id="busqueda-rnc" class="mb-12 text-left">
                        <h2
                            class="text-xl lg:text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200"
                        >
                            {{ $t('documentation.advanced_search_title') }}
                        </h2>
                        <!-- Leyenda de Badges con FeatureCard -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <FeatureCard
                                :title="$t('documentation.exact_search')"
                                :description="$t('documentation.exact_search_description')"
                                fa-icon="fa-solid fa-crosshairs"
                                color="red"
                            />
                            <FeatureCard
                                :title="$t('documentation.partial_search')"
                                :description="$t('documentation.partial_search_description')"
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
                                example="/api/search?rnc=123456789"
                                :is-exact="true"
                            />

                            <ParamCard
                                param-id="param-business-name"
                                type="string"
                                name="business_name"
                                description="Nombre o razón social de la empresa (búsqueda parcial)"
                                example="/api/search?business_name=empresa"
                                :is-exact="false"
                            />

                            <ParamCard
                                param-id="param-economic-activity"
                                type="string"
                                name="economic_activity"
                                description="Actividad económica del contribuyente (búsqueda parcial)"
                                example="/api/search?economic_activity=comercio"
                                :is-exact="false"
                            />

                            <ParamCard
                                param-id="param-status"
                                type="string"
                                name="status"
                                description="Estado del contribuyente (ej: Activo, Inactivo, Cancelado)"
                                example="/api/search?status=Activo"
                                :is-exact="true"
                            />

                            <ParamCard
                                param-id="param-payment-regime"
                                type="string"
                                name="payment_regime"
                                description="Régimen de pago (ej: General, Pequeño Contribuyente)"
                                example="/api/search?payment_regime=General"
                                :is-exact="true"
                            />

                            <ParamCard
                                param-id="param-start-date"
                                type="date | array"
                                name="start_date"
                                description="Fecha de inicio de operaciones. Puedes enviar un único valor (YYYY-MM-DD) para coincidencia exacta o un arreglo de dos fechas [desde, hasta] para filtrar por rango."
                                example="/api/search?start_date[]=2020-01-01&start_date[]=2024-12-31"
                                :is-exact="true"
                            />
                        </div>

                        <h5
                            id="ejemplos-uso"
                            class="font-semibold mb-2 mt-6 text-gray-700 dark:text-gray-300"
                        >
                            {{ $t('documentation.usage_examples') }}:
                        </h5>
                        <div class="space-y-2">
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_by_name') }}
                                </h6>
                                <code
                                    class="text-zinc-900 dark:text-gray-200 font-mono text-xs lg:text-sm break-all"
                                >
                                    GET /api/search?<span class="font-semibold">business_name</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">empresa</span>
                                </code>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_by_rnc') }}
                                </h6>
                                <code
                                    class="text-zinc-900 dark:text-gray-200 font-mono text-xs lg:text-sm break-all"
                                >
                                    GET /api/search?<span class="font-semibold">rnc</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">123456789</span>
                                </code>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_by_activity') }}
                                </h6>
                                <code
                                    class="text-zinc-900 dark:text-gray-200 font-mono text-xs lg:text-sm break-all"
                                >
                                    GET /api/search?<span class="font-semibold">economic_activity</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">comercio</span>
                                </code>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_with_filters') }}
                                </h6>
                                <code
                                    class="text-zinc-900 dark:text-gray-200 font-mono text-xs lg:text-sm break-all"
                                >
                                    GET /api/search?<span class="font-semibold">status</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">Activo</span>&<span class="font-semibold">payment_regime</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">General</span>
                                </code>
                            </div>
                        </div>

                        <h5
                            id="ejemplos-combinaciones"
                            class="font-semibold mb-2 text-gray-700 dark:text-gray-300 mt-6"
                        >
                            {{ $t('documentation.combination_examples') }}:
                        </h5>
                        <div class="space-y-2">
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_active_by_name') }}
                                </h6>
                                <code class="text-zinc-900 dark:text-gray-200 font-mono text-sm">
                                    GET /api/search?<span class="font-semibold">business_name</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">empresa</span>&<span class="font-semibold">status</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">Activo</span>
                                </code>
                                <p class="text-gray-600 dark:text-gray-300 text-xs mt-1">
                                    {{ $t('documentation.search_active_with_name') }}
                                </p>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_commerce_general') }}
                                </h6>
                                <code class="text-zinc-900 dark:text-gray-200 font-mono text-sm">
                                    GET /api/search?<span class="font-semibold">economic_activity</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">comercio</span>&<span class="font-semibold">payment_regime</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">General</span>
                                </code>
                                <p class="text-gray-600 dark:text-gray-300 text-xs mt-1">
                                    {{ $t('documentation.search_commerce_with_regime') }}
                                </p>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
                            >
                                <h6
                                    class="text-sm font-medium text-gray-700 dark:text-gray-100 mb-2"
                                >
                                    {{ $t('documentation.search_active_by_date') }}
                                </h6>
                                <code class="text-zinc-900 dark:text-gray-200 font-mono text-sm">
                                    GET /api/search?<span class="font-semibold">start_date[]</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">2020-01-01</span>&<span class="font-semibold">start_date[]</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">2024-12-31</span>&<span class="font-semibold">status</span>=<span class="text-red-600 dark:text-blue-300 font-semibold">Activo</span>
                                </code>
                                <p class="text-gray-600 dark:text-gray-300 text-xs mt-1">
                                    {{ $t('documentation.search_active_by_range') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- TIPOS DE RESPUESTAS -->
                    <div id="tipos-respuestas" class="mb-12 text-left">
                        <h2
                            class="text-xl lg:text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200"
                        >
                            {{ $t('documentation.response_format_title') }}
                        </h2>

                        <!-- Respuesta Exitosa -->
                        <div id="respuesta-exitosa" class="mb-8">
                            <h3
                                class="text-lg lg:text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200"
                            >
                                {{ $t('documentation.successful_response') }}
                            </h3>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 lg:p-6 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors duration-300">
                                <h4
                                    class="text-base lg:text-lg font-medium mb-3 text-gray-700 dark:text-gray-200"
                                >
                                    {{ $t('documentation.structure') }}
                                </h4>
                                <pre
                                    class="bg-gray-800 dark:bg-gray-800 text-gray-100 dark:text-gray-100 p-4 rounded-lg overflow-x-auto text-xs lg:text-sm"
                                >
{
    "{{ $t('documentation.json_keys.message') }}": "{{ $t('documentation.json_values.search_completed') }}",
    "{{ $t('documentation.json_keys.pages') }}": 5,
    "{{ $t('documentation.json_keys.next') }}": "https://consultarnc.com.do/api/search?page=2",
    "{{ $t('documentation.json_keys.prev') }}": null,
    "{{ $t('documentation.json_keys.total') }}": 450,
    "{{ $t('documentation.json_keys.data') }}": [
        {
            "rnc": "123456789",
            "nombre": "Empresa Ejemplo S.A.",
            "tipo": "Persona Jurídica",
            "estado": "Activo",
            "actividad_economica": "Comercio al por menor",
            "regimen_pago": "General",
            "fecha_inicio": "2020-01-15"
        },
        {
            "rnc": "987654321",
            "nombre": "Comercial ABC",
            "tipo": "Persona Jurídica", 
            "estado": "Activo",
            "actividad_economica": "Servicios profesionales",
            "regimen_pago": "Pequeño Contribuyente",
            "fecha_inicio": "2021-03-10"
        }
        // {{ $t('documentation.more_records') }}
    ]
}</pre>
                                <div class="mt-4 space-y-3">
                                    <h4
                                        class="text-base lg:text-lg font-medium mb-3 text-gray-700 dark:text-gray-200"
                                    >
                                        {{ $t('documentation.field_description') }}
                                    </h4>
                                    <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-gray-600">
                                        <table
                                            class="min-w-full bg-white dark:bg-gray-800"
                                        >
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600"
                                                    >
                                                        {{ $t('documentation.field') }}
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600"
                                                    >
                                                        {{ $t('documentation.data_type') }}
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600"
                                                    >
                                                        {{ $t('documentation.description') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600"
                                            >
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <code
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded"
                                                        >message</code>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700"
                                                        >
                                                            string
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                                    >
                                                        {{ $t('documentation.message_field') }}
                                                    </td>
                                                </tr>
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <code
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded"
                                                        >pages</code>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700"
                                                        >
                                                            number
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                                    >
                                                        {{ $t('documentation.pages_field') }}
                                                    </td>
                                                </tr>
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <code
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded"
                                                        >next</code>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700"
                                                        >
                                                            string | null
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                                    >
                                                        {{ $t('documentation.next_field') }}
                                                    </td>
                                                </tr>
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <code
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded"
                                                        >prev</code>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700"
                                                        >
                                                            string | null
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                                    >
                                                        {{ $t('documentation.prev_field') }}
                                                    </td>
                                                </tr>
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <code
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded"
                                                        >total</code>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700"
                                                        >
                                                            number
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                                    >
                                                        {{ $t('documentation.total_field') }}
                                                    </td>
                                                </tr>
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <code
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded"
                                                        >data</code>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700"
                                                        >
                                                            array
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                                    >
                                                        {{ $t('documentation.data_field') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Códigos de Estado HTTP -->
                        <div id="codigos-estado" class="mb-8">
                            <h3
                                class="text-lg lg:text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200"
                            >
                                {{ $t('documentation.status_codes') }}
                            </h3>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 lg:p-6 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors duration-300">
                                <ul class="space-y-4">
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-green-600 dark:text-green-400 mr-2"
                                        >200 OK:</span>
                                        <span class="text-gray-600 dark:text-gray-300">{{ $t('documentation.http_200') }}</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-yellow-600 dark:text-yellow-400 mr-2"
                                        >400 Bad Request:</span>
                                        <span class="text-gray-600 dark:text-gray-300">{{ $t('documentation.http_400') }}</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-red-600 dark:text-red-400 mr-2"
                                        >404 Not Found:</span>
                                        <span class="text-gray-600 dark:text-gray-300">{{ $t('documentation.http_404') }}</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="font-semibold text-red-600 dark:text-red-400 mr-2"
                                        >500 Internal Server Error:</span>
                                        <span class="text-gray-600 dark:text-gray-300">{{ $t('documentation.http_500') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Ejemplos de Integración -->
                    <div id="ejemplos-integracion" class="mb-8 text-left">
                        <h2
                            class="text-xl lg:text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200"
                        >
                            {{ $t('documentation.integration_examples') }}
                        </h2>
                        <div class="space-y-6">
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 lg:p-6 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors duration-300">
                                <h3
                                    class="font-semibold text-gray-700 dark:text-gray-200 mb-3 text-sm lg:text-base"
                                >
                                    {{ $t('documentation.javascript_example') }}
                                </h3>
                                <div
                                    class="bg-gray-800 dark:bg-gray-800 text-gray-100 dark:text-gray-100 p-3 lg:p-4 rounded-lg overflow-x-auto text-xs lg:text-sm"
                                >
                                    <div class="mb-2">
                                        <span
                                            class="text-green-400 font-semibold"
                                        >fetch</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300 font-mono">'<span class="text-blue-200">https://consultarnc.com.do/api/search?<span
                                            class="text-blue-400 font-semibold"
                                        >business_name</span>=<span class="text-blue-300">empresa</span></span>'</span>
                                        <span class="text-yellow-400">)</span>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-purple-400">.then</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">response</span>
                                        <span class="text-yellow-400"> =></span>
                                        <span class="text-blue-300">
                                            response</span>
                                        <span class="text-yellow-400">.</span>
                                        <span class="text-purple-400">json</span>
                                        <span class="text-yellow-400">())</span>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-purple-400">.then</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">data</span>
                                        <span class="text-yellow-400"> =></span>
                                        <span class="text-purple-400">
                                            console</span>
                                        <span class="text-yellow-400">.</span>
                                        <span class="text-purple-400">log</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">data</span>
                                        <span class="text-yellow-400">))</span>
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-purple-400">.catch</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">error</span>
                                        <span class="text-yellow-400"> =></span>
                                        <span class="text-purple-400">
                                            console</span>
                                        <span class="text-yellow-400">.</span>
                                        <span class="text-red-400">error</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-blue-300">error</span>
                                        <span class="text-yellow-400">));</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 lg:p-6 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors duration-300">
                                <h3
                                    class="font-semibold text-gray-700 dark:text-gray-200 mb-3 text-sm lg:text-base"
                                >
                                    {{ $t('documentation.php_example') }}
                                </h3>
                                <div
                                    class="bg-gray-800 dark:bg-gray-800 text-gray-100 dark:text-gray-100 p-3 lg:p-4 rounded-lg overflow-x-auto text-xs lg:text-sm"
                                >
                                    <div class="mb-2">
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400"> =</span>
                                        <span class="text-green-400">
                                            curl_init</span>
                                        <span class="text-yellow-400">();</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-green-400">curl_setopt</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-blue-300">
                                            CURLOPT_URL</span>
                                        <span class="text-yellow-400">,</span>
                                    </div>
                                    <div class="ml-4 mb-2">
                                        <span class="text-blue-200 font-mono">'https://consultarnc.com.do/api/search?<span
                                            class="text-blue-400 font-semibold"
                                        >rnc</span>=<span class="text-blue-300">123456789</span>'</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-green-400">curl_setopt</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-blue-300">
                                            CURLOPT_RETURNTRANSFER</span>
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-green-400">
                                            true</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-purple-400">$response</span>
                                        <span class="text-yellow-400"> =</span>
                                        <span class="text-green-400">
                                            curl_exec</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-green-400">curl_close</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$ch</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                    <div>
                                        <span class="text-purple-400">$data</span>
                                        <span class="text-yellow-400"> =</span>
                                        <span class="text-green-400">
                                            json_decode</span>
                                        <span class="text-yellow-400">(</span>
                                        <span class="text-purple-400">$response</span>
                                        <span class="text-yellow-400">,</span>
                                        <span class="text-green-400">
                                            true</span>
                                        <span class="text-yellow-400">);</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div id="informacion-adicional" class="mb-8 text-left">
                        <h2
                            class="text-xl lg:text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200"
                        >
                            {{ $t('documentation.additional_info') }}
                        </h2>
                        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-400 dark:border-blue-500 p-4 rounded-lg transition-colors duration-300">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg
                                        class="h-5 w-5 text-blue-400 dark:text-blue-500"
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
                                    <p class="text-sm text-blue-700 dark:text-blue-300">
                                        <strong>{{ $t('documentation.note_label') }}</strong> {{ $t('documentation.note') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer />

        <!-- Toast notification -->
        <div
            v-if="showToast"
            class="fixed top-4 left-4 right-4 sm:left-1/2 sm:right-auto sm:transform sm:-translate-x-1/2 sm:w-auto bg-blue-500 text-white px-4 lg:px-6 py-3 lg:py-4 rounded-lg shadow-lg z-50 flex items-center gap-2 transition-all duration-300"
        >
            <i class="fa-solid fa-check flex-shrink-0" />
            <span class="text-sm lg:text-base">{{ $t('documentation.url_copied') }}</span>
        </div>
    </div>
    
    <!-- Scroll to Top Button -->
    <ScrollToTop />
</template>

<script setup lang="ts">
import FeatureCard from '@/Components/FeatureCard.vue'
import Footer from '@/Components/Footer.vue'
import Navigation from '@/Components/Navigation.vue'
import ScrollToTop from '@/Components/ScrollToTop.vue'
import ParamCard from '@/Components/ParamCard.vue'
import { Head } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const activeSection = ref<string>('busqueda-rnc')

// Copiar URL base al portapapeles
const showToast = ref<boolean>(false)

const copyBaseUrl = (): void => {
    navigator.clipboard
        .writeText('https://consultarnc.com.do/api/search?')
        .then(() => {
            showToast.value = true
            setTimeout(() => {
                showToast.value = false
            }, 2000)
        })
        .catch(() => {
            // En caso de error, mantener funcionalidad básica
            alert('No se pudo copiar la URL')
        })
}

const sections: string[] = [
    'url-base',
    'busqueda-rnc',
    'param-rnc',
    'param-business-name',
    'param-economic-activity',
    'param-status',
    'param-payment-regime',
    'param-start-date',
    'ejemplos-uso',
    'ejemplos-combinaciones',
    'tipos-respuestas',
    'respuesta-exitosa',
    'respuesta-error',
    'codigos-estado',
    'ejemplos-integracion',
    'informacion-adicional'
]

const updateActiveSection = (): void => {
    const scrollPosition = window.scrollY + 50 // Offset for header

    // Check parameter subsections first (they have priority when within their bounds)
    const paramSections = sections.filter((section: string) =>
        section.startsWith('param-')
    )
    for (let i = paramSections.length - 1; i >= 0; i--) {
        const section = document.getElementById(paramSections[i])
        if (section) {
            const sectionTop = section.offsetTop
            const sectionHeight = section.offsetHeight

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                activeSection.value = paramSections[i]
                return
            }
        }
    }

    // Check response type subsections
    const responseSections: string[] = [
        'respuesta-exitosa',
        'respuesta-error',
        'codigos-estado'
    ]
    for (let i = responseSections.length - 1; i >= 0; i--) {
        const section = document.getElementById(responseSections[i])
        if (section) {
            const sectionTop = section.offsetTop
            const sectionHeight = section.offsetHeight

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                activeSection.value = responseSections[i]
                return
            }
        }
    }

    // If no parameter or response section is active, check main sections
    const mainSections = sections.filter(
        (section: string) =>
            !section.startsWith('param-') && !responseSections.includes(section)
    )
    for (let i = mainSections.length - 1; i >= 0; i--) {
        const section = document.getElementById(mainSections[i])
        if (section) {
            const sectionTop = section.offsetTop
            const sectionHeight = section.offsetHeight

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                activeSection.value = mainSections[i]
                break
            }
        }
    }
}

onMounted(() => {
    window.addEventListener('scroll', updateActiveSection)
    updateActiveSection() // Initial check
})

onUnmounted(() => {
    window.removeEventListener('scroll', updateActiveSection)
})
</script>
