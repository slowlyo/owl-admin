import React, {useState} from "react"
import {Button, Drawer, Message, Popconfirm} from "@arco-design/web-react"
import {IconSettings} from "@arco-design/web-react/icon"
import {useDispatch, useSelector} from "react-redux"
import {GlobalState} from "@/store"
import Block from "./block"
import ColorPanel from "./color"
import IconButton from "@/layout/common/nav-bar/components/icon-button"
import useLocale from "@/utils/useLocale"
import defaultSettings from "@/settings.json"
import {useRequest} from "ahooks"
import {saveSettings} from "@/service/api"

interface SettingProps {
    trigger?: React.ReactElement;
}

function Setting(props: SettingProps) {
    const {trigger} = props
    const [visible, setVisible] = useState(false)
    const locale = useLocale()
    const dispatch = useDispatch()
    const {settings, appSettings} = useSelector((state: GlobalState) => state)

    const save = useRequest(saveSettings, {
        manual: true,
        onSuccess: () => {
            Message.success(locale["settings.saveSettings.message"])
            setTimeout(() => location.reload(), 800)
        }
    })

    const submit = () => {
        if (settings.menuWidth === 0) {
            if(settings.layoutMode == 'double'){
                settings.menuWidth = appSettings.system_theme_setting.menuWidth
            }else{
                return Message.warning("注意! 菜单宽度不可为零")
            }
        }

        save.run({system_theme_setting: settings})
    }

    const resetSettings = () => {
        dispatch({
            type: "update-settings",
            payload: {settings: defaultSettings},
        })

        save.run({system_theme_setting: defaultSettings})
    }

    return (
        <>
            {trigger ? (
                React.cloneElement(trigger as React.ReactElement, {
                    onClick: () => setVisible(true),
                })
            ) : (
                <IconButton icon={<IconSettings/>} onClick={() => setVisible(true)}/>
            )}
            <Drawer
                width={320}
                title={
                    <>
                        <IconSettings/>
                        {locale["settings.title"]}
                    </>
                }
                visible={visible}
                onCancel={() => setVisible(false)}
                footer={
                    <>
                        <Popconfirm position="lb"
                                    title={locale["tips"]}
                                    content={locale["settings.restoreDefault.confirm"]}
                                    onOk={resetSettings}>
                            <Button type="primary" status="warning">
                                {locale["settings.restoreDefault"]}
                            </Button>
                        </Popconfirm>
                        <Button type="primary" onClick={submit}>
                            {locale["settings.save"]}
                        </Button>
                    </>
                }
            >
                <Block title={locale["settings.themeColor"]}>
                    <ColorPanel/>
                </Block>
                <Block
                    title={locale["settings.menu"]}
                    options={[
                        {
                            name: "settings.loginTemplate",
                            value: "loginTemplate",
                            type: "select",
                            options: ["default", "simple", "amis"]
                        },
                        {
                            name: "settings.layoutMode",
                            value: "layoutMode",
                            type: "select",
                            options: ["default", "top", "left", "double"]
                        },
                        {name: "settings.menuWidth", value: "menuWidth", type: "number"},
                        {name: "settings.siderTheme", value: "siderTheme", type: "select", options: ["light", "dark"]},
                        {name: "settings.topTheme", value: "topTheme", type: "select", options: ["light", "dark"]},
                    ]}
                />
                <Block
                    title={locale["settings.content"]}
                    options={[
                        {name: "settings.keepAlive", value: "keepAlive", alpha: true},
                        {name: "settings.enableTab", value: "enableTab"},
                        {name: "settings.tabIcon", value: "tabIcon"},
                        {name: "settings.footer", value: "footer"},
                        {name: "settings.breadcrumb", value: "breadcrumb"},
                        {name: "settings.breadcrumbIcon", value: "breadcrumbIcon"},
                    ]}
                />
                <Block
                    title={locale["settings.pageAnimate"]}
                    options={[
                        {
                            name: "settings.pageAnimate.animateIn",
                            value: "animateInType",
                            type: "select",
                            options: ["alpha", "left", "right", "top", "bottom", "scale", "scaleBig", "scaleX", "scaleY"]
                        },
                        {name: "settings.pageAnimate.animateInDuration", value: "animateInDuration", type: "number"},
                        {
                            name: "settings.pageAnimate.animateOut",
                            value: "animateOutType",
                            type: "select",
                            options: ["alpha", "left", "right", "top", "bottom", "scale", "scaleBig", "scaleX", "scaleY"]
                        },
                        {name: "settings.pageAnimate.animateOutDuration", value: "animateOutDuration", type: "number"},
                    ]}
                />
            </Drawer>
        </>
    )
}

export default Setting
