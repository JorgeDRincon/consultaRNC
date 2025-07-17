<template>
    <footer class="bg-white border-t border-gray-200 w-full mt-auto">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center space-y-2">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between w-full text-gray-600 text-sm mb-2"
                >
                    <div class="mb-2 md:mb-0">
                        Desarrollado por Jorge Daniel Rincon Luciano
                    </div>
                    <div class="flex items-center space-x-4">
                        <a
                            href="https://www.linkedin.com/in/johanjavierg/"
                            target="_blank"
                            rel="noopener"
                            class="flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200"
                            title="LinkedIn"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-linkedin-icon lucide-linkedin"
                            >
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                                />
                                <rect width="4" height="12" x="2" y="9" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </a>
                        <span class="text-gray-300">|</span>
                        <a
                            href="https://dgii.gov.do"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-gray-500 hover:text-primary-600 transition-colors flex items-center text-sm font-medium"
                            aria-label="DGII República Dominicana"
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
                                class="lucide lucide-external-link ml-1"
                            >
                                <path d="M15 3h6v6"></path>
                                <path d="M10 14 21 3"></path>
                                <path
                                    d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="text-center text-gray-500 text-sm">
                    © 2025 ConsultaRNC – Todos los derechos reservados
                </div>
                <div class="text-center text-gray-400 text-xs">
                    Esta aplicación es solo para fines informativos.
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
// No props or logic needed for this simple footer component
</script>
