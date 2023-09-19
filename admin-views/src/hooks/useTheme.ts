import useStore from '@/hooks/useStore'
import {generate, presetPalettes} from '@ant-design/colors'
import {mergeObject} from '@/utils/common'
import {useState} from 'react'

const setHtmlStyle = (key: string, value: string) => document.documentElement.style.setProperty(key, value)

const useTheme = (store) => {
    if(!store){
        store = useStore()
    }
    const [antdToken, setAntdToken] = useState(store.getState().antdToken)

    // 设置 antd token
    const setToken = (token) => {
        const _token = mergeObject(store.getState().antdToken, token)

        console.clear()
        console.log(_token)
        setAntdToken(_token)

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

    return {
        antdToken,
        setToken,
        setThemeColor
    }
}

export default useTheme
