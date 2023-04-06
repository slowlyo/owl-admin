import React from "react"
import {Image,} from "@arco-design/web-react"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import styles from "./style/index.module.less"

function Logo({collapsed, hideLogo}: { collapsed?: boolean, hideLogo?: boolean }) {
    const {settings, appSettings} = useSelector((state: GlobalState) => state)

    const darkTheme = () => {
        if (settings.topTheme === "dark" && (settings.layoutMode === "top" || settings.layoutMode === "default")) {
            return true
        } else if (settings.siderTheme === "dark" && settings.layoutMode === "left") {
            return true
        }else if(settings.siderTheme === "dark" && settings.layoutMode === "double"){
            return true
        }
        return false
    }

    return (
        <div className="flex items-center justify-center" style={{width: collapsed ? 60 : settings.menuWidth}}>
            <div className={styles.logo + (collapsed ? "p-0" : "")}>
                <div>
                    {(!!appSettings.logo && !hideLogo) && (
                        <Image src={appSettings.logo} width={35} preview={false}/>
                    )}
                </div>
                {!collapsed && (
                    <div className={styles["logo-name"]} style={{
                        color: darkTheme() ? "var(--color-text-4)" : ""
                    }}>
                        {appSettings.app_name}
                    </div>
                )}
            </div>
        </div>
    )
}

export default Logo