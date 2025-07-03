import useStore from '@/hooks/useStore'
import {generate} from '@ant-design/colors'
import {mergeObject} from '@/utils/common'
import {useContext, useEffect} from 'react'
import {GlobalContext} from '@/context'

// 设置 html 样式
const setHtmlStyle = (key: string, value: string) => document.documentElement.style.setProperty(key, value)

// 处理主题切换
const darkThemeHandler = (dark = false) => {
    setHtmlStyle('--owl-body-bg', dark ? '#1F1F1F' : '#fafafa')
    setHtmlStyle('--owl-main-bg', dark ? '#141414' : '#fff')
    setHtmlStyle('--borders-radius-3', '8px')
    setHtmlStyle('--borderRadius', '8px')
    setHtmlStyle('--fonts-size-8', '14px')

    let neutral = ['#141414', '#1f1f1f', '#262626', '#434343', '#595959', '#8c8c8c', '#bfbfbf', '#e9e9e9', '#f0f0f0', '#f5f5f5', '#ffffff']

    if (dark) {
        neutral.reverse()
    }

    neutral.forEach((color, index) => {
        setHtmlStyle(`--colors-neutral-text-${index + 1}`, color)
        setHtmlStyle(`--colors-neutral-fill-${index + 1}`, color)
        setHtmlStyle(`--colors-neutral-line-${index + 1}`, color)
    })
}

// 切换主题
const useTheme = (store = null) => {
    if (!store) {
        store = useStore()
    }
    let themeSettings = store.getState().settings.system_theme_setting
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

        return _token
    }

    // 设置主题色
    const setThemeColor = (color, dark = false) => {
        if (!color) return
        if (typeof color !== 'string') return

        const list = generate(color, {theme: dark ? 'dark' : 'default'})

        list.forEach((c, index) => {
            setHtmlStyle(`--colors-brand-${10 - index}`, c)
            setHtmlStyle(`--colors-link-${10 - index}`, c)
        })
        generate('#faad14', {theme: dark ? 'dark' : 'default'}).forEach((c, index) => {
            setHtmlStyle(`--colors-warning-${10 - index}`, c)
        })
        generate('#f5222d', {theme: dark ? 'dark' : 'default'}).forEach((c, index) => {
            setHtmlStyle(`--colors-error-${10 - index}`, c)
        })
        generate('#52c41a', {theme: dark ? 'dark' : 'default'}).forEach((c, index) => {
            setHtmlStyle(`--colors-success-${10 - index}`, c)
        })
        generate('#1677ff', {theme: dark ? 'dark' : 'default'}).forEach((c, index) => {
            setHtmlStyle(`--colors-info-${10 - index}`, c)
            setHtmlStyle(`--colors-other-${10 - index}`, c)
        })

        setToken({token: {colorPrimary: color}})
    }

    // 刷新 token
    const refreshToken = () => {
        setThemeColor(themeSettings?.themeColor, themeSettings?.darkTheme)
        darkThemeHandler(themeSettings?.darkTheme)

        const darkTop = themeSettings?.topTheme == 'dark' && themeSettings?.layoutMode != 'double' && !themeSettings?.darkTheme

        const textColor = (dark, lightColor = '#fff') => dark ? lightColor : 'var(--colors-neutral-text-1)'

        const token = {
            token: {
                colorPrimary: themeSettings?.themeColor,
            },
            components: {
                Layout: {
                    headerBg: darkTop ? '#001529' : 'var(--owl-main-bg)',
                    headerColor: textColor(darkTop),
                },
                Breadcrumb: {
                    lastItemColor: textColor(darkTop),
                    itemColor: textColor(darkTop),
                    separatorColor: textColor(darkTop),
                    linkHoverColor: textColor(darkTop),
                },
            },
        }

        return setToken(token)
    }

    // 设置深色主题
    const setDarkTheme = (dark = false) => {
        const system_theme_setting = Object.assign({}, store.getState().settings.system_theme_setting, {darkTheme: dark})
        store.dispatch({
            type: 'update-settings',
            payload: {settings: {...store.getState().settings, system_theme_setting}}
        })

        darkThemeHandler(dark)
    }

    useEffect(() => {
        refreshToken()
    }, [themeSettings])

    return {
        antdToken,
        setToken,
        setThemeColor,
        setDarkTheme,
        darkThemeHandler,
        refreshToken
    }
}

export default useTheme
