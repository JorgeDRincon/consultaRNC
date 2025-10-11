import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue'
import { createPinia } from 'pinia'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import i18n from './i18n'

const appName = (import.meta as any).env?.VITE_APP_NAME || 'ConsultaRNC'

createInertiaApp({
    title: (title) => title ? `${title} - ${appName}` : appName,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            (import.meta as any).glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })

        // Create Pinia instance
        const pinia = createPinia()

        // Initialize theme after Pinia is created
        import('./stores/theme').then(({ useTheme }) => {
            const { initializeTheme } = useTheme()
            initializeTheme()
        })

        app.use(plugin)
        app.use(pinia)
        app.use(ZiggyVue)
        app.use(i18n)
        app.mount(el)
    },
    progress: {
        color: '#4B5563'
    }
})
