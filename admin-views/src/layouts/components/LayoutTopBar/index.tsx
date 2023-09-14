import AmisRender from '@/components/AmisRender'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import RefreshButton from '@/layouts/components/LayoutTopBar/components/RefreshButton'
import FullscreenButton from '@/layouts/components/LayoutTopBar/components/FullscreenButton'
import SettingButton from '@/layouts/components/LayoutTopBar/components/SettingButton'

const LayoutTopBar = () => {
    const {userInfo} = useSelector((state: GlobalState) => state)

    return (
        <div className="h-full flex justify-around items-center">
            <RefreshButton/>
            <FullscreenButton/>
            <SettingButton/>
            <div className="bg-transparent h-full pr-6 cursor-pointer hover:bg-gray-100 transition duartion-300">
                <AmisRender className="h-full" schema={userInfo?.menus}/>
            </div>
        </div>
    )
}

export default LayoutTopBar
