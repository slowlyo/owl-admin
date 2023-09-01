/**
 * 应用加载完成
 */
export const appLoaded = () => setTimeout(() => document.getElementById('app-loader')?.remove(), 300)

/**
 * 注册全局函数
 * @param name
 * @param fn
 */
export const registerGlobalFunction = (name, fn) => {
    window.$owl = {...window.$owl, [name]: fn}
}
