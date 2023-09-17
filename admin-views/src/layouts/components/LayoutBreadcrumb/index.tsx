import React, {useEffect, useState} from 'react'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import useRoute from '@/routes'
import {Breadcrumb} from 'antd'
import {useHistory} from 'react-router'

const LayoutBreadcrumb = () => {
    const {routes, getCurrentRoute} = useRoute()
    const {settings} = useSelector((state: GlobalState) => state)
    const [breadcrumb, setBreadcrumb] = useState<any[]>([])
    const history = useHistory()

    const currentRoute = getCurrentRoute()

    // 获取下拉菜单
    const getDropMenu = (route, isChild = false) => {
        const data = {
            items: route.children.filter(i => !i?.meta?.hide && i.path != currentRoute.path).map((item) => {
                const _item = {key: item.path, label: item.meta?.title}

                if (item?.children?.length) {
                    // 父级菜单，递归获取子菜单
                    const children = getDropMenu(item, true)
                    _item['children'] = children.length ? children : null
                } else {
                    // 非父级菜单，点击跳转
                    _item['onClick'] = () => history.push(item.path)
                }

                return _item
            })
        }

        return isChild ? data.items : data
    }

    // 获取面包屑
    const getBreadcrumb = () => {
        const getItem = (route) => {
            let menu = null
            if (route.children?.length) {
                menu = getDropMenu(route)
            }

            let item = {title: route.meta?.title} as any

            if (menu && menu.items?.length) {
                item = {...item, menu}
            }

            return item
        }

        const list = []

        // 父级
        currentRoute.meta.parents.forEach((route) => {
            if (route.path == currentRoute.path) return
            list.push(getItem(route))
        })
        // 当前
        list.push(getItem(currentRoute))

        return list
    }

    useEffect(() => {
        if (currentRoute) {
            setBreadcrumb(getBreadcrumb() as any || [])
        }
    }, [currentRoute, routes])

    // 面包屑开关
    if (settings.breadcrumb === false) return (<div></div>)

    return (<Breadcrumb className="px-3" items={breadcrumb}/>)
}

export default LayoutBreadcrumb
