<template>
    <Transition
        enter-active-class="transition-all duration-500 ease-out"
        enter-from-class="opacity-0 scale-75 translate-y-8 rotate-12"
        enter-to-class="opacity-100 scale-100 translate-y-0 rotate-0"
        leave-active-class="transition-all duration-300 ease-in"
        leave-from-class="opacity-100 scale-100 translate-y-0 rotate-0"
        leave-to-class="opacity-0 scale-75 translate-y-8 rotate-12"
    >
        <button
            v-if="isVisible"
            :class="[
                'group fixed right-4 sm:right-6 z-50 bg-white/90 hover:bg-white text-gray-500 hover:text-gray-700 p-3 sm:p-4 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500/50 backdrop-blur-md border border-gray-200/50 hover:border-gray-300/50',
                isNearFooter 
                    ? 'bottom-8 sm:bottom-10 lg:bottom-40' 
                    : 'bottom-8 sm:bottom-10 lg:bottom-8'
            ]"
            :aria-label="ariaLabel"
            :title="title"
            @click="scrollToTop"
        >
            <!-- Subtle background glow -->
            <div class="absolute inset-0 rounded-xl sm:rounded-2xl bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
            
            <!-- Main icon with modern styling -->
            <svg
                class="w-4 h-4 sm:w-5 sm:h-5 transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-0.5 relative z-10"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                />
            </svg>
            
            <!-- Subtle shine effect -->
            <div class="absolute inset-0 rounded-xl sm:rounded-2xl bg-gradient-to-r from-transparent via-white/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
        </button>
    </Transition>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'

interface Props {
    threshold?: number
    ariaLabel?: string
    title?: string
    smooth?: boolean
}

const props = withDefaults(defineProps<Props>(), {
    threshold: 50,
    ariaLabel: 'Scroll to top',
    title: 'Scroll to top',
    smooth: true
})

const isVisible = ref(false)
const isNearFooter = ref(false)

const handleScroll = (): void => {
    const scrollY = window.scrollY
    const windowHeight = window.innerHeight
    const documentHeight = document.documentElement.scrollHeight
    
    // Show button when scrolled past threshold
    isVisible.value = scrollY > props.threshold
    
    // Check if we're near the bottom (within 300px of footer)
    const distanceFromBottom = documentHeight - (scrollY + windowHeight)
    isNearFooter.value = distanceFromBottom < 300
}

const scrollToTop = (): void => {
    if (props.smooth) {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    } else {
        window.scrollTo(0, 0)
    }
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true })
    // Check initial scroll position
    handleScroll()
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>
