import React, {useEffect, useMemo, useRef, useState} from "react"
import {useHistory} from "react-router-dom"
import {Menu as ArcoMenu} from "@arco-design/web-react"
import qs from "query-string"
import useRoute, {IRoute} from "@/routes"
import {isArray, isString} from "@/utils/is"
import lazyload from "@/utils/lazyload"

const MenuItem = ArcoMenu.Item
const SubMenu = ArcoMenu.SubMenu

function getFlattenRoutes(routes) {
    const mod = import.meta.glob("../../../pages/**/[a-z[]*.tsx")
    const res = []

    function travel(_routes) {
        _routes.forEach((route) => {
            if (route.path && !route.children) {
                if (isString(route.component)) {
                    route.component = lazyload(mod[`../../../pages/${route.component}/index.tsx`])
                }
                res.push(route)
            } else if (isArray(route.children) && route.children.length) {
                travel(route.children)
            }
        })
    }

    travel(routes)
    return res
}

export const Menu = (
    {
        mode = "vertical",
        theme = "light",
        routeProps = [],
    }: {
        mode?: "vertical" | "horizontal" | "pop" | "popButton",
        theme?: "light" | "dark",
        routeProps?: any[],
    }
) => {
    const history = useHistory()
    const pathname = history.location.pathname
    const currentComponent = qs.parseUrl(pathname).url.slice(1)

    const [routes, defaultRoute] = useRoute()
    const defaultSelectedKeys = [currentComponent || defaultRoute]
    const paths = (currentComponent || defaultRoute)?.split("/")
    const defaultOpenKeys = paths?.slice(0, paths.length - 1)

    const [selectedKeys, setSelectedKeys] = useState<string[]>(defaultSelectedKeys)
    const [openKeys, setOpenKeys] = useState<string[]>(defaultOpenKeys)

    const menuMap = useRef<Map<string, { menuItem?: boolean; subMenu?: boolean }>>(new Map())

    const customRoutes = routeProps.length > 0 ? routeProps : routes

    const flattenRoutes = useMemo(() => getFlattenRoutes(customRoutes) || [], [customRoutes])

    function onClickMenuItem(path) {
        const currentRoute = flattenRoutes.find((r) => r.path === path)

        currentRoute.component.preload().then(() => history.push(currentRoute.path))
    }

    function renderRoutes() {
        return function travel(_routes: IRoute[], level, parentNode = []) {
            return _routes.map((route) => {
                const {meta} = route
                const iconDom = <i className={meta?.icon + " pr-5px"}></i>
                const titleDom = <> {iconDom} {route?.meta?.title} </>

                const getBreadcrumb = (route) => ({
                    title: route.meta?.title,
                    icon: route.meta?.icon,
                    children: route.children
                })

                const visibleChildren = (route.children || [])

                if (meta?.hide) {
                    return ""
                }

                if (visibleChildren.length) {
                    menuMap.current.set(route.path, {subMenu: true})
                    return (
                        <SubMenu key={route.path} title={titleDom}>
                            {travel(visibleChildren, level + 1, [...parentNode, getBreadcrumb(route)])}
                        </SubMenu>
                    )
                }
                menuMap.current.set(route.path, {menuItem: true})
                return <MenuItem key={route.path}>{titleDom}</MenuItem>
            })
        }
    }

    function updateMenuStatus() {
        const pathKeys = pathname.split("/")
        const newSelectedKeys: string[] = []
        const newOpenKeys: string[] = [...openKeys]
        while (pathKeys.length > 0) {
            const menuKey = pathKeys.join("/")
            const menuType = menuMap.current.get(menuKey)
            if (menuType && menuType.menuItem) {
                newSelectedKeys.push(menuKey)
            }
            if (menuType && menuType.subMenu && !openKeys.includes(menuKey)) {
                newOpenKeys.push(menuKey)
            }
            pathKeys.pop()
        }
        setSelectedKeys(newSelectedKeys)
        setOpenKeys(newOpenKeys)
    }

    useEffect(() => updateMenuStatus(), [pathname, customRoutes])

    return (
        <ArcoMenu
            mode={mode}
            theme={theme}
            onClickMenuItem={onClickMenuItem}
            selectedKeys={selectedKeys}
            openKeys={openKeys}
            onClickSubMenu={(_, openKeys) => setOpenKeys(openKeys)}
        >
            {renderRoutes()(customRoutes, 1)}
        </ArcoMenu>
    )
}
