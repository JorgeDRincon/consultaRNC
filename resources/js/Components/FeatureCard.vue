<template>
    <div
        :class="[
            'bg-gradient-to-br p-6 rounded-xl border transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer h-full flex flex-col',
            colorClasses.background,
            colorClasses.border,
            colorClasses.hoverShadow,
        ]"
    >
        <div class="flex items-center mb-3">
            <div
                :class="[
                    iconSize,
                    'rounded-lg flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-110',
                    colorClasses.iconBackground,
                ]"
            >
                <template v-if="faIcon">
                    <i :class="['text-white', faIcon, 'text-lg']" />
                </template>
                <template v-else>
                    <svg
                        class="w-6 h-6 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            :d="icon"
                        />
                    </svg>
                </template>
            </div>
            <div v-if="subtitle" class="flex-1">
                <h3 :class="['text-lg font-semibold', colorClasses.title]">
                    {{ title }}
                </h3>
                <p :class="['text-sm', colorClasses.subtitle]">
                    {{ subtitle }}
                </p>
            </div>
            <h3 v-else :class="['text-lg font-semibold', colorClasses.title]">
                {{ title }}
            </h3>
        </div>
        <p
            v-if="description"
            :class="['text-sm mb-4 flex-1', colorClasses.description]"
        >
            {{ description }}
        </p>
        <slot />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

type ColorType = 'blue' | 'green' | 'purple' | 'orange' | 'red' | 'yellow' | 'indigo' | 'pink'

interface Props {
    title: string
    description: string
    icon?: string
    faIcon?: string | null
    color: ColorType
    iconSize?: string
    subtitle?: string
}

const props = withDefaults(defineProps<Props>(), {
    icon: undefined,
    faIcon: null,
    iconSize: 'w-10 h-10',
    subtitle: undefined
})

const colorClasses = computed(() => {
    const colorMap: Record<ColorType, {
        background: string
        border: string
        hoverShadow: string
        iconBackground: string
        title: string
        subtitle: string
        description: string
    }> = {
        blue: {
            background: 'from-blue-50 to-blue-100 dark:from-blue-950/30 dark:to-blue-900/20',
            border: 'border-blue-200 dark:border-blue-800/50',
            hoverShadow: 'hover:shadow-blue-200/50 dark:hover:shadow-blue-950/20',
            iconBackground: 'bg-blue-600',
            title: 'text-blue-900 dark:text-blue-100',
            subtitle: 'text-blue-700 dark:text-blue-200',
            description: 'text-blue-800 dark:text-blue-300'
        },
        green: {
            background: 'from-green-50 to-green-100 dark:from-green-950/30 dark:to-green-900/20',
            border: 'border-green-200 dark:border-green-800/50',
            hoverShadow: 'hover:shadow-green-200/50 dark:hover:shadow-green-950/20',
            iconBackground: 'bg-green-600',
            title: 'text-green-900 dark:text-green-100',
            subtitle: 'text-green-700 dark:text-green-200',
            description: 'text-green-800 dark:text-green-300'
        },
        purple: {
            background: 'from-purple-50 to-purple-100 dark:from-purple-950/30 dark:to-purple-900/20',
            border: 'border-purple-200 dark:border-purple-800/50',
            hoverShadow: 'hover:shadow-purple-200/50 dark:hover:shadow-purple-950/20',
            iconBackground: 'bg-purple-600',
            title: 'text-purple-900 dark:text-purple-100',
            subtitle: 'text-purple-700 dark:text-purple-200',
            description: 'text-purple-800 dark:text-purple-300'
        },
        orange: {
            background: 'from-orange-50 to-orange-100 dark:from-orange-950/30 dark:to-orange-900/20',
            border: 'border-orange-200 dark:border-orange-800/50',
            hoverShadow: 'hover:shadow-orange-200/50 dark:hover:shadow-orange-950/20',
            iconBackground: 'bg-orange-600',
            title: 'text-orange-900 dark:text-orange-100',
            subtitle: 'text-orange-700 dark:text-orange-200',
            description: 'text-orange-800 dark:text-orange-300'
        },
        red: {
            background: 'from-red-50 to-red-100 dark:from-red-950/30 dark:to-red-900/20',
            border: 'border-red-200 dark:border-red-800/50',
            hoverShadow: 'hover:shadow-red-200/50 dark:hover:shadow-red-950/20',
            iconBackground: 'bg-red-600',
            title: 'text-red-900 dark:text-red-100',
            subtitle: 'text-red-700 dark:text-red-200',
            description: 'text-red-800 dark:text-red-300'
        },
        yellow: {
            background: 'from-yellow-50 to-yellow-100 dark:from-yellow-950/30 dark:to-yellow-900/20',
            border: 'border-yellow-200 dark:border-yellow-800/50',
            hoverShadow: 'hover:shadow-yellow-200/50 dark:hover:shadow-yellow-950/20',
            iconBackground: 'bg-yellow-600',
            title: 'text-yellow-900 dark:text-yellow-100',
            subtitle: 'text-yellow-700 dark:text-yellow-200',
            description: 'text-yellow-800 dark:text-yellow-300'
        },
        indigo: {
            background: 'from-indigo-50 to-indigo-100 dark:from-indigo-950/30 dark:to-indigo-900/20',
            border: 'border-indigo-200 dark:border-indigo-800/50',
            hoverShadow: 'hover:shadow-indigo-200/50 dark:hover:shadow-indigo-950/20',
            iconBackground: 'bg-indigo-600',
            title: 'text-indigo-900 dark:text-indigo-100',
            subtitle: 'text-indigo-700 dark:text-indigo-200',
            description: 'text-indigo-800 dark:text-indigo-300'
        },
        pink: {
            background: 'from-pink-50 to-pink-100 dark:from-pink-950/30 dark:to-pink-900/20',
            border: 'border-pink-200 dark:border-pink-800/50',
            hoverShadow: 'hover:shadow-pink-200/50 dark:hover:shadow-pink-950/20',
            iconBackground: 'bg-pink-600',
            title: 'text-pink-900 dark:text-pink-100',
            subtitle: 'text-pink-700 dark:text-pink-200',
            description: 'text-pink-800 dark:text-pink-300'
        }
    }

    return colorMap[props.color] || colorMap.blue
})
</script>
