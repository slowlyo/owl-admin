import React, {useEffect, useLayoutEffect, useMemo, useRef, useCallback} from 'react'
import useStorage from '@/utils/useStorage'
import {getFlattenRoutes} from '@/routes/helpers'
import useRoute, {IRoute} from '@/routes'
import {useHistory} from 'react-router'
import {useAliveController} from 'react-activation'
import Tab from './components/Tab'
import {getCacheKey, registerGlobalFunction} from '@/utils/common'
import useSetting from '@/hooks/useSetting'

// 工具函数：检查元素是否在可视区域内
const isElementInViewport = (element: Element, container: Element): boolean => {
    const elementRect = element.getBoundingClientRect()
    const containerRect = container.getBoundingClientRect()

    return (
        elementRect.left >= containerRect.left &&
        elementRect.right <= containerRect.right &&
        elementRect.top >= containerRect.top &&
        elementRect.bottom <= containerRect.bottom
    )
}

// 工具函数：防抖
type DebouncedFn<T extends (...args: any[]) => void> = ((...args: Parameters<T>) => void) & {
    cancel: () => void
}

const debounce = <T extends (...args: any[]) => void>(func: T, wait: number): DebouncedFn<T> => {
    let timeout: ReturnType<typeof setTimeout> | null = null

    const executedFunction = ((...args: Parameters<T>) => {
        const later = () => {
            if (timeout) {
                clearTimeout(timeout)
            }
            timeout = null
            func(...args)
        }

        if (timeout) {
            clearTimeout(timeout)
        }
        timeout = setTimeout(later, wait)
    }) as DebouncedFn<T>

    executedFunction.cancel = () => {
        if (timeout) {
            clearTimeout(timeout)
        }
        timeout = null
    }

    return executedFunction
}

// 工具函数：等待元素出现
const waitForElement = (selector: string, timeout = 3000, signal?: AbortSignal): Promise<Element | null> => {
    return new Promise((resolve) => {
        if (signal?.aborted) {
            resolve(null)
            return
        }

        const element = document.querySelector(selector)
        if (element) {
            resolve(element)
            return
        }

        let settled = false
        let timeoutId: ReturnType<typeof setTimeout> | null = null
        let observer: MutationObserver | null = null

        const cleanup = () => {
            observer?.disconnect()
            if (timeoutId) {
                clearTimeout(timeoutId)
            }
            if (signal) {
                signal.removeEventListener('abort', onAbort)
            }
        }

        const finish = (value: Element | null) => {
            if (settled) return
            settled = true
            cleanup()
            resolve(value)
        }

        observer = new MutationObserver(() => {
            const el = document.querySelector(selector)
            if (el) {
                finish(el)
            }
        })

        const onAbort = () => {
            finish(null)
        }

        observer.observe(document.body, {
            childList: true,
            subtree: true
        })

        // 超时处理
        timeoutId = setTimeout(() => {
            finish(null)
        }, timeout)

        if (signal) {
            signal.addEventListener('abort', onAbort)
        }
    })
}

// Tab
const LayoutTabs = () => {
    const history = useHistory()
    const pathname = history.location.pathname
    const locationKey = history.location.key
    const {routes, defaultRoute, getCurrentRoute} = useRoute()
    const {settings} = useSetting()
    const keyPrefix = localStorage.getItem(getCacheKey('user_name'))
    const [cacheTabs, setCacheTab] = useStorage(getCacheKey(keyPrefix + '_cached_tabs'), '')
    const flattenRoutes = useMemo(() => getFlattenRoutes(routes), [routes])
    const cachedTabs = useMemo(() => JSON.parse(cacheTabs || '[]'), [cacheTabs])
    const defaultTab = useMemo(
        () => flattenRoutes.find((route) => route.path === '/' + defaultRoute),
        [flattenRoutes, defaultRoute]
    )
    const {drop} = useAliveController()

    const [tabs, setTabs] = React.useState<IRoute[]>([])
    const locateTimeoutRef = useRef<NodeJS.Timeout | null>(null)
    const locateRafRef = useRef<number | null>(null)
    const locateAbortRef = useRef<AbortController | null>(null)
    const mountedRef = useRef(true)
    const [pillStyle, setPillStyle] = React.useState<{left: number; width: number; visible: boolean}>(
        {left: 0, width: 0, visible: false}
    )

    // 更新 Tab
    const updateTabs = (_tabs) => {
        if (!mountedRef.current) return
        setTabs([formatTabValue(defaultTab, defaultTab?.path, true), ..._tabs])
    }

    // 初始化 Tab
    const initTab = () => {
        if (cachedTabs.length != 0) {
            cachedTabs.map((tab) => {
                let _tab = flattenRoutes.find((route) => route.name === tab.name)

                if (_tab) {
                    tab.title = _tab.meta.title
                }
            })
        }
        updateTabs(cachedTabs)
    }

    // 格式化 Tab 数据
    const formatTabValue = (tab, path, isDefault = false) => ({
        name: tab?.name,
        path,
        search: isDefault ? '' : history.location.search,
        title: tab?.meta?.title,
        icon: tab?.meta?.icon
    })

    // 获取当前 Tab
    const currentTab = () => {
        const current = getCurrentRoute()

        return current ? formatTabValue(current, pathname) : null
    }

    const updatePill = useCallback(() => {
        const currentTabEl = document.querySelector('.current_selected_tab') as HTMLElement | null
        const tabsContainer = document.querySelector('.owl-tabs') as HTMLElement | null

        if (!currentTabEl || !tabsContainer) {
            if (!mountedRef.current) return
            setPillStyle((prev) => ({...prev, visible: false}))
            return
        }

        let left = 0
        let el: HTMLElement | null = currentTabEl
        while (el && el !== tabsContainer) {
            left += el.offsetLeft
            el = el.offsetParent as HTMLElement | null
        }

        const width = currentTabEl.offsetWidth

        if (!mountedRef.current) return
        setPillStyle({left, width, visible: true})
    }, [])

    const schedulePillUpdate = useCallback((delays: number[]) => {
        const rafIds: number[] = []
        const timeoutIds: number[] = []

        delays.forEach((delay) => {
            if (delay <= 0) {
                rafIds.push(requestAnimationFrame(() => updatePill()))
            } else {
                timeoutIds.push(window.setTimeout(() => updatePill(), delay))
            }
        })

        return () => {
            rafIds.forEach((id) => cancelAnimationFrame(id))
            timeoutIds.forEach((id) => window.clearTimeout(id))
        }
    }, [updatePill])

    // tabIcon 显隐会改变 tab 宽度，需重算 pill 位置/宽度（并在动画结束后再补算一次）
    useEffect(() => {
        return schedulePillUpdate([0, 200])
    }, [settings?.system_theme_setting?.tabIcon, updatePill])

    // 优化后的定位当前 Tab 函数
    const locateTheCurrentTab = useCallback(async () => {
        // 清除之前的定时器
        if (locateTimeoutRef.current) {
            clearTimeout(locateTimeoutRef.current)
        }

        if (locateAbortRef.current) {
            locateAbortRef.current.abort()
        }
        locateAbortRef.current = new AbortController()

        try {
            // 等待当前选中的tab元素出现
            const currentTab = await waitForElement('.current_selected_tab', 1000, locateAbortRef.current.signal)
            if (!currentTab) {
                console.warn('未找到当前选中的tab元素')
                return
            }

            if (!mountedRef.current || locateAbortRef.current.signal.aborted) {
                return
            }

            // 获取tabs容器
            const tabsContainer = document.querySelector('.owl-tabs')
            if (!tabsContainer) {
                console.warn('未找到tabs容器')
                return
            }

            updatePill()

            // 检查元素是否已经在可视区域内
            if (isElementInViewport(currentTab, tabsContainer)) {
                schedulePillUpdate([0, 80])
                return
            }

            // 使用requestAnimationFrame确保DOM更新完成
            locateRafRef.current = requestAnimationFrame(() => {
                if (!mountedRef.current || locateAbortRef.current?.signal.aborted) return
                currentTab.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                })

                updatePill()
            })
        } catch (error) {
            console.error('定位tab时发生错误:', error)
        }
    }, [updatePill])

    // 防抖版本的定位函数
    const debouncedLocateTab = useMemo(() => debounce(locateTheCurrentTab, 100), [locateTheCurrentTab])

    // 切换 Tab
    const changeTab = () => {
        // 使用防抖版本的定位函数
        debouncedLocateTab()
        // 如果当前路由不在缓存中，则添加
        const _currentTab = currentTab()

        if (_currentTab) {
            const exists = cachedTabs.find((tab) => tab.name === _currentTab.name)

            if (_currentTab.path == '/' + defaultRoute) return

            if (exists) {
                const _index = cachedTabs.findIndex((tab) => tab.name === _currentTab.name)
                cachedTabs[_index] = _currentTab
            } else {
                cachedTabs.push(_currentTab)
            }

            setCacheTab(JSON.stringify(cachedTabs))
            updateTabs(cachedTabs)
        }
    }

    // 根据路径关闭选项卡
    const closeTabByPath = (path) => {
        const current = cachedTabs.find((tab) => tab.path === path)

        if (current) {
            closeTab(formatTabValue(current, path))
        }
    }

    // 注册全局方法
    useEffect(() => {
        registerGlobalFunction('closeTabByPath', closeTabByPath)
    }, [closeTabByPath])

    // 关闭选项卡
    const closeTab = (item) => {
        if (item.path == pathname) {
            const currentIndex = tabs.findIndex((tab) => tab.name === item.name)
            // 如果关闭的是当前选项卡，则跳转到上一个选项卡
            const prevTab = tabs[currentIndex - 1]
            history.push(prevTab?.path || ('/' + defaultRoute))
        }

        closeTabs([item])
    }

    // 关闭多个选项卡
    const closeTabs = (items) => {
        // 从缓存中移除对应的选项卡信息
        const updatedCachedTabs = tabs.filter((tab) => (!items.find((item) => item.name === tab.name) && tab.path != '/' + defaultRoute))

        // 更新选项卡列表
        setCacheTab(JSON.stringify(updatedCachedTabs))
        updateTabs(updatedCachedTabs)
        // 清除页面缓存
        items.forEach((item) => drop(item.name))
    }

    // 菜单点击事件
    const menuClick = (action, item) => {
        switch (action) {
            // 刷新
            case 'refresh':
                // iframe
                if (getCurrentRoute()?.url_type == 3) {
                    location.reload()
                } else {
                    window.$owl.refreshAmisPage()
                }
                break
            // 关闭选项卡
            case 'close':
                closeTab(item)
                break
            // 关闭其他选项卡
            case 'closeOthers':
                const needCloseTabs = cachedTabs.filter((tab) => tab.path !== item.path)

                closeTabs(needCloseTabs)
                history.push(item.path)
                break
            // 关闭左侧选项卡
            case 'closeLeft':
                const currentIndex = cachedTabs.findIndex((tab) => tab.path === item.path)
                const needCloseLeftTabs = cachedTabs.filter((tab, index) => index < currentIndex)

                closeTabs(needCloseLeftTabs)
                history.push(item.path)
                break
            // 关闭右侧选项卡
            case 'closeRight':
                const currentIndex2 = cachedTabs.findIndex((tab) => tab.path === item.path)
                const needCloseRightTabs = cachedTabs.filter((tab, index) => index > currentIndex2)

                closeTabs(needCloseRightTabs)
                history.push(item.path)
                break
            // 关闭全部选项卡
            case 'closeAll':
                closeTabs(cachedTabs)
                history.push('/' + defaultRoute)
                break
        }
    }

    // 水平滚动
    const horizontalScroll = ({deltaY}) => document.querySelector('.owl-tabs').scrollLeft += deltaY

    useEffect(() => changeTab(), [routes, pathname, locationKey])
    useEffect(() => initTab(), [routes])

    useLayoutEffect(() => {
        return schedulePillUpdate([0, 0, 120, 300])
    }, [pathname, tabs, updatePill])

    useEffect(() => {
        const tabsContainer = document.querySelector('.owl-tabs') as HTMLElement | null
        if (!tabsContainer) return

        const handleUpdate = () => updatePill()
        tabsContainer.addEventListener('scroll', handleUpdate, {passive: true})
        window.addEventListener('resize', handleUpdate)

        const cleanup = schedulePillUpdate([0])

        return () => {
            cleanup()
            tabsContainer.removeEventListener('scroll', handleUpdate)
            window.removeEventListener('resize', handleUpdate)
        }
    }, [schedulePillUpdate, updatePill])

    useEffect(() => {
        const tabsContainer = document.querySelector('.owl-tabs') as HTMLElement | null
        if (!tabsContainer) return

        const currentTabEl = document.querySelector('.current_selected_tab') as HTMLElement | null
        if (!currentTabEl) return

        if (typeof ResizeObserver === 'undefined') return

        const ro = new ResizeObserver(() => updatePill())
        ro.observe(tabsContainer)
        ro.observe(currentTabEl)

        return () => ro.disconnect()
    }, [pathname, tabs, updatePill])

    useEffect(() => {
        const fonts = (document as any).fonts
        if (!fonts?.ready) return

        let cancelled = false
        fonts.ready.then(() => {
            if (cancelled) return
            updatePill()
        })

        return () => {
            cancelled = true
        }
    }, [updatePill])

    // 清理定时器
    useEffect(() => {
        return () => {
            mountedRef.current = false

            debouncedLocateTab.cancel?.()
            if (locateAbortRef.current) {
                locateAbortRef.current.abort()
            }
            if (locateRafRef.current != null) {
                cancelAnimationFrame(locateRafRef.current)
            }
            if (locateTimeoutRef.current) {
                clearTimeout(locateTimeoutRef.current)
            }
        }
    }, [])

    const tabClass = 'owl-tabs w-full h-[40px] flex px-[20px] overflow-x-auto overflow-y-hidden items-center border-b bg-[var(--owl-main-bg)] scroll-smooth relative'

    return (
        <div className={tabClass} onWheel={horizontalScroll}>
            <div
                className="pointer-events-none absolute top-[8px] left-0 h-[24px] bg-[var(--colors-brand-10)] rounded-[6px] shadow-sm transition-[transform,width,opacity] duration-300 ease-out"
                style={{
                    width: pillStyle.width,
                    transform: `translateX(${pillStyle.left}px)`,
                    opacity: pillStyle.visible ? 1 : 0
                }}
            />

            {tabs.map((item, index) => (
                <Tab key={item?.name || item?.path || index}
                     item={item}
                     close={closeTab}
                     menuClick={(action) => menuClick(action.key, item)}
                     closeable={item?.path != defaultTab?.path}/>
            ))}
        </div>
    )
}

export default LayoutTabs
