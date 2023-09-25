import {Layout} from 'antd'
import LayoutFooter from '../components/LayoutFooter'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutContent from '@/layouts/components/LayoutContent'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import CollapseTrigger from '@/layouts/components/CollapseTrigger'
import LayoutBreadcrumb from '@/layouts/components/LayoutBreadcrumb'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import {useEffect, useMemo, useState} from 'react'
import useRoute from '@/routes'
import {Icon} from '@iconify/react'
import {getFlattenRoutes} from '@/routes/helpers'
import {useHistory} from 'react-router'

const {Header, Sider, Content} = Layout

export const DoubleLayout = () => {
    const [collapsed, setCollapsed] = useState(false)
    const {routes, getCurrentRoute} = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname

    const [selectedKeys, setSelectedKeys] = useState<string[]>([])
    const [childrenRoutes, setChildrenRoutes] = useState<any[]>()

    function updateMenuStatus() {
        const current = getCurrentRoute()

        if (!current) {
            return
        }

        const _parents = current.meta.parents.map((p) => p.path)

        setSelectedKeys([current.path, ..._parents])
    }

    const getTopRoute = (current) => {
        const parents = current?.meta?.parents

        let topRoute = null

        routes.filter((route) => !route.meta.hide).forEach((menu) => {
            if (menu.path === parents[0].path) {
                topRoute = menu
            }
        })

        return topRoute
    }

    const initChildrenRoutes = () => {
        const currentRoute = getCurrentRoute()
        if (currentRoute?.meta.parents.length) {
            setChildrenRoutes(getTopRoute(currentRoute).children)
        } else {
            setChildrenRoutes([])
        }
    }

    const clickItem = (item) => {
        if (item.is_link) {
            window.open(item.path)
            return
        }

        setSelectedKeys([item?.path])
        if (item?.children?.length) {
            setChildrenRoutes(item.children)
        } else {
            setChildrenRoutes([])

            // @ts-ignore
            item.component.preload().then(() => history.push(item.path))
        }
    }

    useEffect(() => {
        initChildrenRoutes()
        updateMenuStatus()
    }, [pathname, routes])

    return (
        <Layout className="h-screen overflow-hidden">
            <Sider collapsedWidth={64} theme="dark" collapsed>
                <LayoutLogo onlyLogo/>
                <div className="w-full h-full">
                    {routes?.map(item => {
                        if (item?.meta?.hide) return null
                        const baseStyle = 'text-white flex flex-col items-center py-2 cursor-pointer hover:bg-gray-100/20'
                        const selectStyle = selectedKeys.includes(item.path) ? ' bg-white text-dark hover:bg-white' : ''

                        return (
                            <div key={item.name} className={baseStyle + selectStyle}
                                 onClick={() => clickItem(item)}>
                                <div className="p-1">
                                    <Icon icon={item?.meta?.icon} fontSize={18}/>
                                </div>
                                <div className="text-[10px]">
                                    {item?.meta?.title}
                                </div>
                            </div>
                        )
                    })}
                </div>
            </Sider>
            <Sider hidden={!childrenRoutes?.length}
                   width={220}
                   collapsedWidth={64}
                   className="border-r"
                   theme="light"
                   collapsed={collapsed}>
                {(!collapsed && !!childrenRoutes?.length) && (
                    <div className="h-[64px] border-b flex justify-center items-center text-xl font-semibold truncate">
                        {getTopRoute(childrenRoutes[0])?.meta?.title}
                    </div>
                )}

                <LayoutMenu collapsed={collapsed} routeProps={childrenRoutes}/>
            </Sider>
            <Layout>
                <Header className="h-[64px] leading-none flex justify-between items-center bg-white border-b p-0">
                    <div className="flex h-full items-center">
                        {!!childrenRoutes?.length && <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>}
                        <LayoutBreadcrumb/>
                    </div>
                    <LayoutTopBar/>
                </Header>
                <Content className="overflow-auto overflow">
                    <LayoutContent/>
                    <LayoutFooter/>
                </Content>
            </Layout>
        </Layout>
    )
}
