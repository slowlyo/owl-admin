import type {ProxyOptions} from "vite"
import config from "../service/request/config"

/**
 * 设置网络代理
 */
export function createViteProxy() {
    if (!config.changeOrigin) return undefined

    const proxy: Record<string, string | ProxyOptions> = {
        [config.baseURL]: {
            target: config.proxyURL,
            changeOrigin: config.changeOrigin,
        },
    }

    return proxy
}
