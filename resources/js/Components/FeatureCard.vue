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
                    <i :class="['text-white', faIcon, 'text-lg']"></i>
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
                        ></path>
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
            :class="['text-sm mb-4 flex-1', colorClasses.description]"
            v-if="description"
        >
            {{ description }}
        </p>
        <slot></slot>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    icon: {
        type: String,
        required: true,
    },
    faIcon: {
        type: String,
        default: null,
    },
    color: {
        type: String,
        required: true,
        validator: (value) => {
            return [
                "blue",
                "green",
                "purple",
                "orange",
                "red",
                "yellow",
                "indigo",
                "pink",
            ].includes(value);
        },
    },
    iconSize: {
        type: String,
        default: "w-10 h-10",
    },
});

const colorClasses = computed(() => {
    const colorMap = {
        blue: {
            background: "from-blue-50 to-blue-100",
            border: "border-blue-200",
            hoverShadow: "hover:shadow-blue-200/50",
            iconBackground: "bg-blue-600",
            title: "text-blue-900",
            subtitle: "text-blue-700",
            description: "text-blue-800",
        },
        green: {
            background: "from-green-50 to-green-100",
            border: "border-green-200",
            hoverShadow: "hover:shadow-green-200/50",
            iconBackground: "bg-green-600",
            title: "text-green-900",
            subtitle: "text-green-700",
            description: "text-green-800",
        },
        purple: {
            background: "from-purple-50 to-purple-100",
            border: "border-purple-200",
            hoverShadow: "hover:shadow-purple-200/50",
            iconBackground: "bg-purple-600",
            title: "text-purple-900",
            subtitle: "text-purple-700",
            description: "text-purple-800",
        },
        orange: {
            background: "from-orange-50 to-orange-100",
            border: "border-orange-200",
            hoverShadow: "hover:shadow-orange-200/50",
            iconBackground: "bg-orange-600",
            title: "text-orange-900",
            subtitle: "text-orange-700",
            description: "text-orange-800",
        },
        red: {
            background: "from-red-50 to-red-100",
            border: "border-red-200",
            hoverShadow: "hover:shadow-red-200/50",
            iconBackground: "bg-red-600",
            title: "text-red-900",
            subtitle: "text-red-700",
            description: "text-red-800",
        },
        yellow: {
            background: "from-yellow-50 to-yellow-100",
            border: "border-yellow-200",
            hoverShadow: "hover:shadow-yellow-200/50",
            iconBackground: "bg-yellow-600",
            title: "text-yellow-900",
            subtitle: "text-yellow-700",
            description: "text-yellow-800",
        },
        indigo: {
            background: "from-indigo-50 to-indigo-100",
            border: "border-indigo-200",
            hoverShadow: "hover:shadow-indigo-200/50",
            iconBackground: "bg-indigo-600",
            title: "text-indigo-900",
            subtitle: "text-indigo-700",
            description: "text-indigo-800",
        },
        pink: {
            background: "from-pink-50 to-pink-100",
            border: "border-pink-200",
            hoverShadow: "hover:shadow-pink-200/50",
            iconBackground: "bg-pink-600",
            title: "text-pink-900",
            subtitle: "text-pink-700",
            description: "text-pink-800",
        },
    };

    return colorMap[props.color] || colorMap.blue;
});
</script>
