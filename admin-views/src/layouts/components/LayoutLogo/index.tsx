import {Image} from 'antd'
import {useModel} from '@@/plugin-model'

export const LayoutLogo = ({onlyLogo = false}) => {
    const {getSetting} = useModel('settingModel')

    return (
        <div className="w-full h-[60px] flex justify-center items-center border-b">
            <div className="w-[35px]">
                <Image width={35} preview={false} src={getSetting('logo')}/>
            </div>
            {onlyLogo || <div className="text-xl font-medium ml-2 truncate">{getSetting('app_name')}</div>}
        </div>
    )
}
