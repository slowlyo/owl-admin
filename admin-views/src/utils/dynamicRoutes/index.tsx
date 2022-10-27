import {Outlet} from '@umijs/max'
import {lazy} from "react"

export const parseRoutes = (extraRoutes: any[], routes: any[]) => {
    routes.forEach((item: any) => {
        if (item.isLayout) {
            Object.assign(item.children, handleData(extraRoutes, item.id))
        }
    })
}

const handleData = (item: any, parentId: any) => {
    let result: any = []

    item.forEach((val: any, index: number) => {
        let _item: any = {
            id: parentId + '-' + index,
            name: parentId + '-' + index,
            path: val.path,
            parentId: parentId,
            element: <Outlet/>
        }

        if (val.path) {
            if (val.component) {
                let DynamicComponent = lazy(() => import(`@/pages/${val.component}`))

                // 因为他的 element 要的是 React.element 类型
                _item.element = <DynamicComponent/>
            }
        }

        if (val?.routes?.length) {
            _item.children = handleData(val.routes, _item.id)
        }

        result.push(_item)
    })

    return result
}
