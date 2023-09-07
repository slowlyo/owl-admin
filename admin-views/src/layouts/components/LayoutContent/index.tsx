import {Route, Switch} from 'react-router-dom'
import {useRouter} from '@/hooks/useRouter.tsx'
import {NotFound} from '@/pages/NotFound'
import {useApp} from '@/hooks/useApp.ts'
import {Suspense} from 'react'
import {Spin} from 'antd'

const LayoutContent = () => {
    const router = useRouter()
    const app = useApp()
    const routes = app.getStore('routes')

    // {LazyLoad(route.component)}
    return (
        <div className="p-4">
            <Suspense fallback={<Spin/>}>
                <Switch>
                    {router.getFlattenRoutes(routes).map((route) => {
                        return <Route path={route.path} key={route.name} render={() => route.component}/>
                    })}
                    <Route path="*" key="not_found" component={NotFound}/>
                </Switch>
            </Suspense>
        </div>
    )
}

export default LayoutContent
