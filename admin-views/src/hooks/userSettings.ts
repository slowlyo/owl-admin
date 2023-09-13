import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import {arrayGet} from '@/utils/common'

export const useSettings = () => {
    const settings:any = useSelector((state: GlobalState) => state.appSettings)

    const getSetting = (key = '', def = '') => {

        return key ? arrayGet(settings, key, def) : settings
    }

    return {
        settings,
        getSetting
    }
}
