import useStore from '@/hooks/useStore'
import {generate} from '@ant-design/colors'
import {mergeObject} from '@/utils/common'
import {useContext, useEffect} from 'react'
import {GlobalContext} from '@/context'

const setHtmlStyle = (key: string, value: string) => document.documentElement.style.setProperty(key, value)

const useTheme = (store = null) => {
    if (!store) {
        store = useStore()
    }
    const themeSettings = store.getState().settings.system_theme_setting
    const {antdToken, setAntdToken} = useContext(GlobalContext)

    // 设置 antd token
    const setToken = (token) => {
        const _token = mergeObject(store.getState().antdToken, token)

        if (typeof setAntdToken != 'undefined') {
            setAntdToken(JSON.parse(JSON.stringify(_token)))
        }

        store.dispatch({
            type: 'update-antd-token',
            payload: {antdToken: _token},
        })
    }

    // 设置主题色
    const setThemeColor = (color) => {
        const list = generate(color)

        list.forEach((l, index) => {
            setHtmlStyle(`--colors-brand-${10 - index}`, l)
            setHtmlStyle(`--colors-link-${10 - index}`, l)
        })

        setToken({token: {colorPrimary: color}})
    }

    const refreshToken = () => {
        setThemeColor(themeSettings.themeColor)

        const textColor = (theme, lightColor = '#fff') => theme == 'light' ? 'rgba(0, 0, 0, 0.88)' : lightColor

        const token = {
            token: {
                colorPrimary: themeSettings.themeColor
            },
            components: {
                Layout: {
                    headerBg: themeSettings.topTheme == 'light' ? '#fff' : '#001529',
                    headerColor: textColor(themeSettings.topTheme)
                },
                Breadcrumb: {
                    lastItemColor: textColor(themeSettings.topTheme),
                    itemColor: textColor(themeSettings.topTheme),
                    separatorColor: textColor(themeSettings.topTheme),
                    linkHoverColor: textColor(themeSettings.topTheme),
                },
            },
        }

        setAntdToken(token)
    }

    useEffect(() => {
        refreshToken()
    }, [themeSettings])

    return {
        antdToken,
        setToken,
        setThemeColor
    }
}

export default useTheme
