import React, {useEffect, useMemo} from 'react'
import {Redirect, Route, Switch} from 'react-router-dom'
import {Layout} from '@arco-design/web-react'
import {useSelector} from 'react-redux'
import useRoute from '@/routes'
import lazyLoad from '@/utils/lazyload'
import {GlobalState} from '@/store'
import {useHistory, useLocation} from 'react-router'
import QueueAnim from 'rc-queue-anim'
import {getFlattenRoutes} from '@/routes/helpers'
import {KeepAlive} from 'react-activation'
import TabBar from '@/layout/common/tab-bar'
import useSetting from '@/hooks/useSetting'

const ArcoContent = Layout.Content

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
        <div className="p-5">
            {getSetting('system_theme_setting.enableTab') && <TabBar/>}
            <div>
                <QueueAnim className="relative"
                           type={[getSetting('system_theme_setting.animateInType'), getSetting('system_theme_setting.animateOutType')]}
                           duration={[getSetting('system_theme_setting.animateInDuration'), getSetting('system_theme_setting.animateInDuration')]}>
                    <ArcoContent key={pathname} id={pathname} className="absolute w-full">
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
                                <Route path="*" component={lazyLoad(() => import('@/pages/exception/403'))}/>
                            )}
                        </Switch>
                    </ArcoContent>
                </QueueAnim>
            </div>
        </div>
    )
}

export default LayoutContent
