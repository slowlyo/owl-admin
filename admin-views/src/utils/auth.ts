const TokenKey = window.$adminApiPrefix.replace(/^\//, '') + '-token'

export const getToken = () => localStorage.getItem(TokenKey)

export const setToken = (token: string) => localStorage.setItem(TokenKey, token)

export const removeToken = () => localStorage.removeItem(TokenKey)

export const clearLoginInfo = () => {
    removeToken()
    if (window.location.hash !== '#/login') {
        window.location.hash = '#/login'
    }
}

export const isLogin = () => {
    if (!!getToken()) {
        return true
    }

    clearLoginInfo()
}
