import DefaultLogin from '@/pages/login/default-login'
import {useEffect} from 'react'
import {useHistory} from 'react-router'
import {getCacheKey, registerGlobalFunction, Token} from '@/utils/common.ts'
import useStorage from '@/hooks/useStorage.ts'
import useApp from '@/hooks/useApp.tsx'

const Login = () => {
    const history = useHistory()
    const {initUserInfo, initRoutes} = useApp()

    const [loginParams, setLoginParams, removeLoginParams] = useStorage(getCacheKey('loginParams'))

    // 登录成功后的操作
    const afterLoginSuccess = async (params, token) => {
        // 记住密码
        if (params?.username && params?.password) {
            setLoginParams(window.btoa(encodeURIComponent(JSON.stringify(params))))
        } else {
            removeLoginParams()
        }
        // 记录登录状态
        Token().set(token)
        // 获取用户信息
        await initUserInfo()
        // 获取用户路由
        await initRoutes()

        if (window.location.hash == '#/login') {
            // 跳转首页
            // window.location.hash = "#/" + defaultRoute
            window.location.hash = '#/'
        }
    }

    registerGlobalFunction('afterLoginSuccess', afterLoginSuccess)

    if (Token().value) {
        useEffect(() => history.push('/'), [history.location])
    }

    return <DefaultLogin/>
}

export default Login
