import axios, {AxiosError, AxiosInstance, AxiosRequestConfig} from 'axios'
import {message, notification} from 'antd'
import {attachmentAdpator} from 'amis'
import {toast} from 'amis-ui'
import {goToLoginPage, inLoginPage, msgHandler, Token} from '@/utils/common'
import {getCacheKey} from '@/utils/common'

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
                // 设置语言
                handleConfig.headers.locale = localStorage.getItem(getCacheKey('locale'))

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
                    // 先处理附件下载/Blob 的场景
                    const adapted = await attachmentAdpator(response, () => '')

                    // 统一拿到数据体
                    const backend = adapted?.data

                    // token失效
                    if (backend?.code == 401 && !inLoginPage()) {
                        Token().clear()
                        goToLoginPage()
                    }

                    // 当后端返回 AMis 风格包装（包含 status）时，按 msg 显示提示
                    if (typeof backend?.status === 'number') {
                        if (backend?.msg && backend?.doNotDisplayToast == 0) {
                            backend.status === 0 ? toast.success(backend.msg) : toast.error(backend.msg)
                        }
                        // status 为 0 返回后端 JSON，否则返回 axios 响应，保持与原逻辑一致
                        return backend.status === 0 ? backend : adapted
                    }

                    // 非 AMis 风格包装，返回 axios 响应（res.data 即为真实数据）
                    return adapted
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

                    return {data: {status: 1, msg: ''}}
                }

                return {data: {status: 1, msg}}
            }
        )
    }
}
