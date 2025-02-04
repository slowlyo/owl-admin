import React, {useEffect, useMemo, useState} from 'react'
import {useHistory} from 'react-router-dom'
import {Menu} from 'antd'
import qs from 'query-string'
import useRoute from '@/routes'
import {getFlattenRoutes} from '@/routes/helpers'
import {Icon} from '@iconify/react'
import {Scrollbars} from 'react-custom-scrollbars'
import useSetting from '@/hooks/useSetting'

// 菜单
const LayoutMenu = (
    {
        mode = 'inline',
        theme = 'light',
        routeProps = [],
        collapsed = false,
    }: {
        mode?: 'vertical' | 'horizontal' | 'inline',
        theme?: 'light' | 'dark',
        routeProps?: any[],
        collapsed?: boolean,
    }
) => {
    const {getSetting} = useSetting()
    const history = useHistory()
    const pathname = history.location.pathname
    const currentComponent = qs.parseUrl(pathname).url.slice(1)

    const {routes, defaultRoute, getCurrentRoute} = useRoute()
    const defaultSelectedKeys = [currentComponent || defaultRoute]
    const paths = (currentComponent || defaultRoute)?.split('/')
    const defaultOpenKeys = paths?.slice(0, paths.length - 1)

    const [selectedKeys, setSelectedKeys] = useState<string[]>(defaultSelectedKeys)
    const [openKeys, setOpenKeys] = useState<string[]>(defaultOpenKeys)

    const customRoutes = routeProps.length > 0 ? routeProps : routes
    const flattenRoutes = useMemo(() => getFlattenRoutes(customRoutes) || [], [customRoutes])

    // 更新菜单状态
    function updateMenuStatus() {
        const current = getCurrentRoute()

        if (!current) {
            return
        }

        const _parents = current.meta.parents.map((p) => p.path)

        const getListPath = (path: string) => path.replace(/\/create$|\/:id\/edit$|\/:id$/g, '')

        setSelectedKeys([current.path.split('?')[0], getListPath(current.path), ..._parents])

        if (mode == 'inline') {
            setOpenKeys([...openKeys, ..._parents])
        }
    }

    useEffect(() => updateMenuStatus(), [pathname, customRoutes, collapsed])

    // 获取菜单
    const getMenus = (routes = []) => {
        let menus = []
        for (let route of routes) {
            if (route.meta?.hide) {
                continue
            }

            menus.push({
                key: route.path.split('?')[0],
                label: route.meta.title,
                icon: <div className="!ml-[-2px]"><Icon icon={route.meta.icon}/></div>,
                children: route.children ? getMenus(route.children) : null,
            })
        }

        return menus
    }

    // 菜单点击事件
    const clickMenu = (e) => {
        const currentRoute = flattenRoutes.find((r) => r.path.split('?')[0] === e.key)

        if (currentRoute.is_link) {
            window.open(currentRoute.path)
            return
        }

        currentRoute.component.preload().then(() => history.push(currentRoute.path))
    }

    const pathMap = useMemo(() => {
        const getMenuPaths = (pages) => {
            const result = []

            const traverse = (page, pathAccumulator) => {
                const currentPath = [...pathAccumulator, page.path]
                result.push(currentPath)

                if (page.children && page.children.length > 0) {
                    page.children.forEach(child => traverse(child, currentPath))
                }
            }

            pages.forEach(page => traverse(page, []))
            return result
        }

        const list = getMenuPaths(customRoutes)
        const result = new Map()

        list.forEach(items => {
            const lastItem = items[items.length - 1] as string

            if (lastItem.includes(':')) return

            result.set(lastItem, items)
        })

        return result
    }, [customRoutes])

    const openChange = (keys: Array<any>) => {
        const isOpen = keys.length > openKeys.length

        // 没有开启 "手风琴" 或者 正在关闭菜单, 则直接返回
        if (!isOpen || !getSetting('system_theme_setting.accordionMenu')) {
            setOpenKeys(keys)
            return
        }

        setOpenKeys(pathMap.get(keys[keys.length - 1]) || [])
    }

    return (
        <Scrollbars autoHide>
            <Menu
                className="!border-e-0 flex-1"
                mode={mode}
                theme={theme}
                openKeys={openKeys}
                selectedKeys={selectedKeys}
                onOpenChange={(keys: Array<any>) => openChange(keys)}
                onClick={clickMenu}
                items={getMenus(customRoutes)}
            />
        </Scrollbars>
    )
}

export default LayoutMenu
