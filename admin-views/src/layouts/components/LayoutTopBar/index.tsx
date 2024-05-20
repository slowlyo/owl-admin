import AmisRender from '@/components/AmisRender'
import {useSelector} from 'react-redux'
import RefreshButton from '@/layouts/components/LayoutTopBar/components/RefreshButton'
import FullscreenButton from '@/layouts/components/LayoutTopBar/components/FullscreenButton'
import SettingButton from '@/layouts/components/LayoutTopBar/components/SettingButton'
import useSetting from '@/hooks/useSetting'
import DarkThemeButton from '@/layouts/components/LayoutTopBar/components/DarkThemeButton'

// 顶部导航栏
const LayoutTopBar = () => {
    const {userInfo} = useSelector((state: GlobalState) => state)
    const {getSetting} = useSetting()
    const darkTheme = () => getSetting('system_theme_setting.topTheme') == 'dark' && getSetting('system_theme_setting.layoutMode') != 'double'

    return (
        <div className="h-full flex justify-around items-center">
            {/* prependNav */}
            {getSetting('nav.prependNav') && <AmisRender schema={getSetting('nav.prependNav')}/>}

            {getSetting('layout.header.refresh') && <RefreshButton/>}
            {getSetting('layout.header.dark') && <DarkThemeButton/>}
            {getSetting('layout.header.full_screen') && <FullscreenButton/>}
            {getSetting('layout.header.theme_config') && <SettingButton/>}

            {/* appendNav */}
            {getSetting('nav.appendNav') && <AmisRender schema={getSetting('nav.appendNav')}/>}

            <div className="user-navbar bg-transparent h-full cursor-pointer min-w-[120px]" style={darkTheme() ? {
                // @ts-ignore
                '--colors-neutral-text-1': '#fff',
            } : {}}>
                <AmisRender className="h-full !text-white min-w-[120px]" schema={userInfo?.menus}/>
            </div>
        </div>
    )
}

export default LayoutTopBar
