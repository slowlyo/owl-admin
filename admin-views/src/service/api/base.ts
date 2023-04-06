import {request} from "../request"

/**
 * 初始化页面结构
 * @param path
 */
export const initPageSchema = (path: string) => request.get(path)

/**
 * amis请求
 * @param url
 * @param method
 * @param data
 */
export const amisRequest = (url, method, data) => request[method](url, data)

/**
 * 获取设置
 */
export const fetchSettings = () => request.get("/_settings")

/**
 * 保存设置
 * @param data 格式：{key1: value1, key2: value2, ...}
 */
export const saveSettings = (data: any) => request.post("/_settings", data)
