import {useEffect, useState} from 'react'
import {useRequest} from 'ahooks'
import {fetchSettings} from '@/services'
import {arrayGet} from '@/utils/common'

const SettingModel = () => {
    const [settings, setSettings] = useState({})

    const initSettings = useRequest(fetchSettings, {
        manual: true,
        retryCount: 3,
        cacheKey: 'app-settings',
    })

    const getSetting = (key: string) => arrayGet(settings, key)

    useEffect(() => {
        initSettings.runAsync().then((res: any) => setSettings(res.data))
    }, [])

    return {
        settings,
        setSettings,
        getSetting
    }
}

export default SettingModel
