import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import {arrayGet} from '@/utils/common.ts'

export const useSettings = () => {
    const get = (key = '', def = '') => {
        const settings = useSelector((state: GlobalState) => state.settings)

        return key ? arrayGet(settings, key, def) : settings
    }

    const getSetting = (key = '', def = '') => get(key, def)

    return {
        get,
        getSetting
    }
}
