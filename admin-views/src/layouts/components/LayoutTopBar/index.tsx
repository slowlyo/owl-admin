import AmisRender from '@/components/AmisRender'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import RefreshButton from '@/layouts/components/LayoutTopBar/components/RefreshButton'
import FullscreenButton from '@/layouts/components/LayoutTopBar/components/FullscreenButton'
import SettingButton from '@/layouts/components/LayoutTopBar/components/SettingButton'
import useSetting from '@/hooks/useSetting'

const LayoutTopBar = () => {
    const {userInfo} = useSelector((state: GlobalState) => state)
    const {getSetting} = useSetting()
    const darkTheme = () => getSetting('system_theme_setting.topTheme') == 'dark' && getSetting('system_theme_setting.layoutMode') != 'double'

    return (
        <div className="h-full flex justify-around items-center">
            {/* prependNav */}
            {getSetting('nav.prependNav') && <AmisRender schema={getSetting('nav.prependNav')}/>}

            <RefreshButton/>
            <FullscreenButton/>
            <SettingButton/>

            {/* appendNav */}
            {getSetting('nav.appendNav') && <AmisRender schema={getSetting('nav.appendNav')}/>}

            <div className="bg-transparent h-full cursor-pointer" style={{
                // @ts-ignore
                '--colors-neutral-text-1': darkTheme() ? '#fff' : 'rgba(0, 0, 0, 0.88)',
            }}>
                <AmisRender className="h-full !text-white" schema={userInfo?.menus}/>
            </div>
        </div>
    )
}

export default LayoutTopBar
