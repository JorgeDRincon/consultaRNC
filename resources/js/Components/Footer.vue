<template>
    <footer class="bg-white border-t border-gray-200 w-full mt-auto">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div
                class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600"
            >
                <!-- Créditos -->
                <div class="text-center font-medium">
                    Desarrollado por
                    <a
                        href="https://www.linkedin.com/in/jorgerincon-dev/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-gray-600 hover:text-primary-600 hover:underline transition-colors duration-200"
                    >
                        Jorge D. Rincón
                    </a>
                    y
                    <a
                        href="https://www.linkedin.com/in/sherlingdev/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-gray-600 hover:text-primary-600 hover:underline transition-colors duration-200"
                    >
                        Sherling Rodriguez
                    </a>
                </div>

                <!-- Enlaces útiles -->
                <div class="flex justify-center mt-2">
                    <a
                        href="https://dgii.gov.do"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center space-x-1 text-gray-500 hover:text-primary-600 transition border-solid border-slate-400 border-l-2 pl-2"
                    >
                        <span>DGII</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-external-link"
                        >
                            <path d="M15 3h6v6" />
                            <path d="M10 14 21 3" />
                            <path
                                d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"
                            />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Legal -->
            <div class="text-center text-gray-500 text-sm mt-2">
                © 2025 ConsultaRNC – Todos los derechos reservados
            </div>
            <div class="text-center text-gray-400 text-xs">
                Esta plataforma es de uso informativo y no tiene relación
                oficial con la DGII.
            </div>
        </div>
    </footer>
</template>
