import zh_CN from '@/lang/zh_CN'
import en from '@/lang/en'
import useSetting from '@/hooks/useSetting'
import {arrayGet} from '@/utils/common'

// 多语言
export const useLang = () => {
    const {getSetting} = useSetting()
    const lang = {zh_CN, en}

    const t = (key: string) => {
        const locale = getSetting('system_theme_setting.locale', 'zh_CN')

        return arrayGet(lang[locale], key, key)
    }

    return {
        t
    }
}
