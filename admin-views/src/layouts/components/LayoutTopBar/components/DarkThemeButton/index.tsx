import IconButton from '@/layouts/components/IconButton'
import useSetting from '@/hooks/useSetting'
import useTheme from '@/hooks/useTheme'

const DarkThemeButton = () => {
    const {getSetting} = useSetting()
    const {setDarkTheme} = useTheme()

    const toggleDarkTheme = () => {
        setDarkTheme(!getSetting('system_theme_setting.darkTheme'))
    }

    if (getSetting('system_theme_setting.followSystemTheme')) {
        return null
    }

    return (
        <IconButton icon={getSetting('system_theme_setting.darkTheme') ? 'ant-design:sun-outlined' : 'ant-design:moon-outlined'}
                    onClick={() => toggleDarkTheme()}/>
    )
}

export default DarkThemeButton
