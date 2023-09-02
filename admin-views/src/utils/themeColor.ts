import {generate, presetPalettes} from "@ant-design/colors"

export const setThemeColor = (color: string) => {
    const newList = getColorList(color)

    // newList.forEach((l, index) => {
    //     const rgbStr = presetPalettes(l)
    //     setBodyStyle(`--arcoblue-${index + 1}`, rgbStr)
    //
    //     setHtmlStyle(`--colors-brand-${10 - index}`, l)
    //     setHtmlStyle(`--colors-link-${10 - index}`, l)
    // })
}

export const getColorList = (color: string) => generate(color)

const setHtmlStyle = (key: string, value: string) => document.documentElement.style.setProperty(key, value)

const setBodyStyle = (key: string, value: string) => document.body.style.setProperty(key, value)
