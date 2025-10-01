<template>
    <div
        :id="paramId"
        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:shadow-md dark:hover:shadow-gray-900/20 transition-all duration-200"
    >
        <div class="flex items-center gap-2 mb-2">
            <span
                class="bg-blue-200 dark:bg-blue-800 text-gray-800 dark:text-blue-100 px-2 py-1 rounded text-xs font-semibold"
            >{{ type }}</span>
            <code class="text-gray-700 dark:text-gray-300 font-mono font-semibold">{{
                name
            }}</code>
            <span :class="badgeClasses">
                <template v-if="isExact">
                    <i class="fa-solid fa-crosshairs mr-1" />
                </template>
                <template v-else>
                    <i class="fa-solid fa-magnifying-glass mr-1" />
                </template>
                {{ isExact ? "Exacta" : "Parcial" }}
            </span>
        </div>
        <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">
            {{ description }}
        </p>
        <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-500 rounded p-2">
            <code class="text-gray-800 dark:text-gray-200 font-mono text-xs">GET {{ example }}</code>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

interface Props {
    paramId: string
    type: string
    name: string
    description: string
    example: string
    isExact?: boolean
}

const props = withDefaults(defineProps<Props>(), {
    isExact: false
})

const badgeClasses = computed(() => {
    return props.isExact
        ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 px-2 py-1 rounded-full text-xs font-medium'
        : 'bg-sky-100 dark:bg-blue-900/30 text-sky-800 dark:text-blue-300 px-2 py-1 rounded-full text-xs font-medium'
})
</script>
