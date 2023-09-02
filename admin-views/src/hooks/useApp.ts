import {appLoaded} from '@/utils/common.ts'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import useStorage from '@/hooks/useStorage.ts'
import zhCN from 'antd/locale/zh_CN'
import enUS from 'antd/locale/en_US'
import {dynamicAssetsHandler} from '@/utils/dynamicAssets.ts'
import {useSettings} from '@/hooks/useSettings.ts'
import {useAuth} from '@/hooks/useAuth.ts'

export const useApp = () => {
    const [lang, setLang] = useStorage('owl-admin-lang', 'zh-CN')
    const settings = useSettings()
    const auth = useAuth()

    // 获取全局状态
    const getStore = () => useSelector((state: GlobalState) => state)

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
    const init = async (store = null) => {
        // 获取框架设置
        const {data} = await settings.initSettings.runAsync()
        console.log(data)
        // 设置语言
        setLang(data.locale)
        // 设置动态资源
        dynamicAssetsHandler(data.assets)
        // 保存框架设置
        store.dispatch({
            type: 'update-settings',
            payload: {settings: data},
        })
        // 获取用户信息
        await auth.initUserInfo(store)
        // 移除加载动画
        appLoaded()
    }

    return {
        init,
        getStore,
        getAntdLocale
    }
}
