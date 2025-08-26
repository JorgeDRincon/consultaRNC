import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig(({ command, mode }) => {
    // En modo test, no usar Laravel Vite Plugin
    const plugins = [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        })
    ]

    // Solo agregar Laravel plugin si NO estamos en modo test
    if (mode !== 'test') {
        plugins.unshift(
            laravel({
                input: 'resources/js/app.js',
                refresh: true
            })
        )
    }

    return {
        plugins,
        test: {
            globals: true,
            environment: 'jsdom',
            setupFiles: './resources/js/test-setup.js',
            include: [
                'resources/js/**/*.{test,spec}.{js,mjs,cjs,ts,mts,cts,jsx,tsx}'
            ]
        },
        resolve: {
            alias: {
                '@': '/resources/js'
            }
        }
    }
})
