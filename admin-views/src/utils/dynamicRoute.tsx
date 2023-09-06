import {isArray} from '@/utils/common'
import {lazy} from 'react'

export const patch = (original: any, routes: any) => {
    console.log(original, getFlattenRoutes(routes))
    original.map(function (item: any) {
        if (item.isLayout) {
            item.children.push(...getFlattenRoutes(routes))
        }
    })
}

const getFlattenRoutes = (routes: any) => {
    const flattenRoutes = []

    const stack = [...routes]
    while (stack.length) {
        const route = stack.pop()
        if (route.path && !route.children) {
            const DynamicComponent = lazy(() => import(`../pages/${route.component}/index.tsx`))

            flattenRoutes.push({
                id: route.path,
                path: route.path,
                element: <DynamicComponent/>
            })
        } else if (isArray(route.children) && route.children.length) {
            stack.push(...route.children)
        }
    }

    return flattenRoutes
}
