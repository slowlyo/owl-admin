import {useRequest} from 'ahooks'
import {fetchSettings} from '@/service'

export const useSettings = () => {
    const initSettings = useRequest(fetchSettings, {
        manual: true,
        retryCount: 3,
        cacheKey: 'app-settings',
    })

    return {
        initSettings
    }
}
