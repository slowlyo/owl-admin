import {useRequest} from 'ahooks'
import {fetchUserRoutes} from '@/service'
import {lazy, useContext} from 'react'
import {GlobalContext} from '@/components/GlobalContext'
import {isArray, isString} from '@/utils/common.ts'

const lazyLoad = (path: string) => {
    const Component = lazy(async () => await import(`../pages/${path}/index.tsx`))
    return <Component/>
}

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
            payload: {routes: await componentMount(data)},
        })
    }

    const componentMount = (routes) => {
        const cached = {}
        const travel = (_routes, parents = []) => {
            return _routes.map((route) => {
                if (route.path && !route.children) {
                    if (isString(route.component)) {
                        if (!cached[route.component]) {
                            cached[route.component] = lazyLoad(route.component)
                        }
                        route.component = cached[route.component]
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

    return {
        initRoutes,
        getFlattenRoutes,
    }
}
