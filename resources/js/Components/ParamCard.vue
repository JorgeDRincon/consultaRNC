<template>
    <div
        :id="paramId"
        class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200"
    >
        <div class="flex items-center gap-2 mb-2">
            <span
                class="bg-blue-200 text-gray-800 px-2 py-1 rounded text-xs font-semibold"
                >{{ type }}</span
            >
            <code class="text-gray-700 font-mono font-semibold">{{
                name
            }}</code>
            <span :class="badgeClasses">
                <template v-if="isExact">
                    <i class="fa-solid fa-crosshairs mr-1"></i>
                </template>
                <template v-else>
                    <i class="fa-solid fa-magnifying-glass mr-1"></i>
                </template>
                {{ isExact ? "Exacta" : "Parcial" }}
            </span>
        </div>
        <p class="text-gray-600 text-sm mb-2">{{ description }}</p>
        <div class="bg-gray-100 border border-gray-300 rounded p-2">
            <code class="text-gray-800 font-mono text-xs"
                >GET {{ example }}</code
            >
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    paramId: { type: String, required: true },
    type: { type: String, required: true },
    name: { type: String, required: true },
    description: { type: String, required: true },
    example: { type: String, required: true },
    isExact: { type: Boolean, default: false },
});

const badgeClasses = computed(() => {
    return props.isExact
        ? "bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium"
        : "bg-sky-100 text-sky-800 px-2 py-1 rounded-full text-xs font-medium";
});
</script>
