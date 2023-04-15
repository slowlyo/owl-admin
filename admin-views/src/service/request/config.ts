import {AxiosRequestConfig} from "axios"

interface RequestConfig extends AxiosRequestConfig {
    // 代理路径
    proxyURL: string,
    // 是否跨域
    changeOrigin: boolean,
}

export default <RequestConfig>{
    baseURL: "/admin-api",
    proxyURL: "http://owl-admin.test",
    changeOrigin: true,
}
