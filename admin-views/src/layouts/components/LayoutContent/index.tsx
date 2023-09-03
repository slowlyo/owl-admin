import {Route, Switch} from 'react-router-dom'
import {useRouter} from '@/hooks/useRouter.tsx'
import {NotFound} from '@/pages/NotFound'
import {LazyLoad} from '@/utils/LazyLoad.tsx'
import {Suspense} from 'react'
import {Spin} from 'antd'
import {useApp} from '@/hooks/useApp.ts'

export const LayoutContent = () => {
    const router = useRouter()
    const app = useApp()
    const routes = app.getStore('routes')

    return (
        <div className="p-5">
            <Switch>
                {router.getFlattenRoutes(routes).map((route) => {
                    return <Route path={route.path} key={route.name} render={() => (
                        <Suspense fallback={<Spin className="w-full h-full"/>}>
                            {LazyLoad(route.component)}
                        </Suspense>
                    )}/>
                })}
                <Route path="*" key="not_found" element={<NotFound/>}/>
            </Switch>
        </div>
    )
}
