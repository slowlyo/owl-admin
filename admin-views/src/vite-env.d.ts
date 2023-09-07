/// <reference types="vite/client" />

interface Window {
    $adminApiPrefix: string,
    $owl: {
        afterLoginSuccess: (params: any, token: string) => void,
        getToken: () => string,
        logout: () => void,
        checkLogin: () => void,
    }
}

interface ImportMetaEnv {
    VITE_PROXY_URL: string,
    VITE_PROXY_CHANGE_ORIGIN: string,
    VITE_API_PREFIX: string,
    VITE_BASE_URL: string,
}
