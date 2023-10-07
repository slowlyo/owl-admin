import React, {useEffect, useMemo} from 'react'
import {Redirect, Route, Switch} from 'react-router-dom'
import useRoute from '@/routes'
import lazyLoad from '@/utils/lazyload'
import {useHistory, useLocation} from 'react-router'
import QueueAnim from 'rc-queue-anim'
import {getFlattenRoutes} from '@/routes/helpers'
import {KeepAlive} from 'react-activation'
import useSetting from '@/hooks/useSetting'
import LayoutTabs from '@/layouts/components/LayoutTabs'
import LayoutFooter from '@/layouts/components/LayoutFooter'


const LayoutContent = () => {
    const {getSetting} = useSetting()
    const {routes, defaultRoute} = useRoute()
    const flattenRoutes = useMemo(() => getFlattenRoutes(routes) || [], [routes])
    const history = useHistory()
    const pathname = history.location.pathname
    const location = useLocation()

    const setPageTitle = () => {
        let title = flattenRoutes.find((route) => route.path === pathname)?.meta?.title
        if (title) {
            const titleTmp = getSetting('layout.title')
            if (titleTmp) {
                title = titleTmp.replace(/%title%/g, title)
            }

            document.title = title
        }
    }

    useEffect(() => {
        setPageTitle()
    }, [pathname, routes])

    return (
        <div className="h-full overflow-hidden flex flex-col">
            {getSetting('system_theme_setting.enableTab') && <LayoutTabs/>}
            <div className="flex-1 p-5 overflow-auto">
                <QueueAnim className="relative"
                           type={[getSetting('system_theme_setting.animateInType'), getSetting('system_theme_setting.animateOutType')]}
                           duration={[getSetting('system_theme_setting.animateInDuration'), getSetting('system_theme_setting.animateInDuration')]}>
                    <div key={pathname} id={pathname} className="absolute w-full">
                        <Switch location={location}>
                            {flattenRoutes.map(({name, path, component}, index) => {
                                return <Route key={index} path={path.replace(/\?.*$/, '')} render={() => (
                                    <KeepAlive name={name}
                                               cacheKey={path}
                                               when={getSetting('system_theme_setting.keepAlive') && getSetting('layout.keep_alive_exclude')?.indexOf(path) == -1}>
                                        {React.createElement(component)}
                                    </KeepAlive>
                                )}/>
                            })}
                            <Route exact path="/">
                                <Redirect to={`/${defaultRoute}`}/>
                            </Route>
                            {flattenRoutes.length && (
                                <Route path="*" component={lazyLoad(() => import('@/pages/404'))}/>
                            )}
                        </Switch>
                    </div>
                </QueueAnim>
            </div>
            <LayoutFooter/>
        </div>
    )
}

export default LayoutContent
