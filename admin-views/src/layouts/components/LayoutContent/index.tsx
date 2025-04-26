import React, {useEffect, useMemo, useRef, useState, useCallback} from 'react'
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
import {FloatButton} from 'antd'
import useSmallScreen from '@/hooks/useSmallScreen'

// 设置页面标题
const setPageTitle = (currentRoute, getSetting) => {
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
const clearModal = (getSetting) => {
    if (getSetting('system_theme_setting.keepAlive')) {
        if (document.body.classList.contains('is-modalOpened')) {
            window.location.reload()
        }
    }
}

// 内容区域
const LayoutContent = () => {
    const scrollbarRef = useRef<any>(null)
    const [scroll, setScroll] = useState(0)
    const {getSetting} = useSetting()
    const {routes, defaultRoute, getCurrentRoute} = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname
    const location = useLocation()
    const currentRoute = getCurrentRoute()
    const isSmallScreen = useSmallScreen()
    const layoutMode = getSetting('system_theme_setting.layoutMode')

    // 使用useMemo优化flattenRoutes的计算
    const flattenRoutes = useMemo(() => {
        return getFlattenRoutes(routes) || []
    }, [routes?.length]) // 只依赖routes的长度变化

    // 使用useCallback优化回到顶部的函数
    const backTop = useCallback(() => {
        if (!scrollbarRef.current) return

        const step = scroll / 20
        const back = (top) => {
            if (!scrollbarRef.current) return
            scrollbarRef.current.scrollTop(top)

            if (top <= 0) return
            setTimeout(() => back(top - step), 10)
        }
        back(scroll)
    }, [scroll])

    // 使用useThrottle优化滚动事件处理
    const handleScroll = useCallback(() => {
        if (!scrollbarRef.current) return
        setScroll(scrollbarRef.current.getValues().scrollTop)
    }, [])

    // 处理页面标题和modal
    useEffect(() => {
        setPageTitle(currentRoute, getSetting)
        clearModal(getSetting)
    }, [pathname, routes?.length, currentRoute?.meta?.title])

    // 初始化滚动位置
    useEffect(() => {
        if (scrollbarRef.current) {
            const values = scrollbarRef.current.getValues()
            setScroll(values.scrollTop)
        }
    }, [])

    const shouldShowTabs = getSetting('system_theme_setting.enableTab') && !currentRoute?.is_full
    const shouldShowFooter = !currentRoute?.is_full

    return (
        <div className="h-full flex flex-col bg-[var(--owl-body-bg)]" id="owl-container">
            {shouldShowTabs && <LayoutTabs/>}
            <div className="flex-1">
                <Scrollbars autoHide
                            className="clear-children-mb custom-scrollbar"
                            ref={scrollbarRef}
                            onScroll={handleScroll}>
                    <QueueAnim className="relative"
                               type={[getSetting('system_theme_setting.animateInType'), getSetting('system_theme_setting.animateOutType')]}
                               duration={[getSetting('system_theme_setting.animateInDuration'), getSetting('system_theme_setting.animateInDuration')]}>
                        <div key={`${pathname}-${isSmallScreen}-${layoutMode}`} id={pathname} className="absolute w-full iframe p-5">
                            <Switch location={location}>
                                {flattenRoutes.map(({name, path, component}, index) => {
                                    const shouldKeepAlive = currentRoute?.keep_alive == 1 || 
                                        (getSetting('system_theme_setting.keepAlive') && 
                                         getSetting('layout.keep_alive_exclude')?.indexOf(path) == -1)
                                    
                                    return (
                                        <Route key={`${path}-${index}`} 
                                               path={path.replace(/\?.*$/, '')} 
                                               render={() => (
                                            <KeepAlive name={name}
                                                      cacheKey={`${path}-${isSmallScreen}-${layoutMode}`}
                                                      id={`keep-alive-${name}-${path}-${isSmallScreen}-${layoutMode}`}
                                                      when={shouldKeepAlive}>
                                                {React.createElement(component, {currentRoute})}
                                            </KeepAlive>
                                        )}/>
                                    )
                                })}
                                <Route exact path="/">
                                    <Redirect to={`/${defaultRoute}`}/>
                                </Route>
                                {flattenRoutes.length > 0 && (
                                    <Route path="*" component={lazyLoad(() => import('@/pages/404'))}/>
                                )}
                            </Switch>
                        </div>
                    </QueueAnim>

                    {scroll > 400 && (
                        <FloatButton.BackTop 
                            style={{bottom: '5rem'}} 
                            visibilityHeight={0} 
                            onClick={backTop}
                        />
                    )}
                </Scrollbars>
            </div>
            {shouldShowFooter && <LayoutFooter/>}
        </div>
    )
}

export default LayoutContent
