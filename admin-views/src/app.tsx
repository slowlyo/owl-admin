import type {RequestConfig} from 'umi'
import {fetchUserRoutes} from '@/services'
import {message} from 'antd'

export const getInitialState = async () => {
    console.log('getInitialState')
    return {}
}

export const request: RequestConfig = {
    timeout: 1000,
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
            console.log('requestInterceptors', config)
            // 拦截请求配置，进行个性化处理。
            return {...config}
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
                }else{
                    message.error(data.msg || '请求失败')
                }
            }

            return response
        }
    ]
}

let extraRoutes: any

export const patchClientRoutes = ({routes}: { routes: any }) => {

    // 根据 extraRoutes 对 routes 做一些修改
    // patch(routes, extraRoutes);
    console.log('patchClientRoutes', routes, extraRoutes)
}

export const render = (oldRender: any) => {
    fetchUserRoutes().then((res) => {
        extraRoutes = res.data
        oldRender()
    }).catch(() => {
        oldRender()
    })
}
