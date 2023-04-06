import React, {ReactNode, useContext} from "react"
import {Divider, InputNumber, Select, Switch} from "@arco-design/web-react"
import {useDispatch, useSelector} from "react-redux"
import {GlobalState} from "@/store"
import useLocale from "@/utils/useLocale"
import styles from "./style/block.module.less"
import {GlobalContext} from "@/context"

const Option = Select.Option

export interface BlockProps {
    title?: ReactNode;
    options?: { name: string; value: string; type?: "switch" | "number" | "select"; options?: string[] }[];
    children?: ReactNode;
}

export default function Block(props: BlockProps) {
    const {title, options, children} = props
    const locale = useLocale()
    const settings = useSelector((state: GlobalState) => state.settings)
    const dispatch = useDispatch()
    const {setTheme} = useContext(GlobalContext)

    const changeSetting = (option: any, value: any) => {
        const newSetting = {
            ...settings,
            [option.value]: value,
        }

        if(option.value === "theme"){
            setTheme(value)
        }

        dispatch({
            type: "update-settings",
            payload: {settings: newSetting},
        })
    }

    return (
        <div className={styles.block}>
            <h5 className={styles.title}>{title}</h5>
            {options && options.map((option) => {
                const type = option.type || "switch"

                return (
                    <div className={styles["switch-wrapper"]} key={option.value}>
                        <span>{locale[option.name]}</span>
                        {type === "switch" && (
                            <Switch
                                size="small"
                                checked={!!settings[option.value]}
                                onChange={(checked) => {
                                    const newSetting = {
                                        ...settings,
                                        [option.value]: checked,
                                    }
                                    dispatch({
                                        type: "update-settings",
                                        payload: {settings: newSetting},
                                    })
                                }}
                            />
                        )}
                        {type === "number" && (
                            <InputNumber
                                style={{width: 100}}
                                size="small"
                                value={settings[option.value]}
                                onChange={(value) => changeSetting(option, value)}
                            />
                        )}
                        {type === "select" && (
                            <Select
                                size="small"
                                style={{width: 100}}
                                value={settings[option.value]}
                                onChange={(value) => changeSetting(option, value)}
                            >
                                {option.options?.map((item) => (
                                    <Option key={item} value={item}> {locale[option.name + "." + item]} </Option>
                                ))}
                            </Select>
                        )
                        }
                    </div>
                )
            })}
            {children}
            <Divider/>
        </div>
    )
}
