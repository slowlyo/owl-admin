import axios, {AxiosError, AxiosInstance, AxiosRequestConfig} from 'axios'
import {message, notification} from 'antd'
import {attachmentAdpator} from 'amis'
import {goToLoginPage, inLoginPage, msgHandler, Token} from '@/utils/common'

export default class CustomAxiosInstance {
    instance: AxiosInstance

    constructor(axiosConfig: AxiosRequestConfig) {
        this.instance = axios.create(axiosConfig)
        this.setInterceptor()
    }

    setInterceptor() {
        // 请求拦截器
        this.instance.interceptors.request.use(
            async config => {
                const handleConfig = {...config}
                // 设置token
                const token = Token().value

                handleConfig.headers.Authorization = `Bearer ${token}`

                return handleConfig
            },
            (axiosError: AxiosError | any) => {
                return {
                    data: {
                        status: 1,
                        msg: axiosError.response?.data?.message || axiosError.message
                    }
                }
            }
        )
        // 响应拦截器
        this.instance.interceptors.response.use(
            async response => {
                const {status} = response
                if (status === 200 || status < 300 || status === 304) {
                    const backend = response.data
                    // 请求成功
                    if (backend.status === 0) {
                        if (backend?.msg && backend?.doNotDisplayToast == 0) {
                            msgHandler(backend.msg, () => message.success(backend.msg))
                        }

                        return backend
                    } else {
                        if (backend?.msg && backend?.doNotDisplayToast == 0) {
                            msgHandler(backend.msg, () => message.error(backend.msg))
                        }
                    }

                    // token失效
                    if (backend?.code == 401 && !inLoginPage()) {
                        Token().clear()

                        goToLoginPage()
                    }
                    return await attachmentAdpator(response, () => '')
                }

                return response
            },
            (axiosError: AxiosError | any) => {
                const msg = axiosError.response?.data?.message || axiosError.message

                if (msg) {
                    notification.error({
                        message: axiosError.response?.data?.exception || '',
                        description: msg
                    })

                    return {data: {status: 1, msg: '_dont_show_msg'}}
                }

                return {data: {status: 1, msg}}
            }
        )
    }
}
