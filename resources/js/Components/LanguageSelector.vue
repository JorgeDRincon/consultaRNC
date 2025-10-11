<template>
    <button
        :aria-label="`Current language: ${currentLanguageInfo.name}`"
        class="relative inline-flex items-center justify-center w-9 h-9 rounded-full bg-gray-200/80 dark:bg-gray-700/80 hover:bg-gray-300/90 dark:hover:bg-gray-600/90 text-gray-700 dark:text-gray-200 transition-all duration-300 ease-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/60 focus:ring-offset-2 dark:focus:ring-offset-gray-800 backdrop-blur-sm border border-gray-300/20 dark:border-gray-600/20"
        @click="toggleLanguage"
    >
        <span class="text-sm font-medium">{{ currentLanguageInfo.flag }}</span>
    </button>
</template>

<script setup lang="ts">
import { onMounted, watch, computed } from 'vue'
import { useLanguageStore } from '../stores/language'
import { useI18n } from 'vue-i18n'

const languageStore = useLanguageStore()
const { locale } = useI18n()

// Access store properties directly without destructuring to maintain reactivity
const availableLanguages = languageStore.availableLanguages
const setLanguage = languageStore.setLanguage
const getCurrentLanguageInfo = languageStore.getCurrentLanguageInfo

// Create computed properties for reactive access
const currentLanguageInfo = computed(() => getCurrentLanguageInfo())
const currentLanguage = computed(() => languageStore.currentLanguage)

const toggleLanguage = () => {
    // Find current language index
    const currentIndex = availableLanguages.findIndex(lang => lang.code === currentLanguage.value)
    // Get next language (cycle back to first if at end)
    const nextIndex = (currentIndex + 1) % availableLanguages.length
    const nextLanguage = availableLanguages[nextIndex]
    
    setLanguage(nextLanguage.code)
    locale.value = nextLanguage.code
}

onMounted(() => {
    // Set initial locale
    locale.value = currentLanguage.value
})

// Watch for language changes and update i18n locale
watch(currentLanguage, (newLang: string) => {
    locale.value = newLang
})
</script>