import {useEffect} from 'react'
import AmisLogin from './AmisLogin'
import {useMount, useRequest} from 'ahooks'
import {getCacheKey, inLoginPage, registerGlobalFunction, Token} from '@/utils/common'
import DefaultLogin from './DefaultLogin'
import useSetting from '@/hooks/useSetting'
import {useHistory} from 'react-router'
import {useDispatch} from 'react-redux'
import useStorage from '@/utils/useStorage'
import {fetchUserInfo} from '@/service/api'
import useRoute from '@/routes'
import {useLang} from '@/hooks/useLang'
import useTheme from '@/hooks/useTheme'

const Login = () => {
    useTheme()
    const {t} = useLang()
    const {getSetting} = useSetting()
    const loginTemplate = getSetting('system_theme_setting.loginTemplate', 'amis')
    const {defaultRoute} = useRoute()
    const dispatch = useDispatch()
    const history = useHistory()

    const initUserInfo = useRequest(fetchUserInfo, {
        manual: true,
        onSuccess(res) {
            dispatch({type: 'update-userInfo', payload: {userInfo: res.data}})
        }
    })

    const [_, setLoginParams, removeLoginParams] = useStorage(getCacheKey('loginParams'))

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
        await initUserInfo.runAsync()
        // 获取用户路由
        await window.$owl.refreshRoutes()

        if (inLoginPage()) {
            // 跳转首页
            history.replace(defaultRoute)
        }
    }

    registerGlobalFunction('afterLoginSuccess', afterLoginSuccess)

    useEffect(() => {
        if (Token().value) {
            history.replace(defaultRoute)
        }
    }, [history.location])

    useMount(() => {
        if (inLoginPage()) {
            // 页面标题
            let title = t('login.title')
            const titleTmp = getSetting('layout.title')
            if (titleTmp) {
                title = titleTmp.replace(/%title%/g, title)
            }
            document.title = title
        }
    })

    const Render = (mode: string) => {
        switch (mode) {
            case 'amis':
                return <AmisLogin/>
            default:
                return <DefaultLogin/>
        }
    }

    return Render(loginTemplate)
}

export default Login
