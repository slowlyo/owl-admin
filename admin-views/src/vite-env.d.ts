/// <reference types="vite/client" />

interface Window {
    $adminApiPrefix: string,
    $owl: any
}

interface ImportMetaEnv {
    VITE_PROXY_URL: string,
    VITE_PROXY_CHANGE_ORIGIN: string,
    VITE_API_PREFIX: string,
    VITE_BASE_URL: string,
}
