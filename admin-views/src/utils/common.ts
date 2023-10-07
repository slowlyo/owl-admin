/**
 * 应用加载完成
 */
export const appLoaded = () => setTimeout(() => document.getElementById('app-loader')?.remove(), 500)

/**
 * 注册全局函数
 * @param name
 * @param fn
 */
export const registerGlobalFunction = (name, fn) => {
    window.$owl = {...window.$owl, [name]: fn}
}

export const registerGlobalFunctions = (fns) => {
    window.$owl = {...window.$owl, ...fns}
}

/**
 * 获取多级对象的值
 *
 * @param array
 * @param key
 * @param def
 */
export const arrayGet = (array, key, def = null) => {
    if (key === null) {
        return array
    }

    if (array[key] !== undefined) {
        return array[key]
    }

    for (const segment of key.split('.')) {
        if (array[segment] !== undefined) {
            array = array[segment]
        } else {
            return def
        }
    }

    return array
}

/**
 * 递归合并对象
 * @param target
 * @param source
 */
export const mergeObject = (target, source) => {
    for (const key in source) {
        if (source.hasOwnProperty(key)) {
            const sourceVal = source[key]
            const targetVal = target[key]

            if (isObject(sourceVal) && isObject(targetVal)) {
                target[key] = mergeObject(targetVal, sourceVal)
            } else {
                target[key] = sourceVal
            }
        }
    }

    return target
}

export const isArray = (val): boolean => Object.prototype.toString.call(val) === '[object Array]'

export const isObject = (val): boolean => Object.prototype.toString.call(val) === '[object Object]'

export const isString = (val): boolean => Object.prototype.toString.call(val) === '[object String]'

export const isSSR = (function () {
    try {
        return !(typeof window !== 'undefined' && document !== undefined)
    } catch (e) {
        return true
    }
})()

export const getCacheKey = (key: string) => window.$adminApiPrefix.replace(/^\//, '') + '-' + key

export const Token = () => {
    const cacheKey = getCacheKey('token')
    return {
        value: localStorage.getItem(cacheKey),
        set: (token: string) => localStorage.setItem(cacheKey, token),
        clear: () => localStorage.removeItem(cacheKey),
    }
}

export const inLoginPage = () => window.location.hash == '#/login'

export const goToLoginPage = () => window.location.hash = '#/login'
