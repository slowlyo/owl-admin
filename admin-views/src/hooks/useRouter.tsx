import {useRequest} from 'ahooks'
import {fetchUserRoutes} from '@/service'
import {lazy, useContext} from 'react'
import {GlobalContext} from '@/components/GlobalContext'
import {isArray, isString} from '@/utils/common.ts'


export const useRouter = () => {
    const context = useContext(GlobalContext)


    const getFlattenRoutes = (routes?:any) => {
        if(!routes){
            routes = context.store.getState().routes
        }

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
