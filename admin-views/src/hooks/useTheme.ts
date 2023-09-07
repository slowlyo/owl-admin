import {ThemeConfig} from 'antd'

export const useTheme = () => {
    const getThemeConfig = (): ThemeConfig => {
        return {
            token: {
                borderRadius: 4,
                wireframe: true
            },
            components: {
                Menu: {
                    iconSize: 18,
                    collapsedIconSize: 18,
                    subMenuItemBg: '#fff',
                    darkSubMenuItemBg: '#001529',
                    itemMarginInline: 8
                }
            }
        }
    }

    return {
        getThemeConfig
    }
}
