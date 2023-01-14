import type {RequestOptions} from '@@/plugin-request/request'
import {RequestConfig} from '@umijs/max'
import {getToken} from "@/utils/user"
import {toast} from "amis";

// 与后端约定的响应数据格式
interface ResponseStructure {
    data: any;
    doNotDisplayToast?: boolean;
    msg: string;
    status: number;
}

// @ts-ignore
// @ts-ignore
/**
 * 错误处理
 * pro 自带的错误处理， 可以在这里做自己的改动
 * @doc https://umijs.org/docs/max/request#配置
 */
export const errorConfig: RequestConfig = {
    // 错误处理： umi@3 的错误处理方案。
    errorConfig: {
        // 错误抛出
        errorThrower: (res) => {
            const {data, status, msg} =
                res as unknown as ResponseStructure
            if (!status) {
                const error: any = new Error(msg)
                error.name = 'BizError'
                error.info = {status, msg, data}
                throw error // 抛出自制的错误
            }
        },
        // 错误接收及处理
        errorHandler: (error: any, opts: any) => {
            if (opts?.skipErrorHandler) throw error
            // 我们的 errorThrower 抛出的错误。
            if (error.name === 'BizError') {
                const errorInfo: ResponseStructure | undefined = error.info
                if (errorInfo) {
                    const {msg} = errorInfo

                    toast.error(msg)
                }
            } else if (error.response) {
                // Axios 的错误
                // 请求成功发出且服务器也响应了状态码，但状态代码超出了 2xx 的范围
                // toast.error(`Response status:${error.response.status}`)
            } else if (error.request) {
                // 请求已经成功发起，但没有收到响应
                // \`error.request\` 在浏览器中是 XMLHttpRequest 的实例，
                // 而在node.js中是 http.ClientRequest 的实例
                toast.error('无响应')
            } else {
                // 发送请求时出了点问题
                toast.error('请求失败')
            }
        },
    },

    // 请求拦截器
    requestInterceptors: [
        (config: RequestOptions) => {
            // 拦截请求配置，进行个性化处理。
            const token = getToken()
            if (token) {
                config.headers = {
                    Authorization: 'Bearer ' + token,
                    ...config.headers
                }
            }

            const url = config?.url

            return {...config, url}
        },
    ],

    // 响应拦截器
    responseInterceptors: [
        (response) => {
            // 拦截响应数据，进行个性化处理
            const {data} = response as unknown as ResponseStructure

            if (data?.doNotDisplayToast == 1) {
                return response
            }

            if (data?.status == 0 && data?.msg) {
                toast.success(data?.msg)
            }

            if (data?.status != 0) {
                // @ts-ignore 兼容amis toast响应格式
                response = {data: response}
            }

            return response
        },
    ],
}
