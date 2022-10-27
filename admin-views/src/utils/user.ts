export const setToken = (token: string, authLogin: boolean | undefined) => {
    if (authLogin) {
        localStorage.setItem('token', token)
    } else {
        sessionStorage.setItem('token', token)
    }
}

export const getToken = () => {
    return localStorage.getItem('token') || sessionStorage.getItem('token')
}
