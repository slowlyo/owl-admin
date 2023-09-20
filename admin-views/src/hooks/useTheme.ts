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
    const themeColor = store.getState().settings.system_theme_setting.themeColor
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

    useEffect(() => {
        setThemeColor(themeColor)
    }, [themeColor])

    return {
        antdToken,
        setToken,
        setThemeColor
    }
}

export default useTheme
