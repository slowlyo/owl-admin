import React from "react"
import {Trigger} from "@arco-design/web-react"
import {SketchPicker} from "react-color"
import {generate} from "@arco-design/color"
import {useDispatch, useSelector} from "react-redux"
import {GlobalState} from "@/store"
import styles from "./style/color-panel.module.less"
import {setThemeColor} from "@/utils/themeColor"

function ColorPanel() {
    const settings = useSelector((state: GlobalState) => state.settings)
    const themeColor = settings.themeColor
    const list = generate(themeColor, {list: true})
    const dispatch = useDispatch()

    return (
        <div>
            <Trigger
                trigger="hover"
                position="bl"
                popup={() => (
                    <SketchPicker
                        color={themeColor}
                        onChangeComplete={(color) => {
                            const newColor = color.hex
                            dispatch({
                                type: "update-settings",
                                payload: {settings: {...settings, themeColor: newColor}},
                            })
                            setThemeColor(newColor)
                        }}
                    />
                )}
            >
                <div className={styles.input}>
                    <div
                        className={styles.color}
                        style={{backgroundColor: themeColor}}
                    />
                    <span>{themeColor}</span>
                </div>
            </Trigger>
            <ul className={styles.ul}>
                {list.map((item, index) => (
                    <li
                        key={index}
                        className={styles.li}
                        style={{backgroundColor: item}}
                    />
                ))}
            </ul>
        </div>
    )
}

export default ColorPanel
