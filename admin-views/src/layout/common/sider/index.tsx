import React, {useState} from "react"
import {Layout} from "@arco-design/web-react"
import {IconMenuFold, IconMenuUnfold,} from "@arco-design/web-react/icon"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import Menu from "../menu"
import styles from "./style/index.module.less"
import Logo from "@/layout/common/Logo"


const ArcoSider = Layout.Sider

export const Sider = ({stateChange}) => {
    const {settings} = useSelector((state: GlobalState) => state)
    const [collapsed, setCollapsed] = useState<boolean>(false)

    const navbarHeight = 60

    function toggleCollapse() {
        setCollapsed((collapsed) => !collapsed)
        stateChange(!collapsed)
    }

    return (
        <ArcoSider
            className={styles["layout-sider"]}
            width={settings.menuWidth}
            collapsedWidth={60}
            collapsed={collapsed}
            theme={settings.siderTheme}
            onCollapse={(collapse) => {
                setCollapsed(collapse)
                stateChange(collapse)
            }}
            trigger={null}
            collapsible
            breakpoint="xl"
            style={{
                paddingTop: settings.layoutMode !== "left" ? navbarHeight : "",
                // eslint-disable-next-line @typescript-eslint/ban-ts-comment
                // @ts-ignore
                "--color-border": settings.siderTheme === "dark" ? "none" : ""
            }}
        >
            {settings.layoutMode === "left" && (
                <div style={{height: navbarHeight}} className="flex items-center">
                    <Logo collapsed={collapsed}/>
                </div>
            )}
            <div className={styles["menu-wrapper"]} style={{
                height: settings.layoutMode === "left" ? `calc(100vh - ${navbarHeight}px)` : ""
            }}>
                <Menu theme={settings.siderTheme}/>
            </div>
            <div className={styles["collapse-btn"]} onClick={toggleCollapse} style={{
                backgroundColor: settings.siderTheme === "dark" ? "rgba(var(--gray-1), 0.2)" : ""
            }}>
                {collapsed ? <IconMenuUnfold/> : <IconMenuFold/>}
            </div>
        </ArcoSider>
    )
}
