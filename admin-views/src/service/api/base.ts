import {AxiosRequestConfig, Method, ResponseType} from 'axios'
import {request} from '../request'

export interface AmisRequestConfig {
    url: string
    method: Method
    data?: any
    config?: AxiosRequestConfig
    headers?: AxiosRequestConfig['headers']
    responseType?: ResponseType
}

/** 获取 amis 请求最终使用的响应类型，顶层配置优先于 axios 扩展配置 */
export const getAmisResponseType = ({responseType, config}: AmisRequestConfig) =>
    responseType || config?.responseType

/** 判断 amis 请求是否需要按原始二进制响应处理 */
export const isBinaryAmisRequest = (api: AmisRequestConfig) =>
    ['arraybuffer', 'blob'].includes(getAmisResponseType(api) || '')

/**
 * 初始化页面结构
 * @param path
 * @param pageSign
 */
export const initPageSchema = (path: string, pageSign?: string) => {
    if (pageSign) {
        return request.get('/page_schema?sign=' + pageSign)
    }

    return request.get(path)
}

/**
 * amis请求
 * 将 amis 请求参数转换为 axios 调用，并保留现有各 HTTP 方法的数据传递方式
 * @param api amis 请求配置
 */
export const amisRequest = (api: AmisRequestConfig) => {
    const {url, method, data, config = {}, headers} = api
    const responseType = getAmisResponseType(api)
    const requestUrl = isBinaryAmisRequest(api) && url.startsWith('/')
        ? window.location.origin + url
        : url
    const axiosConfig: AxiosRequestConfig = {
        ...config,
        ...(headers ? {headers: {...config.headers, ...headers}} : {}),
        ...(responseType ? {responseType} : {}),
    }
    const normalizedMethod = method.toLowerCase()

    // axios 的只读方法将第二个参数作为配置，需合并 amis 原有 data 以保持查询行为。
    if (['get', 'delete', 'head', 'options'].includes(normalizedMethod)) {
        return request[normalizedMethod](requestUrl, {...data, ...axiosConfig})
    }

    // 写入方法的 data 仍作为请求体，axios 配置通过第三个参数透传。
    return request[normalizedMethod](requestUrl, data, axiosConfig)
}

/**
 * 获取设置
 */
export const fetchSettings = () => request.get('/_settings')

/**
 * 保存设置
 * @param data 格式：{key1: value1, key2: value2, ...}
 */
export const saveSettings = (data: any) => request.post('/_settings', data)
