import {appLoaded, arrayGet} from '@/utils/common.ts'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import useStorage from '@/hooks/useStorage.ts'
import zhCN from 'antd/locale/zh_CN'
import enUS from 'antd/locale/en_US'
import {dynamicAssetsHandler} from '@/utils/dynamicAssets.ts'
import {useSettings} from '@/hooks/useSettings.ts'
import {useAuth} from '@/hooks/useAuth.ts'
import {useRouter} from '@/hooks/useRouter.tsx'
import {useContext} from 'react'
import {GlobalContext} from '@/components/GlobalContext'
import {registerCustomComponents} from '@/components/AmisRender/CustomComponents'

export const useApp = () => {
    const context = useContext(GlobalContext)
    const [lang, setLang] = useStorage('owl-admin-lang', 'zh-CN')
    const settings = useSettings()
    const auth = useAuth()
    const router = useRouter()

    // 获取全局状态
    const getStore = (key = '', def = '') => {
        const store = useSelector((state: GlobalState) => state)

        return key ? arrayGet(store, key, def) : store
    }

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

    // 初始化
    const init = async () => {
        // 获取框架设置
        const {data} = await settings.initSettings.runAsync()
        // 设置语言
        setLang(data.locale)
        // 设置动态资源
        dynamicAssetsHandler(data.assets)
        // 保存框架设置
        context.store.dispatch({
            type: 'update-settings',
            payload: {settings: data},
        })
        // 获取用户信息
        await auth.initUserInfo()
        // 获取路由
        await router.initRoutes()
        // 注册 amis 组件
        registerCustomComponents()
        // 移除加载动画
        appLoaded()
    }

    return {
        init,
        getStore,
        getAntdLocale,
    }
}
