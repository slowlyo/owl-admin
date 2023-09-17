import React, {useEffect, useMemo, useState} from 'react'
import {useHistory} from 'react-router-dom'
import {Menu} from 'antd'
import qs from 'query-string'
import useRoute from '@/routes'
import {getFlattenRoutes} from '@/routes/helpers'
import {Icon} from '@iconify/react'

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
    const history = useHistory()
    const pathname = history.location.pathname
    const currentComponent = qs.parseUrl(pathname).url.slice(1)

    const {routes, defaultRoute} = useRoute()
    const defaultSelectedKeys = [currentComponent || defaultRoute]
    const paths = (currentComponent || defaultRoute)?.split('/')
    const defaultOpenKeys = paths?.slice(0, paths.length - 1)

    const [selectedKeys, setSelectedKeys] = useState<string[]>(defaultSelectedKeys)
    const [openKeys, setOpenKeys] = useState<string[]>(defaultOpenKeys)

    const customRoutes = routeProps.length > 0 ? routeProps : routes

    const flattenRoutes = useMemo(() => getFlattenRoutes(customRoutes) || [], [customRoutes])

    function updateMenuStatus() {
        const current = flattenRoutes.find((r) => r.path.replace(/\?.*$/, '') === pathname)

        if (!current) {
            return
        }

        const _parents = current.meta.parents.map((p) => p.path)

        setSelectedKeys([current.path, ..._parents])

        if (mode == 'inline') {
            setOpenKeys([...openKeys, ..._parents])
        }
    }

    useEffect(() => updateMenuStatus(), [pathname, customRoutes, collapsed])

    const getMenus = (routes = []) => {
        let menus = []
        for (let route of routes) {
            if (route.meta?.hide) {
                continue
            }

            menus.push({
                key: route.path,
                label: route.meta.title,
                icon: <Icon icon={route.meta.icon}/>,
                children: route.children ? getMenus(route.children) : null,
            })
        }

        return menus
    }

    const clickMenu = (e) => {
        const currentRoute = flattenRoutes.find((r) => r.path === e.key)

        if (currentRoute.is_link) {
            window.open(currentRoute.path)
            return
        }

        currentRoute.component.preload().then(() => history.push(currentRoute.path))
    }

    return (
        <Menu
            className="!border-e-0 flex-1"
            mode={mode}
            theme={theme}
            openKeys={openKeys}
            selectedKeys={selectedKeys}
            onOpenChange={(keys) => setOpenKeys(keys)}
            onClick={clickMenu}
            items={getMenus(customRoutes)}
        />
    )
}

export default LayoutMenu
