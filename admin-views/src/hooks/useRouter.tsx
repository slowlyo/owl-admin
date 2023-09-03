import {useRequest} from 'ahooks'
import {fetchUserRoutes} from '@/service'
import React, {useContext} from 'react'
import {GlobalContext} from '@/components/GlobalContext'
import {isArray, isString} from '@/utils/common.ts'
import {Icon} from '@iconify/react'
import {LazyLoad} from '@/utils/LazyLoad.tsx'

export const useRouter = () => {
    const context = useContext(GlobalContext)

    const dynamicRoutes = useRequest(fetchUserRoutes, {
        manual: true,
        cacheKey: 'app-dynamic-routes',
    })

    const initRoutes = async () => {
        const {data} = await dynamicRoutes.runAsync()

        context.store.dispatch({
            type: 'update-routes',
            payload: {
                // routes: await componentMount(data)
                routes: data
            },
        })
    }

    const componentMount = (routes) => {
        const travel = (_routes, parents = []) => {
            return _routes.map((route) => {
                if (route.path && !route.children) {
                    if (isString(route.component)) {
                        route.component = LazyLoad(route.component)
                    }
                } else if (isArray(route.children) && route.children.length) {
                    route.children = travel(route.children, [...parents, route])
                }

                // 设置默认图标
                if (!route.meta?.icon || route.meta?.icon == '-') {
                    route.meta.icon = 'ph:circle'
                }

                // 保存父级路由
                route.meta.parents = parents

                return route
            })
        }

        return travel(routes)
    }

    const getFlattenRoutes = (routes) => {
        const flattenRoutes = []

        const stack = [...routes]
        while (stack.length) {
            const route = stack.pop()
            if (route.path && !route.children) {
                flattenRoutes.push(route)
            } else if (isArray(route.children) && route.children.length) {
                stack.push(...route.children)
            }
        }

        return flattenRoutes
    }

    const getMenus = (routes = []) => {
        // let needInit = false
        if (!routes.length) {
            // needInit = true
            const savedMenus = context.store.getState().menus
            if (savedMenus.length) {
                return savedMenus
            }
            routes = context.store.getState().routes
        }

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

        // if (needInit) {
        //     context.store.dispatch({type: 'update-menus', payload: {menus}})
        // }

        return menus
    }

    return {
        initRoutes,
        getMenus,
        getFlattenRoutes,
    }
}
