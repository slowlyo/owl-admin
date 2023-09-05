/**
 * 应用加载完成
 */
export const appLoaded = () => setTimeout(() => document.getElementById('app-loader')?.remove(), 300)

/**
 * 注册全局函数
 * @param name
 * @param fn
 */
export const registerGlobalFunction = (name: string, fn: any) => {
    window.$owl = {...window.$owl, [name]: fn}
}

export const registerGlobalFunctions = (fns: any) => {
    window.$owl = {...window.$owl, ...fns}
}

/**
 * 获取多级对象的值
 *
 * @param array
 * @param key
 * @param def
 */
export const arrayGet = (array: any, key: string, def = null) => {
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

export const isArray = (val: any): boolean => Object.prototype.toString.call(val) === '[object Array]'

export const isObject = (val: any): boolean => Object.prototype.toString.call(val) === '[object Object]'

export const isString = (val: any): boolean => Object.prototype.toString.call(val) === '[object String]'
