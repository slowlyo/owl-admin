import IconButton from '@/layouts/components/IconButton'
import {Dropdown} from 'antd'
import useSetting from '@/hooks/useSetting'
import {useRequest} from 'ahooks'
import {saveSettings} from '@/service/api'
import {getCacheKey} from '@/utils/common'
import {useState} from 'react'

const LocaleButton = () => {
    const {getSetting} = useSetting()
    const items = getSetting('locale_options')
    const currentLocale = getSetting('locale')
    const [locale, setLocale] = useState(currentLocale)

    // 保存设置
    const save = useRequest(saveSettings, {
        manual: true,
        onBefore: () => {
            window.$owl.appLoader()
        },
        onSuccess: () => {
            localStorage.setItem(getCacheKey('locale'), locale)
            location.reload()
        }
    })

    const onClick = ({key}) => {
        if (key == currentLocale) {
            return
        }

        setLocale(key)

        save.run({admin_locale: key})
    }

    return (
        <Dropdown placement="bottom"
                  arrow={{pointAtCenter: true}}
                  menu={{
                      items: items.map((i) => {
                          i.key = i.value
                          return i
                      }),
                      onClick,
                      selectable: true,
                      defaultSelectedKeys: [currentLocale],
                  }}>
            <div>
                <IconButton icon="lucide:languages" onClick={(e) => e.preventDefault()}/>
            </div>
        </Dropdown>
    )
}

export default LocaleButton
