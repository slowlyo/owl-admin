export const checkLogin = () => !!getToken()

export const setToken = (token: string) => localStorage.setItem("token", token)

export const removeToken = () => localStorage.removeItem("token")

export const getToken = () => {
    const token = localStorage.getItem("token")

    if (!token) {
        if (window.location.hash !== "#/login") {
            window.location.hash = "#/login"
        }
    }

    return token
}
