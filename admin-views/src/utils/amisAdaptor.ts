export type AxiosLikeResponse<T = any> = { data: T; status: number; headers: any }

/** 判断是否为 AMis 标准包装：顶层 numeric status 且含 data 字段 */
export function isAmisWrapper(payload: any): boolean {
    return !!(
        payload &&
        typeof payload === 'object' &&
        typeof (payload as any).status === 'number' &&
        Object.prototype.hasOwnProperty.call(payload, 'data')
    )
}

/** 判断是否包含易被 AMis 误判的歧义字段 */
export function hasAmbiguousFields(payload: any): boolean {
    if (!payload || typeof payload !== 'object') return false
    const own = (k: string) => Object.prototype.hasOwnProperty.call(payload, k)
    const ambiguousError = own('error') && typeof (payload as any).error !== 'number' && !(typeof (payload as any).error === 'object' && (payload as any).error?.code)
    return own('status') || own('no') || own('errno') || own('errorCode') || ambiguousError
}

/** 标准化为 axios 风格响应 */
export function toAxiosLike<T = any>(res: any): AxiosLikeResponse<T> {
    const isAxiosLike = res && typeof res === 'object' && 'data' in res && ('status' in res || 'headers' in res)
    const axiosLike: any = isAxiosLike ? res : { data: res }
    return {
        data: axiosLike.data,
        status: typeof axiosLike.status === 'number' ? axiosLike.status : 200,
        headers: axiosLike.headers ?? {}
    }
}

/**
 * 若 data 含歧义字段但不是 AMis 包装，则包装为 {status:0,data:payload}
 * 返回新的 axios-like 响应对象
 */
export function wrapAxiosLikeIfAmbiguous(res: AxiosLikeResponse): AxiosLikeResponse {
    const payload = res?.data
    if (!isAmisWrapper(payload) && hasAmbiguousFields(payload)) {
        return { ...res, data: { status: 0, data: payload } }
    }
    return res
}

/**
 * 仅包装 payload，本函数用于 addApiResponseAdaptor 回调。
 * 返回 undefined 表示不改动。
 */
export function wrapPayloadIfAmbiguous(payload: any): any | undefined {
    if (!isAmisWrapper(payload) && hasAmbiguousFields(payload)) {
        return { status: 0, data: payload }
    }
    return undefined
}
