import {Layout} from 'antd'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutContent from '@/layouts/components/LayoutContent'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import CollapseTrigger from '@/layouts/components/CollapseTrigger'
import LayoutBreadcrumb from '@/layouts/components/LayoutBreadcrumb'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import {useEffect, useState} from 'react'
import useRoute from '@/routes'
import {Icon} from '@iconify/react'
import {useHistory} from 'react-router'
import useSetting from '@/hooks/useSetting'

const {Header, Sider, Content} = Layout

// 双栏布局
export const DoubleLayout = () => {
    const [collapsed, setCollapsed] = useState(false)
    const {routes, getCurrentRoute} = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname
    const {getSetting} = useSetting()

    const [selectedKeys, setSelectedKeys] = useState<string[]>([])
    const [childrenRoutes, setChildrenRoutes] = useState<any[]>()

    // 更新菜单状态
    function updateMenuStatus() {
        const current = getCurrentRoute()

        if (!current) {
            return
        }

        const _parents = current.meta.parents.map((p) => p.path)

        setSelectedKeys([current.path, ..._parents])
    }

    // 获取顶级菜单
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

    // 初始化子菜单
    const initChildrenRoutes = () => {
        const currentRoute = getCurrentRoute()
        if (currentRoute?.meta.parents.length) {
            setChildrenRoutes(getTopRoute(currentRoute).children)
        } else {
            setChildrenRoutes([])
        }
    }

    // 点击菜单
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
            <Sider collapsedWidth={65}
                   theme={getSetting('system_theme_setting.darkTheme') ? 'light' : 'dark'}
                   className="border-r h-full"
                   collapsed>
                <div>
                    <LayoutLogo onlyLogo/>
                    <div className="w-full h-full overflow-y-auto overflow-x-hidden">
                        {routes?.map(item => {
                            if (item?.meta?.hide) return null
                            const baseStyle = 'text-white flex flex-col items-center justify-center h-[65px] cursor-pointer'
                            const selectStyle = selectedKeys.includes(item.path) ? ' bg-[var(--colors-brand-5)] hover:bg-[var(--colors-brand-5)]' : ' hover:bg-gray-100/20'

                            return (
                                <div key={item.name}
                                     className={baseStyle + selectStyle}
                                     onClick={() => clickItem(item)}
                                     title={item?.meta?.title}>
                                    {(item?.meta?.icon && item?.meta?.icon != '-') && (
                                        <div className="p-1">
                                            <Icon icon={item?.meta?.icon} fontSize={18}/>
                                        </div>
                                    )}
                                    <div className="text-[12px] whitespace-nowrap">
                                        {item?.meta?.title}
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </div>
            </Sider>
            <Sider hidden={!childrenRoutes?.length}
                   width={220}
                   collapsedWidth={65}
                   className="border-r overflow-y-auto"
                   theme="light"
                   collapsed={collapsed}>
                {(!collapsed && !!childrenRoutes?.length) && (
                    <div className="h-[65px] border-b flex justify-center items-center text-xl font-semibold truncate">
                        {getSetting('app_name')}
                    </div>
                )}

                <LayoutMenu collapsed={collapsed} routeProps={childrenRoutes}/>
            </Sider>
            <Layout>
                <Header className="h-[65px] leading-none flex justify-between items-center border-b p-0">
                    <div className="flex h-full items-center">
                        {!!childrenRoutes?.length && <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>}
                        <LayoutBreadcrumb/>
                    </div>
                    <LayoutTopBar/>
                </Header>
                <Content className="overflow-auto overflow">
                    <LayoutContent/>
                </Content>
            </Layout>
        </Layout>
    )
}
