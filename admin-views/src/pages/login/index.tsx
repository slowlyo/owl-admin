import DefaultLogin from '@/pages/login/default-login'
import useStorage from '@/utils/useStorage'
import {clearLoginInfo, setToken} from '@/utils/auth'
import {useModel} from '@@/plugin-model'
import {history} from 'umi'
import {registerGlobalFunction} from '@/utils/common'
import {useEffect} from 'react'

const Login = () => {
    const [_, setLoginParams, removeLoginParams] = useStorage(window.$adminApiPrefix.replace(/^\//, '') + '-loginParams')
    const user = useModel('userModel')

    // 登录成功后的操作
    const afterLoginSuccess = (params: { username?: string, password?: string }, token: string) => {
        // 记住密码
        if (params?.username && params?.password) {
            setLoginParams(window.btoa(encodeURIComponent(JSON.stringify(params))))
        } else {
            removeLoginParams()
        }
        // 记录登录状态
        setToken(token)
        // 获取用户信息
        user.requestUserInfo.runAsync().then(() => {
            if (window.location.hash == '#/login') {
                // 跳转首页
                history.replace('/')
                location.reload()
            }
        })
    }

    registerGlobalFunction('afterLoginSuccess', afterLoginSuccess)

    useEffect(() => {
        clearLoginInfo()
    }, [])

    return <DefaultLogin/>
}

export default Login
