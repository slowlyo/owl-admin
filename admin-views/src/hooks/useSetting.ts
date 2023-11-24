import {useSelector} from 'react-redux'
import {arrayGet} from '@/utils/common'

// 设置
const useSetting = () => {
    // 从 redux 中获取设置
    const settings: any = useSelector((state: GlobalState) => state.settings)

    // 获取设置
    const getSetting = (key = '', def = '') => {
        return key ? arrayGet(settings, key, def) : settings
    }

    return {settings, getSetting}
}

export default useSetting
