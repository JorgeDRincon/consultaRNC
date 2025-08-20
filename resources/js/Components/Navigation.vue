<template>
    <header class="absolute top-0 left-0 right-0 p-6">
        <nav class="max-w-7xl mx-auto flex justify-between items-center">
            <Link href="/">
                <img src="/images/logo.png" alt="Logo" width="200" />
            </Link>
            <div class="flex space-x-6">
                <Link
                    href="/documentation"
                    :class="[
                        'font-medium transition',
                        isActive('/documentation')
                            ? 'text-blue-600'
                            : 'text-gray-600 hover:text-gray-800',
                    ]"
                >
                    Documentación
                </Link>
                <Link
                    href="/documentation/about"
                    :class="[
                        'font-medium transition',
                        isActive('/documentation/about')
                            ? 'text-blue-600'
                            : 'text-gray-600 hover:text-gray-800',
                    ]"
                >
                    About
                </Link>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()

const isActive = (path) => {
    return page.url === path
}
</script>
