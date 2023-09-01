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
    const [lang, setLang] = useStorage('arco-lang', 'zh-CN')
    const settings = useSettings()
    const auth = useAuth()

    const getStore = () => useSelector((state: GlobalState) => state)

    const getLocale = () => {
        switch (lang) {
            case 'zh-CN':
                return zhCN
            case 'en-US':
                return enUS
            default:
                return zhCN
        }
    }

    const init = async (store = null) => {
        const {data} = await settings.initSettings.runAsync()

        setLang(data.locale == 'zh_CN' ? 'zh-CN' : 'en-US')
        dynamicAssetsHandler(data.assets)

        store.dispatch({
            type: 'update-settings',
            payload: {settings: data},
        })

        auth.checkLogin()

        appLoaded()
    }

    return {
        init,
        getStore,
        getLocale
    }
}
