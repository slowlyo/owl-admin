import {useMount, useRequest} from 'ahooks'
import {fetchLogout, fetchSettings, fetchUserInfo, fetchUserRoutes} from '@/service/api'
import {componentMount} from '@/routes/helpers'
import {staticRoutes} from '@/routes'
import {
    appLoaded,
    clearMsgSign,
    getCacheKey,
    goToLoginPage,
    inLoginPage,
    isArray,
    registerGlobalFunction,
    Token
} from '@/utils/common'
import useStorage from '@/utils/useStorage'
import zhCN from 'antd/locale/zh_CN'
import enUS from 'antd/locale/en_US'
import {dynamicAssetsHandler} from '@/utils/dynamicAssets'
import {registerCustomComponents} from '@/components/AmisRender/CustomComponents'

// 应用初始化
const useSetup = (store) => {
    const [lang, setLang] = useStorage('owl-lang', 'zh-CN')

    // 初始化配置信息
    const initSettings = useRequest(fetchSettings, {
        manual: true,
        retryCount: 3,
        cacheKey: 'app-settings',
        onBefore() {
            store.dispatch({
                type: 'update-userInfo',
                payload: {userLoading: true},
            })
        },
        onSuccess(res) {
            store.dispatch({
                type: 'update-settings',
                payload: {settings: res.data},
            })

            localStorage.setItem(getCacheKey('locale'), res.data.locale)
            setLang(res.data.locale == 'zh_CN' ? 'zh-CN' : 'en-US')
            dynamicAssetsHandler(res.data.assets)
        },
        onFinally() {
            store.dispatch({
                type: 'update-inited',
                payload: {inited: true},
            })
        }
    })

    // 初始化用户信息
    const initUserInfo = useRequest(fetchUserInfo, {
        manual: true,
        onSuccess(res) {
            store.dispatch({
                type: 'update-userInfo',
                payload: {userInfo: res.data},
            })
        }
    })

    // 退出登录
    const logout = useRequest(fetchLogout, {
        manual: true,
        onFinally() {
            Token().clear()
            goToLoginPage()
        }
    })

    // 刷新路由 - 直接在 useSetup 中处理，避免跨组件依赖问题
    const refreshRoutes = useRequest(fetchUserRoutes, {
        manual: true,
        onSuccess: async ({data}) => {
            if (!isArray(data)) return
            store.dispatch({
                type: 'update-routes',
                payload: {
                    routes: await componentMount([...staticRoutes, ...data])
                },
            })
        }
    })

    // 获取语言
    const getAntdLocale = () => {
        switch (lang) {
            case 'zh_CN':
                return zhCN
            case 'en':
                return enUS
            default:
                return zhCN
        }
    }

    // 注册全局函数
    const registerFunctions = () => {
        registerGlobalFunction('logout', () => logout.run())
        registerGlobalFunction('getCacheKey', (val: string) => getCacheKey(val))
        registerGlobalFunction('refreshRoutes', () => refreshRoutes.runAsync())
    }

    // 初始化
    const init = async () => {
        try {
            clearMsgSign()
            registerFunctions()
            registerCustomComponents()

            await initSettings.runAsync()

            if (Token().value) {
                let res = await initUserInfo.runAsync()
                if (res.data?.code != 401) {
                    // 刷新路由数据
                    try {
                        await refreshRoutes.runAsync()
                    } catch (e) {
                        console.error(e)
                    }
                }
            } else if (!inLoginPage()) {
                // 未登录时强制跳转登录页
                goToLoginPage()
            }
        } catch (e) {
            console.error(e)
        } finally {
            // 无论初始化成功与否，都要移除首屏 loader，避免页面卡死
            appLoaded()
        }
    }

    // 初始化
    useMount(() => {
        init().then()
    })

    return {getAntdLocale}
}

export default useSetup
