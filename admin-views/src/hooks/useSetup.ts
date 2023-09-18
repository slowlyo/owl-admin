import {useMount, useRequest} from 'ahooks'
import {fetchLogout, fetchSettings, fetchUserInfo} from '@/service/api'
import {appLoaded, inLoginPage, registerGlobalFunction, Token} from '@/utils/common'
import useStorage from '@/utils/useStorage'
import zhCN from 'antd/locale/zh_CN'
import enUS from 'antd/locale/en_US'
import {setThemeColor} from '@/utils/themeColor'
import {dynamicAssetsHandler} from '@/utils/dynamicAssets'
import {useState} from 'react'
import {registerCustomComponents} from '@/components/AmisRender/CustomComponents'

const defaultToken = {
    token: {
        borderRadius: 4,
        wireframe: true,
        colorSplit: 'var(--color-border)'
    },
    components: {
        Menu: {
            iconSize: 18,
            collapsedIconSize: 18,
            subMenuItemBg: '#fff',
            darkSubMenuItemBg: '#001529',
            itemMarginInline: 8,
        }
    }
}

const useSetup = (store) => {
    const [lang, setLang] = useStorage('arco-lang', 'zh-CN')
    const [antdToken, setAntdToken] = useState(defaultToken)

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
                type: 'update-app-settings',
                payload: {appSettings: res.data},
            })
            if (res.data.system_theme_setting) {
                store.dispatch({
                    type: 'update-settings',
                    payload: {settings: res.data.system_theme_setting},
                })
            }
            setLang(res.data.locale == 'zh_CN' ? 'zh-CN' : 'en-US')
            setThemeColor(store.getState().settings.themeColor)
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
            window.location.hash = '#/login'
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
    }

    // 初始化
    const init = async () => {
        await initSettings.runAsync()

        if (Token().value) {
            await initUserInfo.runAsync()
        } else if (!inLoginPage()) {
            window.location.hash = '#/login'
        }

        registerFunctions()
        registerCustomComponents()

        appLoaded()
    }

    useMount(() => {
        init().then()
    })

    return {
        getAntdLocale,
        antdToken
    }
}

export default useSetup
