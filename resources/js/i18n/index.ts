import { createI18n } from 'vue-i18n'

// Import translations
import es from './locales/es.json'
import en from './locales/en.json'

// Get initial language from localStorage or default to 'es'
const getInitialLanguage = () => {
    if (typeof window !== 'undefined') {
        return localStorage.getItem('language') || 'es'
    }
    return 'es'
}

const i18n = createI18n({
    legacy: false,
    locale: getInitialLanguage(),
    fallbackLocale: 'es',
    messages: {
        es,
        en
    }
})

export default i18n
