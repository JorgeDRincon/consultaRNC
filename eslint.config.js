import js from '@eslint/js'
import pluginVue from 'eslint-plugin-vue'
import parserVue from 'vue-eslint-parser'
import parserTypeScript from '@typescript-eslint/parser'

export default [
    js.configs.recommended,
    ...pluginVue.configs['flat/recommended'],
    {
        files: ['**/*.{js,vue}'],
        languageOptions: {
            ecmaVersion: 'latest',
            sourceType: 'module',
            parser: parserVue,
            parserOptions: {
                parser: parserTypeScript,
                ecmaVersion: 'latest',
                sourceType: 'module',
                extraFileExtensions: ['.vue']
            },
            globals: {
                console: 'readonly',
                process: 'readonly',
                window: 'readonly',
                document: 'readonly',
                navigator: 'readonly',
                setTimeout: 'readonly',
                setInterval: 'readonly',
                clearInterval: 'readonly',
                alert: 'readonly',
                FormData: 'readonly',
                fetch: 'readonly',
                HTMLElement: 'readonly',
                global: 'readonly'
            }
        },
        rules: {
            // Reglas básicas de JavaScript
            'no-unused-vars': 'warn',
            'no-console': 'warn',
            'prefer-const': 'error',
            'no-var': 'error',

            // Reglas de estilo
            indent: ['error', 4],
            quotes: ['error', 'single'],
            semi: ['error', 'never'],
            'comma-dangle': ['error', 'never'],

            // Reglas específicas de Vue
            'vue/multi-word-component-names': 'off',  // Permitir nombres de una palabra
            'vue/no-reserved-component-names': 'off',  // Permitir componentes con nombres reservados (como Head de Inertia)
            'vue/require-default-prop': 'error',  // Requerir valores por defecto en props
            'vue/html-indent': ['error', 4],
            'vue/max-attributes-per-line': [
                'error',
                {
                    singleline: 3,
                    multiline: 1
                }
            ],
            'vue/html-self-closing': [
                'error',
                {
                    html: {
                        void: 'always',
                        normal: 'always',
                        component: 'always'
                    }
                }
            ],
            'vue/component-name-in-template-casing': ['error', 'PascalCase']
        }
    },
    {
        files: ['resources/js/**/*.{js,vue}'],
        languageOptions: {
            globals: {
                route: 'readonly',
                axios: 'readonly'
            }
        }
    }
]
