import React, {useEffect, useRef, useState} from "react"
import {Layout, Menu as ArcoMenu} from "@arco-design/web-react"
import {IconMenuFold, IconMenuUnfold,} from "@arco-design/web-react/icon"
import {useSelector, useDispatch} from "react-redux"
import {GlobalState} from "@/store"
import qs from "query-string"
import {Menu} from "../menu"
import styles from "./style/index.module.less"
import Logo from "@/layout/common/Logo"
import useRoute from "@/routes"
import {useHistory} from "react-router"
import lazyload from "@/utils/lazyload"
import {isString} from "@/utils/is"
import {Icon} from "@iconify/react"

const ArcoSider = Layout.Sider

const MenuItem = ArcoMenu.Item

export const DoubleSider = ({stateChange}) => {
    const history = useHistory()
    const dispatch = useDispatch()
    const pathname = history.location.pathname
    const currentComponent = qs.parseUrl(pathname).url.slice(1)
    const {settings, appSettings} = useSelector((state: GlobalState) => state)
    const [collapsed, setCollapsed] = useState<boolean>(false)
    const routeMap = useRef<Map<string, React.ReactNode[]>>(new Map())
    const [routes, defaultRoute] = useRoute()
    const leftMenus = routes.filter((route) => !route.meta.hide)

    const defaultSelectedKeys = [currentComponent || defaultRoute]
    const [selectedKeys, setSelectedKeys] = useState<string[]>(defaultSelectedKeys)
    const [childrenRoutes, setChildrenRoutes] = useState<any[]>()

    const navbarHeight = 60

    if (!appSettings.system_theme_setting?.menuWidth) {
        dispatch({
            type: "update-app-settings",
            payload: {
                appSettings: {
                    ...appSettings,
                    system_theme_setting: {
                        ...appSettings.system_theme_setting,
                        menuWidth: settings.menuWidth
                    }
                }
            }
        })
    }

    const setShowRight = (value) => {
        dispatch({
            type: "update-settings",
            payload: {
                settings: {...settings, menuWidth: value ? appSettings.system_theme_setting.menuWidth : 0}
            }
        })
    }

    function updateMenuStatus() {
        const pathKeys = pathname.split("/")
        const newSelectedKeys: string[] = []

        while (pathKeys.length > 0) {
            const menuKey = pathKeys.join("/")
            newSelectedKeys.push(menuKey)
            pathKeys.pop()
        }
        setSelectedKeys(newSelectedKeys)
    }

    const initChildrenRoutes = () => {
        const pathKeys = pathname.split("/").filter((item) => item)
        const currentRoute = routes.find((r) => r.path === `/${pathKeys[0]}`)
        if (currentRoute?.children?.length) {
            setChildrenRoutes(currentRoute.children)
            setShowRight(true)
        }
    }

    const onClickMenuItem = (path) => {
        const currentRoute = routes.find((r) => r.path === path)

        setSelectedKeys([path])
        if (currentRoute?.children?.length) {
            setChildrenRoutes(currentRoute.children)
        } else {
            setChildrenRoutes([])
            if (isString(currentRoute.component)) {
                const mod = import.meta.glob("../../../pages/**/[a-z[]*.tsx")
                currentRoute.component = lazyload(mod[`../../../pages/${currentRoute.component}/index.tsx`])
            }

            // eslint-disable-next-line @typescript-eslint/ban-ts-comment
            // @ts-ignore
            currentRoute.component.preload().then(() => history.push(currentRoute.path))
        }
    }

    function toggleCollapse() {
        setCollapsed((collapsed) => !collapsed)
        stateChange(!collapsed)
    }

    useEffect(() => setShowRight(childrenRoutes?.length), [childrenRoutes])

    useEffect(() => {
        initChildrenRoutes()
        updateMenuStatus()
    }, [pathname, routes])

    return (
        <>
            <ArcoSider
                className={styles["layout-sider"] + " br"}
                width={65}
                theme="dark"
                trigger={null}
                collapsible
                breakpoint="xl"
            >
                <div style={{height: navbarHeight}} className="flex items-center">
                    <Logo collapsed={true}/>
                </div>
                <div className={styles["left-menu"]}>
                    <ArcoMenu theme="dark" onClickMenuItem={onClickMenuItem} selectedKeys={selectedKeys}>
                        {leftMenus.map((menu) => {
                            routeMap.current.set(menu.path, [{
                                title: menu.meta?.title,
                                icon: menu.meta?.icon,
                                children: menu.children
                            }])
                            return (
                                <MenuItem key={menu.path}>
                                    <div className="flex flex-col items-center text-12px line-height-12px justify-center h-full">
                                        <Icon icon={menu.meta.icon} className="text-18px mb-8px"/>
                                        <div className="">
                                            {menu.meta.title}
                                        </div>
                                    </div>
                                </MenuItem>
                            )
                        })}
                    </ArcoMenu>
                </div>
            </ArcoSider>

            <ArcoSider
                className={styles["layout-sider"]}
                width={settings.menuWidth}
                collapsedWidth={65}
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
                    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
                    // @ts-ignore
                    "--color-border": settings.siderTheme === "dark" ? "none" : "",
                    left: "65px"
                }}
            >
                <div className={styles.bb + " flex items-center justify-center"} style={{height: navbarHeight}}>
                    {!collapsed && <Logo collapsed={collapsed} hideLogo/>}

                    <div className={styles["collapse-btn"]} onClick={toggleCollapse} style={{
                        backgroundColor: settings.siderTheme === "dark" ? "rgba(var(--gray-1), 0.2)" : "",
                        borderTopRightRadius: collapsed ? "2px" : 0,
                        borderBottomRightRadius: collapsed ? "2px" : 0,
                    }}>
                        {collapsed ? <IconMenuUnfold/> : <IconMenuFold/>}
                    </div>
                </div>

                <div className={styles["menu-wrapper"]}>
                    <Menu theme={settings.siderTheme} routeProps={childrenRoutes}/>
                </div>
            </ArcoSider>
        </>
    )
}
