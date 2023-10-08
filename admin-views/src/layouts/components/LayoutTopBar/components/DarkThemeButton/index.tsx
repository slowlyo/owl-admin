import IconButton from '@/layouts/components/IconButton'
import useSetting from '@/hooks/useSetting'
import useTheme from '@/hooks/useTheme'

const DarkThemeButton = () => {
    const {settings} = useSetting()
    const {setDarkTheme} = useTheme()

    const toggleDarkTheme = () => {
        setDarkTheme(!settings.system_theme_setting.darkTheme)
    }

    if (settings.system_theme_setting.followSystemTheme) {
        return null
    }

    return (
        <IconButton icon={settings.system_theme_setting.darkTheme ? 'material-symbols:light-mode-outline' : 'material-symbols:dark-mode-outline'}
                    onClick={() => toggleDarkTheme()}/>
    )
}

export default DarkThemeButton
