import {useSettings} from '@/hooks/useSettings.ts'
import {Image} from 'antd'

export const LayoutLogo = ({onlyLogo = false}) => {
    const settings = useSettings().get()

    return (
        <div className="w-full h-[60px] flex justify-center items-center border-b">
            <div className="w-[35px]">
                <Image width={35} preview={false} src={settings.logo}/>
            </div>
            {onlyLogo || <div className="text-xl font-medium ml-2 truncate">{settings.app_name}</div>}
        </div>
    )
}
