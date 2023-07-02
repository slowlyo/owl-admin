// @ts-ignore
const TokenKey = window.$adminApiPrefix.replace(/^\//, "") + "-token"

export const checkLogin = () => !!getToken()

export const setToken = (token: string) => {
    localStorage.setItem(TokenKey, token)
}

export const removeToken = () => localStorage.removeItem(TokenKey)

export const getToken = () => {
    const token = localStorage.getItem(TokenKey)

    if (!token) {
        if (window.location.hash !== "#/login") {
            window.location.hash = "#/login"
        }
    }

    return token
}
