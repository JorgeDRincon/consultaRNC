import js from '@eslint/js'
import pluginVue from 'eslint-plugin-vue'

export default [
    js.configs.recommended,
    ...pluginVue.configs['flat/recommended'],
    {
        files: ['**/*.{js,vue}'],
        languageOptions: {
            ecmaVersion: 'latest',
            sourceType: 'module',
            globals: {
                console: 'readonly',
                process: 'readonly',
                window: 'readonly',
                document: 'readonly'
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
