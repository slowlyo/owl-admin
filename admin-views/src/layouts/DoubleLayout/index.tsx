import {Affix, Layout} from 'antd'
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
import {Scrollbars} from 'react-custom-scrollbars'

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
        <Layout className="h-screen" hasSider>
            <Sider collapsedWidth={65}
                   width={65}
                   theme={getSetting('system_theme_setting.darkTheme') ? 'light' : 'dark'}
                   className="border-r relative"
                   collapsed>
                <div className="absolute flex items-center justify-center w-full h-[65px]">
                    <LayoutLogo onlyLogo/>
                </div>

                <Scrollbars autoHide className="custom-scrollbar">
                    <div className="w-full h-full pt-[65px]">
                        {routes?.map(item => {
                            if (item?.meta?.hide) return null
                            const baseStyle = 'group text-white flex flex-col items-center justify-center h-[65px] cursor-pointer transition-all duration-200 ease-in-out'
                            const selectStyle = selectedKeys.includes(item.path) ? ' bg-[var(--colors-brand-5)] hover:bg-[var(--colors-brand-5)]' : ' hover:bg-gray-100/20 hover:text-gray-100'

                            return (
                                <div key={item.name}
                                     className={baseStyle + selectStyle}
                                     onClick={() => clickItem(item)}
                                     title={item?.meta?.title}>
                                    {(item?.meta?.icon && item?.meta?.icon != '-') && (
                                        <div className="p-1 transition-transform duration-200 ease-in-out group-hover:scale-110">
                                            <Icon icon={item?.meta?.icon} fontSize={18}/>
                                        </div>
                                    )}
                                    <div className="text-[12px] whitespace-nowrap transition-all duration-200 ease-in-out">
                                        {item?.meta?.title}
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </Scrollbars>
            </Sider>
            <Layout>
                <Sider width={childrenRoutes?.length ? 220 : 0}
                       collapsedWidth={childrenRoutes?.length ? 65 : 0}
                       className={`relative transition-all duration-300 ease-in-out overflow-hidden ${childrenRoutes?.length ? 'border-r' : ''}`}
                       theme="light"
                       collapsed={collapsed && !!childrenRoutes?.length}>
                    {(!collapsed && !!childrenRoutes?.length) && (
                        <div className="w-full h-[65px] border-b flex justify-center items-center text-xl font-semibold truncate absolute transition-opacity duration-300 ease-in-out">
                            {getSetting('app_name')}
                        </div>
                    )}

                    <div className={`w-full h-full pt-[65px] transition-opacity duration-300 ease-in-out ${childrenRoutes?.length ? 'opacity-100' : 'opacity-0'}`}>
                        {childrenRoutes?.length > 0 && (
                            <LayoutMenu collapsed={collapsed} routeProps={childrenRoutes}/>
                        )}
                    </div>
                </Sider>

                <Content className="overflow-hidden relative">
                    <Header className="h-[65px] w-full leading-none flex justify-between items-center border-b p-0 absolute">
                        <div className="flex h-full items-center">
                            <div className={`transition-all duration-300 ease-in-out ${childrenRoutes?.length ? 'opacity-100 w-auto' : 'opacity-0 w-0'} overflow-hidden`}>
                                {!!childrenRoutes?.length && <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>}
                            </div>
                            <LayoutBreadcrumb/>
                        </div>
                        <LayoutTopBar/>
                    </Header>

                    <div className="w-full h-full pt-[65px]">
                        <LayoutContent/>
                    </div>
                </Content>
            </Layout>
        </Layout>
    )
}
