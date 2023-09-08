import useStorage from '@/hooks/useStorage.ts'
import {useRequest} from 'ahooks'
import {fetchUserInfo} from '@/service'
import {useContext} from 'react'
import {GlobalContext} from '@/components/GlobalContext'

const TokenKey = window.$adminApiPrefix.replace(/^\//, '') + '-token'

export const useAuth = () => {
    const context = useContext(GlobalContext)
    const [token, setToken, removeToken] = useStorage(TokenKey, '')
    const [loginParams, setLoginParams, removeLoginParams] = useStorage(window.$adminApiPrefix.replace(/^\//, '') + '-loginParams')

    // 退出登录
    const logout = (request = false) => {
        removeToken()

        if (window.location.hash !== '#/login') {
            window.location.hash = '#/login'
        }
    }

    // 登录成功后的操作
    // const afterLoginSuccess = (params, token) => {
    //     // 记住密码
    //     if (params?.username && params?.password) {
    //         setLoginParams(window.btoa(encodeURIComponent(JSON.stringify(params))))
    //     } else {
    //         removeLoginParams()
    //     }
    //     // 记录登录状态
    //     setToken(token)
    //     // 获取用户信息
    //     initUserInfo().then(() => {
    //         // window.$owl.refreshRoutes().then(() => {
    //         // 跳转首页
    //         // window.location.hash = "#/" + defaultRoute
    //         // window.location.hash = '#/'
    //
    //         if (window.location.hash == '#/login') {
    //             // 跳转首页
    //             // window.location.hash = "#/" + defaultRoute
    //             window.location.hash = '#/'
    //         }
    //         // })
    //     })
    // }

    // 检查登录状态
    const checkLogin = () => {
        if (!token) {
            logout()
        }

        return true
    }

    return {
        loginParams,
        token,
        logout,
        setToken,
        checkLogin,
    }
}
