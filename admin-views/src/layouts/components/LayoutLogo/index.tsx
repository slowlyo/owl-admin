import {Image} from 'antd'
import useSettings from '@/hooks/useSetting'

const LayoutLogo = ({onlyLogo = false}) => {
    const {settings, getSetting} = useSettings()
    const width = onlyLogo ? ' w-full' : ' w-[220px]'
    const textColor = getSetting("system_theme_setting.siderTheme") === 'dark' ? 'text-white' : 'text-black'

    return (
        <div className={'h-[64px] flex justify-center items-center' + width}>
            <div className="w-[35px]">
                <Image width={35} preview={false} src={settings.logo}/>
            </div>
            {onlyLogo || <div className={"text-xl font-medium ml-2 truncate " + textColor}>{settings.app_name}</div>}
        </div>
    )
}

export default LayoutLogo
