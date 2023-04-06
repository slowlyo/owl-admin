import React, {useState} from "react"
import {Layout as ArcoLayout} from "@arco-design/web-react"
import cs from "classnames"
import styles from "./style/index.module.less"
import Navbar from "./common/nav-bar"
import {Sider} from "@/layout/common/sider"
import {Content} from "@/layout/common/content"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import {DoubleSider} from "@/layout/common/double-sider"

export default function ({mode}: { mode: string }) {
    const [collapsed, setCollapsed] = useState<boolean>(false)
    const {settings} = useSelector((state: GlobalState) => state)

    const extraWidth = settings.layoutMode == "double" ? 60 : 0
    const navbarPadding = collapsed ? extraWidth + 60 : extraWidth + settings.menuWidth

    // default / top / left
    return (
        <>
            {(mode === "left" || mode === "double") && (
                // left && double
                <ArcoLayout className={styles.layout}>
                    <div className="z-101">
                        {mode === "double" && (
                            <DoubleSider stateChange={(value) => setCollapsed(value)}/>
                        ) || (
                            <Sider stateChange={(value) => setCollapsed(value)}/>
                        )}
                    </div>
                    <ArcoLayout>
                        <div className={cs(styles["layout-navbar"])} style={{
                            paddingLeft: navbarPadding,
                            transition: settings.layoutMode === "double" ? "none" : ""
                        }}>
                            <Navbar/>
                        </div>
                        <ArcoLayout>
                            <Content menuCollapsed={collapsed}/>
                        </ArcoLayout>
                    </ArcoLayout>
                </ArcoLayout>
            ) || (
                // default && top
                <ArcoLayout className={styles.layout}>
                    <div className={cs(styles["layout-navbar"])}>
                        <Navbar/>
                    </div>
                    <ArcoLayout>
                        {mode === "default" && (
                            <Sider stateChange={(value) => setCollapsed(value)}/>
                        )}
                        <Content menuCollapsed={collapsed}/>
                    </ArcoLayout>
                </ArcoLayout>
            )}
        </>
    )
}
