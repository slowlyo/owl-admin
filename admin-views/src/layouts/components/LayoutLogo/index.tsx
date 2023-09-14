import {Image} from 'antd'
import useSettings from '@/hooks/userSettings'

const LayoutLogo = ({onlyLogo = false}) => {
    const {settings} = useSettings()
    const width = onlyLogo ? ' w-full' : ' w-[220px]'

    return (
        <div className={'h-[64px] flex justify-center items-center' + width}>
            <div className="w-[35px]">
                <Image width={35} preview={false} src={settings.logo}/>
            </div>
            {onlyLogo || <div className="text-xl font-medium ml-2 truncate">{settings.app_name}</div>}
        </div>
    )
}

export default LayoutLogo
