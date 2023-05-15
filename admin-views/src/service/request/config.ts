import {AxiosRequestConfig} from "axios"

interface RequestConfig extends AxiosRequestConfig {
    // 代理路径
    proxyURL: string,
    // 是否跨域
    changeOrigin: boolean,
}

export default <RequestConfig>{
    baseURL: import.meta.env.VITE_API_PREFIX,
    proxyURL: import.meta.env.VITE_PROXY_URL,
    changeOrigin: import.meta.env.VITE_PROXY_CHANGE_ORIGIN === "Y",
}
