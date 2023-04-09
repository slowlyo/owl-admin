import React, {useContext, useEffect, useState} from "react"
import {Tooltip,} from "@arco-design/web-react"
import {IconFullscreen, IconFullscreenExit, IconMoonFill, IconRefresh, IconSunFill,} from "@arco-design/web-react/icon"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import {GlobalContext} from "@/context"
import useLocale from "@/utils/useLocale"
import IconButton from "./components/icon-button"
import Settings from "./components/settings"
import styles from "./style/index.module.less"
import {Menu as LayoutMenu} from "../menu"
import {removeToken} from "@/utils/checkLogin"
import {useRequest} from "ahooks"
import {fetchLogout} from "@/service/api"
import AmisRender from "@/components/AmisRender"
import {Breadcrumb} from "@/layout/common/breadcrumb"
import Logo from "@/layout/common/Logo"
import registerGlobalFunction from "@/utils/registerGlobalFunction"

function Navbar() {
    const t = useLocale()
    const {userInfo, settings, appSettings} = useSelector((state: GlobalState) => state)
    const {theme, setTheme} = useContext(GlobalContext)
    const [refreshing, setRefreshing] = useState(false)

    const [fullScreen, setFullScreen] = useState(document.fullscreenElement != null)
    const toggleFullScreen = () => {
        if (document.fullscreenElement) {
            document.exitFullscreen()
        } else {
            document.documentElement.requestFullscreen()
        }
    }
    useEffect(() => {
        document.addEventListener("fullscreenchange", () => {
            setFullScreen(!!document.fullscreenElement)
        })
    }, [])

    const logout = useRequest(fetchLogout, {
        manual: true,
        onSuccess() {
            removeToken()
            window.location.hash = "#/login"
        }
    })

    const showLogo = (settings.layoutMode == "default" || settings.layoutMode == "top")
    const darkTheme = settings.topTheme == "dark"

    registerGlobalFunction("logout", () => logout.run())

    const UserMenu = () => {
        if (!userInfo.menus) return null

        return (
            <li className="px-8px flex item-center" style={{
                // eslint-disable-next-line @typescript-eslint/ban-ts-comment
                // @ts-ignore
                "--button-default-default-bg-color": darkTheme ? "none" : "",
                "--button-default-hover-bg-color": darkTheme ? "none" : "",
                "--color-text-1": darkTheme ? "var(--color-text-4)" : ""
            }}>
                <AmisRender schema={userInfo.menus}/>
            </li>
        )
    }

    return (
        <div className={styles.navbar} style={{
            backgroundColor: darkTheme ? "var(--color-menu-dark-bg)" : "",
            borderBottomColor: darkTheme ? "#333335" : "",
        }}>
            {showLogo && <Logo/>}
            <div className="flex flex-1 pr-20px justify-between list-none">
                {settings.layoutMode == "top" ? (
                    <div className="flex-1 overflow-hidden">
                        <LayoutMenu mode="horizontal" theme={settings.topTheme}/>
                    </div>
                ) : (
                    <Breadcrumb/>
                )}

                <ul className="flex">
                    {/* 刷新 */}
                    {appSettings?.layout?.header?.refresh && (
                        <li className="pr-8px flex item-center">
                            <Tooltip content={t["settings.refresh"]}>
                                <IconButton className={refreshing && styles.rotate}
                                            icon={<IconRefresh/>}
                                            onClick={() => {
                                                setRefreshing(true)
                                                window.$owl.refreshAmisPage().then(() => {
                                                    setTimeout(() => setRefreshing(false), 500)
                                                })
                                            }}/>
                            </Tooltip>
                        </li>
                    )}
                    {/* 全屏 */}
                    {appSettings?.layout?.header?.full_screen && (
                        <li className="pr-8px flex item-center">
                            <Tooltip content={fullScreen ? t["settings.fullscreen.exit"] : t["settings.fullscreen.enter"]}>
                                <IconButton
                                    icon={fullScreen ? <IconFullscreenExit/> : <IconFullscreen/>}
                                    onClick={toggleFullScreen}
                                />
                            </Tooltip>
                        </li>
                    )}
                    {/* 主题切换 */}
                    {appSettings?.layout?.header?.switch_theme && (
                        <li className="pr-8px flex item-center">
                            <Tooltip content={theme === "light" ? t["settings.navbar.theme.toDark"] : t["settings.navbar.theme.toLight"]}>
                                <IconButton
                                    icon={theme !== "dark" ? <IconMoonFill/> : <IconSunFill/>}
                                    onClick={() => setTheme(theme === "light" ? "dark" : "light")}
                                />
                            </Tooltip>
                        </li>
                    )}
                    {/* 主题设置 */}
                    {appSettings?.layout?.header?.theme_config && <Settings/>}
                    <UserMenu/>
                </ul>
            </div>

        </div>
    )
}

export default Navbar
