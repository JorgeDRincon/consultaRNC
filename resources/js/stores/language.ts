import { defineStore } from 'pinia'
import { ref, watch } from 'vue'

export const useLanguageStore = defineStore('language', () => {
    // Default language is Spanish
    const currentLanguage = ref(localStorage.getItem('language') || 'es')

    // Available languages
    const availableLanguages = [
        { code: 'es', name: 'Español', flag: '🇩🇴' },
        { code: 'en', name: 'English', flag: '🇺🇸' }
    ]

    // Change language
    const setLanguage = (languageCode: string) => {
        if (availableLanguages.find(lang => lang.code === languageCode)) {
            currentLanguage.value = languageCode
            localStorage.setItem('language', languageCode)
        }
    }

    // Get current language info
    const getCurrentLanguageInfo = () => {
        return availableLanguages.find(lang => lang.code === currentLanguage.value) || availableLanguages[0]
    }

    // Watch for language changes and update document language
    watch(currentLanguage, (newLang) => {
        document.documentElement.lang = newLang
    }, { immediate: true })

    return {
        currentLanguage,
        availableLanguages,
        setLanguage,
        getCurrentLanguageInfo
    }
})
