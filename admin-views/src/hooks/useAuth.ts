import useStorage from '@/hooks/useStorage.ts'
import {useRequest} from 'ahooks'
import {fetchUserInfo} from '@/service'

const TokenKey = window.$adminApiPrefix.replace(/^\//, '') + '-token'

export const useAuth = (store = null) => {
    const [token, setToken, removeToken] = useStorage(TokenKey, '')
    const [loginParams, setLoginParams, removeLoginParams] = useStorage(window.$adminApiPrefix.replace(/^\//, '') + '-loginParams')

    // 退出登录
    const logout = (request = false) => {
        removeToken()

        if (window.location.hash !== '#/login') {
            window.location.hash = '#/login'
        }
    }

    const requestUserInfo = useRequest(fetchUserInfo, {manual: true})

    // 初始化用户信息
    const initUserInfo = async (store) => {
        const {data} = await requestUserInfo.runAsync()

        store.dispatch({
            type: 'update-userInfo',
            payload: {userInfo: data},
        })
    }

    // 登录成功后的操作
    const afterLoginSuccess = (params, token) => {
        console.log(params)
        // 记住密码
        if (params?.username && params?.password) {
            setLoginParams(window.btoa(encodeURIComponent(JSON.stringify(params))))
        } else {
            removeLoginParams()
        }
        // 记录登录状态
        setToken(token)
        // 获取用户信息
        initUserInfo(store).then(() => {
            // window.$owl.refreshRoutes().then(() => {
            // 跳转首页
            // window.location.hash = "#/" + defaultRoute
            // window.location.hash = '#/'
            // })
        })
    }

    // 检查登录状态
    const checkLogin = () => {
        if (!token) {
            logout()
        }

        if (window.location.hash == '#/login') {
            // 跳转首页
            // window.location.hash = "#/" + defaultRoute
            window.location.hash = '#/'
        }
    }

    return {
        loginParams,
        token,
        logout,
        setToken,
        checkLogin,
        initUserInfo,
        afterLoginSuccess,
    }
}
