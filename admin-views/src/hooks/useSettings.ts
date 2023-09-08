import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import {arrayGet} from '@/utils/common.ts'

export const useSettings = () => {
    const settings:any = useSelector((state: GlobalState) => state.settings)

    const getSetting = (key = '', def = '') => {

        return key ? arrayGet(settings, key, def) : settings
    }

    return {
        settings,
        getSetting
    }
}
