import React, {useEffect, useMemo, useRef, useState} from 'react'
import {useHistory} from 'react-router-dom'
import {Menu as ArcoMenu} from '@arco-design/web-react'
import qs from 'query-string'
import useRoute, {IRoute} from '@/routes'
import {getFlattenRoutes} from '@/routes/helpers'
import {Icon} from '@iconify/react'
import styles from './style/index.module.less'

const MenuItem = ArcoMenu.Item
const SubMenu = ArcoMenu.SubMenu

const Menu = (
    {
        mode = 'vertical',
        theme = 'light',
        routeProps = [],
    }: {
        mode?: 'vertical' | 'horizontal' | 'pop' | 'popButton',
        theme?: 'light' | 'dark',
        routeProps?: any[],
    }
) => {
    const history = useHistory()
    const pathname = history.location.pathname
    const currentComponent = qs.parseUrl(pathname).url.slice(1)

    const [routes, defaultRoute] = useRoute()
    const defaultSelectedKeys = [currentComponent || defaultRoute]
    const paths = (currentComponent || defaultRoute)?.split('/')
    const defaultOpenKeys = paths?.slice(0, paths.length - 1)

    const [selectedKeys, setSelectedKeys] = useState<string[]>(defaultSelectedKeys)
    const [openKeys, setOpenKeys] = useState<string[]>(defaultOpenKeys)

    const menuMap = useRef<Map<string, { menuItem?: boolean; subMenu?: boolean }>>(new Map())

    const customRoutes = routeProps.length > 0 ? routeProps : routes

    const flattenRoutes = useMemo(() => getFlattenRoutes(customRoutes) || [], [customRoutes])

    function onClickMenuItem(path) {
        const currentRoute = flattenRoutes.find((r) => r.path === path)

        if (currentRoute.is_link) {
            window.open(currentRoute.path)
            return
        }

        currentRoute.component.preload().then(() => history.push(currentRoute.path))
    }

    function renderRoutes() {
        return function travel(_routes: IRoute[], level, parentNode = []) {
            return _routes.map((route) => {
                const {meta} = route
                const titleDom = (
                    <div className="inline-block w-full h-full">
                        <div className={'flex items-center'}>
                            <div className="inline-flex mr-8px" style={{height: '40px'}}>
                                <Icon icon={meta?.icon} style={{fontSize: '18px'}} className="my-auto"/>
                            </div>
                            <div className="inline-flex overflow-hidden"> {route?.meta?.title} </div>
                        </div>
                    </div>
                )

                const visibleChildren = (route.children || [])

                if (meta?.hide) {
                    return ''
                }

                if (visibleChildren.length) {
                    menuMap.current.set(route.path, {subMenu: true})
                    return (
                        <SubMenu key={route.path} title={titleDom}>
                            {travel(visibleChildren, level + 1, [...parentNode])}
                        </SubMenu>
                    )
                }
                menuMap.current.set(route.path, {menuItem: true})
                return <MenuItem key={route.path}>{titleDom}</MenuItem>
            })
        }
    }

    function updateMenuStatus() {
        const current = flattenRoutes.find((r) => r.path.replace(/\?.*$/, '') === pathname)

        if (!current) {
            return
        }

        const _parents = current.meta.parents.map((p) => p.path)

        setSelectedKeys([current.path, ..._parents])
        setOpenKeys([...openKeys, ..._parents])
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
            className={styles['custom-menu']}
        >
            {renderRoutes()(customRoutes, 1)}
        </ArcoMenu>
    )
}

export default Menu
