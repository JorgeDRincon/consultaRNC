import { config } from "@vue/test-utils";
import { beforeEach, vi } from "vitest";

// Mock para Inertia.js
vi.mock("@inertiajs/vue3", () => ({
    Head: {
        template: '<head><title v-if="title">{{ title }}</title></head>',
        props: ["title"],
    },
    Link: {
        template: '<a href="#"><slot /></a>',
        props: ["href", "method"],
    },
    router: {
        visit: vi.fn(),
        get: vi.fn(),
        post: vi.fn(),
        put: vi.fn(),
        patch: vi.fn(),
        delete: vi.fn(),
    },
    usePage: () => ({
        props: {},
        url: "/",
        component: "Welcome",
    }),
}));

// Configuración global para @vue/test-utils
config.global.stubs = {
    // Stubs para componentes de terceros si es necesario
};

// Mocks globales
global.ResizeObserver = class ResizeObserver {
    observe() {}
    unobserve() {}
    disconnect() {}
};

// Mock para IntersectionObserver
global.IntersectionObserver = class IntersectionObserver {
    constructor() {}
    observe() {}
    unobserve() {}
    disconnect() {}
};

// Mock para HTMLDialogElement si no está disponible
if (typeof global.HTMLDialogElement === "undefined") {
    global.HTMLDialogElement = class HTMLDialogElement extends HTMLElement {
        showModal() {}
        close() {}
    };
}

// Hacer vi disponible globalmente
global.vi = vi;

// Configuración adicional antes de cada test
beforeEach(() => {
    // Limpiar todos los mocks antes de cada test
    vi.clearAllMocks();

    // Reset document body styles
    if (typeof document !== "undefined") {
        document.body.style.overflow = "";
    }
});
