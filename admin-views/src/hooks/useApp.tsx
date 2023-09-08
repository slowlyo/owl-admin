import {appLoaded, arrayGet, inLoginPage, isArray, isString} from '@/utils/common.ts'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import useStorage from '@/hooks/useStorage.ts'
import zhCN from 'antd/locale/zh_CN'
import enUS from 'antd/locale/en_US'
import {dynamicAssetsHandler} from '@/utils/dynamicAssets.ts'
import {lazy, useContext} from 'react'
import {GlobalContext} from '@/components/GlobalContext'
import {registerCustomComponents} from '@/components/AmisRender/CustomComponents'
import {useRequest} from 'ahooks'
import {fetchSettings, fetchUserInfo, fetchUserRoutes} from '@/service'

const lazyLoad = (path: string) => {
    const Component = lazy(async () => await import(`../pages/${path}/index.tsx`))
    return <Component/>
}

const useApp = () => {
    const context = useContext(GlobalContext)
    const [lang, setLang] = useStorage('owl-admin-lang', 'zh-CN')

    // 获取全局状态
    const getStore = (key = '', def = '') => {
        const store = useSelector((state: GlobalState) => state)

        return key ? arrayGet(store, key, def) : store
    }

    // 获取语言
    const getAntdLocale = () => {
        switch (lang) {
            case 'zh_CN':
                return zhCN
            case 'en':
                return enUS
            default:
                return zhCN
        }
    }

    const requestSettings = useRequest(fetchSettings, {
        manual: true,
        retryCount: 3,
        cacheKey: 'app-settings',
    })

    // 获取框架设置
    const initSettings = async () => {
        const {data} = await requestSettings.runAsync()
        // 设置语言
        setLang(data.locale)
        // 设置动态资源
        dynamicAssetsHandler(data.assets)
        // 保存框架设置
        context.store.dispatch({
            type: 'update-settings',
            payload: {settings: data},
        })
    }

    const requestUserInfo = useRequest(fetchUserInfo, {manual: true})

    // 初始化用户信息
    const initUserInfo = async () => {
        const {data} = await requestUserInfo.runAsync()

        context.store.dispatch({
            type: 'update-userInfo',
            payload: {userInfo: data},
        })
    }

    const requestRoutes = useRequest(fetchUserRoutes, {
        manual: true,
        cacheKey: 'app-dynamic-routes',
    })

    const componentMount = (routes) => {
        const cached = {}
        const travel = (_routes, parents = []) => {
            return _routes.map((route) => {
                if (route.path && !route.children) {
                    if (isString(route.component)) {
                        if (!cached[route.component]) {
                            cached[route.component] = lazyLoad(route.component)
                        }
                        route.component = cached[route.component]
                    }
                } else if (isArray(route.children) && route.children.length) {
                    route.children = travel(route.children, [...parents, route])
                }
                // 保存父级路由
                route.meta.parents = parents

                return route
            })
        }

        return travel(routes)
    }

    // 获取路由
    const initRoutes = async () => {
        const {data} = await requestRoutes.runAsync()

        context.store.dispatch({
            type: 'update-routes',
            payload: {routes: await componentMount(data)},
        })
    }

    // 初始化
    const init = async () => {
        await initSettings()

        if (!inLoginPage()) {
            await initUserInfo()
            await initRoutes()
        }

        // 注册 amis 组件
        registerCustomComponents()
        // 移除加载动画
        appLoaded()
    }

    return {
        init,
        initUserInfo,
        initRoutes,
        getStore,
        getAntdLocale,
    }
}

export default useApp
