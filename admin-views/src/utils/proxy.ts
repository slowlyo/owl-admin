import type {ProxyOptions} from "vite"

/**
 * 设置网络代理
 */
export function createViteProxy(env) {
    if (env.PROD) return undefined
    if (env.VITE_PROXY_CHANGE_ORIGIN !== "Y") return undefined

    const proxy: Record<string, string | ProxyOptions> = {
        [env.VITE_API_PREFIX]: {
            target: env.VITE_PROXY_URL,
            changeOrigin: env.VITE_PROXY_CHANGE_ORIGIN === "Y",
        },
    }

    return proxy
}
