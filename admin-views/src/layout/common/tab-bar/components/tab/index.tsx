import React from "react"
import locale from "@/locale"
import {Icon} from "@iconify/react"
import {useSelector} from "react-redux"
import {useHistory} from "react-router"
import useLocale from "@/utils/useLocale"
import styles from "./style/index.module.less"
import ContextMenu from "@arco-materials/context-menu"
import {ItemType} from "@arco-materials/context-menu/es/inferface"
import {GlobalState} from "@/store"

const Tab = ({item, close, menuClick, closeable = true}) => {
    const t = useLocale(locale)
    const history = useHistory()
    const pathname = history.location.pathname
    const {settings} = useSelector((state: GlobalState) => state)

    if (!item) return null

    const menuItem = (title, icon) => {
        return (
            <div className="flex items-center">
                <Icon icon={icon} className="mr-8px text-16px"/>
                <span>{title}</span>
            </div>
        )
    }

    const contextMenus = [
        {
            key: "close",
            text: menuItem(t["contextMenus.close"], "mdi:close")
        },
        {
            key: "closeOthers",
            text: menuItem(t["contextMenus.closeOthers"], "ant-design:column-width-outlined")
        },
        {
            key: "closeLeft",
            text: menuItem(t["contextMenus.closeLeft"], "ri:contract-left-line")
        },
        {
            key: "closeRight",
            text: menuItem(t["contextMenus.closeRight"], "ri:contract-right-line")
        },
        {
            key: "closeAll",
            text: menuItem(t["contextMenus.closeAll"], "fluent:subtract-20-filled")
        }
    ]

    return (
        <>
            {item.title && (
                <ContextMenu items={contextMenus as ItemType[]} onClickItem={menuClick}>
                    <div className={styles.tab + " " + (pathname == item.path ? styles.tabSelected : "")}
                         onClick={() => history.push(item.path)}>
                        {settings.tabIcon && <Icon icon={item.icon} className="mr-8px"/>}
                        {item.title}
                        {closeable && (
                            <Icon icon="mdi:close" className={styles.close} onClick={(e) => {
                                e.stopPropagation()
                                close(item)
                            }}/>
                        )}
                    </div>
                </ContextMenu>
            )}
        </>
    )
}

export default Tab
