import {useModel} from '@@/plugin-model'

export const LayoutFooter = () => {
    const {getSetting} = useModel('settingModel')

    if (!getSetting('system_theme_setting.footer')) {
        return null
    }

    return (
        <div className="h-[60px] flex items-center justify-center">
            <div dangerouslySetInnerHTML={{__html: getSetting('layout.footer')}}></div>
        </div>
    )
}
