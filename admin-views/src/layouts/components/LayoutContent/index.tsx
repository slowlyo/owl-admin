import {Outlet} from 'react-router'
import {Route, Routes} from 'react-router-dom'
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

    // {LazyLoad(route.component)}
    return (
        <div className="p-5">
            <Routes>
                {router.getFlattenRoutes(routes).map((route) => {
                    return <Route path={route.path} key={route.name} element={(
                        <Suspense fallback={<Spin/>}>
                            {LazyLoad(route.component)}
                        </Suspense>
                    )}/>
                    // return <Route path={route.path} key={route.name} element={route.component}/>
                })}
                <Route path="*" key="not_found" element={<NotFound/>}/>
            </Routes>
        </div>
    )
}
