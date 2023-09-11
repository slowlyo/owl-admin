import {request} from 'umi'

/**
 * 初始化页面结构
 * @param path
 */
export const fetchPageSchema = (path: string) => request(path, {method: 'get'})

/**
 * amis请求
 * @param url
 * @param method
 * @param data
 */
export const amisRequest = (url: string, method: string, data: any) => request(url, {data, method})

/**
 * 获取设置
 */
export const fetchSettings = () => request('/_settings', {method: 'get'})

/**
 * 保存设置
 * @param data 格式：{key1: value1, key2: value2, ...}
 */
export const saveSettings = (data: any) => request('/_settings', {method: 'post', data})
