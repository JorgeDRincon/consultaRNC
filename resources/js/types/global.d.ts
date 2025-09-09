// Global type definitions

declare global {
    interface Window {
        axios: any;
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

export {};
