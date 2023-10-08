import {useSelector} from 'react-redux'
import {arrayGet} from '@/utils/common'

const useSetting = () => {
    const settings:any = useSelector((state: GlobalState) => state.settings)

    const getSetting = (key = '', def = '') => {
        return key ? arrayGet(settings, key, def) : settings
    }

    return {
        settings,
        getSetting
    }
}

export default useSetting
