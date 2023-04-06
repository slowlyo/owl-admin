export const checkLogin = () => !!getToken()

export const setToken = (token: string) => localStorage.setItem("token", token)

export const removeToken = () => localStorage.removeItem("token")

export const getToken = () => localStorage.getItem("token")
