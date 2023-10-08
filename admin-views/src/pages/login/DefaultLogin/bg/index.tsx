import React from "react"
import styles from "./style/index.module.css"
import useSetting from '@/hooks/useSetting'
import {generate} from '@ant-design/colors'

const Bg = (props) => {
    const {getSetting} = useSetting()
    const darkTheme = getSetting('system_theme_setting.darkTheme')

    const color = (opacity) => {
        const colorValue = darkTheme ? 180 : 255

        return `rgba(${colorValue}, ${colorValue}, ${colorValue}, ${opacity / 10})`
    }

    const themeColorList = generate(getSetting('system_theme_setting.themeColor', 'white') , {
        theme: darkTheme ? 'dark' : 'default',
    })

    const lightColor = themeColorList[1]
    const darkColor = themeColorList[6]

    const bg = `linear-gradient(200deg, ${lightColor} 0%, ${darkColor} 100%)`

    return (
        <div className={styles.bg} style={{background: bg}}>
            <svg className={styles.waves} xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink"
                 viewBox="0 24 150 28" preserveAspectRatio="none" shapeRendering="auto">
                <defs>
                    <path id="gentle-wave"
                          d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
                </defs>
                <g className={styles.parallax}>
                    <use xlinkHref="#gentle-wave" x="48" y="0" fill={color(7)}/>
                    <use xlinkHref="#gentle-wave" x="48" y="3" fill={color(5)}/>
                    <use xlinkHref="#gentle-wave" x="48" y="5" fill={color(3)}/>
                    <use xlinkHref="#gentle-wave" x="48" y="7" fill={color(10)}/>
                </g>
            </svg>
            <div className={styles["bottom-block"]} style={{background: color(10)}}></div>
            {props.children}
        </div>
    )
}

export default Bg
