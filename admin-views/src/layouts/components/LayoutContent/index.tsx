import React, {useEffect, useMemo, useRef, useState, useCallback} from 'react'
import {Redirect, Route, Switch} from 'react-router-dom'
import useRoute from '@/routes'
import lazyLoad from '@/utils/lazyload'
import {useHistory, useLocation} from 'react-router'
import {getFlattenRoutes} from '@/routes/helpers'
import {KeepAlive} from 'react-activation'
import useSetting from '@/hooks/useSetting'
import LayoutTabs from '@/layouts/components/LayoutTabs'
import LayoutFooter from '@/layouts/components/LayoutFooter'
import SimpleBar from 'simplebar-react'
import {FloatButton} from 'antd'
import useSmallScreen from '@/hooks/useSmallScreen'
import {useThrottleFn} from 'ahooks'
import {AnimatePresence, motion} from 'framer-motion'
import {getInVariants, getOutVariants, getAnimateVariants, getTransition} from '@/utils/animation'

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

    const getScrollElement = useCallback(() => {
        if (!scrollbarRef.current) return null
        if (typeof scrollbarRef.current.getScrollElement === 'function') {
            return scrollbarRef.current.getScrollElement()
        }
        return null
    }, [])

    // 使用useMemo优化flattenRoutes的计算
    const flattenRoutes = useMemo(() => {
        const routes_arr = getFlattenRoutes(routes) || []
        // 对路由进行排序：具体路径优先于动态路径（避免 /users/create 被 /users/:id 匹配）
        return routes_arr.sort((a, b) => {
            const aHasParam = a.path.includes(':')
            const bHasParam = b.path.includes(':')
            if (aHasParam && !bHasParam) return 1
            if (!aHasParam && bHasParam) return -1
            return 0
        })
    }, [routes]) // 依赖routes变化

    // 使用useCallback优化回到顶部的函数
    const backTop = useCallback(() => {
        const scrollEl = getScrollElement()
        if (!scrollEl) return

        const step = scroll / 20
        const back = (top) => {
            const el = getScrollElement()
            if (!el) return
            el.scrollTop = top

            if (top <= 0) return
            setTimeout(() => back(top - step), 10)
        }
        back(scroll)
    }, [getScrollElement, scroll])

    // 使用useThrottle优化滚动事件处理
    const {run: handleScroll} = useThrottleFn(() => {
        const scrollEl = getScrollElement()
        if (!scrollEl) return
        setScroll(scrollEl.scrollTop)
    }, {wait: 300})

    // 处理页面标题和modal
    useEffect(() => {
        setPageTitle(currentRoute, getSetting)
        clearModal(getSetting)
    }, [pathname, routes, currentRoute?.meta?.title])

    // 初始化滚动位置
    useEffect(() => {
        const scrollEl = getScrollElement()
        if (!scrollEl) return
        setScroll(scrollEl.scrollTop)
    }, [])

    useEffect(() => {
        const scrollEl = getScrollElement()
        if (!scrollEl) return

        scrollEl.addEventListener('scroll', handleScroll, {passive: true})
        return () => scrollEl.removeEventListener('scroll', handleScroll)
    }, [getScrollElement, handleScroll])

    const shouldShowTabs = getSetting('system_theme_setting.enableTab') && !currentRoute?.is_full
    const shouldShowFooter = getSetting('system_theme_setting.footer') && !currentRoute?.is_full

    return (
        <div className="h-full flex flex-col bg-[var(--owl-body-bg)]" id="owl-container">
            <motion.div layout="position" className="flex flex-col flex-1 min-h-0">
            <AnimatePresence initial={false}>
                {shouldShowTabs && (
                    <motion.div
                        key="layout-tabs"
                        className="origin-top overflow-hidden"
                        initial={{opacity: 0, height: 0}}
                        animate={{opacity: 1, height: 'auto'}}
                        exit={{opacity: 0, height: 0}}
                        transition={{duration: 0.2, ease: 'easeInOut'}}
                    >
                        <LayoutTabs/>
                    </motion.div>
                )}
            </AnimatePresence>
            <motion.div layout="position" className="flex-1 min-h-0">
                <SimpleBar
                    className="clear-children-mb h-full"
                    ref={scrollbarRef}
                    autoHide
                >
                    <div className="relative min-h-full">
                        <AnimatePresence initial={false}>
                            <motion.div
                                key={`${pathname}-${isSmallScreen}`}
                                id={pathname}
                                className="absolute w-full iframe p-5"
                                initial={getInVariants(getSetting('system_theme_setting.animateInType'))}
                                animate={getAnimateVariants()}
                                exit={getOutVariants(getSetting('system_theme_setting.animateOutType'))}
                                transition={getTransition(getSetting('system_theme_setting.animateInDuration'))}
                            >
                                <Switch location={location}>
                                    {flattenRoutes.map((route, index) => {
                                        const {name, path, component} = route
                                        const shouldKeepAlive = route.keep_alive == 1 ||
                                            (getSetting('system_theme_setting.keepAlive') &&
                                                getSetting('layout.keep_alive_exclude')?.indexOf(path) == -1)

                                        return (
                                            <Route key={`${path}-${index}`}
                                                   exact
                                                   path={path.replace(/\?.*$/, '')}
                                                   render={() => (
                                                <KeepAlive name={name}
                                                          cacheKey={`${path}-${isSmallScreen}`}
                                                          id={`keep-alive-${name}-${path}-${isSmallScreen}`}
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
                            </motion.div>
                        </AnimatePresence>
                    </div>

                    <AnimatePresence>
                        {scroll > 400 && (
                            <motion.div
                                key="back-top"
                                initial={{ opacity: 0, scale: 0.5 }}
                                animate={{ opacity: 1, scale: 1 }}
                                exit={{ opacity: 0, scale: 0.5 }}
                                className="fixed right-6 z-50"
                                style={{ bottom: '5rem' }}
                            >
                                <FloatButton.BackTop
                                    style={{ position: 'static' }}
                                    visibilityHeight={0}
                                    onClick={backTop}
                                />
                            </motion.div>
                        )}
                    </AnimatePresence>
                </SimpleBar>
            </motion.div>
            </motion.div>
            <AnimatePresence initial={false}>
                {shouldShowFooter && (
                    <motion.div
                        key="layout-footer"
                        className="origin-bottom overflow-hidden"
                        initial={{opacity: 0, scaleY: 0.9}}
                        animate={{opacity: 1, scaleY: 1}}
                        exit={{opacity: 0, scaleY: 0.9}}
                        transition={{duration: 0.15, ease: 'easeInOut'}}
                    >
                        <LayoutFooter/>
                    </motion.div>
                )}
            </AnimatePresence>
        </div>
    )
}

export default LayoutContent
