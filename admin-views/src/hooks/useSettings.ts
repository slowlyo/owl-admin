import {useRequest} from 'ahooks'
import {fetchSettings} from '@/service'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import {arrayGet} from '@/utils/common.ts'

export const useSettings = () => {

    const initSettings = useRequest(fetchSettings, {
        manual: true,
        retryCount: 3,
        cacheKey: 'app-settings',
    })

    const get = (key = '', def = '') => {
        const settings = useSelector((state: GlobalState) => state.settings)

        return key ? arrayGet(settings, key, def) : settings
    }

    const getSetting = (key = '', def = '') => get(key, def)

    return {
        initSettings,
        get,
        getSetting
    }
}
