import lazyload from "@/utils/lazyload"
import {isArray, isString} from '@/utils/common'

export const componentMount = (routes) => {
    const mod = import.meta.glob("../pages/**/[a-z[]*.tsx")

    const travel = (_routes, parents = []) => {
        return _routes.map((route) => {
            if (route.path && !route.children) {
                if (isString(route.component)) {
                    route.component = lazyload(mod[`../pages/${route.component}/index.tsx`])
                }
            } else if (isArray(route.children) && route.children.length) {
                route.children = travel(route.children, [...parents, route])
            }

            // 设置默认图标
            if (!route.meta?.icon || route.meta?.icon == "-") {
                route.meta.icon = "ph:circle"
            }

            // 保存父级路由
            route.meta.parents = parents

            return route
        })
    }

    return travel(routes)
}

export const getFlattenRoutes = (routes) => {
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
