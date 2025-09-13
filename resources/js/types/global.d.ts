// Global type definitions

export interface FlashMessages {
    success?: string;
    error?: string;
    warning?: string;
    info?: string;
}

declare global {
    interface Window {
        axios: any;
        route: (name: string, params?: Record<string, any>) => string;
    }
}

// Vue component type definitions
declare module '*.vue' {
    import type { DefineComponent } from 'vue';
    const component: DefineComponent<{}, {}, any>;
    export default component;
}

// Import.meta.env type definitions
interface ImportMetaEnv {
    readonly VITE_APP_NAME: string;
}

interface ImportMeta {
    readonly env: ImportMetaEnv;
}

export { };
