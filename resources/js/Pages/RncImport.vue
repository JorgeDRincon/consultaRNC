<template>
    <Head title="Importar RNCs" />

    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div
                    class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-8"
                >
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-12 w-12 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-3xl font-bold text-white">
                                Importar RNCs desde CSV
                            </h1>
                            <p class="mt-1 text-blue-100">
                                Sube tu archivo CSV para importar los datos de
                                RNC
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-6 py-8">
                    <!-- Success/Error Messages -->
                    <div
                        v-if="flash.success"
                        class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4"
                    >
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-5 w-5 text-green-400"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ flash.success }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="flash.error"
                        class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4"
                    >
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-5 w-5 text-red-400"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">
                                    {{ flash.error }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <form class="space-y-6" @submit.prevent="submitForm">
                        <!-- Upload Area -->
                        <div
                            class="relative border-2 border-dashed border-gray-300 rounded-lg p-12 text-center hover:border-blue-400 transition-colors duration-200"
                            :class="{
                                'border-blue-400 bg-blue-50': isDragOver,
                            }"
                            @dragover.prevent="isDragOver = true"
                            @dragleave.prevent="isDragOver = false"
                            @drop.prevent="handleFileDrop"
                            @click="$refs.fileInput.click()"
                        >
                            <div v-if="!selectedFile" class="space-y-4">
                                <svg
                                    class="mx-auto h-16 w-16 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                    />
                                </svg>
                                <div>
                                    <p
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Arrastra tu archivo CSV aquí
                                    </p>
                                    <p class="text-gray-500">
                                        o haz clic para seleccionar un archivo
                                    </p>
                                </div>
                                <button
                                    type="button"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                >
                                    <svg
                                        class="mr-2 h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"
                                        />
                                    </svg>
                                    Seleccionar archivo
                                </button>
                            </div>

                            <!-- File Info -->
                            <div v-else class="space-y-4">
                                <div class="flex items-center justify-center">
                                    <svg
                                        class="h-12 w-12 text-blue-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <p
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        {{ selectedFile.name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ formatFileSize(selectedFile.size) }}
                                    </p>
                                </div>
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    @click="removeFile"
                                >
                                    <svg
                                        class="mr-1 h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                    Cambiar archivo
                                </button>
                            </div>

                            <input
                                ref="fileInput"
                                type="file"
                                class="hidden"
                                accept=".csv"
                                @change="handleFileSelect"
                            />
                        </div>

                        <!-- Progress Bar -->
                        <div v-if="uploading" class="space-y-2">
                            <div
                                class="flex justify-between text-sm text-gray-600"
                            >
                                <span>Subiendo archivo...</span>
                                <span>{{ uploadProgress }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div
                                    class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                    :style="{ width: uploadProgress + '%' }"
                                />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center">
                            <button
                                type="submit"
                                :disabled="!selectedFile || uploading"
                                class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105"
                            >
                                <svg
                                    v-if="uploading"
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    />
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    class="mr-2 h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                    />
                                </svg>
                                {{
                                    uploading
                                        ? "Subiendo..."
                                        : "Subir e Importar"
                                }}
                            </button>
                        </div>
                    </form>

                    <!-- Information Card -->
                    <div
                        class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6"
                    >
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg
                                    class="h-6 w-6 text-blue-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-blue-800">
                                    Información importante
                                </h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>
                                            El archivo debe estar en formato CSV
                                        </li>
                                        <li>Tamaño máximo: 200MB</li>
                                        <li>
                                            La importación se realizará en
                                            segundo plano
                                        </li>
                                        <li>
                                            Recibirás una notificación cuando
                                            termine
                                        </li>
                                        <li>
                                            Asegúrate de que el archivo tenga el
                                            formato correcto
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

export default {
    components: {
        Head
    },
    props: {
        flash: {
            type: Object,
            default: () => ({})
        }
    },
    setup() {
        const selectedFile = ref(null)
        const isDragOver = ref(false)
        const uploading = ref(false)
        const uploadProgress = ref(0)
        const fileInput = ref(null)

        const handleFileSelect = (event) => {
            const file = event.target.files[0]
            if (file && validateFile(file)) {
                selectedFile.value = file
            }
        }

        const handleFileDrop = (event) => {
            isDragOver.value = false
            const files = event.dataTransfer.files
            if (files.length > 0) {
                const file = files[0]
                if (validateFile(file)) {
                    selectedFile.value = file
                }
            }
        }

        const validateFile = (file) => {
            if (!file.name.toLowerCase().endsWith('.csv')) {
                alert('Por favor selecciona un archivo CSV válido.')
                return false
            }

            const maxSize = 200 * 1024 * 1024 // 200MB
            if (file.size > maxSize) {
                alert(
                    'El archivo es demasiado grande. El tamaño máximo es 200MB.'
                )
                return false
            }

            return true
        }

        const removeFile = () => {
            selectedFile.value = null
            if (fileInput.value) {
                fileInput.value.value = ''
            }
        }

        const formatFileSize = (bytes) => {
            if (bytes === 0) return '0 Bytes'
            const k = 1024
            const sizes = ['Bytes', 'KB', 'MB', 'GB']
            const i = Math.floor(Math.log(bytes) / Math.log(k))
            return (
                parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
            )
        }

        const submitForm = async () => {
            if (!selectedFile.value) return

            uploading.value = true
            uploadProgress.value = 0

            const formData = new FormData()
            formData.append('file', selectedFile.value)

            try {
                const response = await fetch('/rnc/import', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                })

                if (response.ok) {
                    // Simulate progress for better UX
                    const interval = setInterval(() => {
                        uploadProgress.value += Math.random() * 10
                        if (uploadProgress.value >= 100) {
                            clearInterval(interval)
                            uploadProgress.value = 100
                            setTimeout(() => {
                                window.location.reload()
                            }, 500)
                        }
                    }, 100)
                } else {
                    throw new Error('Error al subir el archivo')
                }
            } catch (error) {
                alert('Error al subir el archivo: ' + error.message)
                uploading.value = false
                uploadProgress.value = 0
            }
        }

        return {
            selectedFile,
            isDragOver,
            uploading,
            uploadProgress,
            fileInput,
            handleFileSelect,
            handleFileDrop,
            removeFile,
            formatFileSize,
            submitForm
        }
    }
}
</script>
