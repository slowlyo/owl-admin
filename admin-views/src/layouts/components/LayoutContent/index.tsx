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
import {Scrollbars} from 'react-custom-scrollbars'

// 内容区域
const LayoutContent = () => {
    const {getSetting} = useSetting()
    const {routes, defaultRoute, getCurrentRoute} = useRoute()
    const flattenRoutes = useMemo(() => getFlattenRoutes(routes) || [], [routes])
    const history = useHistory()
    const pathname = history.location.pathname
    const location = useLocation()
    const currentRoute = getCurrentRoute()

    // 设置页面标题
    const setPageTitle = () => {
        let title = currentRoute?.meta?.title
        if (title) {
            const titleTmp = getSetting('layout.title')
            if (titleTmp) {
                title = titleTmp.replace(/%title%/g, title)
            }

            document.title = title
        }
    }

    // 处理 keep-alive 导致 modal 无法关闭的问题
    const clearModal = () => {
        if (getSetting('system_theme_setting.keepAlive')) {
            if (document.body.classList.contains('is-modalOpened')) {
                window.location.reload()
            }
        }
    }

    useEffect(() => {
        setPageTitle()
        clearModal()
    }, [pathname, routes])


    return (
        <div className="h-full flex flex-col bg-[var(--owl-body-bg)]">
            {(getSetting('system_theme_setting.enableTab') && !currentRoute?.is_full) && <LayoutTabs/>}
            <div className="flex-1">
                <Scrollbars autoHide className="clear-children-mb">
                    <div className="p-5 h-full">
                        <QueueAnim className="relative"
                                   type={[getSetting('system_theme_setting.animateInType'), getSetting('system_theme_setting.animateOutType')]}
                                   duration={[getSetting('system_theme_setting.animateInDuration'), getSetting('system_theme_setting.animateInDuration')]}>
                            <div key={pathname} id={pathname} className="absolute w-full iframe">
                                <Switch location={location}>
                                    {flattenRoutes.map(({name, path, component}, index) => {
                                        return <Route key={index}  path={path.replace(/\?.*$/, '')}  render={() => (
                                            // @ts-ignore
                                            <KeepAlive name={name}
                                                       cacheKey={path}
                                                       id={`keep-alive-${name}-${path}`} // 确保ID唯一
                                                       when={currentRoute?.keep_alive  == 1 || getSetting('system_theme_setting.keepAlive') && getSetting('layout.keep_alive_exclude')?.indexOf(path) == -1}>
                                                {React.createElement(component, { currentRoute })}
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
                </Scrollbars>
            </div>
            {!currentRoute?.is_full && <LayoutFooter/>}
        </div>
    )
}

export default LayoutContent
