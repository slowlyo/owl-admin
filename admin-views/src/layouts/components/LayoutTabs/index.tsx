import React, {useEffect} from 'react'
import useStorage from '@/utils/useStorage'
import {getFlattenRoutes} from '@/routes/helpers'
import useRoute, {IRoute} from '@/routes'
import {useHistory} from 'react-router'
import {useAliveController} from 'react-activation'
import Tab from './components/Tab'
import {getCacheKey, registerGlobalFunction} from '@/utils/common'

const LayoutTabs = () => {
    const history = useHistory()
    const pathname = history.location.pathname
    const {routes, defaultRoute, getCurrentRoute} = useRoute()
    const flattenRoutes = getFlattenRoutes(routes)
    const keyPrefix = localStorage.getItem(getCacheKey('_user_name'))
    const [cacheTabs, setCacheTab] = useStorage(getCacheKey(keyPrefix + '_cached_tabs'), '')
    const cachedTabs = JSON.parse(cacheTabs || '[]')
    const defaultTab = flattenRoutes.find((route) => route.path === '/' + defaultRoute)
    const {drop} = useAliveController()

    const [tabs, setTabs] = React.useState<IRoute[]>([])

    const updateTabs = (_tabs) => {
        setTabs([formatTabValue(defaultTab, defaultTab?.path), ..._tabs])
    }

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

    const formatTabValue = (tab, path) => ({name: tab?.name, path, title: tab?.meta?.title, icon: tab?.meta?.icon})

    const currentTab = () => {
        const current = getCurrentRoute()

        return current ? formatTabValue(current, pathname) : null
    }

    const locateTheCurrentTab = () => {
        setTimeout(() => {
            // 定位当前选项卡
            const tab = document.querySelector('.current_selected_tab')

            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    tab?.scrollIntoView({behavior: 'smooth', block: 'center', inline: 'center'})
                }, 200)
            }
        }, 100)
    }

    const changeTab = () => {
        locateTheCurrentTab()

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

    const closeTabByPath = (path) => {
        const current = cachedTabs.find((tab) => tab.path === path)

        if (current) {
            closeTab(formatTabValue(current, path))
        }
    }

    registerGlobalFunction('closeTabByPath', closeTabByPath)

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

    const closeTabs = (items) => {
        // 从缓存中移除对应的选项卡信息
        const updatedCachedTabs = tabs.filter((tab) => (!items.find((item) => item.name === tab.name) && tab.path != '/' + defaultRoute))

        // 更新选项卡列表
        updateTabs(updatedCachedTabs)
        setCacheTab(JSON.stringify(updatedCachedTabs))
        // 清除页面缓存
        items.forEach((item) => drop(item.name))
    }

    const menuClick = (action, item) => {
        switch (action) {
            case 'close':
                closeTab(item)
                break
            case 'closeOthers':
                const needCloseTabs = cachedTabs.filter((tab) => tab.path !== item.path)

                closeTabs(needCloseTabs)
                history.push(item.path)
                break
            case 'closeLeft':
                const currentIndex = cachedTabs.findIndex((tab) => tab.path === item.path)
                const needCloseLeftTabs = cachedTabs.filter((tab, index) => index < currentIndex)

                closeTabs(needCloseLeftTabs)
                history.push(item.path)
                break
            case 'closeRight':
                const currentIndex2 = cachedTabs.findIndex((tab) => tab.path === item.path)
                const needCloseRightTabs = cachedTabs.filter((tab, index) => index > currentIndex2)

                closeTabs(needCloseRightTabs)
                history.push(item.path)
                break
            case 'closeAll':
                closeTabs(cachedTabs)
                history.push('/' + defaultRoute)
                break
        }
    }

    // 水平滚动
    const horizontalScroll = ({deltaY}) => document.querySelector('.owl-tabs').scrollLeft += deltaY

    useEffect(() => changeTab(), [routes, pathname])
    useEffect(() => initTab(), [routes])

    const tabClass = 'owl-tabs w-full h-[40px] flex px-[20px] overflow-x-auto overflow-y-hidden items-center border-b bg-[var(--owl-main-bg)] scroll-smooth'

    return (
        <div className={tabClass} onWheel={horizontalScroll}>
            {tabs.map((item, index) => (
                <Tab key={index}
                     item={item}
                     close={closeTab}
                     menuClick={(action) => menuClick(action.key, item)}
                     closeable={item?.path != defaultTab?.path}/>
            ))}
        </div>
    )
}

export default LayoutTabs
