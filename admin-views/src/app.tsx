import type {RequestConfig} from 'umi'
import {fetchUserRoutes} from '@/services'
import {message} from 'antd'
import {getToken} from '@/utils/auth'
import {patch} from '@/utils/dynamicRoute'

let extraRoutes: any


export const getInitialState = async () => {
    return {extraRoutes}
}

export const request: RequestConfig = {
    baseURL: '/admin-api',
    headers: {'X-Requested-With': 'XMLHttpRequest'},
    errorConfig: {
        errorHandler(res) {
            console.log('errorHandler', res)
        },
        errorThrower(res) {
            console.log('errorThrower', res)
        },
    },
    // 请求拦截器
    requestInterceptors: [
        (config: any) => {
            const handleConfig = {...config}
            const token = getToken()

            handleConfig.headers.Authorization = `Bearer ${token}`

            return handleConfig
        }
    ],
    // 响应拦截器
    responseInterceptors: [
        (response: any) => {
            // 拦截响应数据，进行个性化处理
            const {data} = response

            if (data?.status) {
                if (data?.code == 401) {
                    if (window.location.hash != '/login') {
                        window.location.hash = '/login'
                    }
                } else {
                    message.error(data.msg || '请求失败')
                }
            }

            return response
        }
    ]
}

export const patchClientRoutes = ({routes}: { routes: any }) => {
    patch(routes, extraRoutes)
}

export const render = (oldRender: any) => {
    fetchUserRoutes().then((res) => {
        extraRoutes = res.data
        oldRender()
    }).catch(() => {
        oldRender()
    })
}
