import React, {useState} from 'react'
import {Layout as ArcoLayout} from '@arco-design/web-react'
import cs from 'classnames'
import styles from './style/index.module.less'
import Navbar from './common/nav-bar'
import {Sider} from '@/layout/common/sider'
import {Content} from '@/layout/common/content'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import {DoubleSider} from '@/layout/common/double-sider'
import useRoute from '@/routes'
import {getFlattenRoutes} from '@/routes/helpers'
import {useHistory} from 'react-router'

export const PageLayout =  ({mode = 'default'}: { mode: string }) => {
    const [collapsed, setCollapsed] = useState<boolean>(false)
    const {settings} = useSelector((state: GlobalState) => state)
    const [routes] = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname

    const extraWidth = mode == 'double' ? 65 : 0
    const collapsedWidth = mode == 'double' ? (settings.menuWidth == 0 ? 0 : 65) : 60
    const navbarPadding = collapsed ? extraWidth + collapsedWidth : extraWidth + settings.menuWidth
    const currentRoute = getFlattenRoutes(routes).find((route) => route.path.replace(/\?.*$/, '') === pathname)

    if (currentRoute?.is_full) {
        return (
            <div className="h-screen">
                <Content menuCollapsed={true} noPadding/>
            </div>
        )
    }

    return (
        <>
            {(mode === 'left' || mode === 'double') && (
                // left && double
                <ArcoLayout className={styles.layout}>
                    <div className="z-101">
                        {mode === 'double' && (
                            <DoubleSider stateChange={(value) => setCollapsed(value)}/>
                        ) || (
                            <Sider stateChange={(value) => setCollapsed(value)}/>
                        )}
                    </div>
                    <ArcoLayout>
                        <div className={cs(styles['layout-navbar'])} style={{
                            paddingLeft: navbarPadding,
                            transition: settings.layoutMode === 'double' ? 'none' : ''
                        }}>
                            <Navbar/>
                        </div>
                        <ArcoLayout>
                            <Content menuCollapsed={collapsed}/>
                        </ArcoLayout>
                    </ArcoLayout>
                </ArcoLayout>
            ) || (
                // default && top
                <ArcoLayout className={styles.layout}>
                    <div className={cs(styles['layout-navbar'])}>
                        <Navbar/>
                    </div>
                    <ArcoLayout>
                        {mode === 'default' && (
                            <Sider stateChange={(value) => setCollapsed(value)}/>
                        )}
                        <Content menuCollapsed={collapsed}/>
                    </ArcoLayout>
                </ArcoLayout>
            )}
        </>
    )
}
