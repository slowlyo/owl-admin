import useStorage from '@/hooks/useStorage.ts'

const TokenKey = window.$adminApiPrefix.replace(/^\//, '') + '-token'

export const useAuth = () => {
    const [token, setToken, removeToken] = useStorage(TokenKey, '')

    const logout = () => {
        removeToken()

        if (window.location.hash !== '#/login') {
            window.location.hash = '#/login'
        }
    }

    const checkLogin = () => {
        console.log(token)
        if (!token) {
            logout()
        }
    }

    return {
        token,
        checkLogin
    }
}
