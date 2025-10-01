import { ref, computed, watch } from 'vue'

export type Theme = 'light' | 'dark'

const THEME_KEY = 'dgii-theme'

export function useTheme() {
    // Reactive state
    const isDark = ref<boolean>(false)

    // Computed theme
    const theme = computed<Theme>(() => isDark.value ? 'dark' : 'light')

    // Initialize theme from localStorage or system preference
    const initializeTheme = (): void => {
        const savedTheme = localStorage.getItem(THEME_KEY)

        if (savedTheme) {
            isDark.value = savedTheme === 'dark'
        } else {
            // Check system preference
            isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches
        }

        applyTheme()
    }

    // Apply theme to document
    const applyTheme = (): void => {
        if (isDark.value) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    }

    // Toggle theme
    const toggleTheme = (): void => {
        isDark.value = !isDark.value
    }

    // Set specific theme
    const setTheme = (newTheme: Theme): void => {
        isDark.value = newTheme === 'dark'
    }

    // Watch for theme changes and persist to localStorage
    watch(isDark, (newValue) => {
        localStorage.setItem(THEME_KEY, newValue ? 'dark' : 'light')
        applyTheme()
    })

    return {
        isDark,
        theme,
        initializeTheme,
        toggleTheme,
        setTheme,
    }
}

