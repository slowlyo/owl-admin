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
                icon: <Icon icon={route.meta.icon}/>,
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

    const splitPath = (path: string) => {
        if(!path){
            return ''
        }

        let arr = path.split('/')
        let res = []
        do {
            res.push(arr.join('/'))
            arr.pop()
        } while (arr.length)

        return res.filter(i => i)
    }

    return (
        <Scrollbars autoHide>
            <Menu
                className="!border-e-0 flex-1"
                mode={mode}
                theme={theme}
                openKeys={openKeys}
                selectedKeys={selectedKeys}
                onOpenChange={(keys: Array<any>) => setOpenKeys(getSetting('system_theme_setting.accordionMenu') ? splitPath(keys[keys.length - 1]) : keys)}
                onClick={clickMenu}
                items={getMenus(customRoutes)}
            />
        </Scrollbars>
    )
}

export default LayoutMenu
