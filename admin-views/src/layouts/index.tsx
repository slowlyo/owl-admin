import React, {useEffect, useState} from 'react'
import useRoute from '@/routes'
import {useHistory} from 'react-router'
import DefaultLayout from '@/layouts/DefaultLayout'
import LayoutContent from '@/layouts/components/LayoutContent'
import SmLayout from '@/layouts/SmLayout'
import useSmallScreen from '@/hooks/useSmallScreen'
import TopLayout from '@/layouts/TopLayout'
import TopMixLayout from '@/layouts/TopMixLayout'
import {DoubleLayout} from '@/layouts/DoubleLayout'
import SettingPanel from '@/layouts/components/SettingPanel'
import useSetting from '@/hooks/useSetting'
import {appLoaded, goToLoginPage, Token} from '@/utils/common'

// 应用整体布局
const Layout = () => {
    const {getCurrentRoute} = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname
    const isSmallScreen = useSmallScreen()
    const [isSm, setIsSm] = useState<boolean>(isSmallScreen)
    const {getSetting} = useSetting()

    const currentRoute = getCurrentRoute()

    // 根据配置渲染不同布局
    const RenderLayout = (mode:string) => {
        switch (mode) {
            case 'default':
                return <DefaultLayout/>
            case 'top':
                return <TopLayout/>
            case 'top-mix':
                return <TopMixLayout/>
            case 'double':
                return <DoubleLayout/>
            default:
                return <></>
        }
    }

    // 监听屏幕大小
    useEffect(() => {
        if (isSm !== isSmallScreen) {
            // 解决刷新后页面不显示的问题
            window.$owl.appLoader()
            setIsSm(isSmallScreen)
            history.push('/')
            setTimeout(() => {
                history.push(pathname)
                setTimeout(() => {
                    appLoaded()
                }, 600)
            }, 300)
        }
    }, [isSmallScreen])

    // 判断是否登录
    if(!Token().value){
        goToLoginPage()
    }

    // 判断是否全屏
    if (currentRoute?.is_full) {
        return (
            <div className="h-screen">
                <LayoutContent/>
            </div>
        )
    }

    return (
        <>
            {isSmallScreen ? <SmLayout/> : RenderLayout(getSetting('system_theme_setting.layoutMode', 'default'))}
            <SettingPanel/>
        </>
    )
}

export default Layout
