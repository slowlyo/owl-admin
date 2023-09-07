import zh_CN from '@/lang/zh_CN'
import en from '@/lang/en'
import {useSettings} from '@/hooks/useSettings.ts'
import {arrayGet} from '@/utils/common.ts'

export const useLang = () => {
    const settings = useSettings()
    const lang = {zh_CN, en}

    const t = (key: string) => {
        const locale = settings.get('locale', 'zh_CN')

        return arrayGet(lang[locale], key, key)
    }

    return {
        t
    }
}
